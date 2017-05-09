<?php

set_time_limit(0); //0为无限制时间
$whether="";
function catchWhether()
{
	$url="http://www.tianqizhubo.com/city/wuhan";
	
	$regD="/<div class=\"description\">(.+)<\/div>/";
	$regT="/<div class=\"temperature\">温度：(.+)<\/div>/";
	$regW="/<div class=\"wind\">(.*)\s+(.+)/";
	
	$html=file_get_contents($url);
	//print_r($html);
	if ($html == "") return "Catch $url error !";
	//$html = iconv( "UTF-8", "gb2312//IGNORE" , $html);	//转换编码方式
	try
	{
		preg_match($regD,$html,$matchD);		//仅匹配一次
		preg_match($regT,$html,$matchT);
		preg_match($regW,$html,$matchW);
		
		$des     = trim(strip_tags($matchD[1]));		//去除html标记
		$temper  = trim(strip_tags($matchT[1]));
		$wind    = trim(strip_tags($matchW[2]));
		global $whether;
		$whether=$des.' '.$temper.' '.$wind;
	}
	catch(Exception $e)
	{
		echo 'Message: ' .$e->getMessage();
	}
	return "catch Whether OK!!";
}
catchWhether();	
print $whether;

?>