<?
##################################################################################################################	 	
#				Written by kerrigancap
#				Copyright kerrigancap
#				Date 2005 . 02 . 26	   
##################################################################################################################
if (phpversion() >= 4.2) {
   if (count($_POST)) extract($_POST, EXTR_PREFIX_SAME, 'VARS_');
   if (count($_GET)) extract($_GET, EXTR_PREFIX_SAME, '_GET');
   if (count($_SERVER)) extract($_SERVER, EXTR_PREFIX_SAME, 'SERVER_');
   if (count($_FILES)) extract($_FILES, EXTR_PREFIX_SAME, 'FILES_' );
   if (count($_ENV)) extract($_ENV, EXTR_PREFIX_SAME, 'ENV_');
   if (count($_COOKIE)) extract($_COOKIE, EXTR_PREFIX_SAME, 'COOKIE_');
   if (count($_SESSION)) extract($_SESSION, EXTR_PREFIX_SAME, 'SESSION_');
}

##################################################################################################################
# ������ �� �÷� ����
##################################################################################################################

if($_COOKIE[ROOT_COLOR_TYPE] == "1"){
//Dark Skin
// ���̺� 1px �׵θ� ���� 
$TABLE_STYLE = "bgcolor = 'CCCCCC'" ;
//Ÿ��Ʋ ū������ ��Ÿ��
$TITLE_STYLE = " bgcolor = '000000' class = 'title_big'" ;
// Ÿ��Ʋ ���� ������ ��Ÿ��
$TITLE_SMALL_STYLE = " bgcolor = '000000' class = 'title_small'" ; 
// ������ ����Ʈ TD Ÿ��Ʋ ��Ÿ�� 
$LEFT_STYLE = " bgcolor = 'CE0000' class = 'title_small'" ; 
// ������ ������ TD ��Ÿ��
$CONTENT_STYLE = "bgcolor = 'FFFFFF'";

}else if($_COOKIE[ROOT_COLOR_TYPE] == "2"){

// BlueRay Skin
// ���̺� 1px �׵θ� ���� 
$TABLE_STYLE = "bgcolor = 'B9CFE3'" ;
//Ÿ��Ʋ ū������ ��Ÿ��
$TITLE_STYLE = " bgcolor = '005584' class = 'title_big'" ; 
// Ÿ��Ʋ ���� ������ ��Ÿ��
$TITLE_SMALL_STYLE = " bgcolor = '000000' class = 'title_small'" ; 
// ������ ����Ʈ TD Ÿ��Ʋ ��Ÿ�� 
$LEFT_STYLE = " bgcolor = 'F0F8FF' class = 'blue_admin'" ; 
// ������ ������ TD ��Ÿ��
$CONTENT_STYLE = "bgcolor = 'FFFFFF'";

} else if($_COOKIE[ROOT_COLOR_TYPE] == "3"){
//Grace Skin
$TABLE_STYLE = "bgcolor = 'B9CFE3'" ;
//Ÿ��Ʋ ū������ ��Ÿ��
$TITLE_STYLE = " bgcolor = '00A6A8' class = 'title_big'" ; 
// Ÿ��Ʋ ���� ������ ��Ÿ��
$TITLE_SMALL_STYLE = " bgcolor = '000000' class = 'title_small'" ; 
// ������ ����Ʈ TD Ÿ��Ʋ ��Ÿ�� 
$LEFT_STYLE = " bgcolor = 'E5F6F6' class = 'blue_admin_02'" ; 
// ������ ������ TD ��Ÿ��
$CONTENT_STYLE = "bgcolor = 'FFFFFF'";

}

##################################################################################################################	 		  
# ���� ���ε�� ���
##################################################################################################################


function file_uploade($file_field_name){
global $file_field_name, $file_name, $file_type, $file_error, $file_size, $file_tmp_name;
$file_name=$_FILES[$file_field_name]['name'];
$file_type=$_FILES[$file_field_name]['type'];
$file_error=$_FILES[$file_field_name]['error'];
$file_size=$_FILES[$file_field_name]['size'];
$file_tmp_name=$_FILES[$file_field_name]['tmp_name'];
}


##################################################################################################################	 		  
# ���� �̵� ��ũ��Ʈ
##################################################################################################################	 

					 
function js_location($val) {
	if ($val < 0) {
		echo "<script language='javascript'>history.go(${val});</script>";
	} else if ($val == 'close') {
		echo "<script language='javascript'>self.close();</script>";
	} else if ($val == "parent") {
		echo "<script language='javascript'>opener.location.reload();self.close();</script>";
	} else if ($val == "reload") {
		echo "<script language='javascript'>location.reload();</script>";
	} else {
		echo "<script language='javascript'>location.replace ('$val');</script>";
	}
	exit;
}

function js_alert($val) {
	echo "<script language='javascript'>alert ('$val');</script>";
}

function js_alert_location($val, $val2) {
	js_alert ($val);
	js_location ($val2);
	exit;
}
// �˾�â �ݰ� �θ�â�� �̵��ñ�
function js_alert_opener_location($val , $val2){
	js_alert ($val);
	echo "<script language='javascript'>opener.location.replace ('$val2');self.close();</script>";
	exit;
}

// �˾�â �ݰ� �θ�â�� ������  $val2 ���ڷ� FrmUserInfo.ID.value=''�� opener�� ID���� ''�� �Ѱ��ش�.
function js_alert_opener_valuesend($val , $val2){
	js_alert ($val);
	echo "<script language='javascript'>opener.${val2};self.close();</script>";
	exit;
}


##################################################################################################################	 
# ����ȭ�ϰ���
##################################################################################################################	 


//�̹��� ���ε常
	function confirm_upload($file_name){				
		$extention  = strtolower(strrchr($file_name , "."));		
		$allow_files  = array(".jpg",".gif",".jpeg" ,".png");		
		$flag = false;
		if ( in_array($extention , $allow_files) ) $flag = true;		
		if(!$flag) js_alert_location("�ø��� ÷������������ ����� ���ε����� ������ �ƴմϴ�.","-1");
		
	}

