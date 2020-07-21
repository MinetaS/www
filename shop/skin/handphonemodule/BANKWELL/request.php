<?
//  ###################################################################################
// 
//    request.php
// 
//    Copyright (c) 2004 BANKWELL Co. LTD.
//    All rights reserved.
// 
//  ###################################################################################
// 
//    PG��� �ſ�ī�� ���ο�û�� �䱸�Ѵ�.
// 
//  ###################################################################################
// 
//  [ request.php�� ȣ���Ҷ� ���ڷ� �Ѿ���� ������� ]
// 
//   1. OrderDate    : �ֹ�����(YYYYMMDD)
//   2. Amount       : �ֹ���ȣ�� �ش��ϴ� �ŷ��ݾ�
//   3. OrderName    : �ֹ��ڼ���
//   4. OrderTelNo   : �ֹ��� TelNo
//   5. BrandName    : ��ǰ��
//   6. OrderAddr    : ������ּ�
//   7. UserID       : User ID
//   8. Reserved1    : Filler(����)
//   9. Reserved2    : Filler(����)
// 
//       * ����
//          1. �ֹ���ȣ�� ���αݾ��� �ݵ��� �����Ͽ��� �Ѵ�.
//          2. ȣ�������� OpenWindow�������� �ϴ°��� ��Ģ���� �Ѵ�.
// 
//  ###################################################################################
include "./config.php";
include "./log.php";
include "./mysql_function.php";
include "./php_function.php";

//*************************************************************************
//  ShoppingMall�� ������û ȭ������ ���� POST������� ���޵Ǿ�� ���ڰ�����
//  �޾� �Է°��� ��ȿ�����θ� �˻��ϴ� ��ƾ
//*************************************************************************
Function RecvFromMerchant()
{  
	global $MESSAGETYPECODE, $SHOPCODE, $OrderDate, $OrderTime, $SequenceNo, $OrderNo, $Amount, $OrderName, $OrderTelNo;
	global $BrandName,	$OrderAddr,	$UserID,$Email, $Reserved1, $Reserved2, $RecognPage, $ErrorPage ;
	
	// �Ʒ��� ����� ����(test.php���� ����)
	global $msgtype, $zip1, $zip2, $addr1, $addr2, $deliverName, $deliverTelNo, $d_zip1, $d_zip2, $d_addr1, $d_addr2;
	
   //==========================================================================
   // Log Write (write log file) //�Ѿ�°��� ���� �α׸� �����
   //==========================================================================
   TraceLog ("Request", "���������Ѱܹ����� : ",
                  "OrderNo="      .  $OrderNo       . ", " .
                  "Amount="       .  $Amount        . ", " .
                  "OrderName="    .  $OrderName     . ", " .
                  "OrderTelNo="   .  $OrderTelNo    . ", " .
                  "BrandName="    .  $BrandName     . ", " .
                  "OrderAddr="    .  $OrderAddr     . ", " .
                  "UserID="       .  $UserID        . ", " .
                  "Reserved1="    .  $Reserved1     . ", " .
				  "MsgTypeCode=" .   $MESSAGETYPECODE  . ", " .
		          "ShopCode="    .   $SHOPCODE         . ", " .
                  "OrderDate="   .   $OrderDate		   . ", " .
                  "OrderTime="   .   $OrderTime		   . ", " .
                  "SequenceNo="  .   $SequenceNo	   . ", " .
                  "OrderNo="     .   $OrderNo		   . ", " .
                  "Amount="      .   $Amount		   . ", " .
                  "OrderName="   .   $OrderName		   . ", " .
                  "OrderTelNo="  .   $OrderTelNo	   . ", " .
                  "BrandName="   .   $BrandName		   . ", " .
                  "OrderAddr="   .   $OrderAddr		   . ", " .
                  "UserID="      .   $UserID	       . ", " .
                  "Email="		  .  $Email	       	   . ", " .
				  "Reserved1="   .   $Reserved1        . ", " .
                  "Reserved2="   .   $Reserved2        . ", " .
                  "RecognPage="  .   $RecognPage	   . ", " .
                  "ErrorPage="   .   $ErrorPage		   . ", " .
				  // for ���������
				  "msgtype="     .   $msgtype		   . ", " .
				  "zip1="        .   $zip1			   . ", " . 
				  "zip2="        .   $zip2			   . ", " . 
                  "addr1="       .   $addr1			   . ", " . 
				  "addr2="       .   $addr2			   . ", " .
				  "deliverName=" .   $deliverName	   . ", " .
				  "deliverTelNo=".   $deliverTelNo	   . ", " .
				  "d_zip1="	     .   $d_zip1		   . ", " .
				  "d_zip2="	     .   $d_zip2		   . ", " .
				  "d_addr1="	 .   $d_addr1		   . ", " .
				  "d_addr2="	 .   $d_addr2		   );
                 
	//==========================================================================
	// �Է����� �˻�
	//==========================================================================
	// �ŷ�(�ֹ�)��ȣ üũ ���� 1000��
	
	if (strlen($OrderNo) < 3 or strlen($OrderNo) > 100) {return "orderno";}						  // �ֹ���ȣüũ
	else If (strlen($Amount) < 3 Or strlen($Amount) > 9 Or !FncOnlyDigits($Amount)) {return "amount";} // �ŷ��ݾ�üũ
	else if (trim($OrderName)   == "") {return "ordername";}
	else if (trim($BrandName)   == "") {return "brandname";}
	else if (trim($OrderTelNo)  == "") {return "ordertelno";}
	else if (trim($deliverName) == "") {return "delivername";}
	else if (trim($OrderAddr)   == " "){return "orderaddr";}
	else{
		return "";
	}	
}

