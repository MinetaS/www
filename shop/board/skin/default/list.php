<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<?
/*
	BType : ���� Ÿ��
	ListMax : ����Ʈ ����
*/
?>
<?

// �ٸ� ���̺� ������ �� �� �ֵ��� DB ���� �ٿ���
$BOARD_NAME = 'shop.'.$BOARD_NAME;

if (isAdmin() && $Query == 'delete') {   //�����ɼǽ� ����
	foreach($_POST as $key => $value){
		if(ereg("deleteItem", $key)) {
				$VIEW_QUERY = "SELECT * FROM $BOARD_NAME WHERE UID='$value'";
				$LIST = mysql_fetch_array(mysql_query($VIEW_QUERY));
				$Picture = explode("|", $LIST[UPDIR1]);
				for($i = 0 ; $i < sizeof($Picture) && $Picture[$i] ; $i++){
				 if (file_exists("./${BOARD_FOLDER_NAME}/table/$GID/$BID/updir/$Picture[$i]") && $Picture[$i]) {
						  unlink("./${BOARD_FOLDER_NAME}/table/$GID/$BID/updir/$Picture[$i]");
				 }
				}

				$result = mysql_query("DELETE FROM $BOARD_NAME WHERE UID=$value");
				if($result){// ��ũ�� ���̺�� �ڸ�Ʈ ���̺� ����
					@mysql_query("DELETE FROM ${BOARD_NAME}_comment WHERE MID=$value");
					$sql = "DELETE FROM ${SCRAP_TABLE_NAME} WHERE ScrapType  = 'BOARD' AND TableName = '$BOARD_NAME' AND DocNo = '$value'";
					$sresult = mysql_query($sql);
				}
		}
	}
	js_alert_location("�Խù��� ���� �Ǿ����ϴ�.","./${BOARD_MAIN_FILE_NAME}?BID=$BID&GID=$GID&category=$category&SEARCHTITLE=$SEARCHTITLE&searchkeyword=$searchkeyword&manager=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax");
} //�����ɼ� ��




/* ȸ������̸� �α��� ���¿� ȸ������� åũ�Ͽ� ���� ���� �� �ִ� ������ �ο��Ѵ�. */
include "./${BOARD_FOLDER_NAME}/func/GradePermission.php";

if($reverse == "on" && $SOrder == "asc"){
 $SOrder = "desc";
 $orderby = "ORDER BY $STitle $SOrder, FID DESC, THREAD ASC, UID DESC";
 }else if($reverse=="on"){
 $SOrder = "asc";
 $orderby = "ORDER BY $STitle $SOrder, FID DESC, THREAD ASC, UID DESC";
 }else if($STitle && $SOrder){
 $orderby = "ORDER BY $STitle $SOrder, FID DESC, THREAD ASC, UID DESC";
 }else $orderby = "ORDER BY FID DESC, THREAD ASC, UID DESC";

/* �˻� Ű���� �� WHERE ���ϱ� */
$WHERE  = "WHERE SUBSTRING(SPARE1,7,1) != '1'";
if($category) $WHERE = "$WHERE and BID = '$category'";
if($SEARCHTITLE && $searchkeyword) $WHERE = "$WHERE and $SEARCHTITLE LIKE '%$searchkeyword%'";
if($search_term){//���۰��� ���н�Ÿ������ �Ѿ��
$today = time();
$boundary = $today - $search_term;
$WHERE = "$WHERE and W_DATE between '$today' and '$boundary'";
}

/* �� ���� ���ϱ� */
$TOTAL = getSingleValue("SELECT count(UID) FROM $BOARD_NAME $WHERE");
if(empty($CURRENT_PAGE) || $CURRENT_PAGE <= 0) $CURRENT_PAGE = 1;
//--������ ��Ÿ����--
/* �ϴ� �������� ǥ�� for ($i = $SP; $i <= $EP && $i <= $TP ; $i++) */
$TP = ceil($TOTAL / $ListNo) ; /* ����������(Total Page) : �ѰԽù��� / �������� ����Ʈ��  */
$CB = ceil($CURRENT_PAGE / $PageNo); /* ������(Current Block) : ���������� / ǥ�õǴ� ������ �� */
$SP = ($CB - 1) * $PageNo + 1; /* ����� ó�� ������(Start Page) ���ϱ� */
$EP = ($CB * $PageNo); /*����� ������ ������(End Page) : ���� ��� * ǥ�õǴ� �������� */
$TB = ceil($TP / $PageNo); /* �Ѻ�ϼ�(Total Block) : ���������� / ǥ�õǴ� ������ �� */
//--��������ũ�� �ۼ��ϱ�--
?>
<SCRIPT LANGUAGE=javascript>
function deletefnc(){
<!--
        var f = document.forms.BrdList;
        var i = 0;
        var chked = 0;
        for(i = 0; i < f.length; i++ ) {
                if(f[i].type == 'checkbox') {
                        if(f[i].name != "CheckAll" && f[i].checked) {
                                chked++;
                        }
                }
        }
        if( chked < 1 ) {
                alert('�����ϰ��� �ϴ� �Խù��� �ϳ� �̻� ������ �ּ���.');
                return false;
        }
        if (confirm('\n\n�����ϴ� �Խù��� ������ �Ұ����մϴ�!!! \n\n������ �����Ͻðڽ��ϱ�?\n\n')){
			f.submit();
			return true;
		}else{
		    return false;
		}
}


