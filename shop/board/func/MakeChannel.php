<?
//�μ� function(ä�θ�)
function MakeChannel($channel){

	global ${BOARD_FOLDER_NAME};

$today = time();
$todayzero = mktime(0,0,0,date("m"),date("d"),date("Y"));
//	mkdir("${SetupPath}/table/${NewTableName}/updir", 0777);
/* channel ������ ���� ��� channel ���� ���� */
	if(!file_exists("./${BOARD_FOLDER_NAME}/channel")) mkdir("./${BOARD_FOLDER_NAME}/channel", 0707);
	
/* ���� �۾� channel�� ���� ��� */
	if(!file_exists("./${BOARD_FOLDER_NAME}/channel/$channel")) mkdir("./${BOARD_FOLDER_NAME}/channel/$channel", 0707);
	
/* totalcount.php �� ���� ��� totalcount.php�� �ʱ�ȭ�Ͽ� ����� ���� ���� ��Ż ī��Ʈ�� 1�� �ø���. */
	$filepath1 = "./${BOARD_FOLDER_NAME}/channel/$channel/totalcount.php";
	if(!file_exists("$filepath1")){ 
	$fp = fopen($filepath1, "w");
	fwrite($fp,"1|$todayzero");
	fclose($fp);
	}else{
	$fileLines = file($filepath1);
	$fileArr = explode("|", $fileLines[0]);
	$NewTotalCount = $fileArr[0] + 1;
	$fp = fopen($filepath1, "w");
	fwrite($fp,"${NewTotalCount}|$fileArr[1]");
	fclose($fp);
	}

/*  ���� daily.txt ȭ�� ���� �� ���� ��*/
/* totalcount.php �� ���� ��� totalcount.php�� �ʱ�ȭ�Ͽ� ����� ���� ���� ��Ż ī��Ʈ�� 1�� �ø���. */
	$filepath2 = "./${BOARD_FOLDER_NAME}/channel/$channel/$todayzero.php";
	if(!file_exists("$filepath2")){ 
	$fp = fopen($filepath2, "w");
	fwrite($fp,"$today\n");
	fclose($fp);
	}else{
	$fp = fopen($filepath2, "a");
	fwrite($fp,"$today\n");
	fclose($fp);
	}
	$todaycount = sizeof(file($filepath2));
	
		
/* ���� ī��Ʈ�� ���Ͽ� max ī��Ʈ �߻��� maxcount.php�� ������Ʈ �Ѵ�. */
	$filepath3 = "./${BOARD_FOLDER_NAME}/channel/$channel/maxcount.php";
	if(!file_exists("$filepath3")){ 
	$fp = fopen($filepath3, "w");
	fwrite($fp,"1|$today");
	fclose($fp);
	}
	/* ���� max ī��Ʈ �ҷ����� */
	$fileLines = file($filepath3);
	$fileArr = explode("|", $fileLines[0]);
		
	if($todaycount >= $fileArr[0]){
	$fp = fopen($filepath3, "w");
	$NewTotalCount = 
	fwrite($fp,"${todaycount}|$today");
	fclose($fp);
	}

}

?>