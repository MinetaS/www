<?
/* 
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/

/********************************** id search �� ��� �Ʒ��� �����Ѵ�. **************************/
if($mode == 'idsearch'){

	$Name = trim($Name);
	$Jumin1 = trim($Jumin1);
	$Jumin2 = trim($Jumin2);
	$PWDHint = trim($PWDHint);
	$PWDAnswer = trim($PWDAnswer);
	
	if($UseJuminCheck == "checked"){// �ֹι�ȣ ����
		if($Jumin1 && $Jumin2) $list = _mysql_fetch_array("select * from ${MEMBER_TABLE_NAME} where Name='$Name' AND Jumin1='$Jumin1' AND Jumin2='$Jumin2'"); 
	}else{// ��й�ȣ ���� �亯 ����
		if($PWDHint && $PWDAnswer) $list = _mysql_fetch_array("select * from ${MEMBER_TABLE_NAME} where Name='$Name' AND PWDHint='$PWDHint' AND PWDAnswer='$PWDAnswer'"); 				
	}
	
	$Email=$list[Email];
		
	if ( !$list ) js_alert_location(" ��ġ�ϴ� �����͸� ã�� ���߽��ϴ�. ","$_SERVER[PHP_SELF]?query=$query");
	else if($type == "mail"){
		include ("${MEMBER_FOLDER_NAME}/$MemberSkin/IDPASS_MAIL.php");
		js_alert_location(" ���̵�� �н����带 $Email �� �߼��Ͽ� ��Ƚ��ϴ�. ","./");	
	}
	
}



/********************************** pass search �� ��� �Ʒ��� �����Ѵ�. **************************/
if($mode == 'passsearch'){

	$ID = trim($ID );
	$Jumin1 = trim($Jumin1);
	$Jumin2 = trim($Jumin2);
	$PWDHint = trim($PWDHint);
	$PWDAnswer = trim($PWDAnswer);
	
	if($UseJuminCheck == "checked"){// �ֹι�ȣ ����
		if($Jumin1 && $Jumin2) $list = _mysql_fetch_array("select * from ${MEMBER_TABLE_NAME} where ID ='$ID ' AND Jumin1='$Jumin1' AND Jumin2='$Jumin2'"); 
	}else{// ��й�ȣ ���� �亯 ����
		if($PWDHint && $PWDAnswer) $list = _mysql_fetch_array("select * from ${MEMBER_TABLE_NAME} where ID='$ID' AND PWDHint='$PWDHint' AND PWDAnswer='$PWDAnswer'"); 				
	}
	
	$Email=$list[Email];
		
	if ( !$list ) js_alert_location(" ��ġ�ϴ� �����͸� ã�� ���߽��ϴ�. ","$_SERVER[PHP_SELF]?query=$query");
	else if($type == "mail"){
		include ("${MEMBER_FOLDER_NAME}/$MemberSkin/IDPASS_MAIL.php");
		js_alert_location(" ���̵�� �н����带 $Email �� �߼��Ͽ� ��Ƚ��ϴ�. ","./");	
	}
	
}
	?>
