<?
/*
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/

include ("./ROOT_CHECK.php");


if($rank_mode == "up"){

	$cur_ranking = getSingleValue("select Ranking from ${BOARD_GROUP_TABLE_NAME} where UID = '$UID'");
	if($cur_ranking == "1") $Ranking = "1";
	else $Ranking = $cur_ranking - 1 ;

	$sql = "update ${BOARD_GROUP_TABLE_NAME} set Ranking = '$Ranking' where UID = '$UID'";
	mysql_query($sql);
	js_location("${PHP_SELF}?menushow=$menushow&THEME=$THEME&CURRENT_PAGE=$CURRENT_PAGE&ListCount=$ListCount&SEARCHTITLE=$SEARCHTITLE&searchkeyword=$searchkeyword");
	exit;

}

if($rank_mode == "down"){

	$cur_ranking = getSingleValue("select Ranking from ${BOARD_GROUP_TABLE_NAME} where UID = '$UID'");

	$Ranking = $cur_ranking + 1 ;

	$sql = "update ${BOARD_GROUP_TABLE_NAME} set Ranking = '$Ranking' where UID = '$UID'";
	// echo $sql;

	mysql_query($sql);
	js_location("${PHP_SELF}?menushow=$menushow&THEME=$THEME&CURRENT_PAGE=$CURRENT_PAGE&ListCount=$ListCount&SEARCHTITLE=$SEARCHTITLE&searchkeyword=$searchkeyword");
	exit;

}


if(!strcmp($create_group,"makeit")){

	$WDate = time();
	// Group ID �ߺ� üũ
	$NewGroupID = trim($NewGroupID);
	$GroupCnt = getSingleValue("select count(*) from ${BOARD_GROUP_TABLE_NAME} where GID = '$NewGroupID'");
	if($GroupCnt > 0) js_alert_location("${NewGroupID} �� �̹� ������� �׷���̵� �Դϴ�.","-1");

	$cur_ranking = getSingleValue("select max(Ranking) from ${BOARD_GROUP_TABLE_NAME}");
	$next_ranking = $cur_ranking + 1 ;

	$sql = "insert into ${BOARD_GROUP_TABLE_NAME}  (GID , AdminID , Ranking , GrpSubject , WDate, SiteKey ) values (
			'$NewGroupID' , '$AdminID' , '$next_ranking', '$GrpSubject' , '$WDate', '$SiteKey' )";

	$result  = mysql_query($sql);

	if($result) js_alert_location("${NewGroupID} �׷��� �����Ǿ����ϴ�","${PHP_SELF}?menushow=$menushow&THEME=$THEME&CURRENT_PAGE=$CURRENT_PAGE&ListCount=$ListCount&SEARCHTITLE=$SEARCHTITLE&searchkeyword=$searchkeyword");
	else js_alert_location("DB �۾��� ������ �߻��Ͽ����ϴ�.","${PHP_SELF}?menushow=$menushow&THEME=$THEME&CURRENT_PAGE=$CURRENT_PAGE&ListCount=$ListCount&SEARCHTITLE=$SEARCHTITLE&searchkeyword=$searchkeyword");

}//�׷� �����


/* ���̺��� �� �н����� ���� */
if(!strcmp($MODE,"ChangeIt")){
$SQL_STR = "UPDATE ${BOARD_GROUP_TABLE_NAME} SET GrpSubject ='$GrpSubject', AdminID='$AdminID' WHERE GID='$GID'";
$SQL_QRY = mysql_query($SQL_STR) or die(mysql_error());
js_alert_location("���������� ����Ǿ����ϴ�.","${PHP_SELF}?menushow=$menushow&THEME=$THEME&CURRENT_PAGE=$CURRENT_PAGE&ListCount=$ListCount&SEARCHTITLE=$SEARCHTITLE&searchkeyword=$searchkeyword");
}


