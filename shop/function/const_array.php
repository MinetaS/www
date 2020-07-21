<?
//const_array.php�� ��ι����� �ذ��ϱ� ���ؼ�
$MALL_SETTING_PATH = str_replace("/function/const_array.php","", realpath(__FILE__));



############################################################################
# ����Ʈ ���� �ð�
############################################################################
if(file_exists( $MALL_SETTING_PATH. "/config/start_time.php"))
	include_once $MALL_SETTING_PATH.  "/config/start_time.php";

// ����Ʈ ���� ��ȣ
$SiteKey = "fsec";


// ���NickName�� System_Member������ �ҷ����� �ʴ´�..��ø�Ǳ⶧�ȿ�
//echo $MALL_SETTING_PATH. "/config/membernickname_info.php";
if(file_exists( $MALL_SETTING_PATH. "/config/membernickname_info.php") && $THEME != "System_Member" )
	include_once $MALL_SETTING_PATH . "/config/membernickname_info.php";

#��ǰ�ʵ����
if(file_exists( $MALL_SETTING_PATH. "/config/OptionName.php"))
	include_once $MALL_SETTING_PATH . "/config/OptionName.php";

##################################################################################################################
# ���� ������ ����
##################################################################################################################

if(file_exists( $MALL_SETTING_PATH. "/function/banip.php"))
	include_once $MALL_SETTING_PATH . "/function/banip.php";

############################################################################
# ���̺� �̸�
############################################################################

$BANNER_TABLE_NAME = "fsec_Banner"; // ��� ���̺�
$COUNTER_IP_TABLE_NAME = "fsec_Counter_Ip"; // ī���� IP ���̺�
$COUNTER_MAIN_TABLE_NAME = "fsec_Counter_Main"; // ī���� MAIN ���̺�
$COUNTER_REFERER_TABLE_NAME = "fsec_Counter_Referer"; // ī���� REFERER ���̺�
$POPUP_TABLE_NAME = "fsec_Popup"; // �˾�â ���̺�
$BUYER_TABLE_NAME = "fsec_Buyers"; // ������ ���̺�
$CATEGORY_TABLE_NAME = "fsec_Category"; //ī�װ� ���̺�
$CONTENT_TABLE_NAME = "fsec_Content"; // ������ ������ ���̺�
$EVALUATION_TABLE_NAME = "fsec_Evalu"; // ��ǰ�� ���̺�
$INQUIRY_TABLE_NAME = "fsec_Inquire"; // ���� ���̺�
$LOGIN_HISTORY_TABLE_NAME = "fsec_LoginHistory"; // �α��� �����丮 ���̺�
$MALL_TABLE_NAME = "fsec_Mall"; // ���θ� ���� ���̺�
$MEMBER_TABLE_NAME = "fsec_Members"; // ȸ�� ���̺�
$MEMO_TABLE_NAME = "fsec_Memo"; // ���� ���̺�
$PARTNER_TABLE_NAME = "fsec_Partner"; // ��Ʈ�� ���̺�(��۰��� , �ŷ�ó ���� )
$PERMISSION_TABLE_NAME = "fsec_Auth"; // ������ ���� ���̺�
$POINT_TABLE_NAME = "fsec_Point"; // ����Ʈ ���̺�
$POLL_TABLE_NAME = "fsec_Poll" ; // ��ǥ ���̺�
$DIARY_TABLE_NAME = "fsec_Diary"; // ���� ���̺�
$RECOMMAND_TABLE_NAME = "fsec_Recommand"; // ��õ ���̺�
$SCRAP_TABLE_NAME = "fsec_Scrap"; // ��ũ�� ���̺�
$BOARD_GROUP_TABLE_NAME = "fsec_Table_Grp"; // �Խ��� �׷� ���̺�
$BOARD_MAIN_TABLE_NAME = "fsec_Table_Main"; // �Խ��� ���� ���̺�
$WISHLIST_TABLE_NAME = "fsec_Wish"; // ���ø���Ʈ ���̺�
$DEFAULT_TABLE_NAME = "fsec_Table"; // �Խ��� ���̺� PREFIX ���̺�
$CO_BUY_TABLE_NAME = "fsec_CoBuy"; // �������� ���̺�
$SMS_TABLE_NAME = "fsec_SMS"; // SMS ���̺�

