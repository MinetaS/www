<?



//ī�װ� ���� �з����� ����� ���ǰ� �Ǿ��־�� �Ʒ��� ���� ����ȴ�.
$sqlstr = "select * from ${CATEGORY_TABLE_NAME} where cat_no < 100 AND cat_no LIKE '%$big_code' and cat_flag='M'";
$codelist = _mysql_fetch_array($sqlstr);

$sqlstr = "select cat_top, cat_bottom from ${CATEGORY_TABLE_NAME} where cat_no LIKE '$code' and cat_flag='M'";
$cat_skin_list = _mysql_fetch_array($sqlstr);

$istop = stripslashes($cat_skin_list[cat_top]);
$isbottom = stripslashes($cat_skin_list[cat_bottom]);
if($istop) $codelist[cat_top] = $istop;
if($isbottom) $codelist[cat_bottom] = $isbottom;
/* ���ǵ� shop-skin�� ������ �̰����� skin�� �ٲ۴�.*/
//����� ��з����� ������ ���� �Ϸ������� ��� ���� �������� �����ǵ��� �Ǿ��ֽ��ϴ�
echo stripslashes($codelist[cat_top]);
//ī�װ� ���� �з����� ����� ���ǰ� �Ǿ��־�� ���� ���� ����ȴ�.
?>
<table width="690" border="0" cellspacing="0" cellpadding="0">
  <tr align="left" valign="top">
    <td width="10" height="10"><img src="<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/sub_box01_01.gif" width="10" height="10"></td>
    <td background="<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/sub_box01_02.gif"></td>
    <td width="10"><img src="<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/sub_box01_03.gif" width="10" height="10"></td>
  </tr>
  <tr align="left" valign="top">
    <td style="background-image: url(<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/sub_box01_08.gif);background-repeat:repeat-y;"></td>
    <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td align="left" valign="top"></td>
        </tr>
        <tr>
          <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr align="left" valign="top">
                <td height="10">
                  <!-- ����Ʈ��ǰ -->
                  <?

$BestOrderBy = " order by Ranking ASC , UID DESC" ;

if(empty($mid_cate) && empty($small_cate)){
$best_sql="SELECT * FROM ${MALL_TABLE_NAME} WHERE Category LIKE '%$big_code' AND Option3 like '%����Ʈ%' AND   Status = 'Y' $BestOrderBy  LIMIT 0,3";
}elseif($mid_cate){
$best_sql="SELECT * FROM ${MALL_TABLE_NAME} WHERE Category LIKE '%${mid_code}${big_code}' AND Option3 like '%����Ʈ%' AND  Status = 'Y' $BestOrderBy  LIMIT  0,3";
}elseif($small_cate){
$best_sql="SELECT * FROM ${MALL_TABLE_NAME} WHERE Category = '$code' AND Option3 like '%����Ʈ%' AND  Status = 'Y' $BestOrderBy  LIMIT  0,3";
}
// echo "query : ".$best_sql ".<br>";
$best_result = mysql_query($best_sql) or die(mysql_error());
$idx = 0 ;
while($best_list = mysql_fetch_array($best_result)):

$best_uid[$idx] = $best_list[UID];
$best_picture = explode("|" , $best_list[Picture]);
$BPicture[$idx] = "${STOCK_FOLDER_NAME}/${best_picture[1]}";
$best_name[$idx] = $best_list[Name];
$best_price[$idx] = $best_list[Price];
$best_category[$idx] = $best_list[Category];
$best_detail[$idx] = nl2br(stripslashes(STR_CUTTING($best_list[Description2],50)));
$linkUrl[$idx] = "${PHP_SELF}?query=view&no=$best_uid[$idx]&code=$best_category[$idx]";
$idx++;
endwhile;



