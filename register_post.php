<?php
include "db/dbconfig.php";

if (isset($_POST["submit"])) {
    $first_name = stripslashes(strtolower($_POST["firstname"])) ;
    $last_name = stripslashes(strtolower($_POST["lastname"])) ;
    $email = stripslashes(strtolower($_POST["email"])) ;
    $password = $_POST["password"] ;
    $confirm_password = $_POST["confirm_password"] ;
    $err_s = 0 ;
    $md5_pass = md5($password);

    // Validate first_name
    if (empty($first_name)) {
        $first_name_errer = 'First_name field is valid!';
        $err_s = 1 ;
    } elseif (strlen($first_name) < 5) {
        $first_name_errer = 'Your first name needs to have a minimum of 6 letters!';
        $err_s = 1 ;
    } elseif (filter_var($first_name,FILTER_VALIDATE_INT)) {
        $first_name_errer = 'PLEASE ENTER A VALID first name NOT A NUMBER !';
        $err_s = 1 ;
    }

    // Validate last_name
    if (empty($last_name)) {
        $last_name_errer = 'last name field is valid!';
        $err_s = 1 ;
    } elseif (strlen($last_name) < 5) {
        $last_name_errer = 'Your last name needs to have a minimum of 6 letters!';
        $err_s = 1 ;
    } elseif (filter_var($last_name,FILTER_VALIDATE_INT)) {
        $last_name_errer = 'PLEASE ENTER A VALID  last name NOT A NUMBER !';
        $err_s = 1 ;
    }

   // Validate email
    if (empty($email)) {
        $email_errer = 'Email not valid!';
        $err_s = 1;
    } elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $email_errer = 'Email not valid!';
        $err_s = 1;
    } else {
        // Check if email already exists in database
        $stmt = $conn->prepare("SELECT * FROM apprenant WHERE email=:email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $email_errer = 'Email already exists!';
            $err_s = 1;
        }
    }

    // Validate password
    if (empty($password)) {
        $password_errer = 'Your password is not valid minimum of 5 letters!';
        $err_s = 1 ;
    } elseif (strlen($password) < 5) {
        $password_errer = 'Your password is not valid minimum of 5 letters!';
        $err_s = 1 ;
    } elseif ($password !== $confirm_password) {
        $confirm_password_errer = 'Passwords do not match!';
        $err_s = 1 ;
    }

    if ($err_s == 0 ) {
        // Prepare statement
        $stmt = $conn->prepare("INSERT INTO apprenant (firstname, lastname, email, password) 
        VALUES (:firstname, :lastname, :email, :password)");
        $stmt->bindParam(':firstname', $first_name);
        $stmt->bindParam(':lastname', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $md5_pass);

        // Execute the statement
        $stmt->execute();

        echo "New record created successfully";

        header('location:login.php');
    } else {
        include 'register.php';
    }
}
?>