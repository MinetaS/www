<?
/*
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/
header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include  "./config/db_info.php";
include  "./config/db_connect.php";
include  "./config/admin_info.php";
include  "./config/skin_info.php";
include  "./config/membercheck_info.php";
include  "./config/board_info.php";// �Խ��� ����ȯ�� ����
include  "./function/const_array.php";
include  "./function/kerrigancap_lib.php";
include  "./function/filter.php";
if (file_exists("./config/brand_list.php")) include "./config/brand_list.php";// �귣��/������


if ( !$GID || !$BID || !is_dir( "./${BOARD_FOLDER_NAME}/table/$GID/$BID"))
{
	js_alert_location("\\n\\n�������� �ʴ� �����Դϴ�.\\n\\n","-1");

}


$config_include_path = "./${BOARD_FOLDER_NAME}/table/$GID/$BID";


if(file_exists($config_include_path."/basic_config.php")) include $config_include_path."/basic_config.php";/* config1.php���� ���� ��Ų�� ������ ��Ų�� ������ ���ϴ�. */
if(file_exists($config_include_path."/detail_config.php")) include $config_include_path."/detail_config.php";/* config5.php���� ȸ������ ����, �б� ���� ���� ������ ����. */
include "./${BOARD_FOLDER_NAME}/func/MakeChannel.php"; //Channel ����� �Լ�

/****[��Ų�� �ٸ����� ������ ����Ʈ�� ����Ҷ�, �� SameDB�� ���� ��] *******/

if(!$SameDB){

	 $BOARD_NAME="${DEFAULT_TABLE_NAME}_${GID}_${BID}";
	 $UpdirPath = $GID."/".$BID;

}else{
	$BOARD_NAME="${DEFAULT_TABLE_NAME}_${SameDB}";
	$UpdirPath = $SameDB;
}

/****[Ȯ��DB����] *******/
if($ExtendDB && $ExtendDBUse=="checked")
$BOARD_NAME="$ExtendDB";
/******************************************************************************/

/****************** ���������� ���� ���� ***********************/
if($INCLUDE_MALL_SKIN == "Y" ):/* Board�� ��Ų ��Ŭ��� åũ�� */

include "./config/skin_info.php";

if(file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_start.php")) include_once ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_start.php");

if(!$sysop || !$fm ){// ������ ��忡���� ��Ŭ��� Y ���� ���� ���� �ʴ´�.

?>
<?
if (file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_top.php")) include ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_top.php");
?>
<table width="884" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="193" align="center" valign="top"><?

include ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_left.php");
?></td>
    <td align="center" valign="top">
<!-- main menu start -->
 <?

}

/* Board�� ��Ų ��Ŭ��� åũ�� */
endif;


?>
 <?

if(!$sysop){

	if(is_file($config_include_path."/top.php")) include $config_include_path."/top.php";

} else{
	// ��Ÿ�Ͻ�ũ�� �Ҹ�
	echo "<link href='./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/style.css' rel='stylesheet' type='text/css'>";

}


if(!$TABLE_WIDTH) $TABLE_WIDTH = "100%";
if(!$TABLE_ALIGN) $TABLE_ALIGN = "DEFAULT";
?>
                        <table width="<?=$TABLE_WIDTH?>" border="0" cellpadding="0" cellspacing="0" align="<?=$TABLE_ALIGN?>">
                          <tr>
                            <td valign="top"><script src = "./js/BoardLayer.js"></script>
<?
switch ( $mode )
{
			case  "list"  :	// ����Ʈ
			include "./${BOARD_FOLDER_NAME}/skin/$BOARD_SKIN_TYPE/list.php";
			break;

			case  "view"  : // ��
			include "./${BOARD_FOLDER_NAME}/skin/$BOARD_SKIN_TYPE/view.php";
			break;

			case  "write" : // ����
			case  "reply" :
			case  "modify":
			include "./${BOARD_FOLDER_NAME}/skin/$BOARD_SKIN_TYPE/write.php";
			break;

			case  "delete": // ����(�˾��� �ƴ� ���������ӿ�)
			include "./${BOARD_FOLDER_NAME}/skin/$BOARD_SKIN_TYPE/delete.php";
			break;

			case  "multi": // ��Ƽ��
			include "./${BOARD_FOLDER_NAME}/skin/$BOARD_SKIN_TYPE/multi_view.php";
			break;

			case  "modify_auth":// ��б�,������ ��� �Է�
			case  "secret"  :
			include "./${BOARD_FOLDER_NAME}/login_secret.php";
			break;

			default :
			include "./${BOARD_FOLDER_NAME}/skin/$BOARD_SKIN_TYPE/list.php";
			break;
}
?>
                            </td>
                          </tr>
                        </table>
<?
if(!$sysop){
	if(file_exists($config_include_path."/bottom.php")){
	include $config_include_path."/bottom.php";
	}
}
?>
<?
if($INCLUDE_MALL_SKIN == "Y"):/* Board�� ��Ų ��Ŭ��� åũ�� */
	if(!$sysop || !$fm ){// ������ ��忡���� ��Ŭ��� Y ���� ���� ���� �ʴ´�.
?>
                        <!-- main menu end -->
                      </td>
  </tr>
</table>
<?

if (file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_bottom.php")) include ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_bottom.php");
}
endif;
if(file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_close.php")) include_once ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_close.php");
?>

<!-- ���߳��� : SQL Injection ������� �Խ��� ��⸸ ��ġ�ϸ� �ǰ� �̹��� ���� ��ġ�� ������ -->