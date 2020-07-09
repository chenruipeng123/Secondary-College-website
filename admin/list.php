<?php 
	$cdgl = "active open";
	$nrgl = "active open";
	$yjcd = $_GET['id'];
	$yjcd_up = $_GET['up_id'];
	include '../inc/include.php';
	loginCheck();
	include '../inc/header.inc.php';
	include '../inc/nav.inc.php';
	$sql = "select * from menu where id={$_GET['id']}";
	$rows = $mysqlObj->fetchOne($sql);
	$sql1 = "select * from menu where id={$_GET['up_id']}";
	$row = $mysqlObj->fetchOne($sql1);
 ?>
<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="index.php">首页</a>
				</li>
				<li>
					内容管理
				</li>
				<?php 
					if ($_GET['up_id'] != 0) {
						echo "<li>{$row['name']}</li>";
					}
				?>
				<li class="active"><?php echo $rows['name'] ?>列表</li>
			</ul>
		</div>

		<div class="page-content">
			<div class="row">
				<div class="col-sm-12">
					<div class="tabbable">
						<ul class="nav nav-tabs" id="myTab">
							<li class="active">
								<a href="#">
								 	<?php echo $rows['name'] ?>列表
								</a>
							</li>
							<li class="#">
								<a href="listadd.php?id=<?php echo $_GET['id'] ?>&up_id=<?php echo $_GET['up_id']?>">
									<?php echo $rows['name'] ?>添加
								</a>
							</li>
						</ul>

						<div class="tab-content">
							<div id="home" class="tab-pane fade active in">
								<table id="simple-table" class="table  table-bordered table-hover">
									<thead>
										<tr>
											<th>序号</th>
											<th>标题</th>
											<th>显示状态</th>
											<th>创建时间</th>
											<th>添加人</th>
											<th>操作</th>
										</tr>
									</thead>
									<tbody>
									<?php 
										$sql = "select count(*) as num from menu_cont where up_id={$_GET['id']}";
										$row = $mysqlObj->fetchOne($sql);
										$num = $row['num'];
										$listRows = 10;
										$page = new Page($num,$listRows,$args);
										$page->set('head','条数据');
										$index = $num;
										$sql = "select * from menu_cont where up_id={$_GET['id']} order by created_at desc,id desc";
										$data = $mysqlObj->fetchAll($sql);
										$i = 0;
										foreach ($data as $info) {
											// var_dump($info);
											// exit;
											$i++;
									 ?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $info["title"] ?></td>
											<td><?php 
												if ($info['state']==1) {
													echo "<span class='label label-success'>显示</span>";
												}else{
													echo "<span class='label label-danger'>隐藏</span>";
												} 
												?>
											</td>
											<td><?php echo $info["created_at"] ?></td>
											<td><?php echo $info["add_user"] ?></td>
											<td><a href="listedit.php?id=<?php echo $_GET['id'] ?>&up_id=<?php echo $_GET['up_id'] ?>&mid=<?php echo $info['id'] ?>">编辑</a>&nbsp;
												<a class="red delete-btn" 
												href="list.php?id=<?php echo $info['up_id'] ?>&up_id=<?php echo $_GET['up_id'] ?>&cid=<?php echo $info['id'] ?>&a=del" 
												onclick="return del()">&nbsp;
													删除
												</a>&nbsp;
												<?php
													if ($info['toutiao'] == 0) {
												?>
												<a class="green" href="pic.php?id=<?php echo $info['up_id'] ?>&up_id=<?php echo $_GET['up_id'] ?>&tid=<?php echo $info['id'] ?>&a=tou">设为头条</a>
												<?php 
													}else{
												?>
												<a class="green" href="pic.php?id=<?php echo $info['up_id'] ?>&up_id=<?php echo $_GET['up_id'] ?>&tid=<?php echo $info['id'] ?>&a=qtou">取消头条</a>
												<?php
													}
												?>
											</td>
										</tr>
									<?php }; ?>
									</tbody> 
								</table>
								<div class="row">
									<div class="col-xs-12">
										<div class="dataTables_paginate paging_simple_numbers" id="dynamic-table_paginate">
											<ul class="pagination"> 
												<?php 
											echo $page->fpage(0, 4, 5, 6);
											?>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- 删除 -->
						<script>
							function del() {
								var msg = "您真的确定要删除吗？\n\n请确认！";
								if (confirm(msg)==true){
								return true;
								}else{
								return false;
								 }
								}
						</script>
						<?php 
							if (isset($_GET['a'])&&$_GET['a']=='del') {
								$cond['id']=$_GET['cid'];
								$mes=$mysqlObj->delete("menu_cont",$cond);
								if ($mes) {
									skip("list.php?id={$_GET['id']}&up_id={$_GET['up_id']}");
								}else{
									alertMes("删除失败","list.php?id={$_GET['cid']}&up_id={$_GET['up_id']}");
									exit;
								}
							}
						 ?>

						 	<!-- 设为头条&取消 -->
					<?php
						if (isset($_GET['a'])&&$_GET['a']=='tou') {
							$cond['id']=$_GET['tid'];
							$upd['toutiao'] = 1;
							$mes = $mysqlObj->update('menu_cont',$upd,$cond);
							if ($mes) {
								skip("pic.php?id={$_GET['id']}&up_id={$_GET['up_id']}");
							}else{
								js_alert("设置失败！","pic.php?id={$_GET['id']}&up_id={$_GET['up_id']}");
							}				
						}

						if (isset($_GET['a'])&&$_GET['a']=='qtou') {
							$cond['id']=$_GET['tid'];
							$upd['toutiao'] = 0;
							$mes = $mysqlObj->update('menu_cont',$upd,$cond);
							if ($mes) {
								skip("pic.php?id={$_GET['id']}&up_id={$_GET['up_id']}");
							}else{
								js_alert("设置失败！","pic.php?id={$_GET['id']}&up_id={$_GET['up_id']}");
							}				
						}
					?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php include '../inc/footer.inc.php'; ?>