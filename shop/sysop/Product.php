<meta http-equiv="Content-Type" content="text/html; charset=euc-kr"><?
/*

*/
######################################################################
#				Written by kerrigancap
#				Copyright kerrigancap.pe.kr
#				Date 2006 . 04
######################################################################
/*
2006/03/29
DetailPicture �ʵ� �߰� ������������ ��ǰ���� �κ��� �̹���ó��
Status �ʵ� �߰� Y(��ǰ ǥ��) , N(��ǰ ǥ��X) , T(������ => ������ ��忡�� ������ �������� ������ �ּ�ȭ ��Ű�� ����)
ǰ���κа��� ������ ��ǰ ǥ�� ���θ� �Ǵ� ���ٰ�� ����..
Back �� ������ $Back���� �Ѿ� ���ְ� �ƴϸ� ProductList�� �Ѿ� ����
2006/06/08
Price/Point �κ��� ȸ����޺� ��������� ���� �ʵ� ���� (tinytext)
���� �迭ó��

2006/08/02
MERCHANT_ID �߰� (���� ���̵�) => ���޾�ü�ʹ� �ٸ�(���� ������ �ø��� ���� ���̵� SiteKey�� ����ȭ)
PID => ���� ī�װ�
CID => ���û�ǰ ���̵�


*/


include "./ROOT_CHECK.php";
include_once "../config/shopDisplay_info.php";
$tmparr = array("Option1", "Option2", "Option4", "Option5", "Size","Color");

if(!$mode)	$send_img = "./img/btn_set/btn_complete_02.gif";
else $send_img = "./img/btn_set/btn_modify_03.gif";

if($Back){// �ٸ� ����Ʈ ���������� �ѿ��°��� �������� Back
	$BackUrl = "$PHP_SELF?menushow=$menushow&THEME=$Back&sort=$sort&sort1=$sort1&sort2=$sort2&sorting=$sorting&OptionList=$OptionList&CURRENT_PAGE=$CURRENT_PAGE&keyword=$keyword";
}else{
	$BackUrl = "$PHP_SELF?menushow=$menushow&THEME=ProductList&sort=$sort&sort1=$sort1&sort2=$sort2&sorting=$sorting&OptionList=$OptionList&CURRENT_PAGE=$CURRENT_PAGE&keyword=$keyword";
}


if ($action == 'delete') {   //�߰� ���� �����ɼǽ� ����

	$VIEW_QUERY = "SELECT * FROM ${MALL_TABLE_NAME} WHERE UID='$uid'";
	$LIST = mysql_fetch_array(mysql_query($VIEW_QUERY, $DB_CONNECT));

	 if (file_exists("../${STOCK_FOLDER_NAME}/$del_Picture")) {
			 unlink("../${STOCK_FOLDER_NAME}/$del_Picture");
	 }

	$rePicture = str_replace($del_Picture , "" , $LIST[Picture]);


	$sql = "update ${MALL_TABLE_NAME} set Picture='$rePicture' where UID='$uid' ";
	$result = mysql_query($sql, $DB_CONNECT ) or die(mysql_error());
	if($result) {
		js_alert_location("�̹����� ���� �Ǿ����ϴ�","$PHP_SELF?menushow=$menushow&THEME=$THEME&uid=$uid&mode=modify&sort=$sort&sort1=$sort1&sort2=$sort2&sorting=$sorting&OptionList=$OptionList&CURRENT_PAGE=$CURRENT_PAGE&keyword=$keyword&Back=$Back");
	} else{
		js_alert_location("DB �۾��� ������ �߻� �߽��ϴ�","-1");
	}


}


if ($action == 'delete2') {   //��ǰ ���� �̹��� ����

	$VIEW_QUERY = "SELECT DetailPicture FROM ${MALL_TABLE_NAME} WHERE UID='$uid'";
	$LIST = mysql_fetch_array(mysql_query($VIEW_QUERY, $DB_CONNECT));

	 if (file_exists("../${STOCK_FOLDER_NAME}/product_detail/$del_Picture")) {
			 unlink("../${STOCK_FOLDER_NAME}/product_detail/$del_Picture");
	 }

	$rePicture = str_replace($del_Picture , "" , $LIST[DetailPicture]);


	$sql = "update ${MALL_TABLE_NAME} set DetailPicture='$rePicture' where UID='$uid' ";
	$result = mysql_query($sql, $DB_CONNECT ) or die(mysql_error());
	if($result) {
		js_alert_location("�̹����� ���� �Ǿ����ϴ�","$PHP_SELF?menushow=$menushow&THEME=$THEME&uid=$uid&mode=modify&sort=$sort&sort1=$sort1&sort2=$sort2&sorting=$sorting&OptionList=$OptionList&CURRENT_PAGE=$CURRENT_PAGE&keyword=$keyword&Back=$Back");
	} else{
		js_alert_location("DB �۾��� ������ �߻� �߽��ϴ�","-1");
	}

}



if ($action == 'writedata') {

		if($Category3) $Category = $Category3;
		else if($Category2) $Category = $Category2;
		else if($Category1) $Category = $Category1;
		else js_alert_location("ī�װ��� �������� �ʾҽ��ϴ�.","-1");


		$Name = addslashes(trim($Name));
		$Size = addslashes(trim($Size));
		$Color = addslashes(trim($Color));
		$Model = addslashes(trim($Model));
		$CompName = addslashes(trim($CompName));
		$GetComp = addslashes(trim($GetComp));
		$CID = $TmpCID;// ���û�ǰ

		// ����
		$InputPrice = "";
		if(is_array($Price)){
			$InputPrice = implode("|" , $Price);
		}


		$InputPoint = "";
		if($POINTSTATUS == "checked"){ // ����Ʈ �Ϸ� �����

			if(is_array($Price)){
				for($i = 0 ; $i < sizeof($Price) ; $i++){
					$InputPoint .=  $Price[$i] * ($POINTRATE/100) . "|";
				}

			}

			$InputPoint = substr($InputPont , 0 , -1);


		}else{// �Ϸ� ������ �ƴ� �ϳ��� �Է½�
			if(is_array($Point)){
				$InputPoint = implode("|" , $Point);
			}

		}


		//�ɼ� ��ǰ.
		$InputOption3 = "" ;
		for($i = 0 ; $i < sizeof($Option3) ; $i++){
			$InputOption3 .= $Option3[$i]. "|";
		}


    if($TextType1 == "checked") {$Description1 = addslashes( trim($Description1) );}
        else {$Description1 = htmlspecialchars($Description1);}
		if($TextType2 == "checked") {$Description2 = addslashes( trim($Description2) );}
        else {$Description2 = htmlspecialchars($Description2);}

		$SDay1 = explode("-" , $SDay);
		$WDate = mktime(0,0,0,$SDay1[1],$SDay1[2],$SDay1[0]);


/* ���� ���ε� ���� */
unset($Picture);
/*
for($i=0; $i<sizeof($file); $i++){
	echo 'aa:';
	echo $file_name[$i];
	if($file[$i]!="none" && $file[$i]){
		echo "\$file_name[$i] = $file_name[$i] <br>";
		//$file_name[$i]=time();
    	if (file_exists("../${STOCK_FOLDER_NAME}/$file_name[$i]")) {
	    $file_name[$i] = time()."_$file_name[$i]";
    	}
	    if(!move_uploaded_file($file[$i], "../${STOCK_FOLDER_NAME}/$file_name[$i]")) {
    	echo "���� ���ε忡 ���� �Ͽ����ϴ�.";
	    exit;}
	}
	$Picture .=$file_name[$i]."|";
}
*/
$file = $_FILES["file0"]["tmp_name"];
$file_name = $_FILES["file0"]["name"];
if($file!="none" && $file){
	//echo "\$file_name = $file_name <br>";
	//$file_name[$i]=time();
	if (file_exists("../${STOCK_FOLDER_NAME}/$file_name")) {
	$file_name[$i] = time()."_$file_name";
	}
	if(!move_uploaded_file($file, "../${STOCK_FOLDER_NAME}/$file_name")) {
	echo "���� ���ε忡 ���� �Ͽ����ϴ�.";
	exit;}
}
$Picture .=$file_name."|";

$file = $_FILES["file1"]["tmp_name"];
$file_name = $_FILES["file1"]["name"];
if($file!="none" && $file){
	//echo "\$file_name = $file_name <br>";
	//$file_name[$i]=time();
	if (file_exists("../${STOCK_FOLDER_NAME}/$file_name")) {
	$file_name[$i] = time()."_$file_name";
	}
	if(!move_uploaded_file($file, "../${STOCK_FOLDER_NAME}/$file_name")) {
	echo "���� ���ε忡 ���� �Ͽ����ϴ�.";
	exit;}
}
$Picture .=$file_name."|";

$file = $_FILES["file2"]["tmp_name"];
$file_name = $_FILES["file2"]["name"];
if($file!="none" && $file){
	//echo "\$file_name = $file_name <br>";
	//$file_name[$i]=time();
	if (file_exists("../${STOCK_FOLDER_NAME}/$file_name")) {
	$file_name[$i] = time()."_$file_name";
	}
	if(!move_uploaded_file($file, "../${STOCK_FOLDER_NAME}/$file_name")) {
	echo "���� ���ε忡 ���� �Ͽ����ϴ�.";
	exit;}
}
$Picture .=$file_name."|";

unset($DetailPicture);//�� ���� �̹���
/*
for($i=0; $i<sizeof($file1); $i++){
	if($file1[$i]!="none" && $file1[$i]){
    	if (file_exists("../${STOCK_FOLDER_NAME}/product_detail/$file1_name[$i]")) {
	    $file1_name[$i] = time()."_$file1_name[$i]";

    	}
	    if(!move_uploaded_file($file1[$i], "../${STOCK_FOLDER_NAME}/product_detail/$file1_name[$i]")) {
    	echo "���� ���ε忡 ���� �Ͽ����ϴ�.";
	    exit;}
	$DetailPicture .=$file1_name[$i]."|";
	}
}
*/
$file1 = $_FILES["file10"]["tmp_name"];
$file1_name = $_FILES["file10"]["name"];
if($file1!="none" && $file1){
	if (file_exists("../${STOCK_FOLDER_NAME}/product_detail/$file1_name")) {
	$file1_name = time()."_$file1_name";

	}
	if(!move_uploaded_file($file1, "../${STOCK_FOLDER_NAME}/product_detail/$file1_name")) {
	echo "���� ���ε忡 ���� �Ͽ����ϴ�.";
	exit;}
$DetailPicture .=$file1_name."|";
}

if($Status !="Y") $Status = "N";

#�ɼ��ʵ�� ����

$STRING = "<?";
$i=0;
foreach($OptionNameTmp as $key => $value){
		$STRING .= "
		\$OptionName[${tmparr[$i]}][0] = \"${OptionNameTmp[$i]}\";
		\$OptionName[${tmparr[$i]}][1] = \"${OptionPropertyTmp[$i]}\";
		";
	$i++;
}
$STRING .="?>";
$fp = fopen("../config/OptionName.php", "w");
fwrite($fp, "$STRING");
fclose($fp);


if(!$InputPrice) $InputPrice = 0;
if(!$InputPoint) $InputPoint = 0;


/* ���� ���ε� �� */
	$QUERY1 = "INSERT INTO ${MALL_TABLE_NAME} (
						 MERCHANT_ID , PID,Name,Brand,CompName,Price,Price1,Point,Model,Size,Color,Option1,Option2,Option3,Option4,Option5,
						 Picture,DetailPicture,None,Input,Output,Stock,WDate,Description1,Description2,Category,CID ,
						 TextType1,TextType2,Hit,GetComp,MainDisplay,Ranking,Status , SiteKey
						 ) VALUES (
						 '$MERCHANT_ID', '$PID','$Name','$Brand','$CompName','$InputPrice','$Price1','$InputPoint','$Model','$Size','$Color','$Option1','$Option2','$InputOption3',
						 '$Option4','$Option5','$Picture','$DetailPicture','$None','$Input','$Output','$Stock','$WDate','$Description1','$Description2','$Category','$CID' ,
						 '$TextType1','$TextType2', '$Hit','$GetComp','$MainDisplay','$Ranking','$Status' , '$SiteKey')";
	$result = mysql_query($QUERY1,$DB_CONNECT) or die(mysql_error());

	$PID = mysql_insert_id();

	$sql = "update ${MALL_TABLE_NAME} set PID = '$PID' where UID = '$PID' ";
	mysql_query($sql);
