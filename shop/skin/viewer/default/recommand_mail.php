<?
include "../../../config/db_info.php";
include "../../../config/db_connect.php";
include "../../../config/admin_info.php";
include "../../../config/skin_info.php";
include "../../../config/shopDisplay_info.php";
include "../../../config/cart_info.php";
include "../../../function/const_array.php";
include "../../../function/kerrigancap_lib.php";

if($query == "sendmail"):// ���� ������ 

if(!$spamfree){// ���Ա� ��������
	js_alert_location("�߸��� ��η� ���̽��ϴ�.(���Ա� ����)","-1");
}elseif($spamfree < time() - 60*60 || $spamfree > time() - 5){
	js_alert_location("�߸��� ��η� ���̽��ϴ�.(���Ա� ����2)","-1");
} 

$Title = "{$Sender} ���� ��õ�����Դϴ�. -{$ADMIN_TITLE}-";
$Content = nl2br(stripslashes($Contents));
$Content2 = stripslashes(getSingleValue("select Content  from ${CONTENT_TABLE_NAME} where Code = 'MAIL_CODE_03'"));
// ��ǰ �κ��� �����ؾ���...
$Product_Contents = "<IFRAME SRC='${SITE_URL}/${MART_MAIN_FILE_NAME}?query=view&no=$no&code=$code' WIDTH=780 HEIGHT=700 FRAMEBORDER=0></IFRAME>";
$Mail_Contents = $Content . "<br>" . $Content2 . "<br>" . $Product_Contents;
$result = boolMailSend($Sender_Email , $Receiver_Email , $Title , $Mail_Contents );
if($result){
	js_alert_location("${Receiver}�Կ��� ���������� ������ ���� �Ͽ����ϴ�","close");
}else{
	js_alert_location("���� ������ ������ �߻� �Ͽ����ϴ�.\\n\\n �����ڿ��� �����Ͽ��ֽñ� �ٶ��ϴ�.","close");
}

endif;



