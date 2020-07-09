<?php 
	include 'inc/header.php';
	$sql0 = "select * from menu where id={$_GET['up_id']}";
	if ($_GET['up_id'] == "") {
		$sql0 = "select * from menu where id={$_GET['id']}";
	}
	$info = $mysqlObj->fetchOne($sql0);
	$sql = "select * from menu_cont where id={$_GET['id']}";
	$data = $mysqlObj->fetchOne($sql);
?>
	</div>
	<!-- 主体内容区 -->
	<div class="con_wrap">
	<div class="content">
		<!-- 侧边栏 -->
		<div class="navside">
			<dl>
				<dt><?php echo $info['name'];?></dt>
				<dd>
					<ul>
						<?php 
							$sql1 = "select * from menu where up_id={$_GET['up_id']}";
							$row = $mysqlObj->fetchAll($sql1);
							foreach ($row as $key => $value) {
								switch ($value['type']) {
									case '1':
										$url = "content.php?id=".$value['id']."&up_id=".$value['up_id'];
										break;
									case '2':
										$url = "list.php?id=".$value['id']."&up_id=".$value['up_id'];
										break;
								}
						?>
						<li class="<?php if ($value['id']==$_GET['id']) echo "active"?>">
							<a href="<?php echo $url;?>"><?php echo $value['name']?></a>
						</li>
						<?php 
							}
						?>
					</ul>
				</dd>
			</dl>
		</div>
		<!-- 主体 -->
		<div class="box">
			<div class="con">
				<div class="title"><?php echo $data['title']?></div>
				<div class="info">
					<span>添加人：<?php echo $data['add_user']?></span>&nbsp;&nbsp;&nbsp;
					<span>添加时间：<?php echo $data['created_at']?></span>
				</div>
				<div class="cont">
					<p>
						<?php echo $data['cont']?>
					</p>
					<div class="pic">
						<?php 
							if (!empty($data['img'])) {
								echo "<img src='uploads/{$data['img']}'>";
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	<?php include 'inc/footer.php'; ?>