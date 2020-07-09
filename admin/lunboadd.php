<?php 
	$tpgl = "active open";
	$lbgl = "active";
	include '../inc/include.php';
	loginCheck();
	include '../inc/header.inc.php';
	include '../inc/nav.inc.php';
	$sql = "select * from lunbo";
	$exc = mysql_query($sql);
	$max = mysql_num_rows($exc);
	if (!empty($_POST['show_order'])&&!empty($_POST['title'])) {
		if (isset($_GET['a'])&&$_GET['a']=='add') {
			$up = new FileUpload();
			$upload_url = "../uploads/";
			$up->set("path",$upload_url);
			$up->upload("img");
			$pic = $up->getFileName();
			// imageUpdateSize($upload_url.$pic,200,100,$pre="s_");
			$ins_menu = $_POST;
			$created_at = date("Y-m-d H:i:s",time());
			$ins_menu['img'] = $pic;
			// var_dump($ins_menu['img']);
			// exit;
			$ins_menu['created_at'] = $created_at;
			$ins_menu['add_user'] = $_SESSION['adminName'];
			$mes = $mysqlObj->insert("lunbo",$ins_menu);
			if ($mes) {
				alertMes("添加成功","lunbo.php");
			}
		}
	}

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
				<li class="active">轮播图添加</li>
			</ul>
		</div>

		<div class="page-content">
			<div class="row">
				<div class="col-sm-12">
					<div class="tabbable">
						<ul class="nav nav-tabs" id="myTab">
							<li class="">
								<a href="lunbo.php">
								 	轮播图列表
								</a>
							</li>
							<li class="active">
								<a href="lunboadd.php">
									轮播图添加
								</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="row">
								<div class="col-xs-12">
									<form action="lunboadd.php?a=add" class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
										<!-- #section:elements.form -->
										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1">显示序号</label>
											<div class="col-sm-9">
												<input type="number" name="show_order" class="col-xs-10 col-sm-1" value="<?php echo $max+1; ?>">

											</div>
										</div>	

										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1">标题</label>
											<div class="col-sm-9">
												<input type="text" name="title" placeholder="请输入标题" class="col-xs-10 col-sm-5">
											</div>
										</div>	
										<div class="form-group"> 
											<label for="file" class="col-sm-3 control-label no-padding-right no-padding-top">上传图片:</label>
											<div class="col-sm-9">
												<input type="file" name="img" id="name" />
												<!-- <span class="text-danger">(请上传像素为1180*330的图片)</span> -->
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label no	-padding-right" for="form-field-1">显示状态</label>	
											<div class="col-sm-9">
												<div class="radio">
													<label>
														<input class="ace" checked="" name="state" type="radio" value="1">							
														<span class="lbl"> 显示</span>
													</label>
												</div>
												<div class="radio">
													<label>
														<input class="ace" name="state" type="radio" value="0">
														<span class="lbl"> 隐藏</span>
													</label>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-input-readonly">添加人</label>
											<div class="col-sm-9">					
												<span class="help-inline col-xs-12 col-sm-7">
													<span class="middle"><?php echo $_SESSION['adminName']; ?></span>
												</span>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-input-readonly">添加时间</label>
											<div class="col-sm-9">					
												<span class="help-inline col-xs-12 col-sm-7">
													<span class="middle">系统自动记录</span>
												</span>
											</div>
										</div>

										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" type="submit" value="提交">
												<i class="ace-icon fa fa-check bigger-110"></i>
												提交
											</button>
											&nbsp; &nbsp; &nbsp;
											<button class="btn" type="reset">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												重置
											</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php 
		include '../inc/footer.inc.php';
	 ?>