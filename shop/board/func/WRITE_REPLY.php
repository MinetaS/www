<meta http-equiv="Content-Type" content="text/html; charset=euc-kr"><?
include  "${BOARD_FOLDER_NAME}/func/FILTERING.php";

/* CATEGORY �� ���� ��� $CATEGORY�� $BID�� �ִ´�. $CATEGORY�� �� ���̺��� �������� ī�װ��� ������� ���� */

//if(!$CATEGORY) $CATEGORY_IN = $BID;
//else $CATEGORY_IN = $CATEGORY;

$CATEGORY_IN = $CATEGORY;
/* DB�� ����� DATA�� �� �� ó���� �Ѵ�. */

$NAME = addslashes($NAME);

if(isMember()) $ID =  "$_COOKIE[MEMBER_ID]";
if(!$IP) $IP = $REMOTE_ADDR;

if(substr($SUBJECT,0,4)=="Re: ") $SUBJECT=substr($SUBJECT,4);
$CONTENTSOri = split("\[��������]", $CONTENTS);
$SUBJECT = addslashes($SUBJECT);
$CONTENTS = addslashes($CONTENTSOri[0]);

$THREAD = "A";
$W_DATE = time();
$MDATE = time();
$COUNT = 0;
$NEW_THREAD="A";

/* ���� ���ε� ���� */
unset($UPDIR1);
unset($UPDIR2);
$file_field_name = "file";
file_uploade($file_field_name);
$upload_path = "${BOARD_FOLDER_NAME}/table/".$GID."/".$BID."/updir";
while(is_array($file_name) && list($att_key, $att_value) = each($file_name)):
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



	$SQL_STR="SELECT FID,THREAD,EMAIL,SPARE1 FROM $BOARD_NAME WHERE UID='$UID'";
	$SQL_QRY=mysql_query($SQL_STR);

	$CURRENT_FID=mysql_result($SQL_QRY,0,FID);
	$CURRENT_THREAD=mysql_result($SQL_QRY,0,THREAD);
	$CURRENT_EMAIL=mysql_result($SQL_QRY,0,EMAIL);
	$SQL_STR_REPLY="SELECT right(THREAD,1) from $BOARD_NAME WHERE FID='$CURRENT_FID' and length('$CURRENT_THREAD')+1=length(THREAD) and locate('$CURRENT_THREAD',THREAD)=1 order by THREAD DESC limit 0,1";
	$SQL_QRY=mysql_query($SQL_STR_REPLY);
	if($LIST=@mysql_fetch_array($SQL_QRY)) {
		$MORE_THREAD=$LIST[0];
		$FUTURE_THREAD=$CURRENT_THREAD.chr(ord($MORE_THREAD)+1);
	} else {

		$FUTURE_THREAD=$CURRENT_THREAD."A";
	}



$SQL_STR="INSERT INTO $BOARD_NAME set BID='$CATEGORY_IN',ID='$ID', NAME='$NAME', PASSWD='$PASSWD', EMAIL='$EMAIL',URL='$URL', SUBJECT='$SUBJECT',
SUB_TITLE1='$SUB_TITLE1', SUB_TITLE2='$SUB_TITLE2',CONTENTS='$CONTENTS', SUB_CONTENTS1='$SUB_CONTENTS1', SUB_CONTENTS2='$SUB_CONTENTS2',
FID='$CURRENT_FID', THREAD='$FUTURE_THREAD', W_DATE='$W_DATE',COUNT='$COUNT', UPDIR1='$UPDIR1', UPDIR2='$UPDIR2', SPARE1 = '$SPARE1' , MDATE='$MDATE' , SiteKey = '$SiteKey'";

$SQL_QRY=mysql_query($SQL_STR) ;
/* Mail_Receive = 1 �̸� Writer_Email ������ ������. */


if($ID && $PointEnable == "checked" ){

	$query_result = mysql_query( "select UID from ${MEMBER_TABLE_NAME} where ID = '$ID'", $DB_CONNECT );
	$BOARD_TITLE_DESC = getTableName($GID , $BID);
	if ( $query_result ) {
		$Content = "${BOARD_TITLE_DESC} �亯�۾��� ����Ʈ �ο�" ; // ����Ʈ ����
		$GName = "System" ; // �ο���
		$Flag = "BW";//�۾��� �÷���
		$presult = boolInsertPoint($BOARD_NAME , $ID , $GName , $WritingPoint , $Flag ,$Content);
		if(!$presult) js_alert("����Ʈ DB �۾� ����");
		$sqlstr = "update ${MEMBER_TABLE_NAME} set WriteNum = WriteNum + 1 where ID = '$ID'";
		$sqlqry = mysql_query($sqlstr) or die(mysql_error());
	}

}


	// �Խ��� ���� �̸�
	$BOARD_TITLE_DESC = getTableName($GID , $BID);

	if(is_file( "./config/admin_info.php")) include "./config/admin_info.php";

	if($RepleMail == "1" && $CURRENT_EMAIL){// �亯 ������ ������츸 ���� ������..
		$SEND_CONTENT = "<a href=\"$SITE_URL/${BOARD_MAIN_FILE_NAME}?BID=$BID&GID=$GID&mode=view&UID=$UID&category=$CATEGORY&tableskin=skip&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax\">$SITE_URL/${BOARD_MAIN_FILE_NAME}?BID=$BID&GID=$GID&category=$CATEGORY&mode=view&UID=$UID&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax</a> <br> �ۼ��� : $NAME <br> <br> $CONTENTS ";
		$TO_MAIL = $CURRENT_EMAIL;
		$FROM_EMAIL = "$NAME <$EMAIL>";
		$SUBJECT = "{$BOARD_TITLE_DESC} �Խ��ǿ� ���� �亯���� �����Ͽ����ϴ�.";

		$mail_result =  boolMailSend($TO_MAIL , $FROM_EMAIL , $SUBJECT , $SEND_CONTENT );
		if(!$mail_result) js_alert(" ���Ϲ߼��� ���� �Ͽ����ϴ�.") ;

	}


	if($MAILTOADMIN == "checked" && !isAdmin()){

		if($CURRENT_EMAIL){// �亯 ������ ������츸 ���� ������..
			$SEND_CONTENT = "<a href=\"$SITE_URL/${BOARD_MAIN_FILE_NAME}?BID=$BID&GID=$GID&mode=view&UID=$UID&category=$CATEGORY&tableskin=skip&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax\">$SITE_URL/${BOARD_MAIN_FILE_NAME}?BID=$BID&GID=$GID&category=$CATEGORY&mode=view&UID=$UID&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax</a> <br> �ۼ��� : $NAME <br> <br> $CONTENTS ";
			$TO_MAIL = $CURRENT_EMAIL;
			$FROM_EMAIL = "$NAME <$EMAIL>";
			$SUBJECT = "{$BOARD_TITLE_DESC} �Խ��ǿ� �亯���� �����Ͽ����ϴ�.";

			$mail_result =  boolMailSend($TO_MAIL , $FROM_EMAIL , $SUBJECT , $SEND_CONTENT );
			if(!$mail_result) js_alert("�����ڿ��� ���Ϲ߼��� ���� �Ͽ����ϴ�.") ;

		}
	}



if($flag == "write_only") $tmode = "write";
else $tmode = "";
js_location("${BOARD_MAIN_FILE_NAME}?BID=$BID&GID=$GID&mode=$tmode&category=$CATEGORY&CURRENT_PAGE=${CURRENT_PAGE}&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax");
exit;

?>
