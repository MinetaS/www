<?
header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<?
include "./config/db_info.php";
include "./config/db_connect.php";
include "./config/admin_info.php";
include "./config/skin_info.php";
include "./config/shopDisplay_info.php";
include "./config/cart_info.php";
include "./function/const_array.php";
include "./function/kerrigancap_lib.php";
if (file_exists("./config/brand_list.php")) include "./config/brand_list.php";


/*******************************************************************************
�ɼǰ��� none�̸� �ݵ�� �ɼǼ���
*******************************************************************************/
if(!strcmp($Option1, "none") || !strcmp($Option2, "none") || !strcmp($Option4, "none") ||!strcmp($Option5, "none") ){
js_alert_location("�ɼ��� ������ �ּ���","-1");
}
/*******************************************************************************
CART������ �����ð��� ���ؼ� 2�ð�(mktime()���� - 7200)�� ����� ��� �ڵ�����..
*******************************************************************************/
$LOG_DIR = opendir("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers");
while($LOG_FILE = readdir($LOG_DIR)) {
	if($LOG_FILE !="." && $LOG_FILE !=".."){
	    if(file_exists("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$LOG_FILE") && mktime() - filemtime("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$LOG_FILE") > 7200) {
         unlink("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$LOG_FILE");
        }
	} //if($LOG_FILE !="." && $LOG_FILE !="..") ����
}
closedir($LOG_DIR);
/* $no|$BUYNUM|$GoodsPrice|$Option1|$Option4|$Option5 : ��ǰ�ڵ�|����|����|�ɼ�1|�ɼ�2|�ɼ�4|�ɼ�5|*/
/*********************************************************************************
���߼��� ��ٱ��� ����ϰ��
*********************************************************************************/
if ($query == 'cmp') {
/* ��ٱ��� �ڵ尡 ���� ��� - ó������ ��ٱ��Ͽ� ����� ��� */
       if (!$_COOKIE[CART_CODE] || !file_exists("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi")) {
                $CART_CODE = date("Ymdhis");  // ��ٱ��ϰ����ڵ�
                setcookie("CART_CODE","$CART_CODE",0,"/");
								$fp = fopen("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$CART_CODE.cgi", "w");
								while (list($key,$value) = each($mall_chk)) :
											 //if(ereg("multi", $key)) :
										$BUYNUM = ${BUYNUM_.$key};
										$GoodsPrice = ${GoodsPrice_.$key};
										$GoodsPoint = ${GoodsPoint_.$key};
										/*
										$tmpvalue = OptionValueFnc($Option1, 1);#�ɼǰ����� �����Ұ�� 2�κ����Ѵ�.
										if($tmpvalue[0]) $GoodsPrice = $tmpvalue[0];
										if($tmpvalue[1]) $Option1 = $tmpvalue[1];
										*/

										fwrite($fp, "$key|$BUYNUM|$GoodsPrice|$GoodsPoint|$Option1|$Option2|$Option4|$Option5|$Addition1|$Addition2|$Addition3|$Addition4|$Addition5|$Addition6|$Addition7|$Addition8|$Addition9|$Addition10|$Addition11|$Addition12|$Addition13|$Addition14|$Addition15|$Addition16|$Addition17|$Addition18|$Addition19|$Addition20|$Addition21|$Addition22|$Addition23|$Addition24|$Addition25|$Addition26|\n");
											 //endif;
								endwhile;

        for ($i=0;$i<sizeof($CART_DATA);$i++){
                fwrite($fp, chop($CART_DATA[$i])."\n");
        }
        fclose($fp);
        }
/* �̹� ��ٱ��� �ڵ尡 ������ ��� */
        else {
		        unset($CartDataTmp);
            while (list($key,$value) = each($mall_chk)) :
                     // if(ereg("multi", $key)) :/* multi�ϰ��� $GoodsPrice�� �Ѿ� ���� �����Ƿ� ���� db���� �����;� �Ѵ�. */
					  $sqlstr = "select Price from {$MALL_TABLE_NAME} where UID = '$key'";
					  $sqlqry = mysql_query($sqlstr) or die(mysql_error());
					  $BUYNUM = ${BUYNUM_.$key};
					  $GoodsPrice = ${GoodsPrice_.$key};
						$GoodsPoint = ${GoodsPoint_.$key};
/* ���� ��ٱ��Ͽ� ����ִ��� ���θ� åũ�� ��������� ������ �ø� */


            $Cart_Data = file("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi");
						$fp = fopen("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$CART_CODE.cgi", "w");
			                while ($Cart_Data_f = each($Cart_Data)) :
            			    $C_dat = explode("|", chop($Cart_Data_f[1]));
											//echo "\$C_dat[0] = $C_dat[0], \$no = $no <br>";
                        			if("$C_dat[0]" == "$key") { /* Multi�� ���� �ɼ������� ���� �ʴ´�.*/
			                                $AddedNum = $BUYNUM + $C_dat[1];
																			/*
																			$tmpvalue = OptionValueFnc($Option1, 1);#�ɼǰ����� �����Ұ�� 2�κ����Ѵ�.
																			if($tmpvalue[0]) $GoodsPrice = $tmpvalue[0];
																			if($tmpvalue[1]) $Option1 = $tmpvalue[1];
																			*/

            			                    fwrite($fp, "$key|$AddedNum|$GoodsPrice|$GoodsPoint|$Option1|$Option2|$Option4|$Option5|$Addition1|$Addition2|$Addition3|$Addition4|$Addition5|$Addition6|$Addition7|$Addition8|$Addition9|$Addition10|$Addition11|$Addition12|$Addition13|$Addition14|$Addition15|$Addition16|$Addition17|$Addition18|$Addition19|$Addition20|$Addition21|$Addition22|$Addition23|$Addition24|$Addition25|$Addition26|\n");
                       				} else {
            			                    fwrite($fp, chop($Cart_Data_f[1])."\n");
                        			}
			                endwhile;
            			    fclose($fp);

														if (!$AddedNum) { /* ���� ���� ������Ʈ ���� �ʾҴٸ�, �� ������ ��ٱ��Ͽ� ���� ��ǰ�̶�� �迭�� �ϴ� ������ �д�.*/
																/*
																$tmpvalue = OptionValueFnc($Option1, 1);#�ɼǰ����� �����Ұ�� 2�κ����Ѵ�.
																if($tmpvalue[0]) $GoodsPrice = $tmpvalue[0];
																if($tmpvalue[1]) $Option1 = $tmpvalue[1];
																*/

																$CartDataTmp .= "$key|$BUYNUM|$GoodsPrice|$GoodsPoint|$Option1|$Option2|$Option4|$Option5|$Addition1|$Addition2|$Addition3|$Addition4|$Addition5|$Addition6|$Addition7|$Addition8|$Addition9|$Addition10|$Addition11|$Addition12|$Addition13|$Addition14|$Addition15|$Addition16|$Addition17|$Addition18|$Addition19|$Addition20|$Addition21|$Addition22|$Addition23|$Addition24|$Addition25|$Addition26|\n";
																//echo "\$CartDataTmp = $CartDataTmp <br>";
														}
							/* ��������� �ߺ� ���� åũ �ϴµ�..*/
														 // endif;
       			 endwhile;
		                  $fp = fopen("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi", "a");
			                fwrite($fp, "$CartDataTmp");
            			    fclose($fp);
        }
		//exit; /* �׽�Ʈ�� */
/* ���� �� ���α׷� ���⼭ �� */
         echo  "<HTML><META http-equiv='refresh' content='0;url=$PHP_SELF'></HTML>";
        exit;
}
/*********************************************************************************
�ϳ��� �����Ͽ� ��ٱ��� ����ϰ��
*********************************************************************************/
if (!strcmp($query,"cart_save")) { // ��ٱ��ϴ��
        if (!$_COOKIE[CART_CODE] || !file_exists("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi")) {
                $CART_CODE = date("Ymdhis");  // ��ٱ��ϰ����ڵ�
                setcookie("CART_CODE","$CART_CODE",0,"/");
                $fp = fopen("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$CART_CODE.cgi", "w");
								/*
								$tmpvalue = OptionValueFnc($Option1, 1);#�ɼǰ����� �����Ұ�� 2�κ����Ѵ�.
								if($tmpvalue[0]) $GoodsPrice = $tmpvalue[0];
								if($tmpvalue[1]) $Option1 = $tmpvalue[1];
								*/

								fwrite($fp, "$no|$BUYNUM|$GoodsPrice|$GoodsPoint|$Option1|$Option2|$Option4|$Option5|$Addition1|$Addition2|$Addition3|$Addition4|$Addition5|$Addition6|$Addition7|$Addition8|$Addition9|$Addition10|$Addition11|$Addition12|$Addition13|$Addition14|$Addition15|$Addition16|$Addition17|$Addition18|$Addition19|$Addition20|$Addition21|$Addition22|$Addition23|$Addition24|$Addition25|$Addition26|\n");
								fclose($fp);
        } else {
                if (file_exists("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi")){
									$Cart_Data = file("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi");
									$fp = fopen("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi", "w");
									while ($Cart_Data_f = each($Cart_Data)) {
									$C_dat = explode("|", chop($Cart_Data_f[1]));
														if("$C_dat[0]^$C_dat[4]^$C_dat[5]^$C_dat[6]^$C_dat[7]" == "$no^$Option1^$Option2^$Option4^$Option5") {
																if(!strcmp($NoneDouble,"checked")) $AddedNum = $BUYNUM; /* �ߺ���Ⱑ �����Ǿ� ������ */
																else $AddedNum = $BUYNUM + $C_dat[1];
																/*
																$tmpvalue = OptionValueFnc($Option1, 1);#�ɼǰ����� �����Ұ�� 2�κ����Ѵ�.
																if($tmpvalue[0]) $GoodsPrice = $tmpvalue[0];
																if($tmpvalue[1]) $Option1 = $tmpvalue[1];
																*/

														fwrite($fp, "$no|$AddedNum|$GoodsPrice|$GoodsPoint|$Option1|$Option2|$Option4|$Option5|$Addition1|$Addition2|$Addition3|$Addition4|$Addition5|$Addition6|$Addition7|$Addition8|$Addition9|$Addition10|$Addition11|$Addition12|$Addition13|$Addition14|$Addition15|$Addition16|$Addition17|$Addition18|$Addition19|$Addition20|$Addition21|$Addition22|$Addition23|$Addition24|$Addition25|$Addition26|\n");
														}	else {
																	fwrite($fp, chop($Cart_Data_f[1])."\n");
														}
									}
									fclose($fp);
									if (!$AddedNum) {
											$fp = fopen("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi", "a");
											/*
											$tmpvalue = OptionValueFnc($Option1, 1);#�ɼǰ����� �����Ұ�� 2�κ����Ѵ�.
											if($tmpvalue[0]) $GoodsPrice = $tmpvalue[0];
											if($tmpvalue[1]) $Option1 = $tmpvalue[1];
											*/

											fwrite($fp, "$no|$BUYNUM|$GoodsPrice|$GoodsPoint|$Option1|$Option2|$Option4|$Option5|$Addition1|$Addition2|$Addition3|$Addition4|$Addition5|$Addition6|$Addition7|$Addition8|$Addition9|$Addition10|$Addition11|$Addition12|$Addition13|$Addition14|$Addition15|$Addition16|$Addition17|$Addition18|$Addition19|$Addition20|$Addition21|$Addition22|$Addition23|$Addition24|$Addition25|$Addition26|\n");
											fclose($fp);
									}
                }
        }

			if($sub_query)  echo  "<HTML><META http-equiv='refresh' content='0;url=$PHP_SELF?query=step1'></HTML>";
			else  echo  "<HTML><META http-equiv='refresh' content='0;url=$PHP_SELF'></HTML>";
			exit;
}
/*********************************************************************************
��ٱ��� ���ϻ���
*********************************************************************************/
if (!strcmp($query,"delete")){ // ��ٱ��� ���ϻ���
			if (file_exists("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi")){
			$Cart_Data = file("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi");
			$fp = fopen("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi", "w");
			while ($Cart_Data_f = each($Cart_Data)) {
			$C_dat = explode("|", chop($Cart_Data_f[1]));
					if("$C_dat[0]^$C_dat[4]^$C_dat[5]^$C_dat[6]^$C_dat[7]" != urldecode($value) ) {
									fwrite($fp, chop($Cart_Data_f[1])."\n");
					}
			}
			fclose($fp);
			}
			 echo  "<HTML><META http-equiv='refresh' content='0;url=$PHP_SELF'></HTML>";
			 exit;
}
/*********************************************************************************
��ٱ��� ���ϼ���
*********************************************************************************/
if (!strcmp($query,"modify")){ // ��ٱ��� ���ϼ���
        if (file_exists("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi")){
        $Cart_Data = file("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi");
        $fp = fopen("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi", "w");
        while ($Cart_Data_f = each($Cart_Data)) {
        $C_dat = explode("|", chop($Cart_Data_f[1]));
						if("$C_dat[0]^$C_dat[4]^$C_dat[5]^$C_dat[6]^$C_dat[7]" == urldecode($value) ) {
								fwrite($fp, "$C_dat[0]|$BUYNUM|$GoodsPrice|$GoodsPoint|$C_dat[4]|$C_dat[5]|$C_dat[6]|$C_dat[7]|$C_dat[8]|$C_dat[9]|$C_dat[10]|$C_dat[11]|$C_dat[12]|$C_dat[13]|$C_dat[14]||$C_dat[12]|$C_dat[13]|$C_dat[14]||$C_dat[12]|$C_dat[13]|$C_dat[14]|$C_dat[15]|$C_dat[16]|$C_dat[17]||$C_dat[18]|$C_dat[19]|$C_dat[20]|\n");
						}
						else {
								fwrite($fp, chop($Cart_Data_f[1])."\n");
						}
        }
        fclose($fp);
        }
         echo  "<HTML><META http-equiv='refresh' content='0;url=$PHP_SELF'></HTML>";
         exit;
}
/*********************************************************************************
��ٱ��� ����
*********************************************************************************/
if (!strcmp($query,"step4")){ // ��ٱ��� ����
	if (file_exists("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi")){
		unlink("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi");
	}
	  setcookie("CART_CODE","",0,"/");
}

