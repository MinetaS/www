
<SCRIPT LANGUAGE=javascript>
<!--
function num_plus(num){
        gnum = parseInt(num.BUYNUM.value);
        num.BUYNUM.value = gnum + 1;
        return;
}
function num_minus(num){
        gnum = parseInt(num.BUYNUM.value);
        if( gnum > 1 ){
                num.BUYNUM.value = gnum - 1;
        }
        return;
}
function really(){
	if (confirm('\n\n������ ��ٱ��ϸ� ��� ���ðڽ��ϱ�?\n\n')) return true;
	return false;
}
//-->
</SCRIPT>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="3"  bgcolor="909090"></td>
  </tr>
  <tr> 
    <td height="3" align="left"><table width="100%" height="30" border="0" cellpadding="0" cellspacing="0" bgcolor="F6F6F6">
        <tr> 
          <td width="97" align="center" valign="middle" class="333333_b">��ǰ</td>
          <td width="3" align="center" valign="top"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/bar01.gif" width="3" height="5"></td>
          <td  align="center" valign="middle" bgcolor="F6F6F6" class="333333_b">��ǰ��</td>
          <td width="3" align="center" valign="top"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/bar01.gif" width="3" height="5"></td>
          <td width="77"  align="center" valign="middle" class="333333_b">�հ�</td>
          <td width="3" align="center" valign="top"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/bar01.gif" width="3" height="5"></td>
          <td width="77"  align="center" valign="middle" class="333333_b">����</td>
          <td width="3" align="center" valign="top"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/bar01.gif" width="3" height="5"></td>         
          <td width="77"  align="center" valign="middle" class="333333_b">������</td>
          <td width="3"  align="center" valign="top" class="333333_b"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/bar01.gif" width="3" height="5"></td>
          <td width="37"  align="center" valign="middle" class="333333_b">����</td>
          <td width="3"  align="center" valign="top" class="333333_b"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/bar01.gif" width="3" height="5"></td>
          <td width="37"  align="center" valign="middle" class="333333_b">���</td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="4" ></td>
  </tr>
  <tr> 
    <td height="1" bgcolor="#C7C7C7"></td>
  </tr>
  <tr> 
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
<?
$TotalUnit = 0;//�ѱ��ż���
//��ȣ|���ż���|����|����Ʈ|�ɼ�1|�ɼ�2|�ɼ�4|�ɼ�5
// 0  |    1   |  2 |   3  |  4  |  5  |  6  |  7 
// �ɼ��� 4�� ���� 

