<?
//  ###################################################################################
// 
//    return.php
// 
//    Copyright (c) 2005  BANKWELL Co. LTD.
//    All rights reserved.
// 
//    PG�翡�� ���� ����� �޾� DB�� �����ϴ� ���
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
//  18. �׿� �Ʒ��� �ּ�ó�� ����ڰ� ������ ���ڸ� ������ �ִ�.
//  ###################################################################################

// test.html ���� ����ڰ� �ѱ䰪�ޱ�.
// �ֹ��ڸ� 	: $order_name
// ��ǰ�� 		: $order_bname
// �ݾ� 		: $order_amount
// �ֹ���Email 	: $order_email
// �ֹ�����ȭ 	: $order_tel
// �ֹ����ڵ��� : $order_hp
// �����θ� 	: $rev_name
// ������Email 	: $rev_email
// ��������ȭ 	: $rev_tel
// �������ڵ��� : $rev_hp
// ������ּ� 	: $zip1 . "-" . $zip2 . "  " . $addr
// �޼��� 		: $message
// ��������		: $MsgTypeCode

// return.php�������� 1���� �������δ� ���������� 
// http://������������/modules/return.php�� ȣ�� ������ ȭ�鿡 0000�̶߸� 1�������δ� ������.
// �̰��� �ּ��� ������ ������ ��� ����ŵ� �˴ϴ�.
include "../../../config/db_info.php";
include "../../../config/db_connect.php";
include "../../../config/admin_info.php";
include "../../../config/cart_info.php";
include "../../../function/const_array.php";
include "../../../function/kerrigancap_lib.php";

$sqlstr = "SELECT * FROM ${BUYER_TABLE_NAME} WHERE CODE_VALUE = '$order_no'";
$sqlqry = mysql_query($sqlstr);
$list = mysql_fetch_array($sqlqry);

$PayDate = time();

if ($ReplyCode == "0000"){		
	 $sqlstr = "UPDATE ${BUYER_TABLE_NAME} SET CardStatus = '$ReplyCode', Co_Now = '20' , PayDate = '$PayDate' WHERE CODE_VALUE = '$order_no'";
	 $sqlqry = mysql_query($sqlstr); 
	 echo "<script>
	 parent.location.replace('../../../${CART_MAIN_FILE_NAME}?query=step3&cod=$order_no');
	 </script>";	 
}else{
	 echo " <script>
	 parent.location.replace('../../../${CART_MAIN_FILE_NAME}?query=step2&cod=$order_no');
	 </script>";
}
?>