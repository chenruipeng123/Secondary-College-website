<?php 
	$tpgl = "active open";
	$lbgl = "active";
	include '../inc/include.php';
	loginCheck();
	include '../inc/header.inc.php';
	include '../inc/nav.inc.php';
	$sql = "select * from lunbo where id='{$_GET['mid']}'";
	$info = $mysqlObj->fetchOne($sql);
	if (!empty($_POST['show_order'])&&!empty($_POST['title'])) {
		if (isset($_GET['a'])&&$_GET['a']=='edit') {
			$oldfilename=$_FILES['img']['name'];
			if (!empty($oldfilename)) {
				$up = new FileUpload();
				$upload_url = "../uploads/";
				$up->set("path",$upload_url);
				$up->upload("img");
				$pic = $up->getFileName();
				// imageUpdateSize($upload_url.$pic,200,100,$pre="s_");
				$ins_menu = $_POST;
				$ins_menu['img'] = $pic;
				$updated_at = date("Y-m-d H:i:s",time());
				$cond['id'] = $_GET['mid'];
				$ins_menu['updated_at'] = $updated_at;
				$ins_menu['add_user'] = $_SESSION['adminName'];
				// var_dump($ins_menu);
				// exit;
				$mes = $mysqlObj->update("lunbo",$ins_menu,$cond);
				if ($mes) {
					alertMes("修改成功","lunbo.php");
				}else{
					alertMes("修改失败","lunboedit.php?mid={$_GET['mid']}");
					exit;
				}
			}else{
				$ins_menu = $_POST;
				$updated_at = date("Y-m-d H:i:s",time());
				$cond['id'] = $_GET['mid'];
				$ins_menu['updated_at'] = $updated_at;
				$ins_menu['add_user'] = $_SESSION['adminName'];
				// var_dump($ins);
				// exit;
				$mes = $mysqlObj->update("lunbo",$ins_menu,$cond);
				if ($mes) {
					alertMes("修改成功","lunbo.php");
				}else{
					alertMes("修改失败","lunboedit.php?mid={$_GET['mid']}");
					exit;
				}
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
				<li class="">轮播图编辑</li>
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
							<li class="">
								<a href="lunboadd.php">
									轮播图添加
								</a>
							</li>
							<li class="active">
								<a href="">
									轮播图编辑
								</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="row">
								<div class="col-xs-12">
									<form action="lunboedit.php?mid=<?php echo $_GET['mid'] ?>&a=edit" class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
										<!-- #section:elements.form -->
										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1">显示序号</label>
											<div class="col-sm-9">
												<input type="number" name="show_order" class="col-xs-10 col-sm-1" value="<?php echo $info['show_order']; ?>">

											</div>
										</div>	

										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1">标题</label>
											<div class="col-sm-9">
												<input type="text" name="title" value="<?php echo $info['title'] ?>" class="col-xs-10 col-sm-5">
											</div>
										</div>	
										<div class="form-group"> 
											<label for="file" class="col-sm-3 control-label no-padding-right no-padding-top">上传图片:</label>
											<div class="col-sm-9">
												<input type="file" name="img" id="name" />
												<!-- <span class="text-danger">(请上传像素为1180*330的图片)</span><br> -->
												<img width="100px" src="../uploads/<?php echo $info['img'] ?>" alt="">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1">显示状态</label>	
											<div class="col-sm-9">
												<div class="radio">
													<label>
														<input class="ace" <?php if($info['state']==1) echo "checked" ?> name="state" type="radio" value="1">							
														<span class="lbl"> 显示</span>
													</label>
												</div>
												<div class="radio">
													<label>
														<input class="ace" <?php if($info['state']==0) echo "checked" ?> name="state" type="radio" value="0">
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