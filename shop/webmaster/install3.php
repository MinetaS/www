<?
/* 
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/
include "../function/const_array.php";
include "../function/kerrigancap_lib.php";


$DB_CONNECT = mysql_connect(trim($db_host), trim($db_user), trim($db_password));
$result = mysql_select_db($USER_DB, $DB_CONNECT);
if ( !$DB_CONNECT || !$result ) js_alert_location("\\n\\nMYSQL ���� �Է������� ��ġ���� �ʾ�, ���α׷��� ��ġ�� �� �����ϴ�.\\n\\n�Է������� �ٽ��ѹ� Ȯ���� �ֽʽÿ�.\\n\\n","-1");


$fp = fopen("../config/db_connect.php", "w");
fwrite($fp,"<?	
	\$DB_CONNECT = mysql_connect(\$MYSQL_HOST, \$MYSQL_ID, \$MYSQL_PASSWORD);
	mysql_select_db(\$MYSQL_DB, \$DB_CONNECT);
	if ( !\$DB_CONNECT ) {echo \"mysql ������ ���̽��� ������ �� �����ϴ�.\"; exit;}
?>");
fclose($fp);

$fp = fopen("../config/db_info.php", "w");
fwrite($fp,"<?
\$MYSQL_HOST = \"$db_host\";
\$MYSQL_DB = \"$USER_DB\";
\$MYSQL_ID = \"$db_user\";
\$MYSQL_PASSWORD = \"$db_password\";
?>");
fclose($fp);


?>
<HTML><HEAD>
<SCRIPT language=javascript>
        window.alert('\n\n<? echo $admin ; ?>�� Data Base �� ���丮 ��ġ�� �Ϸ�Ǿ����ϴ�.\n\n�� ���������� �������� �̵��մϴ�.. \n\n');
        window.top.location.replace('./install4.php?PASS=<?=$PASS?>&admin=<? echo $admin;?>&query=setcookie');
</SCRIPT>