<?php

include "../db/dbconfig.php";

session_start();

$id_apprenant = $_POST['id_apprenant'];
$id_session = $_POST['id_session'];

echo $id_apprenant . " " . $id_session ;

// Update the validation of the enrollment
$stmt = $conn->prepare("UPDATE inscription SET resultat = 'invalid' WHERE id_apprenant = :id_apprenant AND id_session = :id_session");
$stmt->bindParam(':id_apprenant', $id_apprenant);
$stmt->bindParam(':id_session', $id_session);
$stmt->execute();

// Redirect back to the page where the form was submitted
header("Location: ".$_SERVER['HTTP_REFERER']);
exit();
?>