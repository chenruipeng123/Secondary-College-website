<?php 
	include 'inc/header.php';
?>	
			<div class="banner">
				<div class="shutter">
					<div class="shutter-img">
						<?php 
							$sql = "select * from lunbo where state=1 order by show_order desc";
							$info = $mysqlObj->fetchAll($sql);
							foreach ($info as $key => $value) {
						?>
						<a  data-shutter-title="Iron Man"><img src="uploads/<?php echo $value['img']?>" alt="轮播图"></a>
						<?php 
							}
						?>
					</div>
					<ul class="shutter-btn">
					<li class="prev"></li>
					<li class="next"></li>
					</ul>
					<!-- <div class="shutter-desc">
					<p>Iron Man</p>
					</div> -->
				</div>
			</div>
		</div>
		
		<!-- 内容 -->
	<div class="main">
	<div class="toutiao">
			<span class="info">
				<?php 
					$info = $mysqlObj->find('menu_cont','toutiao=1');
				?>
				<a href="list_content.php?id=<?php echo $info['id']?>&up_id=<?php echo $info['up_id']?>"><?php echo $info['title']?></a>
			</span>
		</div>
		<div class="con3">
			<div class="focus">
				<div id="show-area">
					<ul>
					<?php 
						$sql = "select * from active_news where show_order=1";
						$res = $mysqlObj->fetchOne($sql);
						$sql2 = "select * from menu_cont where up_id={$res['menu_id']} and img != ''  order by created_at desc,id desc limit 0,6";
						$info = $mysqlObj->fetchAll($sql2);
						foreach ($info as $key => $value) {
					?>
						<li><a href="list_content.php?id=<?php echo $value['id']?>&up_id=<?php echo $value['up_id']?>">
							<img src="uploads/<?php echo $value['img']?>" >
						</a>
						</li>
					<?php 
						}
					?>
					</ul>
					<div id="indicator"></div>
				</div>
			</div>
			<div class="news">
				<dl>
					<?php 
						$sql = "select * from active_news where show_order=1";
						$res = $mysqlObj->fetchOne($sql);
						$sql1 = "select * from menu where id={$res['menu_id']}";
						$data = $mysqlObj->fetchOne($sql1);
						$sql2 = "select * from menu_cont where up_id={$res['menu_id']} order by created_at desc,id desc limit 0,10";
						$info = $mysqlObj->fetchAll($sql2);
						// echo "<pre>";
						// var_dump($info);
						// exit;
						// echo $info[0]['up_id'];
						// exit;
					?>
					<dt><?php echo $data['name']?><span><?php echo $data['up_name']?></span><a class='more' href="list.php?id=<?php echo $info[0]['up_id'] ?>">More+</a></dt>
					<dd>
						<ul>
						<?php 
							
							foreach ($info as $key => $value) {
						?>
							<li><a href="list_content.php?id=<?php echo $value['id']?>&up_id=<?php echo $value['up_id']?>"><?php echo $value['title']?></a><span class="date"><?php echo substr($value['created_at'], 5) ?></span></li>
						<?php 
							}
						?>
						</ul>
					</dd>
				</dl>
			</div>
			<div class="notice mt30">
				<dl>
					<?php 
						$sql = "select * from active_news where show_order=2";
						$res = $mysqlObj->fetchOne($sql);
						$sql1 = "select * from menu where id={$res['menu_id']}";
						$data = $mysqlObj->fetchOne($sql1);
						$sql2 = "select * from menu_cont where up_id={$res['menu_id']} order by created_at desc,id desc limit 0,10";
						$info = $mysqlObj->fetchAll($sql2);
						// var_dump($info);
						// exit;
					?>
					<dt><?php echo $data['name']?><span><?php echo $data['up_name']?></span><a class='more' href="list.php?id=<?php echo $info[0]['up_id'] ?>">More+</a></dt>
					<dd>
						<ul>
						<?php 
							
							foreach ($info as $key => $value) {
						?>
							<li><a href="list_content.php?id=<?php echo $value['id']?>&up_id=<?php echo $value['up_id']?>"><?php echo $value['title']?></a><span class="date"><?php echo substr($value['created_at'], 5) ?></span></li>
						<?php 
							}
						?>
						</ul>
					</dd>
				</dl>
			</div>
			<div class="exhibition mt30">
			<dl>
					<?php 
						$sql = "select * from active_news where show_order=3";
						$res = $mysqlObj->fetchOne($sql);
						$sql1 = "select * from menu where id={$res['menu_id']}";
						$data = $mysqlObj->fetchOne($sql1);
						$sql2 = "select * from menu_cont where up_id={$res['menu_id']} and state=1 order by created_at desc,id desc limit 0,6";
						$info = $mysqlObj->fetchAll($sql2);
					?>
					<dt><?php echo $data['name']?><span><?php echo $data['up_name']?></span><a class='more' href="display.php?id=<?php echo $data['id'] ?>">More+</a></dt>					
					<dd>
						<ul>
						<?php 
							
							foreach ($info as $key => $value) {
						?>
							<li><a href="content2.php?id=<?php echo $value['id']?>&up_id=<?php echo $value['up_id']?>">
							<img src="uploads/<?php echo $value['img']?>" width="70" ><br><span class="title1"><?php echo $value['title']; ?></span></a></li>
						<?php 
							}
						?>
						</ul>
					</dd>
				</dl>
			</div>
			<div class="major mt30">
				<dl>
					<?php 
						$sql = "select * from active_news where show_order=4";
						$res = $mysqlObj->fetchOne($sql);
						$sql1 = "select * from menu where id={$res['menu_id']}";
						$data = $mysqlObj->fetchOne($sql1);
						$sql2 = "select * from menu where up_id={$res['menu_id']} order by show_order asc";
						$info = $mysqlObj->fetchAll($sql2);
						// var_dump($info);
						// exit;
					?>
					<dt><?php echo $data['name']?><span><?php echo $data['up_name']?></span>
					<a class="more" href="content.php?id=<?php echo $info[0]['id']; ?>&up_id=<?php echo $info[0]['up_id'] ?>">More+</a></dt>
					<dd>
						<ul>
						<?php 
							
							foreach ($info as $key => $value) {
						?>
							<li><a href="content.php?id=<?php echo $value['id']?>&up_id=<?php echo $value['up_id']?>"><?php echo $value['name']?></a></li>
						<?php 
							}
						?>
						</ul>
					</dd>
				</dl>
			</div>
			<div class="studio mt30">
				<dl>
					<?php 
						$sql = "select * from active_news where show_order=5";
						$res = $mysqlObj->fetchOne($sql);
						$sql1 = "select * from menu where id={$res['menu_id']}";
						$data = $mysqlObj->fetchOne($sql1);
						$sql2 = "select * from menu_cont where up_id={$res['menu_id']} order by created_at asc";
						$info = $mysqlObj->fetchAll($sql2);
					?>
					<dt><?php echo $data['name']?><span><?php echo $data['up_name']?></span><a class="more" href="display.php?id=<?php echo $info[0]['up_id'] ?>">More+</a></dt>
					<dd>
						<ul>
						<?php 							
							foreach ($info as $key => $value) {
								if ($value['addr'] == "") {
									$url = "list_conten.php?id={$value['id']}&up_id={$value['up_id']}";
								}else{
									$url = $value['addr'];
								}
						?>
							<li><a href="<?php echo $url;?>" <?php if ($value['addr'] != '') echo "target='_blank'"?>>
							<img src="uploads/<?php echo $value['img']?>" width="70" height="70"><br><span><?php echo $value['title']?></span></a></li>
						<?php 
							}
						?>
						</ul>
					</dd>
				</dl>
			</div>
		
			<div class="wrap">
				<div class="zhaosheng mt30">
					<dl>
						<?php 
							$sql = "select * from active_news where show_order=7";
							$res = $mysqlObj->fetchOne($sql);
							$sql1 = "select * from menu where id={$res['menu_id']}";
							$data = $mysqlObj->fetchOne($sql1);
							$sql2 = "select * from menu_cont where up_id in ({$res['menu_id']},{$res['menu_id']}+1) order by created_at desc,id desc limit 0,8";
							$info = $mysqlObj->fetchAll($sql2);
						?>
						<dt>招生资讯<span>Enrollment</span><a class="more" href="list.php?id=<?php echo $info[1]['up_id'] ?>&up_id=<?php echo $data['up_id']?>">More+</a></dt>
						<dd>
							<ul>
							<?php 
								foreach ($info as $key => $value) {
							?>
								<li><a href="list_content.php?id=<?php echo $value['id']?>&up_id=<?php echo $value['up_id']?>"><?php echo $value['title']?></a>
								<span class="date"><?php echo substr($value['created_at'], 5) ?></span></li>
							<?php 
								}
							?>
							</ul>
						</dd>
					</dl>
				</div>
				
				<div class="employ mt30">
					<dl>
						<?php 
							$sql = "select * from active_news where show_order=8";
							$res = $mysqlObj->fetchOne($sql);
							$sql1 = "select * from menu where id={$res['menu_id']}";
							$data = $mysqlObj->fetchOne($sql1);
							$sql2 = "select * from menu_cont where up_id in ({$res['menu_id']},{$res['menu_id']}-1) order by created_at desc,id desc limit 0,8";
							$info = $mysqlObj->fetchAll($sql2);
						?>
						<dt>就业指导<span>Graduates</span><a class="more" href="list.php?id=<?php echo $info[1]['up_id']?>&up_id=<?php echo $data['up_id']?>">More+</a></dt>
						<dd>
							<ul>
							<?php 
								foreach ($info as $key => $value) {
							?>
								<li><a href="list_content.php?id=<?php echo $value['id']?>&up_id=<?php echo $value['up_id']?>"><?php echo $value['title']?></a>
								<span class="date"><?php echo substr($value['created_at'], 5) ?></span></li>
							<?php 
								}
							?>
							</ul>
						</dd>
					</dl>
				</div>
			</div>
			<div class="follow mt30">
				<dl>
					<?php 
						$sql = "select * from active_news where show_order=6";
						$res = $mysqlObj->fetchOne($sql);
						$sql1 = "select * from menu where id={$res['menu_id']}";
						$data = $mysqlObj->fetchOne($sql1);
						$sql2 = "select * from menu_cont where up_id={$res['menu_id']}";
						$info = $mysqlObj->fetchAll($sql2);
					?>
					<dt><?php echo $data['name']?><span><?php echo $data['up_name']?></span></dt>
					<dd>
						<ul>
						<?php 
							
							foreach ($info as $key => $value) {
						?>
							<li><img src="uploads/<?php echo $value['img']?>" width="100">
							<br><span><?php echo $value['title']?></span></li>
						<?php 
							}
						?>
						</ul>
					</dd>
				</dl>
				</dl>
			</div>
		  </div>
		  <div class="link mt30">
			<dl>
				<dt>常用链接<span>Links</span></dt>
				<dd>
					<form>
						<select name="select">
							<option value="" selected>---------常用校内链接---------</option>
							<?php 
								$data = $mysqlObj->findAll('link',' type=1');
								foreach ($data as $key => $value) {
							?>
							<option value="<?php echo $value['addr']?>"><?php echo $value['name']?></option>
							<?php 
								}
							?>
						</select>
						<select name="select">
							<option value="" selected>---------常用校外链接---------</option>
							<?php 
								$data = $mysqlObj->findAll('link',' type=2');
								foreach ($data as $key => $value) {
							?>
							<option value="<?php echo $value['addr']?>"><?php echo $value['name']?></option>
							<?php 
								}
							?>
						</select>
						<select name="select">
							<option value="" selected>---------设计网站链接---------</option>
							<?php 
								$data = $mysqlObj->findAll('link',' type=3');
								foreach ($data as $key => $value) {
							?>
							<option value="<?php echo $value['addr']?>"><?php echo $value['name']?></option>
							<?php 
								}
							?>
						</select>
					</form>
				</dd>
			</dl>
		</div>
		</div>
		<?php include 'inc/footer.php';?>