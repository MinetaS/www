<?
//  ###################################################################################
// 
//    return.php
// 
//    Copyright (c) 2004  BANKWELL Co. LTD.
//    All rights reserved.
// 
//  ###################################################################################
//  ###################################################################################
// 
//   PG�翡�� ���� ����� �޾� DB�� �����ϴ� ���
// 
//  ###################################################################################
// 
//  [ return.php�� ȣ���Ҷ� ���ڷ� �Ѿ���� ������� ]
// 
//   1. ShopCode     : �ش� ���θ� ��ȣ(PG�翡�� �ο����� �ڵ�)
//   2. ReplyCode    : �����ڵ�� '0000'�̸� ���� �׿ܴ� ����ó���Ѵ�.
//   3. ScrMessage   : ����޽���
//   4. OrderDate    : �ŷ���û����(YYYYMMDD)
//   5. OrderTime    : �ŷ���û�ð�(HHMMSS)
//   6. SequenceNo   : �ŷ���û��ȣ
//   7. OrderNo      : �ֹ���ȣ
//   8. Installment  : �Һΰ���
//   9. AcquireCode  : ���Ի��ڵ�
//  10. AcquireName  : ���Ի��̸�
//  11. ApprovalNo   : ���ι�ȣ
//  12. ApprovalTime : �����Ͻ�(YYYYMMDDHHMM000)
//  13. CardIssuer   : ī��߱޻��̸�
//  14. tran_date    : PG���� �ŷ�����(YYYYMMDD)
//  15. tran_seq     : PG���� �ŷ���ȣ
//  16. Reserved1    : FILLER
//  17. Reserved1    : FILLER
// 
//    * Mall������ �ش� �������� �����Ͽ� ����� DB�� ������ �� �ֵ��� �Ѵ�.
// 
//  ###################################################################################
//	�̰��� HTML �����̳� Java Script ������ ���� ������ !!!
include "./config.php";
include "./log.php";
//include "./mysql_function.php";
include "./php_function.php";

	TraceLog ("Request", "FromPG  : ",
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


 include "../../../config/db_info.php";
 include "../../../config/db_connect.php";
	$sqlstr = "select * from wizBuyers where CODE_VALUE = '$OrderNo'";
	$sqlqry = mysql_query($sqlstr);
	$list = mysql_fetch_array($sqlqry);
	// �Ʒ� if ���� ������ ���̽� ������Ʈ�� �Ͻø� �˴ϴ�(���缺����).
	if ($ReplyCode == "0000"){		
		 $sqlstr = "update wizBuyers set CardStatus = '', Co_Now = 'C' where CODE_VALUE = '$OrderNo'";
		 $sqlqry = mysql_query($sqlstr); 
		 echo "<script>
		 parent.location.replace('../../../wizbag.php?query=step4&check=$list[Total_Money]&cod=$list[CODE_VALUE]&userName=$list[Sender_Name]&userTel=$list[Sender_Tel]&UserEmail=$list[Sender_Email]&cardmoney=$list[Card_Money]');
		 </script>";
	}else{
		 echo " <script>
		 parent.location.replace('../../../wizbag.php?query=step3&check=$list[How_Buy]&cod=$list[CODE_VALUE]');
		 </script>";
	}
?>