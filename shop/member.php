<?
/*<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/
/*
	mypage skin �и� ${SKIN_FOLDER_NAME}/mypage/
	USER_POINT
	USER_MYPAGE
	USER_ORDER
	USER_ORDER_SPEC
	regis �� info�� regis�� ����
	ȸ�� ������ (������� query=auth)

*/
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
include "./config/membercheck_info.php";
include "./config/cart_info.php";
include "./function/const_array.php";
include "./function/kerrigancap_lib.php";
if (file_exists("./config/brand_list.php")) include "./config/brand_list.php";// �귣��/������

include "./function/filter.php";
////////////////////////////////
// �Ķ���� ���͸�
////////////////////////////////
$Name = filter($Name);
$Jumin1 = filter($Jumin1);
$Jumin2 = filter($Jumin2);
$ID = filter($ID);


$OrderName = trim($OrderName);
$OrderPWD = trim($OrderPWD);

###############################################################################################
# ��ȸ�� ��ȸ�� ��Ű ����
###############################################################################################

if($query == "order" && $mode == "NonMemberCookie"){// ��ȸ�� �ֹ����� Ȯ�ν� ���̵� ��� ��Űȭ
	$OrderCnt = getSingleValue("SELECT COUNT(*) as cnt FROM ${BUYER_TABLE_NAME} WHERE Sender_Name = '$OrderName' AND PWD = '$OrderPWD'");
	if($OrderCnt  > 0 ){
		setcookie("ORDER_NON_MEMBER_NAME", "$OrderName", 0, "/");
		setcookie("ORDER_NON_MEMBER_PWD", "$OrderPWD", 0, "/");
		js_location("./${MEMBER_MAIN_FILE_NAME}?query=order");
		exit;
	}else{
		js_alert_location("������ ���ų����� �������� �ʽ��ϴ�.","./${MEMBER_MAIN_FILE_NAME}?query=order");
		exit;
	}
}

/****************** ���������� ���� ���� ***********************/

if(!strcmp($INCLUDE_MALL_SKIN,"Y")):/* ${MEMBER_FOLDER_NAME} �� ��Ų ��Ŭ��� åũ�� */

if(!$TABLE_WIDTH) $TABLE_WIDTH = "100%";
if(!$TABLE_ALIGN) $TABLE_ALIGN = "DEFAULT";
?>
<?
if (file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_start.php")) include_once ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_start.php");
if (file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_top.php")) include ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_top.php");
?>
<table width="884" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="193" align="center" valign="top">
<?
if (file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_left.php")) include ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_left.php");
?></td>
    <td align="center" valign="top">
<?
/* ${MEMBER_FOLDER_NAME} �� ��Ų ��Ŭ��� åũ�� */
endif;
?>
<?
if(file_exists("./config/MemberSkinTop.php")) include "./config/MemberSkinTop.php";
?>
            <table width="<?=$TABLE_WIDTH?>" border="0" cellpadding="0" cellspacing="0" align="<?=$TABLE_ALIGN?>">
              <tr>
                <td valign="top">
                  <?