############################################################################
# �����̸�
############################################################################

$STOCK_FOLDER_NAME = "stock";// ��ǰ �̹��� ���ε� ����
$BOARD_FOLDER_NAME = "board";// �Խ��� ����
$MEMBER_FOLDER_NAME = "member";// ȸ�� ����
$MEMBER_TEMP_FOLDER_NAME = "member_tmp";// ȸ�� �ӽ� ���� ����
$SKIN_FOLDER_NAME = "skin" ; // ��Ų ����

############################################################################
# ���� �̸�
############################################################################

$BOARD_MAIN_FILE_NAME = "board.php";// �Խ��� ���� �̸�
$MEMBER_MAIN_FILE_NAME = "member.php";// ȸ�� ���� �̸�
$HTML_MAIN_FILE_NAME = "html.php";// html ���� �̸�
$CART_MAIN_FILE_NAME = "bag.php";// ��ٱ��� ���� �̸�
$MART_MAIN_FILE_NAME = "mart.php";// ��Ʈ ���� �̸�
$SEARCH_MAIN_FILE_NAME = "search.php"; // �˻� ���� �̸�
$ONLINE_CAL_MAIN_FILE_NAME = "calcu.php"; // �¶��� ���� ���� �̸�
$CO_BUY_MAIN_FILE_NAME = "coorbuy.php"; // ���� ���� ���� �̸�

############################################################################
# ������ ������ ���� �迭
############################################################################

$ADMIN_MENU_CODE_ARRAY = array(
//	"A" => array(// �⺻ȯ��
		"A001" => "System_Basic" ,
		"A002" => "System_Payment" ,
		"A003" => "System_Skin" ,
		"A004" => "System_Email_Content" ,
		"A005" => "System_Info" ,
		"A006" => "System_Info_Insert" ,
		"A007" => "System_Member" ,
		"A008" => "System_Board" ,
		"A009" => "System_Partner" ,
		"A010" => "System_Auth" ,
		"A011" => "System_MainBanner" ,
		"A012" => "System_SMS" ,
		"A015" => "System_Sql" ,
		"A016" => "System_PHPINFO"  ,

//	),
//	"B" => array(// ��ǰ����
		"B001" => "CategoryManager" ,
		"B002" => "Brand" ,
		"B003" => "Product" ,
		"B004" => "ProductList" ,
		"B005" => "ProductPriceList" ,
		"B006" => "ProductSoldOutList" ,
		"B007" => "ProductTrashList" ,
		"B008" => "ProductWishList" ,
		"B009" => "ProductEstimate" ,
//	),
//	"C" => array(// �ֹ���۰���
		"C001" => "OrderList" ,
		"C002" => "OrderView" ,
		"C003" => "OrderCompleteList" ,
		"C004" => "OrderReturnList" ,
//	),
//	"D" => array(// ȸ������
		"D001" => "MemberList" ,
		"D002" => "MemberView" ,
		"D003" => "MemberAgeList" ,
		"D004" => "MemberAreaList" ,
		"D005" => "Member" ,
		"D006" => "MemberLoginList" ,
//	),
//	"E" => array(// ���ϸ�����
		"E001" => "MailSend" ,
//	),
//	"F" => array(// �Խ��ǰ���
		"F001" => "GroupManager" ,
		"F002" => "BoardManager",
//	),
//	"G" => array(// �湮����躸��
		"G001" => "VisitorLog" ,
//	),
//	"H" => array(// ����/���м�
		"H001" => "Product_Statistic1" ,
		"H002" => "Product_Statistic2" ,
		"H003" => "Product_Statistic3" ,
//	),
//	"I" => array(// ���ǰ���
		"I001" => "Customer_InquiryList" ,
//	),
//	"J" => array(// ��Ÿ����
		"J001" => "Popup" ,
		"J002" => "Popup_pop" ,
		"J003" => "Poll" ,
		"J004" => "Diary"

//	)

);