if (file_exists("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi")) {
			$Cart_Data = file("./${MEMBER_TEMP_FOLDER_NAME}/mall_buyers/$_COOKIE[CART_CODE].cgi");
			for($i = 0; $i < sizeof($Cart_Data) && trim($Cart_Data[$i]); $i++) {
				$C_dat = explode("|", chop($Cart_Data[$i]));
				
				$CartNo =  $C_dat[0] ; // ��ǰ ��ȣ 
				$CartCnt =  $C_dat[1] ; // ��ǰ ����
				$CartPrice =  $C_dat[2] ; // ��ǰ ���� (ǰ�� �ϳ��� �ջ� ����)
				$CartPoint =  $C_dat[3] ; // ��ǰ ����Ʈ(ǰ�� �ϳ��� �ջ� ����Ʈ)
				$CartTmpOpt1  = $C_dat[4] ; // Option1
				$CartTmpOpt2  = $C_dat[5] ; // Option2
				$CartTmpOpt3  = $C_dat[6] ; // Option4
				$CartTmpOpt4  = $C_dat[7] ; // Option5
									
				$Total_QTY += $CartCnt;
				
				$VIEW_QUERY = "SELECT * FROM ${MALL_TABLE_NAME} WHERE UID='$CartNo'";
				
				$LIST = mysql_fetch_array(mysql_query($VIEW_QUERY, $DB_CONNECT));
				$Picture = explode("|", $LIST[Picture]);
				$VIEW_LINK = "${MART_MAIN_FILE_NAME}?query=view&code=$LIST[Category]&no=$LIST[UID]'";
			
				$SUM_MONEY = $CartPrice * $CartCnt;
				$SUM_POINT = $CartPoint * $CartCnt;				
				
				
				$TOTAL_MONEY += $SUM_MONEY ;
				$TOTAL_POINT += $SUM_POINT ;												
		
?>	
        <FORM name='view_form<? echo $i;?>' ACTION='<? echo $_SERVER['PHP_SELF']; ?>'>
          <INPUT TYPE=HIDDEN NAME='query' VALUE='modify'>
          <INPUT TYPE=HIDDEN NAME='value' VALUE='<? echo urlencode("$LIST[UID]^$CartTmpOpt1^$CartTmpOpt2^$CartTmpOpt3^$CartTmpOpt4") ;?>'>
          <tr> 
            <td width="97" height="72" align="center"><table width="65" border="0" cellpadding="0" cellspacing="1" bgcolor="dddddd">
                <tr> 
                  <td align="center" valign="top" bgcolor="#FFFFFF"><A HREF='<? echo ${MART_MAIN_FILE_NAME}; ?>?code=<?=$LIST[Category]?>&query=view&no=<?=$LIST[UID]?>'><IMG SRC='<? echo $STOCK_FOLDER_NAME; ?>/<?=$Picture[0]?>' WIDTH='60' HEIGHT='60' BORDER=0></A></td>
                </tr>
              </table></td>
            <td><A HREF='<? echo ${MART_MAIN_FILE_NAME}; ?>?code=<?=$LIST[Category]?>&query=view&no=<?=$LIST[UID]?>'> 
              <?=$LIST[Name]?>
              </A> <br>
<?
				for($k = 4 ; $k < 8  ; $k++ ){// �ɼǿ� ���� �ִ�  ���� ��ŭ						
						
						if($C_dat[$k]){

						if($C_dat[$k]) $OptionTitle = 	"<font color = '009077'>" . $OptionName[key($OptionName)][0] . "</font> ";// �ɼ� �̸�									
						
						if(ereg("=" , trim($C_dat[$k])))  {// �ɼ��߿� ���� �ɼ��� �ִ� ��츸 �ѷ��ش�.
							$tmpOptionValue = explode("=" , trim($C_dat[$k]));																	
							if(intval($tmpOptionValue[1]) > 0) $tmpPrefix = " �߰�" ;
							else $tmpPrefix = " ����" ;						
							echo  $OptionTitle . trim($tmpOptionValue[0]). "  " . $tmpOptionValue[1] . " $tmpPrefix <br>" ;
						}else{		
							echo  $OptionTitle  . " $C_dat[$k] <br>" ;
						}
						next($OptionName); 
						}
													
				}
				reset($OptionName);// ����Ʈ ����

?>
            </td>
            <td width="83" align="center"> 
              <?=number_format($CartPrice * $CartCnt)?>
        ��
				<INPUT TYPE=HIDDEN NAME='GoodsPrice' VALUE='<?=$CartPrice?>'>
				<INPUT TYPE=HIDDEN NAME='GoodsPoint' VALUE='<?=$CartPoint?>'>
				</td>
            <td width="76" align="center"><table width="65" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td> <INPUT TYPE=TEXT SIZE=5 NAME='BUYNUM' MAXLENGTH=3 VALUE='<?=$CartCnt?>' <? echo $ONLY_NUMBER_STYLE; ?> class="input2"></td>
                  <td align="center"><table width="15" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td align="center"><A href='javascript:num_plus(document.view_form<?echo $i;?>);'><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/btn_up.gif" width="9" height="7" border="0"></a></td>
                      </tr>
                      <tr> 
                        <td align="center"><A href='javascript:num_minus(document.view_form<?echo $i;?>);'><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/btn_down.gif" width="9" height="7" border="0"></a></td>
                      </tr>
                    </table></td>
                  <td>�� </td>
                </tr>
              </table></td>            
            <td width="82" align="center"><? echo number_format($CartPoint * $CartCnt);?> Point</td>
            <td width="37" align="center"><input type = "image" src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/btn_modify.gif" width="13" height="13"></td>
            <td width="43" align="center"><A HREF='./<? echo ${CART_MAIN_FILE_NAME}; ?>?query=delete&value=<? echo urlencode("$LIST[UID]^$CartTmpOpt1^$CartTmpOpt2^$CartTmpOpt3^$CartTmpOpt4") ;?>'><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/btn_del.gif" width="21" height="13" border = 0></a></td>
          </tr>
          <tr> 
            <td background="/image/dot_line_02.gif" height="1" colspan="8" align="center"> 
            </td>
          </tr>
        </form>
        <?
					$TotalUnit++;
        }   // for

}       // if

