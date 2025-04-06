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
            <h3 class="page-header"><i class="fa fa-laptop"></i> Users</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
              <li><i class="fa fa-laptop"></i>Users</li>
            </ol>
          </div>
        </div>
         <div class="col-md-6 mx-auto">
          <div class="card card-body bg-light">
            <h3>Add Users</h3>
            <p>Fill in all details</p>
            <form action="includes/function.php" method="POST">
              <div class="form-group">
                <input class="form-control form-control-lg" type="text" placeholder="Firstname" name="fname">
              </div>
               <div class="form-group">
                <input class="form-control form-control-lg" type="text" placeholder="Lastname" name="lname">
              </div>
               <div class="form-group">
                <input class="form-control form-control-lg" type="email" placeholder="Email" name="email">
              </div>
               <div class="form-group">
                <input class="form-control form-control-lg" type="password" placeholder="Password" name="pwd">
              </div>
               <div class="form-group">
                <select class="form-control form-control-lg" name="role">
                  <option value="Admin">Admin</option>
                  <option value="Editor">Editor</option>
                  <option value="Agent">Agent</option>
                </select>
              </div>
               <div class="form-group">
                <input class="btn btn-success btn-block" type="submit" value="Add User" name="register">
              </div>
            </form>
          </div>
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
