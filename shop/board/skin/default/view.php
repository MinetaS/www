<?
/*
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/

if(!$UID) js_alert_location("�ش� �� ��ȣ�� ���� ���� �ʽ��ϴ�.","-1");

/* channel�� ī��Ʈ �ֱ� */
MakeChannel($GID."_".$BID);

/* ȸ������̸� �α��� ���¿� ȸ������� åũ�Ͽ� ���� ���� �� �ִ� ������ �ο��Ѵ�. */
include "./${BOARD_FOLDER_NAME}/func/GradePermission.php";
/* ������ �����ۿ��� �������� UID �� �������� UID�� ���Ѵ� */
if($category) $catwhere = "AND BID = '$category'";
$PRE_BOARD_STR = "SELECT UID, SUBJECT FROM $BOARD_NAME WHERE UID > '$UID'  $catwhere ORDER BY UID ASC LIMIT 1";
$PRE_BOARD = _mysql_fetch_array($PRE_BOARD_STR);
$PRE_BOARD[1] = stripslashes($PRE_BOARD[1]);
$PRE_BOARD[1] = STR_CUTTING($PRE_BOARD[1], $ViewSubjectLength);
$NEXT_BOARD_STR = "SELECT UID, SUBJECT FROM $BOARD_NAME WHERE UID < '$UID' $catwhere ORDER BY UID DESC LIMIT 1";
$NEXT_BOARD = _mysql_fetch_array($NEXT_BOARD_STR);
$NEXT_BOARD[1] = stripslashes($NEXT_BOARD[1]);
$NEXT_BOARD[1] = STR_CUTTING($NEXT_BOARD[1], $ViewSubjectLength);


/* �ڸ�Ʈ ����Ѵ� */
if(!strcmp($COMMENT_MODE, "WRITE")){
include "./${BOARD_FOLDER_NAME}/func/WRITE_COMMENT.php";
}


/* VIEW ������ DB���� �����´� */
$SELECT_STR="SELECT * FROM $BOARD_NAME where UID='$UID'";
$SELECT_QRY=mysql_query($SELECT_STR);
$LIST=mysql_fetch_array($SELECT_QRY);

$SPARE1 = explode("|", $LIST[SPARE1]);
# TxtType 0; text, 1:html, 2:txt+br
$TxtType = $SPARE1[0];
$RepleMail = $SPARE1[1];
$Secret = $SPARE1[2];
$MainDisplay = $SPARE1[3];// ������ ���

$LIST[CONTENTS]=stripslashes($LIST[CONTENTS]);
if ($TxtType != "1" && $LIST[TxtType] != "2")
{   $LIST[CONTENTS] = str_replace("&nbsp;", "&amp;nbsp;", $LIST[CONTENTS]);
	$LIST[CONTENTS] = eregi_replace(" ", "&nbsp;", $LIST[CONTENTS]);
	$LIST[CONTENTS] = eregi_replace("	", "&nbsp;&nbsp;&nbsp;&nbsp;", $LIST[CONTENTS]);
	if ($AutoLink == 'Y') $LIST[CONTENTS] = auto_link($LIST[CONTENTS]);
}
if($TxtType != "1") $LIST[CONTENTS]=nl2br($LIST[CONTENTS]);

$LIST[SUB_CONTENTS1]=stripslashes($LIST[SUB_CONTENTS1]);
if ($TxtType != "1" && $LIST[TxtType] != "2")
{
	$LIST[SUB_CONTENTS1] = eregi_replace(" ", "&nbsp;", $LIST[SUB_CONTENTS1]);
	$LIST[SUB_CONTENTS1] = eregi_replace("	", "&nbsp;&nbsp;&nbsp;&nbsp;", $LIST[SUB_CONTENTS1]);
	if ($AutoLink == 'Y') $LIST[SUB_CONTENTS1] = auto_link($LIST[SUB_CONTENTS1]);
}
if($TxtType != "1") $LIST[SUB_CONTENTS1]=nl2br($LIST[SUB_CONTENTS1]);

$LIST[SUB_CONTENTS2]=stripslashes($LIST[SUB_CONTENTS2]);
if ($TxtType != "1" && $LIST[TxtType] != "2")
{
	$LIST[SUB_CONTENTS2] = eregi_replace(" ", "&nbsp;", $LIST[SUB_CONTENTS2]);
	$LIST[SUB_CONTENTS2] = eregi_replace("	", "&nbsp;&nbsp;&nbsp;&nbsp;", $LIST[SUB_CONTENTS2]);
	if ($AutoLink == 'Y') $LIST[SUB_CONTENTS2] = auto_link($LIST[SUB_CONTENTS2]);
}
if($TxtType != 1) $LIST[SUB_CONTENTS2]=nl2br($LIST[SUB_CONTENTS2]);


