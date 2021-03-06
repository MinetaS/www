<?
/*
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
*/
include "../../../config/db_info.php";
include "../../../config/db_connect.php";
include "../../../config/admin_info.php";
include "../../../config/cart_info.php";
include "../../../function/const_array.php";
include "../../../function/kerrigancap_lib.php";

$sqlstr = "SELECT * FROM ${BUYER_TABLE_NAME} WHERE CODE_VALUE = '$cod'";
$sqlqry = mysql_query($sqlstr);
$olist = mysql_fetch_array($sqlqry);
$Zip1 = explode("-",$olist[Zip1]);
$Zip2 = explode("-",$olist[Zip2]);
$Sender_Tel = $olist[Sender_Tel]; 
$Sender_Hand = $olist[Sender_Hand];
$Re_Tel = $olist[Re_Tel]; 
$Re_Hand = $olist[Re_Hand];
$Sender_Company = $olist[Sender_Company];		
$Address1 = $olist[Address1];
$Address2 = $olist[Address2];
$Address3 = $olist[Address3];
$Address4 = $olist[Address4];
$How_Bank = $olist[How_Bank];
$Inputer = $olist[Inputer];
$Sender_Name = $olist[Sender_Name];	
$Sender_Email = $olist[Sender_Email];	
$Re_Email = $olist[Re_Email];
$Re_Name = $olist[Re_Name];
$Message = $olist[Message];

$Pay_Money = $olist[Pay_Money];
$Delivery_Money = $olist[Delivery_Money];// 배송비
$How_Buy = $olist[How_Buy];
$Total_Money = $olist[Total_Money];// 총 주문긍액
/*
<option value="onlycard" >신용카드 (전용)
<option value="onlyiche">계좌이체 (전용)
<option value="onlyhp">핸드폰결제 (전용)
<option value="onlyvirtual">가상계좌 (전용)
*/

if($How_Buy == "card" ) $MsgTypeCode = "onlycard" ; // 카드 결제(전용) 
elseif($How_Buy == "hand") $MsgTypeCode = "onlyhp" ; // 핸드폰 결제
elseif($How_Buy == "autobank") $MsgTypeCode = "onlyiche" ; // 자동이체
elseif($How_Buy == "escrow") $MsgTypeCode = "onlyvirtual" ; // 에스크로


$MallUrl=$SITE_URL;//  상정URL
$StoreId = $CARD_ID; // 상점아이디 (올더게이트에서 발급받은 아이디입니다.)
$OrdNo=$cod; /* 주문번호 */
$OrdNm=$Sender_Name; /* 주문자명 */
$ProdNm=urldecode($goods_name); /* 상품명 */
$Amt=$Pay_Money; /* 결제금액 */
$StoreNm = $ADMIN_TITLE_E; #영문 상점명(반드시 영문으로 해주세요 공백없이)

if(isMember()) $txtCustNo = "$_COOKIE[MEMBER_ID]";
else $txtCustNo = "GUEST";

$OrderContact=$Sender_Tel; // 주문자 전화번호
$email=$Sender_Email;// 이메일
$returnurl = $SITE_URL."/$SKIN_FOLDER_NAME/cardmodule/ALLTHEGATE/result.php"; // 리턴URL
$deliverName=$Re_Name; // 수령인
$deliverPhone=$Re_Tel; // 수령자 전화번호

$OrderAddr=$Address1 . " " . $Address2; // 주문자 주소
$OrderRecAddr=$Address3 . " " . $Address4; // 수령인 주소