//�ɼ����ϸ� ����


// ���� ī�װ� �۾�
$MultiCategoryArr = explode("|", $TmpMultiCategoryvalue);
$MultiCategoryArr = array_unique($MultiCategoryArr); // �ߺ��� ����

for($i=0; $i < sizeof($MultiCategoryArr) && $MultiCategoryArr[$i] ; $i++){
	if($MultiCategoryArr[$i]){
		$sqlstr = "INSERT INTO ${MALL_TABLE_NAME} (
							 MERCHANT_ID , PID,Name,Brand,CompName,Price,Price1,Point,Model,Size,Color,Option1,Option2,Option4,Option5,
							 Picture,DetailPicture,None,Input,Output,Stock,WDate,Description1,Description2,Category,CID ,
							 TextType1,TextType2,Hit,GetComp,MainDisplay,Ranking,Status , SiteKey
							 ) VALUES (
							 '$MERCHANT_ID', '$PID','$Name','$Brand','$CompName','$InputPrice','$Price1','$InputPoint','$Model','$Size','$Color','$Option1','$Option2',
							 '$Option4','$Option5','$Picture','$DetailPicture','$None','$Input','$Output','$Stock','$WDate','$Description1','$Description2','$MultiCategoryArr[$i]','$CID' ,
							 '$TextType1','$TextType2', '$Hit','$GetComp','$MainDisplay','$Ranking','$Status' , '$SiteKey')";
							 $sqlqry = mysql_query($sqlstr) or die(mysql_error());
	}
}

	if($result){
		js_alert_location("���������� ���� �Ǿ����ϴ�.","$PHP_SELF?menushow=$menushow&THEME=ProductList&sort=$sort&sort1=$sort1&sort2=$sort2&sorting=$sorting&OptionList=$OptionList&CURRENT_PAGE=$CURRENT_PAGE&keyword=$keyword&Back=$Back");
	}else{
		js_alert_location("DB �۾��� ������ �߻��Ͽ����ϴ�.","$PHP_SELF?menushow=$menushow&THEME=ProductList&sort=$sort&sort1=$sort1&sort2=$sort2&sorting=$sorting&OptionList=$OptionList&CURRENT_PAGE=$CURRENT_PAGE&keyword=$keyword&Back=$Back");
	}

}