if(!strcmp($MODE , "DelG" )){
// ���� ����


if($GID == "") js_alert_location("�׷� ID ���� �Ѿ� ���� �ʾҽ��ϴ�.","-1");

$group_sql = "select GID , BID  from ${BOARD_MAIN_TABLE_NAME} where GID='$GID'";

$group_result = mysql_query($group_sql);
while($list = mysql_fetch_array($group_result)):


/******** ä������ ���� **************/

if(is_dir("../${BOARD_FOLDER_NAME}/channel/${GID}_${list[BID]}")):

	$LOG_DIR = opendir("../${BOARD_FOLDER_NAME}/channel/${GID}_${list[BID]}");
	while($LOG_FILE = readdir($LOG_DIR)) {
		if($LOG_FILE !="." && $LOG_FILE !=".."){
			  unlink("../${BOARD_FOLDER_NAME}/table/${GID}_${list[BID]}/$LOG_FILE");
		}
	}
	closedir($LOG_DIR);
	$result = rmdir("../${BOARD_FOLDER_NAME}/channel/${GID}_${list[BID]}");
	if(!$result) js_alert_location("./${BOARD_FOLDER_NAME}/channel/${GID}_${list[BID]} �� �������� ���߽��ϴ�. �������� ������ �ּ���","-1");

endif;



/******** ���ε��� ���� ���� updir ���� **************/
$LOG_DIR = opendir("../${BOARD_FOLDER_NAME}/table/${GID}/${list[BID]}/updir");
while($LOG_FILE = readdir($LOG_DIR)) {
	if($LOG_FILE !="." && $LOG_FILE !=".."){
          unlink("../${BOARD_FOLDER_NAME}/table/${GID}/${list[BID]}/updir/$LOG_FILE");
	}
}
closedir($LOG_DIR);

$uresult = rmdir("../${BOARD_FOLDER_NAME}/table/${GID}/${list[BID]}/updir");
if(!$uresult) js_alert_location("./${BOARD_FOLDER_NAME}/table/${GID}/${list[BID]}/updir �� �������� ���߽��ϴ�. �������� ������ �ּ���","-1");


/******** config ���� ���� �� table ���丮 ���� **************/
$LOG_DIR2 = opendir("../${BOARD_FOLDER_NAME}/table/${GID}/${list[BID]}");
while($LOG_FILE2 = readdir($LOG_DIR2)) {
	if($LOG_FILE2 !="." && $LOG_FILE2 !=".."){
          unlink("../${BOARD_FOLDER_NAME}/table/${GID}/${list[BID]}/$LOG_FILE2");
	} //if($LOG_FILE !="." && $LOG_FILE !="..") ����
}
closedir($LOG_DIR2);


$ccresult = rmdir("../${BOARD_FOLDER_NAME}/table/${GID}/${list[BID]}");
if(!$ccresult) js_alert_location("./${BOARD_FOLDER_NAME}/table/${GID}/${list[BID]}/updir �� �������� ���߽��ϴ�. �������� ������ �ּ���","-1");


rmdir("../${BOARD_FOLDER_NAME}/table/${GID}");// �׷����� ����

/* comment ���̺� ���� */

$deli = 0;
$i = 0 ;
$comment_result = mysql_list_tables ($MYSQL_DB);
while ($i < mysql_num_rows ($comment_result)) {
   $tb_names[$i] = mysql_tablename ($comment_result, $i);
   if("${DEFAULT_TABLE_NAME}_${GID}_{$list[BID]}_comment" == $tb_names[$i]) $deli = 1 ;
  	$i++;
}

if($deli == 1){// �ڸ�Ʈ ���̺��� ���� �Ұ�� ����
	$COMMENT_DROP = "DROP TABLE ${DEFAULT_TABLE_NAME}_${GID}_${list[BID]}_comment";
	$cresult = mysql_query($COMMENT_DROP) or die(mysql_error());
	if(!$cresult) js_alert_location("${DEFAULT_TABLE_NAME}_${GID}_${list[BID]}_comment �� �������� ���߽��ϴ�. �������� ������ �ּ���","-1");
}


/* ���̺� ���� */
$TABLE_DROP = "DROP TABLE ${DEFAULT_TABLE_NAME}_${GID}_${list[BID]}";
$tresult = mysql_query($TABLE_DROP) or die(mysql_error());
if(!$tresult) js_alert_location("${DEFAULT_TABLE_NAME}_${GID}_${list[BID]} �� �������� ���߽��ϴ�. �������� ������ �ּ���","-1");



$MAIN_TABLE_DEL = "delete from ${BOARD_MAIN_TABLE_NAME} where GID='$GID' and BID = '${list[BID]}'";
mysql_query($MAIN_TABLE_DEL) or die(mysql_error());

endwhile;

/* ${BOARD_MAIN_TABLE_NAME} w ���� ���� ���� ���� ���� */

$QUERY_DEL = "delete from ${BOARD_GROUP_TABLE_NAME} where GID='$GID'";
$gresult = mysql_query($QUERY_DEL) or die(mysql_error());

if($gresult) js_alert_location("${GID} �׷��� ���������� �����Ͽ����ϴ�.","${PHP_SELF}?menushow=$menushow&THEME=$THEME&GID=${GID}&CURRENT_PAGE=$CURRENT_PAGE&Grp=$Grp&ListCount=$ListCount&SEARCHTITLE=$SEARCHTITLE&searchkeyword=$searchkeyword");


// ���� �P

}

