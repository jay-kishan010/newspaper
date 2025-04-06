<?php 

 class User {
 	private $conn;
 	private $user;

 	public function __construct($conn, $user) {
 		$this->conn = $conn;
 		$sql = mysqli_query($conn, "SELECT * FROM users WHERE username='$user'");
 		return $this->user = mysqli_fetch_array($sql);
 	}

 	public function getUserName() {
 		$username = $this->user['username'];
 		return $username;
 	}

 	public function getProfilePic() {
 		$username = $this->user['username'];
 		$sql = mysqli_query($this->conn, "SELECT profile_pic FROM users WHERE username='$username'");
 		$row = mysqli_fetch_array($sql);
 		return $row['profile_pic'];
 	}

 	public function getRole() {
 		$username = $this->user['username'];
 		$sql = mysqli_query($this->conn, "SELECT role FROM users WHERE username='$username'");
 		$row = mysqli_fetch_array($sql);
 		return $row['role'];
 	}

 	public function getID() {
 		$username = $this->user['username'];
 		$sql = mysqli_query($this->conn, "SELECT id FROM users WHERE username='$username'");
 		$row = mysqli_fetch_array($sql);
 		return $row['id'];	
 	}

 	public function getNumPosts(){
 		$username = $this->user['username'];
 		$sql = mysqli_query($this->conn, "SELECT * FROM news WHERE added_by='$username'");
 		$num_posts = mysqli_num_rows($sql);
 		return $num_posts;
 	 	}
 }

