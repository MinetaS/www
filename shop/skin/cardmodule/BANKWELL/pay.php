<?php
/*
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/
include "../../../config/db_info.php";
include "../../../config/db_connect.php";
include "../../../config/admin_info.php";
include "../../../config/cart_info.php";
include "../../../function/const_array.php";
include "../../../function/kerrigancap_lib.php";

$sqlstr = "SELECT * FROM ${BUYER_TABLE_NAME} WHERE CODE_VALUE = '$cod'";
$sqlqry = mysql_query($sqlstr);
$sqlqry = mysql_query($sqlstr);
$olist = mysql_fetch_array($sqlqry);
$Zip1 = explode("-",$olist[Zip1]);
$Zip2 = explode("-",$olist[Zip2]);
$Sender_Tel = $olist[Sender_Tel]; 
$Sender_Hand = $olist[Sender_Hand];
$Re_Tel = $olist[Re_Tel]; 
$Re_Hand = $olist[Re_Hand];
$Sender_Company = $olist[Sender_Company];		
$Address1 = $olist[Address1];
$Address2 = $olist[Address2];
$Address3 = $olist[Address3];
$Address4 = $olist[Address4];
$How_Bank = $olist[How_Bank];
$Inputer = $olist[Inputer];
$Sender_Name = $olist[Sender_Name];	
$Sender_Email = $olist[Sender_Email];	
$Re_Email = $olist[Re_Email];
$Re_Name = $olist[Re_Name];
$Message = $olist[Message];

$Pay_Money = $olist[Pay_Money];
$Delivery_Money = $olist[Delivery_Money];
$How_Buy = $olist[How_Buy];


if($How_Buy == "card" ) $MsgTypeCode = "11" ; // ī�� ���� 
elseif($How_Buy == "hand") $MsgTypeCode = "30" ; // �ڵ��� ����
elseif($How_Buy == "autobank") $MsgTypeCode = "33" ; // �ڵ���ü
elseif($How_Buy == "ars") $MsgTypeCode = "31" ; // ARS

$ShopCode = "$CARD_ID";/* �׽�Ʈ ���� ���̵� : 2999199998 */
//$storeid  = "2999199998"; test only
$OrderNo="$cod"; /* �ֹ���ȣ */
$OrderName="$Sender_Name"; /* �ֹ��ڸ� */
$BrandName= urldecode($goods_name); /* ��ǰ�� */
$Amount=$Pay_Money; /* �����ݾ�(���ұݾ�) */
$OrderTelNo=$Sender_Tel;
$Email=$Sender_Email;
$deliverName=$Re_Name;
$OrderAddr=$Address3 . " " . $Address4;