if($bmode == "modify"){


	if($Category3) $Category = $Category3;
	else if($Category2) $Category = $Category2;
	else if($Category1) $Category = $Category1;
	else js_alert_location("ī�װ��� �������� �ʾҽ��ϴ�.","-1");

	$Name = addslashes(trim($Name));
	$Size = addslashes(trim($Size));
	$Color = addslashes(trim($Color));
	$Model = addslashes(trim($Model));
	$CompName = addslashes(trim($CompName));
	$GetComp = addslashes(trim($GetComp));
	$Category = trim($Category);
	$CID = $TmpCID;// ���û�ǰ

	//�ɼ� ��ǰ.
	$InputOption3 = "" ;
	for($i = 0 ; $i < sizeof($Option3) ; $i++){
		$InputOption3 .= $Option3[$i]. "|";
	}
	// ����
	$InputPrice = "";
	if(is_array($Price)){
		$InputPrice = implode("|" , $Price);
	}


	$InputPoint = "";
	if($POINTSTATUS == "checked"){ // ����Ʈ �Ϸ� �����

		if(is_array($Price)){
			for($i = 0 ; $i < sizeof($Price) ; $i++){
				$InputPoint .=  $Price[$i] * ($POINTRATE/100) . "|";
			}

		}

		$InputPoint = substr($InputPont , 0 , -1);


	}else{// �Ϸ� ������ �ƴ� �ϳ��� �Է½�
		if(is_array($Point)){
			$InputPoint = implode("|" , $Point);
		}

	}



	if($TextType1 == "checked") {$Description1 = addslashes( trim($Description1) );}
	else {$Description1 = htmlspecialchars($Description1);}

	if($TextType2 == "checked") {$Description2 = addslashes( trim($Description2) );}
	else {$Description2 = htmlspecialchars($Description2);}


	//$SDay1 = explode("-" , $SDay);
	//$WDate = mktime(0,0,0,$SDay1[1],$SDay1[2],$SDay1[0]);


	$PicValue = getSingleValue("select Picture from ${MALL_TABLE_NAME} WHERE UID='$uid'");
	$PicList = explode("|", $PicValue);
	/* ���� ���ε� ���� */
	unset($Picture);
	/*
	for($i=0; $i < sizeof($file); $i++){
		$MicroTsmp = split(" ",microtime());
		$newFileName = str_replace(".", "", $MicroTsmp[0]);
		if($file[$i]!="none" && $file[$i]){
			$extention = strrchr($file_name[$i], ".");
			$file_name[$i] = time()."".$extention;
			if($PicList[$i]) unlink("../${STOCK_FOLDER_NAME}/$PicList[$i]");
			if (file_exists("../${STOCK_FOLDER_NAME}/$file_name[$i]")) {
			$file_name[$i] = $newFileName."_$file_name[$i]";
			}
			if(!move_uploaded_file($file[$i], "../${STOCK_FOLDER_NAME}/$file_name[$i]")) {
				js_alert_location("���� ���ε忡 ���� �Ͽ����ϴ�.","-1");
			}
		$UPDIR[$i]=$file_name[$i];
		}else $UPDIR[$i]=$PicList[$i];
	$Picture .=$UPDIR[$i]."|";
	}
	*/

	$file = $_FILES["file0"]["tmp_name"];
	$file_name = $_FILES["file0"]["name"];
	$MicroTsmp = split(" ",microtime());
	$newFileName = str_replace(".", "", $MicroTsmp[0]);
	if($file!="none" && $file){
		$extention = strrchr($file_name, ".");
		$file_name = time()."".$extention;
		if($PicList[0]) unlink("../${STOCK_FOLDER_NAME}/$PicList[0]");
		if (file_exists("../${STOCK_FOLDER_NAME}/$file_name")) {
		$file_name = $newFileName."_$file_name";
		}
		if(!move_uploaded_file($file, "../${STOCK_FOLDER_NAME}/$file_name")) {
			js_alert_location("���� ���ε忡 ���� �Ͽ����ϴ�.","-1");
		}
	$UPDIR[0]=$file_name;
	}else $UPDIR[0]=$PicList[0];
	$Picture .=$UPDIR[0]."|";


	$file = $_FILES["file1"]["tmp_name"];
	$file_name = $_FILES["file1"]["name"];
	$MicroTsmp = split(" ",microtime());
	$newFileName = str_replace(".", "", $MicroTsmp[0]);
	if($file!="none" && $file){
		$extention = strrchr($file_name, ".");
		$file_name = time()."".$extention;
		if($PicList[1]) unlink("../${STOCK_FOLDER_NAME}/$PicList[1]");
		if (file_exists("../${STOCK_FOLDER_NAME}/$file_name")) {
		$file_name = $newFileName."_$file_name";
		}
		if(!move_uploaded_file($file, "../${STOCK_FOLDER_NAME}/$file_name")) {
			js_alert_location("���� ���ε忡 ���� �Ͽ����ϴ�.","-1");
		}
	$UPDIR[1]=$file_name;
	}else $UPDIR[1]=$PicList[1];
	$Picture .=$UPDIR[1]."|";

	$file = $_FILES["file2"]["tmp_name"];
	$file_name = $_FILES["file2"]["name"];
	$MicroTsmp = split(" ",microtime());
	$newFileName = str_replace(".", "", $MicroTsmp[0]);
	if($file!="none" && $file){
		$extention = strrchr($file_name, ".");
		$file_name = time()."".$extention;
		if($PicList[2]) unlink("../${STOCK_FOLDER_NAME}/$PicList[2]");
		if (file_exists("../${STOCK_FOLDER_NAME}/$file_name")) {
		$file_name = $newFileName."_$file_name";
		}
		if(!move_uploaded_file($file, "../${STOCK_FOLDER_NAME}/$file_name")) {
			js_alert_location("���� ���ε忡 ���� �Ͽ����ϴ�.","-1");
		}
	$UPDIR[2]=$file_name;
	}else $UPDIR[2]=$PicList[2];
	$Picture .=$UPDIR[2]."|";


// ��ǰ ���� �̹���

	$PicValue2 = getSingleValue("select DetailPicture from ${MALL_TABLE_NAME} WHERE UID='$uid'");
	$PicList2 = explode("|", $PicValue2);
	/* ���� ���ε� ���� */
	unset($DetailPicture);
	/*
	for($i=0; $i < sizeof($file1); $i++){
	$MicroTsmp = split(" ",microtime());
	$newFileName = str_replace(".", "", $MicroTsmp[0]);
		if($file1[$i]!="none" && $file1[$i]){
			$extention = strrchr($file1_name[$i], ".");
			$file1_name[$i] = time()."".$extention;
			if($PicList2[$i]) unlink("../${STOCK_FOLDER_NAME}/product_detail/$PicList2[$i]");
			if (file_exists("../${STOCK_FOLDER_NAME}/product_detail/$file1_name[$i]")) {
			$file1_name[$i] = $newFileName."_$file1_name[$i]";
			}
			if(!move_uploaded_file($file1[$i], "../${STOCK_FOLDER_NAME}/product_detail/$file1_name[$i]")) {
				js_alert_location("���� ���ε忡 ���� �Ͽ����ϴ�.","-1");
			}
		$UPDIR2[$i]=$file1_name[$i];
		}else $UPDIR2[$i]=$PicList2[$i];
	$DetailPicture .=$UPDIR2[$i]."|";
	}
	*/

	$file1 = $_FILES["file10"]["tmp_name"];
	$file1_name = $_FILES["file10"]["name"];
	$MicroTsmp = split(" ",microtime());
	$newFileName = str_replace(".", "", $MicroTsmp[0]);
	if($file1!="none" && $file1){
		$extention = strrchr($file1_name, ".");
		$file1_name = time()."".$extention;
		if($PicList2[0]) unlink("../${STOCK_FOLDER_NAME}/product_detail/$PicList2[0]");
		if (file_exists("../${STOCK_FOLDER_NAME}/product_detail/$file1_name")) {
		$file1_name = $newFileName."_$file1_name";
		}
		if(!move_uploaded_file($file1, "../${STOCK_FOLDER_NAME}/product_detail/$file1_name")) {
			js_alert_location("���� ���ε忡 ���� �Ͽ����ϴ�.","-1");
		}
	$UPDIR2[0]=$file1_name;
	}else $UPDIR2[0]=$PicList2[0];
	$DetailPicture .=$UPDIR2[0]."|";


if($Status !="Y") $Status = "N";
#�ɼ��ʵ�� ����

$cnt = 0;

$STRING = "<?";
$i=0;
foreach($OptionNameTmp as $key => $value){
		$STRING .= "
		\$OptionName[${tmparr[$i]}][0] = \"${OptionNameTmp[$i]}\";
		\$OptionName[${tmparr[$i]}][1] = \"${OptionPropertyTmp[$i]}\";
		";
	$i++;
}
$STRING .="?>";
$fp = fopen("../config/OptionName.php", "w");
fwrite($fp, "$STRING");
fclose($fp);


if(!$InputPrice) $InputPrice = 0;
if(!$InputPoint) $InputPoint = 0;


$sql = "UPDATE ${MALL_TABLE_NAME} SET
MERCHANT_ID = '$MERCHANT_ID' ,
PID  = '$uid' ,
Name  = '$Name' ,
Brand  = '$Brand' ,
CompName  = '$CompName' ,
Price  = '$InputPrice' ,
Price1  = '$Price1' ,
Point  = '$InputPoint' ,
Model  = '$Model' ,
Size  = '$Size' ,
Color  = '$Color' ,
Option1  = '$Option1' ,
Option2  = '$Option2' ,
Option3  = '$InputOption3' ,
Option4  = '$Option4' ,
Option5  = '$Option5' ,
Picture  = '$Picture' ,
DetailPicture  = '$DetailPicture' ,
None  = '$None' ,
Input  = '$Input' ,
WDate  = '$WDate' ,
Description1  = '$Description1' ,
Description2  = '$Description2' ,
Category  = '$Category' ,
CID = '$CID' ,
TextType1  = '$TextType1' ,
TextType2  = '$TextType2' ,
GetComp  = '$GetComp' ,
MainDisplay  = '$MainDisplay' ,
Ranking  = '$Ranking' ,
Status = '$Status'
WHERE UID='$uid'";
$result = mysql_query($sql,$DB_CONNECT) or die(mysql_error());


/* MultiCategory �� ���� ��� ���� ī�װ��� �����ϰ� ���� �߰� �Ѵ�. ���� Option3�� insert���� �ʴ´�. */
$sqlstr = "delete from ${MALL_TABLE_NAME} where PID <> '' and PID = '$uid' and PID <> UID";
$sqlqry = mysql_query($sqlstr) or die(mysql_error());
$MultiCategoryArr = explode("|", $TmpMultiCategoryvalue);
$MultiCategoryArr = array_unique($MultiCategoryArr); // �ߺ��� ����
for($i=0; $i < sizeof($MultiCategoryArr) && $MultiCategoryArr[$i] ; $i++){
	if($MultiCategoryArr[$i]){
		$sqlstr = "INSERT INTO ${MALL_TABLE_NAME} (
							 MERCHANT_ID , PID,Name,Brand,CompName,Price,Price1,Point,Model,Size,Color,Option1,Option2,Option4,Option5,
							 Picture,DetailPicture,None,Input,Output,Stock,WDate,Description1,Description2,Category,CID ,
							 TextType1,TextType2,Hit,GetComp,MainDisplay,Ranking,Status , SiteKey
							 ) VALUES(
							 '$MERCHANT_ID', '$uid','$Name','$Brand','$CompName','$InputPrice','$Price1','$InputPoint','$Model','$Size','$Color','$Option1','$Option2',
							 '$Option4','$Option5','$Picture','$DetailPicture','$None','$Input','$Output','$Stock','$WDate','$Description1','$Description2','$MultiCategoryArr[$i]','$CID' ,
							 '$TextType1','$TextType2', '$Hit','$GetComp','$MainDisplay','$Ranking','$Status' , '$SiteKey')";
							 $sqlqry = mysql_query($sqlstr) or die(mysql_error());
	}
}
/* MultiCategory �� */



