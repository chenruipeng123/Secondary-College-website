<?php 
	$tpgl = "active open";
	$zsgl = "active";
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
					图片管理
				</li>
				<li class="active">Banner图管理</li>
			</ul>
		</div>

		<div class="page-content">
			<div class="row">
				<div class="col-sm-12">
					<div class="tabbable">
						<ul class="nav nav-tabs" id="myTab">
							<li class="active">
								<a data-toggle="tab" href="#home" aria-expanded="true">
								 	Banner图列表
								</a>
							</li>
							<li class="show">
								<a href='display_add.php'>
									Banner图添加
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
											<th>图片</th>
											<th>显示状态</th>
											<th>创建时间</th>
											<th>修改时间</th>
											<th>添加人</th>
											<th>操作</th>
										</tr>
									</thead>
									<tbody>
										<?php 
											$i = 0;
											$sql = "select * from display order by show_order asc";
											$mes = $mysqlObj->fetchAll($sql);
											foreach ($mes as $info) {
												$i++;
										?>
										<tr id="content">
											<td><?php echo $info['show_order']; ?></td>
											<td><?php echo $info["title"]; ?></td>
											<td><img width="100" src="../uploads/<?php echo $info['img'] ?>" alt=""></td>
											<td><?php 
												if ($info['state']==1) {
													echo "<span class='label label-sm label-success'>显示</span>";
												}else{
													echo "<span class='label label-sm label-danger'>隐藏</span>";
												} 
												?>
											</td>
											<td><?php echo $info["created_at"] ?></td>
											<td><?php echo $info["updated_at"] ?></td>
											<td><?php echo $info["add_user"] ?></td>
											<td><a href="display_edit.php?mid=<?php echo $info['id'] ?>">修改</a>&nbsp;&nbsp;<a href="display.php?cid=<?php echo $info['id'] ?>&a=del" class="red" onclick="return del()">删除</a></td>
										</tr>
										<?php  } ?>
									</tbody> 
								</table>
							</div>
						</div>
						<script>
								$(document).ready(function () {
									var content = $('#content').text();
									if (content != "") {
										$('.show').attr('class','hide');
									}
								});
						</script>	
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
								$mes=$mysqlObj->delete("display",$cond);
								if ($mes) {
									skip("display.php");
								}else{
									alertMes("删除失败","display.php");
									exit;
								}
							}
						 ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php include '../inc/footer.inc.php'; ?>