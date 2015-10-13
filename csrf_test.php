<html>
	<head>
		<title>CSRF Test</title>
	</head>
	<body>
		<form method="POST" action="register.php">
						<input type="text" name="tfb_name" placeholder="USERNAME" value="danger" /><br />
						<input type="text" name="address" placeholder="ADDRESS" value="danger" /><br />
						<input type="text" name="tfb_email1" placeholder="EMAIL" value="danger"/><br />
						<input type="text" name="tfb_email2" placeholder="REPEAT EMAIL" value="danger"/><br/>
						<input type="password" name="tfb_password1" placeholder="PASSWORD" value="danger"/><br />
						<input type="password" name="tfb_password2" placeholder="REPEAT PASSWORD" value="danger"/><br />
						<input type="submit" class="submit_button_login" name="submit" value="CREATE ACCOUNT" />
					</form>
	</body>
</html>