if($result) {
	if($Back) js_alert_location("���� �Ǿ����ϴ�.","$PHP_SELF?menushow=$menushow&THEME=$Back&sort=$sort&sort1=$sort1&sort2=$sort2&sorting=$sorting&OptionList=$OptionList&CURRENT_PAGE=$CURRENT_PAGE&keyword=$keyword");
	else 	js_alert_location("���� �Ǿ����ϴ�.","$PHP_SELF?menushow=$menushow&THEME=ProductList&sort=$sort&sort1=$sort1&sort2=$sort2&sorting=$sorting&OptionList=$OptionList&CURRENT_PAGE=$CURRENT_PAGE&keyword=$keyword");
} else{
	js_alert_location("DB �۾��� ������ �߻� �߽��ϴ�","-1");

}


}


if($mode == "modify") { // ���÷���

	$sqlstr = "SELECT * FROM ${MALL_TABLE_NAME} WHERE UID='$uid'";
	$list = mysql_fetch_array(mysql_query($sqlstr, $DB_CONNECT));
	$list[Name] = stripslashes($list[Name]);
	$list[CompName] = stripslashes($list[CompName]);
	$list[Description1] = stripslashes($list[Description1]);
	$list[Description2] = stripslashes($list[Description2]);
	$list[Model] = stripslashes($list[Model]);
	$Picture = explode("|",$list[Picture]);
	$DetailPicture = explode("|",$list[DetailPicture]);
	$list[Option2] = stripslashes($list[Option2]);
	$list[Size] = stripslashes($list[Size]);
	$list[PID] = stripslashes($list[PID]);
	$Price = explode("|",$list[Price]);// ���� �迭ó��
	$Point = explode("|",$list[Point]);// ����Ʈ �迭ó��


}
?>


<script language=javascript>
<!--
function checkForm(f) {

	var MultiCategorylen = f.TmpMultiCategory.length;
	var TmpMultivalue = '';
	for(var i=0; i< MultiCategorylen; i++){
	if(f.TmpMultiCategory.options[i]) TmpMultivalue += f.TmpMultiCategory.options[i].value + '|';
	}
	f.TmpMultiCategoryvalue.value = TmpMultivalue;

	var CIDlen = f.CID.length;
	var TmpCIDValue = '';
	for(var i=0; i< CIDlen; i++){
	if(f.CID.options[i]) TmpCIDValue += f.CID.options[i].value + '|';
	}
	f.TmpCID.value = TmpCIDValue;

checkenable = new Array();
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

}

//-->
</script>
<script>
<!--


function MultiCategorySelect(selObj){
	var f=document.WriteForm
	var aIdx=f.TmpMultiCategory.options.length;
	var str=selObj.options[selObj.selectedIndex].text;

	if(aIdx){
		for(i=0; i<aIdx; i++){
			if(f.TmpMultiCategory.options[i].value == selObj.options[selObj.selectedIndex].value){
				alert('����ī�װ��� ���õǾ����ϴ�.');
				return false;
			}

		}
	}

	if(selObj.options[selObj.selectedIndex].value != ""){

		var itm= new Option(str)
		if(aIdx >= 10){
			window.alert('10���̻� ī�װ� ������ �Ұ����մϴ�.');
			return false;
		}
		f.TmpMultiCategory.options[aIdx] = itm;
		f.TmpMultiCategory.options[aIdx].value = selObj.options[selObj.selectedIndex].value

	}

}

function DeleteMultiCat(sel){
	if(sel.selectedIndex == "-1" ){
		alert("�����ϰ��� �׸��� �������ּ���");
		return;
	} else {
		var selectedIndexNo = sel.selectedIndex;
		sel.options[sel.selectedIndex] = null;
	}
}
function DeleteRelative(sel){
	if(sel.selectedIndex == "-1" ){
		alert("�����ϰ��� �׸��� �������ּ���");
		return;
	} else {
		var selectedIndexNo = sel.selectedIndex;
		sel.options[sel.selectedIndex] = null;
	}
}


function addToPIC()
{

	nameToDiv.insertAdjacentElement("BeforeEnd",document.createElement("<INPUT type='file' name='file[]'  size = 30>"));
	nameToDiv.insertAdjacentElement("BeforeEnd",document.createElement("<br>"));
}

function del(obj,no)// ��ǰ �̹��� ����
{
	location.href = "<? echo $_SERVER[PHP_SELF]; ?>?menushow=<? echo $menushow;?>&THEME=<? echo $THEME; ?>&uid="+no+"&action=delete"+ "&del_Picture=" + obj + "&sort=<? echo $sort ;?>&sort1=<? echo $sort1 ;?>&sort2=<? echo $sort2 ;?>&sorting=<? echo $sorting ;?>&OptionList=<? echo $OptionList ;?>&CURRENT_PAGE=<? echo $CURRENT_PAGE ;?>&keyword=<? echo $keyword ;?>&Back=<? echo $Back; ?>" ;
}
function del2(obj,no)// ��ǰ ���� �̹��� ����
{
	location.href = "<? echo $_SERVER[PHP_SELF]; ?>?menushow=<? echo $menushow;?>&THEME=<? echo $THEME; ?>&uid="+no+"&action=delete2"+ "&del_Picture=" + obj + "&sort=<? echo $sort ;?>&sort1=<? echo $sort1 ;?>&sort2=<? echo $sort2 ;?>&sorting=<? echo $sorting ;?>&OptionList=<? echo $OptionList ;?>&CURRENT_PAGE=<? echo $CURRENT_PAGE ;?>&keyword=<? echo $keyword ;?>&Back=<? echo $Back; ?>" ;
}


function getCategory(step,f,flag){
	form = f.form.name;
	dynamic.src = "./SubCategory.php?step="+step+"&trigger="+f.value+"&form="+form+"&flag="+flag;
}

-->
</script>
<script language="Javascript1.2" >
<!-- // load htmlarea
_editor_url = "../js/HtmlArea/";                     // URL to htmlarea files
var win_ie_ver = parseFloat(navigator.appVersion.split("MSIE")[1]);
if (navigator.userAgent.indexOf('Mac')        >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Windows CE') >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Opera')      >= 0) { win_ie_ver = 0; }
if (win_ie_ver >= 5.5) {
  document.write('<scr' + 'ipt src="' +_editor_url+ 'editor.js"');
  document.write(' language="Javascript1.2"></scr' + 'ipt>');
} else { document.write('<scr'+'ipt>function editor_generate() { return false; }</scr'+'ipt>'); }
// -->
</script>
<script language="javascript" src = "../js/Calandar.js"></script>
<script language="javascript" src="../js/General.js"></script>
<script id="dynamic"></script>
<table width="747" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> <table width="770" border="0" cellpadding="5" cellspacing="5" bgcolor="EEEEEE">
        <tr>
          <td align="center" <? echo $CONTENT_STYLE; ?>><table width="730"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="30" class="black_16"><strong><font color="#3366CC">��ǰ���</font></strong></td>
              </tr>
              <tr>
                <td>��ǰ�� ī�װ��� �°� �з��Ͽ� ��� �� ���� �Ͻʽÿ�.<br>
                  ī�װ��� �����Ͻ� ������ ���� ���� ī�װ��� ����� �ֽñ� �ٶ��ϴ�.<br>
                  <strong><font color="C15B27">���� ī�װ������ ���� ī�װ��� ������ ��� �ϼŵ�
                  �ϳ��� ī�װ��� ����˴ϴ�.<br>
                  ���� ī�װ��� ���Ե� ��ǰ�� ��� �ɼ��� �Էµ��� �ʽ��ϴ�.</font></strong></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td <? echo $TITLE_STYLE ; ?> height = 30 >*�ʼ� �Է� ����</td>
  </tr>
