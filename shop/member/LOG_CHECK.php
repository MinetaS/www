<?
/*
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/

include "../config/db_info.php";
include "../config/db_connect.php";
include "../config/admin_info.php";
include "../config/membercheck_info.php";
include "../function/const_array.php";
include "../function/kerrigancap_lib.php";

include "../function/filter.php";
////////////////////////////////
// �Ķ���� ���͸�
////////////////////////////////
$ID = filter($ID);
$PWD = filter($PWD);


$ID = trim($ID);
$PWD = trim($PWD);


$ID_Length = strlen($ID);



if(ereg($IP , $DENYIP)) js_alert_location("���ٰź� ������ �Դϴ�.","-1");
$DENYID = explode("|" , $DENYID);
if(in_array($ID , $DENYID)) js_alert_location("���ٰź� ���̵� �Դϴ�.","-1");


if(!$ReturnUrl) $ReturnUrl="../";
else $ReturnUrl = urldecode($ReturnUrl);

if(!$_POST['ID'] || !$_POST['PWD'] || !$_POST['IP']) {
	js_alert_location("���̵�� �н����带 ��� �Է��� �ֽʽÿ�.","-1");
}

if(($ID_Length >= 15) || ($ID_Length < 4)) {
	js_alert_location("���̵�� 4~15 �� ������ �������� ȥ������ �����Ǿ�� �մϴ�.","-1");
}

$MEMBER_EXISTS = mysql_query("SELECT ID,PWD,Name,Email,Url,Jumin1,Grade,NickName,Sex FROM ${MEMBER_TABLE_NAME} WHERE ID='$ID'");

$LIST = mysql_fetch_array($MEMBER_EXISTS);
if ( !$LIST ) js_alert_location("�������� �ʴ� ���̵� �Դϴ�.","-1");

/* �н����� åũ */

$MEMBER_EXISTS = mysql_query("SELECT ID,PWD,Name,NickName,Email,Url,Jumin1,Jumin2,Grade,NickName,Sex
FROM ${MEMBER_TABLE_NAME}
WHERE ID='$ID'
AND PWD='$PWD'", $DB_CONNECT);
$LIST = mysql_fetch_array($MEMBER_EXISTS);

if ( !$LIST ) js_alert_location("�н����尡 ��ġ���� �ʽ��ϴ�.","-1");

/* ���ο��� åũ */

$MEMBER_EXISTS = mysql_query("SELECT ID,PWD,Name,Email,Url,Jumin1,Grade,NickName,Sex
FROM ${MEMBER_TABLE_NAME}
WHERE ID='$ID'
AND PWD='$PWD'
AND GrantSta='checked'", $DB_CONNECT);

$LIST = mysql_fetch_array($MEMBER_EXISTS);

if ( !$LIST ) js_alert_location("ȸ������ ������ �̷�� ���� �ʾҽ��ϴ�. \\n �ڼ��� ������ �����ڿ��� �����ϼ���.","-1");


$CurrentID = $LIST[ID];     // ���̵�
$CurrentPWD = $LIST[PWD];     // ���
$CurrentNAME = $LIST[Name]; // �̸�
$CurrentEMAIL = $LIST[Email]; // �̸�
$CurrentURL = $LIST[Url];     // Ȩ
$CurrentGrade = $LIST[Grade];     // ���

/*******************************************************************************
ȸ���α������� �����ð��� ���ؼ� 2�ð�(mktime()���� - 7200)�� ����� ��� �ڵ�����..
*******************************************************************************/

$LOG_DIR = opendir("../${MEMBER_TEMP_FOLDER_NAME}/login_user");
while($LOG_FILE = readdir($LOG_DIR)) {
	if(is_file("../${MEMBER_TEMP_FOLDER_NAME}/login_user/$LOG_FILE") && mktime() - filemtime("../${MEMBER_TEMP_FOLDER_NAME}/login_user/$LOG_FILE") > 7200) {
		unlink("../${MEMBER_TEMP_FOLDER_NAME}/login_user/$LOG_FILE");
	}
}
closedir($LOG_DIR);



// �α��ο� ���� ����Ʈ �ο� �Ϸ翡 �ѹ���..
$DLIST = _mysql_fetch_array("SELECT  WDate FROM ${LOGIN_HISTORY_TABLE_NAME} WHERE ID='$CurrentID' order by WDate Desc Limit 1");

if( date("ymd") != date("ymd",$DLIST[WDate]) ){//���ÿ� 2�� �α��νô� �ش� ���� �ʴ´�..

		$time = time();
		$Content = date("Y-m-d H : i : s"). " �α��� " ;
		$GName = "System";// ����Ʈ �ο���
		$Flag = "L";// �α��� �÷���
		boolInsertPoint('',$CurrentID , $GName , $LPoint , $Flag ,$Content);
}


//�α��� ���
$result = boolInsertLoginHistory($CurrentID , $IP , '����Ʈ' , $_SERVER['HTTP_REFERRER']);

// �α��� ����� ���
$LLIST = mysql_fetch_array(mysql_query("SELECT LoginNum FROM ${MEMBER_TABLE_NAME}  WHERE ID='$CurrentID'"));
$UPDATE_LOGIN_NUM = $LLIST[LoginNum] + 1;
mysql_query("UPDATE ${MEMBER_TABLE_NAME}  SET LoginNum='$UPDATE_LOGIN_NUM' WHERE ID='$CurrentID'") or die(mysql_error());


setcookie("MEMBER_NAME", "$CurrentNAME", 0, "/");
setcookie("MEMBER_ID", "$CurrentID", 0, "/");
setcookie("MEMBER_EMAIL", "$CurrentEMAIL", 0, "/");
setcookie("MEMBER_GRADE", "$CurrentGrade", 0, "/");
setcookie("MEMBER_NICKNAME", "$CurrentNickName", 0, "/");
if($CurrentGrade == "1") {
setcookie("ADMIN_CHECK_GRADE", "1", 0, "/");// 1����̸� ������ ������ �ش�.
setcookie("ROOT_PASS", "$CurrentPWD", 0, "/");
srand ((double) microtime() * 1000000);
$value = rand(2,3);
setcookie("ROOT_COLOR_TYPE", "$value", 0, "/");
}


$fp = fopen("../${MEMBER_TEMP_FOLDER_NAME}/login_user/$CurrentID.cgi", "w");
$LoginTime = time();
fwrite($fp, "$CurrentID|$CurrentNAME|$LoginTime|$CurrentEMAIL|$CurrentGrade|$CurrentNickName|");
fclose($fp);

if(!strcmp($ispopup, "yes")){// �˾��ΰ�� �˾� �ݰ� ������ URL�� �̵�
js_opener_location($ReturnUrl);
exit;
}
// ��ٱ����� ���� �÷��� ó�� �ʿ�
js_location("$ReturnUrl");
exit;
?>
