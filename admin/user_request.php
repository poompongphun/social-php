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

    <title>Admin UserRequest</title>
</head>
<body style="color:white;">
<nav class="navbar navbar-expand-sm navbar-dark fixed-top" style="margin-bottom:30px; background-color:#222222">
        <div class="container">
            <a class="navbar-brand" href="admin_home.php"style="font-size:35px;">Admin : <font color="#7fffd4">User Request</font></a>
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
    </nav><br><br><br><br><br><br>
    <div class="container" align="center" id="friends">
    <?php
        $user_request = "SELECT * FROM users WHERE user_request = '0'";
        $result_request = mysqli_query($con, $user_request);
        $row_request = mysqli_num_rows($result_request);
        
        if($row_request >= 1)
        {
            echo "<table class='show-table' border='2' border-color='white' style='width:100%; color:white; text-align:center'>";
            echo "<tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Joindate</th>
                    <th>Accept | Eject</th>
                </tr>";

            while($array_request = mysqli_fetch_array($result_request))
            {
                echo "<tr>
                        <td>".$array_request['user_id']."</td>
                        <td>".$array_request['user_name']."</td>
                        <td>".$array_request['user_email']."</td>
                        <td>".$array_request['user_password']."</td>
                        <td>".$array_request['user_joindate']."</td>
                        <td>
                            <a href='process/accept.php?id=".$array_request['user_id']."'style='color: rgb(30,255,0);'>Accept </a>
                            |
                            <a href='process/eject.php?id=".$array_request['user_id']."'style='color: red;'> Eject</a>
                        </td>
                    </tr>";
            }
            echo "</table>";
        }
        else
        {
            echo "No Request";
        }
    ?>
    </div>
</body>
</html>