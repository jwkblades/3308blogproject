<?php

class Page{
	public $title;
	public $content;
	public function Page(){
		$this->title = "Home";
	}
	public function main(){
		global $sql, $rmut, $user;
		$page = 0;
		if(isset($_GET['file']) && is_numeric($_GET['file'])){
			$page = $_GET['file'];
		}
		$tmp = new Template();
		$query = "SELECT articles.article_id, articles.article_title, articles.poster_id FROM articles ORDER BY article_id DESC LIMIT " . ($page * 10) . ",10";
		$articles = $sql->query($query);
		$content = "";
		while($article = $sql->fetchAssoc($articles)){
			$q = "SELECT posts.post, posts.post_id, posts.posted_on, users.username FROM posts, users WHERE posts.article_id = " . $article['article_id'] . " AND users.user_id = posts.poster_id ORDER BY posted_on ASC LIMIT 1";
			$results = $sql->query($q);
			$row = $sql->fetchAssoc($results);
			if(!$row){
				continue;
			}
			$row['post'] = nl2br($row['post']);
			$row['posted_on'] = date("Y-m-d g:i A", strtotime($row['posted_on']));
			$rmut = array_merge($article, $row);
			$rmut['editLink'] = "";
			if(userCanEdit($user, $row['post_id'])){
				$rmut['editLink'] = "<a href=\"[[url]]?act=edit&cid=[[:post_id]]\">[Edit]</a>";
			}
			$content .= Replace::on($tmp->get("singleArticleListItem"));
		}
		if($content == ""){
			$content = $tmp->get("noArticlesExist");
		}
		$this->content = $content;
	}
}

?>
