<?
include "./ROOT_CHECK.php";
include "../config/membercheck_info.php";
if(!$MemberSkin) $MemberSkin = "BASIC";

include "../js/member.php" ; // ȸ���� ���õ� js ���� �Է¹� ������ ���� ���ֱ� ���ؼ� php�� ����


	if(!$mode){
		$title_txt = "����";
	}else if($mode == "modify"){
		$title_txt = "����";
	}
	
	
	$sql = "select * from ${MEMBER_TABLE_NAME} where ID = '$id'";	
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
	
	if($Back)  $GoJumpUrl = "$PHP_SELF?menushow=$menushow&THEME=$Back&CURRENT_PAGE=$CURRENT_PAGE&keyword=$keyword"; 
	else  $GoJumpUrl = "$PHP_SELF?menushow=$menushow&THEME=MemberList&CURRENT_PAGE=$CURRENT_PAGE&WHERE=$WHERE&keyword=$keyword&SELECT_SORT=$SELECT_SORT&add=$add&Sex=$Sex&Dsort=$Dsort&SYear=$SYear&SMonth=$SMonth&SDay=$SDay"; 

	
?>
<script>
	// ���̵� üũ 
	function IDCheck (form,obj,flag){	
			var trigger = obj.value;	
			var nform = form.name;			
			if(checkId(obj)== false) return false;
			else dynamic.src = "../<? echo ${MEMBER_FOLDER_NAME}?>/<? echo ${MemberSkin}?>/CheckJs.php?form=" + nform + "&trigger=" + trigger + "&flag=" + flag;
	}
	// �г��� üũ
	function NickCheck (form,obj,flag){		  
		  var trigger = obj.value;	
			var nform = form.name;			
			if(checkNickName(obj)== false) return false;
			else dynamic.src = "../<? echo ${MEMBER_FOLDER_NAME}?>/<? echo ${MemberSkin}?>/CheckJs.php?form=" + nform + "&trigger=" + trigger + "&flag=" + flag;			
	}

	// �ֹι�ȣ üũ
	function JuminCheck (form,flag){			
			 var nform = form.name;			
			 var Jumin1 = form.Jumin1.value ;
			 var Jumin2 = form.Jumin2.value ;
			if( IsJuminChk(Jumin1, Jumin2) == false) return false;
			else dynamic.src = "../<? echo ${MEMBER_FOLDER_NAME}?>/<? echo ${MemberSkin}?>/CheckJs.php?form=" + nform + "&Jumin1=" + Jumin1 + "&Jumin2=" + Jumin2 +"&flag=" + flag;
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
			  dynamic.src = "../<? echo ${MEMBER_FOLDER_NAME}?>/<? echo ${MemberSkin}?>/CheckJs.php?form=" + nform + "&trigger=" + RecID + "&flag=" + flag;								
			}
	}
	// ���� üũ 
	function MailCheck (form,flag){		 			
			EMAIL = form.Email1_1.value + "@" + form.Email1_2.value;	
			var nform = form.name;			
			if ( checkEmail(form) == false) return false;
			else dynamic.src = "../<? echo ${MEMBER_FOLDER_NAME}?>/<? echo ${MemberSkin}?>/CheckJs.php?form=" + nform + "&trigger=" + EMAIL + "&flag=" + flag;
	}
</script>
<script id="dynamic"></script>
<table width="747" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td> <table width="770" border="0" cellpadding="5" cellspacing="5" bgcolor="EEEEEE">
        <tr> 
          <td align="center" bgcolor="#FFFFFF"><table width="730"  border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="30" class="black_16"><strong><font color="#3366CC">ȸ��<? echo $title_txt; ?></font></strong></td>
              </tr>
              <tr> 
                <td>������ ��忡�� �������� ȸ��<? echo $title_txt; ?>�� �ϴ°��Դϴ�.</td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td> <table width=100% cellspacing=0 cellpadding="0" border=0 align="CENTER" >
        <?
	if(!$mode){ 	
		$action = "../${MEMBER_FOLDER_NAME}/${MemberSkin}/USER_REGISQUERY.php" ; 
	}	else { 
		$action = "../${MEMBER_FOLDER_NAME}/${MemberSkin}/USER_MODIFYQUERY.php" ; 
	}
