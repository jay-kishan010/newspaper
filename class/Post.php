<?php  
	class Post
	{
		private $conn;
		private $user_obj;

		public function __construct($conn, $user)
		{
			$this->conn = $conn;
			$this->user_obj = new User($conn, $user);
		}

		public function addNews($title, $content, $category, $status, $type, $tags, $image)
		{
			if(!empty($title) && !empty($content)) 
			{
				$title = strtoupper($title);
				$title = mysqli_real_escape_string($this->conn, $title);
				$content = nl2br($content);
				$content = mysqli_real_escape_string($this->conn, $content);
				$added_by = $this->user_obj->getUserName();
				$sql = mysqli_query($this->conn, "SELECT id FROM category WHERE cat_title='$category'");
				$row = mysqli_fetch_array($sql);
				$cat_id = $row['id'];
				$date = date("Y-m-d H:i:s");

				$query = mysqli_query($this->conn, "INSERT INTO news VALUES('','$title','$content','$added_by','$category','$cat_id','$image','$tags','$status','$type','0','0','0');");
			}
		}

		public function getBreakingNews() 
		{
			$query = mysqli_query($this->conn, "SELECT * FROM news WHERE type='Breaking News' ORDER BY RAND()");
			$str = "";
			while ($row = mysqli_fetch_array($query)) {
				$id = $row['id'];
				$title = $row['title'];
				$content = $row['content'];
				if(strlen($content) > 200) {
					$content = substr($content, 0, 200) . "...";
				}
				$cat_title = $row['post_category'];
				$cat_id = $row['post_cat_id'];
				$image = $row['post_image'];
				$likes = $row['num_likes'];
				$comments = $row['num_comments'];
				$date_added = $row['date_added'];

				$date_time_now = date("Y-m-d H:i:s");
				$startCount = new DateTime($date_added);
				$endCount = new DateTime($date_time_now);
				$interval = $startCount->diff($endCount);
				if($interval->h <= 10) {
					$rand = rand(5,7);
					$str .= "<div class='col-12 col-lg-$rand'>
                            <div class='single-blog-post featured-post-2'>
                                <div class='post-thumb'>
                                    <a href='#'><img src='Admin/$image'></a>
                                </div>
                                <div class='post-data'>
                                    <a href='#' class='post-catagory'>$cat_title</a>
                                    <div class='post-meta'>
                                        <a href='#' class='post-title'>
                                            <h6>$content</h6>
                                        </a>
                                        <div class='d-flex align-items-center'>
                                            <a href='#' class='post-like'><img src='img/core-img/like.png'> <span>$likes</span></a>
                                            <a href='#' class='post-comment'><img src='img/core-img/chat.png'> <span>$comments</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>";
				}
			}

			echo $str;
		}

		public function getFeaturedNews()
		{
			$query = mysqli_query($this->conn, "SELECT * FROM news ORDER BY RAND() LIMIT 5");
			$str = "";
			while ($row = mysqli_fetch_array($query)) {
				$image = $row['post_image'];
				$content = substr($row['content'],0,60)."...";
				$date_added = $row['date_added'];
				$cat_title = $row['post_category'];

				$str .= "<div class='single-blog-post small-featured-post d-flex'>
                        <div class='post-thumb'>
                            <a href='#'><img src='Admin/$image' class='img-rounded' width='100'></a>
                        </div>
                        <div class='post-data'>
                            <a href='#' class='post-catagory'>$cat_title</a>
                            <div class='post-meta'>
                                <a href='#' class='post-title'>
                                    <h6>$content</h6>
                                </a>
                                <p class='post-date'><span>$date_added</span></p>
                            </div>
                        </div>
                    </div>";
			}
			echo $str;
		}
	}