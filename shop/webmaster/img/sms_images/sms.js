var gdCurDate = new Date();
var Year = gdCurDate.getFullYear();
var Month = gdCurDate.getMonth()+1;
var Day = gdCurDate.getDate();
var	onoffchk=1;

function reserv_chg() {
	var sw=smsForm.checkbox.value;
	if (sw==0) {
		smsForm.checkbox.value=1; 
		smsForm.reserve.value="R";
		smsForm.Dateff1.disabled=false; 
		smsForm.time1.disabled=false; 
		smsForm.time2.disabled=false;
		bt_on.style.visibility="visible";
		bt_off.style.visibility="hidden";
		bt_on.focus();
	}	else { 
		hide_cal();
		smsForm.checkbox.value=0; 
		smsForm.reserve.value="";
		smsForm.Dateff1.disabled=true; 
		smsForm.time1.disabled=true; 
		smsForm.time2.disabled=true;
		bt_on.style.visibility="hidden";
		bt_off.style.visibility="visible";
	}
}
function show_cal(){
	calendar.style.visibility="visible";		//�޷����̱�
}
function onoff(){
	if (onoffchk==0) {
		calendar.style.visibility="hidden";			//�޷°��߱�
		onoffchk=1;
	}else{
		calendar.style.visibility="visible";			//�޷°��߱�
	//	calendar.createCalendar();
			onoffchk=0;
	}
}
function hide_cal(){			
 	calendar.style.visibility="hidden";			//�޷°��߱�
}
function chg2(init){
  	if (init>9) {
  		return init;
  	} else {
	  	str="0"+init;
		return str;
	}
}
															 
function AddData(str,idx)											//Ŭ���� �̸�Ƽ�� ȭ�鿡 ǥ��
{
	clear2();
	form = document.smsForm;

   	// ����, ���������̼�, �̱������̼�, �齽���� ó��
	var re, sq, dq, bs, qq;
	var r1;

	re = /cR_/g;
	sq = /sQ_/g;
	dq = /dQ_/g;
	//bs = /bS_/g;
  
	r1 = str.replace(re, "\r\n");
	r1 = r1.replace(sq, "'");
	r1 = r1.replace(dq, "\"");
	//r1 = r1.replace(bs, "\\");

	form.messageTemp.value = r1;
   	form.cid.value = idx;
   	
    cal_byte(form.messageTemp.value);
}

function insertEmoti(char)												// �̸�Ƽ�� ����
{				
		clear2();
		document.smsForm.messageTemp.value += char;
		cal_byte(document.smsForm.messageTemp.value);
}

function cal_byte(query)												// �Է� ����Ʈ �� ���
{
       var tmpStr;
       var temp=0;
       var onechar;
       var tcount;
       tcount = 0;

       tmpStr = new String(query);
       temp = tmpStr.length;

       for (k=0;k<temp;k++)
       {
            onechar = tmpStr.charAt(k);

            if (escape(onechar).length > 4) {
                 tcount += 2;
            }
            else if (onechar!='\r') {
                 tcount++;
            }
            
       }

       document.smsForm.cbyte.value = tcount;

       if(tcount>80) {
            reserve = tcount-80;
            alert("�޽��� ������80����Ʈ �̻��� �����ϽǼ� �����ϴ�.\r\n ���� �޼����� "+reserve+"����Ʈ�� �ʰ��Ǿ����ϴ�.\r\n �ʰ��� �κ��� �ڵ����� �����˴ϴ�.");
            cutText();
            return;
       }
}

function cal_byte2(query)
{
       var tmpStr;
       var temp=0;
       var onechar;
       var tcount;
       tcount = 0;

       tmpStr = new String(query);
       temp = tmpStr.length;

       for (k=0;k<temp;k++)
       {
            onechar = tmpStr.charAt(k);

            if (escape(onechar).length > 4) {
                 tcount += 2;
            }
            else if (onechar!='\r') {
                 tcount++;
            }
            
       }
	   return tcount;
}


function cutText()															//���ڿ��ڸ���
{
       cut_string(document.smsForm.messageTemp.value, 80);				//��������80����Ʈ������...
}