?>
        <FORM name="FrmUserInfo" method="post" enctype='multipart/form-data' OnSubmit="return MemberCheckField(this);" action="<? echo $action; ?>">
          <input type=hidden name=THEME value='<?  echo $THEME; ?>'>
          <input type=hidden name= menushow value=<? echo $menushow; ?>>
          <input type=hidden name=CURRENT_PAGE value='<?=$CURRENT_PAGE?>'>
          <input type=hidden name=WHERE value='<?=$WHERE?>'>
          <input type=hidden name=keyword value='<?=$keyword?>'>
          <input type=hidden name=SELECT_SORT value='<?=$SELECT_SORT?>'>
          <input type=hidden name=add value='<?=$add?>'>
          <!--<input type=hidden name=Sex value='<?=$Sex?>'> ���� �浹-->
          <input type=hidden name=Dsort value='<?=$Dsort?>'>
          <input type=hidden name=SDay value='<?=$SDay?>'>
          <input type=hidden name=FDay value='<?=$FDay?>'>
          <input type="hidden" name="WHERE_REGIS" value="ADMIN">
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
          <TR> 
            <TD><table width=100% cellpadding="5" cellspacing="1"  border=0 align="center" <? echo $TABLE_STYLE; ?>>
                <TR> 
                  <TD COLSPAN=4 align="center" <? echo $TITLE_STYLE ; ?>>�Ϲ�����</TD>
                </TR>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100" COLSPAN=1>* ���̵�</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3> 
                    <? if(!$mode){?>
                    <input type="text" name="ID" size="15" maxlength = 15> <input type = "button"  value = "ID �ߺ�Ȯ��" class = btn10 onClick="javascript:IDCheck(this.form,this.form.ID,'ID')" style="cursor:hand";> 
                    <? } else { echo $List[ID]; }?>
                  </TD>
                </TR>
                <? if($_ENickName == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100" COLSPAN=1>* �г���</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3> 
                    <? if(!$mode){?>
                    <INPUT type="text" name="NickName" size="15" maxlength = 15> 
                    <input type = "button"  value = "�г��� �ߺ�Ȯ��" class = btn10 onClick="javascript:NickCheck(this.form,this.form.NickName,'NickName')" style="cursor:hand";> 
                    <? } else { echo $List[NickName]; }?>
                  </TD>
                </TR>
                <? } ?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100">* ��й�ȣ</TD>
                  <TD <? echo $CONTENT_STYLE; ?> width="205"> <INPUT type="password" name="PWD" size="15" maxlength = 15 VALUE="<?=$List[PWD]?>"> 
                  </TD>
                  <TD <? echo $LEFT_STYLE; ?> width="102">* ��й�ȣȮ��</TD>
                  <TD <? echo $CONTENT_STYLE; ?> width="189"> <INPUT type="password" name="CPWD" size="15" maxlength = 15 VALUE="<?=$List[PWD]?>"></TD>
                </TR>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100">* �� ��</TD>
                  <TD colspan="3" <? echo $CONTENT_STYLE; ?>> 
                    <? if(!$mode){?>
                    <INPUT type="text" name="Name" size="15" maxlength = 20> 
                    <? } else { echo $List[Name]; }?>
                  </TD>
                </TR>
                <? if($UseJuminCheck == "checked"){ // �ֹ� ��ȣ ���ø� ��Ÿ����.?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100">�ֹε�Ϲ�ȣ</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3> 
                    <? if(!$mode){?>
                    <input  name="Jumin1" maxlength = 6 size="7"  <? echo $ONLY_NUMBER_STYLE; ?> value="<?=$List[Jumin1]?>" onKeyup="moveFocus(6,this,this.form.Jumin2);" <? if($_EBirthDay == "checked") echo "onBlur = 'FillBirthDay(this.form)'" ; ?> >
                    - 
                    <INPUT type = "password" maxLength="7" name="Jumin2" size="7"  value="<?=$List[Jumin2]?>" <? echo $ONLY_NUMBER_STYLE; ?> <? if($_ESex == "checked") echo "onBlur = 'checkSexValue(this.form)'" ; ?>> 
                    <input type = "button"  value = "�ֹι�ȣ �ߺ�Ȯ��" class = btn10 onClick="javascript:JuminCheck(this.form,'JUMIN')" style="cursor:hand";> 
                    <? } else { echo "${List[Jumin1]}-*******"; }?>
                  </TD>
                </TR>
                <? } ?>
                <? if($_EBirthDay == "checked" ){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100"> �������</TD>
                  <TD colspan="3" <? echo $CONTENT_STYLE; ?>> <INPUT type="text" name="BirthYY" size="4" maxlength="4" <? echo $ONLY_NUMBER_STYLE; ?> readonly VALUE="<?=$BirthDay[0]?>">
                    �� 
                    <INPUT type="text" name="BirthMM" size="2" maxlength="2" <? echo $ONLY_NUMBER_STYLE; ?> readonly VALUE="<?=$BirthDay[1]?>">
                    �� 
                    <INPUT type="text" name="BirthDD" size="2" maxlength="2" <? echo $ONLY_NUMBER_STYLE; ?> readonly VALUE="<?=$BirthDay[2]?>">
                    �� 
                    <select name="BirthType" size="1">
                      <option value="S" <? if($List[BirthDay] == "S") echo " selected" ; ?>>���</option>
                      <option value="L" <? if($List[BirthDay] == "L") echo " selected" ; ?> >����</option>
                      <option value="M" <? if($List[BirthDay] == "M") echo " selected" ; ?> >����</option>
                    </select> </TD>
                </TR>
                <? } ?>
                <? if($_ESex == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100">����</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3> <INPUT TYPE=RADIO NAME='Sex' VALUE='M'<? if($List[Sex]=='M') echo  " checked";?>>
                    ���� 
                    <INPUT TYPE=RADIO NAME='Sex' VALUE='F' <? if($List[Sex]=='F') echo  " checked";?>>
                    ���� </TD>
                </TR>
                <? } ?>
                <? if($_EMarrStatus == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100"> ��ȥ����</TD>
                  <TD colspan="3" <? echo $CONTENT_STYLE; ?>><INPUT TYPE=RADIO NAME='MarrStatus' VALUE='Y' <? if($List[MarrStatus]=='Y') echo  " checked";?>>
                    ��ȥ 
                    <INPUT TYPE=RADIO NAME='MarrStatus' VALUE='N' <? if($List[MarrStatus]=='N') echo  " checked";?>>
                    ��ȥ </TD>
                </TR>
                <? } ?>
                <? if($_EMarrDate == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100"> ��ȥ�����</TD>
                  <TD colspan="3" <? echo $CONTENT_STYLE; ?>> <INPUT type="text" name="MarrYY" size="4" maxlength="4" <? echo $ONLY_NUMBER_STYLE; ?>  VALUE="<?=$MarrDate[0]?>">
                    �� 
                    <INPUT type="text" name="MarrMM" size="2" maxlength="2" <? echo $ONLY_NUMBER_STYLE; ?>  VALUE="<?=$MarrDate[1]?>">
                    �� 
                    <INPUT type="text" name="MarrDD" size="2" maxlength="2" <? echo $ONLY_NUMBER_STYLE; ?>  VALUE="<?=$MarrDate[2]?>">
                    �� </TD>
                </TR>
                <? } ?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100" COLSPAN=1>E-mail</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3> <input name="Email1_1" type="text" class="inputline" size="15" VALUE='<?=$Email[0]?>'>
                    @ 
                    <input name="Email1_2" type="text"  size="15" VALUE='<?=$Email[1]?>'> 
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
                    <input type = "button"  value = "�����ߺ�Ȯ��" class = btn10 onClick="javascript:MailCheck(this.form,'EMAIL')" style="cursor:hand";>
                    <? } ?>
                  </TD>
                </TR>
                <? if($_EHomePage == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100" COLSPAN=1>Ȩ������</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3>http:// 
                    <INPUT NAME="Url" type="text" size="45" value = "<? echo stripslashes($List[Url]) ;  ?>"></TD>
                </TR>
                <? } ?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100"> ��ȭ��ȣ</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3> <select name = "Tel1_1">
                      <option value = "" selected>����</option>
                      <?
													foreach($MEMBER_PHONE_ARRAY as $key => $value){
													if($value == $Tel[0]) $checkSelected = " selected" ; else $checkSelected = "";
													echo "<option value='$value' $checkSelected>$value</option>" ;
												}
												?>
                    </select>
                    - 
                    <input name=Tel1_2 type=text id="Tel1_2"  size=4 maxlength=4 value = "<? echo $Tel[1]; ?>">
                    - 
                    <input name=Tel1_3 type=text id="Tel1_3"  size=4 maxlength=4 value = "<? echo $Tel[2]; ?>"> 
                    &nbsp;</TD>
                </TR>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100" >�ڵ���</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3><select name = "Hand1_1">
                      <option value = "" selected>����</option>
                      <?
												foreach($MEMBER_HANDPHONE_ARRAY as $key => $value){
													if($value == $Hand[0]) $checkSelected = " selected" ; else $checkSelected = "";
													echo "<option value='$value' $checkSelected>$value</option>" ;
												}
												?>
                    </select>
                    - 
                    <input type=text name=Hand1_2 size=4 maxlength=4  value = "<? echo $Hand[1]; ?>">
                    - 
                    <input type=text name=Hand1_3 size=4 maxlength=4  value = "<? echo $Hand[2]; ?>"></TD>
                </TR>
                <? if($_EFax == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100"> �ѽ���ȣ</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3> <select name = "Fax1_1">
                      <option value = "" selected>����</option>
                      <?
													foreach($MEMBER_PHONE_ARRAY as $key => $value){
													if($value == $Fax[0]) $checkSelected = " selected" ; else $checkSelected = "";
													echo "<option value='$value' $checkSelected>$value</option>" ;
												}
												?>
                    </select>
                    - 
                    <input name=Fax1_2 type=text id="Fax1_2"  size=4 maxlength=4 value = "<? echo $Fax[1]; ?>">
                    - 
                    <input name=Fax1_3 type=text id="Fax1_3"  size=4 maxlength=4 value = "<? echo $Fax[2]; ?>"> 
                    &nbsp;</TD>
                </TR>
                <? } ?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100" COLSPAN=1>�����ȣ</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3><INPUT maxLength="3" name="Zip1_1" size="3"  readonly value = "<?=$Zip1[0]?>">
                    - 
                    <INPUT maxLength="3" name="Zip1_2" size="3"  readonly value = "<?=$Zip1[1]?>"> 
                    <input type = "button"  value = "�����ȣã��" onClick="javascript:OpenZipcode(this.form)" style="cursor:hand" class = "btn20" > 
                  </TD>
                </TR>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100" COLSPAN=1>�ּ�</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3><INPUT NAME="Address1" size="80" type="text" readonly VALUE='<?=$List[Address1]?>'></TD>
                </TR>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100" COLSPAN=1>���ּ�</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3><INPUT NAME="Address2" size="50" type="text" VALUE='<?=$List[Address2]?>'></TD>
                </TR>
                <? if($_EJob == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100" COLSPAN=1>��������</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3><SELECT NAME='Job'>
                      <option value = "" selected>��������</option>
                      <option value = "" >--------------------</option>
                      <?				  
													foreach($MEMBER_JOB_ARRAY as $key => $value){
														if($key == $List[Job]) $checkSelected = " selected" ; else $checkSelected = "";				  
													if($key) echo "<option value = '$key' $checkSelected>$value</option>";			  
													}
													
												?>
                    </SELECT> </TD>
                </TR>
                <? } ?>
                <? if($_EScholarship == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100" COLSPAN=1>�з¼���</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3><SELECT NAME='Scholarship'>
                      <option value = "" selected>�з¼���</option>
                      <option value = "" >--------------------</option>
                      <?				  
												foreach($MEMBER_SCHOOL_ARRAY as $key => $value){
													if($key == $List[Scholarship]) $checkSelected = " selected" ; else $checkSelected = "";				  
												if($key) echo "<option value = '$key' $checkSelected>$value</option>";			  
												}
												
											?>
                    </SELECT> </TD>
                </TR>
                <? } ?>
                <? if($_EPassQna == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100"> ��й�ȣ ��߱�<br>
                    ��������</TD>
                  <TD colspan="3" <? echo $CONTENT_STYLE; ?>> <SELECT NAME='PWDHint' style='width:356px'>
                      <option value = "">��й�ȣ ��߱� ����</option>
                      <option value = "" >--------------------------------------------------------</option>
                      <?				  
													foreach($MEMBER_PWD_Q_ARRAY as $key => $value){
															if($key == $List[PWDHint]) $checkSelected = " selected" ; else $checkSelected = "";
														echo "<option value = '$key' $checkSelected>$value</option>";	
													
													}												
											?>
                    </SELECT></TD>
                </TR>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100" COLSPAN=1>��й�ȣ ��߱�<br>
                    �� �Է�</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3><INPUT NAME="PWDAnswer" size="80" type="text" maxlength = 50 value = "<? echo stripslashes($List[PWDAnswer]) ;?>"></TD>
                </TR>
                <? } ?>
                <? if(!$mode && $USE_RECOMMEND == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> COLSPAN=1>��õ�ξ��̵�</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3>
                    <? if(!$mode){?>
                    <input type = "text" name = "RecID" value = "<? echo $List[RecID]?>"> 
                    <input type = "button"  value = "��õ�ΰ˻�" class = btn10 onClick="javascript:RecommandCheck(this.form,'RECOMMAND')" style="cursor:hand";> 
                    <? } else { echo $List[RecID]; }?>
                  </TD>
                </TR>
                <? } ?>
                <? if($_ECompany == "checked"){?>
                <TR> 
                  <TD COLSPAN=4 align="center" <? echo $TITLE_STYLE ; ?>>ȸ������</TD>
                </TR>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> colspan="1">ȸ���</TD>
                  <TD colspan="3" <? echo $CONTENT_STYLE; ?>> <INPUT type="text" name="Company" size="30" value="<?=$List[Company]?>"> 
                  </TD>
                </TR>
                <? } ?>
                <? if($_EPresident == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> colspan="1">��ǥ�ڸ�</TD>
                  <TD colspan="3" <? echo $CONTENT_STYLE; ?>> <INPUT type="text" name="President" size="30" value="<?=$List[President]?>"> 
                  </TD>
                </TR>
                <? } ?>
                <? if($_EBusiness == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> colspan="1">����</TD>
                  <TD colspan="3" <? echo $CONTENT_STYLE; ?>> <INPUT type="text" name="Business" size="20" value="<?=$List[Business]?>"> 
                  </TD>
                </TR>
                <? } ?>
                <? if($_EItem == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> colspan="1">����</TD>
                  <TD colspan="3" <? echo $CONTENT_STYLE; ?>> <INPUT type="text" name="Item" size="20" value="<?=$List[Item]?>"> 
                  </TD>
                </TR>
                <? } ?>
                <? if($_ECompNum == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> colspan="1">����ڵ�Ϲ�ȣ</TD>
                  <TD colspan="3" <? echo $CONTENT_STYLE; ?>> <INPUT type="text" name="LicenseNo" size="25" value="<?=$List[LicenseNo]?>"> 
                  </TD>
                </TR>
                <? } ?>
                <? if($_ECTel == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100"> ȸ�� ��ȭ��ȣ</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3> <select name = "CTel1_1">
                      <option value = "" selected>����</option>
                      <?
													foreach($MEMBER_PHONE_ARRAY as $key => $value){
													if($value == $CTel[0]) $checkSelected = " selected" ; else $checkSelected = "";
													echo "<option value='$value' $checkSelected>$value</option>" ;
												}
												?>
                    </select>
                    - 
                    <input name=CTel1_2 type=text id="CTel1_2"  size=4 maxlength=4 value = "<? echo $CTel[1]; ?>">
                    - 
                    <input name=CTel1_3 type=text id="CTel1_3"  size=4 maxlength=4 value = "<? echo $CTel[2]; ?>"> 
                    &nbsp;</TD>
                </TR>
                <? } ?>
                <? if($_ECFax == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100"> ȸ�� �ѽ���ȣ</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3> <select name = "CFax1_1">
                      <option value = "" selected>����</option>
                      <?
													foreach($MEMBER_PHONE_ARRAY as $key => $value){
													if($value == $CFax[0]) $checkSelected = " selected" ; else $checkSelected = "";
													echo "<option value='$value' $checkSelected>$value</option>" ;
												}
												?>
                    </select>
                    - 
                    <input name=CFax1_2 type=text id="CFax1_2"  size=4 maxlength=4 value = "<? echo $CFax[1]; ?>">
                    - 
                    <input name=CFax1_3 type=text id="CFax1_3"  size=4 maxlength=4 value = "<? echo $CFax[2]; ?>"> 
                    &nbsp;</TD>
                </TR>
                <? } ?>
                <? if($_ECAddress == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100" COLSPAN=1>ȸ�� �����ȣ</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3><INPUT maxLength="3" name="Zip2_1" size="3"  readonly value = "<?=$Zip2[0]?>">
                    - 
                    <INPUT maxLength="3" name="Zip2_2" size="3"  readonly value = "<?=$Zip2[1]?>"> 
                    <input type = "button"  value = "�����ȣã��" onClick="javascript:OpenZipcode1(this.form)" style="cursor:hand" class = "btn20" > 
                  </TD>
                </TR>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100" COLSPAN=1>ȸ���ּ�</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3><INPUT NAME="Address3" size="80" type="text" readonly VALUE='<?=$List[Address3]?>'></TD>
                </TR>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> width="100" COLSPAN=1>ȸ����ּ�</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3><INPUT NAME="Address4" size="50" type="text" VALUE='<?=$List[Address4]?>'></TD>
                </TR>
                <? } ?>
                <TR> 
                  <TD COLSPAN=4 align="center" <? echo $TITLE_STYLE ; ?>>�߰�����</TD>
                </TR>
                <? if($_EMailReceive == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> COLSPAN=1>���� ����</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3><input type = "checkbox" name = "MailReceive" value = "Y" <? if($List[MailReceive] == "Y") echo " checked" ;  ?>></TD>
                </TR>
                <? } ?>
                <? if($_ESMS == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> COLSPAN=1>SMS ����</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3><input type = "checkbox" name = "SMSReceive" value = "Y" <? if($List[SMSReceive] == "Y") echo " checked" ;  ?>></TD>
                </TR>
                <? } ?>
                <? if($_EInfo == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> COLSPAN=1>������������</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3><input type = "checkbox" name = "MPublic" value = "Y" <? if($List[MPublic] == "Y") echo " checked" ;  ?>>
                    Ÿ�ο��� �ڽ��� ������ ����</TD>
                </TR>
                <? } ?>
                <? if($USE_ICON_TYPE){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> COLSPAN=1>ȸ��������</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3><img alt=�̸����� id=sm src="" width="largh" style="VISIBILITY: hidden"  name="imgsiz" border=1><br>
                    <INPUT type = "file" name = "file[]" id = "file" size="40"  onchange="return image_onchange(this.form);"> 
                    <? if($Picture[0]) { echo "<img src = '../${MEMBER_TEMP_FOLDER_NAME}/user_image/$Picture[0]' width = '$MEMBER_ICON_LIMIT_WIDTH' height = '$MEMBER_ICON_LIMIT_HEIGHT' border = 0> <input name='file_del[0]' type='checkbox' value='1'> �̹�������"; }  
									
									?>
                    <br>
                    ���ε� �뷮�� <? echo number_format($MEMBER_ICON_LIMIT_CAPACITY); ?> 
                    ����Ʈ ���� / �̹��� ũ��� <? echo $MEMBER_ICON_LIMIT_WIDTH; ?> x <? echo $MEMBER_ICON_LIMIT_HEIGHT; ?>���� 
                    ���ּ���.</TD>
                </TR>
                <? } ?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> colspan="1"> ȸ�����</TD>
                  <TD colspan="3" <? echo $CONTENT_STYLE; ?>>
										<? if($List[Grade] != "1"){?>
										<SELECT NAME='Grade'>
                      <?
											  // �迭�� �������� ����. key, value�� ���� �ϰ�(preserve_keys)	
												foreach(array_reverse($MEMBER_GRADE_NAME,preserve_keys) as $key => $value){													
												if($key == $List[Grade]) $checkSelected = " selected" ; else $checkSelected = "" ;  // defaultSelected 10 ���(�Ϲ�ȸ��)				  
												if($value && $key != "1") echo "<option value = '$key' $checkSelected >$value</option>";// �����ڿ� value ���� ���°� ����			  
												}
												
											?>
                    </SELECT>
										<? } else { ?>										
										<input type = "hidden" name = "Grade" value = "1">
										�ְ������
										<? } ?>
										
										</TD>
                </TR>
                <? if($mode == "modify"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?>  COLSPAN=1>�α���Ƚ��</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3> <? echo number_format(getMemberLoginCnt($List[ID])); ?> 
                    ȸ </TD>
                </TR>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?>  COLSPAN=1>��������Ʈ</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3> <A HREF='#' onclick="javascript:window.open('./MemberPoint.php?id=<?=$id?>', 'PointWindow','width=650,height=750,statusbar=no,scrollbars=yes,toolbar=no')"> 
                    <? echo number_format(getTotalPoint($List[ID])); ?> Point 
                    </a> </TD>
                </TR>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?>  COLSPAN=1>ȸ��������</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3> 
                    <? if ($List[RegDate]) echo date("Y-m-d h:i:s" , $List[RegDate]); ?>
                  </TD>
                </TR>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?>  COLSPAN=1>�ֱټ�����</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3> 
                    <? if ($List[ModDate]) echo date("Y-m-d h:i:s" , $List[ModDate]); ?>
                  </TD>
                </TR>
								<TR> 
                  <TD <? echo $LEFT_STYLE; ?>  COLSPAN=1>�ֱٷα��γ�¥</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3> 
										<? if(getLastLoginDate($id)) echo date("Y-m-d h:i:s" ,getLastLoginDate($id));  ?>                    
                  </TD>
                </TR>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?>  COLSPAN=1>ȸ��Ż����</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3> 
                    <? if ($List[OutDate]) echo date("Y-m-d h:i:s" , $List[OutDate]); ?>
                  </TD>
                </TR>
								
								<TR> 
                  <TD <? echo $LEFT_STYLE; ?>  COLSPAN=1>ȸ������</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3> 
										<? if($List[Grade] != "1"){?>
                    <select name = "GrantSta">
											<?											  	
												foreach($MEMBER_STATUS_ARRAY as $key => $value){													
												if($key == $List[GrantSta]) $checkSelected = " selected" ; else $checkSelected = "" ; 				  
												echo "<option value = '$key' $checkSelected >$value</option>";			  
												}												
											?>
										</select>
										<? } else { ?>										
										<input type = "hidden" name = "GrantSta" value = "checked">
										����
										<? } ?>
										
                  </TD>
                </TR>
								
                <? } ?>
                <? if($_EProfile == "checked"){?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> COLSPAN=1>�ڱ�Ұ�</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3><textarea name="MProfile" rows="7" style="width:99%" value = "<? echo stripslashes($List[MProfile]);?>"></textarea></TD>
                </TR>
                <? } ?>
                <TR> 
                  <TD <? echo $LEFT_STYLE; ?> COLSPAN=1>�����ڸ޸�</TD>
                  <TD <? echo $CONTENT_STYLE; ?> COLSPAN=3><textarea name="MDesc" rows="7" style="width:99%" value = "<? echo stripslashes($List[MDesc]);?>"></textarea></TD>
                </TR>
                <TR> 
                  <TD height = 40 colspan = 10 <? echo $CONTENT_STYLE; ?> align = center ><input type = "image" src = "<? if($mode == "modify") echo "./img/btn_set/btn_modify_03.gif" ; else echo "./img/btn_set/btn_complete_02.gif" ; ?>" align = absmiddle class = "noninput"> 
                    &nbsp; <a href = "<? echo $GoJumpUrl; ?>"><img src = "./img/btn_set/btn_list_02.gif" style = "cursor:hand" border = 0 align = absmiddle></a></TD>
                </TR>
              </TABLE></TD>
          </TR>
        </FORM>
      </TABLE></td>
  </tr>
</table></td>
</tr> </table> 