?>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="340" align="left" valign="top"><table height="280" border="0" cellpadding="0" cellspacing="0">
                          <tr align="left" valign="top">
                            <td width="56"><img src="<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/best_title.gif"></td>
                            <td width="10" ></td>
                            <td width="220" align="center" valign="top">
                              <!--  ���κ���Ʈ��ǰ -->
                              <table width="230" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="230" align="center" valign="top">
                                    <? if($BPicture[0]){?>
                                    <a href="<? echo $linkUrl[0];?>"><img src="<? echo $BPicture[0]; ?>" width="<? echo $MIMAGEW; ?>" height = "<? echo $MIMAGEH; ?>" border="0"></a>
                                    <? }?>
                                  </td>
                                </tr>
                                <tr>
                                  <td height="10"></td>
                                </tr>
                                <tr>
                                  <td align="center" valign="top">
                                    <a href="<? echo $linkUrl[0];?>" class="link_gray" style="word-break:break-all;"><? echo $best_name[0];?></a><br>
                                    <span class="green-b"><? echo number_format($best_price[0]);?>
                                    ��</span></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                      <td width="370" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="180" align="left" valign="top"><table width="100%" height="280" border="0" cellpadding="0" cellspacing="0">
                                <tr align="left" valign="top">
                                  <td height="8" bgcolor="#F5F5F5"><img src="<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/box01_01.gif" width="8" height="8"></td>
                                  <td bgcolor="#F5F5F5"></td>
                                  <td bgcolor="#F5F5F5"><img src="<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/box01_02.gif" width="8" height="8"></td>
                                </tr>
                                <tr align="left" valign="top">
                                  <td bgcolor="#F5F5F5">&nbsp;</td>
                                  <td align="center" valign="middle" bgcolor="#F5F5F5"><table width="160" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td height="125" align="center" valign="middle"><table width="100" height="100" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                              <td align="center" valign="top">
                                                <? if($BPicture[1]){?>
                                                <a href="<? echo $linkUrl[1];?>"><img src="<? echo $BPicture[1]; ?>" width="<? echo $SIMAGEW; ?>" height = "<? echo $SIMAGEH; ?>" border="0"></a>
                                                <? }?>
                                              </td>
                                            </tr>
                                          </table></td>
                                      </tr>
                                      <tr>
                                        <td height="40" align="center" valign="top">
                                          <table width = 80%>
                                            <tr>
                                              <td align = center style="word-break:break-all;">
                                                <a href="<? echo $linkUrl[1];?>" class="link_gray" >
                                                <? echo $best_name[1];?></a><br>
                                                <span class="green-b"><? echo number_format($best_price[1]);?>��</span>
                                              </td>
                                            </tr>
                                          </table></td>
                                      </tr>
                                      <tr>
                                        <td height="10" ></td>
                                      </tr>
                                    </table></td>
                                  <td bgcolor="#F5F5F5">&nbsp;</td>
                                </tr>
                                <tr align="left" valign="top">
                                  <td height="8" bgcolor="#F5F5F5"><img src="<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/box01_04.gif" width="8" height="8"></td>
                                  <td bgcolor="#F5F5F5"></td>
                                  <td bgcolor="#F5F5F5"><img src="<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/box01_03.gif" width="8" height="8"></td>
                                </tr>
                              </table></td>
                            <td width="2"></td>
                            <td width="180" align="left" valign="top"><table width="100%" height="280" border="0" cellpadding="0" cellspacing="0">
                                <tr align="left" valign="top">
                                  <td height="8" bgcolor="#F5F5F5"><img src="<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/box01_01.gif" width="8" height="8"></td>
                                  <td bgcolor="#F5F5F5"></td>
                                  <td bgcolor="#F5F5F5"><img src="<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/box01_02.gif" width="8" height="8"></td>
                                </tr>
                                <tr align="left" valign="top">
                                  <td bgcolor="#F5F5F5"></td>
                                  <td align="center" valign="middle" bgcolor="#F5F5F5"><table width="160" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td height="125" align="center" valign="middle"><table width="100" height="100" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                              <td align="center" valign="top">
                                                <? if($BPicture[2]){?>
                                                <a href="<? echo $linkUrl[2];?>"><img src="<? echo $BPicture[2]; ?>" width="<? echo $SIMAGEW; ?>" height = "<? echo $SIMAGEH; ?>" border="0"></a>
                                                <? }?>
                                              </td>
                                            </tr>
                                          </table></td>
                                      </tr>
                                      <tr>
                                        <td height="40" align="center" valign="top">
                                          <table width = 80%>
                                            <tr>
                                              <td align = center  style="word-break:break-all;">
                                                <a href="<? echo $linkUrl[2];?>" class="link_gray">
                                                <? echo $best_name[2];?></a><br>
                                                <span class="green-b"><? echo number_format($best_price[2]);?>��</span>
                                              </td>
                                            </tr>
                                          </table></td>
                                      </tr>
                                      <tr>
                                        <td height="10" ></td>
                                      </tr>
                                    </table></td>
                                  <td bgcolor="#F5F5F5"></td>
                                </tr>
                                <tr align="left" valign="top">
                                  <td height="8" bgcolor="#F5F5F5"><img src="<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/box01_04.gif" width="8" height="8"></td>
                                  <td bgcolor="#F5F5F5"></td>
                                  <td bgcolor="#F5F5F5"><img src="<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/box01_03.gif" width="8" height="8"></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td height="12"></td>
              </tr>
              <tr bgcolor="#CECECE">
                <td height="1"></td>
              </tr>
              <tr bgcolor="#F5F5F5">
                <td height="3"></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="100%" height="15"></td>
              </tr>
              <tr>
                <td align="left" valign="middle">
                  <!-- ��ǰ���� -->
                  <a name = "#P"></a> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="9"></td>
                      <td width="302" align="left" valign="middle" > <table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="left" valign="middle"  style="font-size:12px; font-weight:bold; color='#218EAD'"><img src="<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/bullet1.gif" width="12" height="14" align="absmiddle">&nbsp;
                              <!--<img src="<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/title_driver.gif" width="178" height="18">-->
                              <span class="green-b"><? echo $big_name; ?></span></td>
                          </tr>
                        </table></td>
                      <td width="369" align="right" valign="middle"> <table width = "100%">
                          <tr>
                            <form name = "NaviFrm" action = "<? echo $_SERVER['PHP_SELF'];?>"  method="post">
                              <input type = "hidden" name = "code" value = "<? echo $code; ?>">
                              <input type = "hidden" name = "ArrangeBy" value = "<? echo $ArrangeBy; ?>">
                              <input type = "hidden" name = "mid_cate" value = "<? echo $mid_cate; ?>">
                              <input type = "hidden" name = "small_cate" value = "<? echo $small_cate; ?>">
                              <td width="52%" align = right>
                                <!-- ����Ʈ �ڽ� ǥ�� -->
																��ü���� <input type = "checkbox" name = "CheckAll" onClick = "javascript:allcheck(document.mall_list)" style = "cursor:hand">
                                <select name = "ListMaxCnt" onChange = "this.form.submit();">
                                  <option value = "" <? if(!$_COOKIE[ListMaxCnt]) echo " selected" ; ?>>��ǰ������</option>
                                  <?
																		$UserArrayListNo = explode(",",$UserArrayListNo);
																		foreach($UserArrayListNo as $key => $value){
																				if($ListNo == $value) $selected = " selected" ; else $selected = "";
																				echo "<option value = '$value' $selected>${value}��</option>" ;
																		}
																	?>
                                </select>
                                <!-- ����Ʈ �ڽ� ǥ��-->
                              </td>
                            </form>
                            <td width="48%"> <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="55">
                                    <? if($ArrangeBy == "NP"){?>
                                    <img src="<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/btn_date_over.gif" name="date" width="52" height="19" border="0">
                                    <? } else {?>
                                    <a href="<? echo $_SERVER['PHP_SELF'];?>?code=<? echo $code?>&mid_cate=<? echo $mid_cate;?>&small_cate=<? echo $small_cate; ?>&ArrangeBy=NP#P" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('date','','<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/btn_date_over.gif',1)"><img src="<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/btn_date.gif" name="date" width="52" height="19" border="0"></a>
                                    <? } ?>
                                  </td>
                                  <td width="55">
                                    <? if($ArrangeBy == "HP"){?>
                                    <img src="<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/btn_up_price_over.gif" name="up" width="52" height="19" border="0">
                                    <? } else {?>
                                    <a href="<? echo $_SERVER['PHP_SELF'];?>?code=<? echo $code?>&mid_cate=<? echo $mid_cate;?>&small_cate=<? echo $small_cate; ?>&ArrangeBy=HP#P" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('up','','<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/btn_up_price_over.gif',1)"><img src="<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/btn_up_price.gif" name="up" width="52" height="19" border="0"></a>
                                    <? } ?>
                                  </td>
                                  <td width="55">
                                    <? if($ArrangeBy == "LP"){?>
                                    <img src="<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/btn_down_price_over.gif" name="down" width="52" height="19" border="0">
                                    <? } else {?>
                                    <a href="<? echo $_SERVER['PHP_SELF'];?>?code=<? echo $code?>&mid_cate=<? echo $mid_cate;?>&small_cate=<? echo $small_cate; ?>&ArrangeBy=LP#P" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('down','','<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/btn_down_price_over.gif',1)"><img src="<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/btn_down_price.gif" name="down" width="52" height="19" border="0"></a>
                                    <? } ?>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                        </table></td>
                      <td width="11"></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td height="10"></td>
              </tr>