//���Ͼ��ε�




function file_display($file_name,$path ,$default_width = '300', $default_height = '500'){//������ �̹�������, �÷��� ����, ���� ���Ͽ� �´� �������� ��� ���ش�..		
	
	unset($tmp);			
	$pos  =strrpos($file_name,".");
	$extension  = strtolower(substr($file_name , $pos+1));
	$pwd = "$path/$file_name";			
	$img_size = getimagesize($pwd);
	$width = $img_size[0];
	$height = $img_size[1];
	
	if($extension == "jpg" || $extension == "jpeg" || $extension == "gif" || $extension == "png" || $extension == "bmp" ){												
		
		 display_img ($pwd, $default_width, $default_height, $noimg = '' , $width , $height);							
						
	}else if($extension == "swf"){
	
		 $tmp = "
		  <object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0' width='$default_width' height='$default_height'>
		  <param name='movie' value='$pwd'>
		  <param name='quality' value='high'>
		  <embed src='$pwd' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' width='$default_width' height='$default_height'></embed></object>";
	  
	
	}else if($extension == "avi" || $extension == "asf" ||  $extension == "wmv" || $extension == "mpeg"){
	

	$tmp = "<embed src = '$pwd' width = '$default_width' height = '$default_height' autostart = 1>";
	
	}
										
	echo $tmp;

}//������ �̹�������, �÷��� ����, ���� ���Ͽ� �´� �������� ��� ���ش�..




##################################################################################################################	 
# ���ڿ������Լ���
##################################################################################################################	 
// ���ڿ� ���� (�̻��� �����϶��� ... �� ǥ��)


function STR_CUTTING( $LONG_STR , $CUTTING_LEN )
{
    $LONG_STR  = trim( $LONG_STR ); 
    for( $i=0 ; $i < $CUTTING_LEN ; $i++ ){ 
        if( ord( $LONG_STR[$i] ) >= 128 )
        {
            $KOR++;
        } 
        else
        {
            $ENG++;
        } 
    } 
    if( strlen( $LONG_STR ) > $CUTTING_LEN ){ 
        if( $KOR % 2 == 1 )
        { 
            $CUTTING_LEN = $CUTTING_LEN - 1; 
        } 
        $SHORT_STR = substr( $LONG_STR , 0 , $CUTTING_LEN ); 
        return "$SHORT_STR..."; 
    }
    else {
        $SHORT_STR = substr( $LONG_STR , 0 , $CUTTING_LEN ); 
        return "$SHORT_STR"; 
    }
}

//�˻���� ���ϰ� ����
function convert_word($word,$text){
	$text = str_replace($word,"<b><u>$word</u></b>",$text);
	return $text;
}

##################################################################################################################	 
# �̹��� ���� �Լ�
##################################################################################################################	 


// �̹����� ������¡ �ؼ� �����ֱ� (width �� height ���� ���� ���� ��ŭ ������¡ �ȴ�)

function display_img ($pwd, $width, $height, $noimg = '' , $original_width , $original_height) {
	if (!is_file($pwd)) {
			if (!empty($noimg)) {
					echo "<img src=${noimg} border=0 width=".$width." border=0>";
			}
	}  else {
			
			if ($original_width > $original_height) {
					if ($original_width > $width) {
							$xx = $width / $original_width;
							if ((int)($original_height * $xx) > $height) {
									$img_size = " height=$height ";
							} else {
									$img_size = " width=$width ";
							}
					} else {
							$img_size = "";
					}
			} else {
					if ($original_height > $height) {
							$xx = $height / $original_height;
							if ((int)($original_width * $xx) > $width) {
									$img_size = " width=$width ";
							} else {
									$img_size = " height=$height ";
							}
					} else {
							$img_size = "";
					}
			}
			
			$popWin_width  = intval($original_width + 20) ; 
			$popWin_Height  = intval($original_height + 20) ; 
			
			echo "<a href=\"javascript:doNothing()\" onClick=\"win1Open=displayImage('$pwd', 'BoardPopupImage', '$popWin_width', '$popWin_Height')\" onMouseOver=\"window.status='Click to display picture'; return true;\" onMouseOut=\"window.status=''\"><img src=" . $pwd . " ".$img_size ." border=0></a>";
	}
}



##################################################################################################################	 
# ������������� �ð�
##################################################################################################################	 
 function getMicrotime($startPage,$endPage){
	global $TOTALQUERY;
	$start = explode(" ",$startPage);
	$end   = explode(" ",$endPage);
	$result_micro =$end[0] - $start[0];
	$result_time  =$end[1] - $start[1];
	echo "
		<!-- SQL QUERY TIME & HTML PRINT TIME
		-------------------------------------------------------------------
		SQL QUERY TIME & HTML PRINT TIME
		-------------------------------------------------------------------
		StartTime : $startPage
		EndTime   : $endPage
		-------------------------------------------------------------------
		Total Excute Time  : $result_time sec $result_micro micro
		Total SQL Query    : $TOTALQUERY
		-------------------------------------------------------------------
		-->
	";
 }


##################################################################################################################	 
# ���Ϲ� ���� �̸� �ٲٱ� 
################################################################################################################## 

function boolRename($oldfile,$newfile) {
   if (!rename($oldfile,$newfile)) {
     if (copy ($oldfile,$newfile)) {
         unlink($oldfile);
         return true;
     }
     return false;
   }
   return true;
} 

 
##################################################################################################################	 
# ��Ʈ �ý��� ���� ��� ���
##################################################################################################################	 
 function getServerSys(){
	 return $_SERVER["DOCUMENT_ROOT"];
 }

##################################################################################################################	 
# ��Ʈ Url ���(���� �߼��Ҷ� ���)
##################################################################################################################	 
 function getSeverUrl(){
	 return "http://".$_SERVER["HTTP_HOST"];
 }

##################################################################################################################	 
 # ���� �ý��� ��� ���
##################################################################################################################	 
 function getSysPath(){
	 return $_SERVER["SCRIPT_FILENAME"];
 }

