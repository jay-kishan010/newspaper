<?php  
$mysqli = new mysqli("localhost","root","","news") or die(mysqli_error($mysqli));
$error = [];
if(isset($_POST['register'])) {
	 $firstname = clean($_POST['firstname']);
     $lastname = clean($_POST['lastname']);
	 $email = clean($_POST['email']);
	 $pwd = $_POST['pwd'];

	if(empty($firstname) && empty($lastname)) {
		array_push($error, "firstname and lastname are required");
		header("Location: ../../nw-admin.php?message=firstname_and_lastname_are_required");
	}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		array_push($error, "email is invalid");
		header("Location: ../../nw-admin.php?message=email_is_invalid");
	}elseif (empty($email)) {
		array_push($error, "email is required");
		header("Location: ../../nw-admin.php?message=email_is_required");
	}else{
		if(empty($pwd)) {
			array_push($error, "password is required");
			header("Location: ../../nw-admin.php?message=password_is_required");
		}else{
			if(strlen($pwd) <= 5) {
				array_push($error, "password is too short");
				header("Location: ../../nw-admin.php?message=password_is_too_short");
			}
		}
	}

	if(empty($error)) {
		$username = $firstname . " " . $lastname;
		$hashedPwd = md5($pwd);
		$rand = rand(1,3);
		switch ($rand) {
			case '1':
				$profile_pic = "assets/images/profile_pics/default/head_1.png";
				break;
			case '2':
				$profile_pic = "assets/images/profile_pics/default/head_2.png";
				break;
			case '3':
				$profile_pic = "assets/images/profile_pics/default/head_3.png";
				break;
			
		}
		$role = "Admin";
		$query = mysqli_query($mysqli, "INSERT INTO users VALUES('','$username','$firstname','$lastname','$email','$hashedPwd','$profile_pic','$role','0');");
		if($query) {
			header("Location: ../../nw-admin.php?message=login_now😂");
		}
	}
}

function clean($data) {
	 global $mysqli;
	 $data = htmlspecialchars($data);
     $data = strip_tags($data);
     $data = trim($data);
     $data = mysqli_real_escape_string($mysqli, $data);
     return $data;
}