<?php
    $con = mysqli_connect("localhost", "root", "1234567890", "socialtime");
    if(mysqli_connect_error())
    {
        echo mysqli_connect_error();
    }
?>