<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<?
/*
���� �뷮 ���� �߰�
ATTACH_CAPACITY
*/


set_time_limit (0);


/* CATEGORY �� ���� ��� $CATEGORY�� $BID�� �ִ´�. $CATEGORY�� �� ���̺��� �������� ī�װ��� ������� ���� */
//if(!$CATEGORY) $CATEGORY_IN = $BID;
//else $CATEGORY_IN = $CATEGORY;

$CATEGORY_IN = $CATEGORY;
$SUBJECT = trim($SUBJECT);

if(!$SUBJECT){
	js_alert_location("������ �����ϴ�.","-1");
}

/* ���� ���ε� ���� */
unset($UPDIR1);
unset($UPDIR2);
$file_field_name = "file";
file_uploade($file_field_name);
$upload_path =  "./${BOARD_FOLDER_NAME}/table/".$GID."/".$BID."/updir";
while(is_array($file_name) && list($att_key, $att_value) = each($file_name)):
$MicroTsmp = explode(" ",microtime());
$newFileName = str_replace(".", "", $MicroTsmp[0]);
	if($file_tmp_name[$att_key]!="none" && $file_tmp_name[$att_key]){
    	$extention = strrchr($file_name[$att_key], ".");

		/*
		if(ereg($extention, $REVOKE_EXTENSION)) { // ���� Ȯ����
			js_alert_location("$extention �� ������ Ȯ�����Դϴ�.","-1");
		}
		*/
		upload_filter($extention);
		$UPDIR2 .=$file_name[$att_key]."|"; /* ���� ���ϸ� �־��*/
		if($FILE_NAME_REARRANGE) $file_name[$att_key]=time()."".$extention;
    	if (file_exists($upload_path."/".$file_name[$att_key]) && !$UpLoadingOverWriteEnable) {
	    if(!$FILE_NAME_REARRANGE) $file_name[$att_key] = date("is")."_$file_name[$att_key]";
		else $file_name[$att_key] = $newFileName."_$file_name[$att_key]".$extention;
    	}
	    if(!move_uploaded_file($file_tmp_name[$att_key], $upload_path."/".$file_name[$att_key])) {
			js_alert_location("���� ���ε��� �����Ͽ����ϴ�.","-1");
    	}
	$UPDIR1 .=$file_name[$att_key]."|";
	}
endwhile;

/* ���� ���ε� �� */

/* DB�� ����� DATA�� �� �� ó���� �Ѵ�. */
include "./${BOARD_FOLDER_NAME}/func/FILTERING.php";
include "./${BOARD_FOLDER_NAME}/func/FILTERING_Word.php";


$NAME = addslashes($NAME);
if(isMember()) $ID =  "$_COOKIE[MEMBER_ID]";
if(!$IP) $IP = $REMOTE_ADDR;
$SUBJECT = addslashes($SUBJECT);
$CONTENTS = addslashes($CONTENTS);
$THREAD = "A";
$COUNT = 0;
$W_DATE=time();
if(!$MDATE) $MDATE = time();

/* �йи� ���̵� ���� */
$QUERY_STR = "SELECT max(FID)+1 FROM ${BOARD_NAME}";
$LIST = mysql_query($QUERY_STR);
$FID = mysql_result($LIST,0,0);

/* board DB�� ó���� ������ INSERT �Ѵ�. */
$QUERY_STR = "INSERT INTO $BOARD_NAME (BID,ID,NAME,PASSWD,EMAIL,URL,SUBJECT,SUB_TITLE1,SUB_TITLE2,CONTENTS,SUB_CONTENTS1,SUB_CONTENTS2,THREAD,FID,COUNT,RECCOUNT,DOWNCOUNT,UPDIR1,UPDIR2,IP,SPARE1,W_DATE , MDATE , SiteKey )
VALUES('$CATEGORY_IN','$ID','$NAME','$PASSWD','$EMAIL','$URL','$SUBJECT','$SUB_TITLE1','$SUB_TITLE2','$CONTENTS','$SUB_CONTENTS1','$SUB_CONTENTS2','$THREAD','$FID','$COUNT','$RECCOUNT','$DOWNCOUNT','$UPDIR1','$UPDIR2','$IP','$SPARE1','$W_DATE' , '$MDATE', '$SiteKey')";
//echo "\$QUERY_STR = $QUERY_STR";
//exit;
$RESULT=mysql_query($QUERY_STR) or die(mysql_error());
if(!$RESULT) js_alert_location("DB �۾��� ������ �߻� �Ͽ����ϴ�","-1");
/*
ID �� ���� �ϰ� �� ���� ����Ʈ ���ΰ� ���� �Ѵٸ�...wizPoint �� ������ ���� �д�..
*/
if($ID && $PointEnable == "checked" ){

	$query_result = mysql_query( "select UID from ${MEMBER_TABLE_NAME} where ID = '$ID'", $DB_CONNECT );
	$BOARD_TITLE_DESC = getTableName($GID , $BID);
	if ( $query_result ) {
	$Content = "${BOARD_TITLE_DESC} �۾��� ����Ʈ �ο�" ; // ����Ʈ ����
	$GName = "System" ; // �ο���
	$Flag = "BW";//�۾��� �÷���
	$presult = boolInsertPoint($BOARD_NAME , $ID , $GName , $WritingPoint , $Flag ,$Content);
	if(!$presult) js_alert("����Ʈ DB �۾� ����");

	$sqlstr = "update ${MEMBER_TABLE_NAME} set WriteNum = WriteNum + 1 where ID = '$ID'";
	$sqlqry = mysql_query($sqlstr) or die(mysql_error());
	}

}

/* ���ο��� ���� ���� ������ */

// �Խ��� ���� �̸�
$BOARD_TITLE_DESC = getTableName($GID , $BID);

if($MAILTOADMIN == "checked" && $EMAIL && !isAdmin()){
if(file_exists("./config/admin_info.php")) include "./config/admin_info.php";
	$SEND_CONTENT = "<a href=\"$SITE_URL/${BOARD_MAIN_FILE_NAME}?BID=$BID&GID=$GID&mode=view&UID=$UID&category=$CATEGORY&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax\">$SITE_URL/${BOARD_MAIN_FILE_NAME}?BID=$BID&GID=$GID&category=$CATEGORY&mode=view&UID=$UID&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax</a> <br> �ۼ��� : $NAME <br> <br> $CONTENTS ";
	$TO_MAIL = $ADMIN_EMAIL;
	$FROM_MAIL = "$NAME <$EMAIL>";
	$SUBJECT = "${NAME} ���� ${BOARD_TITLE_DESC} �Խ��ǿ� ���� ������ϴ�.";
	$SEND_CONTENT = "<IFRAME SRC='${SITE_URL}/${BOARD_MAIN_FILE_NAME}?BID=$BID&GID=$GID&mode=view&UID=$UID&category=$CATEGORY&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax' WIDTH=780 HEIGHT=700 FRAMEBORDER=0></IFRAME>";
	$mail_result =  boolMailSend($TO_MAIL , $FROM_EMAIL , $SUBJECT , $SEND_CONTENT );

	if(!$mail_result) js_alert("�����ڿ��� ���Ϲ߼��� ���� �Ͽ����ϴ�.") ;


}
/* ���Ϻ����� �� */

js_alert_location("�ڷᰡ ���������� ��ϵǾ����ϴ�","./${BOARD_MAIN_FILE_NAME}?BID=$BID&GID=$GID&category=$CATEGORY&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax");

?>
