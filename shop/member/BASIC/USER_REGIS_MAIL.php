<?
$CONTENT = stripslashes(getSingleValue("select Content  from ${CONTENT_TABLE_NAME} where Code = 'MAIL_CODE_01'"));
$IMG_URL = $SITE_URL."/${MEMBER_FOLDER_NAME}/".$MemberSkin."/mailimg";

$SEND_CONTENT = "<title>ȸ������ȯ������</title>
<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
<link href='$IMG_URL/body.css' rel='stylesheet' type='text/css'>
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
          <td><img src='$IMG_URL/img_member.gif' width='650' height='118'></td>
        </tr>
        <tr>
          <td align='center'><table width='600' border='0' cellspacing='0' cellpadding='0'>
              <tr height='4'>
                <td height='4' colspan='3' bgcolor='EAEAEA'></td>
              </tr>
              <tr>
                <td width='30' height='210'>&nbsp;</td>
                <td class='company'>�ȳ��ϼ���. <strong>$Name</strong> ���� <br> <br>
                  <font color=#FF6600>$ADMIN_TITLE</font> ȸ���� �ǽŰ��� �������� ȯ���մϴ�.<br>
                  <br>
                  $CONTENT</td>
                <td width='30' class='company'>&nbsp;</td>
              </tr>
              <tr height='1'>
                <td width='30' height='1'></td>
                <td height='1' background='$IMG_URL/bg_jumsun.gif'></td>
                <td width='30' height='1'></td>
              </tr>
              <tr>
                <td width='30'>&nbsp;</td>
                <td><table width='257' border='0' cellspacing='0' cellpadding='0'>
                    <tr>
                      <td width='122'><a href='$SITE_URL'><img src='$IMG_URL/but_shopping.gif' width='122' height='48' border='0'></a></td>
                      <td align='right'><a href='$SITE_URL/$MEMBER_MAIN_FILE_NAME.php?query=regis'><img src='$IMG_URL/but_info.gif' width='105' height='48' border='0'></a></td>
                    </tr>
                  </table></td>
                <td width='30'>&nbsp;</td>
              </tr>
              <tr height='4'>
                <td height='4' colspan='3' bgcolor='EAEAEA'></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height='65' align='right'><table width='245' border='0' cellspacing='0' cellpadding='0'>
              <tr>
                <td class='company'>$ADMIN_TITLE<br>
                  $ADMIN_NAME</td>
                <td width='25'>&nbsp;</td>
              </tr>
            </table>

          </td>
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
</body>

";

if ( $Email ) {
$Tomail = $Email;
$From = $ADMIN_EMAIL;
$Subject = "ȸ������ ������ �ּż� �����մϴ�. - $ADMIN_TITLE -";
$From = "From:$From\nContent-Type:text/html";
mail ($Tomail, $Subject, $SEND_CONTENT, $From);
}

?>