<form method='post' enctype='multipart/form-data' NAME='WriteForm' action='<? echo $PHP_SELF; ?>' onsubmit='return checkForm(this);'>
<INPUT type=hidden name='mode' value='<? echo $mode;?>'>
<?
if($list[UID]){
$mode = "modify";
?>
<INPUT type=hidden name='bmode' value='<? echo $mode;?>'>
<? }else{?>
<INPUT type=hidden name='action' value='writedata'>
<? } ?>
<INPUT type=hidden name='uid' value='<? echo $uid;?>'>
<INPUT type=hidden name= menushow value=<? echo $menushow; ?>>
<INPUT type=hidden name=THEME value=<? echo $THEME;?>>
<INPUT type=hidden name='Back' value='<?=$Back?>'><!-- ���� �������� �����ϱ� ���� �÷��� -->
<INPUT type=hidden name='keyword' value='<?=$keyword?>'>
<INPUT type=hidden name='OPTI_LIST' value='<?=$OPTI_LIST?>'>
<INPUT type=hidden name='sort' value='<?=$sort?>'>
<INPUT type=hidden name='sort1' value='<?=$sort1?>'>
<INPUT type=hidden name='sort2' value='<?=$sort2?>'>
<INPUT type=hidden name='sorting' value='<?=$sorting?>'>
<INPUT type=hidden name='CURRENT_PAGE' value='<?=$CURRENT_PAGE?>'>
<INPUT type=hidden id='TmpMultiCategoryvalue' name='TmpMultiCategoryvalue' value=''>
<INPUT type=hidden id='TmpCID' name='TmpCID' value=''>

    <tr>
      <td> <table width=100% cellpadding="5" cellspacing="1"  border=0 align="center" <? echo $TABLE_STYLE; ?>>
          <TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>> *ī�װ�</TD>
            <TD <? echo $CONTENT_STYLE; ?>> &nbsp;
							<select name="Category1" onChange="getCategory('1', this, 'M')" id = "checkenable" title = "ī�װ��� �������ֽʽÿ�" style="width:130px">
							<option value="" selected style = "background-color:red;color:white">��з� </option>
							<?
								$sqlstr = "SELECT cat_no, cat_name FROM ${CATEGORY_TABLE_NAME} WHERE cat_no < 100 and cat_flag = 'M' ORDER BY cat_no ASC";
								$sqlqry = mysql_query($sqlstr);
								while($LIST=@mysql_fetch_array($sqlqry)):
								if($LIST[cat_no] == "0000" . substr($list[Category],-2) ) $selected  = " selected" ; else $selected = "" ;
								echo"<option value='$LIST[cat_no]' ${selected}>$LIST[cat_name]</option> \n";
								endwhile;

							?>
							</select> <select name="Category2" onChange="getCategory('2', this, 'M')" style="width:130px">
							<option value="" selected style = "background-color:red;color:white">�ߺз�</option>
							<?
							if($mode == "modify"){
								$Mcode = substr($list[Category],4);
								$sqlstr ="select cat_no, cat_name from ${CATEGORY_TABLE_NAME} WHERE cat_no < 10000 AND cat_no >= 100 AND cat_no LIKE '%$Mcode'  and cat_flag = 'M' ORDER BY cat_no ASC";
								$sqlqry = mysql_query($sqlstr);
								while($LIST=@mysql_fetch_array($sqlqry)):
									if($LIST[cat_no] == "00" . substr($list[Category],2) ) $selected  = " selected" ; else $selected = "" ;
								echo"<option value='$LIST[cat_no]' ${selected}>$LIST[cat_name]</option> \n";
								endwhile;
							}
							?>
							</select> <select name="Category3" style="width:130px">
							<option value="" selected style = "background-color:red;color:white">�Һз�</option>
							<?
							if($mode == "modify"){
								$Scode = substr($list[Category],2);
								$sqlstr ="select cat_no, cat_name from ${CATEGORY_TABLE_NAME} WHERE  cat_no >= 10000 AND cat_no like '%$Scode'  and cat_flag = 'M' ORDER BY cat_no ASC";
								$sqlqry = mysql_query($sqlstr);
								while($LIST=@mysql_fetch_array($sqlqry)):
									if($LIST[cat_no] == $list[Category]) $selected  = " selected" ; else $selected = "" ;
								echo"<option value='$LIST[cat_no]' ${selected}>$LIST[cat_name]</option> \n";
								endwhile;
							}
							?>
							</select>

			  <br>
              &nbsp;(���ī�װ��� ������ ī�װ��� <A HREF='./main.php?menushow=<? echo $menushow;?>&THEME=CategoryManager'><font color="#DBB6F5"><strong>���</strong></font></A>
              �ϼ���)</TD>
          </TR>

					<TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>>����ī�װ�</TD>
            <TD <? echo $CONTENT_STYLE; ?>>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="300px" valign="top">&nbsp; <select style="WIDTH: 270px" name="SelectCategory" class="dd1" onChange="MultiCategorySelect(this)">
                      <option value='' style = "background-color:red;color:white">��ǰ��� ī�װ� ����</option>
                      <?
$SQL_STR = "SELECT cat_no, cat_name FROM ${CATEGORY_TABLE_NAME} WHERE cat_no < 100  and cat_flag = 'M' ORDER BY cat_no ASC";
$SQL_QRY = mysql_query($SQL_STR);
while($LIST=@mysql_fetch_array($SQL_QRY)):
	if($LIST[cat_no]==$list[Category]) ECHO "<OPTION VALUE='$LIST[cat_no]' selected>$LIST[cat_name]</OPTION>\n";
	else ECHO "<OPTION VALUE='$LIST[cat_no]'>$LIST[cat_name]</OPTION>\n";
	$cat_no_new = substr($LIST[cat_no],4);
	$SQL_STR1 = "SELECT cat_no, cat_name FROM ${CATEGORY_TABLE_NAME} WHERE cat_no < 10000 AND cat_no >= 100 AND cat_no LIKE '%$cat_no_new'  and cat_flag = 'M' ORDER BY cat_no ASC";
	$SQL_QRY1 = mysql_query($SQL_STR1);
	while($LIST1=@mysql_fetch_array($SQL_QRY1)):
		if($LIST1[cat_no]==$list[Category]) ECHO "<OPTION VALUE='$LIST1[cat_no]' selected>$LIST[cat_name] > $LIST1[cat_name]</OPTION>\n";
		else ECHO "<OPTION VALUE='$LIST1[cat_no]'>$LIST[cat_name] > $LIST1[cat_name]</OPTION>\n";
		$cat_no_new1 = substr($LIST1[cat_no],2);
		$SQL_STR2 = "SELECT cat_no, cat_name FROM ${CATEGORY_TABLE_NAME} WHERE cat_no >= 10000 AND cat_no LIKE '%$cat_no_new1'  and cat_flag = 'M' ORDER BY cat_no ASC";
		$SQL_QRY2 = mysql_query($SQL_STR2);
		while($LIST2=@mysql_fetch_array($SQL_QRY2)):
		if($LIST2[cat_no]==$list[Category]) ECHO "<OPTION VALUE='$LIST2[cat_no]' selected>$LIST[cat_name] > $LIST1[cat_name] > $LIST2[cat_name]</OPTION>\n";
		else ECHO "<OPTION VALUE='$LIST2[cat_no]'>$LIST[cat_name] > $LIST1[cat_name] > $LIST2[cat_name]</OPTION>\n";
		endwhile;
	endwhile;
endwhile;
?>
                    </select></td>
                  <td valign="top"><select name="TmpMultiCategory" size="10" multiple style = "width:270px">
<?

$sqlsubstr = "select Category from ${MALL_TABLE_NAME} where PID = '$uid' and UID != '$uid'";
$sqlsubqry = mysql_query($sqlsubstr) or die(mysql_error());
while($sublist = mysql_fetch_array($sqlsubqry)):
	if(($big_cat = substr($sublist[Category], -2)) > 0){
		$cat_name = getSingleValue("select cat_name from ${CATEGORY_TABLE_NAME} where cat_no = '0000$big_cat' and cat_flag = 'M' ");
	}
	if(($mid_cat = substr($sublist[Category], -4)) > 100){
		$cat_name .= ">" . getSingleValue("select cat_name from ${CATEGORY_TABLE_NAME} where cat_no = '00$mid_cat' and cat_flag = 'M'");
	}
	if(($small_cat = substr($sublist[Category], -6)) > 10000){
		$cat_name .= ">" . getSingleValue("select cat_name from ${CATEGORY_TABLE_NAME} where cat_no = '$small_cat' and cat_flag = 'M'");
	}