##################################################################################################################	 
 # ���� URL ��� ���
##################################################################################################################	 
 function getUrlPath(){
	 return "http://".$_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"];
 }

##################################################################################################################	 
 # ������ ������ ���
##################################################################################################################	 
 function getIp(){
	 return $_SERVER["REMOTE_ADDR"];
 }


##################################################################################################################	 
# Mysql �⺻ ����
##################################################################################################################
	 
	function _mysql_fetch_array($sql){// mysql_query + mysql_fetch_array 
		$row = array();
		$result = mysql_query($sql);
		if($result){		
			$row =  mysql_fetch_array($result);
			return $row; 
			
		}else{
			return mysql_error();
		}
	}
	
	function getSingleValue($sql){// ��Į�� ���� ���Ҷ� 
		$list = _mysql_fetch_array($sql);
		if($list){
			return $list[0];
		}else{
			return mysql_error();
		}
	}
	
	
	function mysql_query_error($sql) {
		$result = mysql_query($sql) or die("<font size=2>" . $sql . "<br>" . mysql_error() . "<br>MySQL Error No. " . mysql_errno() . "</font>");
		return $result;
	}

	function mysql_pop_value($sql) {
		$result = mysql_query_error($sql);
		if (mysql_num_rows($result) == 0) {
			return false;
		} else {
			$val = array_pop(mysql_fetch_row($result));
			return $val;
		}
	}
	
	function set_sql_str ($set_sql, $arr, $str) {
		$r_str;
	
		foreach ($arr as $key=>$val) {
			if (ereg ("^$str", $key)) {
				$key = ereg_replace ("^$str", "", $key);
	
				if (!empty($key)) {
					if (!empty($set_sql)) {
						$set_sql .= ', ';
					}
					$set_sql .= "${key} = '${val}'";
				}
			}
	
		}
	}


function getSelectDate($TYPE , $YearName , $MonthName , $DayName , $Value =0, $LimitYear ,$DisplayName){

	global $SITE_START_DATE;

// Type (YMD , YM , Y) => �����,��� , �� $Value =>������ $LimitYear => �⵵  ���۳� + 
// $YearName = > �� �̸�
// $MonthName = > �� �̸�
// $DayName = > �� �̸�
// $DisplayName => �� �� �� ǥ�� (Y N)

	if($DisplayName == "Y"){
		
		$YearText = "��";
		$MonthText = "��";
		$DayText = "��";
		
	}else{
		$YearText = "";
		$MonthText = "";
		$DayText = "";
	}


	$year = date("Y");// ���� �⵵ 		, $SITE_START_DATE
	$month = date("m");
	$day = date("j");
	
	if($Value){
		$regyear = date("Y", $Value);
		$regmonth = date("m", $Value);
		$regday = date("d", $Value);
	}else{
		$regyear = date("Y");		
		$regmonth = date("m");
		$regday = date("d");
		
	}	
	
	  if(ereg ("Y" , $TYPE )){
		echo "<select name='$YearName' size='1'>";		
		for($i = $year ;$i <= $year + $LimitYear;$i++) {
			if($regyear == $i) 	echo "<option value='$i' selected>$i</option>";			
			else echo "<option value='$i'>$i</option>";
		}
		echo "</select>$YearText " ; 
	  }
	  
	  if(ereg ("M" , $TYPE )){	
		echo "<select name='$MonthName' size='1'>";
		for($i="1";$i<=12;$i++) {
			if($regmonth == $i) echo "<option value='$i' selected>".sprintf("%02d",$i)."</option>";			
			else echo "<option value='$i'>".sprintf("%02d",$i)."</option>";
			
		}
		echo "</select>$MonthText " ;
	  }
	 
	  if(ereg ("D" , $TYPE )){	
		echo "<select name='$DayName' size='1'>";
		for($i="1";$i<=31;$i++) {
			if($regday == $i) echo "<option value='$i' selected>".sprintf("%02d",$i)."</option>";			
			else echo "<option value='$i'>".sprintf("%02d",$i)."</option>";
			
		}
		echo "</select>$DayText";
	  }
		
		

}// end function

//�ش� ���� ������ �� ���

function getDateCount($M,$Y){
	$D=1;
	while(checkdate($M,$D,$Y)){
		$D++;
	}
	$D--;
	if($M==2){
		if(!($Y%4))$D++;
		if(!($Y%100))$D--;
		if(!($Y%400))$D++;
	}
	return $D;
}

//���� ã��
function getWeek($Date) { 
	$ArrayWeek =array("��","��","ȭ","��","��","��","��");
	return $ArrayWeek[date('w',$Date)];
}

function getCreateDate($year,$month,$day) { 
	if(!$year){
		$year = date('Y',mktime());
	}
	if(!$month){
		$month = date('m',mktime());
	}
	if(!$day){
		$day = date('d',mktime());
	}
	
	return mktime(23,59,59,$month,$day,$year);
}


##################################################################################################################	 
# �ֹ� ���� �Լ�
##################################################################################################################

// �ù�ȸ�� URL

function getDeliveryUrl($Company){
	global $PARTNER_TABLE_NAME;
	return getSingleValue("SELECT URL FROM ${PARTNER_TABLE_NAME} WHERE Company = '$Company' LIMIT 1");
}

// �ŷ�ó ȸ���
function getPartnerName($UID){
	global $PARTNER_TABLE_NAME;
	return getSingleValue("SELECT Company FROM ${PARTNER_TABLE_NAME} WHERE UID = '$UID' LIMIT 1");
}




##################################################################################################################	 
# ȸ�� ���� �Լ�
##################################################################################################################

// ȸ������ �ƴ���(���ϰ� ��Ű���� ���� ��)
function isMember(){
	global $MEMBER_TABLE_NAME; 
	global $MEMBER_TEMP_FOLDER_NAME; 
	global $_COOKIE;
	//$tmpLoginFile = false;
	$tmpLoginCnt = false;	
	$ID = $_COOKIE[MEMBER_ID];	
	//$File =  getenv("DOCUMENT_ROOT") . "/${MEMBER_TEMP_FOLDER_NAME}/login_user/$ID.cgi";	
	//if(file_exists($File)) $tmpLoginFile = true;	
	$cnt = getSingleValue("select count(UID) from ${MEMBER_TABLE_NAME} where ID = '$ID'");
	if($cnt > 0  ) $tmpLoginCnt = true;	
	//if($tmpLoginFile && $tmpLoginCnt) return true;
	if($tmpLoginCnt) return true;
	else return false;
	
}

