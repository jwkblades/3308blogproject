<?php

class Page{
	public $title;
	public $content;
	public function Page(){
		$this->title = "Edit";
	}
	private function savePost($uid, $cid){
		global $sql;
		$query = "UPDATE posts SET post = '" . $sql->san($_POST['post']) . "' WHERE post_id = " . $sql->san($cid) . " AND poster_id = " . $uid . " LIMIT 1";
	}
	private function loadPost($uid, $cid){
		global $sql, $rmut;
		$tmp = new Template();
		$query = "SELECT post_id, post FROM posts WHERE post_id = " . $sql->san($cid) . " AND poster_id = " . $uid . " LIMIT 1";
		$res = $sql->query($query);
		if($sql->numRows($res)){
			$rmut = $sql->fetchAssoc($res);
			$this->content = Replace::on($tmp->get("editPostForm"));
		}
		else{
			$this->content = $tmp->get("noPostError");
		}
	}
	public function main(){
		global $user, $config;
		$cid = $_GET['cid'];
		if(!is_numeric($cid)){
			header("Location: " . $config['url']);
			return;
		}
		if(userCanEdit($user, $cid)){
			if(isset($_POST['submit'])){
				$this->savePost($user['user_id'], $cid);
				$tmp = new Template();
				$this->content = $tmp->get("editSaved");
			}
			else{
				$this->loadPost($user['user_id'], $cid);
			}
		}
		else{
			header("Location: " . $config['url']);
			return;
		}
	}
}

?>
