<?
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
$Delivery_Money = $olist[Delivery_Money];// ��ۺ�
$How_Buy = $olist[How_Buy];
$Total_Money = $olist[Total_Money];// �� �ֹ����
/*
<option value="onlycard" >�ſ�ī�� (����)
<option value="onlyiche">������ü (����)
<option value="onlyhp">�ڵ������� (����)
<option value="onlyvirtual">������� (����)
*/

if($How_Buy == "card" ) $MsgTypeCode = "onlycard" ; // ī�� ����(����) 
elseif($How_Buy == "hand") $MsgTypeCode = "onlyhp" ; // �ڵ��� ����
elseif($How_Buy == "autobank") $MsgTypeCode = "onlyiche" ; // �ڵ���ü
elseif($How_Buy == "escrow") $MsgTypeCode = "onlyvirtual" ; // ����ũ��


$MallUrl=$SITE_URL;//  ����URL
$StoreId = $CARD_ID; // �������̵� (�ô�����Ʈ���� �߱޹��� ���̵��Դϴ�.)
$OrdNo=$cod; /* �ֹ���ȣ */
$OrdNm=$Sender_Name; /* �ֹ��ڸ� */
$ProdNm=urldecode($goods_name); /* ��ǰ�� */
$Amt=$Pay_Money; /* �����ݾ� */
$StoreNm = $ADMIN_TITLE_E; #���� ������(�ݵ�� �������� ���ּ��� �������)

if(isMember()) $txtCustNo = "$_COOKIE[MEMBER_ID]";
else $txtCustNo = "GUEST";

$OrderContact=$Sender_Tel; // �ֹ��� ��ȭ��ȣ
$email=$Sender_Email;// �̸���
$returnurl = $SITE_URL."/$SKIN_FOLDER_NAME/cardmodule/ALLTHEGATE/result.php"; // ����URL
$deliverName=$Re_Name; // ������
$deliverPhone=$Re_Tel; // ������ ��ȭ��ȣ

$OrderAddr=$Address1 . " " . $Address2; // �ֹ��� �ּ�
$OrderRecAddr=$Address3 . " " . $Address4; // ������ �ּ�

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
<script language=javascript src="http://www.allthegate.com/plugin/AGSWallet.js"></script>
<script language=javascript>
<!--
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
// �ô�����Ʈ �÷����� ��ġ�� Ȯ���մϴ�.
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

StartSmartUpdate();