?>
<html>
<head>
<title>올더게이트</title>
<style type="text/css">
<!--
body { font-family:"돋움"; font-size:9pt; color:#000000; font-weight:normal; letter-spacing:0pt; line-height:180%; }
td { font-family:"돋움"; font-size:9pt; color:#000000; font-weight:normal; letter-spacing:0pt; line-height:180%; }
.clsright { padding-right:10px; text-align:right; }
.clsleft { padding-left:10px; text-align:left; }
-->
</style>
<script language=javascript src="http://www.allthegate.com/plugin/AGSWallet.js"></script>
<script language=javascript>
<!--
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 올더게이트 플러그인 설치를 확인합니다.
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

StartSmartUpdate();

function Pay(form)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// MakePayMessage() 가 호출되면 올더게이트 플러그인이 화면에 나타나며 Hidden 필드
	// 에 리턴값들이 채워지게 됩니다.
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	if(form.Flag.value == "enable")
	{
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////
		// 입력된 데이타의 유효성을 검사합니다.
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		if(Check_Common(form) == true)
		{
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////
			// 올더게이트 플러그인 설치가 올바르게 되었는지 확인합니다.
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////
			
			if(document.AGSPay == null || document.AGSPay.object == null)
			{
				alert("플러그인 설치 후 다시 시도 하십시오.");
			}
			else
			{
				//////////////////////////////////////////////////////////////////////////////////////////////////////////////
				// 올더게이트 플러그인 설정값을 동적으로 적용하기 JavaScript 코드를 사용하고 있습니다.
				// 상점설정에 맞게 JavaScript 코드를 수정하여 사용하십시오.
				//
				// [1] 일반/무이자 결제여부
				// [2] 일반결제시 할부개월수
				// [3] 무이자결제시 할부개월수 설정
				// [4] 인증여부
				//////////////////////////////////////////////////////////////////////////////////////////////////////////////
				
				//////////////////////////////////////////////////////////////////////////////////////////////////////////////
				// [1] 일반/무이자 결제여부를 설정합니다.
				//
				// 할부판매의 경우 구매자가 이자수수료를 부담하는 것이 기본입니다. 그러나,
				// 상점과 올더게이트간의 별도 계약을 통해서 할부이자를 상점측에서 부담할 수 있습니다.
				// 이경우 구매자는 무이자 할부거래가 가능합니다.
				//
				// 예제)
				// 	(1) 일반결제로 사용할 경우
				// 	form.DeviId.value = "9000400001";
				//
				// 	(2) 무이자결제로 사용할 경우
				// 	form.DeviId.value = "9000400002";
				//
				// 	(3) 만약 결제 금액이 100,000원 미만일 경우 일반할부로 100,000원 이상일 경우 무이자할부로 사용할 경우
				// 	if(parseInt(form.Amt.value) < 100000)
				//		form.DeviId.value = "9000400001";
				// 	else
				//		form.DeviId.value = "9000400002";
				//////////////////////////////////////////////////////////////////////////////////////////////////////////////
				
				form.DeviId.value = "9000400001";
				
				//////////////////////////////////////////////////////////////////////////////////////////////////////////////
				// [2] 일반 할부기간을 설정합니다.
				// 
				// 일반 할부기간은 2 ~ 12개월까지 가능합니다.
				// 0:일시불, 2:2개월, 3:3개월, ... , 12:12개월
				// 
				// 예제)
				// 	(1) 할부기간을 일시불만 가능하도록 사용할 경우
				// 	form.QuotaInf.value = "0";
				//
				// 	(2) 할부기간을 일시불 ~ 12개월까지 사용할 경우
				//		form.QuotaInf.value = "0:3:4:5:6:7:8:9:10:11:12";
				//
				// 	(3) 결제금액이 일정범위안에 있을 경우에만 할부가 가능하게 할 경우
				// 	if((parseInt(form.Amt.value) >= 100000) || (parseInt(form.Amt.value) <= 200000))
				// 		form.QuotaInf.value = "0:2:3:4:5:6:7:8:9:10:11:12";
				// 	else
				// 		form.QuotaInf.value = "0";
				//////////////////////////////////////////////////////////////////////////////////////////////////////////////
				
				//결제금액이 5만원 미만건을 할부결제로 요청할경우 결제실패
				if(parseInt(form.Amt.value) < 50000)
					form.QuotaInf.value = "0";
				else
					form.QuotaInf.value = "0:2:3:4:5:6:7:8:9:10:11:12";
				
				//////////////////////////////////////////////////////////////////////////////////////////////////////////////
				// [3] 무이자 할부기간을 설정합니다.
				// (일반결제인 경우에는 본 설정은 적용되지 않습니다.)
				// 
				// 무이자 할부기간은 2 ~ 12개월까지 가능하며, 
				// 올더게이트에서 제한한 할부 개월수까지만 설정해야 합니다.
				// 
				// 100:BC
				// 200:국민
				// 300:외환
				// 400:삼성
				// 500:엘지
				// 600:신한
				// 800:현대
				// 900:롯데
				// 
				// 예제)
				// 	(1) 모든 할부거래를 무이자로 하고 싶을때에는 ALL로 설정
				// 	form.NointInf.value = "ALL";
				//
				// 	(2) 국민카드 특정개월수만 무이자를 하고 싶을경우 샘플(2:3:4:5:6개월)
				// 	form.NointInf.value = "200-2:3:4:5:6";
				//
				// 	(3) 외환카드 특정개월수만 무이자를 하고 싶을경우 샘플(2:3:4:5:6개월)
				// 	form.NointInf.value = "300-2:3:4:5:6";
				//
				// 	(4) 국민,외환카드 특정개월수만 무이자를 하고 싶을경우 샘플(2:3:4:5:6개월)
				// 	form.NointInf.value = "200-2:3:4:5:6,300-2:3:4:5:6";
				//	
				//		(5) 무이자 할부기간 설정을 하지 않을 경우에는 NONE로 설정
				//		form.NointInf.value = "NONE";
				//
				//		(6) 전카드사 특정개월수만 무이자를 하고 싶은경우(2:3:6개월)
				//		form.NointInf.value = "100-2:3:6,200-2:3:6,300-2:3:6,400-2:3:6,500-2:3:6,600-2:3:6,800-2:3:6,900-2:3:6
				//
				//////////////////////////////////////////////////////////////////////////////////////////////////////////////
				
				if(form.DeviId.value == "9000400002")
					form.NointInf.value = "ALL";
				   
				if(MakePayMessage(form) == true)
				{
					Disable_Flag(form);
					
					var openwin = window.open("AGS_progress.html","popup","width=300,height=160"); //"지불처리중"이라는 팝업창연결 부분
					
					form.submit();
				}
				else
				{
					alert("지불에 실패하였습니다.");// 취소시 이동페이지 설정부분
				}
			}
		}
	}
}

function Enable_Flag(form)
{
        form.Flag.value = "enable"
}

function Disable_Flag(form)
{
        form.Flag.value = "disable"
}

function Check_Common(form) 
{
	if(form.StoreId.value == "")
	{
		alert("상점아이디를 입력하십시오.");
		return false;
	}
	else if(form.StoreNm.value == "")
	{
		alert("상점명을 입력하십시오.");
		return false;
	}
	else if(form.OrdNo.value == "")
	{
		alert("주문번호를 입력하십시오.");
		return false;
	}
	else if(form.ProdNm.value == "")
	{
		alert("상품명을 입력하십시오.");
		return false;
	}
	else if(form.Amt.value == "")
	{
		alert("금액을 입력하십시오.");
		return false;
	}
	else if(form.MallUrl.value == "")
	{
		alert("상점URL을 입력하십시오.");
		return false;
	}
	
	return true;
}

-->
</script>
</head>
<!-- 주의) onload 이벤트에서 아래와 같이 javascript 함수를 호출하지 마십시오. -->
<!-- onload="javascript:Enable_Flag(frmAGS_pay);Pay(frmAGS_pay);" -->
<body topmargin=0 leftmargin=0 rightmargin=0 bottommargin=0 onLoad="javascript:Enable_Flag(frmAGS_pay);Pay(frmAGS_pay);">
<!-- <body topmargin=0 leftmargin=0 rightmargin=0 bottommargin=0 onload="javascript:Pay(frmAGS_pay);">  -->
<form name=frmAGS_pay method=post action=AGS_pay_ing.php>
<!--
1) 본 지불요청 페이지를 상점에 맞게 적절하게 수정하여 사용하십시오.<br>
2) 본 페이지에서는 올더게이트 플러그인을 다운로드하여 설치하도록 되어 있습니다. 다운로드후에  <font color=rde>보안경고창이 뜨면 확인 버튼("예")을 선택하여</font> 플러그인을 설치해 주십시오. 만약 설치에 실패하였을 경우 수동으로 <a href="http://www.allthegate.com/plugin/AGSPayPluginV10.exe">다운로드</a>하여 설치해 주십시오.<br>
3) 지불요청을 위해 필요한 정보를 모두 입력후 '지불요청'버튼을 클릭하시면 올더게이트 플러그인을 실행합니다.<br>
4) 신용카드만 사용시 꼭 <font color=blue>결제지불방법</font>을 <font color=blue><b>신용카드(전용)</b></font>으로 설정해 주십시오.<br>
5) DB 작업을 하실 경우 <font color=blue>결제성공여부(rSuccYn)</font>을 확인후에 작업하여 주십시오.<br>
6) 핸드폰 결제 사용시 올더게이트에서 발급받은[핸드폰결제아이디,비밀번호,상품코드,상품타입]을 입력하여 주십시오.
-->
<input type=hidden name=Job value="<?=$MsgTypeCode?>">
<!-- 계좌이체,핸드폰결제를 사용하지 않는 상점은 지불방법을 꼭 신용카드(전용)으로 설정하시기 바랍니다. -->
<!-- 계좌이체만 사용하도록 연동 <input type=hidden name=Job value="onlyiche"> -->
<!-- 핸드폰결제만 사용하도록 연동 <input type=hidden name=Job value="onlyhp"> -->
<!--<select name=Job style=width:120px>
<option value="" selected>선택하십시오.
<option value="card">신용카드
<option value="iche">계좌이체
<option value="hp">핸드폰결제
<option value="virtual" >가상계좌 가상계좌추가 
<option value="onlycard" >신용카드 (전용)
<option value="onlyiche">계좌이체 (전용)
<option value="onlyhp">핸드폰결제 (전용)
<option value="onlyvirtual">가상계좌 (전용)
</select>-->

