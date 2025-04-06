<div class="featured-post-area">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-8">
                    <div class="row" style="margin-top: 15px;">

                     <?php
                     if (isset($_GET['c_id']) && $_GET['c_id'] !== "") {
                         $cat_obj->getPostByCat($_GET['c_id']); 
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