?>
        <BR>
      </table></td>
  </tr>
  <tr> 
    <td height="2"> </td>
  </tr>
  <tr> 
    <td height="1" bgcolor="B2B2B2"> </td>
  </tr>
</table>
<?
if ($TOTAL_MONEY) { // ��ٱ��ϰ� �������

/* ��ۺ� ������ ���� vat�� ������ ��� �� �κ��� ���� ����Ѵ�. */
if($VAT_ENABLE == "checked"){
$TOTAL_MONEY += $TOTAL_MONEY*$VAT_MONEY/100;
$VAT_REAL_MONEY = $VAT_MONEY;
}


// �ù� MONEY �ջ�
/* �ù�ɼ� : ENABLE : ���ݴ� �ù��, DISABLE : ����, ALL : ���ŷ�, �ݾװ������ �ù�� ����, PER : ������ ���� */
//if($TOTAL_MONEY >= $TACKBAE_CUTLINE) $TACKBAE_MONEY = 0;

if($TOTAL_MONEY < $TACKBAE_CUTLINE && $TACKBAE_ALL == "ENABLE"){
$TOTAL_MONEY = $TOTAL_MONEY + $TACKBAE_MONEY;
$TACKBAE_REAL_MONEY = $TACKBAE_MONEY;
}

if($TACKBAE_ALL == "ALL" ){
$TOTAL_MONEY = $TOTAL_MONEY + $TACKBAE_MONEY;
$TACKBAE_REAL_MONEY = $TACKBAE_MONEY;
}

?>
<br>
<table width="100%" border="3" cellpadding="0" cellspacing="0" bordercolor="EEEEEE">
  <tr> 
    <td height="30" align="right" bgcolor="FFFFFF">
		<? 
		
			
		if($VAT_REAL_MONEY > 0 ){
			echo "<span class = orange-b-02>VAT : $VAT_MONEY% </span>";
		}
		
		if($TOTAL_POINT > 0) {
		echo "<img src=$SKIN_FOLDER_NAME/cart/$CartSkin/images/point_cost_image.gif align = absmiddle> <span class = orange-b-02>".number_format($TOTAL_POINT)." Point</span>&nbsp;&nbsp;";
		} 
		if($TACKBAE_MONEY > 0){
		echo "<img src=$SKIN_FOLDER_NAME/cart/$CartSkin/images/delivery_cost_image.gif align = absmiddle> <span class = green-b>".number_format($TACKBAE_MONEY)." ��</span>";
		}
		?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/cart_img_01.gif" width="77" height="19" align = absmiddle> 
      <span class = "red-b"><? echo  number_format($TOTAL_MONEY);?> ��</span>
			</td>
  </tr>
</table>
<?

} else if(!$TotalUnit) { // ��ٱ��ϰ� �������

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="30" align="center" bgcolor="f5f5f5" class="333333">��ٱ��ϰ� ����ֽ��ϴ�.</td>
  </tr>
  <tr> 
    <td height="1" align="right" bgcolor="B2B2B2"> </td>
  </tr>
</table>
<br>
<? } ?>
