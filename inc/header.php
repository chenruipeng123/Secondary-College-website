<?php 
	include 'inc/include.php';
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>创意设计学院-日照职业技术学院</title>
		<meta name="description" content="创意设计学院">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="shortcut icon" href="images/fac.png">
		<link rel="stylesheet" href="css/text.css">
		<link rel="stylesheet" href="css/index.css">
		<link rel="stylesheet" href="css/mobile.css" media="screen and (max-width: 768px)">
		<link rel="stylesheet" href="css/focus.css">
		<link rel="stylesheet" href="css/shutter.css">		
	</head>
	<body>
		<!--[if lt IE 7]>
			<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->
		<!-- 开始 -->
		<!-- 顶部展示区 -->
		<div class="con1">
			<!-- 最顶部 -->
			<div class="topest"></div>
			<!-- logo+展示 -->
			<div class="top">
				<div class="logo">
					<?php 
						$sql = "select * from display where state=1 order by show_order asc";
						$info = $mysqlObj->fetchAll($sql);
                        foreach ($info as $key => $value) {
                    ?>
						<img class="pc" src="uploads/<?php echo $value['img'];?>"  alt="尺寸为1020*130">
					<?php
                        }
					?>
						<img class="pic" src="images/logo.png">
					<div class="btn">
						<img src="images/zhe.png" alt="">
					</div>
				</div>
			</div>
		</div>
		<!-- 导航+大图 -->
		<div class="con2">
			<div class="nav">
				<ul class="first">
					<li class="li"><a href="index.php">首 页<br><span class="english">Home</span></a></li>
					<?php 
						$sql = "select * from menu where up_id=0 and state=1 order by show_order asc";
						$data = $mysqlObj->fetchAll($sql);
						foreach ($data as $key => $value) {
							$menu1 = "content.php?id=".$value['id'];
							$menu2 = "list.php?id=".$value['id'];
							$menu3 = $value['addr'];
							// $sql2 = "select * from menu where up_id={$value['id']} and state=1";
							// exit;
							if ($value['type']==1) {
								$url = $menu1;
							}elseif ($value['type']==2) {
								$url = $menu2;
							}elseif ($value['type']==5) {
								$url = $menu3;
							}elseif ($value['type']==4) {
								//查询二级菜单点击后的默认的菜单
								$sql2 = "select * from menu where up_id={$value['id']} and state=1 order by show_order asc limit 0,1";
								$row = $mysqlObj->fetchOne($sql2);
								if(empty($row)){
									$url="#";
								}
								if ($row['type']==1) {
									$url = "content.php?id=".$row['id']."&up_id=".$value['id'];
								}elseif ($row['type']==2) {
									$url = "list.php?id=".$row['id']."&up_id=".$value['id'];
								}elseif ($row['type']==5) {
									$url = $value['addr'];
								}
							}	
					?>
					<li class="li">
						<a href="<?php echo $url;?>" <?php if($url==$menu3) echo "target='_blank'"?> >
							<?php echo $value['name'];?><br><span class="english"><?php echo $value['up_name']; ?></span>
						</a>
					</li>
					<?php 
						}
					?>
				</ul>
			</div>