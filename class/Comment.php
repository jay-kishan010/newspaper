<?php 
	class Comment {

		private $conn;

		public function __construct($conn){
			$this->conn = $conn;
		}

		public function addComment($name, $email, $body, $website = "", $id){
			$name = mysqli_real_escape_string($this->conn, $name);
			$name = strip_tags($name);
			$email = mysqli_real_escape_string($this->conn, $email);
			$email = strip_tags($email);
			$body = mysqli_real_escape_string($this->conn, $body);
			$body = nl2br($body);

			if(isset($_SESSION['subscriber'])){
				$name = $_SESSION['subscriber'];
			}
			if(empty($name)){
				$name = "Anonymous";
			}

			if(!empty($email) && !empty($body)){
				$sql = mysqli_query($this->conn, "INSERT INTO comments (post_id,name,email,body) VALUES('$id','$name','$email','$body')");
				if($sql){
					return true;
				}else {
					die("Failed ". mysqli_error($this->conn));
				}
			}
		}

		public function loadComments(){
			$sql = mysqli_query($this->conn, "SELECT * FROM comments ORDER BY status DESC");
			while ($row = mysqli_fetch_assoc($sql)) {
				$id = $row['id'];
				$post_id = $row['post_id'];
				$name = $row['name'];
				$email = $row['email'];
				$body = $row['body'];
				$status = $row['status'];
				?>

				<tr>
					<td><?php echo $post_id;?></td>
					<td><?php echo $name;?></td>
					<td><?php echo $email;?></td>
					<td><?php echo $body;?></td>
					<td><?php echo $status;?></td>
					<?php
						if($status === "unapproved"){
							echo "<td><a href='includes/function.php?a_com_id=$id' class='btn btn-primary'>Approve</a></td>";
						}else{
							echo "<td><a href='includes/function.php?u_com_id=$id' class='btn btn-danger'>Unapprove</a></td>";
						}
					?>

				</tr>

			<?php }
		}




	}