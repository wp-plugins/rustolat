<?php
/*
Plugin Name: RusToLat
Plugin URI: http://blog.zcore.ru/
Description: This plugin converts Cyrillic characters in post slugs to Latin characters. Very useful for Russian-speaking users of WordPress. You can use this plugin for creating human-readable links. Thanks to Alexander Shilyaev for the idea. Send your suggestions and critics to <a href="mailto:skorobogatov@gmail.com">skorobogatov@gmail.com</a>.
Author: Anton Skorobogatov
Author URI: http://blog.zcore.ru/
Version: 0.1
*/ 
$tr = array(
   "Ґ"=>"G","Ё"=>"YO","Є"=>"E","Ї"=>"YI","І"=>"I",
   "і"=>"i","ґ"=>"g","ё"=>"yo","№"=>"#","є"=>"e",
   "ї"=>"yi","А"=>"A","Б"=>"B","В"=>"V","Г"=>"G",
   "Д"=>"D","Е"=>"E","Ж"=>"ZH","З"=>"Z","И"=>"I",
   "Й"=>"Y","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",
   "О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",
   "У"=>"U","Ф"=>"F","Х"=>"H","Ц"=>"TS","Ч"=>"CH",
   "Ш"=>"SH","Щ"=>"SCH","Ъ"=>"'","Ы"=>"YI","Ь"=>"",
   "Э"=>"E","Ю"=>"YU","Я"=>"YA","а"=>"a","б"=>"b",
   "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"zh",
   "з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
   "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
   "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
   "ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"'",
   "ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya"
  );
 
function sanitize_title_with_translit($title) {
	global $tr;
   	return strtr($title,$tr);
}

add_action('sanitize_title', 'sanitize_title_with_translit', 0);
?>