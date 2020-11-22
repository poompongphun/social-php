<?php 
        $me = $_SESSION['user_id'];
        $data_my = "SELECT * FROM users WHERE user_id = '$me'";
        $result_my = mysqli_query($con, $data_my);
        $array_my = mysqli_fetch_array($result_my);
?>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top" style="margin-bottom: 30px; background-color:#222222">
        <div class="container">
            <a href="index.php" class="navbar-brand">Social</a>

            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">

                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">

                        <form class="form-inline" action="search_result.php" method="post">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search" id="search" size="70" require>
                                <div class="input-group-append">
                                    <input type="submit"name="submit"value="Search" id="search-btn">
                                </div>
                            </div>
                        </form>
                        
                    </li>
                </ul>
            

                <div class="navbar-nav">
                    <div class="input-group">

                        <li class="nav-item">
                            <a class="nav-link">
                                <img src="<?php echo "user_profile/".$array_my['user_profile'];?>"width="25" hieght="25" style="border-radius:20px;">
                                <?php 
                                   echo $array_my['user_name'] ;
                                ?>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link disabled" href="#">&nbsp;|&nbsp;</a>
                        </li>
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" id="navbardrop" data-toggle="dropdown">Friends</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="friends_all.php">My Friends</a>
                                <a class="dropdown-item" href="friends_request.php">Friends Request</a>
                                <a class="dropdown-item" href="friends_other.php">Other User</a>
                            </div>
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
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>

                    </div>
                </div>
            </div>
        </div>
    </nav>