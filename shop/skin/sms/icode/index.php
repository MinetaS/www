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

include "../../../config/db_info.php";
include "../../../config/db_connect.php";
include "../../../config/skin_info.php";
include "../../../config/admin_info.php";
include "../../../config/sms_info.php";
include "../../../function/const_array.php";
include "../../../function/kerrigancap_lib.php";


if(!$USE_SMS) js_alert_location("SMS�� ������� �ʽ��ϴ�.","close");
//���� 10�� �̻��̿������� �׽�Ʈ 	
	
if(!$year) $year=date("Y");
if(!$month) $month=date("m");
if(!$day) $day=date("d");  
$today=mktime(0,0,0,$month,$day,$year);
$next_day=mktime(0,0,0,$month,$day+1,$year); 

$sum = getSingleValue("select count(*) from ${SMS_TABLE_NAME} WHERE ID = '$_COOKIE[MEMBER_ID]' AND WDate >= $today AND WDate <= $next_day");	

if($sum > 10){
	js_alert_location("ȸ������ �Ϸ� ���۷�(10��)�� �ʰ� �ϼ̽��ϴ�..","close");
			
}
	


if($action == "send"){

include "./class.sms.php";

if(!$SMS_SERVER_IP && !$SMS_ID && !$SMS_PASSWORD && !$SMS_SERVER_PORT) js_alert_location("ȯ�漳���� �̷�� ���� �ʾҽ��ϴ�.\\n�����ڸ�� SMS�������� ȯ���� �����Ͽ� �ֽʽÿ�.","close");

$sms_server	= $SMS_SERVER_IP;	## SMS ���� 
$sms_id		= $SMS_ID;				## icode ���̵�
$sms_pw		= $SMS_PASSWORD;				## icode �н�����
$port		= $SMS_SERVER_PORT;				## ������ : 7296, ������ : 7295

$SMS	= new SMS;
$SMS->SMS_con($sms_server,$sms_id,$sms_pw,$port);

$tran_phone	= "$addcall";		# ���Ź�ȣ
$tran_callback = "$callback";		/* ȸ�Ź�ȣ "-" ���� ���� �ֽʽÿ� */
$tran_msg = "$MSG_TXT";
$wdate = time();

$SMS->Add($tran_phone,"$tran_callback","$sms_id","$tran_msg","");
//////////////////////////////////////////////////////////////////////
$result = $SMS->Send();
if ($result) {
	//echo "SMS ������ �����߽��ϴ�.<br>";
	$success = $fail = 0;
	foreach($SMS->Result as $result) {
		list($phone,$code)=explode(":",$result);
		if ($code=="Error") {
			js_alert_location("sms ���� �߻�","close");			
			$fail++;
		} else {
$MSG_TXT = addslashes($MSG_TXT);
$callback = addslashes($callback);
$addcall = addslashes($addcall); 

$result = mysql_query("insert into ${SMS_TABLE_NAME} (ID , FromPhone  , ToPhone  , Content  , WDate , SiteKey ) values (
													  '$_COOKIE[MEMBER_ID]', '$addcall' , '$callback' , '$MSG_TXT' , $wdate , '$SiteKey')");
	
if($result) js_alert_location("sms ������ �Ϸ� �Ǿ����ϴ�..","close");
		
		$success++;
		
		}
	}
	//echo $success."���� ���������� ".$fail."���� ������ ���߽��ϴ�.<br>";
	$SMS->Init(); // �����ϰ� �ִ� ������� ����ϴ�.

	}
}

?>


<LINK REL=stylesheet TYPE="text/css" HREF="css/css1.css">
<script language="javascript" src="js/msg.js"></script>
<script>
	window.resizeTo(200,530);
