<?

$IMG_URL = $SITE_URL."/${SKIN_FOLDER_NAME}/cart/".$CartSkin."/ordermailimg";
$CSS_URL = $SITE_URL."/${SKIN_FOLDER_NAME}/cart/".$CartSkin."/css";

$SEND_CONTENT = "<title>�ֹ��Ϸ����</title>
<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
<link href='$CSS_URL/body.css' rel='stylesheet' type='text/css'>
<body leftmargin='5' topmargin='5' marginwidth='0' marginheight='0'>
<table width='653' border='0' cellspacing='0' cellpadding='0'>
  <tr> 
    <td width='650' background='$IMG_URL/body.gif'><table width='650' border='0' cellspacing='0' cellpadding='0'>
        <tr>
          <td height='50'><table width='650' border='0' cellspacing='0' cellpadding='0'>
              <tr>
                <td width='2'><img src='$IMG_URL/img_top_l.gif' width='2' height='50'></td>
                <td background='$IMG_URL/bg_top.gif'>&nbsp;</td>
                <td width='2'><img src='$IMG_URL/img_top_r.gif' width='2' height='50'></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td><img src='$IMG_URL/img_order.gif' width='650' height='118'></td>
        </tr>
        <tr>
          <td align='center'><table width='600' border='0' cellspacing='0' cellpadding='0'>
              <tr> 
                <td height='80' colspan='2' bgcolor='#F1F1F1'> <table width='565' border='0' cellspacing='0' cellpadding='0'>
                    <tr> 
                      <td width='43'>&nbsp;</td>
                      <td class='company'>�ȳ��ϼ���. <strong>$list[Sender_Name]</strong> ����<br> 
                        <br>
                        ���� $ADMIN_TITLE �� �̿��� �ּż� ����� �����մϴ�.<br>
                        ���Բ��� �ֹ��Ͻ� ������ Ȯ���� �帳�ϴ�.<br>$CONTENT</td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td colspan='2'>&nbsp;</td>
              </tr>
              <tr> 
                <td colspan='2'><table width='600' border='0' cellpadding='0' cellspacing='0' class='company'>
                    <tr> 
                      <td height='3' colspan='3' bgcolor='#83A1C7'></td>
                    </tr>
                    <tr> 
                      <td width='200' height='27' align='right' bgcolor='#f3f3f3'><font color='#144179'>�ֹ���ȣ&nbsp; 
                        &nbsp; &nbsp; </font></td>
                      <td width='1' height='27'><img src='$IMG_URL/img_a.gif' width='12' height='27'></td>
                      <td width='399' height='27'><font color='618DC4'><strong>$CODE_VALUE</strong></font></td>
                    </tr>
                    <tr> 
                      <td height='1' colspan='3' bgcolor='#cfcfcf'></td>
                    </tr>
                    <tr> 
                      <td width='200' height='27' align='right' bgcolor='#f3f3f3'><font color='#144179'>�����ôº�&nbsp; 
                        &nbsp; &nbsp; </font></td>
                      <td width='1' height='27'><img src='$IMG_URL/img_a.gif' width='12' height='27'></td>
                      <td width='399' height='27'>$list[Re_Name]</td>
                    </tr>
                    <tr> 
                      <td height='1' colspan='3' bgcolor='#cfcfcf'></td>
                    </tr>
                    <tr> 
                      <td width='200' height='27' align='right' bgcolor='#f3f3f3'><font color='#144179'>����ó&nbsp; 
                        &nbsp; &nbsp; </font></td>
                      <td width='1' height='27'><img src='$IMG_URL/img_a.gif' width='12' height='27'></td>
                      <td width='399' height='27'>$list[Re_Tel]</td>

                    </tr>
                    <tr> 
                      <td height='1' colspan='3' bgcolor='#cfcfcf'></td>
                    </tr>
                    <tr> 
                      <td width='200' height='27' align='right' bgcolor='#f3f3f3'><font color='#144179'>������ 
                        �� �ּ�&nbsp; &nbsp; &nbsp; </font></td>
                      <td width='1' height='27'><img src='$IMG_URL/img_a.gif' width='12' height='27'></td>
                      <td width='399' height='27'>$list[Address3] $list[Address4]</td>
                    </tr>
                    <tr> 
                      <td height='1' colspan='3' bgcolor='#cfcfcf'></td>
                    </tr>
										<tr> 
                      <td width='200' height='27' align='right' bgcolor='#f3f3f3'><font color='#144179'>�������&nbsp; 
                        &nbsp; &nbsp; </font></td>
                      <td width='1' height='27'><img src='$IMG_URL/img_a.gif' width='12' height='27'></td>
                      <td width='399' height='27'>$PayTypeText ����</td>
                    </tr>
                    <tr> 
                      <td height='1' colspan='3' bgcolor='#cfcfcf'></td>
                    </tr>
                    <tr> 
                      <td width='200' height='27' align='right' bgcolor='#f3f3f3'><font color='#144179'>�����Ͻ� �ݾ�&nbsp; 
                        &nbsp; &nbsp; </font></td>
                      <td width='1' height='27'><img src='$IMG_URL/img_a.gif' width='12' height='27'></td>
                      <td width='399' height='27'>$Pay_Money ��</td>
                    </tr>
                    <tr> 
                      <td height='1' colspan='3' bgcolor='#cfcfcf'></td>
                    </tr>
                    <tr> 
                      <td width='200' height='27' align='right' bgcolor='#f3f3f3'><font color='#144179'>��������&nbsp; 
                        &nbsp; &nbsp; </font></td>
                      <td width='1' height='27'><img src='$IMG_URL/img_a.gif' width='12' height='27'></td>
                      <td width='399' height='27'>$Buy_Date</td>
                    </tr>
                    <tr> 
                      <td height='1' colspan='3' bgcolor='#cfcfcf'></td>
                    </tr>
                    <tr> 
                      <td height='3' colspan='3' bgcolor='#83A1C7'></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td colspan='2'>&nbsp;</td>
              </tr>        
                          
            </table></td>
        </tr>
        <tr>
          <td height='65' align='right'> <table width='450' border='0' cellspacing='0' cellpadding='0'>
              <tr> 
                <td width='425' align='right' class='company'>${ADMIN_TITLE}�� �̿����ּż� 
                  �����մϴ�.<br></td>
                <td width='25'>&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height='88' align='center' background='$IMG_URL/bg_bottom.gif' class='company'>�����ŷ�����ȸ 
            ��� ��2000-1ȣ�� ���� �ȳ� ����ڹ�ȣ : $COMPANY_BUSINESS_NUM<br>
            �ּ� :$COMPANY_ADD ��ȣ : $COMPANY_NAME ��ǥ�ڸ� : $COMPANY_CEO<br>
            ���θ���:$ADMIN_TITLE �� ����ó : $CUSTOMER_TEL, �ѽ���ȣ: $CUSTOMER_FAX</td>
        </tr>
      </table></td>
    <td width='3' valign='top' bgcolor='E4E4E4'><img src='$IMG_URL/img_r.gif' width='3' height='4'></td>
  </tr>
  <tr bgcolor='E4E4E4'> 
    <td height='3' colspan='2' valign='top'><img src='$IMG_URL/img_l.gif' width='3' height='3'></td>
  </tr>
</table>
";

if ( $list[Sender_Email]) {
$Tomail = $list[Sender_Email] ;
$From = $ADMIN_EMAIL;

$subject = "������ �ֹ������Դϴ�. - $ADMIN_TITLE -";

$from = "From:$From\nContent-Type:text/html";

mail ($Tomail, $subject, $SEND_CONTENT, $from);
mail ($ADMIN_EMAIL, $subject, $SEND_CONTENT, $from);


}
?>

