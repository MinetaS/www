<?

header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include "./config/db_info.php";
include "./config/db_connect.php";
include "./config/admin_info.php";
include "./config/skin_info.php";
include "./config/shopDisplay_info.php";
include "./config/cart_info.php";
include "./function/const_array.php";
include "./function/kerrigancap_lib.php";

include "./function/filter.php";
////////////////////////////////
// �Ķ���� ���͸�
////////////////////////////////
$UID = filter($UID);
$PID = filter($PID);
$CURRENT_PAGE = filter($CURRENT_PAGE);
$pmode = filter($pmode);
$html = filter($html);


if($query == "INQ"):

/* ���� ���ε� ����
unset($UPDIR);
for($i=0; $i<sizeof($file); $i++){
	if($file[$i]!="none" && $file[$i]){
    	if (file_exists("./${STOCK_FOLDER_NAME}/$file_name[$i]")) {
	    $file_name[$i] = time()."_$file_name[$i]";
    	}
	    if(!move_uploaded_file($file[$i], "./${STOCK_FOLDER_NAME}/$file_name[$i]")) {
    	echo "���� ���ε忡 ���� �Ͽ����ϴ�.";
	    exit;}
	$UPDIR .=$file_name[$i]."|";
	}
}
*/
/* ���� ���ε� �� */
$WDate=time();
$Tel="${Tel1}-${Tel2}-${Tel3}";
$Hand="${Hand1}-${Hand2}-${Hand3}";
$Fax="${Fax1}-${Fax2}-${Fax3}";
$ZIP="${Zip1_1}-${Zip1_2}";
$Email = $Email1_1."@".$Email1_2;
$sql = "INSERT INTO $INQUIRY_TABLE_NAME (IID,Company,Name,Jumin,Tel,Fax,ZIP,Address1,Address2,City,Province,Country,Hand,Email,Contents,Option1,Option2,Option3,Option4,Option5,Option6,Option7,Option8,Option9,UPDIR,WDate,SiteKey)
VALUES('$IID','$Company','$Name','$Jumin','$Tel','$Fax','$ZIP','$Address1','$Address2','$City','$Province','$Country','$Hand','$Email','$Contents','$Option1','$Option2','$Option3','$Option4','$Option5','$Option6','$Option7','$Option8','$Option9','$UPDIR','$WDate' , '$SiteKey')";
$result=mysql_query($sql) or die(mysql_error());

if($result){
	js_alert_location("������ ���ǿ� ���� �帳�ϴ�.","./");
}else{
	js_alert_location("DB �۾��� ������ �߻��Ͽ����ϴ�.","-1");
}

endif;



if($pmode == "poll" && !${"PollCookie".$UID} ) {

// ��ǥ �Ⱓ�� ���� �Ǿ�����
$Sqlqry = mysql_query("SELECT * FROM ${POLL_TABLE_NAME} WHERE UID='$UID'");
$List = mysql_fetch_array($Sqlqry);
$Contents = explode("|",$List[Contents]);
$Vote = explode("|",$List[Vote]);

for($i = 0; $i < sizeof($Vote); $i++) {
	if($poll_qna-1 == $i) $Vote[$i] += 1;
	$vote_ok .= $Vote[$i]."|";
}

$Point = $List [Point];


// ��õ ���̺� ���� ���� ������..�Է°� ����Ʈ �ο��� �ϰ� ���� �Ұ��� ƨ�ܳ���.

$result = boolRecommandExistID(${POLL_TABLE_NAME} , $UID , $_COOKIE[MEMBER_ID], 'GOOD', 'POLL');
if(!$result)  {
		// �׸� ��ǥ�� 1 ����

	$poll_sql = "UPDATE ${POLL_TABLE_NAME} SET Vote='$vote_ok' where UID='$UID'";
	mysql_query($poll_sql);
	// ��ǥ �ѻ������ ��Ű ����(������ �ð���ŭ)
	setcookie("PollCookie{$UID}","1",$List[ToDay],"/");

	boolInsertRecommand(${POLL_TABLE_NAME} , $UID , $_COOKIE[MEMBER_ID], 'GOOD', 'POLL');
	boolInsertPoint(${POLL_TABLE_NAME} , $_COOKIE[MEMBER_ID] , "System" , $Point , "P" ,"��ǥ����" );

} else {

	js_alert_location("�̹� ��ǥ�� ���� �ϼ̽��ϴ�" , "-1" );

}

	// ����Ʈ �ο�

	js_location("$PHP_SELF?html=poll&PID=$PID&UID=$UID&mode=view");
	exit;

}
?>

<?
if (file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_start.php")) include_once ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_start.php");
if (file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_top.php")) include ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_top.php");
?>
<table width="884" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="193" align="center" valign="top">
<? if (file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_left.php")) include ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_left.php");?></td>
    <td align="center" valign="top">

<?
if($html == "poll"){
	include_once ("./util/poll/index.php");
}else {
	include_once ("./${SKIN_FOLDER_NAME}/html/$HtmlSkin/$html.php");
}
?>

</td>
  </tr>
</table>
<?
if (file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_bottom.php")) include ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_bottom.php");
if (file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_close.php")) include ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_close.php");
?>
