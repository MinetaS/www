<?
$BOARD_TITLE_DESC = getTableName($GID , $BID);
switch($RECOMMAND){
	case "GOOD" : $Rec = "R" ; $Rec_Text = "��õ"; $RecPoint = $RecommandPoint ;  break ; 
	case "BAD" : $Rec = "NR" ; $Rec_Text = "����õ"; $RecPoint = $DelRecommandPoint ;break ; 
}
//Flag�� �۾��� ���� �۾���(BW) , �ڸ�Ʈ����(BCW) , ȸ���α���(ML) , ȸ����õ(MR) , ��õ(R) , ����(NR) ,
//       �ֹ� ����� (OF) , �ֹ���ǰ ��ǰ (OR) ,  ��ǥ������(P)
//       ���б� (BR) , �Խ��� �ٿ�ε�(BD) , ������ �Է�(SI) , �α���(L)

$result = boolInsertRecommand($BOARD_NAME , $UID , $_COOKIE[MEMBER_ID], $RECOMMAND, "BOARD");

if($result){	
		
	if(isMember() && $PointEnable == "checked"){
		// �۾������� ����Ʈ�� �ο� �Ѵ�..
		$Content = "$_COOKIE[MEMBER_ID]���� ${BOARD_TITLE_DESC} �Խ��� $UID �ۿ� ���� ${Rec_Text} ����Ʈ �ο�" ; 
		$iresult = boolInsertPoint($BOARD_NAME , $LIST[ID] , $_COOKIE[MEMBER_ID] , $RecPoint , $Rec ,$Content);
		if(!$iresult) js_alert("����Ʈ �ο� ����");
	}
	
	js_alert_location("���������� ó���Ǿ����ϴ�.","$PHP_SELF?BID=$BID&GID=$GID&mode=view&UID=$UID&CURRENT_PAGE=$CURRENT_PAGE&category=$category&sysop=$sysop&fm=$fm&BType=$BType&ListMax=$ListMax");
}

?>