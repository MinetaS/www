<meta http-equiv="Content-Type" content="text/html; charset=euc-kr"><?
/* 

*/

/* ȸ������̸� �α��� ���¿� ȸ������� åũ�Ͽ� ���� ���� �� �ִ� ������ �ο��Ѵ�. */
include "${BOARD_FOLDER_NAME}/func/GradePermission.php";

if($AdminOnly == "Y" && !isAdmin()){
		js_alert_location("������ ����Խ����Դϴ�.","${BOARD_MAIN_FILE_NAME}?GID=$GID&BID=$BID&category=$category&CURRENT_PAGE=$CURRENT_PAGE&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax");
}

if($MemberOnly == "Y" && !isMember()){
js_alert_location("ȸ�� ����Խ����Դϴ�.","${BOARD_MAIN_FILE_NAME}?GID=$GID&BID=$BID&category=$category&CURRENT_PAGE=$CURRENT_PAGE&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax");
}

/************************************************ mode�� write�϶� **********************************************************/
if(!strcmp($mode,"write") && $bmode=="write"){
if(!$TxtType) $TxtType=0;
if(!$RepleMail) $RepleMail=0;
if(!$Secret) $Secret=0;
if(!$MainDisplay) $MainDisplay=0;
$SPARE1 = $TxtType."|".$RepleMail."|".$Secret."|".$MainDisplay;
include "${BOARD_FOLDER_NAME}/func/NoSpam.php";
include "${BOARD_FOLDER_NAME}/func/WRITE_WRITE.php";
}

/************************************ bmode�� modify�϶� ******************************************************************/
if(!strcmp($mode,"modify") && !strcmp($bmode,"modify")){
if(!$TxtType) $TxtType=0;
if(!$RepleMail) $RepleMail=0;
if(!$Secret) $Secret=0;
if(!$MainDisplay) $MainDisplay=0;
$SPARE1 = $TxtType."|".$RepleMail."|".$Secret."|".$MainDisplay;
include "${BOARD_FOLDER_NAME}/func/WRITE_MODIFY.php";
}

/**************************************************** mode�� reply�϶� *****************************************************/
if(!strcmp($mode,"reply") && !strcmp($bmode,"reply")){
if(!$TxtType) $TxtType=0;
if(!$RepleMail) $RepleMail=0;
if(!$Secret) $Secret=0;
if(!$MainDisplay) $MainDisplay=0;
$SPARE1 = $TxtType."|".$RepleMail."|".$Secret."|".$MainDisplay;
include "${BOARD_FOLDER_NAME}/func/WRITE_REPLY.php";
}

/********************************************************************** modify �ϰ�� ���� �Խõ� �۵��� �ҷ��´� **********/

if(!strcmp($mode,"modify")):
	$SQL_STR="SELECT * FROM $BOARD_NAME WHERE UID='$UID'";
	$SQL_QRY=mysql_query($SQL_STR);
	$LIST=mysql_fetch_array($SQL_QRY) or die(mysql_error());
	$LIST[SUBJECT] = stripslashes($LIST[SUBJECT]);
  $LIST[CONTENTS] = stripslashes($LIST[CONTENTS]);
	$SPARE1 = explode("|", $LIST[SPARE1]);
	$TxtType = $SPARE1[0];
	$RepleMail = $SPARE1[1];
	$Secret = $SPARE1[2];
	$MainDisplay = $SPARE1[3];
	$UPDIR1=explode("|",$LIST[UPDIR1]);
	
	if(!isAdmin()):
	
		if(!$LIST[ID]){// ȸ���� ������ �ƴϸ� ����� ���Ѵ�
		
			if ($_COOKIE[MODIFY] != $UID."_".$BID."_".$GID){
				js_location("./${BOARD_MAIN_FILE_NAME}?mode=modify_auth&BID=$BID&GID=$GID&nmode=$mode&rmode=modify&UID=$UID&CURRENT_PAGE=$CURRENT_PAGE&category=$category&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax");		
				exit;	
			}
		
		}else{
			
			if(!isMember()){
					include "./function/member_check_module.php";
			}else{
					if($_COOKIE[MEMBER_ID] != $LIST[ID]){
						js_alert_location("������ �۸� �����ϽǼ� �ֽ��ϴ�.","-1");
					}
			}	
		
		}
	endif;
	
