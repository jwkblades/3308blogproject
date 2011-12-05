<?php

class Page{
	public $title;
	public $content;
	public function Page(){
	}
	private function loadPosts($aid){
		global $user, $sql, $rmut;
		$query = "SELECT posts.poster_id, posts.approved, posts.post, posts.posted_on, posts.post_id, users.username FROM posts, users WHERE article_id = " . $aid . " AND posts.poster_id = users.user_id ORDER BY posted_on ASC";
		$results = $sql->query($query);
		$content = "";
		$tmp = new Template();
		$first = true;
		while($row = $sql->fetchAssoc($results)){
			$row['posted_on'] = date("Y-m-d g:i A", strtotime($row['posted_on']));
			$row['post'] = nl2br($row['post']);
			$rmut = $row;
			$rmut['editLink'] = "";
			$view = true;
			if(!$row['approved']){
				$view = false;
			}
			if(userCanEdit($user, $row['post_id'])){
				$rmut['editLink'] = "<a href=\"[[url]]?act=edit&cid=[[:post_id]]\">[Edit]</a>";
				$view = true;
			}
			if($row['approved'] || $first){
				$rmut['approved'] = "approved";
				if($user['can_approve_comments'] && !$first){
					$rmut['approveLink'] = "<a href=\"[[url]]?act=approve&cid=[[:post_id]]&app=0\">[Unapprove]</a>";
					$view = true;
				}
			}
			else{
				$rmut['approved'] = "unapproved";
				if($user['can_unapprove_comments'] && !$first){
					$rmut['approveLink'] = "<a href=\"[[url]]?act=approve&cid=[[:post_id]]&app=1\">[Approve]</a>";
					$view = true;
				}
			}
			if($user['user_id'] == $row['poster_id'] || $first){
				$view = true;
				if(!$first){
					$rmut['deleteLink'] = "<a href=\"[[url]]?act=delete&pid=[[:post_id]]\">[Delete]</a>";
				}
			}
			if($view){
				$content .= Replace::on($tmp->get("singlePost"));
			}
			if($first){
				$first = false;
			}
		}
		return $content;
	}
	private function commentForm($aid){
		global $user, $rmut;
		$tmp = new Template();
		$content = "";
		if($user['user_id'] != 0 && $user['can_comment']){
			$rmut = array("article_id" => $aid);
			$content = Replace::on($tmp->get("commentForm"));
		}
		return $content;
	}
	public function main(){
		global $sql, $config, $rmut;
		if(!isset($_GET['aid']) || !is_numeric($_GET['aid'])){
			header("Location: " + $config['url']);
			return;
		}
		$aid = $sql->san($_GET['aid']);
		$query = "SELECT article_title from articles WHERE public = 1 AND article_id = " . $aid . " LIMIT 1";
		$titleRes = $sql->query($query);
		if($sql->numRows($titleRes) != 1){
			// no title -- meaning it is either a private article, or non-existant
			header("Location: " + $config['url']);
			return;
		}
		$rObj = $sql->fetchObj($titleRes);
		$this->title = $rObj->article_title;
		$tmp = new Template();
		$rmut = array("title" => $this->title, "content" => $this->loadPosts($aid));
		$this->content = Replace::on($tmp->get("basePage")) . $this->commentForm($aid);
	}
}

?>
