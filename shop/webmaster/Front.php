<?
include ("./ROOT_CHECK.php");
/*
���� ��Ȳ
*/

######################## �ʿ��� ���� ##############################
$hdd_total = $SYSTEM_HDD_SIZE; //�ϵ��ũ�뷮�� �Է��ϼ���. MB������ �Է��ϼž� �մϴ�
$db_total = $SYSTEM_DB_SIZE;  //��� �뷮�� �Է��ϼ���.     MB������ �Է��ϼž� �մϴ�.


//�Ʒ��� ������ ������ �ּ���.
//hdd config...
$DROOT = "../";
$hdd_using = `du -sh ${DROOT}`; //������ �ö� ������ �뷮�� �����ϰ� �˴ϴ�.
$a = explode("/" , $hdd_using);
$hdd_using = $a[0]*1024*1024;

$hdd_total = $hdd_total*1024*1024; //MB -> Byte
$hdd_free = $hdd_total-$hdd_using;
$r_hdd_using = sprintf("%0.1f",$hdd_using/$hdd_total*100);
$r_hdd_free = 100-$r_hdd_using;


//�� �Ʒ����ʹ� ������ �κ��� �����ϴ�.
$db_total = $db_total*1024*1024; //MB -> Byte


//��ü���̺���Ȳ�� �ҷ����� ������
$result = mysql_query("SHOW TABLE STATUS");
$db_using = 0;
while($dbData=mysql_fetch_array($result)) {
	$db_using += $dbData[Data_length]+$dbData[Index_length];
}

$db_free = $db_total-$db_using;
$r_db_using = sprintf("%0.1f",$db_using/$db_total*100);
$r_db_free = 100-$r_db_using;


//����ũ�⸦ KB, MB, etc ��ȯ�ؼ� ����
function size($size)
{
	if(!$size) return "0 Byte";
	if($size<1024)
		{
			return ($size." Byte");
		}
	elseif($size >1024 && $size< 1024 *1024)
		{
			return sprintf("%0.1f KB",$size / 1024);
		}
	else return sprintf("%0.1f MB",$size / (1024*1024));
}

/*
���θ� ��Ȳ
*/
$FromDate = mktime (0,0,0, date("m"),date("d"),date("Y"));
$ToDate = mktime (23,59,59, date("m"),date("d"),date("Y"));

$WHEREIS = "WHERE ( BuyDate >= '$FromDate' AND BuyDate <= '$ToDate' )  AND Co_Now<>'50' AND Co_Del=''";
$COUNT_ARRAY = mysql_fetch_array(mysql_query( "SELECT count(*),SUM(Total_Money) FROM ${BUYER_TABLE_NAME} $WHEREIS"));
$TODAY_ORDER_NUM = $COUNT_ARRAY[0];
$TODAY_ORDER_MONEY = $COUNT_ARRAY[1];
$LIST_QUERY = "SELECT * FROM ${BUYER_TABLE_NAME} $WHEREIS ORDER BY UID DESC LIMIT 5";
$TABLE_DATA = mysql_query($LIST_QUERY);

// ���� ��� ȸ��
$MWHEREIS = "WHERE RegDate >= '$FromDate' AND RegDate <= '$ToDate'  ";
$COUNT_ARRAY = mysql_fetch_array(mysql_query( "SELECT count(*) FROM ${MEMBER_TABLE_NAME} $MWHEREIS"));
$TODAY_MEMBER_NUM = $COUNT_ARRAY[0];
$MEMBER_QUERY = "SELECT * FROM ${MEMBER_TABLE_NAME} $MWHEREIS ORDER BY UID DESC LIMIT 5";
$MEMBER_DATA = mysql_query($MEMBER_QUERY);