endif;

/********************************************************************* reply �ϰ�� SUBJECT�� Reǥ�ø� �� ���δ�. **********/
if(!strcmp($mode,"reply")):
	$SQL_STR="SELECT SUBJECT, CONTENTS, SPARE1 FROM $BOARD_NAME WHERE UID='$UID'";
	$SQL_QRY=mysql_query($SQL_STR);
	$LIST=mysql_fetch_array($SQL_QRY) or die(mysql_error());
	$LIST[SUBJECT] = stripslashes($LIST[SUBJECT]);
  $LIST[CONTENTS] = stripslashes($LIST[CONTENTS]);
	// �������� ������� �ƴ����� �Ǻ� �ؼ� ��б��̶�� �ϴ��� �������� ������ �ʴ´�.	
	$SPARE1 = explode("|", $LIST[SPARE1]);
	$Secret = $SPARE1[2];
	if($Secret != "1") 	$LIST[CONTENTS] = "\n\r\n\r\n\r\n\r\n\r ------------ [Original Message] --------------------------\r\n&gt;&gt;".ereg_replace("\n","\n&gt;&gt;",$LIST[CONTENTS]);
	else $LIST[CONTENTS] = "";
	$LIST[SUBJECT]="Re: ".$LIST[SUBJECT];
endif;
?>
<script language="JavaScript">
<!--
function WRITE_FUNC(){
var f =  document.WRITE_FORM;
checkenable = new Array(); 
	if(f.spamfree.value){
		alert('����Ÿ�� �������Դϴ�.');
		return false;	
	}
    if(f.checkenable){
    var checkenablelen = f.checkenable.length
        for (i = 0; i < checkenablelen; i++){
            if(f.checkenable[i].value == ""){
            alert(f.checkenable[i].title);
            f.checkenable[i].focus();
            return false;
            }
        }
        if(!checkenablelen && f.checkenable.value == ""){
        alert(f.checkenable.title);
        f.checkenable.focus();
        return false;
        }
    }
	f.spamfree.value='<?=time()?>';
  f.submit();
	document.all.WRITE_FORM_TRANSFER_DIV.style.display = "";
	document.all.WRITE_FORM_DIV.style.display ="none";
}
//-->
</script>

<DIV id=WRITE_FORM_TRANSFER_DIV style="display:none"> <br>
  <br>
  <br>
  <br>
  <table cellpadding="3" cellspacing="1" bgcolor="#E7E3E7" align="center" width="308">
    <tr>
      <td width="300" bgcolor="white" height="100" align="center"><b>�ۼ����� �������Դϴ�.</b><br>
        <br>
        ��ø� ��ٷ� �ֽñ� �ٶ��ϴ�.</td>
    </tr>
  </table>
