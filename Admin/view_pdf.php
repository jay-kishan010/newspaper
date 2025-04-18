<?php
// Database connection details
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "news";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the uploaded files from the database
$sql = "SELECT * FROM pdf";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Uploaded Files</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Uploaded Files</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>File Name</th>
                    <th>File Size</th>
                    <th>File Type</th>
                    <th>Preview</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Display the uploaded files and provide preview and download links
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $file_path = "uploads/" . urlencode($row['filename']);
                        $absolute_path = realpath($file_path);

                        // Check if the file exists
                        if (file_exists($absolute_path)) {
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['filename']); ?></td>
                                <td><?php echo htmlspecialchars($row['filesize']); ?> bytes</td>
                                <td><?php echo htmlspecialchars($row['filetype']); ?></td>
                                <td>
                                    <a href="<?php echo htmlspecialchars($file_path); ?>" 
                                       target="_blank" 
                                       class="btn btn-warning">
                                       Preview
                                    </a>
                                </td>
                                <td>
                                    <a href="<?php echo htmlspecialchars($file_path); ?>" 
                                       class="btn btn-primary" 
                                       download>
                                       Download
                                    </a>
                                </td>
                            </tr>
                            <?php
                        } else {
                            ?>
                            <tr>
                                <td colspan="5" class="text-danger">File not found: <?php echo htmlspecialchars($row['filename']); ?></td>
                            </tr>
                            <?php
                        }
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="5">No files uploaded yet.</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
$conn->close();
?>