function Pay(form)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// MakePayMessage() �� ȣ��Ǹ� �ô�����Ʈ �÷������� ȭ�鿡 ��Ÿ���� Hidden �ʵ�
	// �� ���ϰ����� ä������ �˴ϴ�.
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	if(form.Flag.value == "enable")
	{
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////
		// �Էµ� ����Ÿ�� ��ȿ���� �˻��մϴ�.
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		if(Check_Common(form) == true)
		{
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////
			// �ô�����Ʈ �÷����� ��ġ�� �ùٸ��� �Ǿ����� Ȯ���մϴ�.
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////
			
			if(document.AGSPay == null || document.AGSPay.object == null)
			{
				alert("�÷����� ��ġ �� �ٽ� �õ� �Ͻʽÿ�.");
			}
			else
			{
				//////////////////////////////////////////////////////////////////////////////////////////////////////////////
				// �ô�����Ʈ �÷����� �������� �������� �����ϱ� JavaScript �ڵ带 ����ϰ� �ֽ��ϴ�.
				// ���������� �°� JavaScript �ڵ带 �����Ͽ� ����Ͻʽÿ�.
				//
				// [1] �Ϲ�/������ ��������
				// [2] �Ϲݰ����� �Һΰ�����
				// [3] �����ڰ����� �Һΰ����� ����
				// [4] ��������
				//////////////////////////////////////////////////////////////////////////////////////////////////////////////
				
				//////////////////////////////////////////////////////////////////////////////////////////////////////////////
				// [1] �Ϲ�/������ �������θ� �����մϴ�.
				//
				// �Һ��Ǹ��� ��� �����ڰ� ���ڼ����Ḧ �δ��ϴ� ���� �⺻�Դϴ�. �׷���,
				// ������ �ô�����Ʈ���� ���� ����� ���ؼ� �Һ����ڸ� ���������� �δ��� �� �ֽ��ϴ�.
				// �̰�� �����ڴ� ������ �Һΰŷ��� �����մϴ�.
				//
				// ����)
				// 	(1) �Ϲݰ����� ����� ���
				// 	form.DeviId.value = "9000400001";
				//
				// 	(2) �����ڰ����� ����� ���
				// 	form.DeviId.value = "9000400002";
				//
				// 	(3) ���� ���� �ݾ��� 100,000�� �̸��� ��� �Ϲ��Һη� 100,000�� �̻��� ��� �������Һη� ����� ���
				// 	if(parseInt(form.Amt.value) < 100000)
				//		form.DeviId.value = "9000400001";
				// 	else
				//		form.DeviId.value = "9000400002";
				//////////////////////////////////////////////////////////////////////////////////////////////////////////////
				
				form.DeviId.value = "9000400001";
				
				//////////////////////////////////////////////////////////////////////////////////////////////////////////////
				// [2] �Ϲ� �ҺαⰣ�� �����մϴ�.
				// 
				// �Ϲ� �ҺαⰣ�� 2 ~ 12�������� �����մϴ�.
				// 0:�Ͻú�, 2:2����, 3:3����, ... , 12:12����
				// 
				// ����)
				// 	(1) �ҺαⰣ�� �ϽúҸ� �����ϵ��� ����� ���
				// 	form.QuotaInf.value = "0";
				//
				// 	(2) �ҺαⰣ�� �Ͻú� ~ 12�������� ����� ���
				//		form.QuotaInf.value = "0:3:4:5:6:7:8:9:10:11:12";
				//
				// 	(3) �����ݾ��� ���������ȿ� ���� ��쿡�� �Һΰ� �����ϰ� �� ���
				// 	if((parseInt(form.Amt.value) >= 100000) || (parseInt(form.Amt.value) <= 200000))
				// 		form.QuotaInf.value = "0:2:3:4:5:6:7:8:9:10:11:12";
				// 	else
				// 		form.QuotaInf.value = "0";
				//////////////////////////////////////////////////////////////////////////////////////////////////////////////
				
				//�����ݾ��� 5���� �̸����� �Һΰ����� ��û�Ұ�� ��������
				if(parseInt(form.Amt.value) < 50000)
					form.QuotaInf.value = "0";
				else
					form.QuotaInf.value = "0:2:3:4:5:6:7:8:9:10:11:12";
				
				//////////////////////////////////////////////////////////////////////////////////////////////////////////////
				// [3] ������ �ҺαⰣ�� �����մϴ�.
				// (�Ϲݰ����� ��쿡�� �� ������ ������� �ʽ��ϴ�.)
				// 
				// ������ �ҺαⰣ�� 2 ~ 12�������� �����ϸ�, 
				// �ô�����Ʈ���� ������ �Һ� ������������ �����ؾ� �մϴ�.
				// 
				// 100:BC
				// 200:����
				// 300:��ȯ
				// 400:�Ｚ
				// 500:����
				// 600:����
				// 800:����
				// 900:�Ե�
				// 
				// ����)
				// 	(1) ��� �Һΰŷ��� �����ڷ� �ϰ� ���������� ALL�� ����
				// 	form.NointInf.value = "ALL";
				//
				// 	(2) ����ī�� Ư���������� �����ڸ� �ϰ� ������� ����(2:3:4:5:6����)
				// 	form.NointInf.value = "200-2:3:4:5:6";
				//
				// 	(3) ��ȯī�� Ư���������� �����ڸ� �ϰ� ������� ����(2:3:4:5:6����)
				// 	form.NointInf.value = "300-2:3:4:5:6";
				//
				// 	(4) ����,��ȯī�� Ư���������� �����ڸ� �ϰ� ������� ����(2:3:4:5:6����)
				// 	form.NointInf.value = "200-2:3:4:5:6,300-2:3:4:5:6";
				//	
				//		(5) ������ �ҺαⰣ ������ ���� ���� ��쿡�� NONE�� ����
				//		form.NointInf.value = "NONE";
				//
				//		(6) ��ī��� Ư���������� �����ڸ� �ϰ� �������(2:3:6����)
				//		form.NointInf.value = "100-2:3:6,200-2:3:6,300-2:3:6,400-2:3:6,500-2:3:6,600-2:3:6,800-2:3:6,900-2:3:6
				//
				//////////////////////////////////////////////////////////////////////////////////////////////////////////////
				
				if(form.DeviId.value == "9000400002")
					form.NointInf.value = "ALL";
				   
				if(MakePayMessage(form) == true)
				{
					Disable_Flag(form);
					
					var openwin = window.open("AGS_progress.html","popup","width=300,height=160"); //"����ó����"�̶�� �˾�â���� �κ�
					
					form.submit();
				}
				else
				{
					alert("���ҿ� �����Ͽ����ϴ�.");// ��ҽ� �̵������� �����κ�
				}
			}
		}
	}
}