</DIV>
<DIV id=WRITE_FORM_DIV style="display:block">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <form name="WRITE_FORM" action="<?=$PHP_SELF?>" method="post" enctype="multipart/form-data">
      <? if(!$bmode) $bmode="write"; ?>
      <input type="hidden" name="blank" value="">
      <!-- mysql���� �� kr �� �ƴѰ�� modify�� ��ó�� hidden���� ������� �������� ���׹߻����� -->
      <input type="hidden" name="BID" value="<?=$BID?>">
      <input type="hidden" name="GID" value="<?=$GID?>">
      <input type="hidden" name="mode" value="<?=$mode?>">
      <input type="hidden" name="bmode" value="<?=$mode;?>">
      <input type="hidden" name="UID" value="<?=$UID;?>">
      <!--<input type="hidden" name="CATEGORY" value="<?=$category?>">-->
      <input type="hidden" name="ID" value="<?=$_COOKIE[MEMBER_ID];?>">
      <input type="hidden" name="sysop" value="<? echo $sysop; ?>">
      <input type="hidden" name="fm" value="<? echo $fm; ?>">
      <input type="hidden" name="BType" value="<? echo $BType; ?>">
      <input type="hidden" name="ListMax" value="<? echo $ListMax; ?>">
      <input type="hidden" name="spamfree" value="">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="35" align="right" valign="bottom" style="padding-bottom:2px" class="paging">&nbsp;</td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="1" colspan="2"bgcolor="#DDDDDD"></td>
            </tr>
            <tr>
              <td width="100" height="26" align="center" bgcolor="#efefef"><strong>�̸�</strong></td>
              <td bgcolor="#f5f5f5" style="padding-left:5"><input name="NAME" type="text" id="checkenable" style="BACKGROUND-COLOR: #FFFFFF; BORDER: #DDDDDD 1 solid; font-family:Tahoma; font-size:11px; color:#5E5E5E; HEIGHT: 18px; width:50%" title="�̸��� �Է��ϼ���" value="<? if($LIST[NAME]) echo $LIST[NAME]; else echo $_COOKIE[MEMBER_NAME];?>">
              </td>
            </tr>
            <tr>
              <td height="1" colspan="2"bgcolor="#DDDDDD"></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td height="1"></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="100" height="26" align="center" bgcolor="#efefef"><strong>�̸���</strong></td>
              <td bgcolor="#f5f5f5" style="padding-left:5"><input name="EMAIL" type="text" id="EMAIL" style="BACKGROUND-COLOR: #FFFFFF; BORDER: #DDDDDD 1 solid; font-family:Tahoma; font-size:11px; color:#5E5E5E; HEIGHT: 18px; width:99%" value="<? if($LIST[EMAIL]) echo $LIST[EMAIL]; else echo $_COOKIE[MEMBER_EMAIL];?>">
              </td>
            </tr>
            <tr>
              <td height="1" colspan="2"bgcolor="#DDDDDD"></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td height="1"></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="100" height="26" align="center" bgcolor="#efefef"><strong>����</strong></td>
              <td bgcolor="#f5f5f5" style="padding-left:5"><input name="SUBJECT" type="text" id="checkenable" style="BACKGROUND-COLOR: #FFFFFF; BORDER: #DDDDDD 1 solid; font-family:Tahoma; font-size:11px; color:#5E5E5E; HEIGHT: 18px; width:99%" title="������ �Է��ϼ���" value="<?=$LIST[SUBJECT];?>">
              </td>
            </tr>
            <tr>
              <td height="1" colspan="2" bgcolor="#DDDDDD"></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td height="1"></td>
      </tr>
      <? if($CategoryEnable):?>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="100" height="26" align="center" bgcolor="#efefef"><strong>ī�װ�</strong></td>
              <td bgcolor="#f5f5f5" style="padding-left:5"><?
if($CategoryType == "radio"){
	
	foreach ($CategoryContents as $key => $value){
	$j = $key+1;
	if($LIST["BID"] == "$j") $checked =  "checked";
	else unset($checked);
	echo "<input type=\"Radio\" name=\"CATEGORY\" value=\"$j\" $checked >$value &nbsp;";
	}
}else{
	echo "<select name='CATEGORY' style='BACKGROUND-COLOR: #FFFFFF; BORDER: #D0D0D0 1 solid; font-family:Tahoma; font-size:12px; color:#5E5E5E; letter-spacing: -1px; HEIGHT: 20px;'>";
	echo "<option value = ''>ī�װ�����</option>";
	foreach ($CategoryContents as $key => $value){
	$j = $key+1;
	if($category == "$j") $selected =  "selected";
	else unset($selected);
	echo "<option value=\"$j\" ${selected}>$value</option>\n";
	}
	echo "</select>";
}

?>
              </td>
            </tr>
            <tr>
              <td height="1" colspan="2" bgcolor="#DDDDDD"></td>
            </tr>

          </table></td>
      </tr>
      <tr>
        <td height="1"></td>
      </tr>
      <? endif; ?>
