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

    $user_friend = "SELECT * FROM friends WHERE user_b = '$me' AND friend_request = '0'";
    $result_friend = mysqli_query($con, $user_friend);
    $row_friend = mysqli_num_rows($result_friend);
    ?>
    <div class="container" id="friends">
    <h2>Friends Request</h2>
    <?php
    if($row_friend >= 1)
    {
        echo "<div class='row'>";
        while($array_friend = mysqli_fetch_array($result_friend))
        {   
            if($array_friend['user_a'] == $me)
            {
                $show_user = "SELECT * FROM users WHERE user_id = '$array_friend[user_b]'";
            }
            elseif($array_friend['user_b'] == $me)
            {
                $show_user = "SELECT * FROM users WHERE user_id = '$array_friend[user_a]'";
            }
            $result_user = mysqli_query($con, $show_user);
            $array_user = mysqli_fetch_array($result_user);

            ?>
            <div class="user_profile">
                <img src="user_profile/<?php echo $array_user['user_profile']; ?>" width="125" height="125" style="border-radius:10px; margin-top:10px;"><br>
                <font style="font-size: 25px;"><?php echo $array_user['user_name']; ?></font><br>
            
            <?php
            
                echo "<a href='friend_process/friend_accept.php?id=".$array_user['user_id']."' id='green-btn'>Accept</a>";
                echo "<a href='friend_process/friend_remove.php?id=".$array_user['user_id']."' id='red-btn'>Ignore</a>";
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