<?
/*
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/


include "../../config/db_info.php";
include "../../config/db_connect.php";
include "../../config/admin_info.php";
include "../../config/skin_info.php"; //������� ��Ų������ ������($MemberSkin - ȸ�����Խ�Ų��)
include "../../config/membercheck_info.php";
include "../../function/const_array.php";
include "../../function/kerrigancap_lib.php";

include "../../function/filter.php";
////////////////////////////////
// �Ķ���� ���͸�
////////////////////////////////
$ID = filter($ID);
$Name = filter($Name);
$PWD = filter($PWD);
$RecID = filter($RecID);



$ID = trim($ID);
$Name = trim($Name);
$PWD = trim($PWD);
$RecID = trim($RecID);
$PWDAnswer = addslashes($PWDAnswer);
/*******************************************************************************
ȸ���α������� �����ð��� ���ؼ� 2�ð�(mktime()���� - 7200)�� ����� ��� �ڵ�����..
*******************************************************************************/
$LOG_DIR = opendir("../../${MEMBER_TEMP_FOLDER_NAME}/login_user");
while($LOG_FILE = readdir($LOG_DIR)) {
	if(is_file("../../${MEMBER_TEMP_FOLDER_NAME}/login_user/$LOG_FILE") && mktime() - filemtime("../../${MEMBER_TEMP_FOLDER_NAME}/login_user/$LOG_FILE") > 7200) {
		unlink("../../${MEMBER_TEMP_FOLDER_NAME}/login_user/$LOG_FILE");
	}
}
closedir($LOG_DIR);

$ID = trim($ID);
$Name = trim($Name);
$PWD = trim($PWD);
$RecID = trim($RecID);
$PWDAnswer = addslashes($PWDAnswer);
$BirthDay = $BirthYY."-".$BirthMM."-".$BirthDD;

$Tel = $Tel1_1."-".$Tel1_2."-".$Tel1_3;
$Hand = $Hand1_1."-".$Hand1_2."-".$Hand1_3;
$Fax = $Fax1_1."-".$Fax1_2."-".$Fax1_3;
$CTel = $CTel1_1."-".$CTel1_2."-".$CTel1_3;//  ȸ�� ��ȣ
$CFax = $CFax1_1."-".$CFax1_2."-".$CFax1_3;// ȸ�� �ѽ�
$Fax = $Fax1_1."-".$Fax1_2."-".$Fax1_3;
$Zip1 = $Zip1_1."-".$Zip1_2;
$Zip2 = $Zip2_1."-".$Zip2_2;
$MarrDate = $MarrYY."-".$MarrMM."-".$MarrDD;
if(!$Email) $Email = $Email1_1."@".$Email1_2;
if(!$Grade) $Grade=10;
$GrantSta=$EGrantSta;
$MDesc = addslashes($MDesc);// �������Է½� �޸� ���� �ִ� ���
if(!$MPublic) $MPublic = "N"; // ���� ���� ����
$RegDate = time();
$MProfile  = addslashes($MProfile);// �ڱ� �Ұ�

/**********************************************************************/
if ( !$ID || !$PWD || !$Name || !$IDCheckFlag || !$IP) {
	js_alert_location("\\n\\n���������� ������� �����Ͽ����ϴ�.\\n\\n","../../");
}

// ���̵� �ߺ� üũ Ȯ��
$id_exists = mysql_fetch_array(mysql_query( "select * from ${MEMBER_TABLE_NAME} where ID='$ID'", $DB_CONNECT ));
if ($id_exists) js_alert_location("\\n\\n�̹� ��ϵ� ���̵��Դϴ�.\\n\\n","-1");


if($UseJuminCheck == "checked" && $Grade=="10"){ // �ֹ� ��ȣ ����� �ϰ� �Ϲ� ȸ���̸� �ֹ� ��ȣ üũ�� �Ѵ�.
	$num_exists = mysql_fetch_array(mysql_query( "select * from ${MEMBER_TABLE_NAME} where Jumin1='$Jumin1' AND Jumin2='$Jumin2'", $DB_CONNECT ));
	if ($num_exists) js_alert_location("\\n\\n�̹� ��ϵ� �ֹε�Ϲ�ȣ�Դϴ�.\\n\\n�����ڿ��� �����Ͻʽÿ�\\n\\n","-1");
}


/*****************************************************************************
  ��õ�ο��� ����Ʈ �������ֱ�.(Point ���̺� ����)
*****************************************************************************/
if ($RecID && $USE_RECOMMEND == "checked") {
if($RecID == $ID) js_alert("������ ��õ�ϽǼ� �����ϴ�.");
$reqer_exists = mysql_fetch_array(mysql_query( "select ID from ${MEMBER_TABLE_NAME} where ID='$RecID'", $DB_CONNECT ));
	if ($reqer_exists) 	boolInsertPoint('' , $RecID , $ID , $RPoint , 'RM',  "$Name($ID)ȸ���� ��õ����Ʈ");
}


// ȸ�� ������ ���
unset($Picture);
/* ���� ���ε� ���� */

$file = $_FILES["file1"]["tmp_name"];
$file_name = $_FILES["file1"]["name"];

