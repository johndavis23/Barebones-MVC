<form method="post" action="<?= UrlUtils::getControllerUrl( "Login/Login") ?>">
	<table>
		<tr><td colspan="2"><em>Login:</em></td></tr>
		<tr><td><label for="username">Username:</label></td><td><input type="text" name="username" id="username" /></td></tr>
		<tr><td><label for="pass">Password:</label></td><td><input type="password"  name="pass" id="pass" />
		</td></tr>
		<tr><td></td><td><input type="submit" value="submit"/></td></tr>
	</table>
</form>