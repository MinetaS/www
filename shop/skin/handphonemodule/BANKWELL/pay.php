<?php
/*
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/
include "../../../config/admin_info.php";
include "../../../config/cart_info.php";

$mid = "$CARD_ID";/* �׽�Ʈ ���� ���̵� : 2999199998 */
//$storeid  = "2999199998"; test only
$OrderNo="$cod"; /* �ֹ���ȣ */
$OrderName="$userName"; /* �ֹ��ڸ� */
$BrandName="$goods_name"; /* ��ǰ�� */
$amount="$TOTAL_MONEY"; /* �����ݾ� */
$TmpTel = split("\-", $UserTel1);
$OrderTelNo=$UserTel1;
$Email=$UserEmail;
$deliverName=$Re_Name;
$OrderAddr=$Re_Address;



//  #####################################################################

	include "php_function.php";	
	//�Ʒ��� �ֹ���ȣ�� �����ϴ°���, ����ũ�� ���̸� ����̵� �������.
	$g_OrderDate = f_Now_Date();
	$g_OrderTime = f_NOW_Time();	
	$orderNum = $g_OrderDate . "-" . $g_OrderTime . rand(10,99);
?>
<form name="payfrm" method="post" action="request.php">
<!--�ֹ���ȣ-->
<input type="hidden" name="OrderNo" value="<?= $OrderNo ?>">
<!--���缺���� �̵���������-->
<input type="hidden" name="RecognPage" value="<?=$MART_BASEDIR?>/skinwiz/cardmodule/<?=$PHONE_PACK?>/result.php">
<!--��������� �̵���������-->
<input type="hidden" name="ErrorPage"  value="<?=$MART_BASEDIR?>/skinwiz/cardmodule/<?=$PHONE_PACK?>/result.php">
<input type="hidden" name="OrderAddr" value="<? echo $OrderAddr;?>">
<!-- ������ �ּ� (���ּ�����) -->
<input type="hidden" name="msgtype" value="30"><!-- 11 : �ſ�ī��, 33 : ������ü, 30 : �ڵ��� --> 

<input type="hidden" name="BrandName" value="<?=$BrandName?>" ><!--  ��ǰ�� -->
<input type="hidden" name="Amount" value="<?=$amount?>"><!--  �������� -->
<input name="OrderName" type="hidden" value="<?=$OrderName?>"><!--  �� �� -->
<input name="Email" type="hidden" value="<?=$Email?>"><!-- E-mail  -->
<input name="OrderTelNo" type="hidden" value="<?=$OrderTelNo?>"><!-- ��ȭ��ȣ  -->
<input name="zip1" type="hidden">
<input name="zip2" type="hidden"><!-- �����ȣ  -->
<input name="deliverName" type="hidden" value="<?=$deliverName?>"><!--  �� �� -->
<input name="deliverTelNo" type="hidden"><!-- ��ȭ��ȣ  -->
<input name="d_zip1" type="hidden">
<input name="d_zip2" type="hidden"><!--  �����ȣ -->
<input name="d_addr1" type="hidden"><!--  �� �� -->
<input name="d_addr2" type="hidden"><!-- ���ּ�  -->
</form>
<script language="JavaScript">
<!--
f = document.payfrm;
f.submit();
//-->
</script>