// �ְ� ������ ��Ű���̵�͵���� DB�� ��
function isAdmin(){
	global $MEMBER_TABLE_NAME; 
	global $_COOKIE; 
	$tmpAdminStatus = false;
	$ID = $_COOKIE[MEMBER_ID];
	$Grade = $_COOKIE[MEMBER_GRADE];
	$Pass = $_COOKIE[ROOT_PASS];		
	if(isMember($ID)){
		$list = _mysql_fetch_array("select ID , Grade from ${MEMBER_TABLE_NAME} where ID = '$ID' and Grade = '$Grade' and PWD = '$Pass'");		
		if($ID == $list[ID] && $Grade = $list[Grade]) $tmpAdminStatus = true;
		else $tmpAdminStatus = false;	
	}	
	
	return $tmpAdminStatus;
}


// ���̵�� �̸�  ���ϱ�
function getMemberName($ID){
	global $MEMBER_TABLE_NAME; 
	return getSingleValue("select Name from ${MEMBER_TABLE_NAME} where ID = '$ID'");
}

// ���̵�� ���  ���ϱ�
function getMemberGrade($ID){
	global $MEMBER_TABLE_NAME; 
	return getSingleValue("select Grade from ${MEMBER_TABLE_NAME} where ID = '$ID'");
}

// ȸ�� ��ȣ�� ȸ�� ���̵� ���ϱ� 
function getMemberIDByUID($UID){
	global $MEMBER_TABLE_NAME; 
	return getSingleValue("select ID from ${MEMBER_TABLE_NAME} where UID = '$UID'");
}


// ȸ�� NickName ��� 
function getNickName($ID){	
	global $MEMBER_TABLE_NAME; 
	return getSingleValue("select NickName from ${MEMBER_TABLE_NAME} where ID = '$ID'");
}


//�ֹι�ȣ ���ڸ��� ���� ýũ

function getAge($Jumin1,$Jumin2){
	$TmpYear = substr($Jumin1,0,2);
	$AMonth = substr($Jumin1,2,2);
	$ADay = substr($Jumin1,4,2);

	if($Jumin2 !=''){
		$CkCent = substr($Jumin2,0,1);
		if($CkCent=='3' || $CkCent=='4'){
			$AYear = "20{$TmpYear}";
		}else{
			$AYear = "19{$TmpYear}";
		}
	}else{
		if($TmpYear>0 && $TmpYear<40){
			$AYear = "20{$TmpYear}";
		}else{
			$AYear = "19{$TmpYear}";
		}
	}
	$NYear = date('Y',time());
	$NMonth = date('m',time());
	$NDay = date('d',time());

	$Age = $NYear - $AYear;

/*
	if($AMonth < $NMonth || ($AMonth==$NMonth && $ADay < $NDay)){
		$Age=$Age+1;
	}
*/
	return $Age;
}

// ȸ���� ����

function getSex($Jumin2){		
		$digit = substr($Jumin2,0,1);
		$txt_sex = "";
		switch($digit){
			case "1" : 
			case "3" : $txt_sex = "��"  ; break;
			case "2" : 
			case "4" : $txt_sex = "��"  ; break;
		}		
		return $txt_sex;									
}

// ȸ���� �����α��� ��¥

function getLastLoginDate($ID){
		global ${LOGIN_HISTORY_TABLE_NAME};
		$sql = "select WDate from ${LOGIN_HISTORY_TABLE_NAME} where ID = '$ID' AND Flag = 'LOGIN' order by UID desc limit 1";
		return getSingleValue($sql);
}
// ȸ�� �ֱ� ���� ������ 
function getLastLoginIP($ID){
		global ${LOGIN_HISTORY_TABLE_NAME};
		$sql = "select IP from ${LOGIN_HISTORY_TABLE_NAME} where ID = '$ID' AND Flag = 'LOGIN' order by UID desc limit 1";
		return getSingleValue($sql);
}




##################################################################################################################	 
# ����Ʈ ������ ���� �Լ�
##################################################################################################################

function getContentPage($Code){
	global $CONTENT_TABLE_NAME;
	global $Sitekey;
	return getSingleValue("select Content from ${CONTENT_TABLE_NAME} where Code = '$Code'");
}


##################################################################################################################	 
# ����Ʈ ���� �Լ�
##################################################################################################################

function getTotalPoint($ID){
	global $POINT_TABLE_NAME;
	global $Sitekey;
	return getSingleValue("select sum(point) from ${POINT_TABLE_NAME} where ID = '$ID'");
}

// ��� ���� ����Ʈ (��ٱ��Ͽ��� ���)

function getTotalEnablePoint($ID){
	global $POINT_TABLE_NAME;
	global $BUYER_TABLE_NAME;
	global $Sitekey;
	$Amount =  getSingleValue("select sum(point) from ${POINT_TABLE_NAME} where ID = '$ID'");
	if(!$Amount) return "0";
	else return $Amount;
}




// ����Ʈ
function boolInsertPoint($TBL , $ID , $GName , $Point , $Flag ,$Content ){
	global $POINT_TABLE_NAME;
	global $SiteKey;
	//Flag�� �۾��� ���� �۾���(BW) , �ڸ�Ʈ����(BCW) , ȸ���α���(ML) , ȸ����õ(MR) , ��õ(R) , ����(NR) , 
	//�ֹ� ����� (OF) , �ֹ����� (OC) �ֹ���ǰ ��ǰ (OR) ,  ��ǥ������(P)
	//���б� (BR) , �Խ��� �ٿ�ε�(BD) , ������ �Է�(SI) , �α���(L) , ȸ������  (M) , ��õ�� (RM)	
	//$TBL �Խ����ϰ��� �Խ������̺� / �ֹ��ϰ��� �ֹ���ȣ
	$Date = time();
	$result = mysql_query("insert into ${POINT_TABLE_NAME} SET TBL = '$TBL' , Point='$Point', ID='$ID' , GName = '$GName' ,Content = '$Content' , Flag = '$Flag'  , WDate = $Date , SiteKey = '$SiteKey'");
	return $result;
}