$LIST[NAME]=stripslashes($LIST[NAME]);
$LIST[SUBJECT]=stripslashes($LIST[SUBJECT]);
if($ViewSubjectLength) $LIST[SUBJECT]=STR_CUTTING($LIST[SUBJECT], $ViewSubjectLength);
if($ViewNameLength) $LIST[NAME]=STR_CUTTING($LIST[NAME], $ViewNameLength);

$UPDIR1=explode("|",$LIST[UPDIR1]);

/* ��аԽù��̸� �����ڿ� ���ۼ����� �н����带 Ȯ���Ͽ� ������ ���� �� �ְ� �Ѵ�. */
if(!isAdmin()):// �����ڴ� �н�

	if($Secret == "1" && $_COOKIE[SECRET] != $UID."_".$BID."_".$GID && !$LIST[ID]){//  ȸ���� ������ �ƴҰ��� ����� ��Ÿ����.
	/* ���� $_COOKIE[SECRET] �� �ְ� $UID�� �ٸ� ��� �� 2�������� $_COOKIE[SECRET]�� FID �� ������ ���� ������ �ִ��� ��ȣ �� */
		if($_COOKIE[SECRET]){
			$tmparr = explode("-", $_COOKIE[SECRET]);
			$FID = getSingleValue("select FID from $BOARD_NAME where UID = '$tmparr[0]'") ;
			if($LIST[FID] != $FID){
				js_location("./${BOARD_MAIN_FILE_NAME}?mode=secret&BID=$BID&GID=$GID&nmode=$mode&UID=$UID&CURRENT_PAGE=$CURRENT_PAGE&category=$category&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax");
				exit;
			}
		}else{
			js_location("./${BOARD_MAIN_FILE_NAME}?mode=secret&BID=$BID&GID=$GID&nmode=$mode&UID=$UID&CURRENT_PAGE=$CURRENT_PAGE&category=$category&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax");
			exit;
		}
	} else if($Secret == "1" && $LIST[ID]){

		if(isMember()){// ȸ��

			if($_COOKIE[MEMBER_ID] != $LIST[ID]){
					$THREAD = $LIST[THREAD];
					$AFTERT_THREAD = substr($THREAD , 0 , -1);// ���ܰ� Depth
					// �ڱⰡ ������ �ƴ����� �׷��� ���� ���� �׷��� ���غ���.
					$FID = getSingleValue("select FID from $BOARD_NAME where  THREAD = '$AFTERT_THREAD' and FID = '$LIST[FID]'") ;
					if($LIST[FID] != $FID){
						js_alert_location("���θ� Ȯ���ϽǼ� �ֽ��ϴ�.","-1");
					}

			}

		} else { // ��ȸ���� �α��� ������ ����
				include "./function/member_check_module.php";
		}

	}

endif;// ��б�üũ

if($LIST[ID] != $_COOKIE[MEMBER_ID]): // �ڽ��� ������ ��ȸ�� ���� ��Ű�� �ʴ´�.
	$COUNT_STR="UPDATE $BOARD_NAME SET COUNT=COUNT + 1 WHERE UID='$UID'";
	$RESULT=mysql_query($COUNT_STR) or die(mysql_error());
endif;


// ��õ (��õ�̳� ����õ�̳� �ѹ��� �ǵ��� ����)

if($RECOMMAND == "GOOD" || $RECOMMAND == "BAD"){

	if(!isMember()) js_alert_location("ȸ������ ��õ�ϽǼ� �ֽ��ϴ�.","$PHP_SELF?BID=$BID&GID=$GID&mode=view&UID=$UID&CURRENT_PAGE=$CURRENT_PAGE&category=$category&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax");

	if($_COOKIE[MEMBER_ID] == $LIST[ID]) js_alert_location("������ ��õ�ϽǼ� �����ϴ�.","$PHP_SELF?BID=$BID&GID=$GID&mode=view&UID=$UID&CURRENT_PAGE=$CURRENT_PAGE&category=$category&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax");

	if(!boolRecommandExistID($BOARD_NAME , $UID , $_COOKIE[MEMBER_ID], $RECOMMAND, "BOARD")) include "./${BOARD_FOLDER_NAME}/func/RECOMMAND.php";
	else js_alert_location("�̹� ��õ �ϼ̽��ϴ�.","$PHP_SELF?BID=$BID&GID=$GID&mode=view&UID=$UID&CURRENT_PAGE=$CURRENT_PAGE&category=$category&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax");
}


