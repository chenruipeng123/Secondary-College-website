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
	$sql1 = "select * from menu_cont where up_id={$_GET['id']} and id={$_GET['mid']}";
	$rows = $mysqlObj->fetchOne($sql1);
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
				<li class="active"><?php echo $info['name'] ?>编辑</li>
			</ul><!-- /.breadcrumb -->
		</div>
		<div class="page-content">			
			<div class="row">
				<div class="col-xs-12">
					<div class="tabbable">
						<ul class="nav nav-tabs" id="myTab">
							<li class="">
								<a href="list.php?id=<?php echo $_GET['id']?>&up_id=<?php echo $_GET['up_id'] ?>">
									<?php echo $info['name'] ?>列表
								</a>
							</li>
							<li class="">
								<a href="listadd.php?id=<?php echo $_GET['id']?>&up_id=<?php echo $_GET['up_id']?>" >
									<?php echo $info['name'] ?>添加
								</a>
							</li>
							<li class="active">
								<a href=""><?php echo $info['name'] ?>编辑</a>
							</li>
						</ul>
						<?php 

							if (isset($_GET['a'])&&$_GET['a']=='edit') {
								$upd_menu = $_POST;
								$updated_at = date("Y-m-d H:i:s",time());
								$upd_menu['updated_at'] = $updated_at;
								$upd_menu['title'] =  $_POST['name'];
								$upd_menu['cont'] =  $_POST['cont'];
								$upd_menu['state'] = $_POST['state'];
								$upd_menu['add_user'] = $_SESSION['adminName'];
								$cond['id'] = $_GET['mid'];
								$mes = $mysqlObj->update("menu_cont",$upd_menu,$cond);
								// var_dump($upd_menu);
								// exit;
								if ($mes) {
									alertMes("修改成功","list.php?id={$_GET['id']}&up_id={$_GET['up_id']}");
								}else{
									alertMes("修改失败","listedit.php?id={$_GET['id']}&up_id={$_GET['up_id']}&mid={$_GET['mid']}");
									exit;
								}
							}
						 ?>
						<div class="tab-content">
							<form action="listedit.php?id=<?php echo $_GET['id'] ?>&up_id=<?php echo $_GET['up_id']?>&mid=<?php echo $_GET['mid'] ?>&a=edit" class="form-horizontal" role="form" method="post">
								<!-- #section:elements.form -->
								
								<div class="form-group">
									<label class="col-sm-2 control-label no-padding-right" for="form-field-1">标题</label>
									<div class="col-sm-10">
										<input type="text" name="name" value="<?php echo $rows['title'] ?>" class="col-xs-10 col-sm-5">
									</div>
								</div>	
								<div class="form-group">
									<label class="col-sm-2 control-label no-padding-right" for="form-field-1" >内容</label>
									<div class="col-sm-10">
										<script id="editor" name="cont"  type="text/plain" style="width:500px;height:300px;"><?php echo $rows['cont'] ?></script>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label no-padding-right" for="form-field-1">显示状态</label>	
									<div class="col-sm-10">
										<div class="radio">
											<label>
												<input class="ace" <?php if($rows['state']==1) echo 'checked';?> name="state" type="radio" value="1">							
												<span class="lbl"> 显示</span>
											</label>
										</div>
										<div class="radio">
											<label>
												<input class="ace" <?php if($rows['state']==0) echo 'checked';?> name="state" type="radio" value="0">
												<span class="lbl">隐藏</span>
											</label>
										</div>
									</div>
								</div>	
								<div class="form-group">
									<label class="col-sm-2 control-label no-padding-right" for="form-input-readonly">修改人</label>
									<div class="col-sm-10">	
										<span class="help-inline col-xs-12 col-sm-7">
											<span class="middle"><?php echo $_SESSION['adminName'] ?></span>
										</span>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label no-padding-right" for="form-input-readonly">修改时间</label>
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