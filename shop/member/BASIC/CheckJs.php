<?
$trigger = $_GET['trigger'];
$target = $_GET['target'];
$form = $_GET['form'];
$flag = $_GET['flag'];

include "../../config/db_info.php";
include "../../config/db_connect.php";
include "../../config/membercheck_info.php";
include "../../function/const_array.php";
include "../../function/kerrigancap_lib.php";

include "../../function/filter.php";
////////////////////////////////
// �Ķ���� ���͸�
////////////////////////////////
$trigger = filter($trigger);
$Jumin1 = filter($Jumin1);
$Jumin2 = filter($Jumin2);


header("Content-Type: application/x-javascript");


if($flag == "ID")://���̵� üũ
	$ID = trim($trigger);
	$DISABLEID = explode("," , $DISABLEID);

	if(!$ID) {
		echo "
		alert('���̵� �Է����ּ���');
		document." . $form . ".ID.focus();
		document." . $form . ".IDCheckFlag.value = 'N';
		";
		exit;
	}else if((strlen($ID) > 20) || (strlen($ID) < 4)) {
		echo "
		alert('���̵�� 4~20�� ������ �������� ȥ������ �����Ǿ�� �մϴ�.');
		document." . $form . ".ID.focus();
		document." . $form . ".IDCheckFlag.value = 'N';
		";
		exit;
	}else if(in_array($ID , $DISABLEID)){
		echo "
		alert('".$ID." �� ���Ұ� ID �Դϴ�.');
		document." . $form . ".ID.value = '';
		document." . $form . ".ID.focus();
		document." . $form . ".IDCheckFlag.value = 'N';
		";
		exit;
	}

	$cnt  = getSingleValue("SELECT count(UID) as cnt  FROM ${MEMBER_TABLE_NAME} WHERE ID='$ID'", $DB_CONNECT);

	if ( $cnt > 0  ) {
	echo "
		alert('".$ID." �� �̹� ������� ���̵��Դϴ�.');
		document." . $form . ".ID.value = '';
		document." . $form . ".ID.focus();
		document." . $form . ".IDCheckFlag.value = 'N';
		";
		exit;
	}else{
		echo "
		alert('��밡���� ���̵��Դϴ�.');
		document." . $form . ".IDCheckFlag.value = 'Y';
		";
		exit;
	}

exit;
endif;

if($flag == "NickName"):// �г��� üũ
$NICKANME = trim($trigger);
$DISABLEID = explode("," , $DISABLEID);
if(!$NICKANME) {
		echo "
		alert('�г����� �Է����ּ���');
		document." . $form . ".NickName.focus();
		document." . $form . ".NickCheckFlag.value = 'N';
		";
		exit;
	}else if((strlen($NICKANME) > 16) || (strlen($NICKANME) < 4)) {
		echo "
		alert('�г����� 4~16�� ������ �����Ǿ�� �մϴ�.');
		document." . $form . ".NickName.focus();
		document." . $form . ".NickCheckFlag.value = 'N';
		";
		exit;
	}else if(in_array($NICKANME , $DISABLEID)){
		echo "
		alert('".$NICKANME." �� ���Ұ� NICKANME �Դϴ�.');
		document." . $form . ".NickName.focus();
		document." . $form . ".NickCheckFlag.value = 'N';
		";
		exit;
	}

	$cnt  = getSingleValue("SELECT count(UID) as cnt  FROM ${MEMBER_TABLE_NAME} WHERE NickName='$NICKANME'", $DB_CONNECT);
	if ( $cnt > 0  ) {
	echo "
		alert('".$NICKANME." �� �̹� ������� �г��� �Դϴ�.');
		document." . $form . ".NickName.value = '';
		document." . $form . ".NickName.focus();
		document." . $form . ".NickCheckFlag.value = 'N';
		";
		exit;
	}else{

		echo "
		alert('��밡���� �г����Դϴ�.');
		document." . $form . ".NickCheckFlag.value = 'Y';
		";
		exit;
	}
exit;
endif;


if($flag == "JUMIN"):// �ֹε�� ��ȣ

$Jumin1 = trim($Jumin1);
$Jumin2 = trim($Jumin2);
if(!$Jumin1 || !$Jumin2) {
		echo "
		alert('�ֹι�ȣ�� �Է����ּ���');
		document." . $form . ".Jumin1.focus();
		document." . $form . ".JuminCheckFlag.value = 'N';
		";
		exit;
}

$cnt  = getSingleValue("SELECT count(UID) as cnt  FROM ${MEMBER_TABLE_NAME} WHERE Jumin1='$Jumin1' and Jumin2 = '$Jumin2' ", $DB_CONNECT);

if ( $cnt > 0  ) {
		echo "
		alert('�̹� ������� �ֹι�ȣ �Դϴ�');
		document." . $form . ".Jumin1.focus();
		document." . $form . ".JuminCheckFlag.value = 'N';
		";
		exit;
}else{
		echo "
		alert('��밡���� �ֹι�ȣ �Դϴ�.');
		document." . $form . ".JuminCheckFlag.value = 'Y';
		";
		exit;
}

exit;
endif;



if($flag == "EMAIL"):// �̸���

$MAIL = trim($trigger);
if(!$MAIL) {
		echo "
		alert('�̸����� �Է����ּ���');
		document." . $form . ".MailCheckFlag.value = 'N';
		";
		exit;
}

$cnt  = getSingleValue("SELECT count(UID) as cnt  FROM ${MEMBER_TABLE_NAME} WHERE Email = '$MAIL'", $DB_CONNECT);
if ( $cnt > 0  ) {
		echo "
		alert('�̹� ������� �̸����Դϴ�.');
		document." . $form . ".Email1_1.value= '';
		document." . $form . ".Email1_2.value= '';
		document." . $form . ".Email1_1.focus();
		document." . $form . ".MailCheckFlag.value = 'N';
		";
		exit;
}else{
		echo "
		alert('��밡���� �̸����Դϴ�.');
		document." . $form . ".MailCheckFlag.value = 'Y';
		";
		exit;
}

exit;
endif;


if($flag == "RECOMMAND"):// ��õ�� ���̵�

$RecID = trim($trigger);

if(!$RecID) {
		echo "
		alert('��õ�� ���̵� �Է����ּ���');
		document." . $form . ".RecID.focus();
		";
		exit;
}

$cnt  = getSingleValue("SELECT count(UID) as cnt  FROM ${MEMBER_TABLE_NAME} WHERE ID = '$RecID' ", $DB_CONNECT);
if ( $cnt ==  0  ) {
		echo "
		alert('�������� �ʴ� ��õ�� ���̵��Դϴ�.');
		document." . $form . ".RecID.value= '';
		document." . $form . ".RecID.focus();
		";
		exit;
}else{
		echo "alert('���밡�� ��õ�ξ��̵� �Դϴ�.');";
		exit;
}
exit;
endif;

?>
