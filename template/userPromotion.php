<form action="[[url]]?act=userPromotion" method="post">
	<input type="text" name="author" placeholder="Author"/>
	<br/>
	<select name = "Groups">
	<option value = "1">Admin</option>
	<option value = "2">Moderator</option>
	<option value = "3">Member</option>
	<option value = "4">Trusted Member</option>
	<option value = "5">Banned</option>
	</select>
	<br/>
	<input type="submit" name="submit" value="Update Permissions"/>
</form>
