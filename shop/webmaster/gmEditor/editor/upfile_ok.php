<?
##-------------------------------------------------------------------##
##  ���α׷��� : gmEditor v1.0
##-------------------------------------------------------------------##
##  ���� ���� �Ϸ��� : 2006-01-05
##  ���߻� �� ���۱��� : PHP����
##  ������Ʈ : http://www.phpmonster.co.kr
##  �� �� �� : �ڿ��� (misnam@gmail.com)
##-------------------------------------------------------------------##
##                           ī�Ƕ���Ʈ
##-------------------------------------------------------------------##
##  �� ���α׷��� ���� ���α׷����� �����˴ϴ�.
##  gmEditor�� GNU General Public License(GPL) �� �����ϴ�.
##  ���� �ڼ��� ������ LICENSE�� �����Ͻʽÿ�.
##  ����: http://korea.gnu.org/people/chsong/copyleft/gpl.ko.html
##-------------------------------------------------------------------##
##                           ����ȯ��
##-------------------------------------------------------------------##
##  ���� OS : IE 5 �̻�
##  ����ȯ�� : Win XP
##  IE ���� ȯ�濡���� �ùٷ� �۵����� ���� �� �ֽ��ϴ�.
##-------------------------------------------------------------------##


// �̹����� ����Ǵ� ���
$dir = "./uploaded";

// �̵������ üũȮ����
$old = array(
	"mid",
	"rmi",
	"midi",
	"asx",
	"wax",
	"wax",
	"m3u",
	"mvx",
	"mov",
	"qt",
	"asf",
	"wm",
	"wma",
	"wmv",
	"mpeg",
	"mpg",
	"m1v",
	"mp2",
	"mp3",
	"avi",
	"wmv",
	"wav",
	"snd",
	"au",
	"aif",
	"aifc",
	"aiff",
	"rm",
	"ra",
	"ram",
	"swf"
);


/*
*************************   �޼����� ������ �ڷ� �̵�   *************************
*/
function goBack($message){
	echo"
		<script language='javascript'>
		window.alert('".$message."');
		history.go(-1);
		</script>
	";
	exit;
} // end func


/*
*************************   ���� ȣ��Ʈ���� �Ѿ�Դ��� üũ   *************************
*/
function referer(){

	$referer = explode('/',preg_replace("/http:\/\//",'',$_SERVER[HTTP_REFERER]));

	if ($referer[0] <> $_SERVER[HTTP_HOST]) {

		echo"
			<script language='javascript'>
				window.alert('Not a possibility of searching the Root');
				history.go(-1);
			</script>
		";
		exit;
	}

} // end func


referer();



if($_SERVER['REQUEST_METHOD'] <> 'POST') {

	goBack('�������� ������� �����Ͻʽÿ�.');
}



// ���ε� ���丮�� �ִ��� üũ 
if (!@is_dir($dir)) {
	goBack('���ε� ������ �������� �ʽ��ϴ�.');
}

// ���ε� ������ �۹̼� 707���� üũ
if(substr(decoct(fileperms($dir)),2) <> 707){
	goBack("���ε� ������ �۹̼� 707�� ������ �ּ���.");
}



/***************************************************************************************
*************************   ���� ����
****************************************************************************************/

if(is_uploaded_file($_FILES['upfile']['tmp_name']) && ($_FILES['upfile']['size'] > 0)) {

	$upfile = time();

	// �̹����̸�..
	if($_POST['type']==1){
		$tmp_file = @getimagesize($_FILES['upfile']['tmp_name'],&$type);
		$upfile .= '.img.gm';

		// (1) = gif, (2) = jpg, (3) = png, (4) = swf, (5) = psd, (6) = bmp
		if(($tmp_file[2] != 1) && ($tmp_file[2] != 2) && ($tmp_file[2] != 6)) {
			goBack('GIF,JPG,BMP Ȯ���ڰ� ���ε� �����մϴ�.');
		}
	}
	// �̵���̸�..
	else{
		$ext = substr($_FILES['upfile']['name'],strrpos(stripslashes($_FILES['upfile']['name']),'.')+1);
		$media_chk = '';
		foreach($old as $key => $value){
			if($value == $ext){
				$media_chk = 1;
				break;
			}
		}
		$upfile .= '.midi.'.$ext;

		if($media_chk <> 1) goBack('�̵�����ϸ� ���ε��� �ּ���.');
	} // end if


	if(!@move_uploaded_file($_FILES['upfile']['tmp_name'],$dir.'/'.$upfile)) {
		@unlink($dir.'/'.$upfile);
		goBack('������ �����ϴµ� �����Ͽ����ϴ�.');
	}
	@chmod($dir.'/'.$upfile,0606);
} // end if




/***************************************************************************************
*************************   ������ �����Ϳ� ����
****************************************************************************************/
if(is_file($dir.'/'.$upfile)){

	$imgsize = (int)$_POST['imgsize'];
	$title = addslashes($_POST['title']);
	$alignment = $_POST['alignment'];
	$upfile_ok = $dir.'/'.addslashes($upfile);
	$file_path = $_POST['url'].'/'.$upfile_ok;

	ECHO "<script language='javascript'>\n";
	ECHO "<!--\n";
	ECHO "	var val,os;\n";
	ECHO "	var ostmp = navigator.appName.charAt(0);\n";
	ECHO "	if(ostmp=='M') os = '';\n";
	ECHO "	else if(ostmp=='N') os = 1;\n";
	ECHO "	else os = 2;\n";

	if($_POST['type']==1){
		ECHO "	val = '";

		// �̹��� ���� 2-1
		if(!empty($alignment) && ($alignment=='center')) ECHO "<div align=\"".$alignment."\">";

		ECHO "<img src=\"".$file_path."\" ";

		// �̹��� ũ��
		if(!empty($imgsize)) ECHO " width=\"".$imgsize."\"";

		ECHO ">";

		// �̹��� ����2-2
		if(!empty($alignment) && ($alignment=='center')) ECHO "</div>";

		ECHO "';\n";
	}
	else{
		$size = $imgsize ? $imgsize : '300';
		ECHO "	val = '";

		// �̵�� ���� 2-1
		if(!empty($alignment)) ECHO "<div align=\"".$alignment."\">";

		ECHO "<embed src=\"".$file_path."\" ";
		ECHO " width=\"".$size."\" height=\"".$size."\"";
		ECHO " autostart=\"true\" loop=\"true\">";

		// �̵�� ���� 2-2
		if(!empty($alignment)) ECHO "</div>";

		ECHO "';\n";
	}

	ECHO "if(os < 2) window.opener.HTMLPaste(val);\n";
	ECHO "self.close();\n";
	ECHO "//-->\n";
	ECHO "</script>\n";
}
else{

	ECHO "<script language='javascript'>\n";
	ECHO "<!--\n";
	ECHO "	window.close();\n";
	ECHO "//-->\n";
	ECHO "</script>\n";
}
?>
