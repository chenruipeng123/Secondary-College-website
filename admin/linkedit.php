<?php
$ljgl = 'active open';
$ljlb = 'active';
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
					友情链接管理
				</li>
				<li class="active">友情链接添加</li>
			</ul><!-- /.breadcrumb -->
		</div>
		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<div class="tabbable">
						<ul class="nav nav-tabs" id="myTab">
							<li class="">
								<a href="link.php" title="">友情链接列表</a>
							</li>
							<li class="active">
								<a href="listadd.php" title="">友情链接添加</a>
							</li>
						</ul>
						<?php
					if (isset($_GET['a']) && $_GET['a'] == 'add') {
						$ins = $_POST;
						$created_at = date('Y-m-d,H:i:s', time());
						$ins['name'] = $_POST['name'];
						$ins['address'] = $_POST['address'];
										// $ins['cont'] = $_POST['cont'];
						$ins['created_at'] = $created_at;
										// echo "<pre>";
										// var_dump($ins);
										// exit;
						$mes = $mysqlObj->insert('link', $ins);
						if ($mes) {
							alertMes('添加成功！', 'link.php');
						} else {
							alertMes('添加失败！', 'linkadd.php');
							exit;
						}
					}
					?>
						<div class="tab-content">
							<form action="linkadd.php?a=add" class="form-horizontal" role="form" method="post">
								<!-- #section:elements.form -->

								<div class="form-group">
									<label class="col-sm-2 control-label no-padding-right" for="form-field-1">链接名称</label>
									<div class="col-sm-10">
										<input type="text" name="name" placeholder="请输入网站标题" class="col-md-4">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label no-padding-right" for="form-field-1" >链接地址</label>
									<div class="col-sm-10">
										<input type="text" name="address" placeholder="请输入以“http://”或者“https://”开头的地址" class="col-md-4">
									</div>
								</div>
								<!-- <div class="form-group">
									<label class="col-sm-2 control-label no-padding-right" for="form-field-1" >网站描述</label>
									<div class="col-sm-10">
										<textarea name="cont"></textarea>
									</div>
								</div> -->
								<div class="form-group">
									<label class="col-sm-2 control-label no-padding-right" for="form-input-readonly">添加人</label>
									<div class="col-sm-10">
										<span class="help-inline col-xs-12 col-sm-7">
											<span class="middle"><?php echo $_SESSION['adminName']; ?></span>
										</span>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label no-padding-right" for="form-input-readonly">添加时间</label>
									<div class="col-sm-10">
										<span class="help-inline col-xs-12 col-sm-7">
											<span class="middle">系统自动记录</span>
										</span>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-offset-3 col-md-9">
										<button class="btn btn-info" type="submit">
											<i class="ace-icon fa fa-check bigger-110"></i>
											提交
										</button>
										&nbsp; &nbsp; &nbsp;
										<button class="btn" type="reset">
											<i class="ace-icon fa fa-undo bigger-110"></i>
											重置
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
 </div>
 <?php include '../inc/footer.inc.php'; ?>