if(!$Amount){
	/*
	echo "<script>alert('�����ݾ��� �������ϴ�.');</script>";
	exit;
	*/
}else if(!$OrderName){
	$OrderName = "None";
	/*
	echo "<script>alert('�����ڸ��� �ݾ��� �������ϴ�.');</script>";
	exit;
	*/
}else if(!$BrandName){
	$BrandName = "None";
	/*
	echo "<script>alert('��ǰ���� �������ϴ�.');</script>";
	exit;
	*/
}else if(!$OrderTelNo){
	$OrderTelNo = "None";
	/*
	echo "<script>alert('��ȭ��ȣ�� �������ϴ�.');</script>";
	exit;
	*/
}else if(!$Email){
	$Email = "None";
	/*
	echo "<script>alert('�̸����� �������ϴ�.');</script>";
	exit;
	*/
}else if(!$OrderAddr){
	$OrderAddr = "None";
	/*
	echo "<script>alert('�ּҰ� �������ϴ�.');</script>";
	exit;
	*/
}
?>
<!--#######################################################-->
<!--# 					test.html						  #-->
<!--#######################################################-->
<!--# 													  #-->
<!--# PG��� ���� �����͸� POST������� �Ѱ��ش�.		  #-->
<!--#													  #-->
<!--# �Ѱ��ִ� DATA�� PG�� �⺻�����Ϳ� ����ڰ� �����ؼ� #-->
<!--# �Ѱ��ټ� �ִ�.									  #-->
<!--#													  #-->
<!--# [ ��ũ������ �����ϴ� �⺻ ������� ] 			  #-->
<!--#		                                              #-->      
<!--# 1. OrderNo    : �ֹ�����(YYYYMMDD)                  #-->
<!--# 2. Amount     : �ֹ���ȣ�� �ش��ϴ� �ŷ��ݾ�        #-->
<!--# 3. OrderName  : �ֹ��ڼ���                          #-->
<!--# 4. OrderTelNo : �ֹ��� TelNo                        #-->
<!--# 5. BrandName  : ��ǰ��                              #-->
<!--# 6. OrderAddr  : ������ּ�                          #-->
<!--# 7. UserID     : User ID                             #-->
<!--# 8. Reserved1  : Filler(����)                        #-->
<!--# 9. Reserved2  : Filler(����)                        #-->
<!--# 10.RecognPage : ����ó���� Opener Page Refresh URL  #-->
<!--# 11.ErrorPage  : ����ó���� Opener Page Refresh URL  #--> 
<!--#													  #-->
<!--#######################################################-->
<script language="javascript">
/////////////////////��¥����ƾ (�մ��� ������...^^)/////////////////////////////////////
var now = new Date();
var nowyear  = now.getFullYear();
var nowmonth = now.getMonth() + 1;
var nowday   = now.getDate();
var nowhour  = now.getHours();
var nowmin   = now.getMinutes();
var nowsec   = now.getSeconds();
var randnum  = Math.floor(Math.random()*10);

if (("" + nowmonth).length == 1) { nowmonth = "0" + nowmonth; }
if (("" + nowday).length   == 1) { nowday   = "0" + nowday;   }
if (("" + nowhour).length  == 1) { nowhour  = "0" + nowhour;  }
if (("" + nowmin).length   == 1) { nowmin   = "0" + nowmin;   }
if (("" + nowsec).length   == 1) { nowsec   = "0" + nowsec;   }

var orderdate   = String(nowyear) + String(nowmonth) + String(nowday); //�ֹ���
var ordertimeis = String(nowhour) + String(nowmin) + String(nowsec);   //�ֹ��ð�
var ordernum    = orderdate + "_" +ordertimeis+randnum;				   //�ֹ���ȣ	
//////////////////////////////////////////////////////////////////////////////////////////

function goScript() {
	var doc = document.form1;
	doc.action="https://pay.bankwell.co.kr/cgi-bin/CreditCard/PGRE301.cgi"; //�������� ������
	doc.method="post";	
	window.open(form1.action, form1.target, "toolbar=no, directories=no,menubar=no,scrollbars=no,resizable=yes,status=yes,location=no,copyhistory=yes,width=446,height=530");
	// �������� �������� �������̶�� ǥ��.	
	location.href="<?=$SITE_URL?>/<? echo $SKIN_FOLDER_NAME; ?>/cardmodule/<?=$CARD_PACK?>/loading/loading.html";

	doc.OrderDate.value  = orderdate;
	doc.OrderTime.value  = ordertimeis;
	doc.SequenceNo.value = ordertimeis;
	doc.OrderNo.value    = ordernum;
	doc.submit();
}
</script>
<form name="form1" target="popup">
<input type="hidden" name="order_name" value="<? echo $deliverName; ?>"><!-- �ֹ��ڸ� -->
<input type="hidden" name="order_bname" value="<? echo $BrandName; ?>"><!-- ��ǰ�� -->
<input type="hidden" name="order_amount" value="<? echo $Amount; ?>"><!-- �ݾ� -->
<input type="hidden" name="order_email" value="<? echo $Email; ?>"><!-- �ֹ��� Email -->
<input type="hidden" name="order_tel" value="<? echo $OrderTelNo; ?>"><!-- �ֹ��� ��ȭ -->
<input type="hidden" name="order_hp" value="<? echo $order_hp; ?>"><!-- �ֹ��� �ڵ��� -->
<input type="hidden" name="rev_name" value="<? echo $deliverName; ?>"><!-- ������ �� -->
<input type="hidden" name="rev_email" value="<? echo $rev_email; ?>"><!-- ������ Email -->
<input type="hidden" name="rev_tel" value="<? echo $OrderTelNo; ?>"><!-- ������ ��ȭ -->
<input type="hidden" name="rev_hp" value="<? echo $rev_hp; ?>"><!-- ������ �ڵ��� -->
<input type="hidden" name="zip1" value="<? echo $zip1; ?>"><!-- ����� zip1 -->
<input type="hidden" name="zip2" value="<? echo $zip2; ?>"><!-- ����� zip2 -->
<input type="hidden" name="addr" value="<? echo $OrderAddr; ?>"><!-- ����� �ּ� -->
<input type="hidden" name="order_no" value="<? echo $OrderNo; ?>">
<input type="hidden" name="message" value="<? echo $message; ?>"><!-- �޼��� -->
<input type="hidden" name="MsgTypeCode" value="<? echo $MsgTypeCode; ?>"><!-- 11 : �ſ�ī�� , 30: �޴���, 31:ARS, 32:����, 33:������ü -->