function allcheck(f)
{
  for (var i=0; i<f.elements.length; i++)
  {
	if (f.elements[i].name.indexOf('deleteItem_')!=-1) f.elements[i].checked = f.CheckAll.checked;
  }
}
function down(updir, uid){
	file_url = "./<? echo ${BOARD_FOLDER_NAME}; ?>/download.php?filename="+updir+"&UID="+uid+"&BID=<?=$BID?>&GID=<?=$GID?>&sysop=<? echo $sysop; ?>&fm=<? echo $fm;?>&BType=<? echo $BType; ?>&ListMax=<? echo $ListMax; ?>";
	location.href=file_url;
}

function category_go(f){
	f.Query.value = "";
	f.submit();
}

-->
</script>
<form action="<?=$PHP_SELF?>" Name="BrdList" method = "post">
<input type="hidden" name="BID" value="<?=$BID?>" >
<input type="hidden" name="GID" value="<?=$GID?>" >
<input type="hidden" name="SEARCHTITLE" value="<?=$SEARCHTITLE?>">
<input type="hidden" name="searchkeyword" value="<?=$searchkeyword?>">
<input type="hidden" name="sysop" value="<?=$sysop?>">
<input type="hidden" name="fm" value="<?=$fm?>">
<input type="hidden" name="BType" value="<? echo $BType; ?>">
<input type="hidden" name="ListMax" value="<? echo $ListMax; ?>">
<input type="hidden" name="Query" value="delete">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" style="COLOR: #000000; LINE-HEIGHT: 14pt; vertical-align: bottom;">
          <tr>
						<td  valign="bottom" style="padding-bottom:2px">
<?
if($CategoryEnable): //�з��� ������
	echo "<select name='category' style='BACKGROUND-COLOR: #FFFFFF; BORDER: #D0D0D0 1 solid; font-family:Tahoma; font-size:12px; color:#5E5E5E; letter-spacing: -1px; HEIGHT: 20px;' onChange='category_go(this.form)';>";
	echo "<option value = ''>ī�װ�����</option>";
	foreach ($CategoryContents as $key => $value){
	$j = $key+1;
	if($category == "$j") $selected =  "selected";
	else unset($selected);
	echo "<option value=\"$j\" ${selected}>$value</option>\n";
	}
	echo "</select>";

endif; ?>

						</td>
            <td height="35" align="right" valign="bottom" style="padding-bottom:2px">Total
              <strong>
              <?=$TOTAL?>
              </strong> Articles | Viewing page : <strong>
              <?=$CURRENT_PAGE?>
              /
              <?=$TP?>
              </strong></td>
          </tr>
        </table></td>
  </tr>
  <tr>
    <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td bgcolor="#DDDDDD" height="1"></td>
        </tr>
        <tr>
          <td height="28" bgcolor="#F5F5F5"> <table width="100%" border="0" cellspacing="0" cellpadding="0" style="COLOR: #000000; LINE-HEIGHT: 14pt; vertical-align: bottom;">
              <tr>
                <? if($fm && $sysop && isAdmin()){?>
                <td width="20" align="center" valign="middle" ><input type="checkbox" name="CheckAll" onclick="allcheck(this.form)"></td>
                <? }?>
                <td width="60" align="center"><strong>��ȣ</strong></td>
                <td align="center"><strong>����</strong></td>
                <td width="90" align="center"><strong>�̸�</strong></td>
                <td width="70" align="center"><strong>��¥</strong></td>
                <td width="40" align="center"><strong>��ȸ</strong></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td bgcolor="#DDDDDD" height="1"></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="1"></td>
  </tr>
  <tr>
    <td>
      <?
$Category_Name = $CategoryContents;

$cnt=0;
$NoticeWhere = "WHERE SUBSTRING(SPARE1,7,1)= '1'";
$NoticeOrderBy = "order by UID DESC";
if(!$NoticeBoardListCnt) $NoticeBoardListCnt=5;
$sqlnoticestr="SELECT * FROM $BOARD_NAME $NoticeWhere $NoticeOrderBy LIMIT 0, $NoticeBoardListCnt";