?>
<option value="<?=$sublist[Category]?>">
<?=$cat_name?>
</option>
<?
endwhile;
?>
                    </select>
										<img src = "./img/btn_set/btn_del.gif" onClick="DeleteMultiCat(document.WriteForm.TmpMultiCategory)" style = "cursor:hand">
                  </td>
                </tr>
              </table>

					  </TD>
          </TR>
          <TR>
            <TD WIDTH='100' height="40" <? echo $LEFT_STYLE; ?>> *��ǰ��</TD>
            <TD <? echo $CONTENT_STYLE; ?> height="40">&nbsp; <INPUT name='Name' size='26' value = "<? echo $list[Name]; ?>" id = "checkenable" title = "��ǰ���� �Է����ּ���">
              &nbsp;</TD>
          </TR>
          <TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>> ��ǰ�𵨸�</TD>
            <TD <? echo $CONTENT_STYLE; ?>>&nbsp; <INPUT NAME='Model' SIZE='26' value = "<? echo $list[Model]; ?>">
              - �𵨸��� �����Ұ�� ����</TD>
          </TR>
          <TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>> ��ǰ��������</TD>
            <TD <? echo $CONTENT_STYLE; ?>>&nbsp;
								<select name="Ranking">
								<option value = "9999" <? if(!$mode || $list[Ranking] == "9999") echo " selected";?>>������� ����</option>
								<?
									$cnt = getSingleValue("SELECT count(*) as cnt FROM ${MALL_TABLE_NAME}");
									if(!$mode) $cnt++;// ���� ��� �ϰ��� ���� ������ ���� ������ ���´�.
									for($i = 1 ; $i <= $cnt ; $i++){
									$i = sprintf("%04d",$i);
									$selectChecked = "" ;
									if($i == $list[Ranking]) $selectChecked = " selected";
								?>
                <option value="<? echo $i; ?>" <? echo $selectChecked; ?>>
                <? echo $i ; ?>
                </option>
                <? }?>
              </select>
              �� ���庰 ������ ������ ���մϴ�.. (������ �ʿ� ���� ���� <font color="#DBB6F5">'������� ����'</font> ����)</TD>
          </TR>
          <TR>
            <TD WIDTH='100' HEIGHT="25" <? echo $LEFT_STYLE; ?>> �Һ��ڰ�</TD>
            <TD HEIGHT="25" <? echo $CONTENT_STYLE; ?>>&nbsp; <INPUT MAXLENGTH='30' NAME='Price1' SIZE='15' onkeyPress="if ((event.keyCode<48) || (event.keyCode>57)) event.returnValue=false;"style="ime-mode:disabled" value = "<? echo $list[Price1]; ?>">
            </TD>
          </TR>

          <TR>
            <TD WIDTH='100' height="35" <? echo $LEFT_STYLE; ?>> *�ǸŰ�</TD>
            <TD <? echo $CONTENT_STYLE; ?> height="35" style = "padding-left:10px">
							<?
								if($PRICEDIFF == "checked"){// ��޺� ����ݹ���� ���
									 $pindex = 0 ;
									 foreach($MEMBER_GRADE_NAME as $key => $value){
										if($value) {
											echo "<input name='Price[]' size='10' onkeyPress='if ((event.keyCode<48) || (event.keyCode>57)) event.returnValue=false;' style='ime-mode:disabled' value = '$Price[$pindex]'> ${value}�� ";// �����ڿ� value ���� ���°� ����
											$pindex++;
											if($pindex%4 == 0 ) echo "<br>";
										}


										}

										$plastindex = sizeof($Price) -1 ;// ������ ������ ��ȸ����..

										echo "<input name='Price[]' size='10' onkeyPress='if ((event.keyCode<48) || (event.keyCode>57)) event.returnValue=false;' style='ime-mode:disabled' value = '$Price[$plastindex]'> ����";// �ǸŰ�
								 }else{
												echo "<input name='Price[]' size='26' onkeyPress='if ((event.keyCode<48) || (event.keyCode>57)) event.returnValue=false;' style='ime-mode:disabled' value = '$Price[0]'> ";// �ǸŰ�
								 }
							?>

            </TD>
          </TR>
          <TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>> �ΰ� ����Ʈ</TD>
            <TD <? echo $CONTENT_STYLE; ?> style = "padding-left:10px">
			<? if($POINTSTATUS == "checked" ){
				echo "�Ϸ����� $POINTRATE % ";

			 } else {// ���������� �����

					if($PRICEDIFF == "checked"){// ��޺� ����ݹ���� ���
					 $pindex = 0 ;
					 foreach($MEMBER_GRADE_NAME as $key => $value){
						if($value) {
							echo "<input name='Point[]' size='10' onkeyPress='if ((event.keyCode<48) || (event.keyCode>57)) event.returnValue=false;' style='ime-mode:disabled' value = '$Point[$pindex]'> ${value}Point ";//
							$pindex++;
							if($pindex%4 == 0 ) echo "<br>";
						}


					  }

					  $plastindex = sizeof($Point) -1 ;// ������ ������ ��ȸ����..

					  echo "<input name='Point[]' size='10' onkeyPress='if ((event.keyCode<48) || (event.keyCode>57)) event.returnValue=false;' style='ime-mode:disabled' value = '$Point[$plastindex]'> �Ϲ�Point";// �ǸŰ�
				 }else{
				        echo "<input name='Point[]' size='26' onkeyPress='if ((event.keyCode<48) || (event.keyCode>57)) event.returnValue=false;' style='ime-mode:disabled' value = '$Point[0]'> ";// �ǸŰ�
				 }

			 }

			?>

            </TD>
          </TR>
          <TR>
            <TD WIDTH='100' height="35" <? echo $LEFT_STYLE; ?>> *��������</FONT></p></TD>
            <TD <? echo $CONTENT_STYLE; ?> height="35" style = "padding-left:10px"><INPUT type='file' name='file0' size = 30>
							<? if($Picture[0]):
							$img = "../${STOCK_FOLDER_NAME}/$Picture[0]";

							if (is_file($img)){
							$Pic_size = @GetImageSize($img);
							$w = $Pic_size[0] + 20 ;
							$h = $Pic_size[1] + 20 ;

							}

							?>
              <a href="javascript:doNothing()" onClick="win1Open=displayImage('<? echo $img; ?>', 'popWin1', '<? echo $w; ?>', '<? echo $h; ?>')" onMouseOver="window.status='Click to display picture'; return true;" onMouseOut="window.status=''"><img src ='../<? echo ${STOCK_FOLDER_NAME}; ?>/<?=$Picture[0]?>' width = 30 border="0"></a>
			 				 <img src = "./img/btn_set/btn_del.gif" onClick = "del('<? echo $Picture[0]; ?>','<? echo $uid; ?>');" style = "cursor:hand" align = "absbottom">
              <? endif;?>
              (��������� <? echo $SIMAGEW; ?> x <? echo $SIMAGEH; ?>)
			 				 <br>
              (<B><FONT COLOR="#FF6600">�׸������� �̸�</FONT></B>�� <FONT COLOR="#FF0000"><B>��������
              ǥ��</B></FONT>�Ͻñ⸦ �����մϴ�.)</TD>
          </TR>
          <TR>
            <TD WIDTH='100' height="35" <? echo $LEFT_STYLE; ?>> *�߰�����</FONT></p></TD>
            <TD <? echo $CONTENT_STYLE; ?> height="35" style = "padding-left:10px">
			  <INPUT type='file' name='file1' size = 30>
							<? if($Picture[1]):
							$img = "../${STOCK_FOLDER_NAME}/$Picture[1]";

							if (is_file($img)){
							$Pic_size = @GetImageSize($img);
							$w = $Pic_size[0] + 20 ;
							$h = $Pic_size[1] + 20 ;

							}

							?>
              <a href="javascript:doNothing()" onClick="win1Open=displayImage('<? echo $img; ?>', 'popWin1', '<? echo $w; ?>', '<? echo $h; ?>')" onMouseOver="window.status='Click to display picture'; return true;" onMouseOut="window.status=''"><img src ='../<? echo ${STOCK_FOLDER_NAME}; ?>/<?=$Picture[1]?>' width = 30 border="0"></a>
			  			<img src = "./img/btn_set/btn_del.gif" onClick = "del('<? echo $Picture[1]; ?>','<? echo $uid; ?>');" style = "cursor:hand" align = "absbottom">
              <? endif;?>
              (��������� <? echo $MIMAGEW; ?> x <? echo $MIMAGEH; ?>)

			</TD>
          </TR>
		  <TR>
            <TD WIDTH='100' height="35" <? echo $LEFT_STYLE; ?>> *ū����</FONT></p></TD>
            <TD <? echo $CONTENT_STYLE; ?> height="35" style = "padding-left:10px">
						<INPUT type='file' name='file2' size = 30>
							<? if($Picture[2]):
							$img = "../${STOCK_FOLDER_NAME}/$Picture[2]";

							if (is_file($img)){
							$Pic_size = @GetImageSize($img);
							$w = $Pic_size[0] + 20 ;
							$h = $Pic_size[1] + 20 ;

							}

							?>
              <a href="javascript:doNothing()" onClick="win1Open=displayImage('<? echo $img; ?>', 'popWin1', '<? echo $w; ?>', '<? echo $h; ?>')" onMouseOver="window.status='Click to display picture'; return true;" onMouseOut="window.status=''"><img src ='../<? echo ${STOCK_FOLDER_NAME}; ?>/<?=$Picture[2]?>' width = 30 border="0"></a>
							<img src = "./img/btn_set/btn_del.gif" onClick = "del('<? echo $Picture[2]; ?>','<? echo $uid; ?>');" style = "cursor:hand" align = "absbottom">
							 <? endif;?>
							(��������� : <? echo $LIMAGEW; ?> x <? echo $LIMAGEH; ?>)

								<? for($i=3; $i < sizeof($Picture)-1 && $Picture[$i]; $i++){
								$img = "../${STOCK_FOLDER_NAME}/$Picture[$i]";
								unset($w);
								unset($h);
								if (is_file($img)){
								$Pic_size = @GetImageSize($img);
								$w = $Pic_size[0] + 20 ;
								$h = $Pic_size[1] + 20 ;

								}

								?>
              <input type='file' name='file[<?=$i?>]' size = "30">
              <? if($Picture[$i]):?>
              <a href="javascript:doNothing()" onClick="win1Open=displayImage('<? echo $img; ?>', 'popWin1', '<? echo $w; ?>', '<? echo $h; ?>')" onMouseOver="window.status='Click to display picture'; return true;" onMouseOut="window.status=''"><img src ='../<? echo ${STOCK_FOLDER_NAME}; ?>/<?=$Picture[$i]?>' width = 30 border="0"></a>
              <img src = "./img/btn_set/btn_del.gif" onClick = "del('<? echo $Picture[$i]; ?>','<? echo $uid; ?>');" style = "cursor:hand" align = "absbottom">
              <? endif;?>
              <? }?>
              &nbsp;
              <img src = "./img/btn_set/btn_plus.gif" style="cursor:hand" onClick="javascript:addToPIC() ;return false"; align = "absmiddle">
							<div id='nameToDiv'></div>
			</TD>
          </TR>
          <TR>
            <TD WIDTH='100' ROWSPAN='2' <? echo $LEFT_STYLE; ?>>  �ɼ�1�̸�
              <INPUT maxLength='30' name='OptionNameTmp[]' size='10'  value = "<? echo $OptionName[Option1][0]; ?>">
							<INPUT type = "hidden" name='OptionPropertyTmp[]' value = "checked">

							</TD>
            <TD <? echo $CONTENT_STYLE; ?>>&nbsp; <TEXTAREA COLS='25' NAME='Option1' ROWS='10'><? echo $list["Option1"]; ?></TEXTAREA>
              <TEXTAREA COLS='25' NAME='EX' ROWS='10'>����1)
