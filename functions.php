<?php

function nequal($a, $b){
	return !equal($a, $b);
}

function equal($a, $b){
	return $a == $b;
}

function _if($bool, $ifout, $elseout){
//var_dump(func_get_args());
//echo "<br/>";
	if($bool || defined("TESTING")){
		return $ifout;
	}
	return $elseout;
}

function loadSummerProgram($need, $current){
	$tmp = new Template();
	if($need == $current || defined("TESTING")){
		return $tmp->get("summer_tab");
	}
	return "";
}

function loginCheckAndContentOutput(){
	global $user;
	$tmp = new Template();
	if($user['id'] != -1){
		return $tmp->load("userinfo");
	}
	return $tmp->load("loginform");
}

function getHomeText(){
  global $user;
  if(array_search("student", $user['groups']) !== false){
    return "My Assignments";
  }
  else if(count($user['groups']) > 0){
    return "Student List";
  }
  return "Home";
}

function getUserInfo(){
	if(isset($_SESSION['uid']) && !empty($_SESSION['uid']) && $_SESSION['uid'] != ""){
		return getUserInfoById($_SESSION['uid']);
	}
	return array("id" => -1, "username" => "Guest", "groups" => array());
}

function getUserInfoById($id){
	global $sql;
	$query = "SELECT username, id FROM user WHERE id = " . $sql->san($id) . " LIMIT 1";
	$results = $sql->query($query);
	if($sql->numRows($results) != 1){
		return array("id" => -1, "username" => "Guest", "groups" => array());
	}
	$row = $sql->fetchAssoc($results);
	$user = array(
		"id" =>	$row['id'],
		"username" => $row['username'],
		"groups" =>array() 
	);
	return $user;
}

function gradeFile(){
	global $user, $config;
	$filename = slug($user['username']);
	$tmp = new Template();
  if(file_exists($confg['url'] . "grades/" . $filename . ".xlsx")){
		return $tmp->get("grade_link_xlsx");
	}
  if(file_exists($confg['url'] . "grades/" . $filename . ".xls")){
		return $tmp->get("grade_link");
	}
	return "";
}

function slug($str){
	$str = strtolower($str);
	$str = preg_replace(array("/[\s]/", "/[\-]+/"), array("-", "-"), $str);
	return $str;
}

function tabActivity($active, $inactive, $number, $activeNumber){
	if($number == $activeNumber){
		return $active;
	}
	return $inactive;
}

function userlinks(){
	global $user;
	$tmp = new Template();
	$str = "";
  if(array_search("admin", $user['groups']) !== false){
		$str .= $tmp->get("adminLinks");
	}
	if(array_search("student", $user['groups']) !== false){
		$str .= $tmp->get("studentLinks");
	}
  return $str;
}

function validTypes(){
	global $config;
	return implode(", ", $config['allowed_exts']);
}

?>
