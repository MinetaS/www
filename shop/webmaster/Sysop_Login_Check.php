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

if(ereg($_POST['ADMINID'] , $DENYID)) js_alert_location("���ٰź� ���̵� �Դϴ�.","-1");
if(!$_POST['ADMINID'] || !$_POST['ADMINPASS'] || !$_POST['IP']) js_alert_location("�߸��� �����Դϴ�.","-1");

$ADMINID = trim(strtolower($ADMINID));
$ADMINPASS = trim(strtolower($ADMINPASS));

$sql = "select ID , PWD , Name , NickName , Grade , Email , GrantSta from ${MEMBER_TABLE_NAME} where ID = '$ADMINID' and PWD = '$ADMINPASS'" ;
$result = mysql_query($sql);
$list = mysql_fetch_array($result);

$ALLOWFORADMIN = explode("|" , $ALLOWFORADMIN);
if(!$list[ID]) js_alert_location("���̵� �н����尡 ��ġ ���� �ʽ��ϴ�","./index.php");
if(!in_array($list[Grade] , $ALLOWFORADMIN)) js_alert_location("������� ȸ������� �ƴմϴ�.","./index.php"); 
if(ereg($IP , $DENYIP)) js_alert_location("���ٰź� ������ �Դϴ�.","./index.php");
if($list[GrantSta] != "checked" ) js_alert_location("������ �ȵǾ��ų� ������ ȸ���Դϴ�,","./index.php");



	if($list[Grade] == "1")  setcookie("ROOT_PASS", "$ADMINPASS", 0, "/");


	 setcookie("ADMIN_CHECK_GRADE", "$list[Grade]", 0, "/");
	 setcookie("MEMBER_NAME", "$list[Name]", 0, "/");
	 setcookie("MEMBER_ID", "$list[ID]", 0, "/");
	 setcookie("MEMBER_EMAIL", "$list[Email]", 0, "/");
	 setcookie("MEMBER_GRADE", "$list[Grade]", 0, "/");
	 setcookie("MEMBER_NICKNAME", "$list[NickName]", 0, "/");

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


	 $fp = fopen("../${MEMBER_TEMP_FOLDER_NAME}/login_user/$ADMINID.cgi", "w");
	 $LoginTime = time();
	 fwrite($fp, "$list[ID]|$list[Name]|$LoginTime|$list[Email]|$list[Grade]|$list[NickName]|");
	 fclose($fp);

	srand ((double) microtime() * 1000000);
	$value = rand(2,3);
	setcookie("ROOT_COLOR_TYPE", "$value", 0, "/");

	$result = boolInsertLoginHistory($list[ID] , $IP , '������������' , $_SERVER['HTTP_REFERRER'] , 'LOGIN' );
	if(!$result) js_alert("Login History DB �۾��� ����");

	$DLIST = _mysql_fetch_array("SELECT  WDate FROM ${LOGIN_HISTORY_TABLE_NAME} WHERE ID='$ADMINID' order by WDate Desc Limit 1");

	if( date("ymd") != date("ymd",$DLIST[WDate]) ){//���ÿ� 2�� �α��νô� �ش� ���� �ʴ´�..

		$time = time();
		$Content = date("Y-m-d H : i : s"). " �α��� " ;
		$GName = "System";// ����Ʈ �ο���
		$Flag = "L";// �α��� �÷���
		boolInsertPoint('',$ADMINID , $GName , $LPoint , $Flag ,$Content);
	}

	js_alert_location("${list[Name]} �� ${MEMBER_GRADE_NAME[$list[Grade]]} ���� �α��� �Ǽ̽��ϴ�. " , "./main.php?THEME=Front" );


?>