?>
<script>
<!--

function checkForm(f){

	if(!f.NewGroupID.value){
		alert("�׷���̵� �Է����ּ���");
		f.NewGroupID.focus();
		return false;
	}else if(!TypeCheck(f.NewGroupID.value,NUM+ALPHA)){
		alert("�׷���̵�� ����/���� ���ո� �����մϴ�.");
		f.NewGroupID.focus();
		return false;
	}else if(!f.GrpSubject.value){
		alert("�׷���� �Է����ּ���");
		f.GrpSubject.focus();
		return false;
	}

}


function del_confirm(f,GID){

	var con = confirm("\n\n�׷��� ���� �Ǹ� ���� ���̺� ������ �˴ϴ� \n\n ������ �����Ͻðڽ��ϱ�?");
	if(con){
		location.href ='<?=$PHP_SELF?>?menushow=<? echo $menushow ; ?>&THEME=<? echo $THEME; ?>&GID=' + GID + '&CURRENT_PAGE=<?=$CURRENT_PAGE?>&MODE=DelG';
	};


}

//-->
</script>

<table  width="770" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="8"></td>
    <td height="8"></td>
  </tr>
  <tr>
    <td> </td>
    <td valign="top">
	<table width="770" border="0" cellpadding="5" cellspacing="5" bgcolor="EEEEEE">
        <tr>
          <td align="center" bgcolor="#FFFFFF"><table width="730"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="30" class="black_16"><strong><font color="#3366CC">�Խ��Ǳ׷� ����</font></strong></td>
              </tr>
              <tr>
                <td>�Խ��� �׷���� ���� ���� �ϽǼ� �ֽ��ϴ�<br>
                  </td>
              </tr>
            </table></td>
        </tr>
      </table>
	<br>
      <table width=100% cellpadding="5" cellspacing="1"  border=0 align="center" <? echo $TABLE_STYLE; ?>>
        <FORM name = "TableFrm" action="<? echo $_SERVER[PHP_SELF]; ?>" method="post" onSubmit = "return checkForm(this);">
         <input type=hidden name= menushow value=<? echo $menushow; ?>>
          <input type=hidden name="THEME" value="<?=$THEME?>">
         <input type="hidden" name="create_group" value="makeit">
          <tr bgcolor=#ffffff>
            <td width=92>�׷���̵�</td>
            <td width="107"> <input name="NewGroupID" size = "15"  maxlength = 20> </font></td>
            <td width=67>�׷��</td>
            <td width="208"> <input name="GrpSubject" size = "30"  maxlength = 30> </font></td>
            <td align=middle width=82>�׷������</td>
            <td width="82" align=middle> <input name="AdminID" type="text"  size=8 maxlength=20> </font>
            </td>
            <td align=middle width=54><input type="image" src="./img/btn_set/btn_create.gif" align = "absmiddle" class = "noninput"></td>
          </tr>
        </form>
      </table>
      <br>
      <table width=100% cellpadding="5" cellspacing="1"  border=0 align="center" <? echo $TABLE_STYLE; ?>>
        <tr align="center" >
          <td width=7% <? echo $TITLE_STYLE ; ?>>����</td>
          <td width=12% <? echo $TITLE_STYLE ; ?>>�׷���̵�</td>
          <td width=29% <? echo $TITLE_STYLE ; ?>>�׷��</td>
          <td width=15% <? echo $TITLE_STYLE ; ?>>�׷������</td>
          <td width="10%" <? echo $TITLE_STYLE ; ?>>�Խ��Ǽ�</td>
          <td width=9% <? echo $TITLE_STYLE ; ?>>����</td>
          <td width=9% <? echo $TITLE_STYLE ; ?>>����</td>
          <td width=9% <? echo $TITLE_STYLE ; ?>>����</td>
        </tr>
        <?

$WHERE = "WHERE UID <> '' ";
if($SEARCHTITLE && $searchkeyword) $WHERE .= "and $SEARCHTITLE like '%$searchkeyword%'";
$TargetBoard = "${BOARD_GROUP_TABLE_NAME} ";
$TOTAL = getSingleValue("SELECT count(UID) FROM $TargetBoard $WHERE");
if(!isset($ListCount) || !$ListCount) $ListCount = 10;
$LIST_NO=$ListCount; /* �������� ��� ����Ʈ �� */


