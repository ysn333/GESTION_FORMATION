<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_formation";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check for sessions that need to be canceled
    

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
