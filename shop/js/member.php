<script language=javascript>

function MemberCheckField(f){


<? if(!$mode): // �Է½ø� üũ ?>

// ���̵� üũ
if(checkId(f.ID)== false) return false;
if(f.IDCheckFlag.value == "N"){// ���̵� üũ �� �ߴ��� ���ߴ��� üũ 
	alert("���̵� �ߺ� üũ�� ���ֽʽÿ�");
	return false;
}


<? if($_ENickName == "checked"){?>
// �г���üũ
if(checkNickName(f.NickName)== false) return false;
if(f.NickCheckFlag.value == "N"){// �г��� üũ �� �ߴ��� ���ߴ��� üũ 
	alert("�г��� �ߺ� üũ�� ���ֽʽÿ�");
	return false;
}
<? } ?>


if (f.PWD.value.length < 4) {
	alert("��й�ȣ�� 4�� �̻��̾�� �մϴ�. ");
	f.PWD.focus();
	return false;
}



if ((f.PWD.value) != (f.CPWD.value)) {
	alert("��й�ȣ��Ȯ���� ��Ȯ�� �Է��� �ּ���. ");
	f.CPWD.focus();
	return false;
}

// �̸� üũ 
if(checkName(f.Name)== false) return false;

<? if($UseJuminCheck == "checked"){?>
// �ֹ� üũ
if( IsJuminChk(f.Jumin1.value , f.Jumin2.value) == false) return false;
if(f.JuminCheckFlag.value == "N"){//  �ֹι�ȣ üũ �� �ߴ��� ���ߴ��� üũ 
	alert("�ֹι�ȣ üũ�� ���ֽʽÿ�");
	return false;
}
<? } // �ֹι�ȣ üũ�� ?>

<? endif// �Է½�?>

<? if($mode): // ���� ���� ?>


if ( f.PWD.value != "" && ((f.PWD.value) != (f.CPWD.value))) {
	alert("��й�ȣ��Ȯ���� ��Ȯ�� �Է��� �ּ���. ");
	f.CPWD.focus();
	return false;
}

<? endif; ?>


// ������� üũ 
<? if($_EBirthDay == "checked" && $_CBirthDay == "checked" ){// ������� üũ  ?>
if(!f.BirthYY.value && !f.BirthMM.value && !f.BirthDD.value.value){
	alert("��������� �Է����ּ���");
	return false;
}
<? } ?>
// ���� üũ 
<? if($_ESex == "checked" && $_CSex == "checked" ){// ���� üũ ?>
if(!radiocheck(f.Sex)) {
	alert("������ �Է��� �ּ���.");	
	return false;
}  
<? } ?>
// ��ȥ ���� üũ 
<? if($_EMarrStatus == "checked" && $_CMarrStatus == "checked" ){// ��ȥ ���� üũ  ?>
if(!radiocheck(f.MarrStatus)) {
	alert("��ȥ���θ� �Է��� �ּ���.");	
	return false;
}  
<? } ?>
// ��ȥ ����� üũ 
<? if($_EMarrDate == "checked" && $_CMarrDate == "checked" ){// ��ȥ ����� üũ  ?>
if(!f.MarrYY.value && !f.MarrMM.value && !f.MarrDD.value){
	alert("��ȥ������� �Է����ּ���");
	return false;
}
<? } ?>

// �̸���üũ 
//var Email = f.Email1_1.value + "@" + f.Email1_2.value;
if ( checkEmail(f) == false) return false;
<? if(!$mode){ // �Է½ø�?>
if(f.MailCheckFlag.value == "N"){// �����ߺ� üũ �� �ߴ��� ���ߴ��� üũ 
	alert("���� �ߺ� üũ�� ���ֽʽÿ�");
	return false;
}
<? } ?>
// Ȩ������ üũ
<? if($_EHomePage == "checked" && $_CHomePage == "checked" ){// Ȩ������ ?>
if  (f.Url.value == "" ) {
	alert("Ȩ�������ּҸ� �Է��� �ּ���.");
	f.Url.focus();
	return false;
}  
<? } ?>


// ��ȭ��ȣ üũ
if(!f.Tel1_1.value || !f.Tel1_2.value || !f.Tel1_3.value){
	alert("��ȭ��ȣ�� ��Ȯ�� �Է����ּ���");
	return false;
}

// �ڵ��� üũ
if(!f.Hand1_1.value || !f.Hand1_2.value || !f.Hand1_3.value){
	alert("�ڵ�����ȣ�� ��Ȯ�� �Է����ּ���");
	return false;
}
 
// �ѽ� üũ (üũ�ø�)
<? if($_EFax == "checked" && $_CFax == "checked" ){ ?>
if(!f.Fax1_1.value || !f.Fax1_2.value || !f.Fax1_3.value){
	alert("�ѽ���ȣ�� ��Ȯ�� �Է����ּ���");
	return false;
}	
<? } ?>

// �ּ� üũ 
if  (f.Address1.value.length < 5) {
	alert("�ּҸ� ��Ȯ�� �Է��� �ּ���.");
	f.Address1.focus();
	return false;
}  
if  (f.Address2.value.length < 2) {
	alert("������/��/���� ��Ȯ�� �Է��� �ּ���.[��:123����] ");
	f.Address2.focus();
	return false;
} 

// ��Ÿ ������ 

<? if($_EJob == "checked" && $_CJob == "checked"){// ���� ?>
if  (f.Job.value == "" ) {
	alert("������ ������ �ּ���.");
	f.Job.focus();
	return false;
}  
<? } ?>
<? if($_EScholarship == "checked" && $_CScholarship == "checked"){// �з� ?>
if  (f.Scholarship.value == "" ) {
	alert("�з��� ������ �ּ���.");
	f.Scholarship.focus();
	return false;
} 
<? } ?>

// ��й�ȣ �нǽ� ������ �� 
<? if($_EPassQna == "checked" && $_CPassQna == "checked"){?>
if  (f.PWDHint.value == "" ) {
	alert("��й�ȣ ��߱� ������ ������ �ּ���.");
	f.PWDHint.focus();
	return false;
} 
if  (f.PWDAnswer.value == "" ) {
	alert("��й�ȣ ��߱� ���� �Է��� �ּ���");
	f.PWDAnswer.focus();
	return false;
} 
<? } ?>

// ȸ���
<? if($_ECompany == "checked" && $_CCompany == "checked"){ ?>
if  (f.Company.value == "" ) {
	alert("ȸ����� �Է��� �ּ���");
	f.Company.focus();
	return false;
} 
<? } ?>

// ��ǥ�ڸ�
<? if($_EPresident == "checked" && $_CPresident == "checked"){ ?>
if  (f.President.value == "" ) {
	alert("��ǥ�ڸ��� �Է��� �ּ���");
	f.President.focus();
	return false;
} 
<? } ?>

// ����
<? if($_EBusiness == "checked" && $_CBusiness == "checked"){ ?>
if  (f.Business.value == "" ) {
	alert("���¸� �Է��� �ּ���");
	f.Business.focus();
	return false;
}
<? } ?>

// ����
<? if($_EItem == "checked" && $_CItem == "checked"){ ?>
if  (f.Item.value == "" ) {
	alert("������ �Է��� �ּ���");
	f.Item.focus();
	return false;
}
<? } ?>

<? if($_ECompNum == "checked" && $_CCompNum == "checked" ){?>
if  (f.LicenseNo.value == "" ) {
	alert("����ڵ�Ϲ�ȣ�� �Է��� �ּ���");
	f.LicenseNo.focus();
	return false;
}
<? } ?>


// ȸ�� ��ȭ
<? if($_ECTel == "checked" && $_CCTel == "checked"){ ?>
if(!f.CTel1_1.value || !f.CTel1_2.value || !f.CTel1_3.value){
	alert("ȸ����ȭ��ȣ�� ��Ȯ�� �Է����ּ���");
	return false;
}	
<? } ?>

// ȸ���ѽ�
<? if($_ECFax == "checked" && $_CCFax == "checked"){ ?>
if(!f.CFax1_1.value || !f.CFax1_2.value || !f.CFax1_3.value){
	alert("ȸ���ѽ���ȣ���� ��Ȯ�� �Է����ּ���");
	return false;
}	
<? } ?>

// ȸ���ּ�
<? if($_ECAddress == "checked" && $_CCAddress == "checked"){ ?>
// �ּ� üũ 
if  (f.Address3.value.length < 5) {
	alert("�ּҸ� ��Ȯ�� �Է��� �ּ���.");
	f.Address3.focus();
	return false;
}  
if  (f.Address4.value.length < 2) {
	alert("������/��/���� ��Ȯ�� �Է��� �ּ���.[��:123����] ");
	f.Address4.focus();
	return false;
} 
<? } ?>

// ���� ���� ����
<? if($_EMailReceive == "checked" && $_CMailReceive == "checked"){ ?>
if(f.MailReceive.checked == false) {
	alert("���ϼ��ſ��� üũ�� ���ּ���");	
	return false;
}
<? } ?>

// SMS ���� ����
<? if($_ESMS == "checked" && $_CSMS == "checked"){ ?>
if(f.SMSReceive.checked == false) {
	alert("SMS ���ſ��� üũ�� ���ּ���");	
	return false;
}
<? } ?>

//�������� ����
<? if($_EInfo == "checked" && $_CInfo == "checked"){ ?>
if(f.MPublic.checked == false) {
	alert("�������� ���� üũ�� ���ּ���");	
	return false;
}
<? } ?>

//�ڱ� �Ұ� ����
<? if($_EProfile == "checked" && $_CProfile == "checked"){ ?>
if  (f.MProfile.value == "" ) {
	alert("�ڱ�Ұ����� �Է��� �ּ���");
	f.MProfile.focus();
	return false;
}
<? } ?>

<? if($USE_ICON_TYPE){ ?>
	if(f.UploadCheckFlag.value == "N"){
		alert("������ �ٽ� üũ���ּ���");		
		return false;		
	}
<? } ?>


	return true;
}// end MemberCheckField