//�޴��� ���Ѽ���
$ADMIN_MENU_NAME_ARRAY = array(
		"A001" => "�⺻ȯ�漳��" ,
		"A002" => "����ȯ�漳�� " ,
		"A003" => "����Ų���� " ,
		"A004" => "���ϳ��뼳��" ,
		"A005" => "����Ʈ���뼳��" ,
		"A006" => "����Ʈ�����Է�" ,
		"A007" => "ȸ������" ,
		"A008" => "�Խ���ȯ�漳��" ,
		"A009" => "�ŷ�ó����" ,
		"A010" => "�����ڱ��Ѽ���" ,
		"A011" => "���ν�Ų�̹�������" ,
		"A012" => "SMS ����" ,
		"A015" => "phpMyAdmin" ,
		"A016" => "phpinfo()" ,


		"B001" => "����Ʈ ī�װ�����" ,
		"B002" => "�귣�����" ,
		"B003" => "��ǰ�űԵ��" ,
		"B004" => "��ǰ����Ʈ" ,
		"B005" => "��ǰ�����ϰ�����" ,
		"B006" => "ǰ����ǰ����" ,
		"B007" => "��ǰ������" ,
		"B008" => "���ø���Ʈ��ǰ" ,
		"B009" => "��ǰ�����" ,

		"C001" => "�ֹ� �� ��ۻ�ǰ" ,
		"C002" => "�ֹ� �� ��ۺ���" ,
		"C003" => "�ֹ��Ϸ��ǰ" ,
		"C004" => "�ݼۻ�ǰ" ,

		"D001" => "ȸ������" ,
		"D002" => "ȸ����������" ,
		"D003" => "ȸ�����ɺм�" ,
		"D004" => "���������м�" ,
		"D005" => "ȸ������" ,
		"D006" => "ȸ����������" ,

		"E001" => "���Ϲ߼��ϱ�" ,

		"F001" => "�Խ��Ǳ׷����" ,
		"F002" => "�Խ��ǰ���" ,

		"G001" => "�湮����躸��" ,


		"H001" => "��ǰ/�Ǹ� ���" ,
		"H002" => "�������� ���" ,
		"H003" => "���Ű��� ���" ,


		"I001" => "������ ����" ,

		"J001" => "�˾�â����" ,
		"J002" => "�˾�â���" ,
		"J003" => "��ǥ����" ,
		"J004" => "��������"

);

############################################################################
# �ҽ����� ����/ ���ڸ� �Է�
############################################################################

$SOURCE_PROTECTION_CODE = " oncontextmenu='return false' onselectstart='return false' ondragstart='return false' ";
$ONLY_NUMBER_STYLE = "onkeyPress='if ((event.keyCode<48) || (event.keyCode>57)) event.returnValue=false;' style = 'ime-mode:disabled;'" ;

############################################################################
# ����Ʈ���� ����
############################################################################

$COMPANY_DESCRIPTION = array(
	"company" => "ȸ��Ұ�" ,
	"agreement" => "ȸ�� �������" ,
	"privacy" => "���κ�ȣ��å" ,
	"guide" => "�̿�ȳ�" ,
	"delivery" => "��� �����ȳ�"  ,
	"exchange" => "��ȯ ȯ�Ҿȳ�" ,
	"yakdo" => "ã�ƿ��ô±�"  ,
	"sitemap" => "����Ʈ��"
);

############################################################################
# ���ϳ��뼳��
############################################################################

$MAIL_DESCRIPTION = array(
	"MAIL_CODE_01" => "ȸ������" ,
	"MAIL_CODE_02" => "���̵���ã��" ,
	"MAIL_CODE_03" => "��ǰ��õ" ,
	"MAIL_CODE_04" => "��������"  ,
	"MAIL_CODE_05" => "�ֹ��Ϸ�"

);


############################################################################
# �Խ���ȯ�漳��
############################################################################

$BOARD_CONFIG_TITLE = array(
	"01" => "�Խ��� �⺻ȯ�� , ����Ʈ , �� ����" ,
	"02" => "�Խ��� ���� , ����Ʈ , ī�װ�����"
);


