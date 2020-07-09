<?php 
	include '../inc/include.php';
	loginCheck();
	include '../inc/header.inc.php';
	include '../inc/nav.inc.php';
	if ($_POST['submit']=='提交') {
		$upd_menu = $_POST;
		$updated_at = date("Y-m-d H:i:s",time());
		$upd_menu['updated_at'] = $updated_at;
		$cond['id'] = $_GET['mid'];
		$mes = $mysqlObj->update("active_news",$upd_menu,$cond);
		if ($mes) {
			alertMes("修改成功","active.php");
		}else{
			alertMes("修改失败","active_edit.php?a=edit&mid={$cond['id']}");
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
					动态管理
				</li>
				<li class="active">动态编辑</li>
			</ul>
		</div>
		<div class="page-content">
			<div class="row">
				<div class="col-sm-12">
					<div class="tabbable">
						<ul class="nav nav-tabs" id="myTab">
							<li class="">
								<a href="active.php">
								 	动态列表
								</a>
							</li>
							<li class="">
								<a href="active_add.php">
									动态添加
								</a>
							</li>
							<li class="active">
								<a href="active_edit.php">
									动态编辑
								</a>
							</li>
						</ul>
						<?php 
							$sql = "select * from active_news where id={$_GET[mid]}";
							$row = $mysqlObj->fetchOne($sql);
						 ?>
						<div class="tab-content">
							<div class="row">
								<div class="col-xs-12">
									<form action="" class="form-horizontal" role="form" method="post">
										<!-- #section:elements.form -->
										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1">显示位置</label>
											<div class="col-sm-9">
												<input type="text" name="show_order" class="col-xs-10 col-sm-1" value="<?php echo $row['show_order'] ?>">											
											</div>
										</div>	

										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1">显示菜单</label>
											<div class="col-sm-9">
												<select id="sel" name="menu_id">
													<?php 
														$sql = "select * from menu where type != 4 and type!=1 order by show_order asc";
														$menu_rows = $mysqlObj->fetchAll($sql);
														foreach ($menu_rows as $value) {
															
													 ?>												
													<option <?php if($row['menu_id']==$value['id']){echo "selected";} ?> value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
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