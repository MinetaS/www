<?php
//<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
/**********************************************************************************************
*
* ���ϸ� : AGS_pay_result.php
* �ۼ����� : 2005/03
*
* ���ϰ�������� ó���մϴ�.
*
* Copyright 2004-2005 AEGISHYOSUNG.Co.,Ltd. All rights reserved.
*
**********************************************************************************************/

$AuthTy = trim( $_POST["AuthTy"] );							//��������
$SubTy = trim( $_POST["SubTy"] );							//�����������
$rStoreId = trim( $_POST["rStoreId"] );						//��üID
$rBusiCd = trim( $_POST["rBusiCd"] );						//�����ڵ�
$rOrdNo = trim( $_POST["rOrdNo"] );							//�ֹ���ȣ
$rProdNm = trim( $_POST["rProdNm"] );						//��ǰ��
$rApprNo = trim( $_POST["rApprNo"] );						//���ι�ȣ
$rAmt = trim( $_POST["rAmt"] );								//�ŷ��ݾ�
$rSuccYn = trim( $_POST["rSuccYn"] );						//��������
$rResMsg = trim( $_POST["rResMsg"] );						//���л���
$rApprTm = trim( $_POST["rApprTm"] );						//���νð�
$rCardCd = trim( $_POST["rCardCd"] );						//ī����ڵ�
$rCardNm = trim( $_POST["rCardNm"] );						//ī����
$rMembNo = trim( $_POST["rMembNo"] );						//��������ȣ
$rAquiCd = trim( $_POST["rAquiCd"] );						//���Ի��ڵ�
$rAquiNm = trim( $_POST["rAquiNm"] );						//���Ի��
$rBillNo = trim( $_POST["rBillNo"] );						//��ǥ��ȣ
$rDealNo = trim( $_POST["rDealNo"] );						//�ŷ�������ȣ
$ICHE_OUTBANKNAME = trim( $_POST["ICHE_OUTBANKNAME"] );		//��ü���������
$ICHE_OUTACCTNO = trim( $_POST["ICHE_OUTACCTNO"] );			//��ü���¹�ȣ
$ICHE_OUTBANKMASTER = trim( $_POST["ICHE_OUTBANKMASTER"] );	//��ü���¼�����
$ICHE_AMOUNT = trim( $_POST["ICHE_AMOUNT"] );				//��ü�ݾ�
$rHP_TID = trim( $_POST["rHP_TID"] );						//�ڵ�������TID
$rHP_DATE = trim( $_POST["rHP_DATE"] );						//�ڵ���������¥
$rHP_HANDPHONE = trim( $_POST["rHP_HANDPHONE"] );			//�ڵ��������ڵ�����ȣ
$rHP_COMPANY = trim( $_POST["rHP_COMPANY"] );				//�ڵ���������Ż��(SKT,KTF,LGT)
$rVirNo = trim( $_POST["rVirNo"] );				            //������¹�ȣ ��������߰�
$VIRTUAL_CENTERCD = trim( $_POST["VIRTUAL_CENTERCD"] );				            //������¹�ȣ ��������߰�

?>
<script language=javascript> // "����ó����" �˾�â �ݱ�
<!--
var openwin = window.open("AGS_progress.html","popup","width=300,height=160");
openwin.close();
-->
</script>
<?
include "../../../config/db_info.php";
include "../../../config/db_connect.php";
include "../../../config/admin_info.php";
include "../../../config/cart_info.php";
include "../../../function/const_array.php";
include "../../../function/kerrigancap_lib.php";


$sqlstr = "SELECT * FROM ${BUYER_TABLE_NAME} WHERE CODE_VALUE = '$rOrdNo'";
$sqlqry = mysql_query($sqlstr);
$list = mysql_fetch_array($sqlqry);
$PayDate = time();
	
