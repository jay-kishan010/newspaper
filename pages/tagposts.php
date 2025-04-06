<div class="featured-post-area">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-8">
                    <div class="row">
                     <?php 
                     if (isset($_GET['tag'])) {
                         $tag = $_GET['tag'];
                         $post_obj->getNewsByTags($tag); 
                     }
                     
                     ?>
                    </div>
                </div>

                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>