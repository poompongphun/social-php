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

    <title>Admin All Users</title>
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark fixed-top" style="margin-bottom:30px; background-color:#222222">
        <div class="container">
            <a class="navbar-brand" href="admin_home.php"style="font-size:35px;">Admin : <font color="#adff2f">All Users</font></a>
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
        <div class="container" style="color:white; margin-top:80px;"id="friends">
            <?php 
                $all_user = "SELECT * FROM users WHERE user_id";
                $result_user = mysqli_query($con,$all_user);
                $row_user = mysqli_num_rows($result_user);

                if ($row_user >= 1) {
                    echo "<font color ='white'>";
                    echo "<table border=1 bordercolor='white'; style='width: 100%; text-align: center;'>";
                    echo "<tr>
                            <th> User ID</th>
                            <th>User Name</th>
                            <th>User Email</th>
                            <th>User Password</th>
                            <th>User Join Date</th>
                            <th>Delete</th>
                        </tr>";
                        while ($array_user = mysqli_fetch_array($result_user)) {
                          echo "<tr>";
          
                      $link=$array_user['user_id'];?>
                      <td><a href="go_user.php?user=<?php echo $link; ?>"><?php echo $link; ?></a></td>
                        <?php
                        echo "<td>".$array_user['user_name']."</td>";
                        echo "<td>".$array_user['user_email']."</td>";
                        echo "<td>".$array_user['user_password']."</td>";
                        echo "<td>".$array_user['user_joindate']."</td>";
                        echo '<td>
                                <a href="delete_user.php?id='.$array_user['user_id'].'"><font color="red">Delete</font></a>
                              </td>';
                        echo "</tr>";
                        }
                        echo "</table>";
                        echo "</font>";
                  }
                 ?>
        </div>
</body>
</html>