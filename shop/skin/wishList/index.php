<?
/* 
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/

header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include "../../config/db_info.php";
include "../../config/db_connect.php";
include "../../config/skin_info.php";
include "../../config/shopDisplay_info.php";
include "../../config/admin_info.php";
include "../../config/cart_info.php";
include "../../function/const_array.php";
include "../../function/kerrigancap_lib.php";


include "../../function/member_check_module.php" ; // ȸ��üũ

if ($mode == 'insert') {// �ϳ� �̷�

		
		$cnt = getSingleValue("select count(UID) from ${WISHLIST_TABLE_NAME} where ID = '$_COOKIE[MEMBER_ID]' and PID = '$no'");// ������ ��� �� �ִ��� �˻�
		if($cnt > 0 ) js_alert_location("������ �����Ͻ� ��ǰ�� �̹� ���ø���Ʈ�� ��� �ִ� ��ǰ�Դϴ�.","-1");
		
		//�ɼ��� ������� 
	  if($Option1 || $Option2)   js_alert_location("�ɼ��� �ִ� ��ǰ�� ���ø���Ʈ�� ������ �����ϴ�.","-1");
		
		$WDate = time();		
		$sql = "insert into ${WISHLIST_TABLE_NAME} (ID, PID , OptionDetail , WDate , SiteKey) values 
				('$_COOKIE[MEMBER_ID]', '$no' , '$OptionDetail' , '$WDate' , '$SiteKey' ) ";		
		$result = mysql_query($sql);
		
		if($result){		
			$WISH_NUM = getSingleValue("select count(UID) as cnt from ${WISHLIST_TABLE_NAME} where ID = '$_COOKIE[MEMBER_ID]'");			
			js_alert_location("\\n\\n�����Ͻ� ��ǰ�� WISH LIST �� ��ҽ��ϴ�.    \\n\\n���� ������ WISH LIST���� ${WISH_NUM}���� ��ǰ�� ����ֽ��ϴ�.\\n\\n","../../${MEMBER_MAIN_FILE_NAME}?query=wish");
		}else{
			js_alert_location("DB �۾��� ������ �߻� �߽��ϴ�.","-1");
		}

	
} else if($mode == "delete"){// ����
	
		
		$sql = "delete from ${WISHLIST_TABLE_NAME} where UID = '$UID' and ID = '$_COOKIE[MEMBER_ID]'";
				
		$result = mysql_query($sql);
		if($result){
			 js_alert_location("\\n\\n�����Ͻ� ��ǰ�� WISH LIST ���� �����Ͽ����ϴ�   \\n\\n","../../${MEMBER_MAIN_FILE_NAME}?query=wish");
		}else{
			js_alert_location("DB �۾��� ������ �߻� �߽��ϴ�.","-1");
		}

} else if($mode == "truncate"){// ��� ����

		$sql = "delete from ${WISHLIST_TABLE_NAME} where ID = '$_COOKIE[MEMBER_ID]'";
		$result = mysql_query($sql);
		if($result){
			js_alert_location("\\n\\n���� ����Ʈ�� ���������� ���� ���׽��ϴ�.   \\n\\n","../../${MEMBER_MAIN_FILE_NAME}?query=wish");
		}else{
			js_alert_location("DB �۾��� ������ �߻� �߽��ϴ�.","-1");
		}

// ���� �Է¶� ��������
}


?>