</script>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="156" border="0" cellpadding="0" cellspacing="0" align = center>
<!-- Action �ȿ� ����Ͻô� ����� ���ϸ��� �����ּ��� -->
  <form name=MsgForm method=post  onSubmit="return varcheck()">
  <input type="hidden" name = "action" value = "send">
    <tr> 
      <td height="227" align="center" valign="top" background="sms_images/msg_bg.gif">
		<!-- ����ȭ�� -->
		<table width="100" border="0" cellspacing="0" cellpadding="0" class="td1">
		  <tr> 
			<td><br><br><br><br><br><br>
			  <textarea name="MSG_TXT" onChange="ChkLen()" onKeyUp="ChkLen()" style="border-color:#000000; border:solid 0; height: 74px; background-color: #FF9B42; width: 100px; FONT-SIZE: 9pt; overflow:hidden" rows=6 cols=22></textarea>
			</td>
		  </tr>
		  <tr> 
			<td align="right" height=20> 
			  <input type="text" name="MSG_TXT_CNT" size="2" style="border-color:#000000; border:solid 0; height: 14px; width: 18px; background-color: #FF9B42; FONT-SIZE: 9pt;" maxlength="2" value="80" readonly >/80 byte&nbsp;&nbsp;</td>
		  </tr>
		</table>
		<!-- ����ȭ�� -->	  
	  </td>
    </tr>
    <tr>
      <td height="7" align="center" valign="top" background="sms_images/num_bg.gif"><img src="sms_images/num_top.gif" width="156" height="7"></td>
    </tr>
    <tr> 
      <td height="133" align="center" valign="top" background="sms_images/num_bg.gif"> 
        <table width="110" border="0" cellspacing="0" cellpadding="0" class="td1">
          <tr> 
            <td height="20"><b>�޴»����ȣ</b></td>
          </tr>
          <tr> 
            <td><input type="text" name=addcall size=11 maxlength=11 style='border-color:#000000; border:solid 1; FONT-SIZE: 9pt; width:110px; height:18px;' value = "<? echo str_replace("-" , "" , $addcall) ; ?>"></td>
          </tr>
          <tr> 
            <td height="20"><b>�����»����ȣ</b></td>
          </tr>
          <tr> 
            <td><input type="text" name="callback" size="14" maxlength="14" STYLE='border-color:#000000; FONT-SIZE: 9pt; border:solid 1; width:110px; height:18px;' value=""></td>
          </tr>
         <tr> 
            <td><input checked name="SendFlag" type=radio value="0" onClick="CWCheck(this.form)">
              ������� <br> <input name="SendFlag" type=radio value="1" onClick="CWCheck(this.form)">
              ��������</td>
          </tr>
        </table>
        <div ID="sDest"  STYLE="display:none"> 
          <table width="110" border="0" cellspacing="0" cellpadding="0" class="td1">
            <tr> 
              <td height="25"><b>����ð�</b></td>
            </tr>
            <tr> 
              <td align=center> <input type="text" name="R_YEAR" size="3" maxlength="4" value=""  STYLE='border-color:#000000; border:solid 1; FONT-SIZE: 9pt; height:18px;'>
                �� 
                <input type="text" name="R_MONTH"  maxlength="2" value=""   STYLE='border-color:#000000; border:solid 1; FONT-SIZE: 9pt;  width:15px; height:18px;'>
                ��<br> <input type="text" name="R_DAY"  maxlength="2" value=""   STYLE='border-color:#000000; border:solid 1; FONT-SIZE: 9pt; width:15px; height:18px;'>
                �� 
                <input type="text" name="R_HOUR"  maxlength="2" value=""   STYLE='border-color:#000000; border:solid 1; FONT-SIZE: 9pt; width:15px; height:18px;'>
                �� 
                <input type="text" name="R_MIN"  maxlength="2" value=""   STYLE='border-color:#000000; border:solid 1; FONT-SIZE: 9pt; width:15px; height:18px;'>
                ��</td>
            </tr>
          </table>
        </div></td>
    </tr>
    <tr> 
      <td height="7"><img src="sms_images/num_bottom.gif" width="156" height="7"></td>
    </tr>
    <tr> 
      <td height="78" align="center" valign="top" background="sms_images/btn_bg.gif"><table width="85" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="5"></td>
            <td width="34"></td>
          </tr>
          <tr>
            <td><input type="image" src="sms_images/btn_send.gif" width="44" height="22" border="0"></td>
            <td><a href="javascript:self.close();"><img src="sms_images/btn_cancel.gif" width="34" height="22" border="0"></a></td>
          </tr>
        </table></td>
    </tr>
  </form>
</table>
</body>
</html>

