<?php

class Page{
	public $title;
	public function Page(){
		$this->title = "Logout";
	}
	public function main(){
		global $config, $sql;
		if(isset($_SESSION['uid'])){
			$query = "DELETE FROM sessions WHERE hash = '" . $sql->san($_SESSION['uid']) . "' LIMIT 1";
			$sql->query($query);
			unset($_SESSION['uid']);
		}
		header("Location: " . $config['url']);
	}
}

?>