function FillBirthDay(f){

	if ( ! TypeCheck(f.Jumin1.value, NUM)) {
		alert("�ֹε�� ��ȣ�� �߸��� ���ڰ� �ֽ��ϴ�. ");
		f.Jumin1.focus();
		return false;
	}

	num = f.Jumin1.value;
	
	mm = parseInt(num.substring(2,4), 10);
	dd = parseInt(num.substring(4,6), 10);
	
	if ((mm < 1) || (mm > 12)) {
		alert ("�ֹε�� ��ȣ ���ڸ��� �߸��Ǿ����ϴ�.");
		return false;
	}
	
	if ((dd < 1) || (dd > 31)) {
		alert ("�ֹε�� ��ȣ ���ڸ��� �߸��Ǿ����ϴ�.");
		return false;
	}

	if(f.Jumin1.value.length == 6){
	
		f.BirthYY.value = "19" + num.substring(0,2);
		f.BirthMM.value = num.substring(2,4);
		f.BirthDD.value = num.substring(4,6);
	
	}
	
	f.Jumin2.focus();
}


function checkSexValue(f){// �ڵ� ���� üũ 
	var JuminValue = f.Jumin2.value;
	var DigitNum = JuminValue.substring(0,1);
	if(JuminValue){
		switch(DigitNum){			
			case "1" : 
			case "3" : f.Sex[0].checked = true; break ;			
			case "2" : 
			case "4" : f.Sex[1].checked = true ; break ; 	
		
		}		
	}
}

