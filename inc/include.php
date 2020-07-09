<?php 
	header("Content-Type:text/html;charset=utf-8");
	session_start();
	error_reporting(E_ALL ^ E_NOTICE);
	date_default_timezone_set("PRC");
	define("ROOT",dirname(__FILE__));
	// echo set_include_path(".".PATH_SEPARATOR.ROOT."/inc".PATH_SEPARATOR.get_include_path());
	require_once 'page.class.php';
	require_once 'mysql.class.php';
	require_once 'upload.class.php';
	require_once 'user.func.php';
	require_once 'admin.func.php';
    // $mysqlObj = new mysql('cysj','root','cx356.dzxx.rzpt.2016','127.0.0.1');
	// $up = new FileUpload('cysj','root','cx356.dzxx.rzpt.2016','127.0.0.1');
	$mysqlObj = new mysql('cysj','root','root','127.0.0.1');
    $up = new FileUpload('cysj','root','root','127.0.0.1');
?>