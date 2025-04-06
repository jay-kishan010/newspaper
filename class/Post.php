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

				$query = mysqli_query($this->conn, "INSERT INTO news VALUES('','$title','$content','$added_by','$category','$cat_id','$image','$date','$tags','$status','$type','0','0','0',NOW());");
			}
		}

		public function getBreakingNews() 
		{
			$query = mysqli_query($this->conn, "SELECT * FROM news WHERE type='Breaking News' ORDER BY id DESC LIMIT 10");
			$str = "";
			while ($row = mysqli_fetch_array($query)) {
				$id = $row['id'];
				$title = $row['title'];
				$content = $row['content'];
				if(strlen($content) > 200) {
					$content = substr($content, 0, 200) . "...";
				}
				$cat_title = $row['post_category'];
				$post_cat_id = $row['post_cat_id'];
				$image = $row['post_image'];
				$likes = $row['num_likes'];
				$comments = $row['num_comments'];
				$date_added = $row['date_added'];

				$date_time_now = date("Y-m-d H:i:s");
				$startCount = new DateTime($date_added);
				$endCount = new DateTime($date_time_now);
				$interval = $startCount->diff($endCount);
				if($interval->h <= 10 && $interval->d < 1) {
					$rand = rand(5,7);
					$str .= "<div class='col-12 col-lg-$rand'>
                            <div class='single-blog-post featured-post-2'>
                                <div class='post-thumb'>
                                    <a href='single-post.php?post_id=$id&cat_r=$cat_title'><img src='Admin/$image'></a>
                                </div>
                                <div class='post-data'>
                                    <a href='category.php?c_id=$post_cat_id' class='post-catagory'>$cat_title</a>
                                    <div class='post-meta'>
                                        <a href='single-post.php?post_id=$id&cat_r=$cat_title' class='post-title'>
                                            <h6>$content</h6>
                                        </a>
                                        <div class='d-flex align-items-center'>
                                            <a href='index.php?like_id=$id' class='post-like'><img src='img/core-img/like.png'> <span>$likes</span></a>
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
				$id = $row['id'];
				$image = $row['post_image'];
				$content = substr($row['content'],0,60)."...";
				$date_added = $row['date_added'];
				$cat_title = $row['post_category'];
				$post_cat_id = $row['post_cat_id'];

				$str .= "<div class='single-blog-post small-featured-post d-flex'>
                        <div class='post-thumb'>
                            <a href='single-post.php?post_id=$id&cat_r=$cat_title'><img src='Admin/$image' class='img-rounded' width='100'></a>
                        </div>
                        <div class='post-data'>
                            <a href='category.php?c_id=$post_cat_id' class='post-catagory'>$cat_title</a>
                            <div class='post-meta'>
                                <a href='single-post.php?post_id=$id&cat_r=$cat_title' class='post-title'>
                                    <h6>$content</h6>
                                </a>
                                <p class='post-date'><span>$date_added</span></p>
                            </div>
                        </div>
                    </div>";
			}
			echo $str;
		}

		public function getCasualNews()
		{
			$query = mysqli_query($this->conn, "SELECT * FROM news WHERE type='Casual News' ORDER BY id DESC LIMIT 10");
			$str = "";
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
                                        <a href='index.php?like_id=$id' class='post-like'><img src='img/core-img/like.png'> <span>$num_likes</span></a>
                                        <a href='#' class='post-comment'><img src='img/core-img/chat.png'> <span>$num_comments</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>";
			}
			echo $str;
		}

		public function getPostBySearch($keyword)
		{
			$query = mysqli_query($this->conn, "SELECT * FROM news WHERE tags LIKE '%$keyword%' ORDER BY id DESC LIMIT 10");
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
                                        <a href='index.php?like_id=$id' class='post-like'><img src='img/core-img/like.png'> <span>$num_likes</span></a>
                                        <a href='#' class='post-comment'><img src='img/core-img/chat.png'> <span>$num_comments</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>";
			}
		}
			echo $str;
		}

		public function getFullNews($id)
		{
			$query = mysqli_query($this->conn, "SELECT * FROM news WHERE id=$id");
			$str = "";
			$row = mysqli_fetch_array($query);
			$id = $row['id'];
			$title = $row['title'];
			$content = $row['content'];
			$added_by = $row['added_by'];
			$post_category = $row['post_category'];
			$post_cat_id = $row['post_cat_id'];
			$image = $row['post_image'];
			$tags = explode(',', $row['tags']);
			$date_added = $row['date_added'];
			$views = $row['num_views'];
			$comments = $row['num_comments'];
			$num_likes = $row['num_likes'];
			$str_tags = "";
			foreach ($tags as $tag) {
				$str_tags .= "<a href='tags.php?tag=$tag' class='btn btn-primary'>$tag</a>" . " ";
			}

			$str .= "<div class='single-blog-post featured-post single-post'>
                            <div class='post-thumb'>
                                <a href='single-post.php?post_id=$id&cat_r=$post_category'><img src='Admin/$image'></a>
                            </div>
                            <div class='post-data'>
                                <a href='category.php?c_id=$post_cat_id' class='post-catagory'>$post_category</a>
                                <a href='single-post.php?post_id=$id&cat_r=$post_category' class='post-title'>
                                    <h6>$title</h6>
                                </a>
                                <div class='post-meta'>
                                    <p class='post-author'>By <a href='#'>$added_by</a></p>
                                    <p>$content</p>
                                    <div class='newspaper-post-like d-flex align-items-center justify-content-between'>
                                        <div class='newspaper-tags d-flex'>
                                            <span>Tags: $str_tags</span>
                                        </div>

                                        <!-- Post Like & Post Comment -->
                                        <div class='d-flex align-items-center post-like--comments'>
                                            <a href='single-post.php?post_id=$id&cat_r=$post_category&like_id=$id' class='post-like'><img src='img/core-img/like.png'> <span>$num_likes</span></a>
                                            <a href='#' class='post-comment'><img src='img/core-img/chat.png'> <span>$comments</span></a>&nbsp; &nbsp;
                                            <span><i class='fa fa-eye'></i> $views</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>";

                        return $str;
		}
		
		public function getPopularNews() 
		{
			$query = mysqli_query($this->conn, "SELECT * FROM news WHERE timestamped>DATE_SUB(curdate(),INTERVAL 1 WEEK) ORDER BY num_views DESC LIMIT 10");
			$str = "";
			while ($row = mysqli_fetch_array($query)) {
				$id = $row['id'];
				$content = $row['content'];
				if (strlen($content) > 200) {
					$content = substr($content, 0, 200) . "...";
				}
				$category = $row['post_category'];
				$image = $row['post_image'];
				$num_likes = $row['num_likes'];
				$post_cat_id = $row['post_cat_id'];
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
                                        <a href='index.php?like_id=$id' class='post-like'><img src='img/core-img/like.png'> <span>$num_likes</span></a>
                                        <a href='#' class='post-comment'><img src='img/core-img/chat.png'> <span>$num_comments</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>";
			}
			echo $str;
		}

		public function getNewsByTags($tag)
		{
			$query = mysqli_query($this->conn, "SELECT * FROM news WHERE tags LIKE '%$tag%' ORDER BY id DESC LIMIT 10");
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
				$image = $row['post_image'];
				$post_cat_id = $row['post_cat_id'];
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
                                        <a href='index.php?like_id=$id' class='post-like'><img src='img/core-img/like.png'> <span>$num_likes</span></a>
                                        <a href='#' class='post-comment'><img src='img/core-img/chat.png'> <span>$num_comments</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>";
			}
		}
			echo $str;
		}

		public function getWorldNews() {
			$query = mysqli_query($this->conn, "SELECT * FROM news WHERE post_category='International News' ORDER BY id DESC LIMIT 5");
			$str = "";
			while ($row = mysqli_fetch_assoc($query)) {
				$id = $row['id'];
				$content = substr($row['content'], 0, 50) . "...";
				$image = $row['post_image'];
				$date = $row['date_added'];
				$category = $row['post_category'];
				$post_cat_id = $row['post_cat_id'];
				$str .= "<div class='single-blog-post style-2'>
                        <div class='post-thumb'>
                            <a href='single-post.php?post_id=$id&cat_r=$category'><img src='Admin/$image'></a>
                        </div>
                        <div class='post-data'>
                            <a href='single-post.php?post_id=$id&cat_r=$category' class='post-title'>
                                <h6>$content</h6>
                            </a>
                            <div class='post-meta'>
                                <div class='post-date'><a href=''>$date</a></div>
                            </div>
                        </div>
                    </div>";
			}
			echo $str;
		}

		public function getRecentNews() 
		{
			$query = mysqli_query($this->conn, "SELECT * FROM news WHERE timestamped>DATE_SUB(curdate(),INTERVAL 1 WEEK) ORDER BY num_views DESC LIMIT 4");
			$str = "";
			while ($row = mysqli_fetch_array($query)) {
				$id = $row['id'];
				$content = $row['content'];
				if (strlen($content) > 200) {
					$content = substr($content, 0, 50) . "...";
				}
				$category = $row['post_category'];
				$date_added = $row['date_added'];
				$post_cat_id = $row['post_cat_id'];

				$str .= " <div class='single-popular-post'>
                            <a href='single-post.php?post_id=$id&cat_r=$category'>
                                <h6>$content</h6>
                            </a>
                            <p>$date_added</p>
                        </div>";
			}
			echo $str;
		}

	}