if(empty($CURRENT_PAGE) || $CURRENT_PAGE <= 0) $CURRENT_PAGE = 1;
//--������ ��Ÿ����--
$TP = ceil($TOTAL / $LIST_NO) ; /* ������ �ϴ��� �� �������� */
$CB = ceil($CURRENT_PAGE / $PageNo);
$SP = ($CB - 1) * $PageNo + 1;
$EP = ($CB * $PageNo);
$TB = ceil($TP / $PageNo);
//--��������ũ�� �ۼ��ϱ�--



$START_NO = ($CURRENT_PAGE - 1) * $LIST_NO;
$BOARD_NO=$TOTAL-($LIST_NO*($CURRENT_PAGE-1));
$SELECT_STR="SELECT * FROM $TargetBoard $WHERE ORDER BY Ranking ASC LIMIT $START_NO, $LIST_NO";
$SELECT_QRY=mysql_query($SELECT_STR);
while($GROUP_LIST=@mysql_fetch_array($SELECT_QRY)):
?>
        <tr bgcolor=#ffffff>
          <FORM  ACTION="<? echo $_SERVER[PHP_SELF]; ?>">
            <input type="hidden" name="GID" value="<?=$GROUP_LIST[GID]?>">
            <input type="hidden" name="MODE" value="ChangeIt">
            <input type=hidden name= "menushow" value=<? echo $menushow; ?>>
            <input type="hidden" name="THEME" value="<?=$THEME?>">
            <input type="hidden" name="CURRENT_PAGE" value="<?=$CURRENT_PAGE?>">
            <input type="hidden" name="ListCount" value="<?=$ListCount?>">
            <input type="hidden" name="SEARCHTITLE" value="<?=$SEARCHTITLE?>">
            <input type="hidden" name="searchkeyword" value="<?=$searchkeyword?>">
            <td align=center <? echo $LEFT_STYLE; ?>>
              <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                <tr>
                  <td align = center><a href = "<? echo $_SERVER[PHP_SELF];?>?THEME=<? echo $THEME; ?>&menushow=<? echo $menushow;?>&UID=<?=$GROUP_LIST[UID]?>&CURRENT_PAGE=<? echo $CURRENT_PAGE; ?>&rank_mode=up"><img src = "./img/btn_up.gif" align = absmiddle border = 0></a></td>
                </tr>
                <tr>
                  <td align = center><a href = "<? echo $_SERVER[PHP_SELF];?>?THEME=<? echo $THEME; ?>&menushow=<? echo $menushow;?>&UID=<?=$GROUP_LIST[UID]?>&CURRENT_PAGE=<? echo $CURRENT_PAGE; ?>&rank_mode=down"><img src = "./img/btn_down.gif" align = absmiddle border = 0></a></td>
                </tr>
              </table> </td>
            <td align=middle <? echo $LEFT_STYLE; ?>><?=$GROUP_LIST[GID]?></td>
            <td align=middle > <input name=GrpSubject   value="<?=$GROUP_LIST[GrpSubject ]?>" size=30 maxlength=20>
            </td>
            <td align=center > <input size=10 name=AdminID  value="<?=$GROUP_LIST[AdminID]?>">
            </td>
            <td  align=center> <? echo number_format(getTableCountByGroup($GROUP_LIST[GID]))?>
              �� </td>
            <td align=center><img src="./img/btn_set/btn_modify_02.gif" onclick="javascript:submit()"; style="cursor:hand;"></td>
            <td align=center><A HREF="<? echo $_SERVER['PHP_SELF'];?>?menushow=menu7&THEME=BoardManager&GID=<? echo $GROUP_LIST[GID]; ?>"><img src="./img/btn_set/btn_view_02.gif" border="0"></a></td>
            <td align=center><A HREF="javascript:del_confirm(this.form,'<? echo $GROUP_LIST[GID]; ?>','<? echo $GROUP_LIST[BID]?>')"><img src="./img/btn_set/btn_img06.gif" border="0"></a></td>
          </form>
        </tr>
        <?
endwhile;
?>
      </table>
      <br> <table cellspacing=0 cellpadding=0 width="100%" border=0>
        <tr>
          <td align=center >
<?
	$PostValue = "menushow=$menushow&THEME=$THEME&SEARCHTITLE=$SEARCHTITLE&searchkeyword=$searchkeyword&ListCount=$ListCount";
	include "./adminskin/pageskin/$PGSKIN/index.php" ;
?>


           </td>
        </tr>
      </table>
      <br> </td>
  </tr>
</table>