function cut_string(query,max)												//�����ڸ��� ����
{
       var tmpStr;
       var temp=0;
       var onechar;
       var tcount;
       tcount = 0;

       tmpStr = new String(query);
       temp = tmpStr.length;

       for(k=0;k<temp;k++)
       {
            onechar = tmpStr.charAt(k);

            if(escape(onechar).length > 4) {
                 tcount += 2;
            }
            else if(onechar!='\r') {
                 tcount++;
            }
            
            if(tcount>max) {
                 tmpStr = tmpStr.substring(0,k);
                 break;
            }
       }

       if (max == 80) {
            document.smsForm.messageTemp.value = tmpStr;
            cal_byte(tmpStr);
       }

       return tmpStr;
}


function SendToSMS1()
{
	var form = document.smsForm;
	var idx=0;
	var new_rphone='';
	var tcount = 0;
	var digits="0123456789";
	var temp;
	var yyyy;
	var mm;
	var dd;

	tmpStr = form.messageTemp.value;
	tcount = cal_byte2(tmpStr);
	if(tcount > 80) {
		reserve = tcount-80;
		alert("�޽��� ������80����Ʈ �̻��� �����ϽǼ� �����ϴ�.\r\n ���� �޼����� "+reserve+"����Ʈ�� �ʰ��Ǿ����ϴ�.\r\n �ʰ��� �κ��� �ڵ����� �����˴ϴ�.");
		cutText();
		form.messageTemp.focus();
		return;
	}

	if(form.checkbox.value!=0){
		var a1=form.Dateff1.value.substring(0,4);					//������ �⵵
		var a2=form.Dateff1.value.substring(6,8);					//������ ��
		var a3=form.Dateff1.value.substring(10,12);					//������ ��
		var a4=form.time1.value;									//������ ��
		var a5=form.time2.value;									//������ �� 

		var today=null;
		today=new Date();
		var b1=today.getYear();
		var b2=today.getMonth()+1;									//getMonth�� 0:1��, 1:2�� �̹Ƿ� 1����
		var b3=today.getDate();
		var b4=today.getHours();
		var b5=today.getMinutes()+5;
			
		
		var X = new Date(b1,b2,b3,b4,b5); 							//����ð�+5��
		var D = new Date(a1,a2,a3,a4,a5,0); 						//������ ��¥

		//�ð����� ���ϱ� ���� �и����� ������ ������ �ٲ۴�.
		X = X.getTime();//���� ��¥�� �и����� ������ ����
		D = D.getTime();//������ ��¥�� �и����� ������ ����

		//�ٲ� �и����� ���ڰ����� ������ �Ѵ�.(�����̸� �� �� �ֵ��� 60*1000 ���� ����)
		var day_gap = Math.floor((X - D) / (60*1000));

		if(X-D > 0){ //����ð�-���ýð�
			alert("����߼� ���� �ð��� ����ð����� �ּ�5�� ���Դϴ�.");
			return;
		}
	}

	if(form.messageTemp.value=='' || form.cbyte.value==0) {
		alert("������ �Է����ּ���!");
		form.messageTemp.focus();
		return;
	}

	if(form.receive.value=='' || form.receive.value.length<10) {
		alert('�޴»�� ��ȭ��ȣ�� Ȯ���� �ּ���');
		form.receive.focus();
		return;
	}

	for(var q=0;q<form.send.value.length;q++){
		temp=form.send.value.substring(q,q+1);
		if (digits.indexOf(temp)==-1){
			alert("�����»�� ��ȭ��ȣ�� ���ڸ� �Է��ϼ���. Ȯ�ιٶ��ϴ�.");
			form.send.focus();
			return;
		}
	}

	rphones=form.receive.value.split("\r\n");
	//alert('rphone������='+rphones.length);

	for(i=0;i<rphones.length;i++)
	{
	  	if (rphones[i]=='') {
	  	} else {
			for(var r=0;r<rphones[i].length;r++){
				temp=rphones[i].substring(r,r+1);
				if (digits.indexOf(temp)==-1){
					alert("�޴»�� ��ȭ��ȣ�� ���ڸ� �Է��ϼ���. Ȯ�ιٶ��ϴ�.");
					form.receive.focus();
					return;
				}
			}
			if (i==(rphones.length-1)) {					// �ݷ����� �����¹�ȣ ����
				new_rphone=new_rphone+rphones[i];
			} else {
				new_rphone=new_rphone+rphones[i]+":";
			}
	  	}
	}

	new_rphone=both_trim(new_rphone);
	new_rphones=new_rphone.split(":");
      
	if (new_rphones.length>50) {
		alert("���ÿ� ������ �� �ִ� �ο����� �ʰ��Ͽ����ϴ�. (�ִ� 50��)\r\n"+new_rphones.length+"���� �Է��ϼ̽��ϴ�.");
		form.receive.focus();
		return;
	}

	if(form.send.value=='' || form.send.value.length>11) {
		alert('�����»�� ��ȭ��ȣ�� Ȯ���� �ּ���');
		form.send.focus();
		return;
	}

	form.message.value=form.messageTemp.value;
	form.sendPhone.value=form.send.value;
	form.receivePhone.value=new_rphone;
	if (form.cid.value=='')	{form.cid.value="99100001";}
	
	yyyy = form.Dateff1.value.substring(0,4);
	mm = form.Dateff1.value.substring(6,8);
	dd = form.Dateff1.value.substring(10,12);
	form.reserveTime.value=yyyy+"-"+mm+"-"+dd+" "+form.time1.value+":"+form.time2.value+":00";
	
	/*
	if (form.location.value=='NPNS' || form.location.value=='NMSN') {		//�޽����ϰ��
	} else {
		form.messageTemp.value="";				//������â �ʱ�ȭ
		form.cbyte.value="0";
		form.receive.value="";
	}
	*/
	
	if (form.location.value=='NMSN') {		//�޽����ϰ��
		gosend();
	} else {
		window.open("","sendSms","scrollbars=no,resizable=no,top=40,left=40,width=420,height=480");
		form.target="sendSms";
		form.submit();
		form.cid.value="";
	}
}

