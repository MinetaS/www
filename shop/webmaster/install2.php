<?
	include "../function/kerrigancap_lib.php" ;	
?>
<TITLE>INSTALL PAGE</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="./style.css" rel="stylesheet" type="text/css">

<script language='JavaScript'>
function install_check(f) {        
        if ( !f.db_host.value ) {
        alert('MYSQL ȣ��Ʈ�� �Է��� �ֽʽÿ�.');
				f.db_host.focus();	
        return false;
        }
        if ( !f.USER_DB.value ) {
        alert('����Ͻ� MYSQL DB�� �̸��� �Է��� �ֽʽÿ�.');
				f.USER_DB.focus();
        return false;
        }
        if ( !f.db_user.value ) {
        alert('MYSQL DB ���̵� �Է��� �ֽʽÿ�.');
				f.db_user.focus();
        return false;
        }
        if ( !f.admin.value ) {
        alert('������ ID�� �Է��� �ֽʽÿ�.');
				f.admin.focus();
        return false;
        }
        if ( !f.PASS.value ) {
        alert('�ʱ�� ����Ͻ� ������ �н����带 �Է��� �ֽʽÿ�.');
				f.PASS.focus();
        return false;
        }
        if ( !f.PASS1.value ) {
        alert('�ʱ�� ����Ͻ� ������ �н����带 �ٽ��ѹ� �Է��� �ֽʽÿ�.');
				f.PASS1.focus();
        return false;
        }
        if ( f.PASS.value != f.PASS1.value ) {
        alert('�ʱ�� ����Ͻ� ������ �н������ Ȯ���Ͻ� �н����尡 �ٸ��ϴ�.');
				f.PASS1.focus();
        return false;
        }
        if (confirm('\n�Է��Ͻ� ��� ������ ������ ��Ȯ�մϱ�?\n')) return true;
        return false;
}
</script>
<table width="747" border="0" cellspacing="0" cellpadding="0" align = center>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td> <table width="770" border="0" cellpadding="5" cellspacing="5" bgcolor="EEEEEE">
        <tr> 
          <td align="center" bgcolor="#FFFFFF"><table width="730"  border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="30" class="black_16"><strong><font color="#3366CC">���θ� 
                  INSTALL PAGE</B></FONT></font></strong></td>
              </tr>
              <tr> 
                <td> <br>
                  * DB ������ ��Ȯ�� �Է����ֽʽÿ�</p></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td><table width=100% cellspacing=0 cellpading = 0 border=0 >
        <TR> 
          <TD WIDTH=100% HEIGHT=50 BGCOLOR=WHITE VALIGN=TOP><table width=100% cellpadding="5" cellspacing="1"  border=0 align="center" >
              <TR ALIGN=CENTER HEIGHT=22 > 
                <TD colspan="6" ><FORM NAME=install ACTION='./install3.php' METHOD='POST' onsubmit='return install_check(this);'>                  
                      <table width=700 cellpadding="5" cellspacing="1"  border=0 align="center" <? echo $TABLE_STYLE; ?>>
                        <TR> 
                          <TD <? echo $TITLE_STYLE ; ?> COLSPAN=4 height="17">&nbsp; <FONT COLOR="#CCCCCC">������ 
                            �ʵ���� ��Ȯ�� �Է��� �ֽñ� �ٶ��ϴ�.</FONT></TD>
                        </TR>
                        <TR> 
                          <TD BGCOLOR="F2F2F2" width="134"><FONT COLOR='#092F7B'>* 
                            MYSQLȣ��Ʈ</FONT></TD>
                          <TD BGCOLOR="#FFFFFF" width="136"> <INPUT type="TEXT" name="db_host" size="15" value="localhost"> 
                          </TD>
                          <TD BGCOLOR="F2F2F2" width="135"><FONT COLOR='#092F7B'>* 
                            ���DB�̸�</FONT></TD>
                          <TD BGCOLOR="#FFFFFF" width="177"> <INPUT type="TEXT" name="USER_DB" size="20"> 
                          </TD>
                        </TR>
                        <TR> 
                          <TD BGCOLOR="F2F2F2" width="134"><FONT COLOR='#092F7B'>* 
                            DB ���̵�</FONT></TD>
                          <TD BGCOLOR="#FFFFFF" width="136"> <input type="TEXT" name="db_user" size="15"> 
                          </TD>
                          <TD BGCOLOR="F2F2F2" width="135"><FONT COLOR='#092F7B'>* 
                            DB �н�����</FONT></TD>
                          <TD BGCOLOR="#FFFFFF" width="177"> <INPUT type="TEXT" name="db_password" size="20"> 
                          </TD>
                        </TR>
                        <TR> 
                          <TD BGCOLOR="#FFFFFF" COLSPAN=4><FONT COLOR='#092F7B'>* 
                            MYSQLȣ��Ʈ�� Ÿ ȣ��Ʈ�� ��� ������ �ֽʽÿ�. MYSQL ������ ��Ȯ�ؾ� ���������� 
                            ��ġ�˴ϴ�. </FONT></TD>
                        </TR>
                        <TR> 
                          <TD BGCOLOR="F2F2F2" width="134"><FONT COLOR='#092F7B'>* 
                            Admin ID</FONT></TD>
                          <TD colspan="3" BGCOLOR="#FFFFFF"> <INPUT type="TEXT" name="admin" size="15"> 
                          </TD>
                        </TR>
                        <TR> 
                          <TD BGCOLOR="F2F2F2" width="134"><FONT COLOR='#092F7B'>* 
                            �н�������</FONT></TD>
                          <TD BGCOLOR="#FFFFFF" width="136"> <INPUT type="password" name="PASS" size="15"> 
                          </TD>
                          <TD BGCOLOR="F2F2F2" width="135"><FONT COLOR='#092F7B'>* 
                            �н�����Ȯ��</FONT></TD>
                          <TD BGCOLOR="#FFFFFF" width="177"> <INPUT type="password" name="PASS1" size="15"> 
                          </TD>
                        </TR>
                        <TR> 
                          <TD BGCOLOR="#FFFFFF" COLSPAN=4><FONT COLOR='#092F7B'>* 
                            ID �� �н������ �ݵ�� ����ϰ� ��ž��մϴ�.</FONT></TD>
                        </TR>
						<tr>
							<TD BGCOLOR="#FFFFFF" COLSPAN=4 align = center height = 30 ><INPUT TYPE=SUBMIT VALUE='INSTALL START' class = "btn20"></td>
						</tr>
                      </TABLE>                     
                  </FORM></TD>
              </TR>
            </TABLE></TD>
        </TR>
      </TABLE></td>
  </tr>
</table>


