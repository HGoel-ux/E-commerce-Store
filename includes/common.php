<?php
    $conn = mysqli_connect("localhost", "root", "","store","3308") or die(mysqli_error($conn));
    
    if(!$conn){
        die("connection to the database failed due to ".mysqli_connect_error());
    }
    else{
        mysqli_select_db($conn, "store");
    }

    if(!isset($_SESSION)){
        session_start();
    }
?>