function SendToSMS2()		//���̹� �˻����� ���(2004.11.12 �߰�)
{
	var form = document.smsForm;
	var idx=0;
	var new_rphone='';
	var tcount = 0;
	var digits="0123456789";
	var temp;

	tmpStr = document.smsForm.messageTemp.value;
	tcount = cal_byte2(tmpStr);
	
	if(tcount > 80) {
		reserve = tcount-80;
		alert("�޽��� ������80����Ʈ �̻��� �����ϽǼ� �����ϴ�.\r\n ���� �޼����� "+reserve+"����Ʈ�� �ʰ��Ǿ����ϴ�.\r\n �ʰ��� �κ��� �ڵ����� �����˴ϴ�.");
		cutText();
		form.messageTemp.focus();
		return;
	}
	            
	if(form.messageTemp.value=='' || form.cbyte.value==0) {
		alert("������ �Է����ּ���!");
		form.messageTemp.focus();
		return;
	}
   
	if(form.receive.value=='' || form.receive.value.length<10) {
		alert('�޴»�� ��ȭ��ȣ�� Ȯ���� �ּ���');
		form.receive.focus();
		return;
	}
      
	if(form.send.value=='') {
		alert('�����»�� ��ȭ��ȣ�� Ȯ���� �ּ���');
		form.send.focus();
		return;
	}
     
	if (isNaN(form.receive.value)) {
		alert ('�޴� ��� ����ȣ�� ���ڷθ� �Է��ؾ� �մϴ�.!!');
		form.receive.value = '';
		form.receive.focus();
		return;
	}
	
	if (isNaN(form.send.value)) {
		alert ('������ ��� ����ȣ�� ���ڷθ� �Է��ؾ� �մϴ�.!!');
		form.send.value = '';
		form.send.focus();
		return;
	}

	if(form.send.value=='' || form.send.value.length>11) {
		alert('�����»�� ��ȭ��ȣ�� Ȯ���� �ּ���');
		form.send.focus();
		return;
	}

	form.message.value=form.messageTemp.value;
	form.sendPhone.value=form.send.value;
	form.receivePhone.value=form.receive.value;
	if (form.cid.value=='')	{form.cid.value="99100001";}

	form.messageTemp.value="";				//������â �ʱ�ȭ
	form.cbyte.value="0";

	window.open("","sendSms","scrollbars=no,resizable=no,top=40,left=40,width=420,height=480");
	form.target="sendSms";
	form.submit();
	form.cid.value="";

}

function cal_pre()												//���ڸ޽��� �Է½� 80����Ʈ üũ �κ�
{
	var tmpStr, tcount;
	tmpStr = document.smsForm.messageTemp.value;

	cal_byte(tmpStr);

	if(document.smsForm.cbyte.value > 80) {
		reserve = tcount-80;
		alert("�޽��� ������ 80����Ʈ �̻��� �����ϽǼ� �����ϴ�.\r\n ���� �޼����� "+reserve+"����Ʈ�� �ʰ��Ǿ����ϴ�.\r\n �ʰ��� �κ��� �ڵ����� �����˴ϴ�.");
		cutText();
		return;
	}
}