function mailChange(f){// ���� ���� 
    if(f.sel_email.value){
        f.Email1_2.value=f.sel_email.value;
				//f.Email1_2.readOnly = true;// readOnly ���� ���� O�� �빮��
    } else{
			f.Email1_2.value = "";
			f.Email1_2.focus();	
		}

}

// ���̵� üũ 

function checkId(f)
{
	
	if(!f.value){
		alert("���̵� �Է��Ͽ� �ּ���");
		f.focus();
		return false;		
	}	else if(f.value.length < 4 || f.value.length > 20)
	{
		alert("���̵�� 4���̻� 20�� �̳��� �����Ͻʽÿ�.");
		f.focus();
		return false;
	}
	
	for (var i=0; i<f.value.length; i++) {
		var ch = f.value.charAt(i);
		if(i == 0 && !(ch>="a" && "z">=ch) )
		{
			alert("���̵�� �ݵ�� �����ڷ� �����Ͽ��� �մϴ�.");
			f.focus();
			return false;
		}
		
		if(!((ch>="0" && "9">=ch) || (ch>="a" && "z">=ch) || ch=="-" || ch=="_"))
		{
			alert("���̵𿡴� ���� " + ch + " �� ����� �� �����ϴ�");
			f.focus();			
			return false;
		}
	} 
	
}

// �̸� üũ 
function checkName(f) {
	
	if(!f.value){
		alert("�̸��� �Է��ϼ���!");
		f.focus();
		return false;
	}
	
	
	if (f.value.indexOf(" ") != -1) {
		alert("�̸��� ������ �Է��Ҽ� �����ϴ�.");
		f.focus();
		return false;		
	}

	for (var i=0; i<f.value.length; i++) {
		var ch = f.value.charAt(i);
	
		if( (ch>="a" && "z">=ch) || ch=="-" || ch=="_" || (ch>="0" && "9">=ch) || (ch>="a" && "z">=ch) || (ch>="A" && "Z">=ch) || ch=="!" || ch=="@" || ch=="$" || ch=="%" || ch=="^" || ch=="&" || ch=="*" )
		{
			alert("�̸����� ���� " +ch+ " �� ����� �� �����ϴ�");
			f.focus();
			return false;
		}
	} 
	
}

