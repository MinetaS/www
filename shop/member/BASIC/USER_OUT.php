<? include "./function/member_check_module.php" ; ?>

<?
if($mode == "remove_progress"){
		
	$OutDate = time();	
	$Content = addslashes($Content);	
	$OutContent = "$OutReason|$Content";	
	
	if(isAdmin()) {
		js_alert_location("�ְ� �����ڴ� Ż�� �ϽǼ� �����ϴ�.","./");
	}	 	 
	 
	$sql = "UPDATE ${MEMBER_TABLE_NAME} SET 
					OutDate = $OutDate , 
					OutContent = '$OutContent'	,
					GrantSta = 'remove'
					WHERE ID='$_COOKIE[MEMBER_ID]'
					";
			
	$result = mysql_query($sql);
	
	if($MEMBER_OUT_LIMIT_DATE) $OutDateContent = "ȸ������ ��������� $MEMBER_OUT_LIMIT_DATE�� �� �ڵ� ���� �˴ϴ�." ;
	if($result)	js_alert_location("\\n ���������� Ż�� ��û�� �̷�� �����ϴ�\\n$OutDateContent","./${MEMBER_FOLDER_NAME}/LOG_OUT.php");
	 else js_alert_location("\\n DB �۾��� ������ �߻��߽��ϴ�..\\n","./");
				
	
}
		
?>


<script>
	function checkOutForm(f){		
		
		if(!f.OutReason.value){
			alert("Ż�� ������ ������ �ּ���");
			f.OutReason.focus();
			return false;
		}
		if(!f.Content.value){
			alert("����� ������ �����ּ���");
			f.Content.focus();
			return false;
		}
		
		var con = confirm("Ż�� �Ͻø� ȸ���� ���� ��� �ڷᰡ ���� �˴ϴ�. \n\n������ Ż�� �Ͻðڽ��ϱ�?");	
		
		if(!con)	return false;
		else return true;	
		
	}
	
</script>
<table width="690" border="0" cellspacing="0" cellpadding="0">
  <tr align="left" valign="top">
    <td width="10" height="10"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/sub_box01_01.gif" width="10" height="10"></td>
    <td background="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/sub_box01_02.gif"></td>
    <td width="10"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/sub_box01_03.gif" width="10" height="10"></td>
  </tr>
  <tr align="left" valign="top">
    <td style="background-image: url(<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/sub_box01_08.gif);background-repeat:repeat-y;"></td>
    <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="middle"  style="font-size:12px; font-weight:bold; color='#218EAD'"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/bullet1.gif" width="12" height="14" align="absmiddle">&nbsp;ȸ��Ż��</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="25" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td height="16" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<form name = "MemberOutFrm" method = "post" action = "<? echo $_SERVER['PHP_SELF']?>" onSubmit = "return checkOutForm(this)">
					<input type = "hidden" name = "query" value = "<? echo $query;?>">
					<input type = "hidden" name = "mode" value = "remove_progress">
					
					
              <tr>
                <td align="center" valign="top"><table width="650" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="50" valign="top" class="999999">Ż���Ͻø� ȸ���� ���� ��� �ڷᰡ �����ǹǷ� �ֹ��ڷ���� �ݵ�� �޸��� �νñ� �ٶ��ϴ�.<br>
                            Ż�� �� ������ �ڷ�� ���� ���θ����� å������ �ʽ��ϴ�.</td>
                      </tr>
                      <tr>
                        <td align="center"><table width="680" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td align="center" valign="top"><table width="680" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td align="left" valign="top"><table width="680" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td height="3"  bgcolor="909090"></td>
                                        </tr>
                                        <tr>
                                          <td height="3" align="left"><table width="680" border="0" cellpadding="5" cellspacing="0" bgcolor="F6F6F6">
                                              <tr>
                                                <td width="115" height="30" valign="middle" class="333333_b"> &nbsp;<img src="/img/dot_blue.gif" width="3" height="3" vspace="3"> Ż����� </td>
                                                <td bgcolor="ffffff">
                                                 <select name="OutReason" >
																									<option selected>Ż������� ������ �ּ���</option>
																									<?
																										foreach($ARRAY_OUT_REASON as $key => $value){
																										echo "<option value = '$key'>$value</option>";
																										}
																									?>
																									</select>                                               </td>
                                              </tr>
                                              <tr bgcolor="#C7C7C7">
                                                <td height="1" colspan="2" valign="middle" class="333333_b"> </td>
                                              </tr>
                                              <tr>
                                                <td height="30" valign="middle" class="333333_b"> &nbsp;<img src="/img/dot_blue.gif" width="3" height="3" vspace="3"> ����Ǹ��� </td>
                                                <td bgcolor="ffffff"><textarea name="Content" cols="83" rows="5" class="input2"></textarea></td>
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
                        </table></td>
                      </tr>
                    </table>
                      <br>
                      <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="112" align="center"><input type = "image" src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/btn_ok_03.gif"  border="0"></td>
                          <td width="112" align="center"><a href="./"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/btn_cancle_02.gif"  border="0"></a></td>
                        </tr>
                      </table></td>
              </tr></form>
              
            </table>
            <br>
            <br></td>
        </tr>
        <tr>
          <td height="20" align="center" valign="top">&nbsp;</td>
        </tr>
      </table></td>
    <td background="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/sub_box01_04.gif"></td>
  </tr>
  <tr align="left" valign="top">
    <td width="10" height="10"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/sub_box01_07.gif" width="10" height="10"></td>
    <td background="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/sub_box01_06.gif"></td>
    <td><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/sub_box01_05.gif" width="10" height="10"></td>
  </tr>
</table>
