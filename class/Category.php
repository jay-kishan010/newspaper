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

 	public function getPostByCat($id)
		{
			$query = mysqli_query($this->conn, "SELECT * FROM news WHERE post_cat_id = $id ORDER BY id DESC LIMIT 10");
			$str = "";
		if (mysqli_num_rows($query) === 0) {
			$str = "<h2 class='text-center text-danger'>No results found!</h2>";
		}	
		else {
			while ($row = mysqli_fetch_array($query)) {
				$id = $row['id'];
				$content = $row['content'];
				if (strlen($content) > 200) {
					$content = substr($content, 0, 200) . "...";
				}
				$category = $row['post_category'];
				$post_cat_id = $row['post_cat_id'];
				$image = $row['post_image'];
				$num_likes = $row['num_likes'];
				$num_comments = $row['num_comments'];

				$str .= "<div class='col-12 col-md-6'>
                            <div class='single-blog-post style-3'>
                                <div class='post-thumb'>
                                    <a href='single-post.php?post_id=$id&cat_r=$category'><img src='Admin/$image'></a>
                                </div>
                                <div class='post-data'>
                                    <a href='category.php?c_id=$post_cat_id' class='post-catagory'>$category</a>
                                    <a href='single-post.php?post_id=$id&cat_r=$category' class='post-title'>
                                        <h6>$content</h6>
                                    </a>
                                    <div class='post-meta d-flex align-items-center'>
                                        <a href='#' class='post-like'><img src='img/core-img/like.png'> <span>$num_likes</span></a>
                                        <a href='#' class='post-comment'><img src='img/core-img/chat.png'> <span>$num_comments</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>";
			}
		}
			echo $str;
		}
		

 	
 }