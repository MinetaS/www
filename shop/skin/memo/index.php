<?
include "../../config/db_info.php";
include "../../config/db_connect.php";
include "../../config/skin_info.php";
include "../../config/shopDisplay_info.php";
include "../../config/admin_info.php";
include "../../config/cart_info.php";
include "../../function/const_array.php";
include "../../config/membercheck_info.php";// ���� ���� 
include "../../function/kerrigancap_lib.php";


// ������ �߰� ȸ���Ǻ� Function
function isForMember($ID){
	global $MEMBER_TABLE_NAME; 
	global $MEMBER_TEMP_FOLDER_NAME; 
	$tmpLoginCnt = false;	
	$cnt = getSingleValue("select count(UID) from ${MEMBER_TABLE_NAME} where ID = '$ID'");
	if($cnt > 0  ) $tmpLoginCnt = true;	
	if($tmpLoginCnt) return true;
	else return false;	
}



if (!isMember()) {
	js_alert_location("�α����� �̿� �����մϴ�.","close");
}

if($USE_LETTER != "checked"){
	js_alert_location("������� ���Ұ� �����Դϴ�.","close");
}

if($LETTER_DEL_DATE > 0 ){// ���� ���� ���� ���� �Ǿ�����..
// SendDate �� ���ؼ� $LETTER_DEL_DATE �� ��������..���� 
	$sql = "select UID , SendDate from ${MEMO_TABLE_NAME}" ; 
	$result = mysql_query($sql);
	while($list = mysql_fetch_array($result)){
		$DelDate = $list[SendDate] + 60*60*24*$LETTER_DEL_DATE;
		if(time() > $DelDate){
			mysql_query("delete from ${MEMO_TABLE_NAME} where UID = '$list[UID]'");
		}				
	}

}

if($mode == "write"){//���� ���� 	
	if(!$spamfree){// ���Ա� ��������
		js_alert_location("�߸��� ��η� ���̽��ϴ�.(���Ա� ����)","-1");
	}elseif($spamfree < time() - 60*60 || $spamfree > time() - 5){
		js_alert_location("�߸��� ��η� ���̽��ϴ�.(���Ա� ����2)","-1");
	} 	
	$ReceiveID = trim($ReceiveID);
	$Subject = htmlspecialchars(addslashes($Subject));
	$Content = htmlspecialchars(addslashes($Content));
	$SendDate = time();
	$SendID = $_COOKIE[MEMBER_ID];
	
	$tmpArray = explode("," , $ReceiveID )  ;
	$tmpArraySize = sizeof($tmpArray) ;
	

	if(in_array($_COOKIE[MEMBER_ID],$tmpArray) ) js_alert_location("�ڽſ��Դ� ������ �����Ǽ� �����ϴ�.","-1");
			
		for($i = 0 ; $i < sizeof($tmpArray)  ; $i++){
			$sql = "insert into ${MEMO_TABLE_NAME} (ReceiveID , Subject , Content  , SendID  , SendDate , SiteKey ) values (
			'$tmpArray[$i]' , '$Subject' , '$Content'  ,  '$SendID'  , '$SendDate' , '$SiteKey' )" ;
			
			if(isForMember($tmpArray[$i])){						 				
				$result = mysql_query($sql);
				if(!$result) js_alert_location("DB �۾��� ������ �߻��Ͽ����ϴ�. ","-1");
			}else{
				js_alert_location("ȸ�����Ը� ������ �����Ǽ��� �ֽ��ϴ�.","-1");
			}		
		
		}
	
			
	// ���� ���������� �̵��Ѵ�..
		
		js_location("./$MemoSkin/list.php?MType=send");
		exit;
			
			
				
	
	
}//���� 


if($mode == "delete"){
	
	$sql = "delete from ${MEMO_TABLE_NAME} where UID = '$UID'" ; 
	$result = mysql_query($sql);

	if(!$result) js_alert_location("DB �۾��� ������ �߻��Ͽ����ϴ�. ","-1");
			
	js_location("./$MemoSkin/list.php?MType=$MType&CURRENT_PAGE=$CURRENT_PAGE");
	exit;	
		
}// ���� 

if($MType == "write"){
	js_location("./$MemoSkin/write.php?MType=write&ReceiveID=$ReceiveID");
	exit;
}elseif(!$mode) {
	js_location("./$MemoSkin/list.php?MType=rec");
	exit;
}

?>
