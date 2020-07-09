<?php 
	$cdgl="active open";
	$cdlb="active";
	include '../inc/include.php';
	loginCheck();
	include '../inc/header.inc.php';
	include '../inc/nav.inc.php';
	$sql = "select * from menu where up_id=0";
	$query = mysql_query($sql);
	$max = mysql_num_rows($query);
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
				<li class="active">菜单添加</li>
			</ul><!-- /.breadcrumb -->
		</div>
		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<div class="tabbable">
						<ul class="nav nav-tabs" id="myTab">
							<li class="">
								<a href="menulist.php">
									菜单列表
								</a>
							</li>
							<li class="active">
								<a href="menu_add.php" >
									菜单添加
								</a>
							</li>
						</ul>
						<?php 
						if (isset($_GET)&&$_GET['a']=='add'&&!empty($_POST['name'])) {
							// $ins = $_POST;
							$up = new FileUpload();
							// $up = new FileUpload();
							$upload_url = "../uploads/";
							$up->set("path", $upload_url);
							if ($up->upload("pic")) {
								$pic = $up->getFileName();
							}
							$ins['img'] = $pic;
							// echo $pic;
							// exit;
							$add_time = date("Y-m-d H:i:s",time());
							$ins['state'] = $_POST['state'];
							$ins['show_order'] = $_POST['show_order'];
							$ins['name'] = $_POST['name'];
							$ins['up_name'] = $_POST['up_name'];
							$ins['type'] = $_POST['type'];
							if ($ins['type']!=4) {
								$ins['up_id'] = $_POST['up'];
							}
							$ins['addr'] = $_POST['link'];			
							$ins['add_user'] = $_SESSION['adminName'];
							$ins['created_at'] = $add_time;
							// echo "<pre>";
							// var_dump($ins);
							// exit;
							$mes = $mysqlObj->insert("menu",$ins);
							if ($mes) {
								alertMes("添加成功！","menu_add.php");
							}else{
								alertMes("添加失败！","menu_add.php");
								exit;
							}
						}
						 ?>
						<div class="tab-content">
							<form action="menu_add.php?a=add" class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
								<!-- #section:elements.form -->
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1">显示序号</label>
									<div class="col-sm-9">
										<input type="number" name="show_order" class="col-xs-10 col-sm-1" value="<?php echo $max+1 ?>">
									</div>
								</div>	

								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1">菜单名称</label>
									<div class="col-sm-9">
										<input type="text" name="name" placeholder="请输入菜单名称" class="col-xs-10 col-sm-5">

									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1">菜单英文</label>
									<div class="col-sm-9">
										<input type="text" name="up_name" placeholder="请输入菜单英文，留空则无" class="col-xs-10 col-sm-5">

									</div>
								</div>	
								<!-- <div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1">菜单图标</label>
									<div class="col-sm-9">
										<input type="file" name="pic" class="col-xs-10 col-sm-5">

									</div>
								</div>	 -->
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1">显示状态</label>	
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
												<span class="lbl">隐藏</span>
											</label>
										</div>
									</div>
								</div>	
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1">菜单类型</label>
									<div class="col-sm-9">
										<select id="sel" onchange="javascript:doit2();" name="type">
											<option value="4">有下级菜单</option>
											<option value="1">图文混排</option>
											<option value="2">新闻列表</option>	
											<option value="3">图文列表</option>
											<option value="5">直接链接</option>
										</select>
									</div>
								</div>
								<script>
									$("#sel").change(function () { 
										var hide = $("#sel").val();
										if (hide == 4) {
											$("#cd").hide();
											
										}else{
											$("#cd").show();
										}
									});
								</script>
								<div class="form-group" id="cd" style="display:none" >
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1">隶属菜单</label>
									<div class="col-sm-9">
										<select id="sel" onchange="javascript:doit2();" name="up">
											<option value="0">一级菜单</option>
											<?php
												$sql = "select * from menu where type=4 order by show_order asc";
												$info = $mysqlObj->fetchAll($sql);
                                                foreach ($info as $key => $data) {
                                                    ?>
											<option value="<?php echo $data['id']?>"><?php echo $data['name']?></option>	
											<?php
                                                };
											?>
										</select>
									</div>
								</div>
								<script>
									$("#sel").change(function () { 
										var show = $("#sel").val();
										if (show == 5) {
											$("#link").show();
										}else{
											$("#link").hide();
										}
									});
								</script>
								<div class="form-group" id="link" style="display:none;">
									<label class="col-sm-3 control-label no-padding-right" for="form-input-readonly">跳转链接</label>
									<div class="col-sm-9">					
											<input type="text" name="link" placeholder="请输入链接地址" class="col-xs-10 col-sm-5">
										</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-input-readonly">添加人</label>
									<div class="col-sm-9">					
										<span class="help-inline col-xs-12 col-sm-7">
											<span class="middle"><?php echo $_SESSION['adminName'] ?></span>
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