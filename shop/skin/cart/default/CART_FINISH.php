<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<?
		$sql = "SELECT * FROM ${BUYER_TABLE_NAME} WHERE CODE_VALUE='$cod'";	

		$Cart_List = _mysql_fetch_array($sql);	   
		$Inputer = stripslashes($Cart_List[Inputer]);
		$Sender_Name = stripslashes($Cart_List[Sender_Name]);
		$Sender_Company = stripslashes($Cart_List[Sender_Company]);
		$PWD = stripslashes($Cart_List[PWD]);			 
		$Sender_Email = stripslashes($Cart_List[Sender_Email]);	   
		$Sender_Tel = stripslashes($Cart_List[Sender_Tel]);
		$Sender_Hand = stripslashes($Cart_List[Sender_Hand]);	   
		$Re_Name = stripslashes($Cart_List[Re_Name]);	   
		$Re_Tel = stripslashes($Cart_List[Re_Tel]);		
		$Re_Hand = stripslashes($Cart_List[Re_Hand]);
		$Re_Email = stripslashes($Cart_List[Re_Email]);		
		$Zip1 = explode("-" , $Cart_List[Zip1]);
		$Zip2 = explode("-" , $Cart_List[Zip2]);			 

		$Address1 = stripslashes($Cart_List[Address1]);
		$Address2 = stripslashes($Cart_List[Address2]);
		$Address3 = stripslashes($Cart_List[Address3]);
		$Address4 = stripslashes($Cart_List[Address4]);


		$Message = nl2br(stripslashes($Cart_List[Message]));
		$PayType = $Cart_List[How_Buy]; // ���� ���
		$BANK = stripslashes($Cart_List[How_Bank]);
		$BuyDate = $Cart_List[BuyDate];
		$WishDate = date("Y�� m�� d��" , $Cart_List[WishDate]);
		$PayDate = $Cart_List[PayDate];

		$Point_Money = $Cart_List[Point_Money];// ����Ʈ ����
		$Pay_Money = $Cart_List[Pay_Money]; // ���� ������
		$Delivery_Money = $Cart_List[Delivery_Money]; // �ù��
		$Total_Money = $Cart_List[Total_Money]; // �Ѿ�
			 

?>
<table width="690" border="0" cellspacing="0" cellpadding="0">
  <tr align="left" valign="top"> 
    <td height="10" colspan="3"> </td>
  </tr>
  <tr align="left" valign="top"> 
    <td height="5" colspan="3"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/cart_top_img_02.gif" width="690" height="100"></td>
  </tr>
  <tr align="left" valign="top"> 
    <td style="background-image: url(<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/sub_box01_08.gif);background-repeat:repeat-y;"></td>
    <td align="center"><table width="670" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="10"></td>
        </tr>
        <tr> 
          <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="50%" align="left" valign="middle"><table border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td align="left" valign="middle"  style="font-size:12px; font-weight:bold; color='#218EAD'"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/bullet1.gif" width="12" height="14" align="absmiddle">&nbsp;�ֹ���Ȯ�� 
                      </td>
                    </tr>
                  </table></td>
                <td width="50%" align="right" valign="middle" class="666666_s">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="10"></td>
        </tr>
        <tr> 
          <td height="5" background="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/customer/bar01.gif"> 
          </td>
        </tr>
        <tr> 
          <td height="20" align="left" valign="middle"> 
            <? 