<input type=hidden style=width:100px name=TempJob maxlength=20 value=""><!--  지불방법 직접입력 예) card:iche-->
<!--상점아이디를 실거래 전환후에는 발급받은 아이디로 바꾸시기 바랍니다.-->
<input type=hidden style=width:100px name=StoreId maxlength=20 value="<?=$StoreId?>">
<!--  ☞ 상점아이디 (20) -->
<input type=hidden style=width:300px name=StoreNm value="<?=$StoreNm?>">
<!--  ☞ 상점명 -->
<input type=hidden style=width:100px name=OrdNo maxlength=40 value="<?=$OrdNo?>">
<!--  ☞ 주문번호 (40) -->
<input type=hidden style=width:100px name=ProdCode maxlength=10 value="">
<!--  상품코드 (10) -->
<input type=hidden style=width:300px name=ProdNm maxlength=300 value="<?=$ProdNm?>">
<!-- ☞ 상품명 (300)  -->
<input type=hidden style=width:100px name=Amt maxlength=12 value="<?=$Amt?>">
<!--  ☞ 금액 (12) 예) 금액 콤마(,)입력불가-->
<input type=hidden style=width:100px name=UserId maxlength=20 value="<?=$txtCustNo?>">
<!--  회원아이디 (20) -->
<input type=hidden style=width:100px name=OrdNm maxlength=40 value="<?=$OrdNm?>">
<!--  주문자명 (40) -->
<input type=hidden style=width:100px name=OrdPhone maxlength=21 value="<?=$OrderContact?>">
<!--  주문자연락처 (21) -->
<input type=hidden style=width:300px name=UserEmail maxlength=50 value="<?=$email?>">
<!--  주문자이메일 (50) -->
<!-- 가상계좌추가 -->
<input type=hidden style=width:300px name=OrdAddr maxlength=100 value="<?=$OrderAddr?>">
<!--  주문자주소 (100) -->
<input type=hidden style=width:100px name=RcpNm maxlength=40 value="<?=$deliverName?>">
<!--  수신자명 (40) -->
<input type=hidden style=width:100px name=RcpPhone maxlength=21 value="<?=$deliverPhone?>">
<!-- 수신자연락처 (21)  -->
<input type=hidden style=width:300px name=DlvAddr maxlength=100 value="<?=$OrderRecAddr?>">
<!--  배송지주소 (100) -->
<input type=hidden style=width:300px name=Remark maxlength=350 value="<?=$Message?>">
<!-- 기타요구사항 (350)  -->


