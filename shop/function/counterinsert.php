<?
/*
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/
  // ����� IP ����
  $user_ip=$REMOTE_ADDR;
  $referer=$HTTP_REFERER;
  if(!$referer) $referer="�÷����� �����Է�";

  // ������ ���� ����
  $today=mktime(0,0,0,date("m"),date("d"),date("Y"));
  $yesterday=mktime(0,0,0,date("m"),date("d"),date("Y"))-60*60*24;
  $tomorrow=mktime(23,59,59,date("m"),date("d"),date("Y"));
  $time=time();
//------------------- ī���� ���̺� ����Ÿ �Է� �κ� -------------------------------------------------------

  // ${COUNTER_MAIN_TABLE_NAME}���� ���ó�¥ ���� ������ �߰�.
  $check=mysql_fetch_array(mysql_query("select count(*) from ${COUNTER_MAIN_TABLE_NAME} where date='$today'"));
  if(!$check[0])
  {
   mysql_query("insert into ${COUNTER_MAIN_TABLE_NAME} (date, unique_counter, pageview) values ('$today', '0', '0')");
  }

  // ���� �����Ƿ� ������ ����� ���� ó�� �� ������� �˻�
  $check=mysql_fetch_array(mysql_query("select count(*) from ${COUNTER_IP_TABLE_NAME} where date>=$today and date<$tomorrow and ip='$user_ip'"));
  // ���� ó��������
  if($check[0]==0)
  {
   // ��ü�� ���� ī���� �ø�
   mysql_query("update ${COUNTER_MAIN_TABLE_NAME} set unique_counter=unique_counter+1, pageview=pageview+1 where no=1 or date='$today'");  

   // ���� �ð��뺰 ip �Է�
   mysql_query("insert into ${COUNTER_IP_TABLE_NAME} (date, ip) values ('$time','$user_ip')");
  }
  // ���� �ѹ� �̻� �� �����϶�
  else
  {
   // �������� �ø�
   mysql_query("update ${COUNTER_MAIN_TABLE_NAME} set pageview=pageview+1 where no=1 or date='$today'");
  }

  // referer �� ����
  $check2=mysql_fetch_array(mysql_query("select count(*) from ${COUNTER_REFERER_TABLE_NAME} where date=$today and referer='$referer'"));
   if($check2[0]==0)
   {
    mysql_query("insert into ${COUNTER_REFERER_TABLE_NAME} (date, referer, hit) values ('$today','$referer','1')");
   }
   else
   {
    mysql_query("update ${COUNTER_REFERER_TABLE_NAME} set hit=hit+1 where date=$today and referer='$referer'");
   }
   ?>
