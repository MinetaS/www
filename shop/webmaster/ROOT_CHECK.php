<?

if(!ereg("System_Basic_Proc.php",$_SERVER['PHP_SELF'])){
	include_once "../config/admin_info.php";
}// System_Basic_Proc.php ���Ͽ����� �ҷ� ���� �ʴ´�

include_once "../config/db_info.php";
include_once "../config/db_connect.php";
include_once "../function/const_array.php";
include_once "../function/kerrigancap_lib.php";


if(file_exists("../config/admin_skin_info.php") && $THEME != "System_Board" ){// �Խ��� ȯ�漳���� �ҷ� ���� �ʴ´�.
	include_once "../config/admin_skin_info.php";// ������ ��Ų
}


if ( !$_COOKIE[ADMIN_CHECK_GRADE] && !isMember() ){// �⺻������  ADMIN_CHECK_GRADE üũ �� ȸ�� ���̵� üũ 
setcookie("ROOT_PASS", "0", 0, "/");
setcookie("ADMIN_CHECK_GRADE", "0", 0, "/");
setcookie("ROOT_COLOR_TYPE", "0", 0, "/");
setcookie("MEMBER_NAME", "", 0, "/");
setcookie("MEMBER_ID", "", 0, "/");
setcookie("MEMBER_EMAIL", "", 0, "/");
setcookie("MEMBER_URL", "", 0, "/");
setcookie("MEMBER_GRADE", "", 0, "/");
setcookie("MEMBER_NICKNAME", "", 0, "/");

if (file_exists("../${MEMBER_TEMP_FOLDER_NAME}/login_user/$_COOKIE[MEMBER_ID].cgi")){
	unlink("../${MEMBER_TEMP_FOLDER_NAME}/login_user/$_COOKIE[MEMBER_ID].cgi");
}		 
		js_location("./default.php");
		exit;     
}


$AUTH_READ_FLAG = false;//�б� 
$AUTH_WRITE_FLAG = false;//���� 
$AUTH_DELETE_FLAG = false;//���� 


if(!isAdmin() && $THEME != "Front"){// �ְ� �����ڰ� �ƴϸ� ���Ѻ��� ������ �������� ���� �Ѵ�..Front �������� �⺻������ �����ش�.
		
		
		$AUTH_CODE_FLIP = array_flip ($ADMIN_MENU_CODE_ARRAY);//�迭�� key ���� value ���� �ٲ۴�.		
		$AUTH_CODE = $AUTH_CODE_FLIP["$THEME"];
		$auth_sql = "select AuthService from {$PERMISSION_TABLE_NAME} where ID = '$_COOKIE[MEMBER_ID]' and Code = '$AUTH_CODE'" ; 
		$auth_list = _mysql_fetch_array($auth_sql);
		
		if(ereg("r" , $auth_list[AuthService])) $AUTH_READ_FLAG = true;
		if(ereg("w" , $auth_list[AuthService])) $AUTH_WRITE_FLAG = true;
		if(ereg("d" , $auth_list[AuthService])) $AUTH_DELETE_FLAG = true;		
		
		// ������ ������� default.php�� ���� �Ѵ�..
		if(!$AUTH_READ_FLAG) js_alert_location("{$_COOKIE[MEMBER_ID]}���� �ش� ������ �����ϴ�(����)","./default.php");
		
		//if(!$AUTH_WRITE_FLAG) js_alert_location("{$_COOKIE[MEMBER_ID]}���� ���� ������ �����ϴ�","-1");
		//if(!$AUTH_DELETE_FLAG) js_alert_location("{$_COOKIE[MEMBER_ID]}���� ���� ������ �����ϴ�","-1");
		
}

$PGSKIN = "default";// ������ ������ ��Ų
?>