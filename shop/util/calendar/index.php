<? 
include_once "../../config/db_info.php";
include_once "../../config/db_connect.php";
include_once "../../config/admin_info.php";
include_once "../../config/skin_info.php";
include_once "../../function/const_array.php";
include_once "../../function/kerrigancap_lib.php";
if(!$CalandarSkin) $CalandarSkin = "default";
// �˾��ϰ��� ../../
// ���ο��� �����ϴ°��� ./
include "./$CalandarSkin/index.php";
?>