<?php
$HEVA_CMS = "3.1.5.20130222";
session_start();
header('Expires: Sun, 13 Sep 2009 00:00:00 GMT');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache') ;

define('DEV', false);
if (DEV) {
	error_reporting(E_ALL);
	ini_set('display_errors', 'on');
	ini_set('display_startup_errors', 'on');
} else {
	error_reporting(0);
	ini_set('display_errors', 'off');
	ini_set('display_startup_errors', 'off');
}


if (!isset($_SESSION['lginin']) || $_SESSION['lginin'] == 2){exit;}			// Do not forget to add your user authorization

include("../_mysql.php");
include("../_additional.php");
	
define('DIR_SEP', '/');
mb_internal_encoding('utf-8');
date_default_timezone_set('Europe/Moscow');

$cfg['url']	= 'admin/uploads';
$cfg['root']	= $_SERVER['DOCUMENT_ROOT'] . DIR_SEP . $cfg['url'];			// http://www.yousite.com/upload/		absolute path
$cfg['quickdir'] = '';		//$cfg['quickdir'] = 'quick-folder';		// for CKEditor


$cfg['lang']	= 'en';

$cfg['thumb']['width'] 	= 110;
$cfg['thumb']['height']	= 110;
$cfg['thumb']['quality']	= 85;
$cfg['thumb']['cut']		= true;
$cfg['thumb']['auto']	= true;
$cfg['thumb']['dir']		= '_thumb';
$cfg['thumb']['date']	= "j.m.Y, H:i";

$cfg['hide']['file']	= array('.htaccess');
$cfg['hide']['folder']	= array('.', '..', $cfg['thumb']['dir'], '.svn', '.cvs');

$cfg['chmod']['file']		= 0777;
$cfg['chmod']['folder']	= 0777;

$cfg['deny'] = array(
	'file'		=> array('php','php3','php4','php5','phtml','asp','aspx','ascx','jsp','cfm','cfc','pl','bat','exe','dll','reg','cgi'),
	'flash'		=> array(),
	'image'	=> array(),
	'media'	=> array(),

	'folder'	=> array(
			$cfg['url'] . DIR_SEP . 'file',
			$cfg['url'] . DIR_SEP . 'flash',
			$cfg['url'] . DIR_SEP . 'image',
			$cfg['url'] . DIR_SEP . 'media')
);

$cfg['allow'] = array(
	'file'		=> array('7z', 'aiff', 'asf', 'avi', 'bmp', 'csv', 'doc', 'fla', 'flv', 'gif', 'gz', 'gzip', 'jpeg', 'jpg', 'mid', 'mov', 'mp3', 'mp4', 'mpc', 'mpeg', 'mpg', 'ods', 'odt', 'pdf', 'png', 'ppt', 'pxd', 'qt', 'ram', 'rar', 'rm', 'rmi', 'rmvb', 'rtf', 'sdc', 'sitd', 'swf', 'sxc', 'sxw', 'tar', 'tgz', 'tif', 'tiff', 'txt', 'vsd', 'wav', 'wma', 'wmv', 'xls', 'xml', 'zip', 'chm'),
	'flash'		=> array('swf', 'flv'),
	'image'	=> array('jpg', 'jpeg', 'gif', 'png', 'bmp'),
	'media'	=> array('aiff', 'asf', 'avi', 'bmp', 'fla', 'flv', 'gif', 'jpeg', 'jpg', 'mid', 'mov', 'mp3', 'mp4', 'mpc', 'mpeg', 'mpg', 'png', 'qt', 'ram', 'rm', 'rmi', 'rmvb', 'swf', 'tif', 'tiff', 'wav', 'wma', 'wmv')
);


$cfg['nameRegAllow'] = '/^[a-z0-9-_#~\$%()\[\]&=]+/i';

//	------------------
$cfg['url']	= trim($cfg['url'], '/\\');
$cfg['root']	= rtrim($cfg['root'], '/\\') . DIR_SEP;

$dir = isset($_POST['dir'])? urldecode($_POST['dir']) : '';
$dir = trim($dir, '/\\') . DIR_SEP;

$rpath = str_replace('\\', DIR_SEP, realpath($cfg['root'] . $dir) . DIR_SEP);
if (false === strpos($rpath, str_replace('\\', DIR_SEP, $dir))) {$dir = '';}


$mode = isset($_GET['mode'])? $_GET['mode'] : 'getDirs';
$cfg['type']	= isset($_POST['type'])? $_POST['type'] : (isset($_GET['type']) && 'QuickUpload' == $mode? $_GET['type'] : 'file');
$cfg['sort']	= isset($_POST['sort'])? $_POST['sort'] : 'name';

