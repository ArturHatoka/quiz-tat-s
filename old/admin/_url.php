<?php
$urls = explode('/', urldecode($_SERVER['REQUEST_URI']));
if(strpos($urls[count($urls)-1], '?') !== false)
	$urls[count($urls)-1] = substr($urls[count($urls)-1], 0, strpos($urls[count($urls)-1], '?'));
if(strlen($urls[count($urls)-1])==0)
	unset($urls[count($urls)-1]);
if(strlen($urls[0])==0)
	unset($urls[0]);
$urls = array_values($urls);
$showCities = mysql_result(mysql_query("SELECT text FROM ".MySQLprefix."_additional WHERE id=41"),0);
if($showCities==0){
	$cities = mysql_query("SELECT * FROM ".MySQLprefix."_cities WHERE url='".mysql_real_escape_string($urls[0])."' LIMIT 0, 1");
	if($cities && mysql_num_rows($cities)==1){
		$city = mysql_fetch_assoc($cities);
		if(strlen($city['name'])>0){
			$cur_city = array('/'.$urls[0], $city['name'], $city['namer'], $city['id']);
			unset($urls[0]);
			$urls = array_values($urls);
		}else{
			$cities = mysql_query("SELECT * FROM ".MySQLprefix."_cities WHERE st='2' LIMIT 0, 1");
			if($cities && mysql_num_rows($cities)==1){
				$city = mysql_fetch_assoc($cities);
				$cur_city = array('', $city['name'], $city['namer'], $city['id']);
			}
		}
	}else{
		$cities = mysql_query("SELECT * FROM ".MySQLprefix."_cities WHERE st='2' LIMIT 0, 1");
		if($cities && mysql_num_rows($cities)==1){
			$city = mysql_fetch_assoc($cities);
			$cur_city = array('', $city['name'], $city['namer'], $city['id']);
		}
	}
}
$url['target_type'] = 'main';
for($u=0; $u<count($urls); $u++)
	$urls[$u] = mysql_real_escape_string($urls[$u]);
if(count($urls)>0){
	$url_r = mysql_query("SELECT * FROM ".MySQLprefix."_urls WHERE url='".((is_numeric($urls[count($urls)-1]) && $urls[count($urls)-1]>0) ? $urls[count($urls)-2] : $urls[count($urls)-1])."' LIMIT 0, 1");
	if($url_r)
		if(mysql_num_rows($url_r)==1)
			$url = mysql_fetch_assoc($url_r);
		else{
			$url['target_type'] = '404';
			$seo['title'] = $seo['description'] = $seo['keywords'] = 'Страница не найдена';
			header('HTTP/1.1 404 Not Found');
		}
}
if($url['target_id'] != 0){
	$seo_r = mysql_query("SELECT * FROM ".MySQLprefix."_".$url['target_type']." WHERE id=".($url['target_id']>0?$url['target_id']:$urls[count($urls)-1]));
	if(mysql_num_rows($seo_r)==1){
		$seo = mysql_fetch_assoc($seo_r);
		$urls[count($urls)] = $seo['id'];
	}else{
		$url['target_type'] = '404';
		$seo['title'] = $seo['description'] = $seo['keywords'] = 'Страница не найдена';
		header('HTTP/1.1 404 Not Found');
	}
}else{
	if(count($urls)<2){
		$seo_r = mysql_query("SELECT * FROM ".MySQLprefix."_mypages WHERE url='".(strlen($urls[0])>0?$urls[0]:'main')."'");
		if($seo_r && mysql_num_rows($seo_r)==1){
			$seo = mysql_fetch_assoc($seo_r);
			$urls[count($urls)] = $seo['id'];
		}else{
			$url['target_type'] = '404';
			$seo['title'] = $seo['description'] = $seo['keywords'] = 'Страница не найдена';
			header('HTTP/1.1 404 Not Found');
		}
	}elseif(is_numeric($urls[count($urls)-1]) && $urls[count($urls)-1]>0 || $url['target_type'] == 'faq'){
		if($url['target_type'] == 'faq')
			$urls[count($urls)-1] = $_GET['id'];
		$seo_r = mysql_query("SELECT * FROM ".MySQLprefix."_".$url['target_type']." WHERE id=".$urls[count($urls)-1]);
		if($seo_r && mysql_num_rows($seo_r)==1){
			$seo = mysql_fetch_assoc($seo_r);
			$urls[count($urls)] = $seo['id'];
		}else{
			$url['target_type'] = '404';
			$seo['title'] = $seo['description'] = $seo['keywords'] = 'Страница не найдена';
			header('HTTP/1.1 404 Not Found');
		}
	}
}
if(strlen($cur_city[0])>0 && (in_array($url['target_type'],array('news','all_news','goods')) || $url['target_type']=='mypages' && $url['target_id']!=2)){
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: ".str_replace($cur_city[0], '', $_SERVER['REQUEST_URI']));
	exit;
}
if($urls[0] == 'photos')
	$seo['title'] = $seo['h1'] = $seo['description'] = $seo['keywords'] = $seo['name'];
if($url['target_type']=='newsall' || $url['target_type']=='articlesall' || $url['target_type']=='feedbacks')
	$seo = mysql_fetch_assoc(mysql_query("SELECT * FROM ".MySQLprefix."_mypages WHERE url='".(strlen($urls[0])>0?$urls[0]:'main')."'"));
foreach($seo AS $k => $v)
	$seo[$k] = str_replace(array('%%_city_%%','%%_cityr_%%'), $showCities==0?array($cur_city[1],$cur_city[2]):'', $v);
?>