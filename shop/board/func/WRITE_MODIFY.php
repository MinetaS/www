<?
/*
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/

set_time_limit (0);
/* CATEGORY �� ���� ��� $CATEGORY�� $BID�� �ִ´�. $CATEGORY�� �� ���̺��� �������� ī�װ��� ������� ���� */
//if(!$CATEGORY) $CATEGORY_IN = $BID;
//else $CATEGORY_IN = $CATEGORY;
$CATEGORY_IN = $CATEGORY;
/*** ADMIN �н����� �������� ******/
if($GID) $ADMIN_STR="SELECT Pass FROM ${BOARD_MAIN_TABLE_NAME} WHERE BID='$BID' and GID='$GID'";
else $ADMIN_STR="SELECT Pass FROM ${BOARD_MAIN_TABLE_NAME} WHERE BID='$BID'";
$ADMIN_QRY=mysql_query($ADMIN_STR);
$ADMINPWD=mysql_fetch_array($ADMIN_QRY) or die(mysql_error());;

/*** �� �ۼ��� �н����� �� ���ε� ���� �������� *****/
	$SQL_STR="SELECT ID, PASSWD, UPDIR1, UPDIR2 FROM $BOARD_NAME WHERE UID='$UID'";
	$SQL_QRY=mysql_query($SQL_STR);
	$LIST=mysql_fetch_array($SQL_QRY);
	$UPDIRF = explode("|", $LIST[UPDIR1]); /* ���� ���ε� �� ���� �������� */
	$UPDIRFN = explode("|", $LIST[UPDIR2]); /* ���� ���ε� �� ���� �̸� �������� */
	$LIST[PASSWD]=trim($LIST[PASSWD]);


if(!isAdmin()){

	if($PASSWD && $PASSWD != $LIST[PASSWD]) { // ��ȸ�� �Խ������� �н����带 �Է��ϴ� ���̶�� �Էµ� �н����带 ��ȣ ���Ѵ�.
		js_alert_location("���ۼ��� �н����带 �Է����ּ���.","-1");
	}
}

/* ���� ���ε� ���� */
unset($UPDIR1);
unset($UPDIR2);
//echo "sizeof($file) = ".sizeof($file)."<br>";
$file_field_name = "file";
file_uploade($file_field_name);
$upload_path = "./${BOARD_FOLDER_NAME}/table/".$GID."/".$BID."/updir";

		while(is_array($file_name) && list($att_key, $att_value) = each($file_name)):
		//echo "file_name[$att_key] = ".$file_name[$att_key]." <br>";
			$MicroTsmp = explode(" ",microtime());
			$newFileName = str_replace(".", "", $MicroTsmp[0]);
			if($file_tmp_name[$att_key]!="none" && $file_tmp_name[$att_key]){
				$extention = strrchr($file_name[$att_key], ".");
				/*
				if(ereg($extention, $REVOKE_EXTENSION)) {
					js_alert_location("$extention �� ������ Ȯ�����Դϴ�.","-1");
				}
				*/
				upload_filter($extention);
				$Tmp1[$att_key]=$file_name[$att_key];
				if($UPDIRF[$att_key]) unlink($upload_path."/".$UPDIRF[$att_key]);
				if($FILE_NAME_REARRANGE) $file_name[$att_key]=time()."".$extention;
				if (file_exists($upload_path."/".$file_name[$att_key]) && !$UpLoadingOverWriteEnable) {
				if(!$FILE_NAME_REARRANGE) $file_name[$att_key] = date("is")."_$file_name[$att_key]";
				else $file_name[$att_key] = $newFileName."_$file_name[$att_key]".$extention;
				}
				if(!move_uploaded_file($file_tmp_name[$att_key], $upload_path."/".$file_name[$att_key])) {
					js_alert_location("���� ���ε忡 ���� �Ͽ����ϴ�.","-1");
				}
			$Tmp[$att_key]=$file_name[$att_key];
			}else if($file_del[$att_key] && $UPDIRF[$att_key]){ //���� ���� �ɼ��� åũ �Ǿ� ������
			unlink($upload_path."/".$UPDIRF[$att_key]);
			}else {
			$Tmp[$att_key]=$UPDIRF[$att_key];
			$Tmp1[$att_key]=$UPDIRFN[$att_key];
			}

		$UPDIR1 .= $Tmp[$att_key]."|";
		$UPDIR2 .= $Tmp1[$att_key]."|";

		endwhile;

		/* DB�� ����� DATA�� �� �� ó���� �Ѵ�. */
		include "./${BOARD_FOLDER_NAME}/func/FILTERING.php";
		include "./${BOARD_FOLDER_NAME}/func/FILTERING_Word.php";
		$MDATE = time();
		$NAME = addslashes($NAME);
		$SUBJECT = addslashes($SUBJECT);
		$CONTENTS = addslashes($CONTENTS);

		/* board DB�� ó���� ������ INSERT �Ѵ�. */


		$QUERY_STR = "UPDATE $BOARD_NAME SET BID='$CATEGORY_IN',NAME='$NAME',EMAIL='$EMAIL',URL='$URL',SUBJECT='$SUBJECT',SUB_TITLE1='$SUB_TITLE1',
		SUB_TITLE2='$SUB_TITLE2',CONTENTS='$CONTENTS',SUB_CONTENTS1='$SUB_CONTENTS1',SUB_CONTENTS2='$SUB_CONTENTS2',UPDIR1='$UPDIR1',UPDIR2='$UPDIR2',SPARE1='$SPARE1',MDATE='$MDATE'
		WHERE UID='$UID'";

		$result=mysql_query($QUERY_STR) or die(mysql_error());
		if($flag == "write_only") $tmode = "write";
		else $tmode = "";
		if($result)  js_alert_location("�ڷᰡ ���������� ���� �Ǿ����ϴ�.","./${BOARD_MAIN_FILE_NAME}?BID=$BID&GID=$GID&mode=$tmode&category=$CATEGORY_IN&mode=view&UID=$UID&CURRENT_PAGE=$CURRENT_PAGE&BOARD_NO=$BOARD_NO&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax");
		else js_alert_location("DB�۾��� ������ �߻� �Ͽ����ϴ�.","-1");

?>
