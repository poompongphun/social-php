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

    $all_user = "SELECT * FROM users";
    $result_user = mysqli_query($con, $all_user);
    $row_user = mysqli_num_rows($result_user);
    ?>
    <div class="container" id="friends">
    <h2>Other User</h2>
    <?php
    if($row_user >= 1)
    {
        echo "<div class='row'>";
        while($array_user= mysqli_fetch_array($result_user))
        {   
            $check_friend = "SELECT * FROM friends WHERE user_a = '$array_user[user_id]' AND user_b = '$me' 
                            OR user_a = '$me' AND user_b = '$array_user[user_id]'";
            $result_friend = mysqli_query($con, $check_friend);
            $row_friend = mysqli_num_rows($result_friend);

            if($row_friend == 0 && $array_user['user_id'] != $me)
            {
                ?>
                <div class="user_profile">
                    <img src="user_profile/<?php echo $array_user['user_profile']; ?>" width="125" height="125" style="border-radius:10px; margin-top:10px;"><br>
                    <font style="font-size: 25px;"><?php echo $array_user['user_name']; ?></font><br>
                
                <?php
                
                    echo "<a href='friend_process/friend_add.php?id=".$array_user['user_id']."' id='green-btn'>Add</a>";
                ?>
                </div>
                <?php
            }
            
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