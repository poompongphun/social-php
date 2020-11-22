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
        $post_id = $_GET['id'];
        $show_post = "SELECT * FROM post WHERE post_id = '$post_id'";
        $result_post = mysqli_query($con, $show_post);
        $array_post = mysqli_fetch_array($result_post);

        if(isset($_POST['post_txt']))
        {
            $post_txt = $_POST['post_txt'];
            $post_img = $_FILES['post_img']['name'];
            move_uploaded_file($_FILES['post_img']['tmp_name'], "post_img/".$post_img);

            $upload_post = "UPDATE post
                            SET post_txt = '$post_txt', post_img = '$post_img'
                            WHERE post_id = '$post_id'";
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
                <form name="user_post" action="" method="post" enctype="multipart/form-data" id="form-post">
                    <br>
                    <h4>Edit Post :</h4>
                    <textarea class="form-control" name="post_txt" require><?php echo $array_post['post_txt']; ?></textarea><br>
                    <input type="file" name="post_img" accept=".png,.jpeg,.gif"><br>
                    <input type="submit" name="submit"value="Save">
                    
                </form><br>
                <?php
                    if($array_post['post_img'] != "")
                    {
                        ?><img src="post_img/<?php echo $array_post['post_img']; ?>" class="post-img"><?php
                    }
                ?>
            </div><br>
            
        </div>
    </div>
</body>
</html>