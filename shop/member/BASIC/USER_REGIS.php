<?
include "./config/membercheck_info.php";


if(isMember()){// ȸ�� ����
	$MemberTitle = "ȸ������";
	$FrmAction = "./${MEMBER_FOLDER_NAME}/${MemberSkin}/USER_MODIFYQUERY.php" ;
	$mode = "modify";

	// ���̷�Ʈ�� ġ�� ��� �°��� auth�� �ǵ�����.
	if($PassAuthResult != "PassAuthChecked"){
		js_location("./${MEMBER_MAIN_FILE_NAME}?query=auth");
		exit;
	}
}else{// ����
	$MemberTitle = "ȸ������";
	$FrmAction = "./${MEMBER_FOLDER_NAME}/${MemberSkin}/USER_REGISQUERY.php" ;
	$mode = "";
}

include "./js/member.php" ; // ȸ���� ���õ� js ���� �Է¹� ������ ���� ���ֱ� ���ؼ� php�� ����

	$sql = "select * from ${MEMBER_TABLE_NAME} where ID = '$_COOKIE[MEMBER_ID]'";
	$List = _mysql_fetch_array($sql);
	$Email = explode("@" , $List[Email]);
	$Tel = explode("-",$List[Tel]);
	$Hand = explode("-",$List[Hand]);
	$Fax = explode("-",$List[Fax]);
	$CTel = explode("-",$List[CTel]);
	$CFax = explode("-",$List[CFax]);

	$Zip1 = explode("-",$List[Zip1]);
	$Zip2 = explode("-",$List[Zip2]);
	$BirthDay = explode("-",$List[BirthDay]);
	$MarrDate = explode("-" , $List[MarrDate]);
	$Picture = explode("|" , $List[Picture]);

	// �ʼ� �׸� ������
	$MUST_IMAGE_ICON = "<img src='$MEMBER_FOLDER_NAME/$MemberSkin/images/dot_red.gif' width='3' height='3' hspace='0' vspace='3'>";
	// ���� �׸� ������
	$SEL_IMAGE_ICON = "<img src='$MEMBER_FOLDER_NAME/$MemberSkin/images/dot_blue.gif' width='3' height='3' hspace='0' vspace='3'>";
	// ���� ������
	if($_CSex == "checked")	$_CSex_ICON = $MUST_IMAGE_ICON ; else $_CSex_ICON = $SEL_IMAGE_ICON ;
	if($_CBirthDay == "checked")	$_CBirthDay_ICON = $MUST_IMAGE_ICON ; else $_CBirthDay_ICON = $SEL_IMAGE_ICON ;
	if($_CMarrStatus == "checked")	$_CMarrStatus_ICON = $MUST_IMAGE_ICON ; else $_CMarrStatus_ICON = $SEL_IMAGE_ICON ;
	if($_CMarrDate == "checked")	$_CMarrDate_ICON = $MUST_IMAGE_ICON ; else $_CMarrDate_ICON = $SEL_IMAGE_ICON ;
	if($_CFax == "checked")	$_CFax_ICON = $MUST_IMAGE_ICON ; else $_CFax_ICON = $SEL_IMAGE_ICON ;
	if($_CHomePage == "checked")	$_CHomePage_ICON = $MUST_IMAGE_ICON ; else $_CHomePage_ICON = $SEL_IMAGE_ICON ;
	if($_CJob == "checked")	$_CJob_ICON = $MUST_IMAGE_ICON ; else $_CJob_ICON = $SEL_IMAGE_ICON ;
	if($_CScholarship == "checked")	$_CScholarship_ICON = $MUST_IMAGE_ICON ; else $_CScholarship_ICON = $SEL_IMAGE_ICON ;
	if($_CPassQna == "checked")	$_CPassQna_ICON = $MUST_IMAGE_ICON ; else $_CPassQna_ICON = $SEL_IMAGE_ICON ;
	if($_CCompany == "checked")	$_CCompany_ICON = $MUST_IMAGE_ICON ; else $_CCompany_ICON = $SEL_IMAGE_ICON ;
	if($_CPresident == "checked")	$_CPresident_ICON = $MUST_IMAGE_ICON ; else $_CPresident_ICON = $SEL_IMAGE_ICON ;
	if($_CBusiness == "checked")	$_CBusiness_ICON = $MUST_IMAGE_ICON ; else $_CBusiness_ICON = $SEL_IMAGE_ICON ;
	if($_CItem == "checked")	$_CItem_ICON = $MUST_IMAGE_ICON ; else $_CItem_ICON = $SEL_IMAGE_ICON ;
	if($_CCompNum == "checked")	$_CCompNum_ICON = $MUST_IMAGE_ICON ; else $_CCompNum_ICON = $SEL_IMAGE_ICON ;
	if($_CCTel == "checked")	$_CCTel_ICON = $MUST_IMAGE_ICON ; else $_CCTel_ICON = $SEL_IMAGE_ICON ;
	if($_CCFax == "checked")	$_CCFax_ICON = $MUST_IMAGE_ICON ; else $_CCFax_ICON = $SEL_IMAGE_ICON ;
	if($_CCAddress == "checked")	$_CCAddress_ICON = $MUST_IMAGE_ICON ; else $_CCAddress_ICON = $SEL_IMAGE_ICON ;
	if($_CSMS == "checked")	$_CSMS_ICON = $MUST_IMAGE_ICON ; else $_CSMS_ICON = $SEL_IMAGE_ICON ;
	if($_CMailReceive == "checked")	$_CMailReceive_ICON = $MUST_IMAGE_ICON ; else $_CMailReceive_ICON = $SEL_IMAGE_ICON ;
	if($_CInfo == "checked")	$_CInfo_ICON = $MUST_IMAGE_ICON ; else $_CInfo_ICON = $SEL_IMAGE_ICON ;
	if($_CProfile == "checked")	$_CProfile_ICON = $MUST_IMAGE_ICON ; else $_CProfile_ICON = $SEL_IMAGE_ICON ;

