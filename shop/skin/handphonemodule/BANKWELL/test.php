<?
//  #####################################################################

//                                                                       

//    ������ TEST ȭ��                                                   

//                                                                       

//  #####################################################################

//                                                                       

//  [ PG�� ����ó�� TESTȭ�� ]                                           

//                                                                       

//   1. OrderNo       : �ֹ���ȣ(�ش糯¥������ ������ ��ȣ)             

//   2. Amount        : �ŷ��ݾ�                                         

//   3. OrderName     : �ֹ��� ����                                      

//   4. OrderTelNo    : �ֹ��� ��ȭ��ȣ                                  

//   5. BrandName     : ��ǰ��                                           

//   6. OrderAddr     : ����� �ּ�                                      

//   7. UserID        : User ID                                          

//   8. Reserved1     : �ӽ� �ʵ�1                                       

//   9. Reserved2     : �ӽ� �ʵ�2                                       

//   10. Email        : �ֹ��� Email                                     

//   11. RecognPage   : ���������� �Ѱ��� ������ ����                    

//   12. ErrorPage    : �������н� �Ѱ��� ������ ����                    

//                                                                       

//           *  ����                                                     

//           1. �ֹ���ȣ�� �ֹ��ݾ��� �ʼ��Է»����̴�.                  

//           2. ������ȭ : 1566-0430									 

//                                                                       

//  #####################################################################

	include "php_function.php";	
	//�Ʒ��� �ֹ���ȣ�� �����ϴ°���, ����ũ�� ���̸� ����̵� �������.
	$g_OrderDate = f_Now_Date();
	$g_OrderTime = f_NOW_Time();	
	$orderNum = $g_OrderDate . "-" . $g_OrderTime . rand(10,99);
