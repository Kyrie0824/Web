<?php 
session_start();
require 'server.php'; 

if( isset($_POST["login"])) 
{

	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

	if(mysqli_num_rows($result) == 1)
	{
		$row = mysqli_fetch_assoc($result);
		if (password_verify($password, $row["password"]) )
		{
			$_SESSION["login"] = true;
			echo "<script>
					alert('berhasil masuk');window.location='index.php'</script>";
			
		}
	}
	$error = true;
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>LoginL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php if(isset($error)): ?>
	<p  style="color : red; font-style: italic;">username/password salah</p>
	<?php endif; ?>
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="">
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
  </form>
</body>
</html>