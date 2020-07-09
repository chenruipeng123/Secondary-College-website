<?php 
$ljgl = "active open";
$ljlb = "active";
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
				链接管理
			</li>
			<li class="active">链接列表</li>
		</ul>
	</div>

	<div class="page-content">
		<div class="row">
			<div class="col-xs-12">
				<div class="tabbable">
					<ul class="nav nav-tabs" id="myTab">
						<li class="active">
							<a href="link.php">
							 	链接列表
							</a>
						</li>
						<li class="">
							<a href="linkadd.php">
							 	链接添加
							</a>
						</li>
					</ul>

					<div class="tab-content">
						<div id="home" class="tab-pane fade active in">
							<table id="simple-table" class="table  table-bordered table-hover">
								<thead>
									<tr>
										<th>序号</th>
										<th>链接名称</th>
										<th>链接分类</th>
										<th>链接地址</th>
										<!-- <th>大体内容</th> -->
										<th>添加时间</th>
										<th>操作</th>
									</tr>
								</thead>
								<tbody>
									<?php 
								$sql = "select count(*) as num from link";
								$row = $mysqlObj->fetchOne($sql);
								$num = $row['num'];
								$listRows = 8;
								$page = new Page($num, $listRows, $args);
								$page->set('head', '条数据');
								$index = $num;
								$i = 0;
								$sql = "SELECT * from link order by created_at desc {$page->limit}";
								$data = $mysqlObj->fetchAll($sql);
								foreach ($data as $info) {
									$i++;
									?>
									<tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $info["name"]; ?></td>
										<td>
											<?php
												switch ($info['type']) {
													case '1':
														echo "校内链接";
														break;
													case '2':
														echo "校外链接";
														break;
													case '3':
														echo "设计网站链接";
														break;
													default:
														echo "暂无分类";
														break;
												}
											?>
										</td>
										<td><?php echo $info["addr"] ?></td>
										<td><?php echo $info["created_at"] ?></td>
										<td><a class="red" href="link.php?a=del&cid=<?php echo $info['id'] ?>" onclick="return del()">删除</a></td>
									</tr>
									<?php 
							} ?>
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
				if (isset($_GET["a"]) && $_GET["a"] == "del") {
					$cond['id'] = $_GET['cid'];
					$mes = $mysqlObj->delete("link", $cond);
					if ($mes) {
						skip("link.php");
					} else {
						alertMes("删除失败！", "link.php");
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