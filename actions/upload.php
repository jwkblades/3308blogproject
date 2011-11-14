<?php

class Page{
	public $content;
	public $title;
	public function Page(){
		$this->title = "Upload";
	}
	private function upload(){
		$tmp = new Template();
		$exts = array("png", "jpg", "jpeg", "gif");
		$ext = basename($_FILES['file']['name']);
		$eparts = explode(".", $ext);
		$ext = $eparts[count($eparts) - 1];
		if($_FILES['file']['error']){
			$this->content = $tmp->get("uploadError");
			return;
		}
		$target = "uploads/" . basename($_FILES['file']['name']);

		if(array_search($ext, $exts) !== false){
			if(move_uploaded_file($_FILES['file']['tmp_name'], $target)){
				$this->content = $tmp->get("uploadSuccess");
			}
			else{
				$this->content = $tmp->get("uploadFailed");
			}
		}
		else{
			$this->content = $tmp->get("invalidFileType");
		}
	}
	public function main(){
		global $user, $config;
		
		if($user['can_post_article'] == 1){
			$tmp = new Template();
			if(isset($_POST['submit'])){
				$this->upload();
			}
			else{
				$this->content = $tmp->get("uploadForm");
			}
		}
		else{
			header("Location: " . $config['url']);
			return;
		}
	}
}

?>