<?
	$MidCateCnt = getSingleValue("select cat_no, cat_name from ${CATEGORY_TABLE_NAME} WHERE cat_no >= 100 AND cat_no < 10000 AND cat_no LIKE '%$big_code'");
	if($MidCateCnt > 0)://�ߺз��� ������
?>

              <tr>
                <td align="left" valign="top">
                  <!--  �Һз�ī�װ� -->
                  <table width="100%" border="3" bordercolor="#EDEDED" cellspacing="0" cellpadding="7">
                    <tr>
                      <td align="left" valign="top"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="25" align="left" valign="top"><table width="100%" height="25" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td width="168" align="left" valign="middle" style="padding-left:8"></td>
                                  <td width="168" align="left" valign="middle"style="padding-left:8"></td>
                                  <td width="168" align="left" valign="middle"style="padding-left:8"></td>
                                  <td width="168" align="left" valign="middle"style="padding-left:8"></td>
                                </tr>
                                <tr>
<?
$sqlcatstr = "select cat_no, cat_name from ${CATEGORY_TABLE_NAME} WHERE cat_no >= 100 AND cat_no < 10000 AND cat_no LIKE '%$big_code' order by cat_no ASC";
//echo "query : ".$sqlcatstr;

$sqlcatqry = mysql_query($sqlcatstr) or die(mysql_error());
$count = 1 ;
while($catlist = mysql_fetch_array($sqlcatqry)):
?>
                                  <td height="25" align="left" valign="middle" style="padding-left:8"><img src="<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/blit01.gif">
                                    <a href="<? echo $_SERVER['PHP_SELF'];  ?>?code=<?=$catlist[cat_no]?>&mid_cate=yes" <? if($mid_code==substr($catlist[cat_no],2,2)) echo " style='font-weight:bold;color:FF3000'";?> class="link_green">
                                    <?=$catlist[cat_name]?>
                                    </a></td>
                                  <?