?>
<script>
	// ���̵� üũ
	function IDCheck (form,obj,flag){
			var trigger = obj.value;
			var nform = form.name;
			if(checkId(obj)== false) return false;
			else dynamic.src = "./<? echo ${MEMBER_FOLDER_NAME}?>/<? echo ${MemberSkin}?>/CheckJs.php?form=" + nform + "&trigger=" + trigger + "&flag=" + flag;
	}
	// �г��� üũ
	function NickCheck (form,obj,flag){
		  var trigger = obj.value;
			var nform = form.name;
			if(checkNickName(obj)== false) return false;
			else dynamic.src = "./<? echo ${MEMBER_FOLDER_NAME}?>/<? echo ${MemberSkin}?>/CheckJs.php?form=" + nform + "&trigger=" + trigger + "&flag=" + flag;
	}

	// �ֹι�ȣ üũ
	function JuminCheck (form,flag){
			 var nform = form.name;
			 var Jumin1 = form.Jumin1.value ;
			 var Jumin2 = form.Jumin2.value ;
			if( IsJuminChk(Jumin1, Jumin2) == false) return false;
			else dynamic.src = "./<? echo ${MEMBER_FOLDER_NAME}?>/<? echo ${MemberSkin}?>/CheckJs.php?form=" + nform + "&Jumin1=" + Jumin1 + "&Jumin2=" + Jumin2 +"&flag=" + flag;
	}

	// ��õ üũ
	function RecommandCheck (form,flag){
		  var nform = form.name;
		  RecID = form.RecID.value;
			if(RecID ==""){
				alert("��õ�� ���̵� �Է����ּ���");
				form.RecID.focus();
				return false;
			}else{
			  dynamic.src = "./<? echo ${MEMBER_FOLDER_NAME}?>/<? echo ${MemberSkin}?>/CheckJs.php?form=" + nform + "&trigger=" + RecID + "&flag=" + flag;
			}
	}
	// ���� üũ
	function MailCheck (form,flag){
			EMAIL = form.Email1_1.value + "@" + form.Email1_2.value;
			var nform = form.name;
			if ( checkEmail(form) == false) return false;
			else dynamic.src = "./<? echo ${MEMBER_FOLDER_NAME}?>/<? echo ${MemberSkin}?>/CheckJs.php?form=" + nform + "&trigger=" + EMAIL + "&flag=" + flag;
	}
