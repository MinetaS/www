<?
/*
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/

include "../config/db_info.php";
include "../config/db_connect.php";
include "../config/admin_info.php";
include "../config/board_info.php";
include "../function/const_array.php";
include "../function/kerrigancap_lib.php";
include "../function/filter.php";

/* �ٿ�ε�� ȸ����� üũ  */
if(file_exists("./table/${GID}/${BID}/detail_config.php")) include  "./table/${GID}/${BID}/detail_config.php";

include "./func/GradePermission.php";
/* �ٿ� ī��Ʈ�� �ø��ϴ�. */

$BOARD_NAME="${DEFAULT_TABLE_NAME}_${GID}_${BID}";
$url = "./table/${GID}/${BID}/updir/${filename}";

download_filter($filename);

// ���̷�Ʈ�� ġ������� ��츦 ����
if(ereg("../" , $filename)) js_alert_location("�߸��� �����Դϴ�.","close");


$sql = "select ID from $BOARD_NAME where UID = '$UID'";
$list = _mysql_fetch_array($sql);

if($list[ID] != $_COOKIE[MEMBER_ID]){// �ڱ� �ڽ��� �ٿ�����ô� ī��Ʈ�� �ø��� �ʴ´�.
	mysql_query("UPDATE $BOARD_NAME SET DOWNCOUNT=DOWNCOUNT + 1 WHERE UID='$UID'");
}

// ����Ʈ ���� �κ� �߰�

if(isMember() && $PointEnable == "checked" ){
	$BOARD_TITLE_DESC = getTableName($GID , $BID);
	$Content = "${BOARD_TITLE_DESC} �ٿ�ε�� ����Ʈ �ο�" ; // ����Ʈ ����
	$GName = "System" ; // �ο���
	$Flag = "BD";//�ٿ�ε�� �÷���
	$presult = boolInsertPoint($BOARD_NAME , $_COOKIE[MEMBER_ID] , $GName , $DownPoint , $Flag ,$Content);
	//if(!$presult) js_alert("����Ʈ DB �۾� ����");
}

	$dn = "1"; 							// 1 �̸� �ٿ�, 0 �̸� �������� �ν��ϸ� ȭ�鿡 ���
	$dn_yn = ($dn) ? "attachment" : "inline";

	$bin_txt = "1"; 						// �ƽ�Ű�� r, ���̳ʸ��� rb
	$bin_txt = ($bin_txt) ? "r" : "rb";

	if(eregi("(MSIE 5.5|MSIE 6.0)", $HTTP_USER_AGENT)) 		// ������ ����
	{
		Header("Content-type: application/octet-stream");
		Header("Content-Length: ".filesize("$url"));   		// �� �κ��� �־� �־���� �ٿ�ε� ���� ���°� ǥ�� �˴ϴ�.
		Header("Content-Disposition: $dn_yn; filename=$filename");
		Header("Content-Transfer-Encoding: binary");
		Header("Pragma: no-cache");
		Header("Expires: 0");
	} else {
		Header("Content-type: file/unknown");
		Header("Content-Length: ".filesize("$url"));
		Header("Content-Disposition: $dn_yn; filename=$filename");
		Header("Content-Description: PHP Generated Data");
		Header("Pragma: no-cache");
		Header("Expires: 0");
	}
	if (is_file("$url"))
	{

	$fp = fopen("$url", "$bin_txt");
	if (!fpassthru($fp))  						// �������ϸ� ���̷��� print �� echo �Ǵ� while ���� �̿��� ��Ÿ ���� �̹����...
	fclose($fp);
	} else {
		js_alert("�ش� �����̳� ��ΰ� �������� �ʽ��ϴ�");

	}
?>