?>
<SCRIPT>
<!--
function DELETE_THIS(UID,CURRENT_PAGE,BID,GID){
window.open("./<? echo ${BOARD_FOLDER_NAME}; ?>/delete.php?UID="+UID+"&CURRENT_PAGE="+CURRENT_PAGE+"&BID="+BID+"&GID="+GID+"&sysop=<? echo $sysop; ?>&fm=<? echo $fm;?>&BType=<? echo $BType; ?>&ListMax=<? echo $ListMax; ?>","","scrollbars=no, toolbar=no, width=340, height=150, top=220, left=350")
}

function down(updir, uid){
file_url = "./<? echo ${BOARD_FOLDER_NAME}; ?>/download.php?filename="+updir+"&UID="+uid+"&BID=<?=$BID?>&GID=<?=$GID?>&sysop=<? echo $sysop; ?>&fm=<? echo $fm;?>&BType=<? echo $BType; ?>&ListMax=<? echo $ListMax; ?>";
location.href=file_url;
}

function printThis(){
window.open('./<? echo ${BOARD_FOLDER_NAME}; ?>/skin/<?=$BOARD_SKIN_TYPE?>/print.php?UID=<?=$UID?>&BID=<?=$BID?>&GID=<?=$GID?>&sysop=<? echo $sysop; ?>&fm=<? echo $fm;?>&BType=<? echo $BType; ?>&ListMax=<? echo $ListMax; ?>','printer','resizable=yes,width=630,height=650');
}
//-->
</SCRIPT>


