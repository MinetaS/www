<?
/*
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/
include "../config/db_info.php";
include "../config/db_connect.php";
include "../config/admin_info.php";
include "../config/board_info.php";
include "../function/const_array.php";
include "../function/kerrigancap_lib.php";





if(!$SameDB){
	$BOARD_NAME="${DEFAULT_TABLE_NAME}_${GID}_${BID}";
	$UpdirPath = $BID;
}else{
	$BOARD_NAME="${DEFAULT_TABLE_NAME}_${SameDB}";
	$UpdirPath = $SameDB;
	}
/****[Ȯ��DB����] *******/
if($ExtendDB)
$BOARD_NAME="$ExtendDB";


if(!strcmp($Mode, "SecretLogin")): // ��б��̳� ������

	/* �Ϲ� �Խù� ������� ������ �����´�. */
	$SqlStr = "select UID, PASSWD, THREAD, FID from $BOARD_NAME where UID = $UID";
	$sqlqry = mysql_query($SqlStr);
	$list = mysql_fetch_array($sqlqry);

	if($mode == "secret")://��б� �α����ϰ��
		if(strcmp($list[THREAD],"A")){
			$SqlStr = "select PASSWD from $BOARD_NAME where FID = $list[FID] and THREAD = 'A'";
			$sqlqry = mysql_query($SqlStr);
			$list = mysql_fetch_array($sqlqry);
		}

		$url="../$BOARD_MAIN_FILE_NAME?BID=$BID&GID=$GID&mode=$nmode&rmode=$rmode&UID=$UID&CURRENT_PAGE=$CURRENT_PAGE&category=$category&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax";

		if($SecretPASS == $list[PASSWD]){
			$COOKIE_VALUE = $UID."_".$BID."_".$GID;
			setcookie("SECRET", "$COOKIE_VALUE", 0, "/");
			js_location("$url");
			exit;
		}else{//�α��� �����ϰ��
			js_alert_location("��б� �α��ο� �����Ͽ����ϴ�.\\n\\n��й�ȣ�� üũ���ּ���","$url");
		}

	else ://modify�α����ϰ��

		$url="../$BOARD_MAIN_FILE_NAME?BID=$BID&GID=$GID&mode=$nmode&rmode=$rmode&UID=$UID&CURRENT_PAGE=$CURRENT_PAGE&category=$category&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax";

		if($SecretPASS == $list[PASSWD]){
			$COOKIE_VALUE = $UID."_".$BID."_".$GID;
			setcookie("MODIFY", "$COOKIE_VALUE", 0, "/");
			js_location("$url");
			exit;
		}else{//�α��� �����ϰ��
			js_alert_location("������� �α��ο� �����Ͽ����ϴ�.\\n\\n��й�ȣ�� üũ���ּ���","$url");
		}

	endif;


endif;
?><meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
