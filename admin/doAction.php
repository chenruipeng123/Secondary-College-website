<?php
	require_once '../inc/include.php';
	$mysqlObj = new mysql();
	$admin_id = $_SESSION['adminId'];
	switch ($_GET['a']) {
		case 'log':
			// echo 11;
			// exit;
			$username = $_POST['username'];
			$password = md5(md5($_POST['password']));
			$captcha = $_POST['captcha'];
			$remember = $_POST['remember'];
			$vcode = $_SESSION['authcode'];
			// echo $username;
			// echo $password;
			// echo $vcode;
			// exit;
			if ($captcha==$vcode) {
				$sql = "select * from super where username='$username' and password='$password'";
				// echo $sql;
				// exit;
				$rows = $mysqlObj->fetchOne($sql);
				// var_dump($rows);
				// exit;
				if ($rows) {
					$_SESSION['adminName'] = $rows['add_user'];
					$_SESSION['adminId'] = $rows['id'];
					// echo $_SESSION['adminName'];
					//------------------写入日志----------------
					$time = time();
					$ins['user'] = $_SESSION['adminName'];
					$ins['created_at'] = date("Y-m-d H:i:s",$time);
					$ins['ip'] = getIP();
					$ins['action'] = "登录成功";
					$ins['sql_cont'] = $sql;
					$ins['db_level'] = 4;
					$mysqlObj->insert("super_log",$ins);
					//------------------------------------------
					$upd['last_time'] = date("Y-m-d H:i:s",$time);
					$upd['last_ip'] = getIP();
					// echo $upd['last_time'];
					$cond['id'] = $_SESSION['adminId'];
					$mysqlObj->update("super",$upd,$cond);
					skip("index.php");
				}else{
					js_alert('登录失败!','login.php');
				}
			}else{
				js_alert('验证码错误！','login.php');
			}

			break;

		case 'logout':
			//------------------写入日志----------------
			$time = time();
			$ins['user'] = $_SESSION['adminName'];
			$ins['created_at'] = date("Y-m-d H:i:s",$time);
			$ins['ip'] = getIP();
			$ins['action'] = "注销登录";
			$ins['sql_cont'] = "";
			$ins['db_level'] = 0;
			$mysqlObj->insert("super_log",$ins);
			//------------------------------------------
			logout();
			break;

		case 'change':
			if (!empty($_POST)&&$_GET['a']=="change") {
				$oldpw = md5(md5($_POST['oldpw']));
				$newpw = md5(md5($_POST['newpw']));
				$renewpw = md5(md5($_POST['renewpw']));
				$sql = "select * from super where id = '{$_SESSION['adminId']}'";
				$rows = $mysqlObj->fetchOne($sql);
				if ($rows['password']==$oldpw) {
					if ($oldpw==$newpw&&$newpw==$renewpw) {
						js_alert("新密码与原密码相同！","pwset.php");
					}
					if ($newpw==$renewpw) {
						$arr['password'] = $newpw;
						$con['id'] = $_SESSION['adminId'];
						$aff = $mysqlObj->update("super",$arr,$con);
						if ($aff>0) {
							//------------------写入日志----------------
							$time = time();
							$ins['user'] = $_SESSION['adminName'];
							$ins['created_at'] = date("Y-m-d H:i:s",$time);
							$ins['ip'] = getIP();
							$ins['action'] = "管理员密码修改";
							$ins['sql_cont'] = $mysqlObj->getLastSql();
							$ins['db_level'] = 3;
							$mysqlObj->insert("super_log",$ins);
							//------------------------------------------
							echo "<script>alert('密码修改成功，请重新登录！');</script>";
							logout();
						}else{
							js_alert("修改失败！","pwset.php");
						}
					}else{
						js_alert("新密码与再次新密码不一致！","pwset.php");
					}
				}else{
					js_alert("原密码错误！","pwset.php");
				}
			}
			break;

		default:
			# code...
			break;
	}
