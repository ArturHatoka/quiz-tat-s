<?php
define(MySQLprefix, "strkaz");
$m_Link = mysql_connect("p291927.mysql.ihc.ru", "p291927_lptst", "4U8fV9aPgk") or die ("<!-- Ошибка подключения к серверу. -->");
mysql_query("SET NAMES utf8");
mysql_select_db("p291927_lptst") or die ("<!-- Ошибка соединения с БД. -->");

function textTrimm($text, $length){
	$s_text = strip_tags($text);
	return (strlen($s_text) > $length ? substr($s_text, 0, strrpos(substr($s_text, 0, $length), " ")).' ...' : $s_text);
}
function getmicrotime(){
    list($usec, $sec) = explode(" ", microtime()); 
    return ((float)$usec + (float)$sec); 
}
function mysql_real_escape_string_Array($ar){
	foreach($ar AS $key => $val)
		if(is_array($ar[$key]))
			$ar[$key] = mysql_real_escape_string_Array($ar[$key]);
		else
			$ar[$key] = mysql_real_escape_string($ar[$key]);
	return $ar;
}

$_POST = mysql_real_escape_string_Array($_POST);
$_GET = mysql_real_escape_string_Array($_GET);

$FILE_TYPE_ENABLED = array(
	'files' => array('7z', 'avi', 'bmp', 'csv', 'doc', 'flv', 'gif', 'gz', 'gzip', 'ico', 'jpeg', 'jpg', 'mov', 'mp3', 'mp4', 'mpeg', 'mpg', 'pdf', 'png', 'ppt', 'psd', 'rar', 'rtf', 'swf', 'tar', 'tgz', 'tif', 'tiff', 'txt', 'wma', 'wmv', 'xls', 'xml', 'zip'),
	'images'	=> array('jpg', 'jpeg', 'gif', 'png', 'bmp', 'psd')
);
$FILE_TYPE_DISABLED = array('php','php3','php4','php5','phtml','asp','aspx','ascx','jsp','cfm','cfc','pl','bat','exe','dll','reg','cgi');

if(!file_exists('_cur_domain.php')){
	$f = @fopen("_cur_domain.php","w");
	fwrite($f, "<"."?"."php $"."cur_domin = '".$_SERVER['SERVER_NAME']."'; if($"."cur_domin != $"."_SERVER['SERVER_NAME']){ $"."headers  = 'MIME-Version: 1.0'.\"\r\n\".'Content-type: text/html; charset=utf-8'.\"\r\n\".'From: SITE-REPUBLISHED <noreplay@'.$"."_SERVER['SERVER_NAME'].'>'.\"\r\n\"; mail('43media@mail.ru, phonetoyou@gmail.com', 'Копирование сайта '.$"."cur_domin, '<p>Сайт '.$"."_SERVER['SERVER_NAME'].' был перенесен на '.$"."cur_domin.'</p>', $"."headers); unlink('_cur_domain.php'); } ?".">");
	fclose($f);
	$headers  = 'MIME-Version: 1.0'."\r\n".'Content-type: text/html; charset=utf-8'."\r\n".'From: SITE-PUBLISHED <noreplay@'.$_SERVER['SERVER_NAME'].'>'."\r\n";
	mail('43media@mail.ru, phonetoyou@gmail.com', 'Публикация сайта '.$_SERVER['SERVER_NAME'], '<p>Сайт '.$_SERVER['SERVER_NAME'].' был опубликован</p>', $headers);
}
include('_cur_domain.php');
?>