$BUY_COUNT_ARRAY = mysql_fetch_array(mysql_query( "SELECT SUM(OutPut),sum(Hit) FROM ${MALL_TABLE_NAME}"));
$TOTAL_BUY_NUM = $BUY_COUNT_ARRAY[0];
$TOTAL_HIT_NUM = $BUY_COUNT_ARRAY[1];
if ($TOTAL_BUY_NUM && $TOTAL_HIT_NUM){
$HIT_BUY_PER = intval(($TOTAL_BUY_NUM/$TOTAL_HIT_NUM)*100);
}
else {
$HIT_BUY_PER = 0;
}
$BUY_MONEY_ARRAY = mysql_fetch_array(mysql_query( "SELECT SUM(Total_Money) FROM ${BUYER_TABLE_NAME} WHERE Co_Now='50' AND Co_Del=''" ));
$TOTAL_BUY_MONEY = $BUY_MONEY_ARRAY[0];
$PLIST_QUERY = "SELECT * FROM ${MALL_TABLE_NAME} ORDER BY UID DESC LIMIT 6";
$PTABLE_DATA = mysql_query($PLIST_QUERY);
$ATOTAL_QUERY = mysql_query( "SELECT count(*) FROM ${BUYER_TABLE_NAME} WHERE Co_Now='50' AND Co_Del=''" );
$ATOTAL_ARRAY = mysql_fetch_array($ATOTAL_QUERY);
$TOTAL_DATA_NUM = $ATOTAL_ARRAY[0];
$DAY_MONEY = 0;
$MONTH_MONEY = 0;
?>
<table width="735" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td <? echo $CONTENT_STYLE; ?>> <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="760" height="100%" align="center" valign="top"> <table width=100% cellpadding="5" cellspacing="1"  border=0 align="center" <? echo $TABLE_STYLE; ?>>
<tr>
                <td <? echo $CONTENT_STYLE; ?>> <table width=100% cellspacing=0 cellpadding=1 border=0>
                    <tr>
                      <td height="15" valign=top <? echo $TITLE_STYLE ; ?>><? echo $ADMIN_TITLE ; ?> ������Ȳ</td>
                    </tr>
                    <tr>
                      <td height="50" <? echo $CONTENT_STYLE; ?>>