if (!strcmp($query,"trash")){ // ��ٱ��� ����
			if (file_exists("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi")){
				unlink("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi");
				setcookie("CART_CODE","",0,"/");
			}
			if($goto){
				echo "<HTML><META http-equiv='refresh' content='0;url=$goto'></HTML>";
			}else{
				echo  "<HTML><META http-equiv='refresh' content='0;url=$PHP_SELF'></HTML>";
			}
			exit;
}

/*********************************************************************************
�����ϱ� ����(step1)�̰� ȸ���α��� �����̸� �ٷ� �����������(step2)�� �Ѿ��,
ȸ���α��� ���°� �ƴϸ� ȸ���α��� â���� �Ѿ��.
*********************************************************************************/
if (!strcmp($query,"step1")){
		if (isMember() || !strcmp($NoneMemOnly,"checked")) {
		 echo  "<HTML><META http-equiv='refresh' content='0;url=$PHP_SELF?query=step2'></HTML>";
		 exit;
		}
}

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
switch ( $query )
{
		case ( "cart_save" ) :
		include ("./${SKIN_FOLDER_NAME}/cart/$CartSkin/CART_SAVE.php");
		break;
		case ( "step1" ) :
		include ("./${SKIN_FOLDER_NAME}/cart/$CartSkin/CART_LOGIN.php");
		break;
		case ( "step2" ) :
		include ("./${SKIN_FOLDER_NAME}/cart/$CartSkin/CART_WRITE.php");
		break;
		case ( "step3" ) :
		include ("./${SKIN_FOLDER_NAME}/cart/$CartSkin/CART_FINISH.php");
		break;
		case ( "step4" ) :
		include ("./${SKIN_FOLDER_NAME}/cart/$CartSkin/CART_QUERY_FINAL.php");
		break;
		case ( "cardchecking" ) :
		include ("./${SKIN_FOLDER_NAME}/cart/$CartSkin/CARD_CHECKING.php");
		break;
		default :
		include ("./${SKIN_FOLDER_NAME}/cart/$CartSkin/CART_SAVE.php");
		break;
}
?>
</td>
  </tr>
</table>
<?
if (file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_bottom.php")) include ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/menu_bottom.php");
if (file_exists("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_close.php")) include ("./${SKIN_FOLDER_NAME}/layout/$LayOutSkin/layout_close.php");
?>
