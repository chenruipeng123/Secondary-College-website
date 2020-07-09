<?php 
	error_reporting(E_ALL||~E_NOTICE);
	/*function foreloginCheck(){
		if ($_SESSION['u_id']==""&&$_SESSION['name']=="") {
			alertMes('请先登录！。','login.php');	
		}
	}
	function forelogout(){
		$_SESSION = array();
		if (isset($_COOKIE['u_id'])&&isset($_COOKIE['name'])) {
			setcookie('u_id',"",time()-1);
			setcookie('name',"",time()-1);
		}
		session_unset();
		session_destroy();
		echo "<script>window.location='login.php';</script>";
	}*/
function js_alert($message, $url)
{
    echo "<script language=javascript>alert('";
    echo $message;
    echo "');location.href='";
    echo $url;
    echo "';</script>";
}
function alertMes($message, $url)
{
    echo "<script language=javascript>alert('";
    echo $message;
    echo "');location.href='";
    echo $url;
    echo "';</script>";
}

function skip($url = '')
{
    echo '<script>';
    //如果为空，自动跳转到上一页
    if (empty($url)) {
        echo "history.go(-1);";
    } else {
        echo 'window.location.href=\'' . $url . '\';';
    }

    echo '</script>';
    exit;
}

/**
* 获取服务器端IP地址
 * @return string
 */
// function getIP() { 
//     if (isset($_SERVER)) { 
//         if($_SERVER['SERVER_ADDR']) {
//             $server_ip = $_SERVER['SERVER_ADDR']; 
//         } else { 	
//             $server_ip = $_SERVER['LOCAL_ADDR']; 
//         } 
//     } else { 
//         $server_ip = getenv('SERVER_ADDR');
//     } 
//     return $server_ip; 
// }
function getIP()
{
    //return $_SERVER['REMOTE_ADDR'];

    if (isset($_SERVER)) {
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $realip = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            $realip = $_SERVER["REMOTE_ADDR"];
        }
    } else {
        if (getenv("HTTP_X_FORWARDED_FOR")) {
            $realip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("HTTP_CLIENT_IP")) {
            $realip = getenv("HTTP_CLIENT_IP");
        } else {
            $realip = getenv("REMOTE_ADDR");
        }
    }

    return $realip;

    ///^
}

// 或者
// function getServerIP(){    
//     return gethostbyname($_SERVER["SERVER_NAME"]);    
// } 
