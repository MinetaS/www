<?php
class CUpload {
	var $arrExt = Array();											// Ȯ���� �˻� (array) 
	var $strSaveDir;													// ���ε� ���丮 ����� (string)
	var $booIsOpen = 0;												// 0 ���� 1�����, ������϶� ���ε�� ���ϸ� ���� (bool)
	var $uitLimitFileSize = 1048576;								// ���ε� �뷮���� (int unsigned)
	var $arrUploadFile = Array();									 // ���ε����� (array)
	var $arrUploadFileTmp = Array();							 // tmp �� ���ε�� ���� (array)
	var $arrUploadFileName = Array();						  // ���ϸ� (array)
	var $arrUploadFileExt = Array();							  // ���� Ȯ���� (array)
	var $arrUploadFileSize = Array();							  // ���ϻ����� (array)
	var $arrComFile = Array();										  // ���ε�Ϸ�� ����(���ε��� ������ ���� ���ε����� ����) (array)
	var $arrRealFileName = Array();							  // Ŭ���̾�Ʈ�� ���ϸ� (array)
	var $arrSaveFileName = Array();							// ���ε�� ������ ���ϸ� (array)
	var $uitUploadFileNum = 0;									 // ���ε� ���� ���� (int unsigned)
	var $strErrMsg = '';												// ���� �޼��� (string)

	function CUpload ($strSaveDir, $booIsOpen=0, $arrExt=array()) {
		$this->strSaveDir = $strSaveDir;											// ����� ���丮 �����
		$this->arrExt = $arrExt;															 // ���ε� ���� Ȯ����
		$this->booIsOpen = $booIsOpen;                                        // ���ε� ����
		return true;
	}

	function checkFile() {

		$uitFileSize = 0;																							// ���� ����� 0���� ����

		for($i=0; $i<$this->uitUploadFileNum; $i++) {												// ���� ���� ��ŭ �ݺ�
			 if(is_uploaded_file($this->arrUploadFileTmp[$i])) {								// ���ε�� �������� Ȯ��
				$strExt = strtolower(substr($this->arrUploadFileName[$i],-3,3));		// Ȯ���� ����
				$arrExt = Array($strExt);																	// ����� Ȯ���� �迭�� ��ȯ
				if (sizeof($this->arrExt) != 0) {															// ���� Ȯ���ڰ� ���� ���
					$arrOkExt = array_intersect($this->arrExt,$arrExt);						// ���ؼ� ���� �͸� �Է�
				} else {																							// ���� Ȯ���ڰ� ���� ��� ��� ���ε�
					$arrOkExt = $arrExt;
				}

				if(sizeof($arrOkExt) == 0 || $strExt == 'php' || $strExt == 'htm' || $strExt == 'html' || $strExt == 'cgi') {																// ���ε尡 �Ұ����� Ȯ���� �����߻�
					$this->strErrMsg = "������ ���� ���� Ȯ���� �Դϴ�.";
					return 2;                        
				}

				$uitUpFileSize = filesize($this->arrUploadFileTmp[$i]);						// ���� ������ ����

				if($uitUpFileSize > $this->uitLimitFileSize) {										// ���ε� �뷮 �ʰ��� �����߻�
					$this->strErrMsg = "���ε� �뷮�� �ʰ��Ͽ����ϴ�.!!";
					return 3;
				}

				$uitFileSize += $uitUpFileSize;															// ���ε� ��ü ���� �뷮 �հ�
				$this->arrUploadFileExt[$i] = $strExt;												// ���ε�� ���ϵ��� Ȯ���� �迭
			 }else {
				 $this->strErrMsg = "�������� ���ε� ������ �ƴմϴ�.";
				return 1;                
			}
		}

		if($uitFileSize > $this->uitLimitFileSize) {													// �뷮 �ʰ��� �����߻�
			$this->strErrMsg = "���ε� �뷮�� �ʰ��Ͽ����ϴ�.";
			return 3;                        
		}
		return 0;
	}

