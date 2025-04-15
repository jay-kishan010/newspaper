<?php 
include 'pages/header.php'; 

?>

<!-- container section start -->
<section id="container" class="">

  <?php include 'pages/top_nav.php'; ?>
  <?php include 'pages/side_bar.php'; ?>

  <!-- main content start -->
  <section id="main-content">
    <section class="wrapper">
      <div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="fa fa-file-pdf-o"></i> Add PDF</h3>
          <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
            <li><i class="fa fa-file-pdf-o"></i> Add PDF</li>
          </ol>
        </div>
      </div>



      <div class="container row">
      <h2>Upload a file</h2>
		<form action="upload.php" method="POST" enctype="multipart/form-data">
			<div class="mb-3">
				<label for="file" class="form-label">Select file</label>
				<input type="file" class="form-control" name="file" id = "file">
			</div>
			<button type="submit" class="btn btn-primary">Upload file</button>
		</form>

      </div>

      <br><br>
    </section>
  </section>
</section>

<?php include 'pages/footer.php'; ?>