//*************************************************************************
//  Merchant�� ������û ȭ������ ���� �Է¹��� ������ �̿��Ͽ� PG����
//  ���� �Է�ȭ�� ���ڷ� ������ ������ �����ϴ� ��ƾ
//*************************************************************************
function MakeReqPacket()
{
	global $MESSAGETYPECODE, $SHOPCODE, $OrderDate, $OrderTime, $SequenceNo, $OrderNo, $Amount, $OrderName, $OrderTelNo;
	global $BrandName,	$OrderAddr,	$UserID,$Email, $Reserved1, $Reserved2, $RecognPage, $ErrorPage ;
	
	// �Ʒ��� ����� ����(test.php���� ����)
	global $msgtype, $zip1, $zip2, $addr1, $addr2, $deliverName, $deliverTelNo, $d_zip1, $d_zip2, $d_addr1, $d_addr2;

	$strAstric = chr(38);
	// Current System Date
	$OrderDate = f_Now_Date();
	// Current System Time
	$OrderTime = f_Now_Time();
	// �ŷ����ں� ����ũ�� ���� ����
	$SequenceNo = $OrderTime;

	// ��û���� ����
	$g_ReqPacket = "MsgTypeCode=" .   $MESSAGETYPECODE  .   $strAstric .
		           "ShopCode="    .   $SHOPCODE         .   $strAstric .
                   "OrderDate="   .   $OrderDate		.   $strAstric .
                   "OrderTime="   .   $OrderTime		.   $strAstric .
                   "SequenceNo="  .   $SequenceNo		.   $strAstric .
                   "OrderNo="     .   $OrderNo			.   $strAstric .
                   "Amount="      .   $Amount			.   $strAstric .
                   "OrderName="   .   $OrderName		.   $strAstric .
                   "OrderTelNo="  .   $OrderTelNo		.   $strAstric .
                   "BrandName="   .   $BrandName		.   $strAstric .
                   "OrderAddr="   .   $OrderAddr		.   $strAstric .
                   "UserID="      .   $UserID			.   $strAstric .
                   "Email="		  .   $Email			.   $strAstric .
				   "Reserved1="   .   $Reserved1        .   $strAstric .
                   "Reserved2="   .   $Reserved2        .   $strAstric .
                   "RecognPage="  .   $RecognPage		.   $strAstric .
                   "ErrorPage="   .   $ErrorPage		.   $strAstric .	
				   // for ���������
				   "msgtype="     .   $msgtype			.   $strAstric .
				   "zip1="        .   $zip1			    .   $strAstric . 
				   "zip2="        .   $zip2			    .   $strAstric . 
                   "addr1="       .   $addr1			.   $strAstric . 
				   "addr2="       .   $addr2			.   $strAstric .
				   "deliverName=" .   $deliverName		.   $strAstric .
				   "deliverTelNo=".   $deliverTelNo		.   $strAstric .
				   "d_zip1="	  .   $d_zip1			.   $strAstric .
				   "d_zip2="	  .   $d_zip2			.   $strAstric .
				   "d_addr1="	  .   $d_addr1			.   $strAstric .
				   "d_addr2="	  .   $d_addr2			.   $strAstric ;

	TraceLog ("Request", "BankWell�γѱ����� : ", "g_ReqPacket=" . $g_ReqPacket );
	return $g_ReqPacket;
}


   //*************************************************************************
   //  MAIN
   //*************************************************************************
	TraceLog ("Request", "Request ���� =======================================", "===> Start");

   $htmlHead = "<HTML><HEAD></HEAD><BODY><CENTER><BR><BR>";
   $htmlTail = "</CENTER></BODY></HTML>";

   // Merchant�κ��� ���޵� ���ڸ� �޾ƿ´�
   
	$bRetVal = RecvFromMerchant();

   if ($bRetVal <> ""){		
		if ($bRetVal == "orderno"){
			print "<script language='javascript'>alert('�ֹ���ȣ������ ��Ȯ���� �ʽ��ϴ�.'); history.back();</script>";
		}else if ($bRetVal == "brandname"){
			print "<script language='javascript'>alert('��ǰ���� �����ϴ�'); history.back();</script>";	
		}else if ($bRetVal == "amount"){
			print "<script language='javascript'>alert('�ݾ��� Ȯ�����ּ���'); history.back();</script>";
		}else if ($bRetVal == "ordername"){
			print "<script language='javascript'>alert('������ ������ �����ϴ�'); history.back();</script>";
		}else if ($bRetVal == "ordertelno"){
			print "<script language='javascript'>alert('������ ��ȭ��ȣ �����ϴ�'); history.back();</script>";
		}else if ($bRetVal == "delivername"){
			print "<script language='javascript'>alert('������ ������ �����ϴ�'); history.back();</script>";
		}else if ($bRetVal == "orderaddr"){
			print "<script language='javascript'>alert('������ �ּҰ� �����ϴ�'); history.back();</script>";	
		}
   }
   
   // ���� ��û ������ �����Ѵ�.
   $strTargetURL = $SERVER_URL . $SERVER_FILE . "?" . MakeReqPacket();

   TraceLog ("Request", "PG��γѱ�°� : ", $strTargetURL );
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=euc_kr">
<TITLE></TITLE>
</HEAD>
<BODY>
<CENTER>
<BR><BR><BR>
<table width="500" border="0" cellspacing="0" cellpadding="0" align="center" valign="center">
<tr>
	<td><img src="img/2.gif" width="500" height="34"></td></tr>
<tr>
	<td><img src="img/S.gif" width="500" height="31"></td></tr>
<tr>
	<td height="47"><br></td></tr>
<tr>
	<td><div align="center"><a href="javascript:history.go(-1);"><img src="img/3.gif" width="146" height="44" border="0"></a></div></td></tr>
<tr>
	<td><img src="img/4.gif" width="500" height="51"></td></tr>
<tr>
	<td>&nbsp;</td></tr>
</table></CENTER>
<SCRIPT LANGUAGE="JavaScript">
<!--
   time_id = setTimeout('TimeClosing()', 500);
//-->
</SCRIPT>
</BODY>
</HTML>
<SCRIPT LANGUAGE="JavaScript">
<!--
   var time_id;
   function TimeClosing()
   {
      clearTimeout(time_id);
      window.open("<?echo $strTargetURL ?>", "Connection", "toolbar=no, directories=no,menubar=no,scrollbars=no,resizable=yes,status=yes,location=no,copyhistory=yes,width=610,height=600");
   }
//-->
</SCRIPT>