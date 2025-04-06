<?php 
$conn = mysqli_connect('localhost','root','','news');
if(isset($_GET['like_id'])){
	if(isset($_SESSION['subscriber'])){
		$user = $_SESSION['subscriber'];
		$id = $_GET['like_id'];
		$query = mysqli_query($conn, "SELECT * FROM likes WHERE post_id=$id AND user='$user'");
		if(mysqli_num_rows($query) == 0){
			$sql = mysqli_query($conn, "INSERT INTO likes VALUES('','$user','$id','like');");
			if($sql){
				$stmt = mysqli_query($conn, "SELECT num_likes FROM news WHERE id=$id"); //pull
				$row = mysqli_fetch_array($stmt);//modify
				$num_likes = $row['num_likes'];//modifying
				$num_likes++;//modified
				$sql = mysqli_query($conn, "UPDATE news SET num_likes='$num_likes' WHERE id=$id");//push
			}
		}else{

			$query = mysqli_query($conn, "SELECT * FROM likes WHERE post_id=$id AND user='$user'");
			$row = mysqli_fetch_array($query);
			$type = $row['type'];

			if($type === 'un_like'){
				$sql = mysqli_query($conn, "UPDATE likes SET type='like' WHERE post_id=$id AND user='$user'");
				if($sql){
					$stmt = mysqli_query($conn, "SELECT num_likes FROM news WHERE id=$id"); //pull
					$row = mysqli_fetch_array($stmt);//modify
					$num_likes = $row['num_likes'];//modifying
					$num_likes++;//modified
					$sql = mysqli_query($conn, "UPDATE news SET num_likes='$num_likes' WHERE id=$id");//push
				}
			} else{
				$sql = mysqli_query($conn, "UPDATE likes SET type='un_like' WHERE post_id=$id AND user='$user'");
				if($sql){
					$stmt = mysqli_query($conn, "SELECT num_likes FROM news WHERE id=$id"); //pull
					$row = mysqli_fetch_array($stmt);//modify
					$num_likes = $row['num_likes'];//modifying
					$num_likes--;//modified
					$sql = mysqli_query($conn, "UPDATE news SET num_likes='$num_likes' WHERE id=$id");//push
				}
			}

		
		}
	}
	else{
		header("Location: slogin.php");
	}
}



