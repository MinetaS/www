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


$BOARD_NAME="${DEFAULT_TABLE_NAME}_${GID}_${BID}";

if(file_exists("./table/${GID}/${BID}/detail_config.php")) include  "./table/${GID}/${BID}/detail_config.php";

if($_POST[Act] == "Del") {

include_once "../config/db_info.php";
include_once "../config/db_connect.php";
include_once "../config/admin_info.php";
include_once "../config/board_info.php";
include_once "../function/const_array.php";
include_once "../function/kerrigancap_lib.php";
	
	
if(!$UID) js_alert_location("���� ���� ���� �ʽ��ϴ�","../${BOARD_MAIN_FILE_NAME}?BID=$BID&GID=$GID&category=$category&CURRENT_PAGE=$CURRENT_PAGE&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax");
	
/* ���� ������ ���� �������� �����´� */
$SQL_STR="SELECT ID,NAME,PASSWD,EMAIL,THREAD,FID , UPDIR1 FROM $BOARD_NAME WHERE UID='$UID'";
$SQL_QRY=mysql_query($SQL_STR) or die(mysql_error());
$LIST=mysql_fetch_array($SQL_QRY);

if($member != "1"){ //ȸ������ �ƴҰ��
	$LIST[PASSWD]=trim($LIST[PASSWD]);
	if($passwd != $LIST[PASSWD]) {
		js_alert_location("�н����尡 Ʋ���ϴ�.","-1");		
	}
}else if(!isAdmin()){ //ȸ������ ��� �α��� ���θ� åũ �� �α��� ���̵�� �Խ��� ���̵� �ʵ带 ���Ѵ�. 
	
	if(!isMember()){
		js_alert_location("���� ������ ������ �����ϴ� \\n\\n ���� �α��� �Ͽ� �ֽñ� �ٶ��ϴ�.","close");
		
	}else if(!trim($LIST[ID]) || ($_COOKIE[MEMBER_ID] != $LIST[ID])){
		js_alert_location("���� ������ ������ �����ϴ� \\n\\n ���ۼ��� ���̵�� �α��� �Ͽ� �ֽñ� �ٶ��ϴ�.","close");
	
	}
}

/* ����������� �ۿ� ��������(����Ʈ������ ����)�� �޷��ִ� ���� �����Ұ��� */
$ReplyComment = $LIST[THREAD]."A";

$count = getSingleValue("select count(UID) from $BOARD_NAME where FID = '$LIST[FID]' AND THREAD = '$ReplyComment'");
if($count > 0) js_alert_location("������ �޸� ���� ����� �����ϴ�.","close");

//exit;
/******** ���ε��� ���� ���� **************/
$Updir = explode("|", $LIST[UPDIR1]);

	for($i = 0; $i < sizeof($Updir); $i++){
		if($Updir[$i] && is_file("./table/$GID/${BID}/updir/$Updir[$i]")) {
			unlink("./table/$GID/$BID/updir/$Updir[$i]");
		}
	}

		
/******* ���� ���̺�� ���� ���� ���� *********/
$SQL_STR="DELETE FROM {$BOARD_NAME}_comment WHERE MID='$UID'";

@mysql_query($SQL_STR) or die(mysql_error());

/******* ������ ���� ���� *********/
if($LIST[ID] && $PointEnable == "checked"){
	$query_result = mysql_query( "select count(*) from ${MEMBER_TABLE_NAME} where ID = '$LIST[ID]'", $DB_CONNECT );
	$BOARD_TITLE_DESC = getTableName($GID , $BID);
	if ( $query_result ) {
			
			$Content = "${BOARD_TITLE_DESC} �Խ��� �ۻ����� ����Ʈ ����" ; // ����Ʈ ����
			$GName = "System" ; // �ο��� 
			$Flag = "BW";//�ܸ�Ʈ �÷��� 						
			
			$presult = boolInsertPoint($BOARD_NAME , $LIST[ID] , $GName , "-{$WritingPoint}" , $Flag ,$Content);
			if(!$presult) js_alert("����Ʈ DB �۾� ����");			
			$sqlstr = "update ${MEMBER_TABLE_NAME} set WriteNum = WriteNum - 1 where ID = '$LIST[ID]'";
			$sqlqry = mysql_query($sqlstr) or die(mysql_error());
			
	}
	
}

/******* ���̺�� ���� ���� ���� *********/
	$SQL_STR="DELETE FROM $BOARD_NAME WHERE UID='$UID'";
	$result = mysql_query($SQL_STR) or die(mysql_error());
	
	// ��ũ�����̺� ���� 
	if($result){
		$sql = "DELETE FROM ${SCRAP_TABLE_NAME} WHERE ScrapType  = 'BOARD' AND TableName = '$BOARD_NAME' AND DocNo = '$UID'";
		$sresult = mysql_query($sql);
	}
	
	js_alert_opener_location("�Խù��� �����߽��ϴ�.","../${BOARD_MAIN_FILE_NAME}?BID=$BID&GID=$GID&category=$category&CURRENT_PAGE=$CURRENT_PAGE&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax");

}
?>
<head><title>�� ����</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="JavaScript">
<!--
function sSubmit(){
var f =  document.delete_form;
checkenable = new Array(); 
    if(f.checkenable){
    var checkenablelen = f.checkenable.length
        for (i = 0; i < checkenablelen; i++){
            if(f.checkenable[i].value == ""){
            alert(f.checkenable[i].title);
            f.checkenable[i].focus();
            return false;
            }
        }
        if(!checkenablelen && f.checkenable.value == ""){
        alert(f.checkenable.title);
        f.checkenable.focus();
        return false;
        }
    }
	
    f.submit();
}
//-->
</script> 
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center>
<?
/* ȸ�� �� ��ȸ���Խ����� ���(��, �н����� �Է��� �ְ� ���� ���� ���� ��� ǥ�ø� �޸� �Ѵ�. */
$BOARD_NAME="${DEFAULT_TABLE_NAME}_${GID}_${BID}";
$sqlstr="SELECT ID,NAME,PASSWD,EMAIL,THREAD FROM $BOARD_NAME WHERE UID='$UID'";
$sqlqry = mysql_query($sqlstr) or die(mysql_error());
$isID = @mysql_result($sqlqry, 0, ID);
?>
<?
if(!$isID && !isAdmin()): //ȸ���� ������ �ƴ� ���(��, �н����� ���� �ʿ���� ���)
?>
  <table width="100%" height="100%" border=0 cellpadding="0" cellspacing="0" style=font-family:'����';font-size:12px;line-height:20px;color:#333333>
	<form name="delete_form" action="<?=$PHP_SELF?>" method=post>
	<input type='hidden' name='Act' value='Del'>
	<input type='hidden' name='UID' value='<?=$UID?>'>
	<input type='hidden' name='CURRENT_PAGE' value='<?=$CURRENT_PAGE?>'>
	<input type='hidden' name='BID' value='<?=$BID?>'>
	<input type='hidden' name='GID' value='<?=$GID?>'>
	<input type='hidden' name='category' value='<?=$category?>'>	
	<input type="hidden" name="sysop" value="<? echo $sysop; ?>">
	<input type="hidden" name="fm" value="<? echo $fm; ?>">
	<input type="hidden" name="BType" value="<? echo $BType; ?>">
	<input type="hidden" name="ListMax" value="<? echo $ListMax; ?>">
	  
      <tr align="center"> 
        <td height="5" bgcolor="#999999"></td>
      </tr>	  
      <tr align="center"> 
        <td height="50" bgcolor="#EEEEEE">�� �ۼ� ���� <strong><font color="#0000FF">��й�ȣ</font></strong>�� 
          �Է����ּ���<br>
          ������ ���� <font color="#FF0000">������ �Ұ���</font>�մϴ�.</td>
      </tr>
      <tr> 
        <td height="30" align="center">��й�ȣ: 
          <input type="password" name="passwd" size="10" style='BACKGROUND-COLOR: white; BORDER: 1; HEIGHT: 18px; border-bottom: black 1px solid; border-left: black 1px solid; border-right: black 1px solid; border-top: black 1px solid;' id="checkenable" title="��й�ȣ�� �Է��� �ּ���";>
          </td>
      </tr>
      <tr> 
        <td align="center" bgcolor="#EEEEEE" height="100%"><input type="button" value="�����ϱ�" onClick="javascript:sSubmit();" style="border-bottom: black 1px solid; border-left: black 1px solid; border-right: black 1px solid; border-top: black 1px solid; height:40;">&nbsp;<input type="button" value="����ϱ�" onClick="javascript:window.close();" style="border-bottom: black 1px solid; border-left: black 1px solid; border-right: black 1px solid; border-top: black 1px solid; height:40;"></td>
      </tr>
    </form>
  </table>
