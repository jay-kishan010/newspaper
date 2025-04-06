<div class="featured-post-area">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-8">
                    <div class="row">

                     <?php
                     if (isset($_GET['s']) && $_GET['s'] !== "") {
                         $post_obj->getPostBySearch($_GET['s']); 
                     }else {
                        header("Location: index.php");
                     }
                      
                      ?>
                    </div>
                </div>

                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>