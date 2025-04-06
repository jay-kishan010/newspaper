<?php require 'pages/header.php' ?>
<?php 
if(isset($_POST['login'])){
	$email = $_POST['email'];
	$password = $_POST['password'];
	if(!empty($email) && !empty($password)){
		$sql = mysqli_query($connection, "SELECT * FROM subscribers WHERE email='$email'");
		if(mysqli_num_rows($sql) > 0){
			$row = mysqli_fetch_array($sql);

			$db_email = $row['email'];
			$db_password = $row['password'];
			$db_id = $row['id'];
			$db_name = $row['name'];

			if(password_verify($password, $db_password)){
				$_SESSION['subscriber'] = $db_name;
				header("Location: index.php");
			}
			else{
				die("Failed");
			}
		}
	}
}


 ?>
<div class="row mt-3">
	<div class="col-md-6 mx-auto">
		<h4>Login</h4>
		<p>Fill in all details</p>
		<form action="" method="POST">
			<label>Email</label>
			<div class="form-group">
				<input type="email" name="email" value="" class="form-control form-control-lg">
			</div>
			<label>Password</label>
			<div class="form-group">
				<input type="password" name="password" value="" class="form-control form-control-lg">
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<input type="submit" name="login" value="Login" class="btn btn-success btn-block">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<a href="sregister.php" class="btn btn-block bg-light">Need an Account? Register</a>
					</div>
				</div>
			</div>
			
		</form>
	</div>
</div>