function Enable_Flag(form)
{
        form.Flag.value = "enable"
}

function Disable_Flag(form)
{
        form.Flag.value = "disable"
}

function Check_Common(form) 
{
	if(form.StoreId.value == "")
	{
		alert("�������̵� �Է��Ͻʽÿ�.");
		return false;
	}
	else if(form.StoreNm.value == "")
	{
		alert("�������� �Է��Ͻʽÿ�.");
		return false;
	}
	else if(form.OrdNo.value == "")
	{
		alert("�ֹ���ȣ�� �Է��Ͻʽÿ�.");
		return false;
	}
	else if(form.ProdNm.value == "")
	{
		alert("��ǰ���� �Է��Ͻʽÿ�.");
		return false;
	}
	else if(form.Amt.value == "")
	{
		alert("�ݾ��� �Է��Ͻʽÿ�.");
		return false;
	}
	else if(form.MallUrl.value == "")
	{
		alert("����URL�� �Է��Ͻʽÿ�.");
		return false;
	}
	
	return true;
}

-->
</script>
</head>
<!-- ����) onload �̺�Ʈ���� �Ʒ��� ���� javascript �Լ��� ȣ������ ���ʽÿ�. -->
<!-- onload="javascript:Enable_Flag(frmAGS_pay);Pay(frmAGS_pay);" -->
<body topmargin=0 leftmargin=0 rightmargin=0 bottommargin=0 onLoad="javascript:Enable_Flag(frmAGS_pay);Pay(frmAGS_pay);">
<!-- <body topmargin=0 leftmargin=0 rightmargin=0 bottommargin=0 onload="javascript:Pay(frmAGS_pay);">  -->
<form name=frmAGS_pay method=post action=AGS_pay_ing.php>
<!--
1) �� ���ҿ�û �������� ������ �°� �����ϰ� �����Ͽ� ����Ͻʽÿ�.<br>
2) �� ������������ �ô�����Ʈ �÷������� �ٿ�ε��Ͽ� ��ġ�ϵ��� �Ǿ� �ֽ��ϴ�. �ٿ�ε��Ŀ�  <font color=rde>���Ȱ��â�� �߸� Ȯ�� ��ư("��")�� �����Ͽ�</font> �÷������� ��ġ�� �ֽʽÿ�. ���� ��ġ�� �����Ͽ��� ��� �������� <a href="http://www.allthegate.com/plugin/AGSPayPluginV10.exe">�ٿ�ε�</a>�Ͽ� ��ġ�� �ֽʽÿ�.<br>
3) ���ҿ�û�� ���� �ʿ��� ������ ��� �Է��� '���ҿ�û'��ư�� Ŭ���Ͻø� �ô�����Ʈ �÷������� �����մϴ�.<br>
4) �ſ�ī�常 ���� �� <font color=blue>�������ҹ��</font>�� <font color=blue><b>�ſ�ī��(����)</b></font>���� ������ �ֽʽÿ�.<br>
5) DB �۾��� �Ͻ� ��� <font color=blue>������������(rSuccYn)</font>�� Ȯ���Ŀ� �۾��Ͽ� �ֽʽÿ�.<br>
6) �ڵ��� ���� ���� �ô�����Ʈ���� �߱޹���[�ڵ����������̵�,��й�ȣ,��ǰ�ڵ�,��ǰŸ��]�� �Է��Ͽ� �ֽʽÿ�.
-->
<input type=hidden name=Job value="<?=$MsgTypeCode?>">
<!-- ������ü,�ڵ��������� ������� �ʴ� ������ ���ҹ���� �� �ſ�ī��(����)���� �����Ͻñ� �ٶ��ϴ�. -->
<!-- ������ü�� ����ϵ��� ���� <input type=hidden name=Job value="onlyiche"> -->
<!-- �ڵ��������� ����ϵ��� ���� <input type=hidden name=Job value="onlyhp"> -->
<!--<select name=Job style=width:120px>
<option value="" selected>�����Ͻʽÿ�.
<option value="card">�ſ�ī��
<option value="iche">������ü
<option value="hp">�ڵ�������
<option value="virtual" >������� ��������߰� 
<option value="onlycard" >�ſ�ī�� (����)
<option value="onlyiche">������ü (����)
<option value="onlyhp">�ڵ������� (����)
<option value="onlyvirtual">������� (����)
</select>-->