############################################################################
# ȸ�� ���� �迭
############################################################################
// ���� �ڵ�
$COUNTRY_CODE_ARRAY = array("AL"=>"Albania","DZ"=>"Algeria","AS"=>"American Samoa","AD"=>"Andorra","AO"=>"Angola","AI"=>"Anguilla","AQ"=>"Antarctica",
"AG"=>"Antigua And Barbuda","AR"=>"Argentina","AM"=>"Armenia","AW"=>"Aruba","AU"=>"Australia","AT"=>"Austria","AZ"=>"Azerbaijan","BS"=>"Bahamas",
"BH"=>"Bahrain","BD"=>"Bangladesh","BB"=>"Barbados","BY"=>"Belarus","BE"=>"Belgium","BZ"=>"Belize","BJ"=>"Benin","BM"=>"Bermuda","BT"=>"Bhutan",
"BO"=>"Bolivia","BA"=>"Bosnia And Herzegowina","BW"=>"Botswana","BV"=>"Bouvet Island","BR"=>"Brazil","IO"=>"British Indian Ocean Territory",
"BN"=>"Brunei Darussalam","BG"=>"Bulgaria","BF"=>"Burkina Faso","BI"=>"Burundi","KH"=>"Cambodia","CM"=>"Cameroon","CA"=>"Canada",
"CV"=>"Cape Verde","KY"=>"Cayman Islands","CF"=>"Central African Republic","TD"=>"Chad","CL"=>"Chile","CN"=>"China","CX"=>"Christmas Island",
"CC"=>"Cocos (Keeling) Islands","CO"=>"Colombia","KM"=>"Comoros","CG"=>"Congo","CK"=>"Cook Islands","CR"=>"Costa Rica","CI"=>"Cote D'ivoire",
"HR"=>"CROATIA (Local Name: Hrvatska)","CU"=>"Cuba","CY"=>"Cyprus","CZ"=>"Czech Republic","DK"=>"Denmark","DJ"=>"Djibouti","DM"=>"Dominica",
"DO"=>"Dominican Republic","TP"=>"East Timor","EC"=>"Ecuador","EG"=>"Egypt","SV"=>"El Salvador","GQ"=>"Equatorial Guinea","ER"=>"Eritrea",
"EE"=>"Estonia","ET"=>"Ethiopia","FK"=>"Falkland Islands (Malvinas)","FO"=>"Faroe Islands","FJ"=>"Fiji","FI"=>"Finland","FR"=>"France",
"FX"=>"France, Metropolitan","GF"=>"French Guiana","PF"=>"French Polynesia","TF"=>"French Southern Territories","GA"=>"Gabon ","GM"=>"Gambia",
"GE"=>"Georgia","DE"=>"Germany ","GH"=>"Ghana","GI"=>"Gibraltar","GR"=>"Greece","GL"=>"Greenland","GD"=>"Grenada","GP"=>"Guadeloupe","GU"=>"Guam",
"GT"=>"Guatemala","GN"=>"Guinea","GW"=>"Guinea-Bissau","GY"=>"Guyana","HT"=>"Haiti","HM"=>"Heard And Mc Donald Islands","HN"=>"Honduras",
"HK"=>"Hong Kong","HU"=>"Hungary","IS"=>"Iceland","IN"=>"India","ID"=>"Indonesia","IR"=>"Iran (Islamic Republic Of)","IQ"=>"Iraq","IE"=>"Ireland",
"IL"=>"Israel","IT"=>"Italy","JM"=>"Jamaica","JP"=>"Japan","JO"=>"Jordan","KZ"=>"Kazakhstan","KE"=>"Kenya","KI"=>"Kiribati","KP"=>"Korea, Democratic People's Rep. Of","KR"=>"Korea, Republic Of","KW"=>"Kuwait","KG"=>"Kyrgyzstan","LA"=>"Lao People's Democratic Republic",
"LV"=>"Latvia","LB"=>"Lebanon","LS"=>"Lesotho","LR"=>"Liberia","LY"=>"Libyan Arab Jamahiriya","LI"=>"Liechtenstein","LT"=>"Lithuania",
"LU"=>"Luxembourg","MO"=>"Macau","MK"=>"Macedonia, The Former Yugoslav Rep. Of","MG"=>"Madagascar","MW"=>"Malawi","MY"=>"Malaysia","MV"=>"Maldives",
"ML"=>"Mali","MT"=>"Malta","MH"=>"Marshall Islands","MQ"=>"Martinique","MR"=>"Mauritania","MU"=>"Mauritius","YT"=>"Mayotte","MX"=>"Mexico",
"FM"=>"Micronesia, Federated States Of","MD"=>"Moldova, Republic Of","MC"=>"Monaco","MN"=>"Mongolia","MS"=>"Montserrat","MA"=>"Morocco",
"MZ"=>"Mozambique","MM"=>"Myanmar","NA"=>"Namibia","NR"=>"Nauru","NP"=>"Nepal","NL"=>"Netherlands","AN"=>"Netherlands Antilles","NC"=>"New Caledonia",
"NZ"=>"New Zealand","NI"=>"Nicaragua","NE"=>"Niger","NG"=>"Nigeria","NU"=>"Niue","NF"=>"Norfolk Island","MP"=>"Northern Mariana Islands",
"NO"=>"Norway","OM"=>"Oman","PK"=>"Pakistan","PW"=>"Palau","PA"=>"Panama","PG"=>"Papua New Guinea","PY"=>"Paraguay","PE"=>"Peru","PH"=>"Philippines",
"PN"=>"Pitcairn","PL"=>"Poland","PT"=>"Portugal","PR"=>"Puerto Rico","QA"=>"Qatar","RE"=>"Reunion","RO"=>"Romania","RU"=>"Russian Federation",
"RW"=>"Rwanda","KN"=>"Saint Kitts And Nevis","LC"=>"Saint Lucia","VC"=>"Saint Vincent And The Grenadines","WS"=>"Samoa","SM"=>"San Marino",
"ST"=>"Sao Tome And Principe","SA"=>"Saudi Arabia","SN"=>"Senegal","SC"=>"Seychelles","SL"=>"Sierra Leone","SG"=>"Singapore",
"SK"=>"Slovakia (Slovak Republic)","SI"=>"Slovenia","SB"=>"Solomon Islands","SO"=>"Somalia","ZA"=>"South Africa",
"GS"=>"S. Georgia And The S. Sandwich Islands","ES"=>"Spain","LK"=>"Sri Lanka","SH"=>"St. Helena","PM"=>"St. Pierre And Miquelon","SD"=>"Sudan",
"SR"=>"Suriname","SJ"=>"Svalbard And Jan Mayen Islands","SZ"=>"Swaziland","SE"=>"Sweden","CH"=>"Switzerland","SY"=>"Syrian Arab Republic",
"TW"=>"Taiwan","TJ"=>"Tajikistan","TZ"=>"Tanzania, United Republic Of","TH"=>"Thailand","TG"=>"Togo","TK"=>"Tokelau","TO"=>"Tonga",
"TT"=>"Trinidad And Tobago","TN"=>"Tunisia","TR"=>"Turkey","TM"=>"Turkmenistan","TC"=>"Turks And Caicos Islands","TV"=>"Tuvalu","UG"=>"Uganda",
"UA"=>"Ukraine","AE"=>"United Arab Emirates","GB"=>"United Kingdom","US"=>"United States","UM"=>"United States Minor Outlying Islands","UY"=>"Uruguay",
"UZ"=>"Uzbekistan","VU"=>"Vanuatu","VA"=>"Vatican City State (Holy See)","VE"=>"Venezuela","VN"=>"Viet Nam","VG"=>"Virgin Islands (British)",
"VI"=>"Virgin Islands (U.S.)","WF"=>"Wallis And Futuna Islands","EH"=>"Western Sahara","YE"=>"Yemen","YU"=>"Yugoslavia","ZR"=>"Zaire","ZM"=>"Zambia",
"ZW"=>"Zimbabwe");