<script language="JavaScript">
<!--
document.delete_form.passwd.focus();
//-->
</script>  
<? 
else: //ȸ���� ������ ��� 
?>  
  <table width="100%" height="100%" border=0 cellpadding="0" cellspacing="0" style=font-family:'����';font-size:12px;line-height:20px;color:#333333>
		<form name="delete_form" action="<?=$PHP_SELF?>" method=post>
		<input type='hidden' name='Act' value='Del'>
		<input type='hidden' name='UID' value='<?=$UID?>'>
		<input type='hidden' name='CURRENT_PAGE' value='<?=$CURRENT_PAGE?>'>
		<input type='hidden' name='BID' value='<?=$BID?>'>
		<input type='hidden' name='GID' value='<?=$GID?>'>
		<input type='hidden' name='category' value='<?=$category?>'>	  
		<input type="hidden" name="member" value="1">
		<input type="hidden" name="sysop" value="<? echo $sysop; ?>">
		<input type="hidden" name="fm" value="<? echo $fm; ?>">
		<input type="hidden" name="BType" value="<? echo $BType; ?>">
		<input type="hidden" name="ListMax" value="<? echo $ListMax; ?>">
      <tr align="center"> 
        <td height="5" bgcolor="#999999"></td>
      </tr>	  
      <tr align="center"> 
        <td height="50" bgcolor="#EEEEEE"><br>
          ������ ���� <font color="#FF0000">������ �Ұ���</font>�մϴ�.</td>
      </tr>
      <tr> 
        <td height="30" align="center">���������Ͻðڽ��ϱ�?</td>
      </tr>
      <tr> 
        <td align="center" bgcolor="#EEEEEE" height="100%"><input type="button" value="�����ϱ�" onClick="javascript:sSubmit();" style="border-bottom: black 1px solid; border-left: black 1px solid; border-right: black 1px solid; border-top: black 1px solid; height:40;">&nbsp;<input type="button" value="����ϱ�" onClick="javascript:window.close();" style="border-bottom: black 1px solid; border-left: black 1px solid; border-right: black 1px solid; border-top: black 1px solid; height:40;"></td>
      </tr>
    </form>
  </table>  
<?
endif;
?>  
  </center>
</body>
</html>