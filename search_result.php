<?php
    include("auth.php");
    require("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <script src="CSS/jquery.min.js"></script>
    <script src="CSS/popover.js"></script>
    <script src="CSS/bootstrap.min.js"></script>
    <title>Social</title>
</head>
<body>
    <?php
    include("nav_tab.php");
    $user_name = $_POST['search'];
    $search_name = "SELECT * FROM users WHERE user_name LIKE '%$user_name%'";
    $result_search = mysqli_query($con, $search_name);
    $row_search = mysqli_num_rows($result_search);
    ?>
    <div class="container" id="friends">
    <h2>Search Result</h2>
    <?php
    if($row_search >= 1)
    {
        echo "<div class='row'>";
        while($array_user = mysqli_fetch_array($result_search))
        {
            ?>
            <div class="user_profile">
                <img src="user_profile/<?php echo $array_user['user_profile']; ?>" width="125" height="125" style="border-radius:10px; margin-top:10px;"><br>
                <font style="font-size: 25px;"><?php echo $array_user['user_name']; ?></font><br>
            
            <?php

            $check_request = "SELECT * FROM friends WHERE user_a = '$array_user[user_id]' AND user_b = '$me' AND friend_request = '0'";
            $result_request = mysqli_query($con, $check_request);
            $row_request = mysqli_num_rows($result_request);
            
            $check_pending = "SELECT * FROM friends WHERE user_a = '$me' AND user_b = '$array_user[user_id]' AND friend_request = '0'";
            $result_pending = mysqli_query($con, $check_pending);
            $row_pending = mysqli_num_rows($result_pending);

            $check_friend = "SELECT * FROM friends WHERE user_a = '$array_user[user_id]' AND user_b = '$me' AND friend_request = '1' 
                            OR user_a = '$me' AND user_b = '$array_user[user_id]' AND friend_request = '1'";
            $result_friend = mysqli_query($con, $check_friend);
            $row_frined = mysqli_num_rows($result_friend);

            if($array_user['user_id'] == $me)
            {
                echo "<font id='green-btn'>YOU</font>";
            }
            else if($row_pending >= 1)
            {
                echo "<font id='green-btn'>Pending</font>";
            }
            else if($row_request >= 1)
            {
                echo "<a href='friend_process/friend_accept.php?id=".$array_user['user_id']."' id='green-btn'>Accept</a>";
                echo "<a href='friend_process/friend_remove.php?id=".$array_user['user_id']."' id='red-btn'>Ignore</a>";
            }
            else if($row_frined >= 1)
            {
                echo "<a href='friend_process/friend_remove.php?id=".$array_user['user_id']."' id='red-btn'>Unfriend</a>";
            }
            else
            {
                echo "<a href='friend_process/friend_add.php?id=".$array_user['user_id']."' id='green-btn'>Add</a>";
            }
            ?>
            </div>
            <?php
        }
        echo "</div>";
    }
    else
    {
        echo "Not Found";
    }
    ?>

    </div>
</body>
</html>