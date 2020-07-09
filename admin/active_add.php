<?php
$dtgl = "active open";
$dtlb = "active";
include '../inc/include.php';
loginCheck();
include '../inc/header.inc.php';
include '../inc/nav.inc.php';
$sql = "select * from active_news";
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
					动态管理
				</li>
				<li class="active">动态添加</li>
			</ul><!-- /.breadcrumb -->
		</div>
		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<div class="tabbable">
						<ul class="nav nav-tabs" id="myTab">
							<li class="">
								<a href="active.php">
									动态列表
								</a>
							</li>
							<li class="active">
								<a href="active_add.php" >
									动态添加
								</a>
							</li>
						</ul>
						<?php
							if (isset($_GET) && $_GET['a'] == 'add' && !empty($_POST['show_order'])) {
								// $ins = $_POST;
								$add_time = date("Y-m-d H:i:s", time());
								$ins['show_order'] = $_POST['show_order'];
								$ins['menu_id'] = $_POST['menu_id'];
								$ins['add_user'] = $_SESSION['adminName'];
								$ins['created_at'] = $add_time;
								$mes = $mysqlObj->insert("active_news", $ins);
								if ($mes) {
									alertMes("添加成功！", "active_add.php");
								} else {
									alertMes("添加失败！", "active_add.php");
									exit;
								}
							}
						?>
						<div class="tab-content">
							<form action="active_add.php?a=add" class="form-horizontal" role="form" method="post">
								<!-- #section:elements.form -->
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1">显示位置</label>
									<div class="col-sm-9">
										<input type="number" name="show_order" class="col-xs-10 col-sm-1" value="<?php echo $max + 1 ?>">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1">显示菜单</label>
									<div class="col-sm-9">
										<select id="sel" name="menu_id">
											<?php 
												$sql = "select * from menu where type!=1 order by show_order asc";
												$menu_rows = $mysqlObj->fetchAll($sql);
												foreach ($menu_rows as $value) {
												?>												
											<option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
											<?php 
												}
												?>
										</select>
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
 <?php include '../inc/footer.inc.php';?>