	function upload($arrFile) {
		if(!is_dir($this->strSaveDir)) {																	// ���ε� ���丮 ���� üũ
			$this->strErrMsg = "���ε��� ���丮�� �������� �ʽ��ϴ�.";
			return 8;
		}

		$uitFileNum = sizeof($arrFile[tmp_name]);												// ���ε� ���ϼ� üũ

		$j = 0;
		for($i=0; $i<$uitFileNum; $i++) {																	// ���ε� �� ���� �� ��ŭ ������ ���ϸ���� ����
			if($arrFile[tmp_name][$i] != "none" && $arrFile[tmp_name][$i]) {
				$this->arrUploadFile[$j] = $arrFile;
				$this->arrUploadFileTmp[$j] = $arrFile[tmp_name][$i];
				$this->arrUploadFileName[$j] = $arrFile[name][$i];
				$this->arrUploadFileSize[$j] = $arrFile[size][$i];
				$j++;
			}
		}     

		if($j == 0) {																								// ���ε� �� ������ ���� ���
			$strErrMsg = '���ε��� ������ �������� �ʽ��ϴ�.';
			return 4;
		}else {
			$this->uitUploadFileNum = $j;																// ���ε� �� ���� ���� ����
		}

		$uitIsOk = $this->checkFile();																	// ���ε� ���ɿ��� üũ(Ȯ����, ������)
		if($uitIsOk > 0) {																						// ���ε� üũ���� ������ ������...
			return $uitIsOk;
		}

		$this->setFileName();																				// ������ �ø� �̸� ���� ���ε�� ������ ����� �̸��� ������, ������� �̸��� �����

		$k = 0;
		for($i=0; $i<$j; $i++) {																				// �������� ���ε�
			if(!move_uploaded_file($this->arrUploadFileTmp[$i],$this->strSaveDir.$this->arrSaveFileName[$i])) {
				return $this->delUploadFile();															// ���ε� ���н� ������ ���ε�� ������ ����
			}else {
				chmod ($this->strSaveDir.$this->arrSaveFileName[$i], 0606);
				$this->arrComFile[$k] = $this->arrSaveFileName[$i];						//���ε� ������ ������ �迭, ���� ������ �����ϰ�� ����
				$k++;
			}
		}
		return 0;																									// ���ε� ����
	}


	function setFileName() {
		$arrName = Array();
		$arrRealFileName = Array();

		for($i=0; $i<$this->uitUploadFileNum; $i++) {																
			$j = $i+1;
			$strExt = strtolower(substr($this->arrUploadFileName[$i],-3,3));							// Ȯ����
			$arrRealFileName[$i] = $this->arrUploadFileName[$i];						// ���ϸ�
			if($this->booIsOpen == 1) {																					// ������϶� ������ �̸� ����
				$arrName[$i] = $j.'_'.time().(int)(microtime() *1000).'_'.$strExt;
				while(file_exists($this->strSaveDir.$arrName[$i])) {										// ���ϸ��� �ߺ��� ���
					$arrName[$i] = $j.'_'.time().(int)(microtime() *1000).'_'.$strExt; 
				}
			}else {																													// ������ ���� �̸� ����
				$arrName[$i] = $this->arrUploadFileName[$i];
				if(file_exists($this->strSaveDir.$arrName[$i])) {
					$arrName[$i] = time().'_'.$this->arrUploadFileName[$i];		// �ߺ��� ��� �ð��� �߰�
				}
			}
			@clearstatcache();
		}
		$this->arrRealFileName = $arrRealFileName;															// Ŭ���̾�Ʈ ���ϸ�� ������ ���� ���ϸ��� ����
		$this->arrSaveFileName = $arrName;
		return $arrName;
	}

	function delUploadFile() {
		$uitIsDel = 5;
		for($i=0; $i<sizeof($this->arrComFile); $i++) {														// ���ε尡 �Ϸ�� ���� �� ��ŭ �ݺ��ؼ� ����
			$uitIsDel = @unlink($this->strSaveDir.$this->arrComFile[$i]);
			if(!$uitIsDel) {
				$uitIsDel = 6;
			}
		}
		return $uitIsDel;
	}

	function getRealFileName () {
		$strRealFileName = '';
		foreach ($this->arrRealFileName as $val) {															// Ŭ���̾�Ʈ�� ���ϸ��� ������(|)�� �����Ͽ� ���ڿ��� ��ȯ
			$strRealFileName .= $val . "|";
		}
		return $strRealFileName;
	}
	function getSaveFileName () {
		$strSaveFileName = '';
		foreach ($this->arrSaveFileName as $val) {														// ������ ���� ���ϸ��� ������(|)�� �����Ͽ� ���ڿ��� ��ȯ
			$strSaveFileName .= $val . "|";
		}
		return $strSaveFileName;
	}
	function getFileSize () {
		$strFileSize = '';
		foreach ($this->arrUploadFileSize as $val) {													// ���� ����� ������(|)�� �����Ͽ� ���ڿ��� ��ȯ
			$strFileSize .= $val . "|";
		}
		return $strFileSize;
	}
}
?>