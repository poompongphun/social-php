<?php
    session_start();
    if(!isset($_SESSION['admin_id']))
    {
        header("Location:admin_home.php");
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
    <script src="../CSS/jquery.min.js"></script>
    <script src="../CSS/popover.js"></script>
    <script src="../CSS/bootstrap.min.js"></script>
    <title>Social</title>
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
    </nav><br>
    
    <?php    
            $admin_name = "SELECT * FROM admin WHERE admin_id = '$_SESSION[admin_id]'";
            $result_name = mysqli_query($con, $admin_name);
            $array_my = mysqli_fetch_array($result_name);
            if (isset($_POST['admin_name'])) {
                $admin_name = $_POST['admin_name'];
                $admin_password = $_POST['admin_password'];
            
                $update_admin = "UPDATE admin
                                SET admin_name = '$admin_name', admin_password = '$admin_password'
                                WHERE admin_id = '$array_my[admin_id]'";
                $update_admin = mysqli_query($con, $update_admin);
            
                if ($update_admin) {
                ?>
                <meta http-equiv="refresh" content="1">
                <?php
                }
            } 
            ?>

    <div class="container" style="color: white; margin-top:80px;" align=center id="setting">
        <h1>Admin Setting</h1><br>
        <form name="setting" action="" method="post" enctype="multipart/form-data"><br>
            
            <table>
                <tr>
                    <td>Username : </td>
                    <td><input type="text" name="admin_name" value="<?php echo $array_my['admin_name'] ?>" required></td>
                </tr>
                
                <tr>
                    <td>Password : </td>
                    <td><input type="password" name="admin_password" value="<?php echo $array_my['admin_password'] ?>" required><br></td>
                </tr>
               
            </table>
            
            <br><input type="submit" name="submit" value="Save">

        </form>
    </div>
</body>
</html>