// ��ٱ��� ����
include "${SKIN_FOLDER_NAME}/cart/$CartSkin/CART_VIEW.php";
?>
          </td>
        </tr>
        <tr> 
          <td height="20" align="center" valign="top"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="25" valign="top"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/cart_t_06.gif" width="84" height="16"></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td height="3"  bgcolor="909090"></td>
                          </tr>
                          <tr> 
                            <td height="3" align="left"><table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="F6F6F6">
                                <tr> 
                                  <td width="115" height="30" valign="middle" class="333333_b"> 
                                    &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                    �ֹ���ȣ</td>
                                  <td bgcolor="ffffff"><? echo $cod; ?> (��� ��ȸ�� 
                                    �ʿ� �մϴ�)</td>
                                </tr>
                                <tr bgcolor="#C7C7C7"> 
                                  <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                  </td>
                                </tr>
                                <tr> 
                                  <td height="30" valign="middle" class="333333_b"> 
                                    &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                    �ֹ��Ͻôº� </td>
                                  <td bgcolor="ffffff"><? echo $Sender_Name; ?></td>
                                </tr>
                                <tr bgcolor="#C7C7C7"> 
                                  <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                  </td>
                                </tr>
                                <tr> 
                                  <td height="30" valign="middle" class="333333_b"> 
                                    &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                    ȸ��/�μ��� </td>
                                  <td bgcolor="ffffff"><? echo $Sender_Company; ?></td>
                                </tr>
                                <tr bgcolor="#C7C7C7"> 
                                  <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                  </td>
                                </tr>
                                <? if(!isMember()){?>
                                <tr> 
                                  <td height="30" valign="middle" class="333333_b"> 
                                    &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                    ��ȣ </td>
                                  <td bgcolor="ffffff"><? echo $PWD; ?></td>
                                </tr>
                                <tr bgcolor="#C7C7C7"> 
                                  <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                  </td>
                                </tr>
                                <? } ?>
                                <tr> 
                                  <td height="30" valign="middle" class="333333_b"> 
                                    &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                    ��ȭ��ȣ </td>
                                  <td bgcolor="ffffff"><? echo $Sender_Tel ;?></td>
                                </tr>
                                <tr bgcolor="#C7C7C7"> 
                                  <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                  </td>
                                </tr>
                                <tr> 
                                  <td height="30" valign="middle" class="333333_b"> 
                                    &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                    �޴���ȭ </td>
                                  <td bgcolor="ffffff"><? echo $Sender_Hand ;?></td>
                                </tr>
                                <tr bgcolor="#C7C7C7"> 
                                  <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                  </td>
                                </tr>
                                <tr> 
                                  <td height="30" valign="middle" class="333333_b"> 
                                    &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                    �̸��� </td>
                                  <td bgcolor="ffffff"><? echo $Sender_Email;?></td>
                                </tr>
                                <tr bgcolor="#C7C7C7"> 
                                  <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                  </td>
                                </tr>
                                <tr> 
                                  <td height="30" valign="middle" class="333333_b"> 
                                    &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                    �ּ� </td>
                                  <td bgcolor="ffffff"><? echo "$Zip1[0]-$Zip1[1] $Address1 $Address2"; ?></td>
                                </tr>
                                <tr bgcolor="#C7C7C7"> 
                                  <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                  </td>
                                </tr>
                                <tr> 
                                  <td height="30" valign="middle" class="333333_b"> 
                                    &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                    �������� </td>
                                  <td bgcolor="ffffff"><? echo $WishDate; ?></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr> 
                            <td height="2" bgcolor="909090"></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <br> <br> <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="25" valign="top"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/cart_t_07.gif" width="84" height="16"></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td height="3"  bgcolor="909090"></td>
                          </tr>
                          <tr> 
                            <td height="3" align="left"><table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="F6F6F6">
                                <tr> 
                                  <td width="115" height="30" valign="middle" class="333333_b"> 
                                    &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                    �޴º� </td>
                                  <td bgcolor="ffffff"><? echo $Re_Name; ?></td>
                                </tr>
                                <tr bgcolor="#C7C7C7"> 
                                  <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                  </td>
                                </tr>
                                <tr> 
                                  <td height="30" valign="middle" class="333333_b"> 
                                    &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                    ��ȭ��ȣ </td>
                                  <td bgcolor="ffffff"><? echo $Re_Tel ;?></td>
                                </tr>
                                <tr bgcolor="#C7C7C7"> 
                                  <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                  </td>
                                </tr>
                                <tr> 
                                  <td height="30" valign="middle" class="333333_b"> 
                                    &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                    �޴���ȭ </td>
                                  <td bgcolor="ffffff"><? echo $Re_Hand; ?></td>
                                </tr>
                                <tr bgcolor="#C7C7C7"> 
                                  <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                  </td>
                                </tr>
                                <tr> 
                                  <td height="30" valign="middle" class="333333_b"> 
                                    &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                    �̸��� </td>
                                  <td bgcolor="ffffff"><? echo $Re_Email;?></td>
                                </tr>
                                <tr bgcolor="#C7C7C7"> 
                                  <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                  </td>
                                </tr>
                                <tr> 
                                  <td height="30" valign="middle" class="333333_b"> 
                                    &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                    �ּ� </td>
                                  <td bgcolor="ffffff"><? echo "$Zip2[0]-$Zip2[1] $Address3 $Address4"; ?></td>
                                </tr>
                                <tr bgcolor="#C7C7C7"> 
                                  <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                  </td>
                                </tr>
                                <tr> 
                                  <td height="30" valign="middle" class="333333_b"> 
                                    &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                    ����Ǹ���</td>
                                  <td bgcolor="ffffff"><? echo $Message; ?></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr> 
                            <td height="2" bgcolor="909090"></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <br> <br> <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="25" valign="top"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/cart_t_09.gif" width="84" height="16"></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td height="3"  bgcolor="909090"></td>
                          </tr>
                          <tr> 
                            <td height="3" align="left"><table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="F6F6F6">
                                <tr> 
                                  <td height="30" valign="middle" class="333333_b"> 
                                    &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                    ������� </td>
                                  <td bgcolor="ffffff"><? echo $ORDER_METHOD_ARRAY[$PayType]; ?> ���� </td>
                                </tr>
                                <tr bgcolor="#C7C7C7"> 
                                  <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                  </td>
                                </tr>
																<tr> 
                                  <td width="115" height="30" valign="middle" class="333333_b"> 
                                    &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                    �ֹ��ݾ� </td>
                                  <td bgcolor="ffffff"><? echo number_format($TOTAL_MONEY); ?> 
                                    ��</td>
                                </tr>
                                <tr bgcolor="#C7C7C7"> 
                                  <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                  </td>
                                </tr>
                                <? if($Point_Money):?>
                                <tr> 
                                  <td height="30" valign="middle" class="333333_b"> 
                                    &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                    �������Ʈ </td>
                                  <td bgcolor="ffffff"><? echo number_format($Point_Money); ?> 
                                    Point</td>
                                </tr>
                                <tr bgcolor="#C7C7C7"> 
                                  <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                  </td>
                                </tr>
                                <? endif;?>
                                
                                <tr> 
                                  <td height="30" valign="middle" class="333333_b"> 
                                    &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                    �����ݾ� </td>
                                  <td bgcolor="ffffff"><? echo number_format($Pay_Money); ?> 
                                    ��</td>
                                </tr>
                                <tr bgcolor="#C7C7C7"> 
                                  <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                  </td>
                                </tr>
                                <? if ($PayType == "bank") :?>
                                <tr> 
                                  <td height="28" valign="middle" class="333333_b"> 
                                    &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                    ���༱�� </td>
                                  <td bgcolor="ffffff"><? echo $BANK; ?></td>
                                </tr>
                                <tr bgcolor="#C7C7C7"> 
                                  <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                  </td>
                                </tr>
                                <tr> 
                                  <td height="30" valign="middle" class="333333_b"> 
                                    &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                    �Ա��ڸ� </td>
                                  <td bgcolor="ffffff"><? echo $Inputer; ?></td>
                                </tr>
                                <tr bgcolor="#C7C7C7"> 
                                  <td height="1" colspan="2" valign="middle" class="333333_b"> 
                                  </td>
                                </tr>
                                <tr> 
                                  <td height="30" valign="middle" class="333333_b"> 
                                    &nbsp;<img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/dot_blue.gif" width="3" height="3" vspace="3"> 
                                    �Աݿ����� </td>
                                  <td bgcolor="ffffff"><? echo date("Y �� m �� d ��",$PayDate); ?></td>
                                </tr>
                                <? endif;?>
                              </table></td>
                          </tr>
                          <tr> 
                            <td height="2" bgcolor="909090"></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <br> <br> <table border="0" cellspacing="0" cellpadding="0">
              <tr align="center"> 
                <td width="112"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/btn_order_ok.gif" width="102" height="27" border="0" onclick="javascript:location.replace('<? echo $CART_MAIN_FILE_NAME; ?>?query=step4&CODE_VALUE=<?=$cod?>')" style="cursor:hand"></td>
                <td width="112"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/btn_cancle_02.gif" width="102" height="27" border="0"  onclick="javascript:location.replace('<? echo $CART_MAIN_FILE_NAME; ?>?query=step2&cod=<?=$cod?>')" style="cursor:hand"></td>
              </tr>
            </table>
            <br></td>
        </tr>
        <tr> 
          <td height="50" align="center" valign="top">&nbsp;</td>
        </tr>
      </table></td>
    <td width="10" background="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/sub_box01_04.gif"></td>
  </tr>
  <tr align="left" valign="top"> 
    <td width="10" height="10"><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/sub_box01_07.gif" width="10" height="10"></td>
    <td background="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/sub_box01_06.gif"></td>
    <td><img src="<? echo $SKIN_FOLDER_NAME; ?>/cart/<?=$CartSkin?>/images/sub_box01_05.gif" width="10" height="10"></td>
  </tr>
</table>
