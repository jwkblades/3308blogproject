<?php

class Page{
	public $title;
	public $content;
	public function Page(){
		$this->title = "Login";
	}
	private function login(){
		global $sql;
		$query = "SELECT user_id AS id FROM users WHERE username = '" . $sql->san($_POST['uname']) . "' AND password = '" . md5($sql->san($_POST['pword'])) . "' LIMIT 1";
		$results = $sql->query($query);
		if($sql->numRows($results) == 1){
			$row = $sql->fetchAssoc($results);
			$id = $row['id'];
			$timestamp = date();
			$date = date("Y-m-d");
			$hash = md5($date . $id . $timestamp . "THIS IS A SECRET KEY");
			$query = "INSERT INTO sessions(`user_id`, `hash`, `created_on`) VALUES(" . $id . ", '" . $hash . "', DATE('" . $date . "'));";
			$sql->query($query);
			$_SESSION['uid'] = $hash;
		}
		else{
			unset($_SESSION['uid']);
			return false;
		}
		return true;
	}
	public function main(){
		global $config;
		$tmp = new Template();
		if(isset($_POST['submit'])){
			if(!$this->login()){
				$this->content = $tmp->get("invalidLoginInfo");
			}
			else{
				header("Location: " . $config['url']);
			}
			return;
		}
		$this->content = $tmp->get("loginForm");
	}
}

?>
