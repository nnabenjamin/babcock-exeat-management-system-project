<?php
    // Connection string details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "gate_pass";
    //----------------------------

    $conn = mysqli_connect($servername, $username, $password, $db); // Connection variable

    // Check if connection is valid
    if (!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }
    //-----------------------------------
