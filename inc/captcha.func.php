<?php
	session_start();
 
	$image=imagecreatetruecolor(100,30);
	$bgcolor=imagecolorallocate($image,220,220,200); //#fff
	imagefill($image, 0, 0, $bgcolor);
 
	$captch_code='';
	//画出4个随机的数字或者字母
	for($i=0;$i<4;$i++){
		$fontsize=6;
		//为了让数字的颜色不同,使用随机颜色rand(0,120),120之前是深色
		$fontcolor=imagecolorallocate($image,rand(0,120),rand(0,120),rand(0,120));
		
		$data='0123456789';
		$fontcontent=substr($data,rand(0,strlen($data)),1);	
		$captch_code.=$fontcontent;		
		$x=($i*100/4)+rand(5,10);
		$y=rand(5,10);
		//水平画一条字符串
		imagestring($image,$fontsize,$x,$y,$fontcontent,$fontcolor);
	}
	$_SESSION['authcode']=$captch_code;
	//增加点干扰元素
	for($i=0;$i<200;$i++){
		$pointcolor=imagecolorallocate($image,rand(50,200),rand(50,200),rand(50,200));
		//画一个单一像素
		imagesetpixel($image,rand(1,99),rand(1,99),$pointcolor);
	}
	//增加线干扰元素
	for($i=0;$i<3;$i++){
		$linecolor=imagecolorallocate($image,rand(80,220),rand(80,220),rand(80,220));
		imageline($image,rand(1,99),rand(1,29),rand(1,99),rand(1,29),$linecolor);
	}
	header('content-type:image/png');
	imagepng($image);
 
	imagedestroy($image);
	?>