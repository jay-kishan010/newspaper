<?php include 'pages/header.php'; ?>
  <!-- container section start -->
  <section id="container" class="">

    <!--header end-->
<?php include 'pages/top_nav.php'; ?>
    <!--sidebar start-->
<?php include 'pages/side_bar.php'; ?>
    <!--sidebar end-->

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <!--overview start-->
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i> Comment</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
              <li><i class="fa fa-laptop"></i>Comment</li>
            </ol>
          </div>
        </div>
      
        <div class="container row">
          <table class="table table-hover table-striped table-bordered">
            <thead>
              <th>Post ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Body</th>
              <th>Status</th>
              <th>Action</th>
            </thead>
            <tbody>
              <?php 
                echo $comment_obj->loadComments();
              ?>
            </tbody>
          </table>
        </div>
        <!--/.row-->

        <!-- Today status end -->



       
          <!--/col-->
          
            
          <!--/col-->

      



        <!-- statics end -->




        <!-- project team & activity start -->
        <br><br>

        
        <!-- project team & activity end -->

      </section>
      
    </section>
    <!--main content end-->
  </section>
  <!-- container section start -->

  <!-- javascripts -->
  <?php include 'pages/footer.php'; ?>