<!-- 주의) 상점홈페이지주소를 반드시 입력해 주십시오 -->
<!-- 미입력시 특정카드사 신용카드결제가 이뤄지지 않을 수 있습니다 -->
<input type=hidden style=width:300px name=MallUrl value="<?=$MallUrl?>">
<!-- ☞ 상점URL  예) http://www.abc.com-->

<!-- 가상계좌 결제에서 입/출금 통보를 위한 필수 입력 사항 입니다. -->
<input type=hidden style=width:300px name=MallPage value="/mall/AGS_VirAcctResult.php">
<!--  ☞ 가상계좌통보페이지 예) /mall/AGS_VirAcctResult.php-->

<!-- CP아이디를 실거래 전환후에는 발급받으신 CPID로 변경하여 주시기 바랍니다. -->
<input type=hidden style=width:100px name=HP_ID maxlength=10 value="">
<!--  CP아이디 (10) 예) 핸드폰결제-->
<!-- CP비밀번호를 실거래 전환후에는 발급받으신 비밀번호로 변경하여 주시기 바랍니다. -->
<input type=hidden style=width:100px name=HP_PWD maxlength=10 value="">
<!--  CP비밀번호 (10)예) 핸드폰결제 -->

<!-- SUB-CPID는 발급받으신 상점만 입력하여 주시기 바랍니다. -->
<input type=hidden style=width:100px name=HP_SUBID maxlength=10 value="">
<!--  SUB-CP아이디 (10) 예) 핸드폰결제-->

