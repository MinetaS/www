<!--#######################################################-->
<!--# 					return_true.php					  #-->
<!--#######################################################-->
<!--# 													  #-->
<!--# ���缺���� �����ʿ��� ���۾��� ���⼭ �Ͻø� �˴ϴ�.#-->
<!--#													  #-->
<!--# return.php���� ���� ���� ���⼭ ��� ������ ����	  #-->
<!--#													  #-->
<!--#													  #-->
<!--#######################################################-->

<body leftmargin="10" topmargin="10">
<head><title>�������� !!!</title></head>
<table border="0" cellpadding="0" cellspacing="0" width="500" bgcolor="ababab">
<tr>
	<td>
		<table border="0" cellpadding="5" cellspacing="1" width="100%">
		<tr bgcolor="#FFCC4A">
			<td align="center" colspan="2"><b>�����Ͻ� �����Դϴ�.</b></td>
		</tr>
		<tr bgcolor="ffffff">
			<td width="160" align="center" bgcolor="efefef">�ֹ��ڸ�</td>
			<td><?=$order_name?></td>
		</tr>
		<tr bgcolor="ffffff">
			<td width="160" align="center" bgcolor="efefef">�� ǰ ��</td>
			<td><?=$order_bname?></td>
		</tr>
		<tr bgcolor="ffffff">
			<td width="160" align="center" bgcolor="efefef">�� ��</td>
			<td><?=$order_amount?>��</td>
		</tr>
		<tr bgcolor="ffffff">
			<td width="160" align="center" bgcolor="efefef">�ֹ���Email</td>
			<td><?=$order_email?></td>
		</tr>
		<tr bgcolor="ffffff">
			<td width="160" align="center" bgcolor="efefef">�ֹ�����ȭ</td>
			<td><?=$order_tel?></td>
		</tr>
		<tr bgcolor="ffffff">
			<td width="160" align="center" bgcolor="efefef">�ֹ����ڵ���</td>
			<td><?=$order_hp?></td>
		</tr>
		<tr bgcolor="ffffff">
			<td width="160" align="center" bgcolor="efefef">�����θ�</td>
			<td><?=$rev_name?></td>
		</tr>
		<tr bgcolor="ffffff">
			<td width="160" align="center" bgcolor="efefef">������Email</td>
			<td><?=$rev_email?></td>
		</tr>
		<tr bgcolor="ffffff">
			<td width="160" align="center" bgcolor="efefef">��������ȭ</td>
			<td><?=$rev_tel?></td>
		</tr>
		<tr bgcolor="ffffff">
			<td width="160" align="center" bgcolor="efefef">�������ڵ���</td>
			<td><?=$rev_hp?></td>
		</tr>
		<tr bgcolor="ffffff">
			<td width="160" align="center" bgcolor="efefef">������ּ�</td>
			<td><?=$zip1 . "-" . $zip2 . "  " . $addr?></td>
		</tr>
		<tr bgcolor="ffffff">
			<td width="160" align="center" bgcolor="efefef">�޼���</td>
			<td><?=$message?></td>
		</tr>
		<tr bgcolor="ffffff">
			<td width="160" align="center" bgcolor="efefef">��������</td>
			<td><b><?=$MsgTypeCode?></b> (11:�ſ�ī�� 30:�ڵ��� 31:ARS 32:���� 33:������ü)</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td height="30" align="center" bgcolor="ffffff">
		<a href="/">Ȯ��</a>
	</td>
</tr>
</table>
</body>
