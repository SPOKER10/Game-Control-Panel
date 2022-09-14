<html>
	<head>
		<title>rGaming Romania - Lost Password</title>
	</head>
	<body>
		You have received this email because a password recovery<br>
		was instigated by you on rGaming Romania - Panel.<br><br>
		<hr>
		IMPORTANT!
		<hr><br>
		If you did not request this password change,please IGNORE and DELETE this<br>
		email immediately. Only continue if you wish your password to be reset !<br><br>
		<hr>
		Password Reset Instructions Below
		<hr><br>
		We require that you "validate" your password recovery to ensure that<br>
		you instigated this action. This protects against <br>
		unwanted spam and malicious abuse.<br><br>
		Simply click on the link below and complete the rest of the form.<br>
		<a href="{{ url('user/reset/'.$token) }}">{{ url('user/reset/'.$token) }}</a> <br><br>
		Note that this link expires in 1 hour.
	</body>
</html>