<!-- 판매하는 상품이 디지털(컨텐츠)일 경우 = 1, 실물(상품)일 경우 = 2 -->
<!-- 상품종류를 실거래 전환후에는 발급받으신 상품종류로 변경하여 주시기 바랍니다. -->
<input type="hidden" name="HP_UNITType" value="2">
<!--  상품종류 디지털:1 실물:2 예) 핸드폰결제-->

<!--
<a href="javascript:Pay(frmAGS_pay);"><img src="button.gif" border="0"></a>
-->

<!-- JavaScript 에서 값을 설정하는 Hidden 필드  !!수정을 하시거나 삭제하지 마십시오-->
<input type=hidden name=DeviId value="">
<input type=hidden name=QuotaInf value="0">
<input type=hidden name=NointInf value="NONE">
<!-- JavaScript 에서 값을 설정하는 Hidden 필드 -->

<!-- 올더게이트 플러그인에서 사용하는 Hidden 필드  !!수정을 하시거나 삭제하지 마십시오-->
<input type=hidden name=AuthYn value="">
<input type=hidden name=Flag value="">
<input type=hidden name=AuthTy value="">
<input type=hidden name=SubTy value="">
<input type=hidden name=CardNo value="">
<input type=hidden name=ExpMon value="">
<input type=hidden name=ExpYear value="">
<input type=hidden name=Instmt value="">
<input type=hidden name=Passwd value="">
<input type=hidden name=SocId value="">
<input type=hidden name=partial_mm value="">
<input type=hidden name=noIntMonth value="">
<input type=hidden name=ZuminCode value=""> <!-- 가상계좌추가 -->
<input type=hidden name=KVP_RESERVED1 value="">
<input type=hidden name=KVP_RESERVED2 value="">
<input type=hidden name=KVP_RESERVED3 value="">
<input type=hidden name=KVP_CURRENCY value="">
<input type=hidden name=KVP_CARDCODE value="">
<input type=hidden name=KVP_SESSIONKEY value="">
<input type=hidden name=KVP_ENCDATA value="">
<input type=hidden name=KVP_CONAME value="">
<input type=hidden name=KVP_NOINT value="">
<input type=hidden name=KVP_QUOTA value="">
<input type=hidden name=MPI_CAVV value="">
<input type=hidden name=MPI_ECI value="">
<input type=hidden name=MPI_MD64 value="">
<input type=hidden name=ICHE_OUTBANKNAME value="">
<input type=hidden name=ICHE_OUTACCTNO value="">
<input type=hidden name=ICHE_OUTBANKMASTER value="">
<input type=hidden name=ICHE_AMOUNT value="">
<input type=hidden name=HP_SERVERINFO value="">
<input type=hidden name=HP_HANDPHONE value="">
<input type=hidden name=HP_COMPANY value="">
<input type=hidden name=HP_IDEN value="">
<input type=hidden name=HP_IPADDR value="">
<input type=hidden name=VIRTUAL_CENTERCD value=""><!-- 가상계좌추가 -->
<input type=hidden name=VIRTUAL_DEPODT value=""><!-- 가상계좌추가 -->
<input type=hidden name=VIRTUAL_NO value=""><!-- 가상계좌추가 -->
<!-- 올더게이트 플러그인에서 사용하는 Hidden 필드 -->
<table align = center cellspacing=1 bordercolordark=white width="450" bgcolor=#c0c0c0 bordercolorlight=#dddddd border=0 class="s1" cellpadding="1">
  <tbody>
    <tr>
      <td height=25 align=center bgcolor='00A6A8' colspan="2"><b><font color="white"><span style="font-size:10pt;">[주문자 정보]</span></b></td>
    </tr>
    <tr  bgcolor=white height=25>
      <td width=96 bgcolor='E5F6F6'><span style="font-size:9pt;"><font color='00A6b7'>&nbsp;&nbsp;주문자</span> </td>
      <td width="347"><span style="font-size:9pt;">&nbsp;
        <?=$Sender_Name?>
        </span></td>
    </tr>
		<!--
    <tr  bgcolor=white height=25>
      <td width=96 bgcolor='E5F6F6'><span style="font-size:9pt;"><font color='00A6b7'>&nbsp;&nbsp;입금자</span> </td>
      <td width="347"><span style="font-size:9pt;">&nbsp;
        <?=$Inputer?>
        </span></td>
    </tr>    
		-->
    <tr  bgcolor=white height=25>
      <td width=96 bgcolor='E5F6F6'><span style="font-size:9pt;"><font color='00A6b7'>&nbsp;&nbsp;E-mail</span></td>
      <td width="347"><span style="font-size:9pt;">&nbsp;
        <?=$Sender_Email?>
        </span></td>
    </tr>
    <tr  bgcolor=white height=25>
      <td width=96 bgcolor='E5F6F6'><span style="font-size:9pt;"><font color='00A6b7'>&nbsp;&nbsp;전화번호</span></td>
      <td width="347"><span style="font-size:9pt;">&nbsp;
        <?=$Sender_Tel ?>
        </span></td>
    </tr>
    <tr  bgcolor=white height=25>
      <td width=96 bgcolor='E5F6F6'><span style="font-size:9pt;"><font color='00A6b7'>&nbsp;&nbsp;휴대폰</span></td>
      <td width="347"><span style="font-size:9pt;">&nbsp;
        <?=$Sender_Hand?>
        </span></td>
    </tr>
    <tr  bgcolor=white height=25>
      <td width=96 bgcolor='E5F6F6'><span style="font-size:9pt;"><font color='00A6b7'>&nbsp;&nbsp;수령인</span></td>
      <td width="347"><span style="font-size:9pt;color:red;">&nbsp;
        <?=$Re_Name?>
        </span></td>
    </tr>
    <tr  bgcolor=white height=25>
      <td width=96 bgcolor='E5F6F6'><span style="font-size:9pt;"><font color='00A6b7'>&nbsp;&nbsp;우편번호</span></td>
      <td width="347"><span style="font-size:9pt;">&nbsp;
        <?=$olist[Zip2]?>
        </span> </td>
    </tr>
    <tr  bgcolor=white height=25>
      <td width=96 bgcolor='E5F6F6'><span style="font-size:9pt;"><font color='00A6b7'>&nbsp;&nbsp;배송지주소</span></td>
      <td width="347"><span style="font-size:9pt;">&nbsp;
        <?=$Address3 . " " . $Address4?>
        </span></td>
    </tr>
    <tr  bgcolor=white height=25>
      <td width=96 bgcolor='E5F6F6'><span style="font-size:9pt;"><font color='00A6b7'>&nbsp;&nbsp;배송지전화</span> </td>
      <td width="347"><span style="font-size:9pt;">&nbsp;
        <?=$Re_Tel?>
        </span></td>
    </tr>
		
    <tr  bgcolor=white height=25>
      <td width=96 bgcolor='E5F6F6'><span style="font-size:9pt;"><font color='00A6b7'>&nbsp;&nbsp;희망배송일</span></td>
      <td width="347"><span style="font-size:9pt;">&nbsp;
        <?=date("Y-m-d",$olist[WishDate])?>
        &nbsp;</span></td>
    </tr>
		
    <tr  bgcolor=white height=25>
      <td width=96 bgcolor='E5F6F6'><span style="font-size:9pt;"><font color='00A6b7'>&nbsp;&nbsp;배송안내글</span></td>
      <td width="347"><span style="font-size:9pt;">&nbsp;
        <?=$Message?>
        &nbsp;</span></td>
    </tr>   
		<tr  bgcolor=#B9C2CC>
      <td height=25 align=center bgcolor='00A6A8' colspan="2"><b><font color="white"><span style="font-size:10pt;">[결제정보]</span></b></td>
    </tr>
		<tr  bgcolor=white height=25>
      <td width=96 bgcolor='E5F6F6'><span style="font-size:9pt;"><font color='00A6b7'>&nbsp;&nbsp;총주문금액</span> </td>
      <td width="347"><strong>&nbsp;<?=number_format($Total_Money)?> 원</strong></td>
    </tr>
    <tr  bgcolor=white height=25>
      <td width=96 bgcolor='E5F6F6'><span style="font-size:9pt;"><font color='00A6b7'>&nbsp;&nbsp;총결제금액</span> </td>
      <td width="347"><font color="703EAE"><strong>&nbsp;<?=number_format($Amt)?>

                              원</strong></font></td>
    </tr>
  </tbody>
</table><p>
<div align = center>
<input type="button" value="지불요청" onClick="javascript:Pay(frmAGS_pay);"  style="background: #ffffff; border : 1 solid : #cccccc;  border-color: #cccccc; FONT-SIZE: 9pt;FONT-FAMILY: '돋움';cursor:hand";>&nbsp;&nbsp;<input type = "button" value = "취 소 하 기"  onclick = "opener.location.replace('<?=$SITE_URL?>/<?=$CART_MAIN_FILE_NAME?>?query=step2&check=<?=$How_Buy?>&cod=<?=$cod?>'); self.close();"  style="background: #ffffff; border : 1 solid : #cccccc;  border-color: #cccccc; FONT-SIZE: 9pt;FONT-FAMILY: '돋움';cursor:hand";>
</div>
</form>

