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
                <a class="nav-link disabled" href="login.php">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="registration.php">Registration</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin/admin_login.php">Admin</a>
            </li>
        </ul>
        <h1>Login</h1>
        <form name="login" action="" method="post">
            <input type="text" name="user_name" placeholder="Username">
            <input type="password" name="user_password" placeholder="Password">
            <?php
                if(isset($_POST['user_name']))
                {
                    $user_name = $_POST['user_name'];
                    $user_password = $_POST['user_password'];

                    $check_user = "SELECT * FROM users WHERE user_name = '$user_name' AND user_password = '$user_password'";
                    $result_check = mysqli_query($con, $check_user);
                    $row_check = mysqli_num_rows($result_check);
                    $array_user = mysqli_fetch_array($result_check);

                    echo "<div style='color:red;'>";
                    if($row_check != 1)
                    {
                        echo "Wrong username or password";
                    }
                    else if($row_check == 1 && $array_user['user_request'] == '0')
                    {
                        echo "Wait admin to accept your request";
                    }
                    else if($row_check == 1 && $array_user['user_request'] == '1')
                    {
                        $_SESSION['user_id'] = $array_user['user_id'];
                        header("Location: index.php");
                    }
                    echo "</div>";

                }
            ?>
            <input type="submit" name="submit" value="login">
        </form><br>
    </div>
</body>
</html>