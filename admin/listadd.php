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
	$info = $mysqlObj->fetchOne($sql);
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
				<li class="active"><?php echo $info['name'] ?>添加</li>
			</ul><!-- /.breadcrumb -->
		</div>
		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<div class="tabbable">
						<ul class="nav nav-tabs" id="myTab">
							<li class="">
								<a href="list.php?id=<?php echo $_GET['id'] ?>&up_id=<?php echo $_GET['up_id']?>">
									<?php echo $info['name'] ?>列表
								</a>
							</li>
							<li class="active">
								<a href="" >
									<?php echo $info['name'] ?>添加
								</a>
							</li>
						</ul>
						<?php
							if (isset($_GET['a'])&&$_GET['a']=='add') {
								$ins = $_POST;
								$created_at=date('Y-m-d,H:i:s',time());
								$ins['up_id'] = $_GET['id'];
								$ins['title']= $_POST['title'];
								$ins['cont']= $_POST['cont'];
								$ins['created_at']=$created_at;
								$ins['state']= $_POST['state'];
								$ins['add_user']=$_SESSION['adminName'];
								// echo "<pre>";
								// var_dump($ins);
								// exit;
								$mes = $mysqlObj->insert2("menu_cont",$ins);
								// var_dump($mes);
								// exit;
								if ($mes) {
									alertMes("添加成功！","list.php?id={$_GET['id']}&up_id={$_GET['up_id']}");
								}else{
									alertMes("添加失败！","listadd.php?id={$_GET['id']}&up_id={$_GET['up_id']}");
									exit;
								}
							}
						 ?>
						<div class="tab-content">
							<form action="listadd.php?id=<?php echo $_GET['id'] ?>&up_id=<?php echo $_GET['up_id']?>&a=add" class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
								<!-- #section:elements.form -->

								<div class="form-group">
									<label class="col-sm-2 control-label no-padding-right" for="form-field-1">标题</label>
									<div class="col-sm-10">
										<input type="text" name="title" placeholder="请输入标题" class="col-xs-10 col-sm-5">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label no-padding-right" for="form-field-1" >内容</label>
									<div class="col-sm-10">
										<script id="editor" name="cont"  type="text/plain" style="width:500px;height:300px;"></script>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label no-padding-right" for="form-field-1">显示状态</label>
									<div class="col-sm-10">
										<div class="radio">
											<label>
												<input class="ace" checked="" name="state" type="radio" value="1">
												<span class="lbl"> 显示</span>
											</label>
										</div>
										<div class="radio">
											<label>
												<input class="ace" name="state" type="radio" value="0">
												<span class="lbl">隐藏</span>
											</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label no-padding-right" for="form-input-readonly">添加人</label>
									<div class="col-sm-10">
										<span class="help-inline col-xs-12 col-sm-7">
											<span class="middle"><?php echo $_SESSION['adminName'] ?></span>
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