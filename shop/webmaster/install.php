<?
	if(!$_COOKIE[ROOT_COLOR_TYPE]){
		setcookie("ROOT_COLOR_TYPE", "2", 0, "/");
	}
	include "../function/const_array.php" ;
	include "../function/kerrigancap_lib.php" ;	
?>
<HTML>
<HEAD>
<TITLE>INSTALL PAGE</TITLE>
</HEAD><link href="./style.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<BODY>
<table width="747" border="0" cellspacing="0" cellpadding="0" align = center>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td><table width=100% cellspacing=0 cellpading = 0 border=0 >
        <TR> 
          <TD WIDTH=100% HEIGHT=50 BGCOLOR=WHITE VALIGN=TOP><table width=100% cellpadding="5" cellspacing="1"  border=0 align="center" <? echo $TABLE_STYLE; ?>>
              <TR ALIGN=CENTER HEIGHT=22 > 
                <TD colspan="6" <? echo $TITLE_STYLE ; ?>>
								<FONT STYLE="font-size:15pt;" SIZE=4><B>���θ� INSTALL 
								PAGE</B></FONT> <br>
								* install ���� �غ����<br>
								- webroot�� �ݵ�� config ���丮�� �����Ǿ��־���ϰ� �۹̼��� 707 Ȥ�� 777 �̾���մϴ�.<br>
								- webroot/<? echo ${BOARD_FOLDER_NAME}; ?>/table �� �۹̼��� 707 Ȥ�� 777 �̾�� �մϴ�.<br>
								- webroot/<? echo ${BOARD_FOLDER_NAME}; ?>/channel �� �۹̼��� 707 Ȥ�� 777 �̾�� �մϴ�.<br>
								- webroot/<? echo ${STOCK_FOLDER_NAME}; ?> �� �۹̼��� 707 Ȥ�� 777�̾�� �մϴ�.<br>         
								- webroot/<? echo ${MEMBER_TEMP_FOLDER_NAME}; ?> �� �۹̼��� 707 Ȥ�� 777�̾�� �մϴ�.<br>								
								<br>
								- ��� �۹̼��� ���������� �־������ �Ʒ��� Next ��ư�� ���� �ּ���
				</TD>
              </TR>
              
            </TABLE>
            </TD>
        </TR>
		<tr>
			<td align = center><?
if(!is_dir("../config")) ECHO"WebRoot�� config ���丮�� �����Ͻð� �۹̼��� 707�� ������ �ּ���";
else if(fileperms("../config")!=16839 && fileperms("../config")!=16895) ECHO "webroot/config �� �۹̼��� 707�� ������ �ּ���. <a href='#' onClick= 'location.reload()'>���ΰ�ħ</a>";
else if(file_exists("../config/db_info.php") && fileperms("../config/db_info.php")!=33279 && fileperms("../config/db_info.php")!=33223 && fileperms("../config/db_info.php")!=33188) ECHO "webroot/config/db_info.php �� �۹̼��� 707�� ������ �ּ���. <a href='#' onClick= 'location.reload()'>���ΰ�ħ</a>";
else if(file_exists("../config/db_connect.php") && fileperms("../config/db_connect.php")!=33279 && fileperms("../config/db_connect.php")!=33223 && fileperms("../config/db_connect.php")!=33188) ECHO "webroot/config/db_connect.php �� �۹̼��� 707�� ������ �ּ���. <a href='#' onClick= 'location.reload()'>���ΰ�ħ</a>";
else if(fileperms("../${BOARD_FOLDER_NAME}/table") !=16839 && fileperms("../${BOARD_FOLDER_NAME}/table") !=16895) ECHO "webroot/${BOARD_FOLDER_NAME}/table �� �۹̼��� 707�� ������ �ּ���. <a href='#' onClick= 'location.reload()'>���ΰ�ħ</a>";
else if(fileperms("../${BOARD_FOLDER_NAME}/channel") !=16839 && fileperms("../${BOARD_FOLDER_NAME}/channel") !=16895) ECHO "webroot/${BOARD_FOLDER_NAME}/channel �� �۹̼��� 707�� ������ �ּ���. <a href='#' onClick= 'location.reload()'>���ΰ�ħ</a>";
else if(fileperms("../${STOCK_FOLDER_NAME}") !=16839 && fileperms("../${STOCK_FOLDER_NAME}") !=16895) ECHO "webroot/${STOCK_FOLDER_NAME} �� �۹̼��� 707�� ������ �ּ���. <a href='#' onClick= 'location.reload()'>���ΰ�ħ</a>";
else if(fileperms("../${MEMBER_TEMP_FOLDER_NAME}") !=16839 && fileperms("../${MEMBER_TEMP_FOLDER_NAME}") !=16895) ECHO "webroot/${MEMBER_FOLDER_NAME}/${MEMBER_TEMP_FOLDER_NAME} �� �۹̼��� 707�� ������ �ּ���. <a href='#' onClick= 'location.reload()'>���ΰ�ħ</a>";
else ECHO "<INPUT TYPE=Button VALUE='Next' onclick = \"javascript:location.replace('./install2.php')\" style=\"cursor:hand\" class = 'btn20'> ";
?></td>
		</tr>
      </TABLE></td>
  </tr>
</table>

</BODY></HTML>