##################################################################################################################	 
# ���� ���� �Լ�
##################################################################################################################

function getTotalMemoCnt($ID){// ���� �� ���� 
	global $MEMO_TABLE_NAME;
	global $Sitekey;
	return getSingleValue("select count(UID) from ${MEMO_TABLE_NAME} where ReceiveID = '$ID'");	
}

function getTotalNotReadMemoCnt($ID){// ���� ���� ���� 
	global $MEMO_TABLE_NAME;
	global $Sitekey;
	return getSingleValue("select count(UID) from ${MEMO_TABLE_NAME} where ReceiveID = '$ID' and ConfirmDate = 0");	
}

##################################################################################################################	 
# ��ũ�� ���� �Լ�
##################################################################################################################
//enum('BOARD', 'CAFE', 'BLOG', 'OTHER1', 'OTHER2') �Խ��� ,ī�� , ��α� other1, other2 �� ���� ���α����� ���
function getTotalScrapCnt($ID){
	global $SCRAP_TABLE_NAME;
	global $Sitekey;
	return getSingleValue("select count(UID) from ${SCRAP_TABLE_NAME} where ID = '$ID'");	
}

function boolInsertScrap($ID , $ScrapType , $TableName , $DocNo){	
	global $SCRAP_TABLE_NAME;
	global $Sitekey;
	$WDate = time();
	$result = mysql_query("insert into ${SCRAP_TABLE_NAME} set ID  = '$ID' , ScrapType = '$ScrapType', TableName = '$TableName' , DocNo = '$DocNo' , WDate = $WDate , SiteKey = '$SiteKey'");
	return $result;
}

##################################################################################################################	 
# �Խ��� ���� �Լ�
##################################################################################################################

function getTableName($GID , $BID){// ���̺� �̸� ���
	global $BOARD_MAIN_TABLE_NAME;
	return getSingleValue("select BoardDes from ${BOARD_MAIN_TABLE_NAME} where GID = '$GID' and BID = '$BID'");
}

function getSubject($GID , $BID , $UID){//�Խ��� ���� ���
	global $DEFAULT_TABLE_NAME;
	$list = _mysql_fetch_array("select SUBJECT from ${DEFAULT_TABLE_NAME}_{$GID}_{$BID} where UID = '$UID'");
	if($list[SUBJECT]) return stripslashes($list[SUBJECT]);
	else return "�����ȰԽù��Դϴ�";
}


function getTableCountByGroup($GID){//�׷쿡 ���� �Խ��� ���� ���
	global $BOARD_MAIN_TABLE_NAME;
	return getSingleValue("select count(*) from ${BOARD_MAIN_TABLE_NAME} where GID = '$GID'");
}

function getGroupName($GID){// �׷�� ���
	global $BOARD_GROUP_TABLE_NAME;
	return getSingleValue("select GrpSubject  from ${BOARD_GROUP_TABLE_NAME} where GID = '$GID'");
}

function getGID($BID){// GID  ���  BID�� ���ؼ�
	global $BOARD_MAIN_TABLE_NAME;
	return getSingleValue("select GID  from ${BOARD_MAIN_TABLE_NAME} where BID = '$BID'");
}

function getCountArticle($GID, $BID){// �Խù� ���� ��� 
	global $DEFAULT_TABLE_NAME;				
	$BoardArticleCnt = getSingleValue("select count(*) from ${DEFAULT_TABLE_NAME}_${GID}_${BID}");	
	return $BoardArticleCnt;		
}

function boolCommentTableExist($GID , $BID){// �ڸ�Ʈ ���̺� ���� ����	
	global $MYSQL_DB;
	global $DEFAULT_TABLE_NAME;
	$result = mysql_list_tables ($MYSQL_DB);
	$exitCnt = 0;
	while ($i < mysql_num_rows ($result)) {
	   $tb_names[$i] = mysql_tablename ($result, $i);
	   if("${DEFAULT_TABLE_NAME}_${GID}_${BID}_comment" == $tb_names[$i]) $exitCnt = 1 ;  // �ڸ�Ʈ ���̺��� ���� �ϸ�  $exitCnt = 1
	   $i++;
	}	
	if($exitCnt == 1) return true;
	else return false;	
}


function getCountCommentArticle($GID , $BID){// �ڸ�Ʈ �Խù� ���� ��� 
	global $DEFAULT_TABLE_NAME;
	$BoardCommentArticleCnt  = 0 ; 		
	if(boolCommentTableExist($GID , $BID) == true){// �ڸ�Ʈ ���̺��� ���� �Ұ�� �హ�� ��ȯ	
		$BoardCommentArticleCnt = getSingleValue("select count(*) from ${DEFAULT_TABLE_NAME}_${GID}_${BID}_comment");
	}			
	return $BoardCommentArticleCnt;
}


##################################################################################################################	 
# ��õ ���� �Լ�
##################################################################################################################


function boolRecommandExistID($TBL , $PID , $ID, $Flag = 'GOOD', $RTYPE = 'BOARD'){// �̹� ��õ�� �ߴ��� ����
	global $RECOMMAND_TABLE_NAME;
	global $SiteKey;	
	$cnt = getSingleValue ("select count(UID) from ${RECOMMAND_TABLE_NAME} where TBL = '$TBL' and ID = '$ID' and PID = '$PID' and Flag = '$Flag' and RTYPE = '$RTYPE'");
	if($cnt == 0) return false;
	else return true;	
}

