<?php
	function getCaptcha()
	{
		return PIPHP_CreateCaptcha(26, 8, 'captcha/captcha.ttf', 'captcha/captchaimgs/','!*a&K', ".fs?+");	
	}
	
	function PIPHP_CreateCaptcha($size, $length, $font,$folder, $salt1, $salt2)
	{
		mt_srand ((double) microtime() * 1000000);
		
		$cnt=mt_rand(5,10);
		$captcha="";
		for ($i=0;$i<$cnt;$i++)
		{
			$c=0;
			while (!(($c>48 && $c<57) || ($c>65 && $c<90) || ($c>97 && $c<122)))
				$c=mt_rand(48,122);
			$captcha.=chr($c);
		}
			
		$token   = md5("$salt1$captcha$salt2");
		$fname   = "$folder" . $token . ".gif";
		PIPHP_GifText($fname, $captcha, $font, $size, "ff0000","f0e3ff", $size / 10, "293081");
		$image   = imagecreatefromgif($fname);
		$image   = PIPHP_ImageAlter($image, 2);
		$image   = PIPHP_ImageAlter($image, 13);
		
		for ($j = 0 ; $j < 3 ; ++$j)
			$image = PIPHP_ImageAlter($image, 3);
		
		for ($j = 0 ; $j < 2 ; ++$j)
			$image = PIPHP_ImageAlter($image, 5);
		
		imagegif($image, $fname);
		
		return array($captcha, $token, $fname);
	}
	
	function PIPHP_GifText($file, $text, $font, $size, $fore, $back,$shadow, $shadowcolor)
	{
	
		$bound  = imagettfbbox($size, 0, $font, $text);
		$width  = $bound[2] + $bound[0] + 6 + $shadow;
		$height = abs($bound[1]) + abs($bound[7]) + 5 + $shadow;
		$image  = imagecreatetruecolor($width, $height);

		$bgcol  = PIPHP_GD_FN1($image, $back);
		$fgcol  = PIPHP_GD_FN1($image, $fore);
		
		$shcol  = PIPHP_GD_FN1($image, $shadowcolor);
		
		imagefilledrectangle($image, 0, 0, $width, $height, $bgcol);
		
		if ($shadow > 0) imagettftext($image, $size, 0, $shadow + 2,abs($bound[5]) + $shadow + 2, $shcol, $font, $text);
		
		imagettftext($image, $size, 0, 2, abs($bound[5]) + 2, $fgcol,$font, $text);

		imagegif($image, $file);
	}

 	function PIPHP_GD_FN1($image, $color)
	{
		return imagecolorallocate($image,hexdec(substr($color, 0, 2)),hexdec(substr($color, 2, 2)),hexdec(substr($color, 4, 2)));
	}

	function PIPHP_ImageAlter($image, $effect)
	{
		switch($effect)
		{
		case 1: 
				imageconvolution($image, array(array(-1, -1, -1),array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
				break;
		case 2:  
				imagefilter($image,IMG_FILTER_GAUSSIAN_BLUR); break;
		
		case 3:  imagefilter($image,IMG_FILTER_BRIGHTNESS, 20); break;
		
		case 4:  imagefilter($image,IMG_FILTER_BRIGHTNESS, -20); break;
		
		case 5:  imagefilter($image,IMG_FILTER_CONTRAST, -20); break;
		
		case 6:  imagefilter($image,IMG_FILTER_CONTRAST, 20); break;
		
		case 7:  imagefilter($image,IMG_FILTER_GRAYSCALE); break;
		
		case 8:  imagefilter($image,IMG_FILTER_NEGATE); break;
		
		case 9:  imagefilter($image,IMG_FILTER_COLORIZE, 128, 0, 0, 50); break;
		
		case 10: imagefilter($image,IMG_FILTER_COLORIZE, 0, 128, 0, 50); break;
		
		case 11: imagefilter($image,IMG_FILTER_COLORIZE, 0, 0, 128, 50); break;
		
		case 12: imagefilter($image,IMG_FILTER_EDGEDETECT); break;
		
		case 13: imagefilter($image,IMG_FILTER_EMBOSS); break;
		
		case 14: imagefilter($image,IMG_FILTER_MEAN_REMOVAL); break;
		}
		return $image;
	}
?>