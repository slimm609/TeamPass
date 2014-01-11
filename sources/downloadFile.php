<?php
/**
 * @file          downloadFile.php
 * @author        Nils Laumaillé
 * @version       2.1.19
 * @copyright     (c) 2009-2013 Nils Laumaillé
 * @licensing     GNU AFFERO GPL 3.0
 * @link          http://www.teampass.net
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

require_once('sessions.php');
session_start();
if (!isset($_SESSION['CPM']) || $_SESSION['CPM'] != 1 || $_GET['key'] != $_SESSION['key'] || $_GET['key_tmp'] != $_SESSION['key_tmp']) {
    die('Hacking attempt...');
}

header("Content-disposition: attachment; filename=".rawurldecode($_GET['name']));
header("Content-Type: application/octet-stream");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, no-cache, no-store");
header("Expires: 0");
if (isset($_GET['pathIsFiles']) && $_GET['pathIsFiles'] == 1) {
	readfile($_SESSION['settings']['path_to_files_folder'].'/'.basename($_GET['file']));
} else {
	readfile($_SESSION['settings']['path_to_upload_folder'].'/'.basename($_GET['file']));
}
