<?php

class Page{
	public $title;
	public $content;
	public function Page(){
		$this->title = "Home";
	}
	public function main(){
		$tmp = new Template();
		$this->content = $tmp->get("home");
	}
}

?>