<?
	if($SecretBoard == "Y" || $NoticeBoard == "Y"){//��� �Խù��̰ų� �������ϰ�츸 �ɼ��� ��Ÿ����.
?>			
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="100" height="26" align="center" bgcolor="#efefef"><strong>�ɼ�</strong></td>
              <td bgcolor="#f5f5f5" style="padding-left:5">
<?
if($SecretBoard == "Y"){
?>
<input type=checkbox value="1" name=Secret<? if($Secret) echo " checked";?>>
��� �Խù� 
<?
}
?>
<?		  

if($NoticeBoard == "Y" && isAdmin()):
?>
<input type=checkbox value="1" name=MainDisplay<? if($MainDisplay) echo " checked";?>> ������ 
<?
endif;
?>

              </td>
            </tr>
            <tr>
              <td height="1" colspan="2" bgcolor="#DDDDDD"></td>
            </tr>

          </table></td>
      </tr>
      <tr>
        <td height="1"></td>
      </tr>
<?
}
?>			
			
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="100" align="center" bgcolor="#efefef"><strong>����</strong></td>
              <td bgcolor="#f5f5f5" style="padding-left:5; padding-top:3; padding-bottom:3"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="FONT-SIZE: 9pt; COLOR: #000000; LINE-HEIGHT: 14pt; FONT-FAMILY: '����ü', 'Arial', 'sans-serif', 'helvetica'; vertical-align: bottom;">
                  <tr>
                    <td width="10"><input name="TxtType" type="radio" value="0" <? if(!strcmp($TxtType,"0") || !$TxtType) echo "CHECKED";?>>
                    </td>
                    <td width="80" bgcolor="#f5f5f5" class="text-small"> �Ϲ��ؽ�Ʈ</td>
                    <td width="10"><input type="radio" name="TxtType" value="1" <? if(!strcmp($TxtType,"1")) echo "CHECKED";?>>
                    </td>
                    <td bgcolor="#f5f5f5" class="text-small">html ����ϱ�</td>
                  </tr>
                </table>
                <textarea name="CONTENTS" style="BACKGROUND-COLOR: #FFFFFF; BORDER: #DDDDDD 1 solid; font-family:Tahoma; font-size:11px; color:#5E5E5E; HEIGHT: 300px; width:99%" id="checkenable" title="������ �Է��ϼ���"><?=$LIST[CONTENTS];?></textarea>
              </td>
            </tr>
            <tr>
              <td height="1" colspan="2" bgcolor="#DDDDDD"></td>
            </tr>
          </table></td>
      </tr>
<? 
if($ATTACH1 == "checked"){
for($i = 0 ; $i < $ATTACH_CNT ; $i++){
?>
      <tr>
        <td height="1"></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="100" height="26" align="center" bgcolor="#efefef"><strong>÷ �� </strong></td>
              <td bgcolor="#f5f5f5" style="padding-left:5"><input type="file" name="file[<? echo $i ; ?>]" size="35" style="BACKGROUND-COLOR: #FFFFFF; BORDER: #DDDDDD 1 solid; font-family:Tahoma; font-size:11px; color:#5E5E5E; HEIGHT: 18px; width:300px"> 
							<? if($mode == "modify" && $UPDIR1[$i]) echo " $UPDIR1[$i] <input name='file_del[$i]' type='checkbox' value='1'>���ϻ���"; ?>
						</td>
            </tr>
            <tr>
              <td height="1" colspan="2" bgcolor="#DDDDDD"></td>
            </tr>
          </table></td>
      </tr>
<? }
}
?>
      <tr>
        <td height="1"></td>
      </tr>
<? 
// ������ �ϰ��� �Ⱥ��� 
//������ �����̳� ȸ�� ������ �ƴҰ�츸 ������� �����ش�.

if( !isAdmin() && !isMember() ){
?>      
			<tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="100" height="26" align="center" bgcolor="#efefef"><strong>��й�ȣ</strong></td>
              <td bgcolor="#f5f5f5" style="padding-left:5"><input name="PASSWD" type="password" style="BACKGROUND-COLOR: #FFFFFF; BORDER: #DDDDDD 1 solid; font-family:Tahoma; font-size:11px; color:#5E5E5E; HEIGHT: 18px; width:25%" id="checkenable" title="��й�ȣ�� �Է��ϼ���">
                <span class="text-small"> �� ����/������ �ʿ��մϴ�</span></td>
            </tr>
            <tr>
              <td height="1" colspan="2" bgcolor="#DDDDDD"></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td height="1"></td>
      </tr>
<? }

 ?>			
    </form>
  </table>
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><img src="${BOARD_FOLDER_NAME}/skin/$BOARD_SKIN_TYPE/images/blank.gif" width="1" height="7"></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr valign="top">
            <td height="55"></td>
            <td align="right"><?=showBoardIcon('save');?></td>
            <td width="55" align="right"><?=showBoardIcon('cancel');?></td>
          </tr>
        </table></td>
    </tr>
  </table>
</div>
