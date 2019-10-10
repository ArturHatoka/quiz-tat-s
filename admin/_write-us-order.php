<?php
include("_mysql.php");
include("_additional.php");
$headers  = 'MIME-Version: 1.0'."\r\n".'Content-type: text/html; charset=utf-8'."\r\n".'From: ТЕСТ <noreplay@'.$_SERVER['SERVER_NAME'].'>'."\r\n";
$mess = '<p>Ответы на ТЕСТ<br/>Тел.: <b>'.$_POST['frmopros']['fieldcontact'].'</b></p><hr/>';
$questions = mysql_query("SELECT * FROM ".MySQLprefix."_questions WHERE p_id='0' ORDER BY sort_id ASC");
if ($questions && mysql_num_rows($questions)>0)
	while ($question = mysql_fetch_assoc($questions))
		$q[$question['id']] = $question['name'];

foreach($_POST['frmopros'] AS $k => $v)
	if($k != 'fieldcontact'){
		$mess .= '<p>'.$q[str_replace('field','',$k)].'<br/>';
		if(is_array($v) && count($v)>0)
			$mess .= '<b>'.implode('</b><br/><b>',$v).'</b>';
		else
			$mess .= '<b>'.$v.'</b>';
		$mess .= count($v).'</p>';
	}
mail($additional[11], 'Ответы на ТЕСТ ', $mess, $headers);
?>{"res":"1","id_lead":"9113752","key":"94b27afe5e25a80b","lead":"9113752"}