</script>
<script id="dynamic"></script>
<script language="javascript" src="./js/General.js"></script>
<FORM name="FrmUserInfo" method="post" OnSubmit="return MemberCheckField(this);" enctype='multipart/form-data' action="<? echo $FrmAction; ?>">
<input type="hidden" name="IP" value="<? echo $_SERVER['REMOTE_ADDR'];?>">
<? if(!$mode){?>
<input type="hidden" name="IDCheckFlag" value="N">
<!-- ���̵� üũ�� �ߴ��� Flag-->
<? if($_ENickName == "checked"){ ?>
<input type="hidden" name="NickCheckFlag" value="N">
<!-- ���� üũ�� �ߴ��� Flag-->
<? } ?>
<? if($UseJuminCheck == "checked"){ ?>
<input type="hidden" name="JuminCheckFlag" value="N">
<!-- �ֹι�ȣ üũ Flag-->
<? } ?>
<? } ?>
<input type="hidden" name="MailCheckFlag" value="N">
<!-- ���� üũ�� �ߴ��� Flag-->
<input type="hidden" name="UploadCheckFlag" value="Y">
<!-- ���ε� �������� Flag �⺻ Y-->
<? if($mode == "modify"){ // �����ø� ?>
<input type = "hidden" name = "ID" value = "<? echo $List[ID];?>">
<input type = "hidden" name = "Name" value = "<? echo $List[Name];?>">
<? } ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
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
                  <td align="left" valign="middle"  style="font-size:12px; font-weight:bold; color='#218EAD'"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/bullet1.gif" width="12" height="14" align="absmiddle">&nbsp;<? echo $MemberTitle; ?></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td height="25" align="left" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td height="16" align="center" valign="top"><table width = "100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="25" valign="top"> &nbsp;<img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/dot_red.gif" width="3" height="3" hspace="1" vspace="3">
                    �� �ʼ��Է»����Դϴ�. </td>
                </tr>
                <tr>
                  <td align="center"><table border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="center" valign="top"><table  border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td height="3"  bgcolor="909090"></td>
                                  </tr>
                                  <tr>
                                    <td height="3" align="left"><table  border="0" cellpadding="5" cellspacing="0" bgcolor="F6F6F6">
                                        <tr align="center">
                                          <td height="30" colspan="2" valign="middle" class="333333_b">
                                            ȸ�� �Ϲ����� </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td width="115" height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $MUST_IMAGE_ICON; ?>
                                            ȸ��ID </td>
                                          <td bgcolor="ffffff">
                                            <? if(!$mode){?>
                                            <input type="text" name="ID" size="15" maxlength = 15 class="input2">
                                            <input type = "button"  value = "ID �ߺ�Ȯ��"  onClick="javascript:IDCheck(this.form,this.form.ID,'ID')" style="background: #ffffff; border : 1 solid : #cccccc;  border-color: #cccccc; FONT-SIZE: 9pt;FONT-FAMILY: '����';cursor:hand";>
                                            <? } else { echo $List[ID]; }?>
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? if($_ENickName == "checked"){?>
                                        <tr>
                                          <td width="115" height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $SEL_IMAGE_ICON; ?>
                                            �г��� </td>
                                          <td bgcolor="ffffff">
                                            <? if(!$mode){?>
                                            <INPUT type="text" name="NickName" size="15" maxlength = 15 class="input2">
                                            <input type = "button"  value = "�г��� �ߺ�Ȯ��"  onClick="javascript:NickCheck(this.form,this.form.NickName,'NickName')" style="background: #ffffff; border : 1 solid : #cccccc;  border-color: #cccccc; FONT-SIZE: 9pt;FONT-FAMILY: '����';cursor:hand";>
                                            <? } else { echo $List[NickName]; }?>
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $MUST_IMAGE_ICON; ?>
                                            <? if($mode == "modify") echo "��";?>��й�ȣ </td>
                                          <td bgcolor="ffffff"><INPUT type="password" name="PWD" size="15" maxlength = 15 class="input2">
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $MUST_IMAGE_ICON; ?>
                                            ��й�ȣȮ�� </td>
                                          <td bgcolor="ffffff"><INPUT type="password" name="CPWD" size="15" maxlength = 15 class="input2"></td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $MUST_IMAGE_ICON; ?>
                                            ���� </td>
                                          <td bgcolor="ffffff">
                                            <? if(!$mode){?>
                                            <INPUT type="text" name="Name" size="15" maxlength = 20 class="input2">
                                            <? } else { echo $List[Name]; }?>
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? if($UseJuminCheck == "checked"){ // �ֹ� ��ȣ ���ø� ��Ÿ����.?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $MUST_IMAGE_ICON; ?>
                                            �ֹε�Ϲ�ȣ</td>
                                          <td bgcolor="ffffff">
                                            <? if(!$mode){?>
                                            <input  name="Jumin1" maxlength = 6 size="7"  <? echo $ONLY_NUMBER_STYLE; ?> value="<?=$List[Jumin1]?>" onKeyup="moveFocus(6,this,this.form.Jumin2);" <? if($_EBirthDay == "checked") echo "onBlur = 'FillBirthDay(this.form)'" ; ?> class="input2">
                                            -
                                            <INPUT type = "password" maxLength="7" name="Jumin2" size="7"  value="<?=$List[Jumin2]?>" <? echo $ONLY_NUMBER_STYLE; ?> <? if($_ESex == "checked") echo "onBlur = 'checkSexValue(this.form)'" ; ?> class="input2">
                                            <input type = "button"  value = "�ֹι�ȣ �ߺ�Ȯ��"  onClick="javascript:JuminCheck(this.form,'JUMIN')" style="background: #ffffff; border : 1 solid : #cccccc;  border-color: #cccccc; FONT-SIZE: 9pt;FONT-FAMILY: '����';cursor:hand";>
                                            <? } else { echo "${List[Jumin1]}-*******"; }?>
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_EBirthDay == "checked" ){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CBirthDay_ICON; ?>
                                            �������</td>
                                          <td bgcolor="ffffff"><INPUT type="text" name="BirthYY" size="4" maxlength="4" <? echo $ONLY_NUMBER_STYLE; ?> readonly VALUE="<?=$BirthDay[0]?>" class="input2">
                                            ��
                                            <INPUT type="text" name="BirthMM" size="2" maxlength="2" <? echo $ONLY_NUMBER_STYLE; ?> readonly VALUE="<?=$BirthDay[1]?>" class="input2">
                                            ��
                                            <INPUT type="text" name="BirthDD" size="2" maxlength="2" <? echo $ONLY_NUMBER_STYLE; ?> readonly VALUE="<?=$BirthDay[2]?>" class="input2">
                                            ��
                                            <select name="BirthType" size="1">
                                              <option value="S" <? if($List[BirthDay] == "S") echo " selected" ; ?>>���</option>
                                              <option value="L" <? if($List[BirthDay] == "L") echo " selected" ; ?> >����</option>
                                              <option value="M" <? if($List[BirthDay] == "M") echo " selected" ; ?> >����</option>
                                            </select></td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_ESex == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CSex_ICON;?> ���� </td>
                                          <td bgcolor="ffffff"><INPUT TYPE=RADIO NAME='Sex' VALUE='M'<? if($List[Sex]=='M') echo  " checked";?>>
                                            ����
                                            <INPUT TYPE=RADIO NAME='Sex' VALUE='F' <? if($List[Sex]=='F') echo  " checked";?>>
                                            ���� </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_EMarrStatus == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CMarrStatus_ICON;?>
                                            ��ȥ����</td>
                                          <td bgcolor="ffffff"><INPUT TYPE=RADIO NAME='MarrStatus' VALUE='Y' <? if($List[MarrStatus]=='Y') echo  " checked";?>>
                                            ��ȥ
                                            <INPUT TYPE=RADIO NAME='MarrStatus' VALUE='N' <? if($List[MarrStatus]=='N') echo  " checked";?>>
                                            ��ȥ </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_EMarrDate == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CMarrDate_ICON;?>
                                            ��ȥ�����</td>
                                          <td bgcolor="ffffff"><INPUT type="text" name="MarrYY" size="4" maxlength="4" <? echo $ONLY_NUMBER_STYLE; ?>  VALUE="<?=$MarrDate[0]?>" class="input2">
                                            ��
                                            <INPUT type="text" name="MarrMM" size="2" maxlength="2" <? echo $ONLY_NUMBER_STYLE; ?>  VALUE="<?=$MarrDate[1]?>" class="input2">
                                            ��
                                            <INPUT type="text" name="MarrDD" size="2" maxlength="2" <? echo $ONLY_NUMBER_STYLE; ?>  VALUE="<?=$MarrDate[2]?>" class="input2">
                                            �� </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $MUST_IMAGE_ICON; ?>
                                            �̸���</td>
                                          <td bgcolor="ffffff"><input name="Email1_1" type="text" class="input2" size="15" VALUE='<?=$Email[0]?>'>
                                            @
                                            <input name="Email1_2" type="text"  size="15" VALUE='<?=$Email[1]?>' class="input2">
                                            <select name="sel_email" style="WIDTH: 120px" onchange="mailChange(this.form)">
                                              <option value=''>��Ÿ���������Է�</option>
                                              <?
																								foreach($MEMBER_EMAIL_ARRAY as $key => $value){
																									echo "<option value='$key'>$value</option>" ;
																								}
																							 ?>
                                              <option value=''>��Ÿ���������Է�</option>
                                            </select>
                                            <? if(!$mode){?>
                                            <input type = "button"  value = "�����ߺ�Ȯ��"  onClick="javascript:MailCheck(this.form,'EMAIL')" style="background: #ffffff; border : 1 solid : #cccccc;  border-color: #cccccc; FONT-SIZE: 9pt;FONT-FAMILY: '����';cursor:hand";>
                                            <? } ?>
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? if($_EHomePage == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CHomePage_ICON;?>
                                            Ȩ������ </td>
                                          <td bgcolor="ffffff">http://
                                            <INPUT NAME="Url" type="text" size="45" value = "<? echo stripslashes($List[Url]) ;  ?>" class="input2"></td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $MUST_IMAGE_ICON; ?>
                                            ��ȭ��ȣ</td>
                                          <td bgcolor="ffffff"><select name = "Tel1_1">
                                              <option value = "" selected>����</option>
                                              <?
																								foreach($MEMBER_PHONE_ARRAY as $key => $value){
																								if($value == $Tel[0]) $checkSelected = " selected" ; else $checkSelected = "";
																								echo "<option value='$value' $checkSelected>$value</option>" ;
																							}
																							?>
                                            </select>
                                            -
                                            <input name=Tel1_2 type=text id="Tel1_2"  size=4 maxlength=4 value = "<? echo $Tel[1]; ?>" class="input2">
                                            -
                                            <input name=Tel1_3 type=text id="Tel1_3"  size=4 maxlength=4 value = "<? echo $Tel[2]; ?>" class="input2">
                                            &nbsp;</td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $MUST_IMAGE_ICON; ?>
                                            �޴���ȭ </td>
                                          <td bgcolor="ffffff"><select name = "Hand1_1">
                                              <option value = "" selected>����</option>
                                              <?
																								foreach($MEMBER_HANDPHONE_ARRAY as $key => $value){
																									if($value == $Hand[0]) $checkSelected = " selected" ; else $checkSelected = "";
																									echo "<option value='$value' $checkSelected>$value</option>" ;
																								}
																								?>
                                            </select>
                                            -
                                            <input type=text name=Hand1_2 size=4 maxlength=4  value = "<? echo $Hand[1]; ?>" class="input2">
                                            -
                                            <input type=text name=Hand1_3 size=4 maxlength=4  value = "<? echo $Hand[2]; ?>" class="input2"></td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? if($_EFax == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CFax_ICON;?> �ѽ���ȣ
                                          </td>
                                          <td bgcolor="ffffff"><select name = "Fax1_1">
                                              <option value = "" selected>����</option>
                                              <?
																									foreach($MEMBER_PHONE_ARRAY as $key => $value){
																									if($value == $Fax[0]) $checkSelected = " selected" ; else $checkSelected = "";
																									echo "<option value='$value' $checkSelected>$value</option>" ;
																									}
																								?>
                                            </select>
                                            -
                                            <input name=Fax1_2 type=text id="Fax1_2"  size=4 maxlength=4 value = "<? echo $Fax[1]; ?>" class="input2">
                                            -
                                            <input name=Fax1_3 type=text id="Fax1_3"  size=4 maxlength=4 value = "<? echo $Fax[2]; ?>" class="input2">
                                            &nbsp;</td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $MUST_IMAGE_ICON; ?>
                                            �����ȣ </td>
                                          <td bgcolor="ffffff"><INPUT maxLength="3" name="Zip1_1" size="3"  readonly value = "<?=$Zip1[0]?>" class="input2">
                                            -
                                            <INPUT maxLength="3" name="Zip1_2" size="3"  readonly value = "<?=$Zip1[1]?>" class="input2">
                                            <img src = "./<? echo ${MEMBER_FOLDER_NAME}?>/<? echo ${MemberSkin}?>/images/btn_ad.gif" style="cursor:hand" onClick="javascript:OpenZipcode(document.FrmUserInfo)" align = absmiddle>
																						</td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $MUST_IMAGE_ICON; ?>
                                            �ּ�</td>
                                          <td bgcolor="ffffff"><INPUT NAME="Address1" size="60" type="text" readonly VALUE='<?=$List[Address1]?>' class="input2"></td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $MUST_IMAGE_ICON; ?>
                                            �� �ּ�</td>
                                          <td bgcolor="ffffff"><INPUT NAME="Address2" size="50" type="text" VALUE='<?=$List[Address2]?>' class="input2"></td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? if($_EJob == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CJob_ICON;?> ��������</td>
                                          <td bgcolor="ffffff"><SELECT NAME='Job'>
                                              <option value = "" selected>��������</option>
                                              <option value = "" >--------------------</option>
                                              <?
																								foreach($MEMBER_JOB_ARRAY as $key => $value){
																									if($key == $List[Job]) $checkSelected = " selected" ; else $checkSelected = "";
																								if($key) echo "<option value = '$key' $checkSelected>$value</option>";
																								}

																							?>
                                            </SELECT></td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_EScholarship == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CScholarship_ICON;?>
                                            �з¼���</td>
                                          <td bgcolor="ffffff"><SELECT NAME='Scholarship'>
                                              <option value = "" selected>�з¼���</option>
                                              <option value = "" >--------------------</option>
                                              <?
																								foreach($MEMBER_SCHOOL_ARRAY as $key => $value){
																									if($key == $List[Scholarship]) $checkSelected = " selected" ; else $checkSelected = "";
																								if($key) echo "<option value = '$key' $checkSelected>$value</option>";
																								}

																							?>
                                            </SELECT></td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_EPassQna == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CPassQna_ICON;?> ��й�ȣ <br>
                                            &nbsp;&nbsp;��߱�
                                            ��������</td>
                                          <td bgcolor="ffffff"><SELECT NAME='PWDHint' style='width:356px'>
                                              <option value = "">��й�ȣ ��߱� ����</option>
                                              <option value = "" >--------------------------------------------------------</option>
                                              <?
																									foreach($MEMBER_PWD_Q_ARRAY as $key => $value){
																											if($key == $List[PWDHint]) $checkSelected = " selected" ; else $checkSelected = "";
																										echo "<option value = '$key' $checkSelected>$value</option>";

																									}
																							?>
                                            </SELECT></td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CPassQna_ICON;?> ��й�ȣ <br>
                                            &nbsp;&nbsp;��߱�
                                            �� �Է�</td>
                                          <td bgcolor="ffffff"><INPUT NAME="PWDAnswer" size="60" type="text" maxlength = 50 value = "<? echo stripslashes($List[PWDAnswer]) ;?>" class="input2"></td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if(!$mode && $USE_RECOMMEND == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $SEL_IMAGE_ICON; ?>
                                            ��õ�ξ��̵�</td>
                                          <td bgcolor="ffffff">
                                            <? if(!$mode){?>
                                            <input type = "text" name = "RecID" value = "<? echo $List[RecID]?>" class="input2">
                                            <input type = "button"  value = "��õ�ΰ˻�"  onClick="javascript:RecommandCheck(this.form,'RECOMMAND')" style="background: #ffffff; border : 1 solid : #cccccc;  border-color: #cccccc; FONT-SIZE: 9pt;FONT-FAMILY: '����';cursor:hand";>
                                            <? } else { echo $List[RecID]; }?>
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_ECompany == "checked"){?>
                                        <tr>
                                          <td height="30" colspan="2" align="center" valign="middle" class="333333_b">
                                            ȸ������</td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_ECompany == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CCompany_ICON;?> ȸ���</td>
                                          <td bgcolor="ffffff"> <INPUT type="text" name="Company" size="30" value="<?=$List[Company]?>" class="input2">
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_EPresident == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CPresident_ICON;?>
                                            ��ǥ�ڸ�</td>
                                          <td bgcolor="ffffff"><INPUT type="text" name="President" size="30" value="<?=$List[President]?>" class="input2">
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_EBusiness == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CBusiness_ICON;?>
                                            ����</td>
                                          <td bgcolor="ffffff"> <INPUT type="text" name="Business" size="20" value="<?=$List[Business]?>" class="input2">
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_EItem == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CItem_ICON;?> ����</td>
                                          <td bgcolor="ffffff"> <INPUT type="text" name="Item" size="20" value="<?=$List[Item]?>" class="input2">
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_ECompNum == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CCompNum_ICON;?> ����ڵ�Ϲ�ȣ</td>
                                          <td bgcolor="ffffff"> <INPUT type="text" name="LicenseNo" size="25" value="<?=$List[LicenseNo]?>" class="input2">
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_ECTel == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CCTel_ICON;?> ȸ�� ��ȭ��ȣ</td>
                                          <td bgcolor="ffffff"> <select name = "CTel1_1">
                                              <option value = "" selected>����</option>
                                              <?
																								foreach($MEMBER_PHONE_ARRAY as $key => $value){
																								if($value == $CTel[0]) $checkSelected = " selected" ; else $checkSelected = "";
																								echo "<option value='$value' $checkSelected>$value</option>" ;
																							}
																							?>
                                            </select>
                                            -
                                            <input name=CTel1_2 type=text id="CTel1_2"  size=4 maxlength=4 value = "<? echo $CTel[1]; ?>" class="input2">
                                            -
                                            <input name=CTel1_3 type=text id="CTel1_3"  size=4 maxlength=4 value = "<? echo $CTel[2]; ?>" class="input2">
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_ECFax == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CCFax_ICON;?> ȸ�� �ѽ���ȣ</td>
                                          <td bgcolor="ffffff"> <select name = "CFax1_1">
                                              <option value = "" selected>����</option>
                                              <?
																								foreach($MEMBER_PHONE_ARRAY as $key => $value){
																								if($value == $CFax[0]) $checkSelected = " selected" ; else $checkSelected = "";
																								echo "<option value='$value' $checkSelected>$value</option>" ;
																							}
																							?>
                                            </select>
                                            -
                                            <input name=CFax1_2 type=text id="CFax1_2"  size=4 maxlength=4 value = "<? echo $CFax[1]; ?>" class="input2">
                                            -
                                            <input name=CFax1_3 type=text id="CFax1_3"  size=4 maxlength=4 value = "<? echo $CFax[2]; ?>" class="input2">
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_ECAddress == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CCAddress_ICON;?>
                                            ȸ�� �����ȣ</td>
                                          <td bgcolor="ffffff"> <INPUT maxLength="3" name="Zip2_1" size="3"  readonly value = "<?=$Zip2[0]?>" class="input2">
                                            -
                                            <INPUT maxLength="3" name="Zip2_2" size="3"  readonly value = "<?=$Zip2[1]?>" class="input2">
																						<img src = "./<? echo ${MEMBER_FOLDER_NAME}?>/<? echo ${MemberSkin}?>/images/btn_ad.gif" style="cursor:hand" onClick="javascript:OpenZipcode1(document.FrmUserInfo)" align = absmiddle>
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CCAddress_ICON;?>
                                            ȸ���ּ�</td>
                                          <td bgcolor="ffffff"> <INPUT NAME="Address3" size="80" type="text" readonly VALUE='<?=$List[Address3]?>' class="input2">
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CCAddress_ICON;?>
                                            ȸ����ּ�</td>
                                          <td bgcolor="ffffff"> <INPUT NAME="Address4" size="50" type="text" VALUE='<?=$List[Address4]?>' class="input2">
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <tr>
                                          <td height="30" colspan="2" align="center" valign="middle" class="333333_b">
                                            �߰�����</td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? if($_EMailReceive == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CMailReceive_ICON;?>
                                            ���� ����</td>
                                          <td bgcolor="ffffff"> <input type = "checkbox" name = "MailReceive" value = "Y" <? if($List[MailReceive] == "Y") echo " checked" ;  ?>>
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_ESMS == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CSMS_ICON;?> SMS ����</td>
                                          <td bgcolor="ffffff"> <input type = "checkbox" name = "SMSReceive" value = "Y" <? if($List[SMSReceive] == "Y") echo " checked" ;  ?>>
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_EInfo == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CInfo_ICON;?> ������������</td>
                                          <td bgcolor="ffffff"> <input type = "checkbox" name = "MPublic" value = "Y" <? if($List[MPublic] == "Y") echo " checked" ;  ?>>
                                            Ÿ�ο��� �ڽ��� ������ ���� </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($USE_ICON_TYPE){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $SEL_IMAGE_ICON; ?>
                                            ȸ��������</td>
                                          <td bgcolor="ffffff"> <img alt=�̸����� id=sm src="" width="largh" style="VISIBILITY: hidden"  name="imgsiz" border=1><br>
                                            <INPUT type = "file" name = "file1" id = "file" size="40"  onchange="return image_onchange(this.form);" class="input2"> 
                                            <? if($Picture[0]) { echo "<img src = './${MEMBER_TEMP_FOLDER_NAME}/user_image/$Picture[0]' width = '$MEMBER_ICON_LIMIT_WIDTH' height = '$MEMBER_ICON_LIMIT_HEIGHT' border = 0> <input name='file_del[0]' type='checkbox' value='1'> �̹�������"; } 	?>
                                            <br>
                                            ���ε� �뷮�� <? echo number_format($MEMBER_ICON_LIMIT_CAPACITY); ?>
                                            ����Ʈ ���� / �̹��� ũ��� <? echo $MEMBER_ICON_LIMIT_WIDTH; ?>
                                            x <? echo $MEMBER_ICON_LIMIT_HEIGHT; ?>����
                                            ���ּ���. </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($mode == "modify"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $SEL_IMAGE_ICON; ?>
                                            �α���Ƚ��</td>
                                          <td bgcolor="ffffff"> <? echo number_format(getMemberLoginCnt($List[ID])); ?>
                                            ȸ </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $SEL_IMAGE_ICON; ?>
                                            ��������Ʈ</td>
                                          <td bgcolor="ffffff">
                                            <? echo number_format(getTotalPoint($List[ID])); ?>
                                            Point  </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $SEL_IMAGE_ICON; ?>
                                            ȸ��������</td>
                                          <td bgcolor="ffffff">
                                            <? if ($List[RegDate]) echo date("Y-m-d h:i:s" , $List[RegDate]); ?>
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $SEL_IMAGE_ICON; ?>
                                            ���������� </td>
                                          <td bgcolor="ffffff">
                                            <? if ($List[ModDate]) echo date("Y-m-d h:i:s" , $List[ModDate]); ?>
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
																				<tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $SEL_IMAGE_ICON; ?>
                                            �ֱٷα��γ�¥ </td>
                                          <td bgcolor="ffffff">
                                            <? if(getLastLoginDate($_COOKIE[MEMBER_ID])) echo date("Y-m-d h:i:s" ,getLastLoginDate($_COOKIE[MEMBER_ID]));  ?>
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $SEL_IMAGE_ICON; ?>
                                            ȸ�����</td>
                                          <td bgcolor="ffffff"> <? echo $MEMBER_GRADE_NAME[$_COOKIE[MEMBER_GRADE]]?>
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
                                        <? if($_EProfile == "checked"){?>
                                        <tr>
                                          <td height="30" valign="middle" class="333333_b">
                                            &nbsp;<? echo $_CProfile_ICON;?> �ڱ�Ұ�</td>
                                          <td bgcolor="ffffff"> <textarea name="MProfile" rows="7" style="width:99%" class="input2"><? echo stripslashes($List[MProfile]);?></textarea>
                                          </td>
                                        </tr>
                                        <tr bgcolor="#C7C7C7">
                                          <td height="1" colspan="2" valign="middle" class="333333_b">
                                          </td>
                                        </tr>
                                        <? } ?>
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
              <br> <table border="0" cellspacing="0" cellpadding="0">
                <tr align="center">
                  <td width="133"><input type = "image" src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/btn_ok.gif"  border="0"  onFocus = "this.blur();"></td>
                  <td width="133"><img src="<?=$MEMBER_FOLDER_NAME;?>/<?=$MemberSkin?>/images/btn_cancle.gif"  onclick="javascript:location.href='./'"; style="cursor:hand"  onFocus = "this.blur();"></td>
                </tr>
              </table>
              <br> <br> <br></td>
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
</form>
