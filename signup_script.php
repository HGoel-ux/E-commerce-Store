<?php
    require "./includes/common.php";
    // get details
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $contact = mysqli_real_escape_string($conn, $_POST["contact"]);
    $city = mysqli_real_escape_string($conn, $_POST["city"]);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);
    // hash password
    $hashed_password = md5($password);
    $query1 = "SELECT id FROM users WHERE email = '$email' AND password = '$hashed_password'";
    $query2 = "INSERT INTO users (name, email, password, contact, city, address) VALUES ('$name', '$email', '$hashed_password', '$contact', '$city', '$address')";

    // check if already registered user
    $query_result = mysqli_query($conn, $query1);
    
    // if(mysqli_num_rows($result) > 0){
    //     // email already exists
    //     echo "Email id already exists. Try another";
    // }else{
    //     // perform query operation
    //     $result = mysqli_query($conn, $query2);
    //     $_SESSION["email_id"] = $email;
    //     $_SESSION["id"] = mysqli_insert_id($conn);

    //     // redirect to products page
    //     header("location: products.php");
    // }

    if (!$query_result || mysqli_num_rows($query_result) == 0){
        // perform query operation
        $result = mysqli_query($conn, $query2)or die("Error : ".mysqli_error($conn));
        $_SESSION["email_id"] = $email;
        $_SESSION["id"] = mysqli_insert_id($conn);
        if($result)
        {
        $sms_msg = "Thank You for registering with us.<br>Regards,<br>";
        echo "<script>alert('Congratulations!! Registration has been done successfully.')</script>";
        }
        // redirect to products page
        header("location: products.php");

    }else{
        // email already exists
        echo "Email id already exists. Try another";
    }
?>