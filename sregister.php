<?php require 'pages/header.php' ?>
<?php 
if(isset($_POST['register'])){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];

	if(!empty($name) && !empty($email) && !empty($password)){
		$password = password_hash($password, PASSWORD_DEFAULT);
		$sql = mysqli_query($connection, "INSERT INTO subscribers VALUES('','$name','$email','$password');");
		if($sql){
			header("Location: slogin.php");
		}
	}
}

?>
<div class="row mt-3">
	<div class="col-md-6 mx-auto">
		<h4>Register to become a Subscriber</h4>
		<p>Fill in all details</p>
		<form action="" method="POST">
			<label>Username</label>
			<div class="form-group">
				<input type="text" name="name" value="" class="form-control form-control-lg">
			</div>
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
						<input type="submit" name="register" value="Register" class="btn btn-success btn-block">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<a href="slogin.php" class="btn btn-block bg-light">Have an Account? Login</a>
					</div>
				</div>
			</div>
			
		</form>
	</div>
</div>