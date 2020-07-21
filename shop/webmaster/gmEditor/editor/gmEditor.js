//-------------------------------------------------------------------//
//  ���α׷��� : gmEditor v1.1
//-------------------------------------------------------------------//
//  ���� ���� �Ϸ��� : 2006-01-05
//  ���߻� �� ���۱��� : PHP����
//  ������Ʈ : http://www.phpmonster.co.kr
//  �� �� �� : �ڿ��� (misnam@gmail.com)
//-------------------------------------------------------------------//
//                           ī�Ƕ���Ʈ
//-------------------------------------------------------------------//
//  �� ���α׷��� ���� ���α׷����� �����˴ϴ�.
//  gmEditor�� GNU General Public License(GPL) �� �����ϴ�.
//  ���� �ڼ��� ������ LICENSE�� �����Ͻʽÿ�.
//  ����: http://korea.gnu.org/people/chsong/copyleft/gpl.ko.htmll
//-------------------------------------------------------------------//
//                           ����ȯ��
//-------------------------------------------------------------------//
//  Browser: �ͽ��÷η�, ���̾�����, �׽�������
//  Server : PHP�� �����Ǵ� ��� ����
//-------------------------------------------------------------------//


var str,os,gmFrame;
var ostmp = navigator.appName.charAt(0);

// ������ Ȯ��
if(ostmp=='M') os = ''; else if(ostmp=='N') os = 1; else os = 2;

// ������ Ÿ��
gmFrame = !os ? frames.gmEditor : document.getElementById("gmEditor").contentWindow;

// IE ? Nets
str = !os ? "<STYLE>\np{margin-top:1px;margin-bottom:1px;}\n</STYLE>\n" : '';



// �󹮼� �ҷ�����
function newDoc(){
	gmFrame.document.open("text/html");
	gmFrame.document.write(str);
	gmFrame.document.write("&nbsp;");
	gmFrame.document.close();
	gmFrame.focus();
}

// HTML����
function editor_html(){
	obj = window.open(_editor_url+'/html_edit.html','_editor_Html','width=650,height=530,scrollbars=no');
}

// �̸�����
function editor_view(){
	obj = window.open(_editor_url+'/preview.html','_editor_view','width=650,height=550,scrollbars=yes');
}

// �̹���,�̵�� ÷��
function file_upload(id){
	var _tps = '';

	// �̵�� ���ε�
	if(id > 0){
		// ���ε带 ��� (1�� ���ε�Ұ�)
		if(_m_uploaded==1) return false;
		_height = 170;
	}
	// �̹��� ���ε�
	else{
		// ���ε带 ��� (1�� ���ε�Ұ�)
		if(_i_uploaded==1) return false;
		_tps = '?op=1';
		_height = 350;
	}
	return window.open(_editor_url+'/upfile.html'+_tps,'_editor_tb','staus=no, width=300, height='+_height+',scrollbars=no,toolbar=no,menubar=no');
} // end func

// ��޻���
function createHTML(opt,key){
	var width,height,filename,val;

	switch(key){
		case 1: // ���̺� ����
			width=!os?358:352; height=!os?260:218; filename = 'table.html';
		break;

		case 2: // Ư������ ����
			width=!os?308:304; height=!os?360:330; filename = 'characteristic.html';
		break;

		case 3: // ������ ����
			width=!os?238:232; height=!os?280:248; filename = 'emotions.html';
		break;

		case 4: // �۲� ����
			width = 250; height=!os?335:300; filename = 'fontname.html';
		break;

		case 5: // ���ڻ� ����
			width = 260; height=!os?309:280; filename = 'color.html';
		break;

		case 6: // ���� ���� ����
			var op = (os==1) ? '?op=1' : '';
			width = 260; height=!os?309:280; filename = 'color.html'+op;
		break;

		case 7: // ���� ũ�� ����
			width = 350; height=!os?280:245; filename = 'fontsize.html';
		break;

		case 8: // ������ ��ũ
			width=!os?400:360; height=!os?180:135; filename = 'hyperLink.html';
		break;
	}

	if(!os)	val = showModalDialog(_editor_url+'/'+filename,null,'dialogWidth:' + width + 'px;dialogHeight:' + height + 'px;dialogLeft:center;diallogTop:center;help:no;status:no;');
	else obj = window.open(_editor_url+'/'+filename,'_editor_tb','staus=no, width='+width+', height='+height+',scrollbars=no,toolbar=no,menubar=no');

	if(val){
		gmFrame.focus();
		if((key==4)||(key==5)||(key==6)||(key==7)) window.htmltrue(opt,val,true);
		// �����۸�ũ ����
		else if(key==8) {
			window.htmltrue(opt,val,false);
		}
		// �̸�Ƽ�� ����
		else if(key==3) {
			val = _editor_url + '/img/emotions/' + val;
			window.htmltrue(opt,val,false);
		}
		else window.HTMLPaste(val);
	}
	return false;
}


// ���� ������ ������ ������
function Edit_Modify(_contentName,_contentValue){
	return eval("document." + _contentName + "." + _contentValue + ".value");
}

// �� ���۽� �Է¹��� ��
function SubmitHTML(){
	return !os ? gmFrame.document.body.innerHTML : gmFrame.document.documentElement.innerHTML;
}

// ���� HTML ����
function HTMLPaste(key){
	gmFrame.focus();

	// IE
	if(!os){
		past = gmFrame.document.selection.createRange();
		past.pasteHTML(key);
	}

	// Nets
	else if(os==1) gmFrame.document.execCommand("inserthtml",false,key);
	else return;

} // end if

function htmlfalse(key){
	gmFrame.focus();
	gmFrame.document.execCommand(key,false,null);
	return false;
}

function htmltrue(key,val,mode){
	gmFrame.focus();
	gmFrame.document.execCommand(key,mode,val);
	return false;
}

gmFrame.focus();
gmFrame.document.open("text/html");
gmFrame.document.writeln(str);
gmFrame.document.writeln(Edit_Modify(_contentName,_contentValue));
gmFrame.document.close();

gmFrame.document.designMode = "On";
