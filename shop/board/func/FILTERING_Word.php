<?
	
	$prohibit_word = explode(",",$DENYWORD);
	for($i = 0; $i < sizeof($prohibit_word) && $prohibit_word[$i]; $i++){
	//echo "\$CONTENTS = $CONTENTS <br>";
	//echo "\$prohibit_word[$i] = $prohibit_word[$i] <br>";
	
		if($CONTENTS && in_array($prohibit_word[$i],$CONTENTS)){ //���� üũ
			$prohibit_word[$i] = addslashes($prohibit_word[$i]); //��ũ��Ʈ ������ ���� ���� ���
			js_alert_location(" ���뿡 ������ �ܾ��� $prohibit_word[$i] �� \\n ���Ǿ��� ������ ���� ����� �� �����ϴ�. \\n ������ ���� �� �ٽ� �÷� �ֽñ� �ٶ��ϴ�. ","-1");		
		}
		if($SUBJECT && in_array($prohibit_word[$i],$SUBJECT)){ //���� üũ
		  $prohibit_word[$i] = addslashes($prohibit_word[$i]); //��ũ��Ʈ ������ ���� ���� ���
			js_alert_location(" ���� ������ �ܾ��� $prohibit_word[$i] �� \\n ���Ǿ��� ������ ���� ����� �� �����ϴ�. \\n ������ ���� �� �ٽ� �÷� �ֽñ� �ٶ��ϴ�. ","-1");	
		
		}		
	}
	

?>