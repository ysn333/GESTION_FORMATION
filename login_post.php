<?php
session_start();
include "db/dbconfig.php";


if (isset($_POST["email"]) && isset($_POST["password"])) {

    $email = stripslashes(strtolower($_POST["email"])) ;
    $password = md5($_POST["password"]);

    // Check if email exists
    $stmt = $conn->prepare("SELECT * FROM apprenant WHERE email=:email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) { 
        if ($result['password'] == $password) {

            $_SESSION['id_apprenant'] = $result['id_apprenant'];
            $_SESSION['firstname'] = $result['firstname'];
            $_SESSION['lastname'] = $result['lastname'];
            $_SESSION['email'] = $result['email'];
            $_SESSION['img'] = $result['img'];
            $_SESSION['role'] = $result['role'];


            
            header('location: index.php'); 
            exit();
        } else { 
            $password_errer = 'Incorrect password!';
            include 'login.php';
        }
    } else { 
        $email_errer = 'Email not found!';
        include 'login.php';
    }
}

// Check if user is formateur
$stmt = $conn->prepare("SELECT * FROM formateur WHERE email=:email");
$stmt->bindParam(':email', $email);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) { 
    if ($result['password'] == $password) {

        $_SESSION['id_formateur'] = $result['id_formateur'];
        $_SESSION['firstname'] = $result['firstname'];
        $_SESSION['lastname'] = $result['lastname'];
        $_SESSION['email'] = $result['email'];
        $_SESSION['img'] = $result['img'];
        $_SESSION['role'] = $result['role'];


        
        header('location: index.php'); 
        exit();
    } else { 
        $password_errer = 'Incorrect password!';
        include 'login.php';
    }
}

?>
