<?
/* 
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/
header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include  "../config/db_info.php";
include  "../config/db_connect.php";
include  "../config/admin_info.php";
include  "../config/skin_info.php";
include  "../config/membercheck_info.php";
include  "../config/board_info.php";// �Խ��� ����ȯ�� ����
include  "../function/const_array.php";
include  "../function/kerrigancap_lib.php";
?>
<script src="../js/General.js"></script>
<?

$sql = "SELECT Name, Hand  , Url , Email , MPublic  FROM $MEMBER_TABLE_NAME WHERE ID = '$targetid'";
$list = _mysql_fetch_array($sql);

// ���� ��ȭ��ȣ 
// ���� Ȩ������
// ���� �����ּ�


unset($Message);
unset($goUrl);
if(!isAdmin()):
	
	if($list[MPublic] == "N"){// ���� ���� �ź�
			$Message = "���������� �Ǿ� ���� �ʽ��ϴ�.";
	} else {	
		if(!$list[Url]) $Message = "Ȩ�������� �����ϴ�.";
	}	
		
else ://������ ������ Ȩ�������� ���°��� �޼����� �����ش�.
		if(!$list[Url]) $Message = "Ȩ�������� �����ϴ�.";
endif;


switch($Act){
	case "Memo" :							
							$goUrl = "void(open_memo('../$SKIN_FOLDER_NAME','write','$targetid'))" ;
							break ;
							
	case "Homepage" :
							if(!isAdmin()):							
							
								if($list[MPublic] == "N"){// ���� ���� �ź�							
									$goUrl = "alert('���������� �Ǿ� ���� �ʽ��ϴ�.')" ; 
								} else {	
									if(!$list[Url]) $goUrl = "alert('Ȩ�������� �����ϴ�.')" ;
									else $goUrl = "goHomepage('http://$list[Url]')";
								}
								
							else ://������ ������ Ȩ�������� ���°��� �޼����� �����ش�.
								if(!$list[Url]) $goUrl = "alert('Ȩ�������� �����ϴ�.')" ;
								else $goUrl = "goHomepage('http://$list[Url]')";
							endif;							
							
							break ; 
	case "Mail" : $goUrl = "void(open_mail('../$SKIN_FOLDER_NAME','$list[Email]','$list[Name]'))" ; break ; 
	case "Sms" : $goUrl = "void(open_sms('../$SKIN_FOLDER_NAME','$list[Hand]'))" ; break ;   		
}


?>
<script>
<? echo $goUrl; ?>;	
</script>
