<?
global $sql;

function nameTaken($u)
{
	global $sql;
	$username = $sql -> san($u);
	$q = "select username from users where username = '$username'";
	$result = $sql -> query($q);
	return ($sql -> numrows($result) > 0);
}

function newUser($u, $p, $e)
{
	global $sql;
	$username = sanitize($u);
	$password = sanitize($p);
	$email = sanitize($e);
	
	$q = "INSERT INTO users (group_id, username, password, email) VALUES (3, $username, $password, $email)";
	$sql -> query($q);
}

function sanitize($in)
{
	global $sql;
	$ret = $sql -> san($in);
	return $ret;
}
?>
