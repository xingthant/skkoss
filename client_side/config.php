<?php 
    session_start(); // use for session
    ob_start(); // use for page navigation
    
    define('SITEURL','http://localhost/CLIENT_SIDE/');
    
    $server_name = "localhost";
    $username = "root";
    $password = "";
    $dbname = "online-shop";

    // Create connection in mysqli
    $conn = mysqli_connect($server_name,$username,$password,$dbname);

    if($conn){
        //echo "Connected";
    }else{
        die("Error on the Connection".mysqli_error());
    }

?>