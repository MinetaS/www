<?
/*
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/
include_once "../config/db_info.php" ;
include_once "../config/db_connect.php" ;
include_once "../function/const_array.php" ;
include_once "../function/kerrigancap_lib.php" ;

// show / hide �� �迭�� ó��
for ($MIndex = 0 ; $MIndex <=11 ; $MIndex++){
	if(substr($menushow , 4) == $MIndex) $MenuShowFlag[$MIndex] = "" ;
	else $MenuShowFlag[$MIndex] = "none";
}

$marginleft="0px";
$margintop="0px";
$marginwidth="198";
$marginheight="0px";
?>
<div id="menu0" style="display:<? echo $MenuShowFlag[0];?>">
<?
if($THEME == "Front"):
/*
�޷¿� ���
Ư������ �ϼ��� ���ϴ� �Լ� */
function TotalDaysOfTheMonth($year,$month) {
global $TheDays;
	$TheDays = 1;
	while(checkdate($month,$TheDays,$year)) {
		$TheDays++;
	}
	return $TheDays;
}


/* Ư�� �� ���� ���ϴ� �Լ� */
if(!strcmp($mode,"minus")){

$Month--;
}
elseif(!strcmp($mode,"plus")){
$Month++;
}
elseif(!strcmp($mode,"minusyear")){
$Month=$Month-12;
}
elseif(!strcmp($mode,"plusyear")){
$Month=$Month+12;
}
else unset($Month);

$first_day = date('w', mktime(0,0,0,date("m")+$Month,1,date("Y")));

$TheMonth = date('m', mktime(0,0,0,date("m")+$Month,1,date("Y")));

$TheYear = date('Y', mktime(0,0,0,date("m")+$Month,1,date("Y")));

TotalDaysOfTheMonth($TheYear, $TheMonth);

endif;

?>
  <table width="198" height="100%"  border="0" cellpadding="0" cellspacing="0" >
    <tr>
      <td height="51" align="center" ><table width="180" border="0" cellspacing="0" cellpadding="0">

        </table></td>
    </tr>
    <tr>
      <td align="center" valign="top">
			<!-- �޷� -->
<table width=170 cellpadding="10" cellspacing="1"  border=0 align="center" >
        <tr>


		</tr>
        <tr>
          <td height="10" colspan="7" bgcolor="#FFFFFF"></td>
        </tr>
        <tr>
          <td bgcolor="#FFFFFF">
            <!-- ��¥ ���̺� ���� -->

            <!-- ��¥ ���̺� �� -->
          </td>
        </tr>
      </table>
<!-- �޷� -->
        </td>
    </tr>
  </table>
</div>