if($count%4 == "0") echo "</tr><tr><td height='1' colspan = 100 bgcolor='#EDEDED'></td></tr><tr>" ;
$count++;
endwhile;
?>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
<? endif; // �ߺз��� ������?>

            </table>
            <!--  ��ǰ����Ʈ -->
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
<form  name='mall_list' action ='<? echo $CART_MAIN_FILE_NAME; ?>' method = "post" onsubmit='return cmp(this)'>
<input type = "hidden" name = "query" value='cmp'>
              <tr>
                <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="10"></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                          <tr>
                            <td width="130" ></td>
                            <td width = 5></td>
                            <td width="130" ></td>
                            <td width = 5></td>
                            <td width="130" ></td>
                            <td width = 5></td>
                            <td width="130" ></td>
                            <td width = 5></td>
                            <td width="130" ></td>
                          </tr>
                          <tr align="center" valign="top">
                            <?

$PageNo = $SubPageNo ;
$WHERE = " WHERE 1 AND Status = 'Y' AND " ;
if(empty($mid_cate) && empty($small_cate)){
$TOTAL_STR = "SELECT count(UID) FROM ${MALL_TABLE_NAME} $WHERE Category  LIKE '%$big_code'  $szSearch";
}elseif($mid_cate){
$TOTAL_STR = "SELECT count(UID) FROM ${MALL_TABLE_NAME} $WHERE Category  LIKE '%${mid_code}${big_code}' $szSearch";
}elseif($small_cate){
$TOTAL_STR = "SELECT count(UID) FROM ${MALL_TABLE_NAME} $WHERE Category = '$code' $szSearch";
}

//echo "\$TOTAL_STR : $TOTAL_STR";