$MEMBER_HANDPHONE_ARRAY = array("010","011","016","017","018","019","0130");
$MEMBER_PHONE_ARRAY = array("02" , "031" , "032" , "033" , "041" , "042"  , "043" , "051" , "052" , "053" , "054" , "055" , "061" , "062" , "063" , "064","0502","0504","0505","0506");
$MEMBER_EMAIL_ARRAY = array(
"chol.com" => "chol.com" ,
"daum.net" => "daum.net" ,
"dreamwiz.com" => "dreamwiz.com" ,
"empal.com" => "empal.com" ,
"freechal.com" => "freechal.com" ,
"hanafos.com" => "hanafos.com" ,
"hotmail.com" => "hotmail.com" ,
"intizen.com" => "intizen.com" ,
"kebi.com" => "kebi.com" ,
"korea.com" => "korea.com" ,
"lycos.co.kr" => "lycos.co.kr" ,
"nate.com" => "nate.com" ,
"naver.com" => "naver.com" ,
"netian.com" => "netian.com" ,
"paran.com" => "paran.com" ,
"yahoo.co.kr" => "yahoo.co.kr"
);

$MEMBER_JOB_ARRAY = array(
"01" => "����" ,
"02" => "�л�" ,
"03" => "��ǻ��/���ͳ�" ,
"04" => "���" ,
"05" => "������" ,
"06" => "�ڿ���" ,
"07" => "�ֺ�" ,
"08" => "����" ,
"09" => "����/����/�����" ,
"10" => "��/��/��/�����" ,
"11" => "������" ,
"12" => "�Ƿ���" ,
"13" => "������" ,
"14" => "������" ,
"15" => "������" ,
"16" => "����/������" ,
"17" => "�Ǽ���" ,
"18" => "������" ,
"19" => "�ε����" ,
"20" => "��۾�" ,
"21" => "ȸ���" ,
"22" => "����"
);

