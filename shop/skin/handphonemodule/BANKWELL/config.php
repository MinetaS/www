<?
include "../../../config/admin_info.php";
include "../../../config/cart_info.php";
// ###################################################################################
//
//   config.php
//
//   Copyright (c) 2004 BANKWELL Co. LTD.
//   All rights reserved.
//
// ###################################################################################
//
//                             ȯ�� ���� ���� ���
//
// ###################################################################################
//
//                  [ Mall�� ȯ�濡 �°� ������ �ʿ��� �κ� ]
//
//  1. LOG_FLAG     : Logȭ���� �������� ���θ� �����ϴ� Flag
//                    (1 : LOG_PATH�� �ش��ϴ� ���丮�� Logȭ�� ����)
//  3. LOG_PATH     : LOG_FLAG�� 1�ϰ�� ������ Logȭ���� ���丮 PATH
//  4. TABLE_NAME   : Table ��
//  5. SHOPCODE     : PG�翡�� �ο����� ������ȣ.
//  6. SERVER_URL   : PG�� Server URL
//  7. SERVER_FILE  : PG�� �ſ�ī�� ���� ��û FILE
//
//  * ����
//      SERVER_RUL�� ������ PG�翡�� ������ ���� ��û��
//      �ֱ��������� �����ؼ��� �ȵȴ�.
//
// ###################################################################################

$LOG_FLAG          = "0";					// 0: �αױ�� ���������� 1: �αױ�ϳ����
//$LOG_PATH        = "/temp/shoplogs/"; 	//�α� ���� ���丮 ������
// $ADULT_CD	   = "1";					//���������� ����� ���(Mobile���� �����)

// �ŷ����� �ڵ�(11:�ſ�ī�����, 30:�ڵ�������, 31:ARS����, 32:���� ����, 33:������ü)

if ($msgtype == "30"){ 
	$MESSAGETYPECODE   = "30";     			//�ŷ������ڵ�(30:�ڵ�������)
}else if ($msgtype == "31"){ 
	$MESSAGETYPECODE   = "31";     			//�ŷ������ڵ�(31:ARS����)
}else if ($msgtype == "32"){ 
	$MESSAGETYPECODE   = "32";     			//�ŷ������ڵ�(32:��������)
}else if ($msgtype == "33"){ 
	$MESSAGETYPECODE   = "33";     			//�ŷ������ڵ�(33:������ü)
}else{ 
	$MESSAGETYPECODE   = "11";     			//�ŷ������ڵ�(11:�ſ�ī�����)
}


$SHOPCODE          = "$CARD_ID";			//��ũ������ �ο����� ��������ȣ(shopcode)�� ��������
if ($ADULT_CD == "1" && $MESSAGETYPECODE == "30") {
	$SERVER_URL        = "https://pay.bankwell.co.kr/bankwell/jsp/";
	$SERVER_FILE       = "Ready.jsp";
} else {
	$SERVER_URL        = "https://pay.bankwell.co.kr/cgi-bin/CreditCard/";
	$SERVER_FILE       = "PGRE301.cgi";
}

?>