<div align="center">

				<b>*�ϵ��ũ</b>

				Total <?=size($hdd_total)?> | Using <font color="#000000"><?=size($hdd_using)?>(<?=$r_hdd_using?>%)</font> | Free <font color="#000000"><?=size($hdd_free)?></font><br>


                <table width="400" border="1" height="16" cellspacing="0" cellpadding="0" bordercolor="#AAAAAA" style=table-layout:fixed>
                  <tr>
                    <td width="<?=$r_hdd_using?>%" style="filter=progid:DXImageTransform.Microsoft.Gradient(GradientType=<SPAN class=font-color2>0</SPAN>, StartColorStr=#FFAA28, EndColorStr=#ffffff)">
                      </td>
					<td width="<?=$r_hdd_free?>%" bgcolor="#dcdcdc">
                      </td>
                  </tr>
                </table>

				<b>*�����ͺ��̽�</b>
				Total <?=size($db_total)?> | Using <font color="#000000"><?=size($db_using)?>(<?=$r_db_using?>%)</font> | Free <font color="#000000"><?=size($db_free)?></font>

                <table width="400" border="1" height="16" cellspacing="0" cellpadding="0" bordercolor="#AAAAAA" style=table-layout:fixed>
                  <tr>
                    <td width="<?=$r_db_using?>%" style="filter=progid:DXImageTransform.Microsoft.Gradient(GradientType=<SPAN class=font-color2>0</SPAN>, StartColorStr=#FFAA28, EndColorStr=#ffffff)">
                      </td>
					<td width="<?=$r_db_free?>%" bgcolor="#dcdcdc">
                      </td>
                  </tr>
                </table>
			</div>
											</td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td <? echo $CONTENT_STYLE; ?>>&nbsp;</td>
              </tr>
              <tr>
                <td <? echo $CONTENT_STYLE; ?>> <table width=100% cellspacing=0 cellpadding=1 border=0>
                    <tr>
                      <td height="15" valign=top <? echo $TITLE_STYLE ; ?>><? echo $ADMIN_TITLE ; ?> �ŷ���Ȳ</td>
                    </tr>
                    <tr>
                      <td height="50" <? echo $CONTENT_STYLE; ?>> <font color=GRAY>
                        �� �ŷ��Ǽ� : <font color=RED><B><? echo number_format($ATOTAL_ARRAY[0]);?>��</B></font>
                        | �Ѹ���� : <font color=RED><B><? echo number_format($BUY_MONEY_ARRAY[0]);?>��</B></font>
                        ( ����ո��� : <font color=#800000><B><? echo number_format($MONTH_MONEY);?>��</B></font>
                        | ������ո��� : <font color=#800000><B><? echo number_format($DAY_MONEY);?>��</B></font>
                        ) <BR>
                        ���Ӱǿ� ���� �Ǹż����� : <font color=RED><B><? echo $HIT_BUY_PER;?>%</B></font>
                        ( �� ��ȸ : <font color=#800000><B><? echo number_format($TOTAL_HIT_NUM);?>��</B></font>
                        | �� �Ǹŷ� : <font color=#800000><B><? echo number_format($TOTAL_BUY_NUM);?>
                        EA</B></font> ) </font> </td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td <? echo $CONTENT_STYLE; ?>>&nbsp;</td>
              </tr>
              <tr>
                <td align="center" <? echo $CONTENT_STYLE; ?>> <table width=740 cellspacing=0 cellpadding=1 border=0>
                    <tr>
                      <td valign=TOP>
                        <!---[�ֹ�����Ʈ����] ------------------------------------------------------------------------------------------->
                        <table width=100% cellpadding="5" cellspacing="1"  border=0 align="center" <? echo $TABLE_STYLE; ?>>
                          <tr>
                            <td <? echo $TITLE_STYLE ; ?>>&nbsp;����(<? echo date("Y�� m�� d��");?>)��
                              �ֹ�����Ʈ TOP 5</td>
                          </tr>
                        </table>
                        <table width=100% cellpadding="5" cellspacing="1"  border=0 align="center" <? echo $TABLE_STYLE; ?>>
                          <tr >
                            <td  colspan=5 align=center valign="top" <? echo $CONTENT_STYLE; ?>>
                              <table border="0" cellspacing="0" width="100%" <? echo $LEFT_STYLE; ?>>
                                <?
																	$oi = 0 ;
																	while( $LLIST = mysql_fetch_array( $TABLE_DATA ) ) :
																			$UID = $LLIST[UID];
																			$Address1 = explode(" ", $LLIST[Address1]);
																			$Total_Money = $LLIST[Total_Money];
																			$Co_Value = $LLIST[CODE_VALUE];

																			if (!$LLIST[ID]) $OrderID = "��ȸ��";
																			else $OrderID = $LLIST[ID];


																	?>
                                <tr>
                                  <td <? echo $CONTENT_STYLE; ?>
                                    <?=$Co_Value?>
                                     </td>
                                  <td <? echo $CONTENT_STYLE; ?>><?=$LLIST[Sender_Name]?> (<?=$OrderID?>)</td>
																	 <td <? echo $CONTENT_STYLE; ?>><font color=red><b>
                                    <? echo number_format($Total_Money);?> </b></font color=red>��</td>
                                  <td <? echo $CONTENT_STYLE; ?>> <? echo $ORDER_METHOD_ARRAY[$LLIST[How_Buy]] ;?>
                                  </td>
                                  <td <? echo $CONTENT_STYLE; ?>><font color=green>
                                    <? echo $Address1[0];?> </font></td>
                                  <td <? echo $CONTENT_STYLE; ?>><font color=brown>
                                    <? echo date("H��i��", $LLIST[BuyDate])?>
                                    </font></td>
                                </tr>
																<tr>
																	<td colspan = 100 height = 2 <? echo $CONTENT_STYLE; ?>></td>
																</tr>
                                <?
																$oi++;
																endwhile;?>
                                <? if ($oi == 0){?>
                                <tr>
                                  <td align="center" colspan="5">-
                                    ���� �ֹ������� �����ϴ�. -</td>
                                </tr>
                                <? } ?>
                              </table></td>
                          </tr>
                          <tr>
                            <td  width="77%" colspan=5 <? echo $CONTENT_STYLE; ?>><table border="0" cellspacing="0" width="100%" >
                                <tr height=23>
                                  <td colspan=4>&nbsp; <B>���� ���ֹ� : <font color=blue><?echo number_format($TODAY_ORDER_NUM);?></font>��
                                    | �ֹ��Ѿ� : <font color=red><?echo number_format($TODAY_ORDER_MONEY);?>��</font></B>
                                  </td>
                                  <td width="17%" colspan=1><img src='./img/btn_set/btn_more.gif' border=0>&nbsp;&nbsp;</td>
                                </tr>
                              </TABLE></td>
                          </tr>
                        </table>
                        <!---[�ֹ�����Ʈ��] ------------------------------------------------------------------------------------------->
                      </td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td <? echo $CONTENT_STYLE; ?>>&nbsp;</td>
              </tr>
              <tr>
                <td align="center" <? echo $CONTENT_STYLE; ?>> <table width=740 cellspacing=0 cellpadding=1 border=0>
                    <tr>
                      <td valign=top <? echo $CONTENT_STYLE; ?>>
                        <!---[����ȸ������Ʈ����] ----------------------------------------------------------------------------------------->
                        <table border="0" cellspacing="0" width="100%" >
                          <tr>
                            <td <? echo $TITLE_STYLE ; ?>>&nbsp;����(<? echo date("Y�� m�� d��");?>)��
                              ����ȸ������Ʈ TOP 5</td>
                          </tr>
                        </table>
                        <table width=100% cellpadding="5" cellspacing="1"  border=0 align="center" <? echo $TABLE_STYLE; ?>>
                          <tr>
                            <td  align=center valign="top" <? echo $CONTENT_STYLE; ?>>
                              <table width=100% cellpadding="5" cellspacing="1"  border=0 align="center" <? echo $LEFT_STYLE; ?>>