function clear2() {												//ȭ�� Ŭ����(ȭ��Ŭ����� cid�� ���ܵд�.�̸�Ƽ�ܼ����ΰ��)
	if (document.smsForm.chk.value=="0") {    		
		document.smsForm.chk.value = "1";
		document.smsForm.cbyte.value = 0;
		document.smsForm.messageTemp.value = "";
	}
}

function AddChar(str)											//Ŭ���� ���ڿ� ȭ�鿡 �߰�
{
	clear2();
	form = document.smsForm;
	form.messageTemp.value = form.messageTemp.value + str;
	cal_byte(form.messageTemp.value);
}

function Cancel()												//��ҹ�ư Ŭ����
{
	document.smsForm.cid.value = "";
	document.smsForm.cbyte.value = 0;
	document.smsForm.messageTemp.value="";
	document.smsForm.messageTemp.focus();
}

function Cancel_Emoti()											//�̸�Ƽ�� ��ҽ�
{
	document.smsForm.cbyte.value = 0;
	document.smsForm.messageTemp.value="";
	document.smsForm.cid.value="";
	document.smsForm.msg.value = "";
	document.smsForm.messageTemp.focus();
}

function Paste_Emo(char)										//�̸�Ƽ�� ���̱�
{	
	document.smsForm.messageTemp.value="";
	document.smsForm.messageTemp.value=char;
	document.smsForm.messageTemp.focus();
}

function chk_key()												//�޴� ��� ��ȣ üũ����(keypress �̺�Ʈ��)
{
	var r_str = document.smsForm.receive.value;
	var tmpStr;
	var temp=0;
	arr_rphone=r_str.split("\r\n");
	
	if (event.keyCode < 48 || event.keyCode > 57) {				//Ű�ڵ尡 ���ڰ� �ƴҶ�
		if (event.keyCode != 13) {
			event.returnValue=false;							//�Է°��� �����(����Ű ����)
		} else {												//���͸� �Է½�
			for (i=0;i<arr_rphone.length;i++)
			{
				if (arr_rphone[i]=='') {						//�� ĭ���� ���� ������
					event.returnValue=false;
				} else {										//�� ĭ�� �ƴϰ� ���͸� �Է����� ��
					if (arr_rphone.length>=50) {
						event.returnValue=false;
						alert("���ÿ� ������ �� �ִ� �ο����� �ʰ��Ͽ����ϴ�. (�ִ� 50��)")
						return;
					}
					// ��3�ڸ� üũ
					if ((arr_rphone[i].substring(0,3)=='010')||(arr_rphone[i].substring(0,3)=='011')||(arr_rphone[i].substring(0,3)=='016')||(arr_rphone[i].substring(0,3)=='017')||(arr_rphone[i].substring(0,3)=='018')||(arr_rphone[i].substring(0,3)=='019')){
						if (i>=1) {
							for(var j=0;j<i;j++)
							{
								if (arr_rphone[i]==arr_rphone[j]){
									alert('�޴� �� ��ȣ�� �ߺ� �ԷµǾ����ϴ�.');
									tmpStr = new String(document.smsForm.receive.value);
									temp = tmpStr.length;
									tmpStr = tmpStr.substring(0,temp-arr_rphone[i].length-2);
									document.smsForm.receive.value=tmpStr;
									document.smsForm.receive.focus();
								}
							}
						}
					}else{
							alert('�޴� �� ��ȣ�� 010,011,016,017,018,019�� �����ؾ� �մϴ�.');
							if (i==0){
							document.smsForm.receive.value="";
							event.returnValue=false;
							document.smsForm.receive.focus();
							}
							if (i>=1){
							tmpStr = new String(document.smsForm.receive.value);
							temp = tmpStr.length;
							tmpStr = tmpStr.substring(0,temp-arr_rphone[i].length-2);
							document.smsForm.receive.value=tmpStr;
							document.smsForm.receive.focus();
							//document.smsForm.receive.focus();
							//event.returnValue=false;
							}
					}
				}
			}
		}
	} else {													//���ڸ� �Է����� ��
		
	}
}

