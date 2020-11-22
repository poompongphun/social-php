<?php
    include("admin_auth.php");
    require("../connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    <script src="../CSS/bootstrap.min.js"></script>
    <script src="../CSS/jquery.min.js"></script>
    <script src="../CSS/popover.js"></script>

    <title>Admin</title>
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark fixed-top" style="margin-bottom:30px; background-color:#222222">
        <div class="container">
            <a class="navbar-brand" href="admin_home.php"style="font-size:35px;">Admin</a>
        </div>
        <ul class="navbar-nav" style="font-size:20px;">
            <li class="nav-item">
                <a class="nav-link" href="user_request.php">UserRequest</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">&nbsp;|&nbsp;</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="other_user_admin.php">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">&nbsp;|&nbsp;</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="setting.php">Setting</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">&nbsp;|&nbsp;</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../logout.php"><font color="#a52a2a">Logout</font></a>
            </li>
        </ul>
    </nav>
    <div class="container" style="margin-top: 80px; color: white;">

        <?php

        $show_post = "SELECT * FROM post
                        ORDER BY post_id DESC";
        $result_post = mysqli_query($con, $show_post);
        $row_post = mysqli_num_rows($result_post);
        if ($row_post >= 1) 
        {
            echo "Count Post : ".$row_post;
            while ($array_post = mysqli_fetch_array($result_post)) 
            {
                //Post
                $show_user = "SELECT * FROM users WHERE user_id = '$array_post[user_id]'";
                $result_user = mysqli_query($con, $show_user);
                $array_user = mysqli_fetch_array($result_user);
        ?>
                <div class="post">
                    <div class="post-show">
                        <div>
                            <img src=" <?php echo "../user_profile/" . $array_user['user_profile']; ?>" width="50" height="50" style="border-radius: 100px;">
                            <font size="4"><?php echo $array_user['user_name']; ?> |</font>
                            <font size="2"><?php echo $array_post['post_date']; ?></font>
                            <?php
                            echo '<a href="post_process/delete_post.php?id=' . $array_post['post_id'] . '" id="red-btn">Delete</a>';
                            ?><br>
                        </div>
                        <div style="margin-top: 15px; margin-bottom: 15px;">
                            <font size="3"><?php echo $array_post['post_txt']; ?></font>
                        </div>
                        <?php
                        if ($array_post['post_img'] != "") {
                        ?>
                            <img src=" <?php echo "../post_img/" . $array_post['post_img']; ?>" class="post-img">
                        <?php
                        }
                        ?>
                        <hr color="white">

                        <h5>Comment</h5>
                    </div>

                    <?php
                    //Comment
                    $show_comment = "SELECT * FROM comment WHERE post_id = '$array_post[post_id]'";
                    $result_comment = mysqli_query($con, $show_comment);
                    $row_comment = mysqli_num_rows($result_comment);
                    if($row_comment >= 1)
                    {
                        while ($array_comment = mysqli_fetch_array($result_comment)) 
                        {
                            $show_user = "SELECT * FROM users WHERE user_id = '$array_comment[user_id]'";
                            $result_user = mysqli_query($con, $show_user);
                            $array_user = mysqli_fetch_array($result_user);
                        ?>
                            <div class="comment-show"  style="margin-bottom: 20px; margin-top: -10px">
                                <img src=" <?php echo "../user_profile/" . $array_user['user_profile']; ?>" width="30" height="30" style="border-radius: 100px;">
                                <font size="3"><?php echo $array_user['user_name']; ?> : </font>
                                <font size="3"><?php echo $array_comment['comment_txt']; ?></font>
                                <a href="post_process/delete_comment.php?id=<?php echo $array_comment['comment_id']; ?>" id='red-btn' style='padding: 1px 6px 2px; font-size: 12px;;'>Delete</a>
                            </div>
                        <?php
                        }
                    }
                    else
                    {
                        echo "<div class='comment-show' style='margin-bottom: 20px; margin-top: -10px;'>No Comment.</div>";
                    }
                    ?>
                </div>
        <?php
            }
        } 

        else {
            echo "No Post.";
        }
        ?>
        </div>

</body>
</html>