?>
<html>
<head>
<title>��õ���Ϻ�����</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<style type="text/css">
<!--
BODY {
margin-left: 0px;margin-top: 0px;margin-right: 0px;	margin-bottom: 0px;	
scrollbar-3dlight-color:#CFD0CF;
scrollbar-arrow-color:#FFFFFF;
scrollbar-track-color:#F1F1F1;
scrollbar-darkshadow-color:#CFD0CF;
scrollbar-face-color:#CFD0CF;
scrollbar-highlight-color:#DFE0DF;
scrollbar-shadow-color:#FFFFFF;
background-color: #9eb91f;
}
body, table, tr, td, select, textarea, input{ 
	font-family: "����", "����ü";
	font-size: 9pt;
	line-height: 18px;
	color: #555555 
}
.input2
{color:666666; font-size:12px; font-family: "����"; border:1px solid #999999;}

.333333_b {
	font-family: "����";
	font-size: 12px;
	font-weight: bold;
	color: #333333;
}
.orange-b-02 {
	font-family: "����";
	font-size: 12px;
	font-weight: bold;
	color: #FF6600;
}
-->
</style>
</head>

<body>
<?	
	$sql = "SELECT * FROM $MALL_TABLE_NAME WHERE UID = '$no'";	
	$list = _mysql_fetch_array($sql);
	$list[Name] = stripslashes($list[Name]);
	$list[Model] = stripslashes($list[Model]);
	$list[Brand] = stripslashes($list[Brand]);
	$list[GetComp] = stripslashes($list[GetComp]);	
	$Picture = explode("|" , $list[Picture]);
?>
<script language="JavaScript">
<!--
function WRITE_FUNC(){
var f =  document.MailFrm;
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
	f.spamfree.value='<?=time()?>';
  f.submit();
	document.all.WRITE_FORM_TRANSFER_DIV.style.display = "";
	document.all.WRITE_FORM_DIV.style.display ="none";
}
//-->
</script>
<DIV id=WRITE_FORM_TRANSFER_DIV style="display:none"> <br>
  <br>
  <br>
  <br>
  <table cellpadding="3" cellspacing="1" bgcolor="#E7E3E7" align="center" width="308">
    <tr> 
      <td width="300" bgcolor="white" height="100" align="center"><b>������ �������Դϴ�.</b><br> 
        <br>
        ��ø� ��ٷ� �ֽñ� �ٶ��ϴ�.</td>
    </tr>
  </table>
</DIV>
<DIV id=WRITE_FORM_DIV style="display:block"> 
<table width="385" border="0" cellspacing="0" cellpadding="0">
<form name="MailFrm" method="POST" action="<? echo $_SERVER['PHP_SELF']; ?>" onsubmit='return checkForm(this);' enctype="multipart/form-data">						  
<input type="hidden" name="query" value="sendmail">
<input type="hidden" name="ADMIN_EMAIL" value="<? echo $ADMIN_EMAIL; ?>">
<input type="hidden" name="no" value="<? echo $no; ?>">
<input type="hidden" name="code" value="<? echo $code; ?>">     
<input type="hidden" name="spamfree" value="">
  <tr>
    <td><a href="javascript:self.close()"><img src="../../../<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/pop_t_03.gif" width="385" height="38" border="0"></a></td>
  </tr>
  <tr>
    <td align="center" bgcolor="9EB91F"><table width="367" border="0" cellpadding="10" cellspacing="1" bgcolor="788B1C">
      <tr>
        <td align="center" bgcolor="#FFFFFF"><table width="340" border="0" cellpadding="3" cellspacing="3" bgcolor="E4E4E4">
          <tr>
            <td height="120" align="center" bgcolor="#FFFFFF"><table width="320" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="120" align="center"><img src="../../../<? echo $STOCK_FOLDER_NAME; ?>/<? echo $Picture[0];?>" width="100" height="100"></td>
                <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="23" class="333333_b"><? echo $list[Name]; ?> <? if($list[Model]) echo "({$list[Model]})" ?></td>
                    </tr>
                  <tr>
                    <td height="23" class="orange-b-02">\<? echo number_format($list[Price]);?></td>
                    </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table>
          <br>
          <table width="340" border="0" cellpadding="3" cellspacing="1" bgcolor="dddddd">
            <tr>
              <td width="110" align="center" bgcolor="f2f2f2"> �����º� ����</td>
              <td width="210" bgcolor="#FFFFFF">
                <input name="Sender" type="text" class="input2" size="34" value = "<? echo $_COOKIE[MEMBER_NAME];?>" id="checkenable" title="�����º� ������ �Է��ϼ���"></td>
            </tr>
            <tr>
              <td align="center" bgcolor="f2f2f2">�����º� ���� </td>
              <td bgcolor="#FFFFFF"><input name="Sender_Email" type="text" class="input2" size="34" value = "<? echo $_COOKIE[MEMBER_EMAIL];?>" id="checkenable" title="�����º� �̸����� �Է��ϼ���"></td>
            </tr>
            <tr>
              <td align="center" bgcolor="f2f2f2">�޴º� ����</td>
              <td bgcolor="#FFFFFF"><input name="Receiver" type="text" class="input2" size="34" id="checkenable" title="�޴º� ������ �Է��ϼ���"></td>
            </tr>
            <tr>
              <td align="center" bgcolor="f2f2f2">�޴º� ���� </td>
              <td bgcolor="#FFFFFF"><input name="Receiver_Email" type="text" class="input2" size="34" id="checkenable" title="�޴º� �̸����� �Է����ּ���"></td>
            </tr>
            <tr>
              <td align="center" bgcolor="f2f2f2">����� �޼���</td>
              <td bgcolor="#FFFFFF"><textarea name="Contents" cols="32" rows="4" class="input2" id="checkenable" title="���ý� �޼����� �Է����ּ���"></textarea></td>
            </tr>
          </table>          
          <br>
          <table border="0" cellspacing="0" cellpadding="0">
            <tr align="center">
              <td width="79"><img src="../../../<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/btn_sendmail.gif" width="69" height="20" onClick = "WRITE_FUNC();" style = "cursor:hand"></td>
              <td width="53"><img src="../../../<? echo $SKIN_FOLDER_NAME; ?>/viewer/<?=$ViewerSkin?>/images/btn_cancle_03.gif" width="43" height="20" onClick = "self.close();" style = "cursor:hand"></td>
            </tr>
          </table><br></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="10" align="center" bgcolor="9EB91F"> </td>
  </tr></form>
</table>

</div>
</body>
</html>
