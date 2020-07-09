<?php 
	$dtgl="active open";
	$dtlb="active";
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
					动态管理
				</li>
				<li class="active">动态列表</li>
			</ul><!-- /.breadcrumb -->
		</div>
		
		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<div class="tabbable">
						<ul class="nav nav-tabs" id="myTab">
							<li class="active">
								<a href="active.php">
									动态列表
								</a>
							</li>
							<li class="">
								<a href="active_add.php" >
									动态添加
								</a>
							</li>
						</ul>
						<div class="tab-content">
							<table id="simple-table" class="table  table-bordered table-hover">
								<thead>
									<tr>
										<th>序号</th>
										<th>动态名称</th>
										<th>显示位置</th>
										<th>添加时间</th>
										<th>添加人</th>
										<th>操作</th>
									</tr>
								</thead>

								<tbody>
									<?php 
										$sql = "select * from active_news order by show_order asc";
										$rows = $mysqlObj->fetchAll($sql);
										$i=0;
										foreach ($rows as $data) {
											$i++;
									 ?>
									<tr>
	     								<td><?php echo $i; ?></td>
	     								<td>
											 <?php
												 $sql = "select * from menu where id= {$data['menu_id']}";
												 $info = $mysqlObj->fetchAll($sql);
												//  var_dump($info);
												 echo $info[0]["name"];
											 ?>
										 </td>
	     								<td><?php echo $data['show_order'] ?></td>
	     								<td><?php echo $data['created_at'] ?></td>
	     								<td><?php echo $data['add_user'] ?></td>
	     								<td><a  href="active_edit.php?a=edit&mid=<?php echo $data['id'] ?>">编辑</a> 
										 <a class="red"  href="active.php?a=del&cid=<?php echo $data['id'] ?>" onclick="return del()">删除</a></td>
									</tr>
									<?php }; ?>
								</tbody>
							</table>
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
									$mes = $mysqlObj->delete("active_news",$cond);
									if ($mes) {
										skip("active.php");
									}else{
										alertMes("删除失败","active.php");
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