<?

if(!$SetupPath) $SetupPath = ".";
$WDate = time();

if(!$GID) $GID = "root";
if(!$Grp) $Grp = "1";

if(!is_dir("${SetupPath}/table/$GID")){ 
	$result = mkdir("${SetupPath}/table/$GID", 0777);
	if(!$result){
		js_alert_location("Table ���丮 �۹̼��� üũ �ϼ���","-1");
	}
}

if($NewTableName && !is_dir("${SetupPath}/table/$GID/$NewTableName")){
	$result = mkdir("${SetupPath}/table/$GID/${NewTableName}", 0777);
	if(!$result) js_alert_location("$GID ���丮�� �۹̼��� üũ�ϼ���","-1");
			
	/* �̹��� ���� ���丮�� �����Ѵ�. */
	mkdir("${SetupPath}/table/${GID}/${NewTableName}/updir", 0777);
	/* ���� ������ �����Ѵ�. */
		
		copy("${SetupPath}/mall_default/basic_config.php","${SetupPath}/table/${GID}/$NewTableName/basic_config.php");
		copy("${SetupPath}/mall_default/detail_config.php","${SetupPath}/table/${GID}/$NewTableName/detail_config.php");		
		copy("${SetupPath}/mall_default/top.php","${SetupPath}/table/${GID}/$NewTableName/top.php");
		copy("${SetupPath}/mall_default/bottom.php","${SetupPath}/table/${GID}/$NewTableName/bottom.php");
		
}//if($NewTableName && !is_dir("${SetupPath}/table/$GID/$NewTableName")){
/* step2 -- Main ���̺� ���̺� ������ �Է��մϴ�. */
    
	$cur_ranking = getSingleValue("select max(Ranking) from ${BOARD_MAIN_TABLE_NAME}");
	$next_ranking = $cur_ranking + 1 ; 
	
	//  ���� ���̺��� ������ ���� �Ѵٸ� ���������� ���� �ʴ´�.
	$TableExitCnt = getSingleValue("SELECT COUNT(*) FROM ${BOARD_MAIN_TABLE_NAME} WHERE BID = '$NewTableName' AND GID = '$GID'"); 
	
	if($TableExitCnt ==  0 ) :
		$SQL_QRY = "INSERT INTO ${BOARD_MAIN_TABLE_NAME} (BID, GID, BoardDes, AdminName, Pass, Ranking ,  Grp, WDate , SiteKey)
		VALUES ('$NewTableName', '$GID', '$TABLE_DES', '$AdminName', '$Pass', '$next_ranking' , '$Grp', '$WDate' , '$SiteKey' )";
		$RESULT_CREATE_NEWTABLE = mysql_query($SQL_QRY, $DB_CONNECT) OR die(mysql_error());
	endif;


/* step3 -- ���ο� ���̺��� �����մϴ�. */
	if($RESULT_CREATE_NEWTABLE):
/* �������̺� ����*/	
	$QUERY = "CREATE TABLE IF NOT EXISTS ${DEFAULT_TABLE_NAME}_${GID}_${NewTableName} (
	UID int(6) NOT NULL auto_increment,
	BID varchar(20) NOT NULL default '',
	ID varchar(20) NOT NULL default '',
	NAME varchar(50) NOT NULL default '',
	PASSWD varchar(20) NOT NULL default '',
	EMAIL varchar(30) NOT NULL default '',
	URL varchar(250) NOT NULL default '',
	SUBJECT varchar(100) NOT NULL default '',
	SUB_TITLE1 varchar(100) NOT NULL default '',
	SUB_TITLE2 varchar(100) NOT NULL default '',
	CONTENTS text NOT NULL,
	SUB_CONTENTS1 text NOT NULL,
	SUB_CONTENTS2 text NOT NULL,	
	THREAD varchar(10) NOT NULL default '',
	FID int(10) NOT NULL default '0',
	COUNT int(5) NOT NULL default '0',
	RECCOUNT int(5) NOT NULL default '0',
	DOWNCOUNT int(5) NOT NULL default '0',
	UPDIR1 varchar(250) NOT NULL default '',
	UPDIR2 varchar(250) NOT NULL default '',
	IP varchar(15)  NOT NULL default '',
	SPARE1 varchar(30) NOT NULL default '',	
	W_DATE int(10) NOT NULL default '0',
	MDATE varchar(15) NOT NULL default '0',
	SiteKey varchar(100) default NULL,
	PRIMARY KEY  (UID))";
	mysql_query($QUERY, $DB_CONNECT) OR die(mysql_error());
	
/*���ö��� ���̺� ���� */
	if($CommentEnable == "checked"){	
	$QUERY = "CREATE TABLE IF NOT EXISTS ${DEFAULT_TABLE_NAME}_${GID}_${NewTableName}_comment (
	UID int(6) NOT NULL auto_increment,
	MID int(11) NOT NULL default '0',
	ID varchar(20) NOT NULL default '',
	NAME varchar(50) NOT NULL default '',
	PASSWD varchar(20) NOT NULL default '',	
	SUBJECT varchar(100) NOT NULL default '',
	THREAD varchar(10) NOT NULL default '',
	FID int(10) NOT NULL default '0',
	CONTENTS text NOT NULL,
	IP varchar(15) NOT NULL default '',	
	W_DATE int(10) NOT NULL default '0',		
	SiteKey varchar(100) default NULL,
	PRIMARY KEY  (UID))";
	mysql_query($QUERY, $DB_CONNECT) OR die(mysql_error());
	}
	endif;
	?>