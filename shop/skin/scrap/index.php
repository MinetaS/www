<?
include "../../config/db_info.php";
include "../../config/db_connect.php";
include "../../config/admin_info.php";
include "../../config/skin_info.php";
include "../../config/shopDisplay_info.php";
include "../../config/cart_info.php";
include "../../function/const_array.php";
include "../../config/membercheck_info.php";// ���� ���� 
include "../../function/kerrigancap_lib.php";


if (!isMember()) {
	js_alert_location("�α����� �̿� �����մϴ�.","close");
}

if($USE_SCRAB != "checked"){
	js_alert_location("��ũ����� ���Ұ� �����Դϴ�.","close");
}



if($mode == "write"){//��ũ�� ���� 	
		
	
	$ID = $_COOKIE[MEMBER_ID];
	$ScrapType = $Type;
	$TableName = $Tbl ; 
	$DocNo = $UID;
	$WDate = time();
	
	$ExitCnt = getSingleValue("select count(*) from ${SCRAP_TABLE_NAME} where ID = '$ID' and ScrapType = '$ScrapType' and TableName = '$TableName' and DocNo = '$DocNo'");
	
	if($ExitCnt > 0) js_alert_location("�̹� ��ũ�� �ϼ̽��ϴ�.","close");
	
	$result =  boolInsertScrap($ID , $ScrapType , $TableName , $DocNo);
	
	if(!$result) js_alert_location("DB �۾��� ������ �߻��Ͽ����ϴ�.","close");
			
			
	// ���� ���������� �̵��Ѵ�..
		
		js_location("./$ScrapSkin/list.php");
		exit;
							
	
	
}//���� 


if($mode == "delete"){
	
	$sql = "delete from ${SCRAP_TABLE_NAME} where UID = '$UID'" ; 
	$result = mysql_query($sql);
	
	if($result) js_alert_location("���������� ���� �Ǿ����ϴ�","./");
	else js_alert_location("DB �۾��� ������ �߻��Ͽ����ϴ�. ","-1");
			
	
}// ���� 


if(!$mode) {
	js_location("./$ScrapSkin/list.php");
	exit;
}

?>
