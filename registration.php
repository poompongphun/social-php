<?php
    session_start();
    if(isset($_SESSION['user_id']))
    {
        header("Location: index.php");
        exit();
    }
    ob_start();
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
    <div class="container" id="login-form">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="registration.php">Registration</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin/admin_login.php">Admin</a>
            </li>
        </ul>
        <h1>Registration</h1>
        <form class="" name="registration" action="" method="post">
            <input type="text" name="user_name" placeholder="Username" required>
            <input type="email" name="user_email" placeholder="Email" required>
            <input type="password" name="user_password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required><br>
            <?php
                if(isset($_POST['user_name']))
                {
                    $user_name = $_POST['user_name'];
                    $user_email = $_POST['user_email'];
                    $user_password = $_POST['user_password'];
                    $confirm_password = $_POST['confirm_password'];
                    $user_joindate = date("d/m/Y H:i:s");

                    $check_user = "SELECT * FROM users WHERE user_name = '$user_name' OR user_email = '$user_email'";
                    $result_check = mysqli_query($con, $check_user);
                    $row_check = mysqli_num_rows($result_check);

                    echo "<div style='color:red;'>";
                    if($row_check >= 1)
                    {
                        echo "This username or email is used";
                    }
                    else if($user_password != $confirm_password)
                    {
                        echo "Password is not match";
                    }
                    else
                    {
                        $insert_user = "INSERT INTO users (user_name, user_email, user_password, user_profile, user_joindate, user_request)
                                        VALUE ('$user_name', '$user_email', '$user_password', 'profile.png', '$user_joindate', '0')";
                        $result_insert = mysqli_query($con, $insert_user);
                        if($result_insert)
                        {
                            ?>
                            <script>
                                alert("Success");
                            </script>
                            <?php
                        }
                        else
                        {
                            echo mysqli_error($con);
                        }
                    }
                    echo "</div>";

                }
            ?>
            <input type="submit" name="submit" value="Register">
        </form><br>
    </div>
</body>
</html>