<!-- �Ʒ��� ������ ���ؼ� �ʿ��� input �±��Դϴ�. ���� �����͸� ������ ������ ������ ä���ּ��� -->

<input type="hidden" name="ShopCode" value="<? echo $ShopCode; ?>"> 		<!-- ��ũ���� ���� ���� ShopCode�� �Է��ϼ��� -->
<input type="hidden" name="OrderDate"> 				<!-- �̰��� value�� ���� �ڹٽ�ũ��Ʈ���� ó���ϴ� �մ��� ������ �״�� ����ϸ�� -->
<input type="hidden" name="OrderTime"> 				<!-- �̰��� value�� ���� �ڹٽ�ũ��Ʈ���� ó���ϴ� �մ��� ������ �״�� ����ϸ�� -->
<input type="hidden" name="SequenceNo">				<!-- �̰��� value�� ���� �ڹٽ�ũ��Ʈ���� ó���ϴ� �մ��� ������ �״�� ����ϸ�� -->
<input type="hidden" name="OrderNo">  				<!-- �̰��� value�� ���� �ڹٽ�ũ��Ʈ���� ó���ϴ� �մ��� ������ �״�� ����ϸ��-->


<input type="hidden" name="Amount"     value="<? echo $Amount; ?>">												<!-- �ݾ�(�ʼ�) -->
<input type="hidden" name="OrderName"  value="<? echo $OrderName; ?>">												<!-- �ֹ��ڸ� -->
<input type="hidden" name="BrandName"  value="<? echo $BrandName; ?>">												<!-- ��ǰ��(�ʼ�) -->
<input type="hidden" name="OrderTelNo" value="<? echo $OrderTelNo; ?>">												<!-- �ֹ�����ȭ��ȣ -->
<input type="hidden" name="Email"      value="<? echo $Email; ?>">												<!-- �ֹ����̸���   -->
<input type="hidden" name="OrderAddr"  value="<? echo $OrderAddr; ?>">												<!-- �ֹ����ּ� -->
<input type="hidden" name="RecognPage" value="<?=$SITE_URL?>/<? echo $SKIN_FOLDER_NAME; ?>/cardmodule/<?=$CARD_PACK?>/result.php">  	<!-- ���� ������ �̵��� ������ ����(�ʼ�) -->
<input type="hidden" name="ErrorPage"  value="<?=$SITE_URL?>/<? echo $SKIN_FOLDER_NAME; ?>/cardmodule/<?=$CARD_PACK?>/result.php"> 	<!-- ���� ������ �̵��� ������ ����(�ʼ�) -->
</form>
<script language="JavaScript">
<!--
f = document.form1;
goScript();
//-->
</script>