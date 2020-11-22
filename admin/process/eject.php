<?php
    include("../admin_auth.php");
    require("../../connect.php");
    $user_id = $_GET['id'];
    $user_delete = "DELETE FROM users
                    WHERE user_id = '$user_id'";
    $result_delete = mysqli_query($con, $user_delete);
    if($result_delete)
    {
        header("Location: user_request.php");
        exit();
    }
    else
    {
        echo mysqli_error($con);
    }
?>