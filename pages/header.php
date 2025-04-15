<?php 
include_once 'config/config.php';


// Fetch the latest uploaded PDF from database
$sql = "SELECT * FROM pdf ORDER BY id DESC LIMIT 1";
$result = $connection->query($sql);
$latest_pdf = $result->fetch_assoc();

$user = (isset($_SESSION['admin_user'])) ? $_SESSION['admin_user'] : "user";
include 'class/User.php';
include 'class/Category.php';
include 'class/Post.php';
include 'class/Comment.php';
include 'admin/includes/like.php';

$cat_obj = new Category($connection, $user);
$post_obj = new Post($connection, $user);
$comment_obj = new Comment($connection);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>The News Paper - News &amp; Lifestyle Magazine Template</title>
    <link rel="icon" href="img/core-img/favicon.ico">
    <link rel="stylesheet" href="style.css">

    <style>
        .pdf-viewer {
            position: fixed;
            top: 60px;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            height: 90%;
            background: #fff;
            z-index: 9999;
            border: 2px solid #333;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            display: none;
        }

        .pdf-viewer iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        .close-btn {
            position: absolute;
            top: 5px;
            right: 10px;
            font-size: 28px;
            color: #000;
            cursor: pointer;
            font-weight: bold;
            z-index: 10000;
        }

        .arya-text h1, .arya-text h5 {
            margin: 0;
            line-height: 1.2;
        }
    </style>
</head>

<body>
    <!-- ##### Header Area Start ##### -->
    <header class="header-area">
        <div class="top-header-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="top-header-content d-flex align-items-center justify-content-between">
                            <!-- Logo -->
                            <div class="logo">
                                <div class="arya-text">
                                    <h1>आर्य प्रवाह</h1>
                                    <h5>हिन्दी दैनिक</h5>
                                </div>
                            </div>

                            <!-- Login Search Area -->
                            <div class="login-search-area d-flex align-items-center">
                                <!-- Login -->
                                <?php 
                                    if (isset($_SESSION['subscriber'])) {
                                        $sub = $_SESSION['subscriber'];
                                        echo "<div class='login d-flex'>
                                                <a>Welcome $sub</a>
                                                <a href='logout.php?logout'>Logout</a>
                                              </div>"; 
                                    } else {
                                        echo '<div class="login d-flex">
                                                <a href="slogin.php">Login</a>
                                                <a href="sregister.php">Register</a>
                                              </div>';
                                    }
                                ?>

                                <!-- Search Form + View PDF Button -->
                                <div class="search-form d-flex align-items-center ms-3">
                                    

                                    <?php if ($latest_pdf): ?>
                                        <button type="button" class="btn " id="viewPdfBtn">View NewsPaper</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </header>

    <!-- ##### PDF Viewer ##### -->
    <?php if ($latest_pdf): 
        $filename = htmlspecialchars($latest_pdf['filename']);
        $filepath = "uploads/" . $filename;
    ?>
        <div id="pdfViewer" class="pdf-viewer">
            <span class="close-btn" onclick="document.getElementById('pdfViewer').style.display='none';">&times;</span>
            <iframe src="<?= $filepath ?>"></iframe>
        </div>
    <?php endif; ?>

    <!-- ##### Scripts ##### -->
    <script>
        document.getElementById('viewPdfBtn')?.addEventListener('click', function() {
            document.getElementById('pdfViewer').style.display = 'block';
        });
    </script>
</body>
</html>