<script src = "./js/General.js"></script>
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
                <td align="left" valign="middle"  style="font-size:12px; font-weight:bold; color='#218EAD'"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/bullet1.gif" width="12" height="14" align="absmiddle">&nbsp;���̵�/��й�ȣ
                  ã�� </td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="25" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr> 
          <td height="16" align="center" valign="top"><table width="490" border="0" cellspacing="0" cellpadding="0">
              <form action='<?=$PHP_SELF?>' method=post onSubmit = "return checkIDForm(this)">
								<input type=hidden name=query value=<? echo $query; ?>>
                <input type=hidden name=mode value=idsearch>
                <input type=hidden name=type value=mail>
                <tr> 
                  <td align="left" valign="top"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/id_title.gif"></td>
                </tr>
                <tr> 
                  <td height="10"></td>
                </tr>
                <tr> 
                  <td height="160" align="left" valign="top"><table width="490" height="160" border="0" cellpadding="0" cellspacing="0">
                      <tr> 
                        <td align="center" valign="top">
                          <table width="490" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="18"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/find_box_bg1.gif" width="18" height="19" /></td>
                              <td width="100%" background="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/find_box_bg_top_line.gif">&nbsp;</td>
                              <td width="19"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/find_box_bg2.gif" width="19" height="19" /></td>
                            </tr>
                            <tr>
                              <td colspan="3" align="center" background="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/find_box_bg_top.gif"><table border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td height="15"></td>
                              </tr>
                                <tr> 
                                  <td align="center" valign="top"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/id_ment.gif" width="389" height="14"></td>
                              </tr>
                                <tr> 
                                  <td height="12"></td>
                              </tr>
                                <tr> 
                                  <td align="center" valign="top"><table border="0" cellspacing="0" cellpadding="0">
                                    <tr align="left" valign="middle"> 
                                      <td width="80" height="30"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/img_name.gif" width="64" height="12"></td>
                                      <td> <input name="Name" type="text" class="input1" size="23"></td>
                                    </tr>
                                    <? if($UseJuminCheck == "checked"){?>
                                    <tr align="left" valign="middle"> 
                                      <td height="30"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/img_number.gif" width="64" height="12"></td>
                                      <td><input name="Jumin1" type="text" class="input1" size="6" onKeyPress="moveFocus(6,Jumin1,Jumin2)" maxlength="6">
                                        - 
                                        <input name="Jumin2" type="password" class="input1" size="7" maxlength="7"></td>
                                    </tr>
                                    <? } else { ?>
                                    <tr align="left" valign="middle"> 
                                      <td height="30">��й�ȣ ��߱� ����</td>
                                      <td><SELECT NAME='PWDHint' style='width:300px'>
                                        <option value = "">��й�ȣ ��߱� ����</option>
                                        <option value = "" >--------------------------------------------------------</option>
                                        <?				  
																									foreach($MEMBER_PWD_Q_ARRAY as $key => $value){																										
																										echo "<option value = '$key'>$value</option>";	
																									
																									}												
																							?>
                                        </SELECT></td>
                                    </tr>
                                    <tr align="left" valign="middle"> 
                                      <td height="30">��й�ȣ ��߱� �亯</td>
                                      <td><INPUT NAME="PWDAnswer" size="40" type="text" maxlength = 50 class="input2"></td>
                                    </tr>
                                    <? } ?>
                                    </table></td>
                              </tr>
                                  </table></td>
                            </tr>
                            <tr>
                              <td height="40" colspan="3" align="center" background="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/find_box_bg_bottom.gif"><input type = "image" src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/btn_find01.gif" width="123" height="27" border="0"  onFocus = "this.blur();"></td>
                            </tr>							
                            <tr>
                              <td><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/find_box_bg3.gif" width="18" height="19" /></td>
                              <td background="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/find_box_bg_bottom_line.gif">&nbsp;</td>
                              <td><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/find_box_bg4.gif" width="19" height="19" /></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
              </form>
            </table>
            <br> <br> <table width="490" border="0" cellspacing="0" cellpadding="0">
              <form action='<?=$PHP_SELF?>' method=post onSubmit = "return checkPassForm(this)">
								<input type=hidden name=query value=<? echo $query; ?>>
                <input type=hidden name=mode value=passsearch>
                <input type=hidden name=type value=mail>
                <tr> 
                  <td align="left" valign="top"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/pw_title.gif"></td>
                </tr>
                <tr> 
                  <td height="10"></td>
                </tr>
                <tr> 
                  <td height="160" align="left" valign="top"><table width="490" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="18"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/find_box_bg1.gif" width="18" height="19" /></td>
                              <td width="100%" background="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/find_box_bg_top_line.gif">&nbsp;</td>
                              <td width="19"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/find_box_bg2.gif" width="19" height="19" /></td>
                            </tr>
                            <tr>
                              <td colspan="3" align="center" background="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/find_box_bg_top.gif"><table border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td height="15"></td>
                              </tr>
                                <tr> 
                                  <td align="center" valign="top"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/id_ment2.gif" width="397" height="14"></td>
                              </tr>
                                <tr> 
                                  <td height="12"></td>
                              </tr>
                                <tr> 
                                  <td align="center" valign="top"><table border="0" cellspacing="0" cellpadding="0">
                                  <tr align="left" valign="middle"> 
                                    <td width="80" height="30"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/img_id01.gif" width="64" height="12"></td>
                                    <td> <input name="ID" type="text" class="input1" size="23"></td>
                                  </tr>
																	<? if($UseJuminCheck == "checked"){?>
                                  <tr align="left" valign="middle"> 
                                    <td height="30"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/img_number.gif" width="64" height="12"></td>
                                    <td><input name="Jumin1" type="text" class="input1" size="6" onKeyPress="moveFocus(6,Jumin1,Jumin2)" maxlength="6">
                                      - 
                                      <input name="Jumin2" type="password" class="input1" size="7"  maxlength="7"></td>
                                  </tr>
																	<? } else {?>
																	<tr align="left" valign="middle"> 
                                    <td height="30">��й�ȣ ��߱� ����</td>
                                    <td><SELECT NAME='PWDHint' style='width:300px'>
                                              <option value = "">��й�ȣ ��߱� ����</option>
                                              <option value = "" >--------------------------------------------------------</option>
                                              <?				  
																									foreach($MEMBER_PWD_Q_ARRAY as $key => $value){																										
																										echo "<option value = '$key'>$value</option>";	
																									
																									}												
																							?>
                                            </SELECT></td>
                                  </tr>
																	<tr align="left" valign="middle"> 
                                    <td height="30">��й�ȣ ��߱� �亯</td>
                                    <td><INPUT NAME="PWDAnswer" size="40" type="text" maxlength = 50 class="input2"></td>
                                  </tr>
																	<? } ?>
                                </table></td>
                              </tr>
                                  </table></td>
                            </tr>
                            <tr>
                              <td height="40" colspan="3" align="center" background="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/find_box_bg_bottom.gif"><input type = "image" src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/btn_find01.gif" width="123" height="27" border="0"  onFocus = "this.blur();"></td>
                            </tr>							
                            <tr>
                              <td><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/find_box_bg3.gif" width="18" height="19" /></td>
                              <td background="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/find_box_bg_bottom_line.gif">&nbsp;</td>
                              <td><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/find_box_bg4.gif" width="19" height="19" /></td>
                            </tr>
                          </table></td>
                </tr>
              </form>
            </table></td>
        </tr>
        <tr> 
          <td height="50" align="center" valign="top">&nbsp;</td>
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
<script>
	function checkIDForm(f){
		if(!f.Name.value){
			alert("�̸��� �Է����ּ���");
			f.Name.focus();
			return false;
		}
		<? if($UseJuminCheck == "checked"){// �ֹι�ȣ ���� ?>
		if(!f.Jumin1.value){
			alert("�ֹε�� ��ȣ���ڸ��� �Է����ּ���");
			f.Jumin1.focus();
			return false;
		}
		if(!f.Jumin2.value){
			alert("�ֹε�� ��ȣ���ڸ��� �Է����ּ���");
			f.Jumin2.focus();
			return false;
		}			
		<? } else{ ?>
		if(!f.PWDHint.value){
			alert("��й�ȣ ��߱� ������ �������ּ���.");
			f.PWDHint.focus();
			return false;
		}
		if(!f.PWDAnswer.value){
			alert("��й�ȣ ��߱� �亯�� �Է����ּ���");
			f.PWDAnswer.focus();
			return false;
		}
		<? } ?>
	}
	
	function checkPassForm(f){
		if(!f.ID.value){
			alert("���̵� �Է����ּ���");
			f.ID.focus();
			return false;
		}
		
		<? if($UseJuminCheck == "checked"){// �ֹι�ȣ ���� ?>
		if(!f.Jumin1.value){
			alert("�ֹε�� ��ȣ���ڸ��� �Է����ּ���");
			f.Jumin1.focus();
			return false;
		}
		if(!f.Jumin2.value){
			alert("�ֹε�� ��ȣ���ڸ��� �Է����ּ���");
			f.Jumin2.focus();
			return false;
		}			
		<? } else{ ?>
		if(!f.PWDHint.value){
			alert("��й�ȣ ��߱� ������ �������ּ���.");
			f.PWDHint.focus();
			return false;
		}
		if(!f.PWDAnswer.value){
			alert("��й�ȣ ��߱� �亯�� �Է����ּ���");
			f.PWDAnswer.focus();
			return false;
		}
		<? } ?>
	}
</script>