// �г��� üũ 
function checkNickName(f)
{				
				if(!f.value){
								alert("�г����� �Է��Ͽ� �ּ���");
								f.focus();
								return false;
				}

        if( f && f.value.length != 0 )
        {
                if ( f.value.length <= 1 )
                {
                        alert("�г����� �� �� �̻��Դϴ�.");
                        f.focus();
                        return false;
                }

                if ( f.value.indexOf(" ") != -1 )
                {
                        alert("�г��ӿ� ������ �Է��Ҽ� �����ϴ�.");
                        f.focus();
                        return false;
                }

                for (var i=0; i<f.value.length; i++)
                {
                        var ch = f.value.charAt(i);

                        if ( ch=="-" || ch=="_" || (ch>="0" && "9">=ch) || ch=="'" || ch=="\"" || ch=="\\" )
                        {
                                alert("�и����� ���� " + ch + " �� ����� �� �����ϴ�");
                                f.focus();
                                return false;
                        }
                }
        }
       
}


// ���� üũ 

function checkEmail(f)
{	
	
		Email1_1 = f.Email1_1.value ;
		Email1_2 = f.Email1_2.value ;
		
		if(Email1_1 == ""){
				alert("�̸��� �ּҸ� �Է����ּ���");
				f.Email1_1.focus();
				return false;
			}else if(Email1_2 == ""){
				alert("�̸��� �ּҸ� �Է����ּ���");
				f.Email1_2.focus();
				return false;
			}
			
			
    var id = f.Email1_1.value + "@" + f.Email1_2.value;//str.value;
    var num = id;
    var checkOk = "~!#$%^&*()+|}{\":?><=\\][';/,` ";

    size = id.length;

    var at = -1;
    var dot = -1;
    var special = false;
    var lastdot = -1;

    for(i=0; i<size; ++i) 
    {
        var test = num.charAt(i);
        if( test == "@" ) at = i;
        else if ( test == "." ) 
        {
        if ( dot == -1 ) dot = i;
        lastdot = i;
        }
        else 
        {
        for (j=0; j < checkOk.length ; j++ )
            if ( test == checkOk.charAt(j) ) special = true;
        }
    }

    if ( special ) 
    {
        alert("E-mail���� " + checkOk + " ���� Ư�����ڸ� ����� �� �����ϴ�.");
        f.Email1_1.focus();    
        return false;
    }

    if ( lastdot == size - 1 ) 
    {
        alert("E-mail�� ���Ŀ� ���� �ʽ��ϴ�. ��) eztotal@eztotal.com");
        f.Email1_1.focus();    
        return false;
    }
   
}


	
// �̹��� ���� �Լ� 	
	function AutoResize(img){ 
	//alert(img);
		foto1= new Image(); 
		foto1.src=(img); 
		Controlla(img);
	} 
	
	function Controlla(img){ 
		if((foto1.width!=0)&&(foto1.height!=0)){ 
			viewFoto(img); 
		} 
		else{ 
			funzione="Controlla('"+img+"')"; 
			intervallo=setTimeout(funzione,20); 
		} 
	} 

	function viewFoto(img){ 
		largh=foto1.width; 
		altez=foto1.height;
		 if(largh >= <? echo $MEMBER_ICON_LIMIT_WIDTH; ?>) {
				largh = <? echo $MEMBER_ICON_LIMIT_WIDTH; ?>;
		 }
		 if(altez >= <? echo $MEMBER_ICON_LIMIT_HEIGHT; ?>) {
				altez = <? echo $MEMBER_ICON_LIMIT_HEIGHT; ?>;
		 }	 
		var imgsiz
		document.imgsiz.width = largh ;
	} 


	function image_onchange(f){    

    if(f.file.value != ""){
			f.sm.src=f.file.value;
			f.sm.style.visibility="visible";
			imgsize = f.file.value;
			img_pre = 'sm';
				if(event.srcElement.value.match(/(.jpg|.jpeg|.gif|.png|.JPG|.JPEG|.GIF|.PNG)/)) {
						document.images[img_pre].src = event.srcElement.value;
						document.images[img_pre].style.display = '';					
						if(f.sm.fileSize > <? echo $MEMBER_ICON_LIMIT_CAPACITY; ?>){ 
							document.images[img_pre].style.display = 'none';
							f.UploadCheckFlag.value = "N";
							alert("<? echo $MEMBER_ICON_LIMIT_CAPACITY; ?>����Ʈ �̻��� ���ε� �ϽǼ� �����ϴ�.");
						}						
						
				}	else {
						document.images[img_pre].style.display = 'none';		
						if(f.sm.fileSize ==-1){
							f.UploadCheckFlag.value = "N";
							alert("�̹��� ���ϸ� �����մϴ�");
						}
						
				}
		f.UploadCheckFlag.value = "Y";		
    AutoResize(imgsize);	
	
    }                

}



</script>