<?
$mi = 0 ;
while( $MLIST = mysql_fetch_array( $MEMBER_DATA ) ) :
?>
                                <tr height=26>
                                  <td width="19%"> &nbsp;<B><? echo "$MLIST[Name] ($MLIST[ID])";?></B></td>
                                  <td width="25%"><? echo $MLIST[Email]; ?>
                                    &nbsp; </td>
                                  <td width="36%">
                                    <? echo $MLIST[Address1]; ?>
                                  </td>
                                  <td width="20%" align=center><? echo date("Y-m-d H:i:s ", $MLIST[RegDate]);?></td>
                                </tr>
																<tr>
																	<td colspan = 100 height = 2 <? echo $CONTENT_STYLE; ?>></td>
																</tr>
                                <?
$mi++;
endwhile;
?>
                                <? if($mi == 0 ){ ?>
                                <tr>
                                  <td align="center" colspan="4">-
                                    ���� ȸ�������ڰ� �����ϴ�. -</td>
                                </tr>
                                <? } ?>
                              </table></td>
                          </tr>
                          <tr>
                            <td <? echo $CONTENT_STYLE; ?>><table border="0" cellspacing="0" width="100%" bordercolordark="white">
                                <tr height=23>
                                  <td width="83%" <? echo $CONTENT_STYLE; ?>>&nbsp; <B>����
                                    �Ѱ����� : <font color=blue> <? echo number_format($TODAY_MEMBER_NUM);?></font>��</B></td>
                                  <td width="17%" colspan=1><img src='./img/btn_set/btn_more.gif' border=0>&nbsp;&nbsp;</td>
                                </tr>
                              </table></td>
                          </tr>
                        </table>
                        <!---[����ȸ������Ʈ��] ----------------------------------------------------------------------------------------->
                      </td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td <? echo $CONTENT_STYLE; ?>>&nbsp;</td>
              </tr>
              <tr>
                <td align="center" <? echo $CONTENT_STYLE; ?>> <table width=740 cellspacing=0 cellpadding=1 border=0>
                    <tr>
                      <td valign=top <? echo $CONTENT_STYLE; ?>>
                        <!---��ǰ����� ----------------------------------------------------------------------------------------->
                        <table border="0" cellspacing="0" width="100%" >
                          <tr>
                            <td <? echo $TITLE_STYLE ; ?>>&nbsp;����(<? echo date("Y�� m�� d��");?>)��
                              ��ǰ�� TOP 5</td>
                          </tr>
                        </table>
                        <table width=100% cellpadding="5" cellspacing="1"  border=0 align="center" <? echo $TABLE_STYLE; ?>>
                          <tr>
                            <td  align=center valign="top" <? echo $CONTENT_STYLE; ?>>
                              <table width=100% cellpadding="5" cellspacing="1"  border=0 align="center" <? echo $LEFT_STYLE; ?>>
                                <?
