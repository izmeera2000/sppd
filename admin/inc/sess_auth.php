<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
//     $link = "https"; 
// else
//     $link = "http"; 
// $link .= "://"; 
// $link .= $_SERVER['HTTP_HOST']; 
// $link .= $_SERVER['REQUEST_URI'];
// if(!isset($_SESSION['userdata']) && !strpos($link, 'login.php') && !strpos($link, 'register.php')){
// 	redirect('admin/login.php');
// }
// if(isset($_SESSION['userdata']) && strpos($link, 'login.php')){
// 	redirect('admin/index.php');
// }
// $module = array('','admin','faculty','student');
// if(isset($_SESSION['userdata']) && (strpos($link, 'index.php') || strpos($link, 'admin/')) && $_SESSION['userdata']['login_type'] !=  1){
// 	echo "<script>alert('Access Denied!');location.replace('".base_url.$module[$_SESSION['userdata']['login_type']]."');</script>";
//     exit;
// }
if(!isset($_SESSION['userdata'])){
	redirect('index.php');
}