<input type=hidden style=width:100px name=TempJob maxlength=20 value=""><!--  ���ҹ�� �����Է� ��) card:iche-->
<!--�������̵� �ǰŷ� ��ȯ�Ŀ��� �߱޹��� ���̵�� �ٲٽñ� �ٶ��ϴ�.-->
<input type=hidden style=width:100px name=StoreId maxlength=20 value="<?=$StoreId?>">
<!--  �� �������̵� (20) -->
<input type=hidden style=width:300px name=StoreNm value="<?=$StoreNm?>">
<!--  �� ������ -->
<input type=hidden style=width:100px name=OrdNo maxlength=40 value="<?=$OrdNo?>">
<!--  �� �ֹ���ȣ (40) -->
<input type=hidden style=width:100px name=ProdCode maxlength=10 value="">
<!--  ��ǰ�ڵ� (10) -->
<input type=hidden style=width:300px name=ProdNm maxlength=300 value="<?=$ProdNm?>">
<!-- �� ��ǰ�� (300)  -->
<input type=hidden style=width:100px name=Amt maxlength=12 value="<?=$Amt?>">
<!--  �� �ݾ� (12) ��) �ݾ� �޸�(,)�ԷºҰ�-->
<input type=hidden style=width:100px name=UserId maxlength=20 value="<?=$txtCustNo?>">
<!--  ȸ�����̵� (20) -->
<input type=hidden style=width:100px name=OrdNm maxlength=40 value="<?=$OrdNm?>">
<!--  �ֹ��ڸ� (40) -->
<input type=hidden style=width:100px name=OrdPhone maxlength=21 value="<?=$OrderContact?>">
<!--  �ֹ��ڿ���ó (21) -->
<input type=hidden style=width:300px name=UserEmail maxlength=50 value="<?=$email?>">
<!--  �ֹ����̸��� (50) -->
<!-- ��������߰� -->
<input type=hidden style=width:300px name=OrdAddr maxlength=100 value="<?=$OrderAddr?>">
<!--  �ֹ����ּ� (100) -->
<input type=hidden style=width:100px name=RcpNm maxlength=40 value="<?=$deliverName?>">
<!--  �����ڸ� (40) -->
<input type=hidden style=width:100px name=RcpPhone maxlength=21 value="<?=$deliverPhone?>">
<!-- �����ڿ���ó (21)  -->
<input type=hidden style=width:300px name=DlvAddr maxlength=100 value="<?=$OrderRecAddr?>">
<!--  ������ּ� (100) -->
<input type=hidden style=width:300px name=Remark maxlength=350 value="<?=$Message?>">
<!-- ��Ÿ�䱸���� (350)  -->