20��ġ=-50000=-50
30��ġ=+100000=+100
35��ġ=+200000=+200
--------------------
����2)
��
��
�� </TEXTAREA></TD>
          </TR>
          <TR>
            <TD <? echo $CONTENT_STYLE; ?>> <p>����ݼ����� : ����(����1)�� ���� <FONT COLOR='#FF0000'>&quot;�ɼ�=�߰�����=�߰�����Ʈ&quot;</FONT>�� �������� ���ٿ� �ϳ��� �Է�</p>
              <p>���ϰ��ݼ��� �� �ɼǸ� ������ ���(����2)���� ù�ٿ��� �ɼ��� ������, ��°�ٺ��ʹ� �ɼ��� ������ �Է�</p></TD>
          </TR>
          <TR>
            <TD WIDTH='100' ROWSPAN='2' <? echo $LEFT_STYLE; ?>>  �ɼ�2�̸�
							<INPUT maxLength='30' name='OptionNameTmp[]' size='10'  value = "<? echo $OptionName[Option2][0]; ?>">
							<INPUT type = "hidden" name='OptionPropertyTmp[]' value = "checked">

            <TD <? echo $CONTENT_STYLE; ?>>&nbsp; <TEXTAREA COLS='25' NAME='Option2' ROWS='10'><? echo $list["Option2"]; ?></TEXTAREA>
              <TEXTAREA COLS='25' NAME='EX2' ROWS='10'>
