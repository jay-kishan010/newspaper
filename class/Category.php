<?php 

 class Category {
 	private $conn;
 	private $user_obj;

 	public function __construct($conn, $user) {
 		$this->conn = $conn;
 		$this->user_obj = new User($conn, $user);
 	}

 	public function addCategory($category) {
 		if (!empty($category)) {
 			$query = mysqli_query($this->conn, "INSERT INTO category VALUES('','$category');");
 			($query) ?  true :  false;
 		}else {
 			return false;
 		}
 	}

 	public function getAdminCategory() {
 		$query = mysqli_query($this->conn, "SELECT * FROM category ORDER BY cat_title ASC");
 		$str = "";
 		$role = $this->user_obj->getRole();

 		while ($row = mysqli_fetch_array($query)) {
 			$id = $row['id'];
 			$cat_title = $row['cat_title'];

 			if($role === 'Admin') {
 				$str .= "<tr>" .
 						"<td>{$id}</td>".
 						"<td>{$cat_title}</td>".
 						"<td><a href='edit_category.php?cat_id=$id' class='btn btn-primary'>Edit</a></td>".
 						"<td><a href='category.php?d_cat_id=$id' class='btn btn-danger'>Delete</a></td>".
 						"</tr>";
 			}else {
 				$str .= "<tr>" .
 						"<td>{$id}</td>".
 						"<td>{$cat_title}</td>".
 						"</tr>";
 			}
 		}

 		echo $str; 
 	}

 	public function updateCategory($id, $category) {
 		$query = mysqli_query($this->conn, "UPDATE category SET cat_title='$category' WHERE id=$id");
 		if ($query) {
 			return true;
 		} else{
 			return false;
 		}
 	}

 	public function deleteCategory($id) {
 		$query = mysqli_query($this->conn, "DELETE FROM category WHERE id=$id");
 		if($query) {
 			return true;
 		} else {
 			return false;
 		}
 	}

 	public function getAllCategory() {
 		$query = mysqli_query($this->conn, "SELECT * FROM category ORDER BY cat_title ASC");
 		$str = "";
 		while ($row = mysqli_fetch_array($query)) {
 			$cat_title = $row['cat_title'];
 			$cat_id = $row['id'];
 			$str .= "<li><a href='category.php?c_id=$cat_id'>$cat_title</a></li>";
 		}
 		echo $str;
 	}
 }