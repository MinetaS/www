<?
// Copyright (c) 2009 Web Chat - www.comdomi.com //

@session_start();


include "chat_config.php";



global $cmd, $kcmd, $uname, $rname, $rno, $u_name, $hty_connect, $chat_sno, $HTTP_SESSION_VARS;


$hty_connect=db_connect(); // �����ͺ��̽� ����

// ����� �̸��� ������ ���ǿ� ���
if( $uname )
{

	if(!$HTTP_SESSION_VARS['u_name'])
	{

		$u_name=$uname;

		session_register2("u_name");

	}

	if($uname != $HTTP_SESSION_VARS['u_name']) $HTTP_SESSION_VARS['u_name']=$uname;

}
else $HTTP_SESSION_VARS['u_name'] = 0;


// ����� ������ ���� ���� ���̵� ����
$sid=session_id();
//echo $sid;

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>BobChat</title>
<style type="text/css">
body {

margin:0px;
background-color:#FFFFFF;
font-size:10pt;
color:#555555;
line-height:130%;
font-family:����;

}

form { margin:0px; }

li { font-size:10pt; font-family:����; line-height:200%;}

input { font-size:9pt; font-family:����; line-height:120%; margin-bottom:0px; height:20px; }

select { font-size:9pt; font-family:����; }

td,div { font-size:10pt; }

