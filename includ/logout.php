<?php
  include "../db/dbconfig.php";

  session_start();
  session_unset();
  session_destroy();
  header("Location: ../index.php");
  exit;

?>