<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td valign="bottom" style="padding-bottom:2px" class="text-smalltahoma2"><img src="./<?=${BOARD_FOLDER_NAME}?>/skin/<?=$BOARD_SKIN_TYPE;?>/images/dot03.gif" width="9" height="5">&nbsp;
            date : <strong>
            <?=date("Y-m-d", $LIST[W_DATE])?>
            </strong> | view : <strong>
            <?=$LIST[COUNT];?>
            </strong></td>
          <td height="35" align="right" valign="bottom" style="padding-bottom:2px" class="paging">
           </td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="1" colspan="4"bgcolor="#DDDDDD"></td>
        </tr>
        <tr>
          <td width="100" height="26" align="center" bgcolor="#efefef"><strong>�̸�</strong></td>
          <td width="190" bgcolor="#F5F5F5" style="padding-left:5" class="text"><?=$LIST[NAME]?></td>
          <td width="100" align="center" bgcolor="#efefef"><strong>�̸���</strong></td>
          <td bgcolor="#F5F5F5" style="padding-left:5">
            <?=$LIST[EMAIL];?>
            </td>
        </tr>
        <tr>
          <td height="1" colspan="4"bgcolor="#DDDDDD"></td>
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
          <td bgcolor="#F5F5F5" class="text-small" style="padding-left:5">                                    <?
									$key = $LIST["BID"] - 1;
									echo $CategoryContents[$key];
									?></td>
        </tr>
        <tr>
          <td height="1" colspan="2" bgcolor="#DDDDDD"></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="1"></td>
  </tr>
  <?endif;?>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100" height="26" align="center" bgcolor="#efefef"><strong>����</strong></td>
          <td bgcolor="#F5F5F5" class="text" style="padding-left:5"><strong>
            <?=$LIST[SUBJECT];?>
            </strong>(��õ�� : <? echo number_format(getTotalCountRecommand($BOARD_NAME , $UID , "GOOD" , "BOARD")); ?>&nbsp; |
            ����õ�� : <? echo number_format(getTotalCountRecommand($BOARD_NAME , $UID , "BAD" , "BOARD")); ?>)</td>
        </tr>
        <tr>
          <td height="1" colspan="2" bgcolor="#DDDDDD"></td>
        </tr>
        <tr>
          <td height="1"></td>
        </tr>
      </table></td>
  </tr>
  <? for($i = 0 ; $i < sizeof($UPDIR1) && $UPDIR1[$i]; $i++){?>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100" height="26" align="center" bgcolor="#efefef"><strong>÷��(<? echo $i+1;?>) </strong></td>
          <td bgcolor="#F5F5F5" class="text" style="padding-left:5"><strong>
            <? if($UPDIR1[$i]):?>
            <a href="javascript:down('<? echo $UPDIR1[$i]; ?>','<? echo $LIST[UID]; ?>')">
            <?=$UPDIR1[$i]?>
            </a> (<? echo getFileSize($UPDIR1[$i],$BID) ; ?>)
            <? endif;?>
          </td>
        </tr>
        <tr>
          <td height="1" colspan="2" bgcolor="#DDDDDD"></td>
        </tr>
        <tr>
          <td height="1"></td>
        </tr>
      </table></td>
  </tr>
	 <? } ?>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td valign="top" style="padding-left:15; padding-right:15; padding-top:12; padding-bottom:15;word-break:break-all;"><? for($i = 0 ; $i < sizeof($UPDIR1) && $UPDIR1[$i]; $i++){?>
            <table width="100%" border="0" cellspacing="5">
              <tr>
                <td><? file_display($UPDIR1[$i],  "./${BOARD_FOLDER_NAME}/table/$UpdirPath/updir",550); ?>
                </td>
              </tr>
            </table>
            <? }?>
            <? echo $LIST[CONTENTS];?> </td>
        </tr>
      </table>
      <? if($CommentEnable == "Y"):?>
      <!-- comment start -->
      <? include "./${BOARD_FOLDER_NAME}/skin_comment/${COMMENT_SKIN_TYPE}/comment.php"; ?>
      <!-- comment end -->
      <? endif; ?>
    </td>
  </tr>
  <tr>
    <td><img src="<? echo ${BOARD_FOLDER_NAME} ?>/skin/<? echo $BOARD_SKIN_TYPE; ?>/images/blank.gif" width="1" height="2"></td>
  </tr>
  <tr>
    <td>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">

      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="1" colspan="2"bgcolor="#DDDDDD"></td>
            </tr>
            <tr>
              <td width="100" height="26" align="center" bgcolor="#efefef"><strong>������</strong></td>
              <td bgcolor="#F5F5F5" class="text" style="padding-left:5"><? if($PRE_BOARD[0]):?>
                <a href="<? echo $_SERVER[PHP_SELF];?>?BID=<?=$BID;?>&GID=<? echo $GID; ?>&mode=view&UID=<?=$PRE_BOARD[0];?>&category=<?=$category?>&CURRENT_PAGE=<?=$CURRENT_PAGE;?>&SEARCHTITLE=<?=$SEARCHTITLE?>&searchkeyword=<?=$searchkeyword?>&sysop=<? echo $sysop; ?>&fm=<? echo $fm;?>&BType=<? echo $BType; ?>&ListMax=<? echo $ListMax; ?>">
                <?=$PRE_BOARD[1]?>
                </a>
                <? else: echo "�������� �����ϴ�."; endif;?></td>
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
              <td width="100" height="26" align="center" bgcolor="#efefef"><strong>������</strong></td>
              <td bgcolor="#F5F5F5" class="text" style="padding-left:5"><? if($NEXT_BOARD[0]):?>
                <a href="<? echo $_SERVER[PHP_SELF];?>?BID=<?=$BID;?>&GID=<? echo $GID ; ?>&mode=view&UID=<?=$NEXT_BOARD[0];?>&category=<?=$category?>&CURRENT_PAGE=<?=$CURRENT_PAGE;?>&SEARCHTITLE=<?=$SEARCHTITLE?>&searchkeyword=<?=$searchkeyword?>&sysop=<? echo $sysop; ?>&fm=<? echo $fm;?>&BType=<? echo $BType; ?>&ListMax=<? echo $ListMax; ?>">
                <?=$NEXT_BOARD[1]?>
                </a>
                <? else: echo "�������� �����ϴ�."; endif;?></td>
            </tr>
            <tr>
              <td height="1" colspan="2"bgcolor="#DDDDDD"></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td height="1"></td>
      </tr>
    </table><br>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr valign="top">
        <td width="820" height="60"><?=showBoardIcon("list");?></td>
        <td width="55" align="right"><?=showBoardIcon('recomm');?></td>
        <td width="55" align="right"><?=showBoardIcon('none_recomm');?></td>
        <? if($USE_SCRAB): ?>
        <td width="55" align="right"><?=showBoardIcon('scrap');?></td>
        <? endif; ?>
				<? if(!strcmp($ReplyBtn,"Y") && !$MainDisplay): //�������� ������ ���� �ʴ´�.?>
        <td width="55" align="right"><?=showBoardIcon('reply');?></td>
				<? endif; ?>
				<?
				if (isAdmin() || $AdminOnly != "Y") :
				?>
				<td width="55" align="right"><?=showBoardIcon('modify');?></td>
				<td width="55" align="right"><?=showBoardIcon('delete');?></td>
			<?
			endif;
			?>
      </tr>
    </table>
    </td>
  </tr>
</table>
<?
/* ����Ʈ ������ ���� */
if($ListEnable == "Y"):
echo "<br><br>" ;
$ThisFileName = basename(__FILE__); // get the file name
$path = str_replace($ThisFileName,"",__FILE__);   // get the directory path
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="<?=$TABLE_ALIGN?>">
	<tr>
		<td valign="top">
<?
include "${path}/list.php";
?></td>
	</tr>
</table>
<?
endif;
?>
