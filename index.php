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
        if(isset($_POST['post_txt']))
        {
            $post_txt = $_POST['post_txt'];
            $post_img = $_FILES['post_img']['name'];
            $post_date = date("d/m/Y H:i:s");
            move_uploaded_file($_FILES['post_img']['tmp_name'], "post_img/".$post_img);

            $upload_post = "INSERT INTO post (user_id, post_txt, post_img, post_date)
                            VALUE ('$me', '$post_txt', '$post_img', '$post_date')";
            $result_upload = mysqli_query($con, $upload_post);
            if($result_upload)
            {
                ?>
                <meta http-eqiv="refresh" content="1">
                <?php
            }
            else
            {
                echo mysqli_error($con);
            }
        }
        if(isset($_POST['comment_txt']))
        {
            $comment_txt = $_POST['comment_txt'];
            $post_id = $_POST['send_post_id'];

            $upload_comment = "INSERT INTO comment (post_id, user_id, comment_txt)
                            VALUE ('$post_id', '$me', '$comment_txt')";
            $result_upload = mysqli_query($con, $upload_comment);
            if($result_upload)
            {
                ?>
                <meta http-eqiv="refresh" content="1">
                <?php
            }
            else
            {
                echo mysqli_error($con);
            }
        }
    ?>
    <div class="container" style="margin-top:80px; color:white">

        <div class="post">
            <form name="user_post" action="" method="post"enctype="multipart/form-data" id="form-post">
            <br><h4>Create Post :</h4>
            <textarea class="form-control" name="post_txt" rows="5"placeholder="Write Something to post..."require></textarea><br>
            <input type="file"name="post_img"accept=".png,.jpeg,.gif"><br>
            <input type="submit" name="submit" value="Post"><br><br>
            </form>
        </div>

        <?php
            $show_post = "SELECT * FROM post WHERE user_id = '$me' 
                        OR user_id IN (SELECT user_a FROM friends WHERE user_b = '$me' AND friend_request = '1')
                        OR user_id IN (SELECT user_b FROM friends WHERE user_a = '$me' AND friend_request = '1')
                        ORDER BY post_id DESC";
            $result_post = mysqli_query($con, $show_post);
            $row_post = mysqli_num_rows($result_post);
            if($row_post >= 1)
            {
                while($array_post = mysqli_fetch_array($result_post))
                {
                    $show_user = "SELECT * FROM users WHERE user_id = '$array_post[user_id]'";
                    $result_user = mysqli_query($con, $show_user);
                    $array_user = mysqli_fetch_array($result_user);
                ?>

                <div class="post">
                    <div class="post-show">
                        <img src="user_profile/<?php echo $array_user['user_profile']; ?>" width="50" height="50" style="border-radius:100px" >
                        <font style="font-size: 18px"><?php echo $array_user['user_name']; ?> | </font>
                        <font style="font-size: 12px"><?php echo $array_post['post_date']; ?></font>

                        <?php
                        if($array_post['user_id'] == $me)
                        {
                            echo "<a href='edit_post.php?id=".$array_post['post_id']."' id='orange-btn'>Edit</a>";
                            echo '<a href="post_process/delete_post.php?id='.$array_post['post_id'].'" id="red-btn">Delete</a>';
                        }
                        ?>
                        <br>
                        <div style="font-size: 16px; margin-top: 10px;">
                            <font><?php echo $array_post['post_txt']; ?></font>
                            <?php
                            if($array_post['post_img'] != "")
                            {
                                ?><img src="post_img/<?php echo $array_post['post_img']; ?>" class="post-img"><?php
                            }
                            ?>
                        </div>
                    </div>
                    
                    <div class="comment">
                    <hr color=white>
                    <h5>Comment</h5>

                    <?php
                        $show_comment = "SELECT * FROM comment WHERE post_id = '$array_post[post_id]'";
                        $result_comment = mysqli_query($con, $show_comment);
                        $row_comment = mysqli_num_rows($result_comment);
                        if($row_comment >= 1)
                        {
                            while($array_comment = mysqli_fetch_array($result_comment))
                            {
                                $show_user = "SELECT * FROM users WHERE user_id = '$array_comment[user_id]'";
                                $result_user = mysqli_query($con, $show_user);
                                $array_user = mysqli_fetch_array($result_user);
                                ?>
                                <div class="comment-show">
                                    <img src="user_profile/<?php echo $array_user['user_profile']; ?>" width="30" height="30" style="border-radius:100px" >
                                    <font style="font-size: 15px"><?php echo $array_user['user_name']; ?> : </font>
                                    <font><?php echo $array_comment['comment_txt']; ?></font>
                                    <?php
                                    if($array_post['user_id'] == $me)
                                    {
                                        echo "<a href='edit_comment.php?id=".$array_post['post_id']."' id='orange-btn' style='padding: 3px 10px 3px'>Edit</a>";
                                        echo "<a href='post_process/delete_comment.php?id=".$array_post['post_id']."' id='red-btn' style='padding: 3px 10px 3px'>Delete</a>";
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                        }
                        else
                        {
                            echo "<div class='comment-show'>No Comment.</div>";
                        }
                    ?> 

                        <form class="post_comment" action="" method="post">
                            <input type="text" name="comment_txt"placeholder="Comment..."style="width:91%;">
                            <input type="hidden" name="send_post_id" value="<?php echo $array_post['post_id']; ?>">
                            <input type="submit" name="submit"value="Send">
                        </form>
                    </div>
                </div>

                <?php
                }
            }
            else
            {
                echo "No Post.";
            }
        ?>

    </div>
    
</body>
</html>