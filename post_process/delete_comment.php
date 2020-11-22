<?php
    include("../auth.php");
    require("../connect.php");
    $comment_id = $_GET['id'];

    $del_comment = "DELETE FROM comment 
                WHERE comment_id = '$comment_id'";
    $result_add = mysqli_query($con, $del_comment);
    if($result_add)
    {
        header("Location: index.php");
    }
    else
    {
        echo mysqli_error($con);
    }
?>