<?php
session_start();

require_once "config.php";
require_once "classes/MySQL.php";
require_once "classes/Replace.php";
require_once "classes/Template.php";
require_once "functions.php";


$sql = new Mysql($settings['mysqlUser'], $settings['mysqlPass'], $settings['mysqlHost']);
$sql->select($settings['mysqlDb']);
$rmut = array();

$act = $_GET['act'];
//
if(empty($act)){
 $act = "home";
}
//
$act = stripslashes($act);
$page = array();
$user = getUserInfo();
//
if(file_exists("actions/" . $act . ".php")){
  require_once "actions/" . $act . ".php";
	$mainPage = new Page();
	$mainPage->main();
	$page = get_object_vars($mainPage);
}
else{
	header("Location: " . $config['url']);
}

$template = new Template();
$main = $template->get("main");
echo Replace::on($main);

$sql->close();
session_write_close();
?>
