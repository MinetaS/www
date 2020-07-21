<?
// ###################################################################################
//
//   log.php
//
//   Copyright (c) 2004 BANKWELL Co. LTD.
//   All rights reserved.
//
// ###################################################################################
//
//	Log ������ ó���ϴ� ���
//
// ###################################################################################
//
// ============= Input ���� ==========================================================
// strModule   : Module Name
// strFunction : Function Name
// strLogMsg   : Logging �� ����
// ===================================================================================

function TraceLog( $strModule, $strFunction, $strLogMsg )
{
	include "config.php";

	$ForReading   = 1;
	$ForWriting   = 2;
	$ForAppending = 8;

	if ( ! $LOG_FLAG ) return;

	//***************************************************************************
	// Log File ����
	//***************************************************************************
	if ( empty($LOG_PATH) ) $LOG_PATH = ".";

	$strLogFile = $LOG_PATH."/".$strModule."_".f_Now_Date().".txt";

	//*************************************************************************
	// Logging �� Record ����
	//*************************************************************************
	$strRecord = "";
	$strRecord .= "[".f_Now_Time()."] ";
	$strRecord .= PadR($strFunction,18);
	$strRecord .= ": $strLogMsg \n";

	//*************************************************************************
	// ȭ�Ͽ� Logging
	//*************************************************************************
	//Set fs = CreateObject("Scripting.FileSystemObject")
    	//Set f = fs.OpenTextFile(strLogFile, ForAppending, True)
	//f.WriteLine(strRecord)
	//f.Close
	$fp = fopen($strLogFile, "a");
	if ( $fp )
	{
		fwrite($fp, $strRecord, strlen($strRecord));
		fclose( $fp );
	}
}

?>
