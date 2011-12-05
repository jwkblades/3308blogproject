<?php

class Page{
	public $title;
	public $content;
	public function Page(){
		$this->title = "Comment";
	}
	public function main(){
		global $sql, $config, $user;
		if($user['user_id'] == 0 || $user['can_comment'] == 0 || !isset($_POST['submit'])){
			// guest, or not allowed to comment, or no form posted
			header("Location: " . $config['url']);
			return;
		}
		$autoApprove = $user['auto_approve_comment'];
		$query = "INSERT INTO posts(`poster_id`, `article_id`, `approved`, `post`, `posted_on`) VALUES(" . $user['user_id'] . ", " . $sql->san($_POST['aid']) . ", " . $autoApprove . ", '" . $sql->san($_POST['post']) . "', NOW())";
		$sql->query($query);
		header("Location: " . $config['url'] . "?act=article&aid=" . $sql->san($_POST['aid']));
	}
}

?>
