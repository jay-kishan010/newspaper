<?php require 'pages/header.php' ?>



        <!-- Navbar Area -->
	<?php require 'pages/navbar.php' ?>
    <!-- ##### Header Area End ##### -->

    <!-- ##### Hero Area Start ##### -->
    <?php require 'pages/shero.php' ?>
    <!-- ##### Hero Area End ##### -->

    <!-- ##### Blog Area Start ##### -->
    <div class="blog-area section-padding-0-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="blog-posts-area">

                        <!-- Single Featured Post -->
                        <?php include 'pages/s-news.php'; ?>

                        
                        <div class="section-heading">
                            <h6>Related</h6>
                        </div>

                        <?php include 'pages/s-related.php'; ?>

                        <!-- Comment Area Start -->
                        <div class="comment_area clearfix">
<?php
if(isset($_GET['post_id'])){
   $id = $_GET['post_id'];
$sql = mysqli_query($connection, "SELECT * FROM comments WHERE post_id=$id AND status='approved'");
$num = mysqli_num_rows($sql);
}

?>
                            <h5 class="title"><?php echo $num;?> Comments</h5>

                            <ol>

<?php
    if(isset($_GET['post_id'])){
        $id = $_GET['post_id'];
        $sql = mysqli_query($connection, "SELECT * FROM comments WHERE post_id=$id AND status='approved' ORDER BY id DESC");
        while ($row = mysqli_fetch_array($sql)) {
            $name = $row['name'];
            $body = $row['body'];

            ?>
<li class="single_comment_area">
<!-- Comment Content -->
<div class="comment-content d-flex">
<div class="comment-author">
    <img src="img/bg-img/32.jpg" alt="author">
</div>
<!-- Comment Meta -->
<div class="comment-meta">
<a href="#" class="post-author"><b><?php echo $name;?></b></a>
<p class="lead"><?php echo $body;?></p>
</div>
</div>
</li>
        <?php }
    }

?>
                           </ol>
                        </div>

                        <div class="post-a-comment-area section-padding-80-0">
                            <h4>Leave a comment</h4>
                            
                            <!-- Reply Form -->
                            <div class="contact-form-area">

<?php 
if(isset($_GET['post_id']) && isset($_GET['cat_r'])){
    $id = $_GET['post_id'];
    $post_category = $_GET['cat_r'];

    if(isset($_POST['comment-add'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $body = $_POST['body'];
        $website = $_POST['website'];

        if($comment_obj->addComment($name, $email, $body, $website, $id)){
            $msg = "<div class='alert alert-success'>You comment was added and will soon be approved by the admin</div>";
        }else{
            return false;
        }
    }
}

 ?> 
 <?php
if(isset($msg)){
    echo $msg;
}

 ?>                               
<form action="single-post.php?post_id=<?php echo $id;?>&cat_r=<?php echo $post_category;?>" method="post">
<div class="row">
    <div class="col-12 col-lg-6">
        <input type="text" class="form-control" name="name" id="name" placeholder="Name*">
    </div>
    <div class="col-12 col-lg-6">
        <input type="email" class="form-control" name="email" id="email" placeholder="Email*">
    </div>
    <div class="col-12">
        <input type="text" class="form-control" id="subject" placeholder="Website" name="website">
    </div>
    <div class="col-12">
        <textarea name="body" class="form-control" id="message" cols="30" rows="10" placeholder="Message"></textarea>
    </div>
    <div class="col-12 text-center">
        <button class="btn newspaper-btn mt-30 w-100" type="submit" name="comment-add">Submit Comment</button>
    </div>
</div>
</form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="blog-sidebar-area">
                        <!-- Popular News Widget -->
                        <div class="popular-news-widget mb-50">
                            <h3>4 Most Popular News</h3>

                            <!-- Single Popular Blog -->
                            <div class="single-popular-post">
                                <a href="#">
                                    <h6><span>1.</span> Amet, consectetur adipiscing elit. Nam eu metus sit amet odio sodales.</h6>
                                </a>
                                <p>April 14, 2018</p>
                            </div>

                            <!-- Single Popular Blog -->
                            <div class="single-popular-post">
                                <a href="#">
                                    <h6><span>2.</span> Consectetur adipiscing elit. Nam eu metus sit amet odio sodales placer.</h6>
                                </a>
                                <p>April 14, 2018</p>
                            </div>

                            <!-- Single Popular Blog -->
                            <div class="single-popular-post">
                                <a href="#">
                                    <h6><span>3.</span> Adipiscing elit. Nam eu metus sit amet odio sodales placer. Sed varius leo.</h6>
                                </a>
                                <p>April 14, 2018</p>
                            </div>

                            <!-- Single Popular Blog -->
                            <div class="single-popular-post">
                                <a href="#">
                                    <h6><span>4.</span> Eu metus sit amet odio sodales placer. Sed varius leo ac...</h6>
                                </a>
                                <p>April 14, 2018</p>
                            </div>
                        </div>

                        <!-- Newsletter Widget -->
                        <div class="newsletter-widget mb-50">
                            <h4>Newsletter</h4>
                            <p>Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                            <form action="#" method="post">
                                <input type="text" name="text" placeholder="Name">
                                <input type="email" name="email" placeholder="Email">
                                <button type="submit" class="btn w-100">Subscribe</button>
                            </form>
                        </div>

                        <!-- Latest Comments Widget -->
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Blog Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <?php require 'pages/footer.php' ?>