// ���� �ö�� ��ǰ��
$EWHEREIS = " WHERE WDate >= '$FromDate' AND WDate <= '$ToDate' " ;
$TODAY_EVAL_NUM = getSingleValue("SELECT count(*) FROM ${EVALUATION_TABLE_NAME} $EWHEREIS");

$sql = "SELECT * FROM ${EVALUATION_TABLE_NAME} $EWHEREIS  ORDER BY UID DESC LIMIT 5" ;
$result = mysql_query($sql);
$ei = 0 ;
while( $ELIST = mysql_fetch_array( $result ) ) :
$sqlsubstr = "select UID, Picture, Name from ${MALL_TABLE_NAME} where UID = '$ELIST[GID]'";
$plist = _mysql_fetch_array($sqlsubstr);
$TmpPicture = $plist[Picture];
$GoodsName = $plist[Name];
$Picture = explode("|", $TmpPicture);
?>
                                <tr height=30>
                                  <td width="13%"><table width="99%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td align="center" <? echo $CONTENT_STYLE; ?>><img src="../<? echo ${STOCK_FOLDER_NAME}; ?>/<?=$Picture[0]?>" width="50" height="50" border = 0></td>
                                      </tr>
                                      <tr>
                                        <td align="center" <? echo $CONTENT_STYLE; ?>>
                                          <? echo $GoodsName?> </td>
                                      </tr>
                                    </table></td>
                                  <td width="16%" align=center> <? echo getMemberName($ELIST[ID]);?><br>
                                    <? echo $ELIST[ID]?> </td>
                                  <td width="57%" valign = top>
                                    <? if ($ELIST[Subject]) echo stripslashes($ELIST[Subject]) . "<br>";?>
                                    <? echo stripslashes($ELIST[Contents]);?> </td>
                                  <td width="14%" align=center class = star>
																	<?
																		$star_grade = "";
																		switch($ELIST[Grade]){
																		case "1": $star_grade = "�ڡ١١١�" ; break;
																		case "2": $star_grade = "�ڡڡ١١�" ; break;
																		case "3": $star_grade = "�ڡڡڡ١�" ; break;
																		case "4": $star_grade = "�ڡڡڡڡ�" ; break;
																		case "5": $star_grade = "�ڡڡڡڡ�" ; break;
																		}
																		echo $star_grade;
																	?>
                                  </td>
                                </tr>
																<tr>
																	<td colspan = 100 height = 2 <? echo $CONTENT_STYLE; ?>></td>
																</tr>
                                <?
