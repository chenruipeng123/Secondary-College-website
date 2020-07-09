<?php 
	$cdgl="active open";
	$cdlb="active";
	include '../inc/include.php';
	loginCheck();
	include '../inc/header.inc.php';
	include '../inc/nav.inc.php';
	if ($_POST['submit']=='提交') {
		$upd_menu = $_POST;
		$updated_at = date("Y-m-d H:i:s",time());
		$upd_menu['updated_at'] = $updated_at;
		$upd_menu['up_id'] = $_POST['up'];
		$upd_menu['up_name'] = $_POST['up_name'];
		$upd_menu['addr'] = $_POST['addr'];
		$cond['id'] = $_GET['mid'];
		$mes = $mysqlObj->update("menu",$upd_menu,$cond);
		// var_dump($mes);	
		// exit;
		if ($mes) {
			alertMes("修改成功","menulist.php");
		}else{
			alertMes("修改失败","medit.php?a=edit&mid={$cond['id']}");
			exit;
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
					菜单管理
				</li>
				<li class="active">菜单编辑</li>
			</ul>
		</div>
		<div class="page-content">
			<div class="row">
				<div class="col-sm-12">
					<div class="tabbable">
						<ul class="nav nav-tabs" id="myTab">
							<li class="">
								<a href="menulist.php">
								 	菜单列表
								</a>
							</li>
							<li class="">
								<a href="menu_add.php">
									菜单添加
								</a>
							</li>
							<li class="active">
								<a href="medit.php">
									菜单编辑
								</a>
							</li>
						</ul>
						<?php 
							$sql = "select * from menu where id={$_GET[mid]}";
							$row = $mysqlObj->fetchOne($sql);
						 ?>
						<div class="tab-content">
							<div class="row">
								<div class="col-xs-12">
									<form action="" class="form-horizontal" role="form" method="post">
										<!-- #section:elements.form -->
										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1">显示序号</label>
											<div class="col-sm-9">
												<input type="text" name="show_order" class="col-xs-10 col-sm-1" value="<?php echo $row['show_order'] ?>">

											</div>
										</div>	

										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1">菜单名称</label>
											<div class="col-sm-9">
												<input type="text" name="name" value="<?php echo $row['name'] ?>" class="col-xs-10 col-sm-5">

											</div>
										</div>	
										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1">菜单英文</label>
											<div class="col-sm-9">
												<input type="text" name="up_name" value="<?php echo $row['up_name']?>" class="col-xs-10 col-sm-5">

											</div>
										</div>	
										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1">显示状态</label>	
											<div class="col-sm-9">
												<div class="radio">
													<label>
														<input class="ace" <?php if($row['state']==1) echo "checked";?>  name="state" type="radio" value="1">							
														<span class="lbl"> 显示</span>
													</label>
												</div>
												<div class="radio">
													<label>
														<input class="ace" <?php if($row['state']==0) echo "checked";?> name="state" type="radio" value="0">
														<span class="lbl"> 隐藏</span>
													</label>
												</div>
											</div>
										</div>	
										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1">菜单类型</label>
											<div class="col-sm-9">
												<select id="sel" onchange="javascript:doit2();" name="type">
													<option value="1" <?php if ($row['type'] == 1) echo "selected"; ?>>图文混排</option>
													<option value="2" <?php if($row['type']==2) echo "selected";?>>新闻列表</option>
													<option value="3" <?php if ($row['type'] == 3) echo "selected"; ?>>图文列表</option>
													<option value="4" <?php if ($row['type'] == 4) echo "selected"; ?>>有下级菜单</option>
													<option value="5" <?php if ($row['type'] == 5) echo "selected"; ?>>直接链接</option>
												</select>
											</div>
										</div>	
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
													<option value="<?php echo $data['id']?>" <?php if ($data['id'] == $row['up_id']) echo "selected"; ?>>
													<?php echo $data['name']?></option>	
													<?php
														};
													?>
												</select>
											</div>
										</div>	
										<script>
											var hide = $("#sel").val();
											if (hide == 4) {
												$("#cd").hide();
											}else{
												$("#cd").show();
											}
											$("#sel").change(function () { 
												var hide1 = $("#sel").val();
												if (hide1 == 4) {
													$("#cd").hide();
													
												}else{
													$("#cd").show();
												}
											});
										</script>
										<div class="form-group" id="link" style="display:none;">
											<label class="col-sm-3 control-label no-padding-right" for="form-input-readonly">跳转链接</label>
											<div class="col-sm-9">					
													<input type="text" name="addr" value="<?php echo $row['addr']?>" class="col-xs-10 col-sm-5">
												</span>
											</div>
										</div>
										<script>
												var show = $("#sel").val();
												if (show == 5) {
													// alert(0);
													$("#link").show();
												}else{
													$("#link").hide();
												}
												$("#sel").change(function () { 
													var show1 = $("#sel").val();
													if (show1 == 5) {
														$("#link").show();
													}else{
														$("#link").hide();
													}
												});
										</script>
										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-input-readonly">添加人</label>
											<div class="col-sm-9">					
												<span class="help-inline col-xs-12 col-sm-7">
													<span class="middle">admin</span>
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
											<button class="btn btn-info" type="submit" value="提交" name="submit">
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
 <?php include '../inc/footer.inc.php'; ?>