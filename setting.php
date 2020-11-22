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
    ?>
    <div class="container" style="color: white; margin-top:80px;" align=center id="setting">
        <h1>Setting</h1><br>
        <img src=" <?php echo "user_profile/".$array_my['user_profile']; ?>" width="200" height="200" style="border-radius: 20px;">
        <form name="setting" action="" method="post" enctype="multipart/form-data"><br>
            <input type="file" accept=".png,.jpeg" name="user_profile">
            
            <table>
                <tr>
                    <td>Username : </td>
                    <td><input type="text" name="user_name" value="<?php echo $array_my['user_name'] ?>" required></td>
                </tr>
                <tr>
                    <td>Email : </td>
                    <td><input type="email" name="user_email" value="<?php echo $array_my['user_email'] ?>" required></td>
                </tr>
                <tr>
                    <td>Password : </td>
                    <td><input type="password" name="user_password" value="<?php echo $array_my['user_password'] ?>" required><br></td>
                </tr>
                <tr>
                    <td>Confirm : </td>
                    <td><input type="password" name="password_confirm" placeholder="Confirm Password" required></td>
                </tr>
            </table>
            <?php
                if(isset($_POST['user_name']))
                {
                    $user_name = $_POST['user_name'];
                    $user_email = $_POST['user_email'];
                    $user_password = $_POST['user_password'];
                    $password_confirm = $_POST['password_confirm'];
                    $user_profile = $_FILES['user_profile']['name'];
                    move_uploaded_file($_FILES['user_profile']['tmp_name'], "user_profile/".$user_profile); 

                    $check_email = "SELECT * FROM users WHERE user_email = '$user_email'";
                    $result_email = mysqli_query($con, $check_email);
                    $row_email = mysqli_num_rows($result_email);

                    $check_name = "SELECT * FROM users WHERE user_name = '$user_name'";
                    $result_name = mysqli_query($con, $check_name);
                    $row_name = mysqli_num_rows($result_name);
                    
                    if($row_email == 1 && $row_name == 1 && $user_email != $array_my['user_email'])
                    {
                        echo "This username or email this taken";
                    }

                    elseif($array_my['user_password'] != $password_confirm)
                    {
                        echo "Wrong Password";
                    }
                    else
                    {
                        if($user_profile == "")
                        {
                            $update_user = "UPDATE users
                                        SET user_name='$user_name', user_email='$user_email', user_password='$user_password'
                                        WHERE user_id='$array_my[user_id]'";
                            $update_result = mysqli_query($con, $update_user);
                        }
                        else
                        {
                            $update_user = "UPDATE users
                                        SET user_name='$user_name', user_email='$user_email', user_password='$user_password', user_profile='$user_profile'
                                        WHERE user_id='$array_my[user_id]'";
                            $update_result = mysqli_query($con, $update_user);
                        }
                        echo mysqli_error($con);
                        if($update_result)
                        {
                            ?>
                            <meta http-equiv="refresh" content="1">
                            <?php
                           
                        }
                        
                    }
                    
                }
            ?>
            <br><input type="submit" name="submit" value="Save">
        </form>
    </div>
</body>
</html>