function boolInsertRecommand($TBL , $PID , $ID, $Flag = 'GOOD', $RTYPE = 'BOARD'){
	global $RECOMMAND_TABLE_NAME;
	global $SiteKey;
	$WDate = time();
	$sql = "insert into ${RECOMMAND_TABLE_NAME} set TBL = '$TBL' , PID = '$PID' , ID = '$ID' , Flag = '$Flag' , RTYPE = '$RTYPE' , WDate = $WDate , SiteKey = '$SiteKey'" ; 
	$result = mysql_query($sql);
	return $result;
}

function getTotalCountRecommand($TBL , $PID , $Flag = 'GOOD' , $RTYPE = 'BOARD'){// ��õ�� ���
	global $RECOMMAND_TABLE_NAME;	
	global $SiteKey;	
	return getSingleValue("select count(UID) from ${RECOMMAND_TABLE_NAME} where  TBL = '$TBL' and  PID = '$PID'  and  Flag = '$Flag' and  RTYPE = '$RTYPE'") ; 	
}

function getFileSize($file, $BID) {//���� ������  �Խ��ǿ�

	global $GID ; 
	global $BOARD_FOLDER_NAME;
	if(file_exists("./${BOARD_FOLDER_NAME}/table/$GID/$BID/updir/$file") && $file){
	   // �Ϲ����� ���� ������ ������ �����Ѵ�.
		$kb = 1024;         // Kilobyte
		$mb = 1024 * $kb;   // Megabyte
		$gb = 1024 * $mb;   // Gigabyte
		$tb = 1024 * $gb;   // Terabyte
	
	// byte������ ������ �����´�.
	   $size = filesize("./${BOARD_FOLDER_NAME}/table/$GID/$BID/updir/$file");
	/* ���� ������ kb(Ű�ι���Ʈ)���� ������ �� ���� �״�� �����ϰ� �ƴϸ� ������ ���ϴ����� ���δ�.*/	
	   if($size < $kb) {
		   return $size." B";
	   }
	   else if($size < $mb) {
		  return round($size/$kb,2)." KB";
	   }
	   else if($size < $gb) {
		   return round($size/$mb,2)." MB";
	  }
	   else if($size < $tb) {
		   return round($size/$gb,2)." GB";
	   }
	   else {
		  return round($size/$tb,2)." TB";
	   }
	}   
}


function getIcon($ex){
	global $BOARD_FOLDER_NAME;
	$img = "" ; 
	switch(strtolower($ex)){
		case ".doc" : $img = "<img src = './${BOARD_FOLDER_NAME}/images/icon_doc.gif' border = 0  align = absmiddle>" ; break ; 
		case ".ppt" : $img = "<img src = './${BOARD_FOLDER_NAME}/images/icon_ppt.gif' border = 0  align = absmiddle>" ; break ; 
		case ".xls" : $img = "<img src = './${BOARD_FOLDER_NAME}/images/icon_excel.gif' border = 0  align = absmiddle>" ; break ;
		case ".hwp" : $img = "<img src = './${BOARD_FOLDER_NAME}/images/icon_hwp.gif' border = 0  align = absmiddle>" ; break ;
		case ".gif" : $img = "<img src = './${BOARD_FOLDER_NAME}/images/icon_gif.gif' border = 0  align = absmiddle>" ; break ;
		case ".jpg" : $img = "<img src = './${BOARD_FOLDER_NAME}/images/icon_jpg.gif' border = 0  align = absmiddle>" ; break ;
		case ".zip" : $img = "<img src = './${BOARD_FOLDER_NAME}/images/icon_zip.gif' border = 0  align = absmiddle>" ; break ;
		default :
			$img = "<img src = './${BOARD_FOLDER_NAME}/images/icon_etc.gif' border = 0  align = absmiddle>";  
	}	
	return $img;
}


function auto_link($str)
{
$str=eregi_replace("[-_a-z0-9]+(\.[-_a-z0-9]+)*@[-a-z0-9]+(\.[-a-z0-9]+)+", "<a href='mailto:\\0' target=_blank>\\0</a>",$str);
$str=eregi_replace ("(http|mms|ftp|telnet)://[-a-z0-9]+(\.[-a-z0-9]+)*(/[^\\\*\"\<\>\| &]+(\.[^\\\*\"\<\>\| &]+)?)*/?", "<a href='\\0' target=_blank>\\0</a>",$str);
//$str=eregi_replace ("(http|mms|ftp|telnet)://[-a-z0-9]+(\.[-a-z0-9]+)*(/([^ >]+)*)*/?", "<a href='\\0' target=_blank>\\0</a>",$str);
return $str;
}


##################################################################################################################	 
# ������ ������ �Լ�
##################################################################################################################


// ī�װ� flag ���� ������  ī�װ� ���� ��´�..
function getCateName($code,$flag='M'){
	global $CATEGORY_TABLE_NAME;
	global $SiteKey;
	return getSingleValue("select cat_name from ${CATEGORY_TABLE_NAME} where cat_no = '$code' and cat_flag = '$flag'");	
}

// ���� index ���� 
function getBannerPicture($Skin , $Code){  	
	global $BANNER_TABLE_NAME;
	global $STOCK_FOLDER_NAME;
	$sql = "select * from ${BANNER_TABLE_NAME} where Skin = '$Skin'  and Code = '$Code'";	
	$list = _mysql_fetch_array($sql);	  
	$Url1 = stripslashes($list[Url1]);
	$Url2 = stripslashes($list[Url2]);
	$Url3 = stripslashes($list[Url3]);
	$Target1 = stripslashes($list[Target1]); 
	$Target2 = stripslashes($list[Target2]); 
	$Target3 = stripslashes($list[Target3]); 
	
	$URL = $Url1 . "|";
	$TARGET = $Target1 . "|";
	$Size = explode("|",$list[PictureSize]); 	
	$Picture = explode("|" , $list[Picture]);
	$Url = explode("|" , $URL);
	$Target = explode("|" , $TARGET);
			
	
	echo "<a href = '/shop' onfocus = 'this.blur();'><img src ='/shop/img/shop_logo.png' border=0 ></a>";
}


