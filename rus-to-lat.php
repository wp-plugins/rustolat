<?php
/*
Plugin Name: RusToLat
Plugin URI: http://mywordpress.ru/plugins/rustolat/
Description: This plugin converts Cyrillic characters in post slugs to Latin characters. Very useful for Russian-speaking users of WordPress. You can use this plugin for creating human-readable links. Thanks to Alexander Shilyaev for the idea. Send your suggestions and critics to <a href="mailto:skorobogatov@gmail.com">skorobogatov@gmail.com</a>.
Author: Anton Skorobogatov <skorobogatov@gmail.com>
Contributor: Andrey Serebryakov <saahov@gmail.com>
Author URI: http://skorobogatov.ru/
Version: 0.2
*/ 
$gost = array(
   "Г"=>"G","Ё"=>"JO","Є"=>"EH","Ы"=>"Y","І"=>"I",
   "і"=>"i","г"=>"g","ё"=>"jo","№"=>"#","є"=>"eh",
   "ы"=>"y","А"=>"A","Б"=>"B","В"=>"V","Г"=>"G",
   "Д"=>"D","Е"=>"E","Ж"=>"ZH","З"=>"Z","И"=>"I",
   "Й"=>"JJ","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",
   "О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",
   "У"=>"U","Ф"=>"F","Х"=>"H","Ц"=>"C","Ч"=>"CH",
   "Ш"=>"SH","Щ"=>"SHH","Ъ"=>"'","Ы"=>"Y","Ь"=>"",
   "Э"=>"EH","Ю"=>"JU","Я"=>"JA","а"=>"a","б"=>"b",
   "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"zh",
   "з"=>"z","и"=>"i","й"=>"jj","к"=>"k","л"=>"l",
   "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
   "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
   "ц"=>"c","ч"=>"ch","ш"=>"sh","щ"=>"shh","ъ"=>"'",
   "ы"=>"y","ь"=>"","э"=>"eh","ю"=>"ju","я"=>"ja"
  );
  
$original = array(
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
	global $gost, $original;
	$rtl_standard = get_option('rtl_standard');
	switch ($rtl_standard) {
		case 'off':
		    return $title;
		case 'gost':
		    return strtr($title, $gost);
		default:
		    return strtr($title, $original);
	}
}

function rtl_options_page() {
?>
<div class="wrap">
	<h2>Настройки RusToLat</h2>
	<p>Вы можете выбрать стандарт, по которому будет производиться транслитерация заголовков.</p>
	<?php
	if($_POST['rtl_standard']) {
		// set the post formatting options
		update_option('rtl_standard', $_POST['rtl_standard']);
		echo '<div class="updated"><p>Настройки обновлены.</p></div>';
	}
	?>

	<form method="post">
	<fieldset class="options">
		<legend>Производить транслитерацию в стандарте:</legend>
		<?php
		$rtl_standard = get_option('rtl_standard');
		?>
			<select name="rtl_standard">
				<option value="off"<?php if($rtl_standard == 'off'){ echo(' selected="selected"');}?>>Отключена</option>
				<option value="original"<?php if($rtl_standard == 'original' OR $rtl_standard == ''){ echo(' selected="selected"');}?>>По умолчанию</option>
				<option value="gost"<?php if($rtl_standard == 'gost'){ echo(' selected="selected"');}?>>ГОСТ 16876-71</option>
			</select>

			<input type="submit" value="Изменить стандарт" />

	</fieldset>
	</form>
</div>
<?php
}

function rtl_add_menu() {
		add_options_page('RusToLat', 'RusToLat', 8, __FILE__, 'rtl_options_page');
}

add_action('admin_menu', 'rtl_add_menu');
add_action('sanitize_title', 'sanitize_title_with_translit', 0);
?>