$ei++;
endwhile;
?>
                                <? if($ei == 0 ){?>
                                <tr>
                                  <td align="center" colspan="4">-
                                    ���� ��ǰ���� �����ϴ�. - </td>
                                </tr>
                                <? } ?>
                              </table></td>
                          </tr>
                          <tr>
                            <td <? echo $CONTENT_STYLE; ?>><table border="0" cellspacing="0" width="100%" bordercolordark="white">
                                <tr height=23>
                                  <td width="83%" <? echo $CONTENT_STYLE; ?>>&nbsp; <B>����
                                    �ѵ�� ��ǰ�� : <font color=blue> <? echo number_format($TODAY_EVAL_NUM);?></font>��</B></td>
                                  <td width="17%" colspan=1><img src='./img/btn_set/btn_more.gif' border=0>&nbsp;&nbsp;</td>
                                </tr>
                              </table></td>
                          </tr>
                        </table>
                        <!---��ǰ��----------------------------------------------------------------------------------------->
                      </td>
                    </tr>
                  </table></td>
              </tr>

							<tr>
                <td <? echo $CONTENT_STYLE; ?>>&nbsp;</td>
              </tr>
              <tr>
                <td align="center" <? echo $CONTENT_STYLE; ?>> <table width=740 cellspacing=0 cellpadding=1 border=0>
                    <tr>
                      <td valign=top <? echo $CONTENT_STYLE; ?>>
                        <!---����Ʈ ����  ----------------------------------------------------------------------------------------->
                        <table border="0" cellspacing="0" width="100%" >
                          <tr>
                            <td <? echo $TITLE_STYLE ; ?>>&nbsp;����(<? echo date("Y�� m�� d��");?>)��
                              �� ����Ʈ TOP 5</td>
                          </tr>
                        </table>
                        <table width=100% cellpadding="5" cellspacing="1"  border=0 align="center" <? echo $TABLE_STYLE; ?>>
                          <tr>
                            <td  align=center valign="top" <? echo $CONTENT_STYLE; ?>>
                              <table width=100% cellpadding="5" cellspacing="1"  border=0 align="center" <? echo $LEFT_STYLE; ?>>
                                <?
// ���� ����Ʈ
$PWHEREIS = " WHERE WDate >= '$FromDate' AND WDate <= '$ToDate' " ;
$TODAY_POINT_NUM = getSingleValue("SELECT count(*) FROM ${POINT_TABLE_NAME} $PWHEREIS");
$TODAY_POINT_SUM = getSingleValue("SELECT SUM(POINT) FROM ${POINT_TABLE_NAME} $PWHEREIS");

$sql = "SELECT * FROM ${POINT_TABLE_NAME} $PWHEREIS ORDER BY UID DESC LIMIT 5 " ;
$result = mysql_query($sql);
$pi = 0 ;
while( $list = mysql_fetch_array( $result ) ) :
?>
                                <tr height=30>
                                  <td width="17%"><B><? echo getMemberName($list[ID]) . " ({$list[ID]})";?></B></td>
                                  <td width="46%"><? echo stripslashes($list[Content]); ?>
                                  </td>
                                  <td width="13%" align=center >
                                    <font color=C15B27><b><? echo $list[Point]; ?> Point</b></font>
                                  </td>
                                  <td width="24%" align=center ><? echo date("Y-m-d H:i:s" , $list[WDate] ); ?></td>
                                </tr>
                                <tr>
                                  <td colspan = 100 height = 2 <? echo $CONTENT_STYLE; ?>></td>
                                </tr>
                                <?
$pi++;
endwhile;
?>
                                <? if($pi == 0 ){?>
                                <tr>
                                  <td align="center" colspan="4">-
                                    ���� ����Ʈ������ �����ϴ�. -</td>
                                </tr>
                                <? } ?>
                              </table></td>
                          </tr>
                          <tr>
                            <td <? echo $CONTENT_STYLE; ?>><table border="0" cellspacing="0" width="100%" bordercolordark="white">
                                <tr height=23>
                                  <td width="83%" <? echo $CONTENT_STYLE; ?>>&nbsp;
                                    <B>���� �ѵ�� ����Ʈ ����: <font color=blue> <? echo number_format($TODAY_POINT_NUM);?></font>��</B>
                                    | <B>���� �ѵ�� ����Ʈ ��: <font color=red><? echo number_format($TODAY_POINT_SUM); ?></font>
                                    Point</B></td>
                                  <td width="17%" colspan=1></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table>
                        <!---[����ȸ������Ʈ��] ----------------------------------------------------------------------------------------->
                      </td>
                    </tr>
                  </table></td>
              </tr>


            </table>
            <br> </td>
        </tr>
      </table></td>
  </tr>
</table>
<?

// ���� ����Ʈ ���

// ���� ���� ����Ʈ ���
?>