if($file!="none" && $file){
		upload_image_filter($file_name);
		$extention = strrchr($file_name, ".");
		$file_name = time()."".$extention;
		upload_filter($file_name);

  	if (file_exists("../../${MEMBER_TEMP_FOLDER_NAME}/user_image/$file_name")) {
    	$file_name = time()."_$file_name";
  	}
    if(!move_uploaded_file($file, "../../${MEMBER_TEMP_FOLDER_NAME}/user_image/$file_name")) {
  		js_alert_location("���� ���忡 ���� �߽��ϴ�.","-1");
		}
		$Picture =$file_name;
}




/**************************************************************************************************
  DB CONNECT -> INSERT INTO ${MEMBER_TABLE_NAME} ; DB������ ȸ�������͸� �����Ѵ�. 1�� �⺻ ���� �Է�
**************************************************************************************************/

$sql = "INSERT INTO ${MEMBER_TABLE_NAME} (
ID,PWD,Name,NickName,PWDHint,PWDAnswer,Sex,Jumin1,Jumin2,BirthDay,BirthType,Email,
MailReceive, SMSReceive , Tel,Hand,Fax,Zip1,Address1,Address2,Job,Scholarship,Company,CTel, CFax, Zip2,
Address3,Address4,MarrStatus,MarrDate,RegDate,ModDate , Url,RecID,GrantSta,Grade,WriteNum,RegIP,
 LicenseNo , Business , Item , President , MProfile  , MDesc , MPublic , Picture , SiteKey)
VALUES(
'$ID','$PWD','$Name','$NickName','$PWDHint','$PWDAnswer','$Sex','$Jumin1','$Jumin2','$BirthDay','$BirthType','$Email',
'$MailReceive', '$SMSReceive' , '$Tel','$Hand','$Fax','$Zip1','$Address1','$Address2','$Job','$Scholarship','$Company','$CTel','$CFax','$Zip2',
'$Address3','$Address4','$MarrStatus','$MarrDate','$RegDate','$RegDate','$Url','$RecID','$GrantSta','$Grade','0','$IP' ,
'$LicenseNo' , '$Business' , '$Item' , '$President' , '$MProfile' , '$MDesc' , '$MPublic' , '$Picture' , '$SiteKey')";

$result = mysql_query($sql);
if(!$result){
	js_alert_location("DB �۾��� ������ �߻� �߽��ϴ�.","../../");
}



/*******************************************************************************
���� ���� �������� ȸ���α�(��Ű�� ���� �� ���� ����)�� ���۵ȴ�
*******************************************************************************/
if($GrantSta == "checked"):
	$MEMBER_EXISTS = mysql_query("SELECT ID,PWD,Name,NickName , Email,Url,Jumin1,Grade
	FROM ${MEMBER_TABLE_NAME}
	WHERE ID='$ID'
	AND PWD='$PWD'
	AND GrantSta='checked'", $DB_CONNECT);
	$LIST = mysql_fetch_array($MEMBER_EXISTS);
	if ( !$LIST ) {
		js_alert_location("���̵�� �н����尡 ��ġ���� �ʽ��ϴ�.","-1");
	}

	// ����Ʈ �ο�
	if($EPoint > 0 ) { boolInsertPoint('', $ID , "System" , $EPoint , 'M', "ȸ������ ���� ����Ʈ");}


	if(!$WHERE_REGIS):// ������ ��忡�� ��ϵȰ� �ƴҰ�츸 ��Ű ���� ���ش�..

			$CurrentID = $LIST[ID];     // ���̵�
			$CurrentNAME = $LIST[Name]; // �̸�
			$CurrentEMAIL = $LIST[Email]; // �̸�
			$CurrentURL = $LIST[Url];     // Ȩ
			$CurrentGrade = $LIST[Grade];     // ���
			$CurrentNickName = $LIST[NickName]; 	// �г���

			setcookie("MEMBER_NAME", "$CurrentNAME", 0, "/");
			setcookie("MEMBER_ID", "$CurrentID", 0, "/");
			setcookie("MEMBER_EMAIL", "$CurrentEMAIL", 0, "/");
			setcookie("MEMBER_GRADE", "$CurrentGrade", 0, "/");
			setcookie("MEMBER_NICKNAME", "$CurrentNickName", 0, "/");
			$fp = fopen("../../${MEMBER_TEMP_FOLDER_NAME}/login_user/$CurrentID.cgi", "w");
			$LoginTime = time();
			fwrite($fp, "$CurrentID|$CurrentNAME|$Log_Time|$CurrentEMAIL|$CurrentURL|$CurrentGrade|$CurrentNickName");
			fclose($fp);

	endif;

endif ;

if($SendMail == "Y" && $MailReceive == "Y") { include("./USER_REGIS_MAIL.php"); }


if($GrantSta == "checked"){
	js_alert("\\n������ ���������� �̷�������ϴ�. \\nȸ������ ������ �ֽ� {$Name} �Բ� �������� ����帳�ϴ�.");
}else{
	js_alert("\\n {$Name} �Բ����� ������ ������ ȸ�����񽺸� �̿��ϽǼ� �ֽ��ϴ�..");
}


if($ispopup == "yes"){// �˾�â���� ���� �Ѿ� �� ���
	js_location("close");
	exit;
}

if ($WHERE_REGIS == "ADMIN") { // ������ ��忡�� ���� �Ѿ� �� ���
	js_location("-1");
	exit;
}else{
	js_location("../../${MEMBER_MAIN_FILE_NAME}?query=regis_complete");
	exit;
}

?>