$MEMBER_SCHOOL_ARRAY = array(
"01" => "����" ,
"02" => "�ʵ��б�����" ,
"03" => "�ʵ��б�����" ,
"04" => "���б�����" ,
"05" => "���б�����" ,
"06" => "����б�����" ,
"07" => "����б�����" ,
"08" => "���б�����" ,
"09" => "���б�����" ,
"10" => "���п�����" ,
"11" => "���п������̻�"
);

$MEMBER_PWD_Q_ARRAY = array(

"01" => "���� ���� �� 1ȣ��?" ,
"02" => "���� �������� ģ�� �̸���?" ,
"03" => "���� �������� ������ ������?" ,
"04" => "���� ��￡ ���� ��������?" ,
"05" => "�޾Ҵ� ������ ��￡ ���� ������?" ,
"06" => "���� �����ϴ� �����?" ,
"07" => "���� �뷡�� ��â����?" ,
"08" => "���� ���� �����ϴ� ��ȭ ���ΰ���?" ,
"09" => "������ �� ��ȭ��?" ,
"10" => "���� �����ϴ� ������?" ,
"11" => "���� �����ϴ� ��������?" ,
"12" => "�����ϰ� ���� �����?" ,
"13" => "�����ϴ� ������ �� �̸���?" ,
"14" => "���� ��￡ ���� ��Ҵ�?" ,
"15" => "���� ��� �ʵ��б���?" ,
"16" => "�ٽ� �¾�� �ǰ� ���� ����?" ,
"17" => "�λ� ��� ���� å �̸���?" ,
"18" => "���� �������� ģ�� �̸���?"
);


// ȸ�� Ż�� ����..

$ARRAY_OUT_REASON = array(
"01" => "���� ���� " ,
"02" => "��۰���" ,
"03" => "���� �ٲ���"
);

// ȸ�� ���°�
$MEMBER_STATUS_ARRAY = array(
"checked" => "���λ���" ,
"hold" => "��������" ,
"bad" => "�ҷ�����" ,
"remove" => "Ż�����"
);

// ȸ�� ���ļ���
$MEMBER_SORTING_ARRAY = array (
"RegDate" => "��ϳ�¥�� ����" ,
"ID" => "���̵�� ����" ,
"Name" => "�̸��� ����" ,
"Point" => "����Ʈ�� ����" ,
"Grade" => "��޼� ����" ,
"LoginNum" => "���Ӽ� ����"  ,
"Jumin1" => "���̱��� ����"  ,
"Address1" => "�������� ����"  ,
"Sex" => "�������� ����"  ,
);

// ȸ�� �˻�����
$MEMBER_SEARCH_TITLE_ARRAY = array (
"ID" => "���̵�" ,
"Name" => "�̸�" ,
"Address1" => "�ּ�" ,
"Email" => "�̸���"
);