if($rSuccYn == "y"){
		 $sqlstr = "UPDATE ${BUYER_TABLE_NAME} SET CardStatus = '', Co_Now = '20' , PayDate = '$PayDate' WHERE CODE_VALUE = '$rOrdNo'";
		 $sqlqry = mysql_query($sqlstr); 
   echo "<script>
   	 alert('������ ���������� �̷�� �����ϴ�.');
	 parent.location.replace('../../../${CART_MAIN_FILE_NAME}?query=step3&cod=$rOrdNo');
	 </script>";	 
}else{
	 echo " <script>
	 alert('������ ���� �Ͽ����ϴ�.');
	 parent.location.replace('../../../${CART_MAIN_FILE_NAME}?query=step2&cod=$rOrdNo');
	 </script>";
}
exit;
?>
<html>
<head>
<title>�ô�����Ʈ</title>
<style type="text/css">
<!--
body { font-family:"����"; font-size:9pt; color:#000000; font-weight:normal; letter-spacing:0pt; line-height:180%; }
td { font-family:"����"; font-size:9pt; color:#000000; font-weight:normal; letter-spacing:0pt; line-height:180%; }
.clsright { padding-right:10px; text-align:right; }
.clsleft { padding-left:10px; text-align:left; }
-->
</style>
<script language=javascript> // "����ó����" �˾�â �ݱ�
<!--
var openwin = window.open("AGS_progress.html","popup","width=300,height=160");
openwin.close();
-->
</script>
<script language=javascript>
<!--
//////////////////////////////////////////////////////
// ������ ����� ī������ÿ��� ����Ͻ� �� �ֽ��ϴ�.
//////////////////////////////////////////////////////
function show_receipt() 
{
	if("<?=$rSuccYn?>"== "y" && "<?=$AuthTy?>"=="card")
	{
		url="http://www.allthegate.com/customer/receiptLast3.jsp"
		url=url+"?sRetailer_id="+sRetailer_id.value;
		url=url+"&approve="+approve.value;
		url=url+"&send_no="+send_no.value;
		
		window.open(url, "window","toolbar=no,location=no,directories=no,status=,menubar=no,scrollbars=no,resizable=no,width=470,height=700,top=0,left=150");
	}
	else
	{
		alert("�ش��ϴ� ���������� �����ϴ�");
	}
}
-->
</script>
</head>
<body topmargin=0 leftmargin=0 rightmargin=0 bottommargin=0>
<table border=0 width=100% height=100% cellpadding=0 cellspacing=0>
	<tr>
		<td align=center>
		<table width=400 border=0 cellpadding=0 cellspacing=0>
			<tr>
				<td><hr></td>
			</tr>
			<tr>
				<td class=clsleft>���� ���</td>
			</tr>
			<tr>
				<td><hr></td>
			</tr>
			<tr>
				<td>
				<table width=400 border=0 cellpadding=0 cellspacing=0>
					<tr>
						<td class=clsright width=150>�������� : </td>
						<td class=clsleft width=250>
<?php

if($AuthTy == "card")
{
	if($SubTy == "isp")
	{
		echo "�ſ�ī����� - ��������(ISP)";
	}	
	else if($SubTy == "visa3d")
	{
		echo "�ſ�ī����� - �Ƚ�Ŭ��";
	}
	else if($SubTy == "normal")
	{
		echo "�ſ�ī����� - �Ϲݰ���";
	}
	
}
else if($AuthTy == "iche")
{
	echo "������ü";
}
else if($AuthTy == "hp")
{
	echo "�ڵ�������";
}else if($AuthTy == "virtual")
{
	echo "������°���";
}

?>
						</td>
					</tr>
					<tr>
						<td class=clsright>�������̵� : </td>
						<td class=clsleft><?=$rStoreId?></td>
					</tr>
					<tr>
						<td class=clsright>�����ڵ� : </td>
						<td class=clsleft><?=$rBusiCd?></td>
					</tr>
					<tr>
						<td class=clsright>�ֹ���ȣ : </td>
						<td class=clsleft><?=$rOrdNo?></td>
					</tr>
					<tr>
						<td class=clsright>��ǰ�� : </td>
						<td class=clsleft><?=$rProdNm?></td>
					</tr>
					<tr>
						<td class=clsright>���ι�ȣ : </td>
						<td class=clsleft><?=$rApprNo?></td>
					</tr>
					<tr>
						<td class=clsright>���αݾ� : </td>
						<td class=clsleft><?=$rAmt?></td>
					</tr>
					<tr>
						<td class=clsright>�������� : </td>
						<td class=clsleft><?=$rSuccYn?></td>
					</tr>
					<tr>
						<td class=clsright>ó���޼��� : </td>
						<td class=clsleft><?=$rResMsg?></td>
					</tr>
					<tr>
						<td class=clsright>���νð� : </td>
						<td class=clsleft><?=$rApprTm?></td>
					</tr>
					<tr>
						<td class=clsright>ī����ڵ� : </td>
						<td class=clsleft><?=$rCardCd?></td>
					</tr>
					<tr>
						<td class=clsright>ī���� : </td>
						<td class=clsleft><?=$rCardNm?></td>
					</tr>
					<tr>
						<td class=clsright>���Ի��ڵ� : </td>
						<td class=clsleft><?=$rAquiCd?></td>
					</tr>
					<tr>
						<td class=clsright>���Ի�� : </td>
						<td class=clsleft><?=$rAquiNm?></td>
					</tr>
					<tr>
						<td class=clsright>��������ȣ : </td>
						<td class=clsleft><?=$rMembNo?></td>
					</tr>
					<tr>
						<td class=clsright>��ǥ��ȣ : </td>
						<td class=clsleft><?=$rBillNo?></td>
					</tr>
					<tr>
						<td class=clsright>�ŷ�������ȣ : </td>
						<td class=clsleft><?=$rDealNo?></td>
					</tr>
					<tr>
						<td class=clsright>��ü��������� : </td>
						<td class=clsleft><?=$ICHE_OUTBANKNAME?></td>
					</tr>
					<tr>
						<td class=clsright>��ü���¹�ȣ : </td>
						<td class=clsleft><?=$ICHE_OUTACCTNO?></td>
					</tr>
					<tr>
						<td class=clsright>��ü���¼����� : </td>
						<td class=clsleft><?=$ICHE_OUTBANKMASTER?></td>
					</tr>
					<tr>
						<td class=clsright>��ü�ݾ� : </td>
						<td class=clsleft><?=$ICHE_AMOUNT?></td>
					</tr>
					<tr>
						<td class=clsright>�ڵ�������TID : </td>
						<td class=clsleft><?=$rHP_TID?></td>
					</tr>
					<tr>
						<td class=clsright>�ڵ���������¥ : </td>
						<td class=clsleft><?=$rHP_DATE?></td>
					</tr>
					<tr>
						<td class=clsright>�ڵ��������ڵ�����ȣ : </td>
						<td class=clsleft><?=$rHP_HANDPHONE?></td>
					</tr>
					<tr>
						<td class=clsright>�ڵ���������Ż�� : </td>
						<td class=clsleft><?=$rHP_COMPANY?></td>
					</tr>
                     <tr><!-- ��������߰� -->
						<td class=clsright>�Աݰ��¹�ȣ : </td>
						<td class=clsleft><?=$rVirNo?></td>
					</tr>
                    <tr><!-- ��������߰� -->
						<td class=clsright>�Ա����� : </td>
						<td class=clsleft><?=$VIRTUAL_CENTERCD?></td>
					</tr>
                    <tr><!-- ��������߰� -->
						<td class=clsright>�����ָ� : </td>
						<td class=clsleft>(��)������ȿ��</td>
					</tr>
                    <tr>
						<td class=clsright>������ :</td>
						<!--��������������ؼ������ִ°�-------------------->
						<input type=hidden name=sRetailer_id value="<?=$rStoreId?>"><!--�������̵�-->
						<input type=hidden name=approve value="<?=$rApprNo?>"><!---���ι�ȣ-->
						<input type=hidden name=send_no value="<?=$rOrdNo?>"><!--�ֹ���ȣ-->
						<!--��������������ؼ������ִ°�-------------------->
						<td class=clsleft><input type="button" value="������" onClick="javascript:show_receipt();"></td>
					<tr>
						<td colspan=2>&nbsp;</td>
					</tr>
					<tr>
						<td align=center colspan=2>ī�� �̿������ ����ó�� <font color=red>������ȿ��(��)</font>�� ǥ��˴ϴ�.</td>
					</tr>
					
				</table>
				</td>
			</tr>
			<tr>
				<td><hr></td>
			</tr>
			<tr>
				<td class=clsleft>Copyright 2004-2005 AEGISHYOSUNG.Co.,Ltd. All rights reserved.</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</body>
</html>