$TOTAL = getSingleValue($TOTAL_STR);
if(empty($CURRENT_PAGE) || $CURRENT_PAGE <= 0) $CURRENT_PAGE = 1;
//--������ ��Ÿ����--
$TP = ceil($TOTAL / $ListNo) ; /* ������ �ϴ��� �� �������� */
$CB = ceil($CURRENT_PAGE / $PageNo);
$SP = ($CB - 1) * $PageNo + 1;
$EP = ($CB * $PageNo);
$TB = ceil($TP / $PageNo);
$START_NO = ($CURRENT_PAGE - 1) * $ListNo;
$BOARD_NO=$TOTAL-($ListNo*($CURRENT_PAGE-1));

if ($ArrangeBy == "NP")  // �Ż�ǰ
	$szSearch = "  ORDER BY UID DESC ";
elseif ($ArrangeBy == "HP" ) // ����
	$szSearch = "  ORDER BY Price DESC ";
elseif ($ArrangeBy == "LP" ) // ������
	$szSearch = "  ORDER BY Price ASC ";
elseif ($ArrangeBy == "NMP" ) // �̸���
	$szSearch = "  ORDER BY Name ASC ";
elseif ($ArrangeBy == "MP" ) // �𵨼�
	$szSearch = "  ORDER BY Model DESC ";
elseif ($ArrangeBy == "MVP" ) // ��Ʈ��
	$szSearch = "  ORDER BY Hit DESC ";
elseif ($ArrangeBy == "PP" ) // ����Ʈ��
	$szSearch = "  ORDER BY Point DESC ";
else   // NO�˻�
	$szSearch = "  ORDER BY Ranking ASC, UID DESC ";

if(empty($mid_cate) && empty($small_cate)){
$SQL_STR="SELECT * FROM ${MALL_TABLE_NAME} $WHERE Category LIKE '%$big_code'  $szSearch LIMIT $START_NO, $ListNo";
}elseif($mid_cate){
$SQL_STR="SELECT * FROM ${MALL_TABLE_NAME} $WHERE Category LIKE '%${mid_code}${big_code}' $szSearch LIMIT $START_NO, $ListNo";
}elseif($small_cate){
$SQL_STR="SELECT * FROM ${MALL_TABLE_NAME} $WHERE Category = '$code' $szSearch LIMIT $START_NO, $ListNo";
}

//echo"\$SQL_STR = $SQL_STR <br>";
$SQL_QRY=mysql_query($SQL_STR) or die(mysql_error());
$NO=0;
 //echo  'query : '.$SQL_STR;
while($LIST=mysql_fetch_array($SQL_QRY)):
  $Picture = explode("|", $LIST[Picture]);
	$VIEW_LINK = "$PHP_SELF?query=view&code=$LIST[Category]&no=$LIST[UID]&ArrangeBy=$ArrangeBy&Brand=$Brand&ListNo=$ListNo&mid_cate=$mid_cate&small_cate=$small_cate";

?>
                            <td width="130" height="170"><table width="130" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="120" align="center" valign="middle"><table width="100" height="100" border="1" cellpadding="0" cellspacing="0" bordercolor="#EBEBEB">
                                      <tr>
                                        <td align="center" valign="top"><a href=<? echo $VIEW_LINK;?> ><img src=<? echo $STOCK_FOLDER_NAME; ?>/<?=$Picture[0]?> width="<? echo $SIMAGEW; ?>" height = "<? echo $SIMAGEH; ?>"  border="0"></a></td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr>
                                  <td height="60" align="center" valign="top">
                                    <table width = 80%>
                                      <tr>
                                        <td style="word-break:break-all;">
																				<input type="checkbox" name="mall_chk[<?=$LIST[UID]?>]" value="1" <?
																					$tmpCartFlag = true;
																				 	foreach($OptionName as $key => $value){
																					if($LIST[$key]) :
																							if($OptionName[$key][1] == "checked"):// ����Ʈ �ڽ��̰� ���� ���� �ϸ� īƮ�� �ٷ� ���� �ʴ´�.
																								$Option = split("\n", $LIST[$key]);
																								for($i = 0; $i < sizeof($Option) && $Option[$i]; $i++) {// ���� ����
																									$tmpCartFlag = false;
																								}
																							endif;
																					endif;
																					}
																				 if(!strcmp($LIST[None],"checked") || $tmpCartFlag == false) echo "disabled";?>><input type="hidden" name="GoodsPrice_<?=$LIST[UID]?>" value="<?=$LIST[Price]?>"><input type="hidden" name="GoodsPoint_<?=$LIST[UID]?>" value="<?=$LIST[Point]?>"><input type="hidden" name="BUYNUM_<?=$LIST[UID]?>" value="1">
																				<a href=<? echo $VIEW_LINK;?> class="link_gray">
                                          <? echo $LIST[Name]; ?></a> </td>
                                      </tr>
																			<tr>
																				<td align = center class="green-b">
                                          <?=number_format($LIST[Price])?>
                                          ��</td>
																			</tr>
																			<tr>
																				<td align = center><?
																				$n = 1 ;
																				$Option3 = explode("|" , $LIST[Option3]);
																				for($i = 0 ; $i < sizeof($Option3) ; $i++){
																					if($Option3[$i] !="N"){
																						echo $OPTION_IMAGE_ARRAY[$Option3[$i]] ;
																						if(!($n%3)) echo "<br>";
																					}
																				$n++;
																				}
																				if($LIST[None] == "checked") echo $OPTION_IMAGE_ARRAY[NONE];
																				?>  </td>
																			</tr>
                                    </table></td>
                                </tr>
                              </table></td>
                            <?
