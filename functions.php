<?php

function nequal($a, $b){
	return !equal($a, $b);
}

function equal($a, $b){
	return $a == $b;
}

function _if($bool, $ifout, $elseout){
	if($bool){
		return $ifout;
	}
	return $elseout;
}

function isLoggedIn(){
	return isset($_SESSION['uid']);
}

function getUserInfo(){
	global $sql;
	$user = array('user_id' => 0);
	if(isset($_SESSION['uid'])){
		$query = "SELECT user_id FROM sessions WHERE hash = '" . $sql->san($_SESSION['uid']) . "' LIMIT 1";
		$res = $sql->query($query);
		if($sql->numRows($res) == 1){
			$row = $sql->fetchAssoc($res);
			$id = $row['user_id'];
			$query = "SELECT users.user_id, users.username, users.email, users.group_id, groups.group_name, groups.can_post_article, groups.can_comment, groups.auto_approve_comment, groups.can_approve_comments, groups.can_unapprove_comments, groups.banned FROM users LEFT JOIN groups ON users.group_id = groups.group_id WHERE users.user_id = " . $id . " LIMIT 1";
			$results = $sql->query($query);
			$user = $sql->fetchAssoc($results);
		}
	}
	return $user;
}

function loginOrUserLinks($uid){
	$tmp = new Template();
	if($uid == '0'){
		return $tmp->get("loginRegister");
	}
	return $tmp->get("userlinks");
}

function slug($str){
	$str = strtolower($str);
	$str = preg_replace(array("/[\s]/", "/[\-]+/"), array("-", "-"), $str);
	return $str;
}

function userlinks(){
	global $user;
	$content = "";
	$tmp = new Template();
	if($user['can_post_article'] == 1){
		$content .= $tmp->get("articlePostLink");
	}
	return $content;
}

?>