function chk_num()												//�޴� ��� ��ȣ üũ����(keydown��)
{
	var r_str = document.smsForm.receive.value;
	var tmpStr;
	var temp=0;
	arr_rphone=r_str.split("\r\n");
	
	if (event.keyCode >= 48 && event.keyCode <= 57) {
		for (i=0;i<arr_rphone.length;i++)
			{
				if (arr_rphone[i].length>=12) {												
					alert('�޴� �� ��ȣ�� 11�ڸ� �ʰ��Ҽ� �����ϴ�. �ٽ� �ѹ� Ȯ�ιٶ��ϴ�.');
					tmpStr = new String(document.smsForm.receive.value);
					temp = tmpStr.length;
					tmpStr = tmpStr.substring(0,temp-arr_rphone[i].length-2);
					document.smsForm.receive.value=tmpStr;
					document.smsForm.receive.focus();
				} 
			}
	}
}

function both_trim(a)											//���� : �ڸ���
{
   var search=0;
   while (a.charAt(search)==":")
   {
     search=search+1;
   }
   a=a.substring(search,(a.length))
   search=a.length-1;
   while (a.charAt(search)==":")
   {
     search = search-1;
   }
   return a.substring(0,search+1)
}

function trim(a)								//��������
{
   var search=0;
   while (a.charAt(search)==" ")
   {
     search=search+1;
   }
   a=a.substring(search,(a.length))
   search=a.length-1;
   while (a.charAt(search)==" ")
   {
     search = search-1;
   }
   return a.substring(0,search+1)
}

function Main_SMS_Send()
{
	var form = document.smsForm;
	var digits="0123456789";
	var tcount = 0;
    var new_rphone='';
    var temp;
         
	if(form.messageTemp.value.length>80){
			alert("�޽����� ���̴� 80����Ʈ�� ������ �����ϴ�. Ȯ�ιٶ��ϴ�.");
			return;
		}
		
	if(form.messageTemp.value=='' || document.smsForm.cbyte.value=='0') {
	    alert("������ �Է����ּ���!");
	    form.messageTemp.focus();
	    return;
	}

	if(form.receive.value=='' || form.receive.value.length<10) {
       	alert('�޴»�� ��ȭ��ȣ�� Ȯ���� �ּ���');
       	form.receive.focus();
       	return;
    }
 
	if (isNaN(form.send.value))
	{
  	  alert ('������ ��� ����ȣ�� ���ڷθ� �Է��ؾ� �մϴ�.!!');
   	  form.send.value = '';
	  form.send.focus();
   	  return;
	}		
	
	if(form.send.value=='' || form.send.value.length>11) {
	   	alert('�����»�� ��ȭ��ȣ�� Ȯ���� �ּ���');
	   	form.send.focus();
	   	return;
	}
		
	rphones=form.receive.value.split(",");
      //alert('rphone������='+rphones.length);
    for(i=0;i<rphones.length;i++)
    {
	  	if (rphones[i]=='') {
	  	} else {
	  		for(var r=0;r<rphones[i].length;r++){
					temp=rphones[i].substring(r,r+1);
					if (digits.indexOf(temp)==-1){
						alert("�޴»�� ��ȭ��ȣ�� ���ڸ� �Է��ϼ���. Ȯ�ιٶ��ϴ�.");
						form.receive.focus();
						return;
					}
				}
				
		  	if (i==(rphones.length-1)) {					// �ݷ����� �����¹�ȣ ����
		  		new_rphone=new_rphone+rphones[i];
		  	} else {
		  		new_rphone=new_rphone+rphones[i]+":";
		  	}
	  	}
	}
    new_rphone=both_trim(new_rphone);
    new_rphones=new_rphone.split(":");
      
    if (new_rphones.length>50) {
    	alert("���ÿ� ������ �� �ִ� �ο����� �ʰ��Ͽ����ϴ�. (�ִ� 50��)\r\n"+new_rphones.length+"���� �Է��ϼ̽��ϴ�.");
    	form.receive.focus();
    	return;
    }
    
    form.message.value=form.messageTemp.value;
	form.sendPhone.value=form.send.value;
	form.receivePhone.value=new_rphone;
	if (form.cid.value=='')	{ form.cid.value="99100001"; }

	form.messageTemp.value="";				//������â �ʱ�ȭ
	form.cbyte.value="0";
	window.open("","sendSms","scrollbars=no,resizable=no,top=40,left=40,width=420,height=480");
	form.target="sendSms";
	form.submit();
	form.cid.value="";
}