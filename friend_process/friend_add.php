<?php
    include("../auth.php");
    require("../connect.php");
    $user_id = $_GET['id'];

    $friend_add = "INSERT INTO friends (user_a, user_b, friend_request)
                    VALUE ('$_SESSION[user_id]', '$user_id', '0')";
    $result_add = mysqli_query($con, $friend_add);
    if($result_add)
    {
        header("Location: friend_other.php");
    }
    else
    {
        echo mysqli_error($con);
    }
?>