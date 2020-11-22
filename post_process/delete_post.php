<?php
    include("../auth.php");
    require("../connect.php");
    $post_id = $_GET['id'];

    $del_post = "DELETE FROM post 
                WHERE post_id = '$post_id'";
    $result_add = mysqli_query($con, $del_post);
    if($result_add)
    {
        header("Location: index.php");
    }
    else
    {
        echo mysqli_error($con);
    }
?>