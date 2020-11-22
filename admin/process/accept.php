<?php
    include("../admin_auth.php");
    require("../../connect.php");
    $user_id = $_GET['id'];
    $user_accept = "UPDATE users
                SET user_request = '1'
                WHERE user_id = '$user_id'";
    $result_accept = mysqli_query($con, $user_accept);
    if($result_accept)
    {
        header("Location: user_request.php");
        exit();
    }
    else
    {
        echo mysqli_error($con);
    }
?>