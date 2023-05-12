<?php

include "../db/dbconfig.php";

session_start();

if(isset($_POST['update'])){
    $id = $_SESSION["id_apprenant"];
    $directory = "../files/profiles/";
    $pic_name = basename($_FILES["primary"]["name"]);
    $path = $directory.$pic_name;
    move_uploaded_file($_FILES["primary"]["tmp_name"], $path);

    $sqlSat = $conn->prepare("UPDATE apprenant SET `img` = '$pic_name' WHERE id_apprenant  = '$id'");
    $sqlSat->execute();
    header('location:../index.php');

    exit();

}
?>