$sqlnoticeqry=mysql_query($sqlnoticestr);
while($NOLIST=@mysql_fetch_array($sqlnoticeqry)):
$NOLIST[SUBJECT]=stripslashes($NOLIST[SUBJECT]);
if($SubjectLength) $NOLIST[SUBJECT]=STR_CUTTING($NOLIST[SUBJECT], $ListSubjectLength);

/* ������ ��� new icon�� ǥ���Ѵ�. */
if(time() < ($NOLIST[W_DATE]+ 24*60*60*$NEWTIME)) $NewWriteImg = showBoardIcon('new');
else $NewWriteImg ="";
$NOUPDIR1=explode("|",$NOLIST[UPDIR1]);
$noextention = strrchr($NOUPDIR1[0], ".");
$Arr_num = $NOLIST[BID] - 1;

// �� ������

if($NOLIST[COUNT] >=$HOT_HIT_COUNT ) $NOTICE_HOT_ICON = showBoardIcon('hot') ;  else $NOTICE_HOT_ICON = "" ;


?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" style="FONT-SIZE: 9pt; COLOR: #000000; LINE-HEIGHT: 14pt; vertical-align: bottom;">
        <tr onMouseOver="this.style.backgroundColor='#F1F1F1'" onMouseOut="this.style.backgroundColor=''">
          <? if($fm && $sysop && isAdmin()){?>
          <td width="20" align="center" valign="middle" ><input type="checkbox" name="deleteItem_<?=$NOLIST[UID]?>" value="<?=$NOLIST[UID]?>"></td>
          <? }?>
          <td width="60" height="26" align="center">
					<? if($NOLIST[UID]==$UID) echo showBoardIcon('arrow');
						 else echo "������";
					?>

          </td>
          <td>
            <? if($NOLIST[BID]) echo "[".$Category_Name[$Arr_num]."]"; //�з��� ������?>
            <a href="<?=$PHP_SELF?>?BID=<?=$BID;?>&GID=<?=$GID;?>&mode=view&UID=<?=$NOLIST[UID];?>&CURRENT_PAGE=<?=$CURRENT_PAGE;?>&SEARCHTITLE=<?=$SEARCHTITLE?>&searchkeyword=<?=$searchkeyword?>&category=<?=$category?>&sysop=<? echo $sysop; ?>&fm=<? echo $fm;?>&BType=<? echo $BType; ?>&ListMax=<? echo $ListMax; ?>">
            <?=$NOLIST[SUBJECT];?>
            </a> <? echo $NOTICE_HOT_ICON; echo $SecretImg; echo $NewWriteImg;  ?> </td>
          <td width="90" align="center">
            <?=$NOLIST[NAME]?>
          </td>
          <td width="70" align="center">
            <?=date("Y-m-d", $NOLIST[W_DATE])?>
          </td>
          <td width="40" align="center">
            <?=$NOLIST[COUNT];?>
          </td>
        </tr>
        <tr bgcolor="#DDDDDD">
          <td height="1" colspan="7"></td>
        </tr>
      </table>
      <?
$cnt++;
endwhile;


$START_NO = ($CURRENT_PAGE - 1) * $ListNo;
$BOARD_NO1=$TOTAL-($ListNo*($CURRENT_PAGE-1));
$SELECT_STR="SELECT * FROM $BOARD_NAME $WHERE $orderby LIMIT $START_NO, $ListNo";
//echo "query : ".$SELECT_STR;
$SELECT_QRY=mysql_query($SELECT_STR);
while($LIST=@mysql_fetch_array($SELECT_QRY)):
$LIST[SUBJECT]=stripslashes($LIST[SUBJECT]);
$LIST[NAME]=stripslashes($LIST[NAME]);
if($ListSubjectLength) $LIST[SUBJECT]=STR_CUTTING($LIST[SUBJECT], $ListSubjectLength);
if($ListNameLength) $LIST[NAME]=STR_CUTTING($LIST[NAME], $ListNameLength);

$SPARE1 = explode("|",$LIST[SPARE1]);
$TxtType = $SPARE1[0];// ������
$RepleMail = $SPARE1[1];// ���ø���
$Secret = $SPARE1[2];// ��б�
$MainDisplay = $SPARE1[3];// ������

/* ������ ��� new icon�� ǥ���Ѵ�. */
if(time() < ($LIST[W_DATE]+ 24*60*60*$NEWTIME)) $NewWriteImg = showBoardIcon('new');
else $NewWriteImg ="";
/* REPLY�� �̹����� ���� ��� �Ʒ� ����� ����մϴ�. */
$IMGNUM=strlen($LIST[THREAD])-1;
$SPACE="";
for($i=0; $i<$IMGNUM-1; $i++){
$SPACE .="&nbsp;&nbsp;";
}
/* ��аԽù��ϰ�� �Ʒ��� ��µȴ�.*/
if($Secret == "1"){
$SecretImg = showBoardIcon('key');
}
else $SecretImg ="";
/* ���� ������ �޸���� �� ������ ���Ѵ� */
$CommentCnt = @getSingleValue("select count(*) from ${BOARD_NAME}_comment where MID = '$LIST[UID]'");
$Arr_num = $LIST[BID] - 1;
$UPDIR1=explode("|",$LIST[UPDIR1]);
$extention = strrchr($UPDIR1[0], ".");