$cfg['type'] = strtolower($cfg['type']);

$reply = array(
	'dirs'		=> array(),
	'files'		=> array()
);

//	------------------

require_once 'lib.php';
if($mode == 'QuickUpload'){
		switch ($cfg['type']) {
			case 'file':
			case 'flash':
			case 'image':
			case 'media':
				$dir = $cfg['type'];
				break;
			default:
				exit;		//	exit	for not supported type
				break;
		}
		if (!is_dir(is_dir($toDir = $cfg['root'] . $dir . DIR_SEP . $cfg['quickdir']))) {
			mkdir($toDir, $cfg['chmod']['folder']);
		}

		if (0 == ($_FILES['upload']['error'])) {
			$fileName = getFreeFileName($_FILES['upload']['name'], $toDir);
			if (strpos(strtolower($_FILES['upload']['name']), "php")=== false && move_uploaded_file($_FILES['upload']['tmp_name'], $toDir . DIR_SEP . $fileName)) {
				if($additional[39]==1){
					$fileimg = $toDir . DIR_SEP . $fileName;
					$size = getimagesize($fileimg);
					$height = $size[1];
					$width = $size[0];
					$imageType = $size[2];
					$imageType = image_type_to_mime_type($imageType);
					switch($imageType){
						case "image/gif":
							$imgnow=imagecreatefromgif($fileimg);
						break;
						case "image/pjpeg":
						case "image/jpeg":
						case "image/jpg":
							$imgnow=imagecreatefromjpeg($fileimg);
						break;
						case "image/png":
						case "image/x-png":
							$imgnow=imagecreatefrompng($fileimg);
							imagesavealpha($imgnow, true);
						break;
					}
					$stamp = imagecreatefrompng('../../'.$additional[40]);
					$size2 = getimagesize('../../'.$additional[40]);
					$height2 = $size2[1];
					$width2 = $size2[0];
					$k = 1;
					if($width<$width2)
						$kw = $width/$width2;
					if($height<$height2)
						$kh = $height/$height2;
					if($width<$width2 || $height<$height2)
						$k = $k>$kw?$kw:($k>$kh?$kh:$k);
					imagecopyresampled($imgnow, $stamp, ($width-$k*$width2)/2, ($height-$k*$height2)/2, 0, 0, $k*$width2, $k*$height2, $width2, $height2);
					imagepng($imgnow, $fileimg);
					imagedestroy($newimg);
				}
				$fileimg = $toDir . DIR_SEP . $fileName;
				$size = getimagesize($fileimg);
				$height = $size[1];
				$width = $size[0];
				$max = $additional[29]==1?980:696;
				if($height > $max || $width > $max){
					$imageType = $size[2];
					$imageType = image_type_to_mime_type($imageType);
					switch($imageType){
						case "image/gif":
							$imgnow=imagecreatefromgif($fileimg);
						break;
						case "image/pjpeg":
						case "image/jpeg":
						case "image/jpg":
							$imgnow=imagecreatefromjpeg($fileimg); 
						break;
						case "image/png":
						case "image/x-png":
							$imgnow=imagecreatefrompng($fileimg); 
						break;
					}
					$k = max($height/$max, $width/$max);
					$newimg2 = imagecreatetruecolor($width/$k, $height/$k);
					imagecopyresampled($newimg2, $imgnow, 0, 0, 0, 0, $width/$k, $height/$k, $width, $height);
					$fileName = str_replace(".", "_small.", $fileName);
					switch($imageType){
						case "image/gif":
							imagegif($newimg2, $toDir . DIR_SEP . $fileName);
						break;
						case "image/pjpeg":
						case "image/jpeg":
						case "image/jpg":
							imagejpeg($newimg2, $toDir . DIR_SEP . $fileName, 95);
						break;
						case "image/png":
						case "image/x-png":
							imagepng($newimg2, $toDir . DIR_SEP . $fileName);
						break;
					}
				}
				$result = "<script type=\"text/javascript\">window.parent.CKEDITOR.tools.callFunction(1, '/". $cfg['url'] . '/' . $dir . '/' . (empty($cfg['quickdir'])? '' : trim($cfg['quickdir'], '/\\') . '/') . $fileName."', '');</script>";
			}
		}

		exit($result);
}

if (isset($_GET['noJson'])) {echo'<pre>';print_r($reply);echo'</pre>';exit;}
exit( json_encode( $reply ) );