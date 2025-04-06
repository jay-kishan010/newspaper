<?php 
if (isset($_GET['post_id']) && $_GET['post_id'] !== "") {
    $id = $_GET['post_id'];
    $sql = mysqli_query($connection, "SELECT num_views FROM news WHERE id=$id");
    $row = mysqli_fetch_array($sql);
    $view = $row['num_views'];
    $view++;
    mysqli_query($connection, "UPDATE news SET num_views='$view',timestamped=NOW() WHERE id=$id");
    echo $post_obj->getFullNews($_GET['post_id']); 
}
?>