<html>
<head>
<title>Calendar ver.1.1</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<style type="text/css">
<!--
a:link {  font-family: "����", "����ü"; font-size: 9pt; color: 5D5D5D; text-decoration: none}
a:visited {  font-family: "����", "����ü"; font-size: 9pt; color: #666666; text-decoration: none}
a:active {  font-family: "����", "����ü"; font-size: 9pt; color: #E50101; text-decoration: underline}
a:hover {  font-family: "����", "����ü"; font-size: 9pt; color: E50101; text-decoration: underline}
.txt {  font-family: "����", "����ü"; font-size: 9pt; color: #333333; line-height: 15pt}
BODY, TEXTAREA,TABLE, TR, TD, INPUT{font-size:12px; font-family:����;}
a:link,a:visited,a:hover {color: #ffffff; text-decoration: none}
a.com:link,a.com:visited {color: #000000; text-decoration: none}
a.pro:hover {  color: #869603; text-decoration: underline}
a.inq:hover {  color: #489CE7; text-decoration: underline}
a.bro:hover {  color: #21B686; text-decoration: underline}
a.site:hover {  color: #CC3333; text-decoration: underline}
-->
</style>
<style type="text/css">
<!--
a.com:hover { color: #000000} -->
</style>
</head>
<body>

<?

/* Ư������ �ϼ��� ���ϴ� �Լ� */

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
elseif(!strcmp($mode,"view")){

}
elseif(!strcmp($mode,"write")){

}
else unset($Month);

$first_day = date('w', mktime(0,0,0,date("m")+$Month,1,date("Y")));

$TheMonth = date('m', mktime(0,0,0,date("m")+$Month,1,date("Y")));

$TheYear = date('Y', mktime(0,0,0,date("m")+$Month,1,date("Y")));

TotalDaysOfTheMonth($TheYear, $TheMonth);

?>
     
<table border="0" cellpadding="0" cellspacing=0 bordercolorlight=#CEE1FF  bordercolordark=#E1FFFD  align="center" width="344">
  <tr> 
          <td height="25" colspan=7 align="center" bgcolor="#CC3333"><font color="#FFFFFF"><a href="javascript:void(location.replace('<?=$PHP_SELF?>?mode=minusyear&Month=<?=$Month?>'))">����</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(location.replace('<?=$PHP_SELF?>?mode=minus&Month=<?=$Month?>'))">��</a>&nbsp; 
            <?=date('Y', mktime(0,0,0,date("m")+$Month,date("d"),date("Y")));?>
            �� 
            <?=date('m', mktime(0,0,0,date("m")+$Month,date("d"),date("Y")));?>
            �� 
            <?=date('M', mktime(0,0,0,date("m")+$Month,date("d"),date("Y")));?>
            &nbsp; <a href="javascript:void(location.replace('<?=$PHP_SELF?>?mode=plus&Month=<?=$Month?>'))">��</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(location.replace('<?=$PHP_SELF?>?mode=plusyear&Month=<?=$Month?>'))">����</a></font></td>
        </tr>
        <tr bgcolor=#FFFFFF> 
          <td height="26" colspan="7" align="center">&nbsp;</td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td height="25" colspan="7" align="right"><a href="javascript:void(location.replace('<?=$PHP_SELF?>'))" class="com">Go 
            Today</a></td>
        </tr><tr><td>
<!-- ��¥ ���̺� ���� -->				
        <table border="0" cellpadding="0" cellspacing=1 bordercolorlight=#CEE1FF  bordercolordark=#E1FFFD  align="center"  bgcolor=#CCCCCC width="100%"><tr> 
          <td width="48" height="25" align="center" bgcolor="#F2F2F2"><font color="#FF0000">Sun</font></td>
          <td width="48" align="center" bgcolor="#F2F2F2">Mon</td>
          <td width="48" align="center" bgcolor="#F2F2F2">Tue</td>
          <td width="48" align="center" bgcolor="#F2F2F2">Wed</td>
          <td width="48" align="center" bgcolor="#F2F2F2">Thu</td>
          <td width="48" align="center" bgcolor="#F2F2F2">Fri</td>
          <td width="48" align="center" bgcolor="#F2F2F2">Sat</td>
        </tr>
        <tr> 
          <?		  

/* ���ϰ� ��¥�� ��ġ���������� ����ä��� */

unset($count);	
for($i = 0; $i < $first_day; $i++) {
echo " <td bgcolor=#FFFFFF>&nbsp;</td>";
$count++;
}

for($j = 1; $j < $TheDays; $j++) {
?>
<form><td height="40" valign="top" bgcolor=#FFFFFF style=padding-top:2pt;padding-left:2pt;>
<a href="javascript:void(location.replace('<?=$PHP_SELF?>?mode=view&Month=<?=$Month?>'))">
<?
/* $ThedayThetime�� ī������ ��� �ð����� ���н� �ð����� �����Ѵ�. */
$ThedayThetime = mktime(date("H"),date("i"),date("s"),date("$TheMonth"),date("$j"),date("$TheYear"));
 if ( date("Ymd") == $TheYear.$TheMonth.$j ) {  // ���� ��¥�� ������ ff0000������ ǥ�� 

  echo "<font style='color:#0000FF; text-decoration:none;'><b>$j</b><font>"; 

}elseif(!($count%7)){
echo "<font style='color:#FF0000; text-decoration:none;'>$j<font>"; 
}else { echo "<font style='color:#000000; text-decoration:none;'>$j<font>"; } 
?></a>
<input type="hidden" name="ThedayThetime" value="<?=$ThedayThetime?>">
</td></form>
<?
$count++; //������ ����Ͽ� 7�� �Ǹ� tr������



		if($count == 7) {

			echo " </tr> ";

			if($j != $totaldays) { echo "<tr>"; }

			unset($count);

		}

	}



// �޷µڿ� �ڸ��� ������ �������� ä���ֱ�	

	while($count > 0 && $count < 7) {

		echo "<td bgcolor=#ffffff>&nbsp;</td>";

		$count++;

	}



?>

        </tr></table>
<!-- ��¥ ���̺� �� -->
</td></tr></table>

</body>

</html>