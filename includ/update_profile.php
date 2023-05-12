<?php
// start the session and include your database connection file
session_start();
include '../db/dbconfig.php';

// get the user ID from the session
$user_id = $_SESSION['id_apprenant'];

// get the updated profile information from the form
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];

// validate the input
if (empty($firstname) || empty($lastname) || empty($email)) {
    // if any of the fields are empty, redirect back to the profile page with an error message
    $_SESSION['error'] = 'All fields are required.';
    header('Location: index.php');
    exit();
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // if the email is not valid, redirect back to the profile page with an error message
    $_SESSION['error'] = 'Invalid email address.';
    header('Location: ../index.php');
    exit();
}

// update the user's profile information in the database
$stmt = $conn->prepare("UPDATE apprenant SET firstname = :firstname, lastname = :lastname, email = :email WHERE id_apprenant = :user_id");
$stmt->bindParam(':firstname', $firstname);
$stmt->bindParam(':lastname', $lastname);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();

// update the session variables with the new profile information
$_SESSION['firstname'] = $firstname;
$_SESSION['lastname'] = $lastname;
$_SESSION['email'] = $email;

// redirect back to the profile page with a success message
$_SESSION['success'] = 'Profile updated successfully.';
header('Location: ../index.php');
exit();
?>