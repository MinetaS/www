<?	
	if(ereg($_SERVER['REMOTE_ADDR'] , $DENYIP)){
		js_alert_location($_SERVER['REMOTE_ADDR'] . " �����Ǵ� ����Ʈ�� �����ϽǼ� �����ϴ�.", "-1");
	}
?>