<!-- ����) ����Ȩ�������ּҸ� �ݵ�� �Է��� �ֽʽÿ� -->
<!-- ���Է½� Ư��ī��� �ſ�ī������� �̷����� ���� �� �ֽ��ϴ� -->
<input type=hidden style=width:300px name=MallUrl value="<?=$MallUrl?>">
<!-- �� ����URL  ��) http://www.abc.com-->

<!-- ������� �������� ��/��� �뺸�� ���� �ʼ� �Է� ���� �Դϴ�. -->
<input type=hidden style=width:300px name=MallPage value="/mall/AGS_VirAcctResult.php">
<!--  �� ��������뺸������ ��) /mall/AGS_VirAcctResult.php-->

<!-- CP���̵� �ǰŷ� ��ȯ�Ŀ��� �߱޹����� CPID�� �����Ͽ� �ֽñ� �ٶ��ϴ�. -->
<input type=hidden style=width:100px name=HP_ID maxlength=10 value="">
<!--  CP���̵� (10) ��) �ڵ�������-->
<!-- CP��й�ȣ�� �ǰŷ� ��ȯ�Ŀ��� �߱޹����� ��й�ȣ�� �����Ͽ� �ֽñ� �ٶ��ϴ�. -->
<input type=hidden style=width:100px name=HP_PWD maxlength=10 value="">
<!--  CP��й�ȣ (10)��) �ڵ������� -->

<!-- SUB-CPID�� �߱޹����� ������ �Է��Ͽ� �ֽñ� �ٶ��ϴ�. -->
<input type=hidden style=width:100px name=HP_SUBID maxlength=10 value="">
<!--  SUB-CP���̵� (10) ��) �ڵ�������-->

<!-- �Ǹ��ϴ� ��ǰ�� ������(������)�� ��� = 1, �ǹ�(��ǰ)�� ��� = 2 -->
<!-- ��ǰ������ �ǰŷ� ��ȯ�Ŀ��� �߱޹����� ��ǰ������ �����Ͽ� �ֽñ� �ٶ��ϴ�. -->
<input type="hidden" name="HP_UNITType" value="2">
<!--  ��ǰ���� ������:1 �ǹ�:2 ��) �ڵ�������-->

<!--
<a href="javascript:Pay(frmAGS_pay);"><img src="button.gif" border="0"></a>
-->

<!-- JavaScript ���� ���� �����ϴ� Hidden �ʵ�  !!������ �Ͻðų� �������� ���ʽÿ�-->
<input type=hidden name=DeviId value="">
<input type=hidden name=QuotaInf value="0">
<input type=hidden name=NointInf value="NONE">
<!-- JavaScript ���� ���� �����ϴ� Hidden �ʵ� -->

