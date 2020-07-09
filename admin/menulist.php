<?php 
	$cdgl="active open";
	$cdlb="active";
	include '../inc/include.php';
	loginCheck();
	include '../inc/header.inc.php';
	include '../inc/nav.inc.php';
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
					菜单管理
				</li>
				<li class="active">菜单列表</li>
			</ul><!-- /.breadcrumb -->
		</div>
		
		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<div class="tabbable">
						<ul class="nav nav-tabs" id="myTab">
							<li class="active">
								<a href="menulist.php">
									菜单列表
								</a>
							</li>
							<li class="">
								<a href="menu_add.php" >
									菜单添加
								</a>
							</li>
						</ul>
						<div class="tab-content">
							<table id="simple-table" class="table  table-bordered table-hover">
								<thead>
									<tr>
										<th>显示序号</th>
										<th>菜单名称</th>
										<th>菜单英文</th>
										<th>显示状态</th>
										<th>类型</th>
										<th>创建时间</th>
										<th>添加人</th>
										<th>操作</th>
									</tr>
								</thead>

								<tbody>
									<?php 
										$sql = "select count(*) as num from menu where up_id = 0";
										$row = $mysqlObj->fetchOne($sql);
										$num = $row['num'];
										$listRows = 6;
										$page = new Page($num,$listRows,$args);
										$page->set('head','条数据');
										$index = $num;
										$sql = "select * from menu where up_id=0 order by show_order asc {$page->limit}";
										$rows = $mysqlObj->fetchAll($sql);
										$i=0;
										foreach ($rows as $data) {
											$i++;
									 ?>
									<tr>
	     								<td><?php echo $data['show_order']; ?></td>
										 <td style="font-size:14px;font-weight:bold"><?php echo $data['name'] ?></td>
										 <td><?php echo $data['up_name']; ?></td>
	     								<td>
	     									<?php 
	     										if ($data['state']==1) {
	     											echo "<span class='label label-success'>显示</span>";
	     										}else{
	     											echo "<span class='label label-danger'>隐藏</span>";
	     										}
	     									 ?>
	     								</td>
	     					
	     								<td>
	     									<?php 
	     										switch ($data['type']) {
	     											case '1':
	     												echo "图文混排";
	     												break;
	     											case '2':
	     												echo "新闻列表";
	     												break;
	     											case '3':
	     												echo "图文列表";
	     												break;
	     											case '4':
														echo "有下级菜单";
														 break;
													case '5':
														echo "直接链接";
														 break;
	     										}
	     									 ?>
	     								</td>
	     								<td><?php echo $data['created_at'] ?></td>
	     								<td><?php echo $data['add_user'] ?></td>
	     								<td><a  href="medit.php?a=edit&mid=<?php echo $data['id'] ?>">编辑</a> <a class="red"  href="menulist.php?a=del&cid=<?php echo $data['id'] ?>" onclick="return del()">删除</a></td>
									</tr>
									<?php
										$sql = "select * from menu where type!=4 and up_id={$data['id']} order by show_order asc";
										$rows = $mysqlObj->fetchAll($sql);
										$i=0;
										foreach ($rows as $data) {
											$i++;		 
									?>
									<tr>
	     								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;├───<?php echo $i; ?></td>
										<td><?php echo $data['name'] ?></td>
										<td>无</td>
	     								<td>
	     									<?php 
	     										if ($data['state']==1) {
	     											echo "<span class='label label-success'>显示</span>";
	     										}else{
	     											echo "<span class='label label-danger'>隐藏</span>";
	     										}
	     									 ?>
	     								</td>
	     								<td>
	     									<?php 
	     										switch ($data['type']) {
	     											case '1':
	     												echo "图文混排";
	     												break;
	     											case '2':
	     												echo "新闻列表";
	     												break;
	     											case '3':
	     												echo "图文列表";
	     												break;
	     											case '4':
														echo "有下级菜单";
														 break;
													case '5':
														echo "直接链接";
														 break;
	     										}
	     									 ?>
	     								</td>
	     								<td><?php echo $data['created_at'] ?></td>
	     								<td><?php echo $data['add_user'] ?></td>
	     								<td><a  href="medit.php?a=edit&mid=<?php echo $data['id'] ?>">编辑</a> <a class="red"  href="menulist.php?a=del&cid=<?php echo $data['id'] ?>" onclick="return del()">删除</a></td>
									</tr>
									<?php
											 };
										 };
									 ?>
								</tbody>
							</table>
								<div class="row">
									<div class="col-xs-12">
										<div class="dataTables_paginate paging_simple_numbers" id="dynamic-table_paginate">
											<ul class="pagination"> 
												<?php 
													echo $page->fpage(0,4,5,6);
												?>
											</ul>
										</div>
									</div>
								</div>
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
									// $sql = "select * from menu where id={$_GET['cid']}";
									// $cont_row = $mysqlObj->fetchOne($sql);
									$mes = $mysqlObj->delete("menu",$cond);
									if ($mes) {
										skip("menulist.php");
									}else{
										alertMes("删除失败","menulist.php");
										exit;
									}
								}
							 ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><!-- /.main-content -->
 <?php include '../inc/footer.inc.php'; ?>