Red
Blue
Yellow </TEXTAREA></TD>
          </TR>
          <TR>
            <TD <? echo $CONTENT_STYLE; ?>> ���ϰ��ݼ��� �� �ɼǸ� ������ ���(����2)���� ù�ٿ��� �ɼ���
              ������, ��°�ٺ��ʹ� �ɼ��� ������ �Է�</TD>
          </TR>
          <TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>>  �ɼ�3�̸�

              <INPUT maxLength='30' name='OptionNameTmp[]' size='10'  value = "<? echo $OptionName[Option4][0]; ?>">
							<INPUT type = "hidden" name='OptionPropertyTmp[]'>
							</TD>
            <TD <? echo $CONTENT_STYLE; ?>> &nbsp; <INPUT maxLength='30' name='Option4' size='26'  value = "<? echo $list[Option42]; ?>"></TD>
          </TR>
          <TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>>  �ɼ�4�̸�
              <INPUT maxLength='30' name='OptionNameTmp[]' size='10'  value = "<? echo $OptionName[Option5][0]; ?>">
							<INPUT type = "hidden" name='OptionPropertyTmp[]'>

							</TD>
            <TD <? echo $CONTENT_STYLE; ?>> &nbsp; <INPUT maxLength='30' name='Option5' size='26'  value = "<? echo $list[Option5]; ?>"></TD>
          </TR>

          <TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>>  �ɼ�5�̸�
              <INPUT maxLength='30' name='OptionNameTmp[]' size='10'  value = "<? echo $OptionName[Size][0]; ?>">
							<INPUT type = "hidden" name='OptionPropertyTmp[]'>
							</TD>
            <TD <? echo $CONTENT_STYLE; ?>> &nbsp; <INPUT maxLength='30' name='Size' size='26'  value = "<? echo $list[Size]; ?>"></TD>
          </TR>
					<TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>>  �ɼ�6�̸�
              <INPUT maxLength='30' name='OptionNameTmp[]' size='10'  value = "<? echo $OptionName[Color][0]; ?>">
							<INPUT type = "hidden" name='OptionPropertyTmp[]'>
							</TD>
            <TD <? echo $CONTENT_STYLE; ?>> &nbsp; <INPUT maxLength='30' name='Color' size='26'  value = "<? echo $list[Color]; ?>"></TD>
          </TR>
          <TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>>*�ڼ��Ѽ���<BR> <INPUT TYPE=hidden NAME=TextType1 VALUE=checked >
              <!--HTML���--></TD>
            <TD <? echo $CONTENT_STYLE; ?>>&nbsp; <textarea cols='70' name='Description1' rows='15'><? echo $list[Description1]; ?></textarea>
						<script language='javascript1.2'>editor_generate('Description1');</script>
              &nbsp; <br>
              ��ǰ�� ���� ������ �ִ� ���Դϴ�.<br>
              �Ϲ� TEXT �� HTML�� ��� �� �� �ֽ��ϴ�. <br>
              <font color="#0000FF"><strong>HTML �ҽ��� �����Ƿ��� &lt;&gt; ��ũ�� ���� �ֽʽÿ�..</strong></font><br>
              <font color="#FF0000">���� �κ��� �̹����� ��ó �ϽǷ��� �ϴ��� ���� �̹����� �̹����� ��� �Ͻñ�
              �ٶ��ϴ�.</font><br>
              (HTML�� ���� ��� &quot;html���&quot;�� üũ�� ���ֽð� ���ñ� �ٶ��ϴ�. html �����ڰ� �ƴ϶��
              ��ü ���θ��� ������ �� �����Ƿ� ����� �����Ͻñ� �ٶ��ϴ�.)</TD>
          </TR>
          <TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>>���� �̹���</TD>
            <TD <? echo $CONTENT_STYLE; ?>><input type='file' name='file10' size = "30">
							<? if($DetailPicture[0]):
								$img = "../${STOCK_FOLDER_NAME}/product_detail/$DetailPicture[0]";

								 if (is_file($img)){
									$Pic_size = @GetImageSize($img);
									$w = $Pic_size[0] + 20 ;
									$h = $Pic_size[1] + 20 ;

								}

								?>
              <a href="javascript:doNothing()" onClick="win1Open=displayImage('<? echo $img; ?>', 'popWin1', '<? echo $w; ?>', '<? echo $h; ?>')" onMouseOver="window.status='Click to display picture'; return true;" onMouseOut="window.status=''"><img src ='../<? echo ${STOCK_FOLDER_NAME}; ?>/product_detail/<?=$DetailPicture[0]?>' width = 30 border="0"></a>
              <img src = "./img/btn_set/btn_del.gif" onClick = "del2('<? echo $DetailPicture[0]; ?>','<? echo $uid; ?>');" style = "cursor:hand" align = "absbottom">
			  			<? endif;?> (<? echo $PIMAGEW; ?> px ���Ϸ� ��� �ٶ��ϴ�.)
              <br>
              (<B><FONT COLOR="#FF6600">���������� �̸�</FONT></B>�� <FONT COLOR="#FF0000"><B>��������
              ǥ��</B></FONT>�Ͻñ⸦ �����մϴ�.)</TD>
          </TR>
        </table>
        <br> <center>
          <input type = "image" src = "<? echo $send_img ; ?>" align = "absmiddle"  class = "noninput">
		  <img src = "./img/btn_set/btn_list_02.gif" onClick = "javascript:location.href='<? echo $BackUrl; ?>'" style = "cursor:hand" align = "absmiddle">
        </center>
        <br> <table width=100% cellpadding="5" cellspacing="1"  border=0 align="center" <? echo $TABLE_STYLE; ?>>
          <TR>
            <TD colspan = 2 <? echo $TITLE_STYLE ; ?>>* �ɼ� �Է»���&nbsp;&nbsp;&nbsp;(�ɼ� ������ �����Ѱ�츸 ���θ� �� �������� ��Ÿ���ϴ�)</TD>
          </TR>
					<TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>> ������</TD>
            <TD <? echo $CONTENT_STYLE; ?>> &nbsp; <select name='GetComp' style = "width:150px">
							<option value = "" selected style = "background-color:red;color:white">ǥ�þ���</option>
							<?
							if(file_exists("../config/brand_list.php")) {
							    include "../config/brand_list.php";
									$origin_list = explode(",",$Origin);
									for($i = 0 ; $i < sizeof($origin_list)  && $origin_list[$i] ; $i++){
											$OriginValue[$i] = trim($origin_list[$i]);
											if($list[GetComp]==$OriginValue[$i]) $selectedCheck = " selected "; else $selectedCheck = "" ;
											echo "<option value='$OriginValue[$i]' $selectedCheck>$OriginValue[$i]</option>\n";
									}
							}
							?>
              </select></TD>
          </TR>
          <TR>
            <TD WIDTH='100' height="40" <? echo $LEFT_STYLE; ?>> �귣��</TD>
            <TD <? echo $CONTENT_STYLE; ?> height="40">&nbsp; <select name='Brand' style = "width:150px">
							<option value = "" selected style = "background-color:red;color:white">ǥ�þ���</option>
							<?
							if (file_exists("../config/brand_list.php")) {
							    include "../config/brand_list.php";
									$brand_name_list = split("\n",$brand_list);
									for($i = 0 ; $i < sizeof($brand_name_list)  && $brand_name_list[$i] ; $i++){
											$BrandValue[$i] = trim($brand_name_list[$i]);
											if($list[Brand]==$BrandValue[$i]) $selectedCheck = " selected "; else $selectedCheck = "" ;
											echo "<option value='$BrandValue[$i]' $selectedCheck>$BrandValue[$i]</option>\n";
									}
							}
							?>
              </select> &nbsp;</TD>
          </TR>
          <TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>> ����ó</TD>
            <TD <? echo $CONTENT_STYLE; ?>>&nbsp;
						<select name = "CompName">
						<option value = "" selected style = "background-color:red;color:white">������</option>
							<?
							$sql = "SELECT UID , Company  FROM ${PARTNER_TABLE_NAME}  WHERE (PType = 'S' or PType = 'M') and Service = 'Y'";// Partner ���� ������ü�� ���޾�ü
							$sresult = mysql_query($sql);
							while( $clist = mysql_fetch_array( $sresult ) ) {
									if($clist[UID] == $list[CompName]) $selectedCheck = " selected" ; else $selectedCheck = "" ;
											echo  "<option value='$clist[UID]' $selectedCheck>$clist[Company]</option>";
							}
							?>
						</select>
            </TD>
          </TR>

          <TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>> ���û�ǰ</TD>
            <TD <? echo $CONTENT_STYLE; ?>> &nbsp;
						<select name="CID" size="10" multiple style = "width:470px">
						<?
						 $CID = explode("|" , $list[CID]);
						 for ($i = 0 ; $i < sizeof($CID) && $CID[$i] ; $i++){
						 $sql = "SELECT UID , Name , Category  FROM ${MALL_TABLE_NAME} WHERE UID = '$CID[$i]' AND Status = 'Y' ";
						 $result = mysql_query($sql);
						 $clist = mysql_fetch_array($result);
						 $clist[Name] = trim(stripslashes($clist[Name]));
						 $tmpValue = "<" . getCateName($clist[Category]) . ">  " .  $clist[Name];// ī�װ� �̸��� ���� ���
						?>
						<option value="<? echo $clist[UID]?>">
						<? echo $tmpValue; ?>
						</option>
						<?
						}
						?>
                    </select>
              <img src = "./img/btn_set/btn_img01.gif" onClick="window.open('Product_Relative_Popup.php?mode=new','Product_Search_Window','width=640, height=650, scrollbars=yes')"; align = absbottom style="cursor:hand" >
							<img src = "./img/btn_set/btn_del.gif" onClick="DeleteRelative(document.WriteForm.CID)" align = absbottom style = "cursor:hand">
              <br>
              ��ǰ�󼼺��⿡�� ���û�ǰ�� ���÷����� �� ���</TD>
          </TR>
        </TABLE></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td> <table width=100% cellpadding="5" cellspacing="1"  border=0 align="center" <? echo $TABLE_STYLE; ?>>
	  	<TR>
					<TD WIDTH='100' <? echo $LEFT_STYLE; ?>> ��ǰǥ�ÿ���</TD>
					<TD <? echo $CONTENT_STYLE; ?>>&nbsp; <input name='Status' type='checkbox' value='Y' <? if(!$mode) { echo " checked" ; } else { if($list[Status] == "Y") echo " checked" ; }?>>
						��ǰǥ�� ������ ������ ������ ��忡���� ��Ÿ������ ���θ��� ǥ�� ������ �ʽ��ϴ�.
			  </TD>
          </TR>
          <TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>> ǰ��</TD>
            <TD <? echo $CONTENT_STYLE; ?>>&nbsp; <input name='None' type='checkbox' value='checked' <? echo $list[None]; ?>>
              ǰ����ǰ�� ����Ʈ�� �󼼺��⿡���� ǥ�� �ǳ� <font color="#DBB6F5">��ٱ���,</font><font color="#DBB6F5">���ø���Ʈ</font>��
              ������� �ʽ��ϴ�.</TD>
          </TR>
		      <TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>> ��Ͽɼ�</TD>
            <TD <? echo $CONTENT_STYLE; ?>> &nbsp;
              <?
								foreach($OPTION_PRODUCT_ARRAY as $key => $value){
								$chkValue = "";
								if(@ereg($key , $list[Option3])) $chkValue = " checked" ;
								echo "<input type = 'checkbox' name = 'Option3[]' id = 'Option3' value = '$key' $chkValue onClick = 'javascript:checkOptionBox();'>";

								echo $OPTION_IMAGE_ARRAY[$key] ;

							}
						 ?>
            </TD>
          </TR>
          <TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>> ����ȭ�� ǥ�� </TD>
            <TD <? echo $CONTENT_STYLE; ?>>&nbsp; <input type="checkbox" name = "MainDisplay" value="checked" <? echo $list[MainDisplay]; ?>>
              <strong><font color="#FF0000"> (��� �ɼǿ� ���ԵȰ��� ���ο� �ѷ��ݴϴ�..)</font></strong></TD>
          </TR>
          <TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>> ���Ϸ�</TD>
            <TD <? echo $CONTENT_STYLE; ?>>&nbsp; <INPUT name='Input' size='5' onkeyPress="if ((event.keyCode<48) || (event.keyCode>57)) event.returnValue=false;"style="ime-mode:disabled" value = "<? echo $list[Input]; ?>">
              ��ǰ�� ���ϵ� ��</TD>
          </TR>
					<? if($mode != "modify"){?>
          <TR>
            <TD WIDTH='100' <? echo $LEFT_STYLE; ?>> �����</TD>
            <TD <? echo $CONTENT_STYLE; ?>>
              <input type=text name=SDay size=15 class="dd1" value = "<? if($list[WDate]) echo  date("Y-m-d",$list[WDate]); else  echo date("Y-m-d");?>" readonly>
                    &nbsp;<img src = "./img/calendar.jpg" width = "16" height = "15" style = "cursor:hand" align = "absmiddle" onclick="popUpCalendar(this, SDay, 'yyyy-mm-dd');">
            </TD>
          </TR>
					<? } ?>


        </TABLE>
        <br> <DIV ALIGN="CENTER">
          <input type = "image" src = "<? echo $send_img ; ?>" align = "absmiddle"  class = "noninput"> <img src = "./img/btn_set/btn_list_02.gif" onClick = "javascript:location.href='<? echo $BackUrl; ?>'" style = "cursor:hand" align = "absmiddle">
        </DIV></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </FORM>
  <tr>
    <td height = 40 >&nbsp;</td>
  </tr>
</table>
<script>
	function checkOptionBox(){

		var f = document.WriteForm;
		if(f.Option3[0].checked){
			for(i = 1 ; i < f.Option3.length ; i++){
				f.Option3[i].checked = false;
				f.Option3[i].disabled = true;

			}
		}else{

			for(i = 1 ; i < f.Option3.length ; i++){
				f.Option3[i].disabled = false;
			}

		}
	}

	<? if(!$mode){ ?>
		document.WriteForm.Option3[0].checked = true;
		for(i = 1 ; i < document.WriteForm.Option3.length ; i++){
			document.WriteForm.Option3[i].checked = false;
			document.WriteForm.Option3[i].disabled = true;
		}
	<? } else{ ?>
		checkOptionBox();
	<? }?>
</script>
