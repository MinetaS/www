<?
include "./ROOT_CHECK.php";

$step = $_GET['step'];
$form = $_GET['form'];
$flag = $_GET['flag'];
$trigger = $_GET['trigger'];
$big_code = substr($trigger,-2);
$mid_code = substr($trigger,2,4);
if($step == "1"){
	$sqlstr = "select cat_no, cat_name from ${CATEGORY_TABLE_NAME} where cat_flag = '$flag' and cat_no >= 100 and cat_no < 10000 and cat_no like '%$big_code'  order by cat_no asc";
	$str = "�ߺз�";
	$target = "Category2";
	
}elseif($step == "2"){
	$sqlstr = "select cat_no, cat_name from ${CATEGORY_TABLE_NAME} where cat_flag = '$flag' and cat_no >= 10000 and cat_no < 1000000 and cat_no like '%$mid_code' order by cat_no asc";
	$str = "�Һз�";
	$target = "Category3";
}
//echo "sqlstr = $sqlstr <br>";
$sqlqry = mysql_query($sqlstr);
$length = mysql_num_rows($sqlqry)+1;

header("Content-Type: application/x-javascript");
echo "document.forms['$form'].elements['$target'].length = $length; \n";
echo "document.forms['$form'].elements['$target'].options[0].text = '$str'; \n";
echo "document.forms['$form'].elements['$target'].options[0].selected = true; \n";
$i=1;	
while($list = mysql_fetch_array($sqlqry)):
	echo "document.forms['$form'].elements['$target'].options[$i].text = '$list[cat_name]'; \n";
	echo "document.forms['$form'].elements['$target'].options[$i].value = '$list[cat_no]'; \n";
$i++;
endwhile;

function resetField($form, $claretarget, $targetstr){
	echo "document.forms['$form'].elements['$claretarget'].length = 1; \n";
	echo "document.forms['$form'].elements['$claretarget'].options[0].text = '$targetstr'; \n";
	echo "document.forms['$form'].elements['$claretarget'].options[0].selected = true; \n";
}


if($step == "1"){	// �Һз� ����
	if(!$trigger){ // ��з��� ���� ���� ���� �ߺз��� ����
		resetField($form, $claretarget="Category2", $targetstr="�ߺз�");
	}
	resetField($form, $claretarget="Category3", $targetstr="�Һз�");	
}


?>