<!-- �ô�����Ʈ �÷����ο��� ����ϴ� Hidden �ʵ�  !!������ �Ͻðų� �������� ���ʽÿ�-->
<input type=hidden name=AuthYn value="">
<input type=hidden name=Flag value="">
<input type=hidden name=AuthTy value="">
<input type=hidden name=SubTy value="">
<input type=hidden name=CardNo value="">
<input type=hidden name=ExpMon value="">
<input type=hidden name=ExpYear value="">
<input type=hidden name=Instmt value="">
<input type=hidden name=Passwd value="">
<input type=hidden name=SocId value="">
<input type=hidden name=partial_mm value="">
<input type=hidden name=noIntMonth value="">
<input type=hidden name=ZuminCode value=""> <!-- ��������߰� -->
<input type=hidden name=KVP_RESERVED1 value="">
<input type=hidden name=KVP_RESERVED2 value="">
<input type=hidden name=KVP_RESERVED3 value="">
<input type=hidden name=KVP_CURRENCY value="">
<input type=hidden name=KVP_CARDCODE value="">
<input type=hidden name=KVP_SESSIONKEY value="">
<input type=hidden name=KVP_ENCDATA value="">
<input type=hidden name=KVP_CONAME value="">
<input type=hidden name=KVP_NOINT value="">
<input type=hidden name=KVP_QUOTA value="">
<input type=hidden name=MPI_CAVV value="">
<input type=hidden name=MPI_ECI value="">
<input type=hidden name=MPI_MD64 value="">
<input type=hidden name=ICHE_OUTBANKNAME value="">
<input type=hidden name=ICHE_OUTACCTNO value="">
<input type=hidden name=ICHE_OUTBANKMASTER value="">
<input type=hidden name=ICHE_AMOUNT value="">
<input type=hidden name=HP_SERVERINFO value="">
<input type=hidden name=HP_HANDPHONE value="">
<input type=hidden name=HP_COMPANY value="">
<input type=hidden name=HP_IDEN value="">
<input type=hidden name=HP_IPADDR value="">
<input type=hidden name=VIRTUAL_CENTERCD value=""><!-- ��������߰� -->
<input type=hidden name=VIRTUAL_DEPODT value=""><!-- ��������߰� -->
<input type=hidden name=VIRTUAL_NO value=""><!-- ��������߰� -->
<!-- �ô�����Ʈ �÷����ο��� ����ϴ� Hidden �ʵ� -->
<table align = center cellspacing=1 bordercolordark=white width="450" bgcolor=#c0c0c0 bordercolorlight=#dddddd border=0 class="s1" cellpadding="1">
  <tbody>
    <tr>
      <td height=25 align=center bgcolor='00A6A8' colspan="2"><b><font color="white"><span style="font-size:10pt;">[�ֹ��� ����]</span></b></td>
    </tr>
    <tr  bgcolor=white height=25>
      <td width=96 bgcolor='E5F6F6'><span style="font-size:9pt;"><font color='00A6b7'>&nbsp;&nbsp;�ֹ���</span> </td>
      <td width="347"><span style="font-size:9pt;">&nbsp;
        <?=$Sender_Name?>
        </span></td>
    </tr>
		<!--
    <tr  bgcolor=white height=25>
      <td width=96 bgcolor='E5F6F6'><span style="font-size:9pt;"><font color='00A6b7'>&nbsp;&nbsp;�Ա���</span> </td>
      <td width="347"><span style="font-size:9pt;">&nbsp;
        <?=$Inputer?>
        </span></td>
    </tr>    
		-->
    <tr  bgcolor=white height=25>
      <td width=96 bgcolor='E5F6F6'><span style="font-size:9pt;"><font color='00A6b7'>&nbsp;&nbsp;E-mail</span></td>
      <td width="347"><span style="font-size:9pt;">&nbsp;
        <?=$Sender_Email?>
        </span></td>
    </tr>
    <tr  bgcolor=white height=25>
      <td width=96 bgcolor='E5F6F6'><span style="font-size:9pt;"><font color='00A6b7'>&nbsp;&nbsp;��ȭ��ȣ</span></td>
      <td width="347"><span style="font-size:9pt;">&nbsp;
        <?=$Sender_Tel ?>
        </span></td>
    </tr>
    <tr  bgcolor=white height=25>
      <td width=96 bgcolor='E5F6F6'><span style="font-size:9pt;"><font color='00A6b7'>&nbsp;&nbsp;�޴���</span></td>
      <td width="347"><span style="font-size:9pt;">&nbsp;
        <?=$Sender_Hand?>
        </span></td>
    </tr>
    <tr  bgcolor=white height=25>
      <td width=96 bgcolor='E5F6F6'><span style="font-size:9pt;"><font color='00A6b7'>&nbsp;&nbsp;������</span></td>
      <td width="347"><span style="font-size:9pt;color:red;">&nbsp;
        <?=$Re_Name?>
        </span></td>
    </tr>
    <tr  bgcolor=white height=25>
      <td width=96 bgcolor='E5F6F6'><span style="font-size:9pt;"><font color='00A6b7'>&nbsp;&nbsp;�����ȣ</span></td>
      <td width="347"><span style="font-size:9pt;">&nbsp;
        <?=$olist[Zip2]?>
        </span> </td>
    </tr>
    <tr  bgcolor=white height=25>
      <td width=96 bgcolor='E5F6F6'><span style="font-size:9pt;"><font color='00A6b7'>&nbsp;&nbsp;������ּ�</span></td>
      <td width="347"><span style="font-size:9pt;">&nbsp;
        <?=$Address3 . " " . $Address4?>
        </span></td>
    </tr>
    <tr  bgcolor=white height=25>
      <td width=96 bgcolor='E5F6F6'><span style="font-size:9pt;"><font color='00A6b7'>&nbsp;&nbsp;�������ȭ</span> </td>
      <td width="347"><span style="font-size:9pt;">&nbsp;
        <?=$Re_Tel?>
        </span></td>
    </tr>
		
    <tr  bgcolor=white height=25>
      <td width=96 bgcolor='E5F6F6'><span style="font-size:9pt;"><font color='00A6b7'>&nbsp;&nbsp;��������</span></td>
      <td width="347"><span style="font-size:9pt;">&nbsp;
        <?=date("Y-m-d",$olist[WishDate])?>
        &nbsp;</span></td>
    </tr>
		
    <tr  bgcolor=white height=25>
      <td width=96 bgcolor='E5F6F6'><span style="font-size:9pt;"><font color='00A6b7'>&nbsp;&nbsp;��۾ȳ���</span></td>
      <td width="347"><span style="font-size:9pt;">&nbsp;
        <?=$Message?>
        &nbsp;</span></td>
    </tr>   
		<tr  bgcolor=#B9C2CC>
      <td height=25 align=center bgcolor='00A6A8' colspan="2"><b><font color="white"><span style="font-size:10pt;">[��������]</span></b></td>
    </tr>
		<tr  bgcolor=white height=25>
      <td width=96 bgcolor='E5F6F6'><span style="font-size:9pt;"><font color='00A6b7'>&nbsp;&nbsp;���ֹ��ݾ�</span> </td>
      <td width="347"><strong>&nbsp;<?=number_format($Total_Money)?> ��</strong></td>
    </tr>
    <tr  bgcolor=white height=25>
      <td width=96 bgcolor='E5F6F6'><span style="font-size:9pt;"><font color='00A6b7'>&nbsp;&nbsp;�Ѱ����ݾ�</span> </td>
      <td width="347"><font color="703EAE"><strong>&nbsp;<?=number_format($Amt)?>

                              ��</strong></font></td>
    </tr>
  </tbody>
</table><p>
<div align = center>
<input type="button" value="���ҿ�û" onClick="javascript:Pay(frmAGS_pay);"  style="background: #ffffff; border : 1 solid : #cccccc;  border-color: #cccccc; FONT-SIZE: 9pt;FONT-FAMILY: '����';cursor:hand";>&nbsp;&nbsp;<input type = "button" value = "�� �� �� ��"  onclick = "opener.location.replace('<?=$SITE_URL?>/<?=$CART_MAIN_FILE_NAME?>?query=step2&check=<?=$How_Buy?>&cod=<?=$cod?>'); self.close();"  style="background: #ffffff; border : 1 solid : #cccccc;  border-color: #cccccc; FONT-SIZE: 9pt;FONT-FAMILY: '����';cursor:hand";>
</div>
</form>

