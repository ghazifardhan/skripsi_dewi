<?php
function Resize($source,$dest,$extension,$size,$scale=2) {
	$thumb_size = $size;
	$sizes = getimagesize($source);
	$width = $sizes[0];
	$height = $sizes[1];
    $x = 0;
	$y = 0;
	$extension = ltrim($extension,'.');
	//echo $source.' => '.$dest.' => '.$extension.' => '.$size;
	if($extension == 'jpg')
	$im = imagecreatefromjpeg($source);
	elseif($extension == 'gif')
	$im = imagecreatefromgif($source);
	elseif($extension == 'png')
	$im = imagecreatefrompng($source);	
	if($scale == 1) {
		//if($width > $height) {
			$coeff = $width/$size;
			$width = $size;
			$height = round($height/$coeff);
		/*} elseif($height > $width) {
			$coeff = $height/$size;
			$height = $size;
			$width = round($width/$coeff);
		} else {
			$width = $size;
			$height = $size;
		}*/
	$new_im = imagecreatetruecolor($width,$height);
		imagecopyresampled($new_im,$im,0,0,0,0,$width,$height,$sizes[0],$sizes[1]);	
	}
	else {
		if($width > $height) {
			$x = ceil(($width - $height) / 2 );
			$width = $height;
		} elseif($height > $width) {
			$y = ceil(($height - $width) / 2);
			$height = $width;
		}
	$new_im = imagecreatetruecolor($thumb_size,$thumb_size);
		imagecopyresampled($new_im,$im,0,0,$x,$y,$thumb_size,$thumb_size,$width,$height);
	}
	if($extension == 'jpg')
	imagejpeg($new_im,$dest,80);
	elseif($extension == 'gif')
	imagegif($new_im,$dest);
	elseif($extension == 'png')
	imagepng($new_im,$dest);
	imagedestroy($new_im);
	imagedestroy($im);
}
