<?php

    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "cms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $conn->set_charset("utf8");                                             //Türkçe karakter sorununu çözmek için

    // Check connection
    if (!$conn)
    {
        die("Connection failed: " . mysqli_connect_error());
    }
//    echo "Connected successfully";

?>