function getRotateBannerCount($Skin){
	global $BANNER_TABLE_NAME;	
	$sql = "SELECT COUNT(*) FROM ${BANNER_TABLE_NAME} WHERE Skin = '$Skin' AND Code LIKE 'A%'" ;	
	return getSingleValue($sql);
}



function getGeneralPoint($Price,$Point = 0){// �Ϲ� 
	global $POINTSTATUS; // ��ü ����Ʈ�� ����� checked
	global $POINTRATE;// ��ü ����Ʈ�� 	
	if($POINTSTATUS == "checked"){
		return $Price * ($POINTRATE/100);// ��ü ����Ʈ ����� 		
	}else{
		return $Point; // ������ ����Ʈ�� �������ش�..
	}				
}


##################################################################################################################	 
# �α��� ���� �Լ� 
##################################################################################################################

//�α��� �Ҷ� DB �Է�
function boolInsertLoginHistory($ID , $IP , $Location = '' ,$Referer , $Flag = 'LOGIN'){
	global $LOGIN_HISTORY_TABLE_NAME;
	global $SiteKey;
	$WDate = time();
	$sql = "insert into ${LOGIN_HISTORY_TABLE_NAME}  set ID = '$ID' , IP = '$IP' , Location = '$Location' , Referer = '$Referer' , Flag = '$Flag' , WDate = $WDate , SiteKey = '$SiteKey'" ; 
	$result = mysql_query($sql);
	return $result;	
	
}

// �α��� �� 

function getMemberLoginCnt($ID){
	global $LOGIN_HISTORY_TABLE_NAME;
	return getSingleValue("select count(UID) from ${LOGIN_HISTORY_TABLE_NAME} where ID = '$ID' AND Flag = 'LOGIN'");
}




##################################################################################################################	 
# ���ϰ��� �Լ� ������ �Լ�
##################################################################################################################
// �ܼ� ���� ������
function boolMailSend($TO_MAIL , $FROM_EMAIL , $SUBJECT , $SEND_CONTENT ){
	
	$MailHeaders .=  "Return-Path: $FROM_EMAIL \r\n";
	$MailHeaders .=  "From: $NAME <$FROM_EMAIL> \r\n";
	$MailHeaders .=  "X-Mailer: FORM Mailer \r\n";
	$MailHeaders .=  "Mime-Version: 1.0\r\n";
	$MailHeaders .=  "Content-Type: text/html; charset='iso-2022-kr'\r\n";	
	
	$mail_result = mail($TO_MAIL, $SUBJECT , $SEND_CONTENT , $MailHeaders);
	return $mail_result;
	
}
##��ٱ��� ���� �ɼ�
function OptionValueFnc($Option1, $AddPriceOption){
	if($Option1 && eregi("=", $Option1)){//�ɼ�1�� �ְ� ������ ���� �̸� ���ݺ��� or �����߰��� �̰����� ���Ѵ�.
		if($AddPriceOption == 2){ # 1: �����߰� 2: ���ݺ���
			$splitArr = split("=", $Option1);
			$splitArr[1] = ereg_replace(",", "", $splitArr[1]);
			if(intval($splitArr[1])) $GoodsPrice = $splitArr[1];
			
			$OptionValue[0] = $GoodsPrice;
			$OptionValue[1] = $splitArr[0];
			return $OptionValue;
		}
	}
}

