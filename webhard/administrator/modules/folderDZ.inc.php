<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2005
 *
 *   Module
 *   $Id: filelinks.inc.php,v 1.1 2005/07/28 20:11:47 andrewgodwin Exp $
 *
 */
 

#name File Links
#author Andrew Godwin
#description Lets the administrator delete a file link if necessary.
#iscore 1

if (!empty($_GET['deletelink'])) {
	bh_folderDZlink_remove($_GET['deletelink']);
	bh_log($bhlang['notice:filelink_deleted'], "BH_NOTICE");
}

$flinks = select_bhdb("folderdzcodes", "", "");

foreach ($flinks as $flink) {
	$filecodes[$flink['username']][$flink['email']][$flink['foldercode']] = $flink;
}


$layoutobj = new bhadminlayout("folderDZ");
$layoutobj->content1 = $filecodes;
$layoutobj->title = $bhlang['title:folderdz'];
$layoutobj->display();
