<?

if ( ! $bFunc[FncDB] ):

$bFunc[FncDB] = true;

// ���� ���� �μ� ��: DB ����, Host, User, Password
function FncOpenDatabase ()
{
	$cfgSQLDataBase  =''; //����Ÿ���̽���
	$cfgSQLDataSource=''; //��� ���� localhost�� ����
	$cfgSQLUsername  =''; //�����ͺ��̽� �α��� ���̵�
	$cfgSQLPasswd    =''; //�����ͺ��̽� �α��� �佺����

	$nConnID = @MySQL_connect( $cfgSQLDataSource, $cfgSQLUsername, $cfgSQLPasswd);

	if($nConnID == 0)
	{	TraceLog ("MySQL", "connect", "[ERROR] Connection to SQL-Server failed.\n".mysql_error() );
		exit;
	}

	$bCheck = @mysql_select_db($cfgSQLDataBase, $nConnID);

	if($bCheck == 0)
	{	TraceLog ("MySQL", "select_db", "[ERROR] Connection to database failed.\n".mysql_error() );
		exit;
	}

	return $nConnID;
};

/*
**
**	���� ������ �����Ѵ�.
**
*/
function FncQuery ( $svSQL )
{
	$connectionID = FncOpenDatabase ();
	$result = @mysql_query( $svSQL,$connectionID );

	if ($result)
	{	return $result;
	}
	else
	{	return false;
	}
};

/*
**
**	���� ������ �����ϰ�, ����� �����Ѵ�.
**
*/
function FncResultQuery ( $svSQL )
{
	$connectionID = FncOpenDatabase ();
	$result = @mysql_query( $svSQL,$connectionID );
	$saResult = @mysql_fetch_array($result);

	if ($saResult)
	{	return $saResult;
	}
	else
	{	return false;
	}
};

/*
**
**	���� ������ �����Ѵ�.
**
*/
function FncExecQuery ( $svSQL )
{
	$connectionID = FncOpenDatabase ();
	$result = @mysql_query( $svSQL,$connectionID );

	if ($result)
	{	return true;
	}
	else
	{	return false;
	}
};

endif;

?>
