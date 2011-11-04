<?php

class Page{
	public $title;
	public $content;
	public function Page(){
		$this->title = "Register";
	}
	private function nameTaken($u){
		global $sql;
		$username = $sql->san($u);
		$q = "select username from users where username = '" . $username . "'";
		$result = $sql->query($q);
		return ($sql->numRows($result) > 0);
	}
	private function newUser($u, $p, $e){
		global $sql;
		$username = $this->sanitize($u);
		$password = $this->sanitize($p);
		$email = $this->sanitize($e);
	
		$q = "INSERT INTO users (group_id, username, password, email) VALUES (3, $username, $password, $email)";
		$sql->query($q);
	}
	private function sanitize($in){
		global $sql;
		$ret = $sql->san($in);
		return $ret;
	}
	public function main(){
		$tmp = new Template();
		if(isset($_POST['submit'])){
			if(!$this->nameTaken($_POST['uname'])){
				$this->newUser($_POST['uname'], $_POST['pword'], $_POST['email']);
				$this->content = $tmp->get("registerSuccess");
			}
			else{
				$this->content = $tmp->get("usernameTaken");
				$this->content .= $tmp->get("registerForm");
			}
		}
		else{
			$this->content = $tmp->get("registerForm");
		}
	}
}
?>