?>
<html>
<head>
	<style type="text/css">
		.menuTitle{ width:300px; height:30px; border:1px solid #808080; cursor:hand;}		  
		.blk { display:inline-block; background-color:#ffffff;	padding:0px;}		  
		.non { display:none; position:relative; top:-19px; left:0px;}
	</style>
	<script language="javascript">
		function sametop(){
			frm = document.payfrm;
			if (frm.same.checked){
				frm.deliverName.value  = frm.OrderName.value;
				frm.deliverTelNo.value = frm.OrderTelNo.value;
				frm.d_zip1.value       = frm.zip1.value;
				frm.d_zip2.value	   = frm.zip2.value;
				frm.d_addr1.value      = frm.addr1.value;
				frm.d_addr2.value      = frm.addr2.value;
			}else{
				frm.deliverName.value  = "";
				frm.deliverTelNo.value = "";
				frm.d_zip1.value       = "";
				frm.d_zip2.value	   = "";
				frm.d_addr1.value      = "";
				frm.d_addr2.value      = "";	
			}
		}
	
		function CheckIt(){
			frm = document.payfrm;
			if (!frm.msgtype[0].checked && !frm.msgtype[1].checked && !frm.msgtype[2].checked){
				alert("���������� �����ϼž� �մϴ� !!!");
				return;
			}
			// �Ʒ��� ����� �ּҸ� ó���ϴ� �����Դϴ�.
			frm.OrderAddr.value = frm.d_addr1.value + " " + frm.d_addr2.value;
			if (!frm.BrandName.value)   {alert("��ǰ���� �Է��ϼ���!"); frm.BrandName.focus(); return;}
			if (!frm.Amount.value)      {alert("������ �Է��ϼ��� !"); frm.Amount.focus(); return;}
			if (!frm.OrderName.value)   {alert("������ �̸��� �Է��ϼ���"); frm.OrderName.focus(); return;}
			if (!frm.OrderTelNo.value)  {alert("������ ��ȭ��ȣ�� �����ϴ� !"); frm.OrderTelNo.focus(); return;}
			if (!frm.addr1.value)       {alert("�ּҰ� �����ϴ� !"); frm.addr1.focus(); return;}
			if (!frm.deliverName.value) {alert("������ ���� �����ϴ� !"); frm.deliverName.focus(); return;}
			if (!frm.deliverTelNo.value){alert("������ ��ȭ��ȣ�� �����ϴ� !"); frm.deliverTelNo.focus(); return;}
			if (!frm.d_addr1.value)     {alert("������ �ּҰ� �����ϴ� !"); frm.d_addr1.focus(); return;}
			
			frm.submit();
		}
	</script>
</head>
<body>
<form name="payfrm" method="post" action="request.php">
<!--�ֹ���ȣ-->
<input type="hidden" name="OrderNo" value="<?= $orderNum ?>">
<!--���缺���� �̵���������-->
<input type="hidden" name="RecognPage" value="http://www.happyday69.com/skinwiz/cardmodule/BANKWELL/result.php">
<!--��������� �̵���������-->
<input type="hidden" name="ErrorPage"  value="http://www.happyday69.com/skinwiz/cardmodule/BANKWELL/result.php">
<input type="hidden" name="OrderAddr">

<table width="500" border="0" cellpadding="3" cellspacing="2" >
<tr>
	<td bgcolor="#efefef" colspan="2" align="center">		
		<input type="radio" name="msgtype" value="11">�ſ�ī�� &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
		<input type="radio" name="msgtype" value="33">������ü &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		<input type="radio" name="msgtype" value="30">�ڵ��� &nbsp; &nbsp; 
	</td></tr>

<!-- �Ʒ��� ������ ������ ���⼭ ������ name������ ��簪�� ���� �ְ� ó�����ּ���-->
<tr>
	<td bgcolor="#cdcdcd" colspan="2" align="center"> <b>����������</b> </td></tr>
<tr>
	<td bgcolor="#efefef"><font color="#CC3300">*</font> ��ǰ��</td>
	<td bgcolor="#efefef"><input type="text" name="BrandName" ></td></tr>
<tr>
	<td bgcolor="#efefef"><font color="#CC3300">*</font> ��������</td>
	<td bgcolor="#efefef"><input type="text" name="Amount" >��</td></tr>
<tr>
	<td bgcolor="#efefef"><font color="#CC3300">*</font> �� �� </td>
	<td bgcolor="#efefef"><input name="OrderName" type="text" ></td></tr>
<tr>
	<td bgcolor="#efefef"><font color="#CC3300">*</font> E-mail</td>
	<td bgcolor="#efefef"><input name="Email" type="text" ></td></tr>
<tr>
	<td bgcolor="#efefef"><font color="#CC3300">*</font> ��ȭ��ȣ</td>
	<td bgcolor="#efefef"><input name="OrderTelNo" type="text" size="20"></td></tr>
<tr>
	<td bgcolor="#efefef"><font color="#CC3300">*</font> �����ȣ</td>
	<td bgcolor="#efefef">
		<input name="zip1" type="text" size="7"> - <input name="zip2" type="text" size="7">
	</td></tr>
<tr>
	<td rowspan="2" bgcolor="#efefef"><font color="#CC3300">*</font> �� ��</td>
	<td bgcolor="#efefef"><input name="addr1" type="text" size="35"></td></tr>
<tr>
	<td bgcolor="#efefef"> <input name="addr2" type="text" size="26"> ���ּ�</td></tr>
<tr>
	<td bgcolor="#cdcdcd" colspan="2" align="center"> <b>���������</b> &nbsp; &nbsp; 
		<input type="checkbox" name="same" onClick="javascript:sametop()">���Ͱ���</td></tr>
<tr>
	<td bgcolor="#efefef"><font color="#CC3300">*</font> �� �� </td>
	<td bgcolor="#efefef"><input name="deliverName" type="text" ></td></tr>
<tr>
	<td bgcolor="#efefef"><font color="#CC3300">*</font> ��ȭ��ȣ</td>
	<td bgcolor="#efefef"><input name="deliverTelNo" type="text" size="20"></td></tr>
<tr>
	<td bgcolor="#efefef"><font color="#CC3300">*</font> �����ȣ</td>
	<td bgcolor="#efefef">
		<input name="d_zip1" type="text" size="7"> - <input name="d_zip2" type="text" size="7">
	</td></tr>
<tr>
	<td rowspan="2" bgcolor="#efefef"><font color="#CC3300">*</font> �� ��</td>
	<td bgcolor="#efefef"><input name="d_addr1" type="text" size="35"></td></tr>
<tr>
	<td bgcolor="#efefef"> <input name="d_addr2" type="text" size="26"> ���ּ�</td></tr>
<tr>
<tr>
	<td colspan="2" bgcolor="#efefef">
		<table border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
			<td>
				<a href="javascript:CheckIt();">�����ϱ�</a>
			</td>
			<td width="2">&nbsp;</td>
			<td>
				<a href="javascript:history.back();">���</a>	
			</td></tr>
		</table>
	</td></tr>
</form>
</body>
</html>