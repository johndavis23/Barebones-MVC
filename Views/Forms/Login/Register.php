<form method="post" action="<?= UrlUtils::getControllerUrl( "Login/Register") ?>">
	<table>
		<tr><td colspan="2"><em>Register:</em></td></tr>
		<tr><td><label for="username">Username:</label></td><td><input type="text" name="username" id="username" /></td></tr>
		<tr><td><label for="email">Email:</label></td><td><input type="text" name="email" id="email" /></td></tr>
		<tr><td><label for="pass">Password:</label></td><td><input type="password"  name="pass" id="pass" />
		</td></tr>
		<tr><td></td><td><input type="submit" value="submit"/></td></tr>
	</table>
</form>