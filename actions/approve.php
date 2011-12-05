<?php

class Page{
	public $title;
	public $content;
	public function Page(){
	}
	public function main(){
		global $config, $user, $sql;
		$type = $_GET['app'];
		$pid = $_GET['cid'];
		if(($type == "1" && $user['can_approve_comments']) || ($type == "0" && $user['can_unapprove_comments'])){
			$query = "UPDATE posts SET approved = " . $sql->san($type) . " WHERE post_id = " . $sql->san($pid) . " LIMIT 1";
			$sql->query($query);
			$query = "SELECT article_id FROM posts WHERE post_id = " . $sql->san($pid) . " LIMIT 1";
			$res = $sql->query($query);
			$row = $sql->fetchAssoc($res);
			header("Location: " . $config['url'] . "?act=article&aid=" . $row['article_id'] . "");
			return;
		}
		header("Location: " . $config['url']);
	}
}

?>