##������� ������ �Լ�
function showBoardIcon($flag=null, $flag1=null, $uid=null){
#flag : list, write, ....
#flag : null or 1 �ܼ����
	global $BOARD_FOLDER_NAME,$SKIN_FOLDER_NAME, $ICON_SKIN_TYPE, $BID, $GID, $UID, $category, $CURRENT_PAGE,$SEARCHTITLE,$searchkeyword,$sysop,$fm,$BType,$ListMax,$NEXT_BOARD,$PRE_BOARD,$SKIN_FOLDER_NAM,$BOARD_NAME;
	$fncuid=$uid?$uid:$UID;
	
	
	switch($flag){
		case "list":
			$icon = "<img src=\"./$BOARD_FOLDER_NAME/icon/$ICON_SKIN_TYPE/list_btn.gif\" border=\"0\" onClick=\"javascript:location.replace('$PHP_SELF?BID=$BID&GID=$GID&category=$category&CURRENT_PAGE=$CURRENT_PAGE&SEARCHTITLE=$SEARCHTITLE&searchkeyword=$searchkeyword&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax');\" style=\"cursor:hand\"  align = absmiddle>";
		break;
		case "write":
			$icon = "<img src=\"./${BOARD_FOLDER_NAME}/icon/$ICON_SKIN_TYPE/write_btn.gif\" border=\"0\" onClick=\"javascript:location.replace('$PHP_SELF?BID=$BID&GID=$GID&mode=write&category=$category&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax');\" style=\"cursor:hand\"  align = absmiddle>";
		break;	
		case "modify":
			$icon = "<img src=\"./${BOARD_FOLDER_NAME}/icon/$ICON_SKIN_TYPE/modify_btn.gif\" onClick=\"javascript:location.replace('$PHP_SELF?BID=$BID&GID=$GID&category=$category&mode=modify&UID=$fncuid&CURRENT_PAGE=$CURRENT_PAGE&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax');\" style=\"cursor:hand\"  align = absmiddle>";
		break;	
		case "save":
			$icon = "<img src=\"./${BOARD_FOLDER_NAME}/icon/$ICON_SKIN_TYPE/save_btn.gif\" onClick=\"javascript:WRITE_FUNC();\" style=\"cursor:hand\"  align = absmiddle>";
		break;
		case "reply":
			$icon = "<img src=\"./${BOARD_FOLDER_NAME}/icon/$ICON_SKIN_TYPE/reply_btn.gif\" onclick=\"javascript:location.replace('$PHP_SELF?BID=$BID&GID=$GID&category=$category&mode=reply&UID=$fncuid&CURRENT_PAGE=$CURRENT_PAGE&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax');\" style=\"cursor:hand\"  align = absmiddle>";
		break;								
		case "cancel":
			$icon = "<img src=\"./${BOARD_FOLDER_NAME}/icon/$ICON_SKIN_TYPE/cancel_btn.gif\" onClick=\"javascript:location.replace('$PHP_SELF?BID=$BID&GID=$GID&query=list&category=$category&CURRENT_PAGE=$CURRENT_PAGE&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax');\" style=\"cursor:hand\"  align = absmiddle>";
		break;
		case "delete":
			$icon = "<img src=\"./$BOARD_FOLDER_NAME/icon/$ICON_SKIN_TYPE/del_btn.gif\" onClick=\"javascript:DELETE_THIS('$fncuid','$CURRENT_PAGE','$BID','$GID');\" style=\"cursor:hand\"  align = absmiddle>";
		break;
		case "new":
			$icon = "<img src='./${BOARD_FOLDER_NAME}/icon/$ICON_SKIN_TYPE/new_btn.gif' align = absmiddle>";
		break;
		case "next":
			$icon = "<img alt=\"����\" src=\"./${BOARD_FOLDER_NAME}/icon/$ICON_SKIN_TYPE/next_btn.gif\" onClick=\"javascript:location.replace('$PHP_SELF?BID=$BID&GID=$GID&category=$category&mode=view&UID=$NEXT_BOARD[0]&CURRENT_PAGE=$CURRENT_PAGE');\" style=\"cursor:hand\"  align = absmiddle>";
		break;
		case "none_recomm":
			$icon = "<img src=\"./${BOARD_FOLDER_NAME}/icon/$ICON_SKIN_TYPE/none_recomm_btn.gif\" border=\"0\" style=\"cursor:hand\" onClick=\"javascript:location.replace('$PHP_SELF?BID=$BID&GID=$GID&UID=$fncuid&mode=view&CURRENT_PAGE=$CURRENT_PAGE&RECOMMAND=BAD&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax');\"  align = absmiddle>";
		break;
		case "prev":
			$icon = "<img alt=\"����\" src=\"./${BOARD_FOLDER_NAME}/icon/$ICON_SKIN_TYPE/prev_btn.gif\" onClick=\"javascript:location.replace('$PHP_SELF?BID=$BID&GID=$GID&category=$category&mode=view&UID=$PRE_BOARD[0]&CURRENT_PAGE=$CURRENT_PAGE');\" style=\"cursor:hand\"  align = absmiddle>";
		break;
		case "print":
			$icon = "<img alt=\"����Ʈ\" src=\"./${BOARD_FOLDER_NAME}/icon/$ICON_SKIN_TYPE/print_btn.gif\" onClick=\"javascript:printThis();\" style=\"cursor:hand\"  align = absmiddle> ";
		break;
		case "re":
			$icon = "<img src='./$BOARD_FOLDER_NAME/icon/${ICON_SKIN_TYPE}/re_btn.gif' align=absmiddle>";
		break;
		case "recomm":
			$icon = "<img src=\"./${BOARD_FOLDER_NAME}/icon/$ICON_SKIN_TYPE/recomm_btn.gif\" border=\"0\" style=\"cursor:hand\" onClick=\"javascript:location.replace('$PHP_SELF?BID=$BID&GID=$GID&UID=$fncuid&mode=view&CURRENT_PAGE=$CURRENT_PAGE&RECOMMAND=GOOD&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax');\"  align = absmiddle>";
		break;
		case "scrap":
			$icon = "<img src=\"./${BOARD_FOLDER_NAME}/icon/$ICON_SKIN_TYPE/scrap_btn.gif\" border=\"0\" style=\"cursor:hand\" onclick=\"javascript:write_scrap('$SKIN_FOLDER_NAME','$BOARD_NAME','$fncuid','BOARD')\"  align = absmiddle>";
		break;	
		case "search":
			$icon = "<img src=\"./${BOARD_FOLDER_NAME}/icon/$ICON_SKIN_TYPE/search_btn.gif\" border = 0 onclick=\"javascript:search();\" style=\"cursor:hand\"  align = absmiddle>";
		break;
		case "hot":// ��ȸ�� ���� �̻�
			$icon = "<img src='./$BOARD_FOLDER_NAME/icon/${ICON_SKIN_TYPE}/hot_btn.gif' align=absmiddle>";
		break;
		case "key":// ��б�Ű
			$icon = "<img src='./$BOARD_FOLDER_NAME/icon/${ICON_SKIN_TYPE}/key_btn.gif' align=absmiddle>";
		break;
		case "arrow":// ������������ ���� ����Ʈ ��ȣ �����ִ� ȭ��ǥ��
			$icon = "<img src='./$BOARD_FOLDER_NAME/icon/${ICON_SKIN_TYPE}/arrow_btn.gif' align=absmiddle>";
		break;	
																											
	}
	
	
	return $icon;

}


// �ɼ� ������ǥ��

function getOptionIcon($Array){
	global $OPTION_IMAGE_ARRAY;
	$ArrayValue = explode("|" , $Array);
	for($i = 0 ; $i < sizeof($ArrayValue) ; $i++){
		if($ArrayValue[$i] !="N"){// �ɼ��� N �� �ƴѰ� ��
			echo $OPTION_IMAGE_ARRAY[$ArrayValue[$i]] ; 
		}																												
	}
}

function IsCartEnable($OptionName, $FilelLIst){// ��ٱ��� ����� ���ɿ��� åũ
	$tmpCartFlag = true;
	unset($isenable);
	foreach($OptionName as $key => $value){
		if($FilelLIst[$key]) :
			if($OptionName[$key][1] == "checked"):// ����Ʈ �ڽ��̰� ���� ���� �ϸ� īƮ�� �ٷ� ���� �ʴ´�.
				$Option = split("\n", $FilelLIst[$key]);
				for($i = 0; $i < sizeof($Option) && $Option[$i]; $i++) {// ���� ���� 
					$tmpCartFlag = false;
				}
			endif;
		endif;
	}
	if(!strcmp($FilelLIst["None"],"checked") || $tmpCartFlag == false) $isenable =  false;
	else $isenable =  true;

	return $isenable;
}
?>