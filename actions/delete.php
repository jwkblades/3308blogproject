<?php

class Page{
	public $title;
	public $content;
	public function Page(){
	}
	private function removePost($uid, $pid){
		global $sql;
		$q1 = "SELECT article_id FROM posts WHERE post_id = " . $sql->san($pid) . " LIMIT 1";
		$res = $sql->query($q1);
		$r1 = $sql->fetchAssoc($res);
		$q2 = "SELECT post_id FROM posts WHERE article_id = " . $r1['article_id'] . " ORDER BY posted_on ASC";
		$res2 = $sql->query($q2);
		$r2 = $sql->fetchAssoc($res2);
		if($r2['post_id'] != $pid){
			$query = "DELETE FROM posts WHERE poster_id = " . $uid . " AND post_id = " . $sql->san($pid) . " LIMIT 1";
			$sql->query($query);
		}
		return $r1['article_id'];
	}
	public function main(){
		global $user, $config;
		if(isset($_GET['pid']) && is_numeric($_GET['pid'])){
			$aid = $this->removePost($user['user_id'], $_GET['pid']);
			header("Location: " . $config['url'] . "?act=article&aid=" . $aid);
			return;
		}
		header("Location: " . $config['url']);
	}
}

?>
