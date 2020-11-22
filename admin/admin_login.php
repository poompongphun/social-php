<?php
    session_start();
    if(isset($_SESSION['admin_id']))
    {
        header("Location: admin_home.php");
        exit();
    }
    ob_start();
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

    <title>Social</title>
</head>
<body>
    <div class="container" align="center" id="login-form">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="../login.php">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../registration.php">Registration</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="admin_login.php">Admin</a>
            </li>
        </ul>
        <h1>Admin Login</h1>
        <form class="" name="login" action="" method="post">
            <input type="text" name="admin_name" placeholder="Adminname">
            <input type="password" name="admin_password" placeholder="Password">
            <?php
                if(isset($_POST['admin_name']))
                {
                    $admin_name = $_POST['admin_name'];
                    $admin_password = $_POST['admin_password'];

                    $check_user = "SELECT * FROM admin WHERE admin_name = '$admin_name' AND admin_password = '$admin_password'";
                    $result_check = mysqli_query($con, $check_user);
                    $row_check = mysqli_num_rows($result_check);
                    $array_user = mysqli_fetch_array($result_check);

                    echo "<div style='color:red;'>";
                    if($row_check != 1)
                    {
                        echo "Wrong adminname or password";
                    }
                    else if($row_check == 1)
                    {
                        $_SESSION['admin_id'] = $array_user['admin_id'];
                        header("Location: admin_home.php");
                    }
                    echo "</div>";

                }
            ?>
            <input type="submit" name="submit" value="login"><br><br>
        </form>
    </div>
</body>
</html>