A:link {color:#555555; font-size:9pt; text-decoration: none}
A:visited {color:#555555; font-size:9pt; text-decoration: none}
A:hover {color:#CC3300; font-size:9pt; text-decoration: none}

</style>
</head>
<body>

<div style="text-align:center;">

<?

if(!strlen($sid))
{

echo "<div style='color:#F60;padding:50px;'>���� ���̵� �����ϴ� !</div>";

exit();

}

$regtime=time();

$t_time=$regtime-60; // 60 �� ���� ���� üũ �ð�

$rno=intval($rno);

switch($kcmd)
{


// ��ȭ�� ���� ���
case "out":

  // ��ȭ�� ���� �޽��� ���
  $t_talk="<span style=\'color:#C90;\'>��ȭ���� ���� �Ͽ����ϴ� !</span>";

  mysql_query("insert into web_chat ( sid, rno, uname, ctalk, regdate ) values ( '$sid', '$rno', '$uname', '$t_talk', '$regtime' )", $hty_connect);

  // ����� ���� ���� ǥ�� ���� 0���� �ʱ�ȭ
  mysql_query("update web_chat set regdate=0 where rno=$rno and sid='$sid' and ctype='S' and regdate>$t_time", $hty_connect);

  echo "<script>alert('��ȭ���� ���� �Ͽ����ϴ� !');location.href='web_chat.php';</script>";

break;


case "enter":

if($sid && $rno)
{

  // �� ���� ���ϱ�
  $r_dat=mysql_fetch_array(mysql_query("select * from web_chat where cno=$rno", $hty_connect));

  $t_dat=mysql_fetch_array(mysql_query("select * from web_chat where rno=$rno and sid='$sid' and regdate>$t_time and ctype='S' ", $hty_connect));

// ����� ���ӹ�ȣ ����
if($t_dat['cno']) $chat_sno=$t_dat['cno']; else $chat_sno=0;

if( $r_dat['cno'] && !$t_dat['cno'] )
{

  // ������ ���� ������ ���� - �ֱ������� �ð��� ������Ʈ
  $sql = "insert into web_chat ( sid, rno, uname, croom, ctype, regdate ) values ( '$sid', '$rno', '$uname', '$r_dat[croom]', 'S', '$regtime' )";
  mysql_query($sql, $hty_connect);

  $chat_sno=mysql_insert_id();

  // ��ȭ�� ���� �޽��� ���
  $t_talk="<span style=\'color:#09C;\'>��ȭ�濡 ���� �Ͽ����ϴ� !</span>";

  mysql_query("insert into web_chat ( sid, rno, uname, ctalk, regdate ) values ( '$sid', '$rno', '$uname', '$t_talk', '$regtime' )", $hty_connect);

if($cmd!="first") echo "<script>alert('��ȭ�濡 ���� �Ͽ����ϴ� !');</script>";

}

}

break;


case "make":

if($rname && $uname)
{

$sql = "insert into web_chat ( sid, uname, croom, ctype, regdate ) values ( '$sid', '$uname', '$rname', 'R', '$regtime' )";
mysql_query($sql, $hty_connect);

$t_rno=mysql_insert_id();

if($t_rno)
{

  echo "<script>alert('[ $rname ] ��ȭ���� ���� �Ͽ����ϴ�. ��ȭ������ ���� �մϴ� !');location.href='web_chat.php?kcmd=enter&rno=$t_rno&cmd=first&uname=$uname';</script>";

}
else
{

  echo "<script>alert('��ȭ���� ����� ���� !');location.href='web_chat.php';</script>";

}


}

break;


default:

break;

}

?>
<script type="text/javascript">
var chat_count=null;

function chat_no()
{

alert("Chat count : "+chat_count);

}

function km35_chat_check()
{

if(!km35_chat.rname.value || km35_chat.rname.value=="��ȭ�� �̸�") { alert("�� �̸��� �Է��ϼ��� !"); km35_chat.rname.focus(); return false; }

if(!km35_chat.uname.value || km35_chat.uname.value=="����� �̸�") { alert("����� �̸��� �Է��ϼ��� !"); km35_chat.uname.focus(); return false; }

return true;

}

function km35_send_check()
{

if(!km35_send.ctext.value) { alert("������ �Է��ϼ��� !"); km35_send.ctext.focus(); return false; }

return true;

}

function chat_enter( rnum )
{

if(!km35_chat.uname.value || km35_chat.uname.value=="����� �̸�") { alert("����� �̸��� �Է��Ͻð� �� �̸��� Ŭ���ϼ��� !"); km35_chat.uname.focus(); return false; }

location.href="web_chat.php?kcmd=enter&rno="+rnum+"&uname="+km35_chat.uname.value;

}

</script>

<div style="padding:5px;">
<table width="660" border="0" cellpadding="5" cellspacing="2">
<col width="180" /><col width="*" />
<? if($kcmd!="enter") { ?>
<form method="post" action="web_chat.php" name="km35_chat" onsubmit="return km35_chat_check();">
<input type=hidden name=kcmd value="make">
<tr>
<td style="padding:0px;">
<div>
<input type="text" name="rname" style="width:180px;height:18px;font-size:9t;padding:1px;line-height:160%;text-align:center;color:#36C;" value="��ȭ�� �̸�" onfocus="this.value='';make_room.style.display='inline';">
</div>
</td>
<td align="left" style="padding:0px;">
<table width="100% cellpadding="0" cellspacing="0">
<tr>
<td align="left">
<input type="text" name="uname" style="width:90px;height:18px;font-size:9t;padding:1px;line-height:160%;text-align:center;color:#6A3;" value="<? if($HTTP_SESSION_VARS['u_name']) echo $HTTP_SESSION_VARS['u_name']; else echo "����� �̸�"; ?>" onfocus="this.value='';"> <input type="submit" value="��ȭ�� �����" style="height:25px;display:none;" id="make_room">
</td>
<td align="right">
&nbsp;
</td>
</tr>
</table>
</td>
</tr>
</form>
<? 
} 
else
{
?>
<tr>
<td style="padding:0px;color:#FFF;" bgcolor="#8899AA">
<b><?=$r_dat['croom']?></b>
</td>
<td align="left" style="padding:0px;">
<table width="100% cellpadding="0" cellspacing="0">
<tr>
<td align="left">
&nbsp;
</td>
<td align="right" valign="bottom">
<input type="button" value="��ȭ�� ������" style="height:25px;cursor:hand;" onclick="location.href='web_chat.php?kcmd=out&rno=<?=$rno?>&uname=<?=$uname?>'">
</td>
</tr>
</table>
</td>
</tr>
<? } ?>
<tr valign="top">
<td rowspan="2" style="border:1px dotted #996;" bgcolor="#DDDDCC">
<? if($kcmd!="enter") { ?>
<div style="padding:5px;background-color:#89A;color:#FFF;">�� ȭ �� �� ��</div>
<hr>
<div id="chat_rlist"></div>
<? } else { ?>
<div style="padding:5px;background-color:#9B8;color:#FFF;">�� �� �� �� ��</div>
<hr>
<div id="chat_ulist"></div>
<embed style="width:0px;height:0px;display:none;" src="enter.wav" type="application/x-mplayer2" showstatusbar="" showcontrols="" showtracker="" enablecontextmenu="" volume="0" playCount="1" AllowScriptAccess="never" autostart="true" />
<embed id="chatwav1" style="width:0px;height:0px;display:none;" src="chat1.wav" type="application/x-mplayer2" showstatusbar="" showcontrols="" showtracker="" enablecontextmenu="" volume="0" playCount="1" AllowScriptAccess="never" autostart="false" />
<embed id="chatwav2" style="width:0px;height:0px;display:none;" src="chat2.wav" type="application/x-mplayer2" showstatusbar="" showcontrols="" showtracker="" enablecontextmenu="" volume="0" playCount="1" AllowScriptAccess="never" autostart="false" />
<? } ?>
</td>
<td bgcolor="#EEEEEE" style="border:1px solid #CCA;">
<div id="chat_view" style="height:400px;width:470px;overflow:auto;overflow-x:hidden;padding:0px;"></div>
</td>
</tr>
<form method="post" action="km_36.php" name="km35_send" target="chatwrite" onsubmit="return km35_send_check();">
<input type=hidden name=sid value="<?=$sid?>">
<input type=hidden name=rno value="<?=$rno?>">
<input type=hidden name=sno value="<?=$chat_sno?>">
<input type=hidden name=uname value="<?=$uname?>">
<input type=hidden name=cmd value="chatwrite">
<tr>
<td bgcolor="#DDDDDD">
<input type="text" name="ctext" style="width:400px;height:18px;font-size:9t;padding:1px;line-height:160%;" <? if($kcmd!="enter") echo "disabled"; ?>> <input type="submit" value="������" style="height:25px" <? if($kcmd!="enter") echo "disabled"; ?> ></td>
</tr>
</form>
</table>
</div>
<? if($kcmd=="enter") { ?>
<iframe name="chatframe" src="km_36.php?rno=<?=$rno?>&sno=<?=$chat_sno?>" width=0 height=0></iframe>
<iframe name="chatwrite" src="km_36.php?rno=<?=$rno?>&sno=<?=$chat_sno?>&cmd=chatwrite" width=0 height=0></iframe>
<? } else { ?>
<iframe name="chatframe" src="km_36.php" width=0 height=0></iframe>
<? } ?>

</div>

</body>
</html>

<?

// �����ͺ��̽� ���� ����
if($hty_connect) {
	@mysql_close($hty_connect);
	unset($hty_connect);
}
?>