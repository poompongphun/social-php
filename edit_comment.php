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
<body style="background-color:#313131;">
    <?php
        include("nav_tab.php");
        $comment_id = $_GET['id'];
        $show_comment = "SELECT * FROM comment WHERE comment_id = '$comment_id'";
        $result_comment = mysqli_query($con, $show_comment);
        $array_comment = mysqli_fetch_array($result_comment);

        if(isset($_POST['comment_txt']))
        {
            $comment_txt = $_POST['comment_txt'];

            $upload_post = "UPDATE comment
                            SET comment_txt = '$comment_txt'
                            WHERE comment_id = '$comment_id'";
            $result_upload = mysqli_query($con, $upload_post);
            if($result_upload)
            {
                ?>
                <meta http-equiv="refresh" content="1">
                <?php
            }
            else
            {
                echo mysqli_error($con);
            }
        }
    ?>
    <div class="container" style="margin-top:80px; color:white;">
        <div class="post">
            <div>
                <form name="user_comment" action="" method="post" id="form-post">
                    <br>
                    <h4>Edit Comment :</h4>
                    <textarea class="form-control" name="comment_txt" require><?php echo $array_comment['comment_txt']; ?></textarea><br>
                    <input type="submit" name="submit"value="Save">
                </form><br>
            </div>
        </div>
    </div>
</body>
</html>