// Option ��ǰ �迭
$OPTION_PRODUCT_ARRAY = array(
"N" => "ǥ�þ���" ,
"�ű�" => "�ű�" , //new
"�α�" => "�α�" , //hit
"����Ʈ" => "����Ʈ" , //X
"��" => "��" , //hot
"����" => "����" ,
"����" => "��������"  //��������
);


// �̹��� ��� ������(������ ���� �Ϲ� ����� ȣȯ�� ����)
if(ereg("/manager/","$PHP_SELF")) $Option_Path_Src = "../";
else $Option_Path_Src = "./";
$OPTION_IMAGE_ARRAY = array(
"N" => "ǥ�þ���" ,
"�ű�" => "<img src = '$Option_Path_Src/${SKIN_FOLDER_NAME}/shop/$ShopSkin/images/mark_new.gif'>" , //new
"�α�" => "<img src = '$Option_Path_Src/${SKIN_FOLDER_NAME}/shop/$ShopSkin/images/mark_hit.gif'>" , //hit
"����" => "<img src = '$Option_Path_Src/${SKIN_FOLDER_NAME}/shop/$ShopSkin/images/mark_sale.gif'>" ,//����
"����" => "<img src = '$Option_Path_Src/${SKIN_FOLDER_NAME}/shop/$ShopSkin/images/mark_down.gif'>" , //��������
"����Ʈ" => "<img src = '$Option_Path_Src/${SKIN_FOLDER_NAME}/shop/$ShopSkin/images/mark_best.gif'>" , //����Ʈ
"��" => "<img src = '$Option_Path_Src/${SKIN_FOLDER_NAME}/shop/$ShopSkin/images/mark_hot.gif'>" , //��
"NONE" => "<img src = '$Option_Path_Src/${SKIN_FOLDER_NAME}/shop/$ShopSkin/images/mark_none.gif'>"  // ǰ��
);

// ��ǰ ���� �迭

$PRODUCT_SORTING_ARRAY = array (
"" => "��ǰ�����ϱ�" ,
"Ranking" => "������ ����" ,
"UID" => "��ϼ� ����" ,
"WDate" => "������ ����" ,
"Price" => "���ݼ� ����" ,
"Hit" => "��ȸ�� ����" ,
"Input" => "����� ����" ,
"OutPut" => "�Ǹż� ����" ,
"Point" => "����Ʈ�� ����"
);

// �ֹ� ����
$ORDER_STATUS_ARRAY = array(
"10" => "�ֹ�����" ,
"20" => "�Ա�Ȯ��" ,
"30" => "����غ�" ,
"40" => "�����" ,
"50" => "��ۿϷ�" ,
"60" => "��ȯȯ��"
);

// �ֹ� ��� ����
$ORDER_SORT_ARRAY = array(
"Total_Money" => "���űݾ׼�����" ,
"Address1" => "������������" ,
"How_Buy" => "������ı���" ,
"ID" => "(��)ȸ������ "
);


// ���� ���
$ORDER_METHOD_ARRAY = array(
"bank" => "�������Ա�" ,
"card" => "�ſ�ī�����" ,
"hand" => "�ڵ�������" ,
"autobank" => "������ü����" ,
"escrow" => "����ũ�ΰ���"
//"coupon" => "��������" ,
);

// ���� �κ� �迭 ó��
// ���Ǹ� �߰� �ϽǼ� �ֽ��ϴ�. "INQ2" => "AS ���� "
$COSTOMER_CODE_ARRAY = array(
"INQ1" => "������ ����"
);


// ī�װ� (�⺻ M)
$CATEGORY_ARRAY = array(
"M" => "����Ʈ"
);

// ��ǥ �迭
$POLL_ARRAY = array(
"POLL1" => "�Ϲ���ǥ",
"POLL2" => "�̺�Ʈ��ǥ"
);


// �ŷ�ó �迭
$COMPANY_TYPE_ARRAY = array(
"S" => "���޾�ü" ,
"D" => "��۾�ü" ,
"M" => "������ü" ,
"P" => "PG��"
);

?>
