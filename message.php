<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets\css\message.css">
  <title>message</title>
</head>
<body>
  
</body>
</html>

<?php

include "db/dbconfig.php";
session_start();

if (!isset($_SESSION["email"])) {
  header("location: login.php");
}


$jsonData = file_get_contents('contact.json');

//  JSON data into a PHP array
$data = json_decode($jsonData, true);

// Show the data in a table
echo '<table>';
echo '<tr><th>Name</th><th>Email</th><th>Message</th></tr>';
foreach ($data as $item) {
  echo '<tr>';
  echo '<td>' . $item['name'] . '</td>';
  echo '<td>' . $item['email'] . '</td>';
  echo '<td>' . $item['message'] . '</td>';
  echo '</tr>';
}
echo '</table>';
?>