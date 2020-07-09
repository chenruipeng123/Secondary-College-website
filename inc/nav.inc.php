<div class="main-container ace-save-state" id="main-container">

			<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<a href="#" style="color:#fff">后</a>
						</button>

						<button class="btn btn-info">
							<a href="#" style="color:#fff">台</a>
						</button>

						<button class="btn btn-warning">
							<a href="#" style="color:#fff">管</a>
						</button>

						<button class="btn btn-danger">
							<a href="#" style="color:#fff">理</a>
						</button>

					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li class="<?php echo $hyfw;?>">
						<a href="../admin/index.php">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> 欢迎访问 </span>
						</a>
					</li>
					<li class="<?php echo $cdgl; ?>">
						<a href="menulist.php" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text">
								菜单管理
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<?php echo $cdlb;?>">
								<a href="menulist.php">
									<i class="menu-icon fa fa-caret-right"></i>
									菜单列表
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<?php echo $nrgl; ?>">
								<a href="" class="dropdown-toggle">
									<span class="menu-text">
										内容管理
									</span>
									<b class="arrow fa fa-angle-down"></b>
								</a>
								<b class="arrow"></b>
								<ul class="submenu">
									<?php 
										// $menu_type1_1 = "list_add.php?id=";
										$menu_type1_1 = "list.php?id=";
										$menu_type3_1 = "pic.php?id=";
										$menu_type2_1 = "content.php?id=";
										$sql = "select * from menu  where up_id=0 and type!=5 order by show_order asc";
										$rows = $mysqlObj->fetchAll($sql);
										foreach ($rows as $data) {
											
									 ?>
									<li class="<?php
									 	if ($data['id']==$yjcd_up) {
											 echo "active open";
										 }elseif($data['id']==$_GET['id'])
										 {
											echo "active";
											}
									
									?>">	
									<?php
										if ($data['type']==4) {
											echo "<a href='#' class='dropdown-toggle'>";
										}
										elseif($data['type']==2) {
											echo "<a href=".$menu_type1_1.$data['id']."&up_id=".$data['up_id'].">";
										}elseif ($data['type']==1) {
											echo "<a href=".$menu_type2_1.$data['id']."&up_id=".$data['up_id'].">";
										}elseif ($data['type'] == 3) {
											echo  "<a href=".$menu_type3_1.$data['id']."&up_id=".$data['up_id'].">";
										}
									?>
											<span class="menu-text">
												<?php echo $data['name']?>
											</span>
											<?php 
												if ($data['type'] == 4) {
													echo "<b class='arrow fa fa-angle-down'></b>";
												}
											?>
											
										</a>
										<b class="arrow"></b>
										<ul class="submenu">	
											<?php 
												// $menu_type1_1 = "list_add.php?id=";
												$menu_type1_1 = "list.php?id=";
												$menu_type3_1 = "pic.php?id=";
												$menu_type2_1 = "content.php?id=";
												$sql = "select * from menu  where type!=4 and type != 5 and up_id={$data['id']} order by show_order asc";
												$rows = $mysqlObj->fetchAll($sql);
												foreach ($rows as $data) {
											?>
											<li class="<?php
												 if($data['id'] == $_GET['id']){
                                                     echo "active";
                                                 }
											 ?>">	
												<?php  
												if ($data['type']==2) {
													echo "<a href=".$menu_type1_1.$data['id']."&up_id=".$data['up_id'].">";
												}elseif ($data['type']==1) {
													echo "<a href=".$menu_type2_1.$data['id']."&up_id=".$data['up_id'].">";
												}elseif ($data['type'] == 3) {
													echo  "<a href=".$menu_type3_1.$data['id']."&up_id=".$data['up_id'].">";
												}
													echo $data["name"];
												?>
												</a>
												<b class="arrow"></b>										
											</li>
										<?php }; ?>
										</ul>
									</li>
								<?php }; ?>
								</ul>
							</li>
						</ul>
					</li>
					<li class="<?php echo $dtgl; ?>">
						<a href="" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text">
								动态管理
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<?php echo $dtlb; ?>">
								<a href="../admin/active.php">
									<i class="menu-icon fa fa-caret-right"></i>
									动态列表
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					<li class="<?php echo $tpgl; ?>">
						<a href="" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text">
								图片管理
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<?php echo $lbgl; ?>">
								<a href="../admin/lunbo.php">
									<i class="menu-icon fa fa-caret-right"></i>
									轮播图管理
								</a>

								<b class="arrow"></b>
							</li>
							<li class="<?php echo $zsgl; ?>">
								<a href="../admin/display.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Banner图管理
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					<li class="<?php echo $ljgl; ?>">
						<a href="" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text">
								链接管理
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<?php echo $ljlb; ?>">
								<a href="../admin/link.php">
									<i class="menu-icon fa fa-caret-right"></i>
									链接列表
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					<li class="<?php echo $aqsz; ?>">
						<a href="menulist.php" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text">
								安全设置
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
						<li class="<?php echo $rzck; ?>">
								<a href="../admin/slog.php">
									<i class="menu-icon fa fa-caret-right"></i>
									日志查看
								</a>

								<b class="arrow"></b>
							</li>
							<li class="<?php echo $mmxg; ?>">
								<a href="../admin/pwset.php">
									<i class="menu-icon fa fa-caret-right"></i>
									密码修改
								</a>
							</li>
							<li>
								<a href="../admin/doAction.php?a=logout">
									<i class="menu-icon fa fa-caret-right"></i>
									安全退出
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>
			