$NO++;
if($NO%$BreakListNo != $BreakListNo-1 ) echo "<td width=5></td>";
if(!($NO%$BreakListNo)) echo "</tr><tr align='center' valign='top'><td colspan = 10 height = 10></td></tr><tr><td height = 1 bgcolor='DBDBDB' colspan = 10></td></tr><tr align='center' valign='top'>";

endwhile;
?>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td height="20"></td>
              </tr>
              <tr>
                <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr align="left" valign="top" bgcolor="#E9F5E5">
                      <td width="8" height="8"><img src="<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/box02_01.gif" width="8" height="8"></td>
                      <td></td>
                      <td width="8"><img src="<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/box02_02.gif" width="8" height="8"></td>
                    </tr>
                    <tr align="left" valign="top" bgcolor="#E9F5E5">
                      <td height="26"></td>
                      <td align="center" valign="middle">
<?
$TransData = "code=$code&ArrangeBy=$ArrangeBy&Brand=$Brand&ListNo=$ListNo&mid_cate=$mid_cate&small_cate=$small_cate#P";
include "${SKIN_FOLDER_NAME}/page/${PageSkin}/index.php" ;
?>
                      </td>
                      <td></td>
                    </tr>
                    <tr align="left" valign="top" bgcolor="#E9F5E5">
                      <td height="8"><img src="<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/box02_04.gif" width="8" height="8"></td>
                      <td></td>
                      <td><img src="<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/box02_03.gif" width="8" height="8"></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td height="50" align="right" valign="middle"><input type="image" src="<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/btn_cart.gif" border="0"> </td>
              </tr></form>
            </table></td>
        </tr>
      </table></td>
    <td background="<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/sub_box01_04.gif"></td>
  </tr>
  <tr align="left" valign="top">
    <td width="10" height="10"><img src="<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/sub_box01_07.gif" width="10" height="10"></td>
    <td background="<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/sub_box01_06.gif"></td>
    <td><img src="<? echo $SKIN_FOLDER_NAME; ?>/shop/<?=$ShopSkin?>/images/sub_box01_05.gif" width="10" height="10"></td>
  </tr>
</table>
<script>
<!--
function cmp(f){

	var i = 0;
	var chked = 0;
	for(i = 0; i < f.length; i++ ) {
		if(f[i].type == 'checkbox') {
			if(f[i].checked) {
				chked++;
			}
		}
	}
	if( chked < 1 ) {
		alert('��ٱ��Ͽ� ���� ��ǰ�� ������ �ּ���.');
		return false;
	}
}

function allcheck(f)
{
  for (var i=0; i<f.elements.length; i++)
  {
	if (f.elements[i].name.indexOf('mall_chk')!=-1 && f.elements[i].disabled == false) f.elements[i].checked = document.NaviFrm.CheckAll.checked;
  }
}

//-->
</script>
<?
//ī�װ� ���� �з����� ����� ���ǰ� �Ǿ��־�� �Ʒ��� ���� ����ȴ�.
echo stripslashes($codelist[cat_bottom]);
//ī�װ� ���� �з����� ����� ���ǰ� �Ǿ��־�� ���� ���� ����ȴ�.
?>