if($LIST[COUNT] >=$HOT_HIT_COUNT ) $HOT_ICON = showBoardIcon('hot'); else $HOT_ICON = "" ;

?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" style="FONT-SIZE: 9pt; COLOR: #000000; LINE-HEIGHT: 14pt; vertical-align: bottom;">
        <tr onMouseOver="this.style.backgroundColor='#F1F1F1'" onMouseOut="this.style.backgroundColor=''">
 					<? if($fm && $sysop && isAdmin()){?>
          <td width="20" align="center" valign="middle" class="pink_s"><span class="999999">
            <input type="checkbox" name="deleteItem_<?=$LIST[UID]?>" value="<?=$LIST[UID]?>">
            </span></td>
          <? } ?>
					<td width="60" height="26" align="center">
					<? if($LIST[UID]==$UID) echo showBoardIcon('arrow');
						 else echo $BOARD_NO1;
					?>
          </td>
          <td>
            <? if($IMGNUM){ echo $SPACE.showBoardIcon('re');} ?>
            <? if($LIST[BID]) echo "[".$Category_Name[$Arr_num]."]"; //�з��� ������?>
            <a href="<?=$PHP_SELF?>?BID=<?=$BID;?>&GID=<?=$GID;?>&mode=view&UID=<?=$LIST[UID];?>&CURRENT_PAGE=<?=$CURRENT_PAGE;?>&SEARCHTITLE=<?=$SEARCHTITLE?>&searchkeyword=<?=$searchkeyword?>&category=<?=$category?>&sysop=<? echo $sysop; ?>&fm=<? echo $fm;?>&BType=<? echo $BType; ?>&ListMax=<? echo $ListMax; ?>" >
            <?=$LIST[SUBJECT];?>
            <?if($CommentCnt > 0) echo "[$CommentCnt]";?>

            </a> <? echo $HOT_ICON; echo $SecretImg; echo $NewWriteImg;  ?> </td>
          <td width="90" align="center">
            <?=$LIST[NAME]?>
          </td>
          <td width="70" align="center">
            <?=date("Y-m-d", $LIST[W_DATE])?>
          </td>
          <td width="40" align="center">
            <?=$LIST[COUNT];?>
          </td>
        </tr>
        <tr bgcolor="#DDDDDD">
          <td height="1" colspan="7"></td>
        </tr>
      </table>
      <?
$BOARD_NO1--;
endwhile;
if(!$TOTAL):/* �Խù��� �������� ���� ��� */
?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" style="FONT-SIZE: 9pt; COLOR: #000000; LINE-HEIGHT: 14pt;  vertical-align: bottom;">
        <tr onMouseOver="this.style.backgroundColor='#F1F1F1'" onMouseOut="this.style.backgroundColor=''">
          <td height="26" align="center"> <p> ��ϵ� ���� �����ϴ�.</p></td>
        </tr>
        <tr>
          <td height="1" colspan="3" bgcolor="#DDDDDD"></td>
        </tr>
      </table>
      <?
endif;
?>
    </td>
  </tr>
  <tr>
    <td height="1"></td>
  </tr>
</table>
</form>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td height="40" bgcolor="#F5F5F5">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="390" style="padding-left:20px">
<?
include "./${BOARD_FOLDER_NAME}/skin_btnm/${BOTTOM_SKIN_TYPE}/index.php";
?>
          </td>
          <td width="560" align="right" style="padding-right:12px">
<?
include "./${BOARD_FOLDER_NAME}/skin_search/${SEARCH_SKIN_TYPE}/index.php";
?>
					</td>
        </tr>
      </table>
	</td>
</tr>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><img src="customer/img/blank.gif" width="1" height="7"></td>
  </tr>
  <tr>
    <td height="60" valign="top">
		<? if($fm && $sysop && isAdmin()){?>
		<img alt="����" src="./<? echo ${BOARD_FOLDER_NAME}; ?>/icon/<?=$ICON_SKIN_TYPE;?>/del_btn.gif" onClick = "deletefnc();" style="cursor:hand";>
		<? } ?></td>
    <td align="right" valign="top">
<?
if (isAdmin() || $AdminOnly != "Y")  echo showBoardIcon('write');
?>
    </td>
  </tr>
</table>