/* �α��� �� �����̴� ������ */
unset($status); /* �α��ΰ� ���� Ȥ�� query ���� ���� �پ��� ����� �䱸�ǹǷ� $status�� ��Ȳ�� ���� ���� �ൿ �ݰ��� ���Ѵ�. */
if (isMember()) {
			if ($query == 'point') {
							include ("./${SKIN_FOLDER_NAME}/mypage/$MyPageSkin/USER_POINT.php");
							$status = "point";
			}
			else if ($query == 'mypage') { // ����������
							include ("./${SKIN_FOLDER_NAME}/mypage/$MyPageSkin/USER_MYPAGE.php");
							$status = "mypage" ;
			}
			else if ($query == 'order') {
							include ("./${SKIN_FOLDER_NAME}/mypage/$MyPageSkin/USER_ORDER.php");
							$status = "order";
			}
			else if ($query == 'regis') {
							include ("./${MEMBER_FOLDER_NAME}/$MemberSkin/USER_REGIS.php");
							$status = "regis";
			}
			else if ($query == 'auth') {// ȸ������������ �н����� ���Զ�.
							include ("./${MEMBER_FOLDER_NAME}/$MemberSkin/USER_AUTH.php");
							$status = "auth";
			}
			else if ($query == 'wish') {
							include ("./${SKIN_FOLDER_NAME}/wishList/$WishSkin/USER_WISH.php");
							$status = "wish";
			}
			else if ($query == 'out') {
							include ("./${MEMBER_FOLDER_NAME}/$MemberSkin/USER_OUT.php");
							$status = "out";
			}

}
/* �α��� ���� �� �� �ִ� ������ */

		if (!strcmp($query,"passsearch") && !$status) {
            include ("./${MEMBER_FOLDER_NAME}/$MemberSkin/IDPASS_SEARCH.php");
		}
		else if (!strcmp($query,"idsearch") && !$status) { /* ȸ����й�ȣȮ�ζ� */
						include ("./${MEMBER_FOLDER_NAME}/$MemberSkin/ID_SEARCH.php");
		}
		else if (!strcmp($query,"auth") && !$status) { /* ȸ����й�ȣȮ�ζ� */
						include ("./${MEMBER_FOLDER_NAME}/$MemberSkin/USER_AUTH.php");
		}
		else if (!strcmp($query,"accept") && !$status) { /* �Ϲ�ȸ������ */
						include ("./${MEMBER_FOLDER_NAME}/$MemberSkin/USER_ACCEPT.php");
		}
		else if (!strcmp($query,"regis") && !$status) { /* �Ϲ�ȸ������ */
						include ("./${MEMBER_FOLDER_NAME}/$MemberSkin/USER_REGIS.php");
		}
		else if (!strcmp($query,"regis_complete") && !$status) { /* �Ϲ�ȸ������ */
						include ("./${MEMBER_FOLDER_NAME}/$MemberSkin/USER_REGIS_COMPLETE.php");
		}
		else if(!strcmp($query,"order")  && !$status && $_COOKIE[ORDER_NON_MEMBER_NAME] && $_COOKIE[ORDER_NON_MEMBER_PWD]) {/* �ֹ� �� ����*/

						include ("./${SKIN_FOLDER_NAME}/mypage/$MyPageSkin/USER_ORDER.php");
		}
		else if(!strcmp($query,"order_detail")  && !$status) {/* �ֹ� �� ����*/
						include ("./${SKIN_FOLDER_NAME}/mypage/$MyPageSkin/USER_ORDER_SPEC.php");
		}
		else if(!strcmp($query,"login") && !$status) {
						include ("./${MEMBER_FOLDER_NAME}/$MemberSkin/USER_LOGIN.php");
		}
		else if(!$status){
						// ��ǰ ���̳� ��Ʈ���� �Ѿ�°��� ReturnUrl�� �ٽ� üũ ���� �ʴ´�.
						if(!ereg("$MART_MAIN_FILE_NAME",$ReturnUrl)) include "./function/member_check_module.php" ;
						include ("./${MEMBER_FOLDER_NAME}/$MemberSkin/USER_LOGIN.php");
		}

?>
                </td>
              </tr>
            </table>
            <!-- Main End -->
<?
if(file_exists("./config/MemberSkinBottom.php")) include "./config/MemberSkinBottom.php";
?>
<?
if(!strcmp($INCLUDE_MALL_SKIN,"Y")):/* ${MEMBER_FOLDER_NAME}�� ��Ų ��Ŭ��� åũ�� */
?>
          </td>
  </tr>
</table>
<?
if (file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_bottom.php")) include ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_bottom.php");
if(file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_close.php")) include_once ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_close.php");
/* ${MEMBER_FOLDER_NAME} �� ��Ų ��Ŭ��� åũ�� */
endif;

?>
