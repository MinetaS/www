<?
include "../../config/db_info.php";
include "../../config/db_connect.php";
include "../../config/membercheck_info.php";
include "../../function/const_array.php";
include "../../function/kerrigancap_lib.php";


$id = trim($id);

if(!$id) js_alert_location("���̵� �Է����ּ���","close");

if((strlen($id) > 15) || (strlen($id) < 4)) {
	js_alert_location("���̵�� 4~15 �� ������ �������� ȥ������ �����Ǿ�� �մϴ�.","close");
}


if(ereg($id , $DISABLEID)){
	js_alert_opener_valuesend("$id �� ���Ұ� ID �Դϴ�.","FrmUserInfo.ID.value=''");
}


$cnt  = getSingleValue("SELECT count(UID) as cnt  FROM ${MEMBER_TABLE_NAME} WHERE ID='$id'", $DB_CONNECT);
if ( $cnt > 0  ) {
	js_alert_opener_valuesend("$id �� �̹� ������� ���̵��Դϴ�.","FrmUserInfo.ID.value=''");
}

$message="<span class=green-b>$id</span> ��(��) ��밡���� ID�Դϴ�.</font>";

?>
<html>
<head>
<title>ID üũ</title>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<style type='text/css'>
<!--
body {
	background-color: #9eb91f;
}
-->
</style>
<script language="JavaScript">
<!--
function setting(name) {
opener.document.FrmUserInfo.name.value = name;
opener.document.FrmUserInfo.IDCheck.value = "Y";// ���̵� üũ�� �ߴ��� �÷��� �Ѱ� �ش�.
self.close();
}
-->
</script>
</head>
<body>
<table width="385" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><a href="javascript:self.close()"><img src="images/pop_t_01.gif" width="385" height="38" border="0"></a></td>
  </tr>
  <tr>
    <td align="center" bgcolor="9EB91F"><table width="367" height="100" border="0" cellpadding="10" cellspacing="1" bgcolor="788B1C">
        <tr>
          <td align="center" bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="0">
              <form name = "Frm">
                <input type=hidden name=action value="user_idcheck">
                <tr>
                  <td width="55"><img src="images/dot_red.gif" width="3" height="3" vspace="4">
                    <strong>���̵�</strong></td>
                  <td><input type=text name=id value="<?=$id?>"  class="input2" size=25>
                  </td>
                  <td width="55" align="center"><img src="images/btn_ok_02.gif" width="43" height="20" border="0" onClick="setting('<?=$id?>')" style = "cursor:hand"></td>
                </tr>
              </form>
            </table>
            <table width="300" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="30" align="center">
                  <?=$message?>
                </td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="10" align="center" bgcolor="9EB91F"> </td>
  </tr>
</table>
</body>
</html>
<?
exit;

?>
