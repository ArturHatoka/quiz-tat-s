<?php
$http = 'http://'.$_SERVER['SERVER_NAME'].'/';
$sitemap_term = array('always','hourly','daily','weekly','monthly','yearly'.'never');
$xmlsitemap = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9             http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
';
$showCities = mysql_result(mysql_query("SELECT text FROM ".MySQLprefix."_additional WHERE id=41"),0);
//обычные страницы
$search = mysql_query("SELECT url FROM ".MySQLprefix."_mypages WHERE shows=1 AND id NOT IN (3,4) ".($showCities==0?"AND id!='77' ":"")."ORDER BY id");
if($search)
	if(mysql_num_rows($search)>0)
		while($srch = mysql_fetch_assoc($search)){
			$srch['url'] = $srch['url']=='main'?'':$srch['url'].'/';
			$xmlsitemap .= '
<url>
	<loc>'.$http.$srch['url'].'</loc>
	<lastmod>'.date('Y-m-d\TH:i:sP', time()).'</lastmod>
	<changefreq>'.$sitemap_term[1].'</changefreq>
</url>';
		}
//новости
$search = mysql_query("SELECT ".MySQLprefix."_urls.url FROM ".MySQLprefix."_news, ".MySQLprefix."_urls WHERE ".MySQLprefix."_news.shows=1 AND ".MySQLprefix."_news.id=".MySQLprefix."_urls.target_id AND ".MySQLprefix."_urls.target_type='news' AND ".MySQLprefix."_news.date_create<='".date('Y-m-d')." 12:00:00'");
if($search)
	if(mysql_num_rows($search)>0)
		while($srch = mysql_fetch_assoc($search)){
			$xmlsitemap .= '
<url>
	<loc>'.$http.$srch['url'].'/</loc>
	<changefreq>'.$sitemap_term[3].'</changefreq>
</url>';
		}
$search = mysql_query("SELECT ".MySQLprefix."_urls.url FROM ".MySQLprefix."_categories, ".MySQLprefix."_urls WHERE ".MySQLprefix."_categories.id=".MySQLprefix."_urls.target_id AND ".MySQLprefix."_urls.target_type='categories'");
if($search)
	if(mysql_num_rows($search)>0)
		while($srch = mysql_fetch_assoc($search)){
			$xmlsitemap .= '
	<url>
		<loc>'.$http.$srch['url'].'/</loc>
		<changefreq>'.$sitemap_term[4].'</changefreq>
	</url>';
		$URLs++;
		if($showCities == '0'){
			$search2 = mysql_query("SELECT url FROM ".MySQLprefix."_cities WHERE st=1");
			if($search2)
				if(mysql_num_rows($search2)>0)
					while($srch2 = mysql_fetch_assoc($search2)){
						$xmlsitemap .= '
	<url>
		<loc>'.$http.$srch2['url'].'/'.$srch['url'].'/</loc>
		<changefreq>'.$sitemap_term[4].'</changefreq>
	</url>';
					}
	}
$search = mysql_query("SELECT id FROM ".MySQLprefix."_goods WHERE status=1");
if($search)
	if(mysql_num_rows($search)>0)
		while($srch = mysql_fetch_assoc($search)){
			$xmlsitemap .= '
	<url>
		<loc>'.$http.'goods/'.$srch['id'].'/</loc>
		<changefreq>'.$sitemap_term[2].'</changefreq>
	</url>';
		$URLs++;
	}
//фотогалереи
$search = mysql_query("SELECT id AS url FROM ".MySQLprefix."_photoalb ORDER BY id");
if($search)
	if(mysql_num_rows($search)>0)
		while($srch = mysql_fetch_assoc($search)){
			$xmlsitemap .= '
<url>
	<loc>'.$http.'photos/'.$srch['url'].'/</loc>
	<changefreq>'.$sitemap_term[3].'</changefreq>
</url>';
		}
$xmlsitemap .= '</urlset>';
$fpl = fopen("../sitemap.xml", w);
fwrite($fpl, $xmlsitemap);
fclose($fpl);
?>