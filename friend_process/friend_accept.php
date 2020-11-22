<?php
    include("../auth.php");
    require("../connect.php");
    $user_id = $_GET['id'];

    $friend_add = "UPDATE friends
                    SET friend_request ='1'
                    WHERE user_a = '$user_id' AND user_b = '$_SESSION[user_id]'";
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