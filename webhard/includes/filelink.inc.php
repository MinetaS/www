<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2003-2004
 *
 *   FileLink Functions File
 *   $Id: filelink.inc.php,v 1.1 2005/07/28 20:11:47 andrewgodwin Exp $
 *
 *   Updated June 18, 2009 - Michael Mason - Added FolderDZ code.
 */

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }

# This function creates a new FileLink
# It returns the [file]code for the link
function bh_filelink_add($filepath, $expires, $username, $email, $notify = 0) {
	# Unnecesarily compicated random code generator
	$filecoderows = array(1,2,3);
	while (!empty($filecoderows)) {
		//srand(microtime()*rand()*10002348);
		$filecode = md5(rand(4,917529843)).md5(rand(rand(0,184284),rand(38792423,23847924)));
		$filecoderows = select_bhdb("filecodes", array("filecode"=>$filecode), "");
	}
	insert_bhdb("filecodes", array("filecode"=>$filecode, "filepath"=>$filepath, "expires"=>$expires, "username"=>$username, "email"=>$email, "notify"=>$notify));
	return $filecode;
}

#This function creates a folder DZ
#It'll return the folderCode
function bh_folderDZ_add($filepath, $expires, $username, $email, $notify = 0, $quota = 0) {
	# Unnecesarily compicated random code generator
	$filecoderows = array(1,2,3);
	//srand(microtime()*rand()*10002348);
	while (!empty($filecoderows)) {
		$filecode = md5(rand(4,917529843)).md5(rand(rand(0,184284),rand(38792423,23847924)));
		$filecoderows = select_bhdb("folderdzcodes", array("foldercode"=>$filecode), "");
		//print_r($filecode);
		//echo "<br>";
	}
	//echo "sql";
	insert_bhdb("folderdzcodes", array("foldercode"=>$filecode, "filepath"=>$filepath, "expires"=>$expires, "username"=>$username, "email"=>$email, "notify"=>$notify, "quota"=>$quota));
	return $filecode;
}


# Removes the filelink with the specified code
function bh_filelink_remove($filecode) {
	delete_bhdb("filecodes", array("filecode"=>$filecode), "");
}

function bh_folderDZlink_remove($filecode) {
	delete_bhdb("folderdzcodes", array("foldercode"=>$filecode), "");
}

# Removes all expired filelink codes
function bh_filelink_remove_expired() {
	$filecoderows = select_bhdb("filecodes", "", "");
	foreach ($filecoderows as $filecoderow) {
		if ($filecoderow['expires'] < time()) {
			bh_filelink_remove($filecoderow['filecode']);
		}
	}
}

function bh_folderDZ_remove_expired() {
	$filecoderows = select_bhdb("folderdzcodes", "", "");
	foreach ($filecoderows as $filecoderow) {
		if ($filecoderow['expires'] < time()) {
			bh_folderDZlink_remove($filecoderow['foldercode']);
		}
	}
}

# Tests if a certain code is valid
function bh_filelink_validate($filecode) {
	$filecoderows = select_bhdb("filecodes", array("filecode"=>$filecode), "");
	if (empty($filecoderows)) { return false; } else { return true; }
}

# Returns the filepath that the filelink points to
# Also returns false on failure, so can be used instead of bh_filelink_validate($filecode)
function bh_filelink_destination($filecode) {
	$filecoderows = select_bhdb("filecodes", array("filecode"=>$filecode), "");
	if (empty($filecoderows)) { return false; } else { return $filecoderows[0]['filepath']; }
}

# Returns the info on the drop zone
# if empty, code doesn't exist.
function bh_folderDZ_destination($foldercode) {
	$filecoderows = select_bhdb("folderdzcodes", array("foldercode"=>$foldercode), "");
	if (empty($filecoderows)) { return false; } else { return $filecoderows; }
}

# Returns a URI for the specified filecode
function bh_filelink_uri($filecode) {
	return bh_get_weburi()."filelink.php?filecode=".$filecode;
}

# Returns a URI for specified folderDZ
function bh_folderdz_uri($filecode) {
	return bh_get_weburi()."folderDZ.php?folderDZ=".$filecode;
}


# Returns if the filecode has notify set or not
function bh_filelink_get_notify($filecode) {
	$filecoderows = select_bhdb("filecodes", array("filecode"=>$filecode), "");
	if (empty($filecoderows)) { return false; } else { return $filecoderows[0]['notify']; }
}

# Returns the filecode object passed
function bh_filelink_get($filecode, $what) {
	$filecoderows = select_bhdb("filecodes", array("filecode"=>$filecode), "");
	if (empty($filecoderows)) { return false; } else { return $filecoderows[0][$what]; }
}