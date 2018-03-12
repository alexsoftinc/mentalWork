<?php
/**
 * Created by PhpStorm.
 * User: a111
 * Date: 11.03.18
 * Time: 17:14
 *
 */
session_start();
session_regenerate_id();

$chars = [
	'math' => [
		'1',
		'2',
		'3',
		'4',
		'5'
	],
];


echo '<pre>',print_r($chars,1),'</pre>'; die;

# Массив значений которые могут генирироваться на изображении
$chars = "192837764823640234oqweiuuwuirywerasdljaskdjlkjfdsxcvzcxkjhmnbSKDHFKSHDFWUIEYRIUWEYRIUHKJSDHFKNXBCMVNBBVXC";

$randor_str = "";

for($i = 0; $i < 5; $i++)
{
    $randor_str .= $chars[rand(0, strlen($chars) -1)];
}

$_SESSION['captcha'] = $randor_str;
# Это фон на который будет наложено изображение
$img = imagecreatefrompng("images/bg.png");
# Создание текста на изображении как бы нанисение
imagettftext($img, 25, 5, 5, 38, imagecolorallocate($img, 0, 0, 0), "fonts/FasterOne-Regular.ttf", $randor_str);
# Назначение заголовков что бы браузер разобрал картинку
header("Content-Type:image/png");
imagepng($img, null, 0);
imagedestroy($img);

