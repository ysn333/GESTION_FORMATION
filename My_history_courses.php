

<?php

  include "db/dbconfig.php";
  session_start();

  if (!isset($_SESSION["email"])) {
    header("location: login.php");
  }

  $firstname = $_SESSION['firstname'];
  $lastname = $_SESSION['lastname'];
  $email =  $_SESSION['email'];
  $img = $_SESSION['img'];
  $id_apprenant = $_SESSION['id_apprenant'];



  

  ?>

<?php


    $stmt_resultat = $conn->prepare("SELECT formation.id_formation, formation.sujet,
        formation.categorie, formation.masse_horaire, formation.description,
        formation.image, session.id_session, session.date_debut, session.date_fin,
        inscription.resultat FROM inscription JOIN session ON
        inscription.id_session = session.id_session JOIN formation ON session.id_formation
        = formation.id_formation WHERE inscription.id_apprenant = :id_apprenant AND 
        (inscription.resultat = 'valid' OR inscription.resultat = 'invalid')");


    $stmt_resultat->bindParam(':id_apprenant', $id_apprenant);
    $stmt_resultat->execute();
    $enrollme = $stmt_resultat->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
  <title>My history courses.</title>
  
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <?php include 'includ/cdn_css.php' ?>

    <link rel ="icon"  href = "https://www.creativefabrica.com/wp-content/uploads/2020/11/02/Abstract-Logo-Design-Vector-Logo-Graphics-6436279-1-312x208.jpg"  type = "image/x-icon">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-edu-meeting.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">

</head>
<body>

   
<?php include 'includ/header.php' ?>

<!-- ***** Header Area Start ***** -->

<?php include 'includ/nav.php' ?>


<?php include 'includ/pop_up_profil.php' ?>


  <section class="our-courses" id="courses">
    
  <div class="container">
    
    <div class="row">
      <div class="col-lg-12">
        

      <?php if (count($enrollme) > 0): ?>
        <div class="section-heading">
          <h2>My history courses.                 
</h2>
        </div>
      </div>

      <?php foreach ($enrollme as $enrollment): ?>
        <div class="col-md-4">
          <div class="card mb-4 box-shadow" style="border: 1px solid #ccc; border-radius: 5px; box-shadow: 0 2px 2px rgba(0, 0, 0, 0.3); transition: all 0.3s ease;">
            <img class="card-img-top w-100 h-75" src="<?php echo $enrollment['image']; ?>" alt="<?php echo $formation['sujet']; ?>" style="height: 200px;">
            <div class="card-body">
              <a href="courses-details.php?id=<?php echo $enrollment['id_formation']; ?>">
                <h4 class="card-title"><?php echo $enrollment['sujet']; ?></h4>
                <p class="text-muted">Date debut : <?php echo $enrollment['date_debut']; ?> </p>
                <p class="text-muted">Date fin : <?php echo $enrollment['date_fin']; ?> </p> <br>
                <p class="card-text"><?php echo $enrollment['description']; ?></p>
                <div class="d-flex justify-content-between align-items-center">
                  <p class="text-muted"><?php echo $enrollment['categorie']; ?></p> <br>
                  <?php
                    if ($enrollment['resultat'] == 'valid') {
                        echo '<div class="alert alert-success" role="alert">';
                        echo '<p>Vous avez réussi cette session.</p>';
                        echo '</div>';
                      } else {
                        echo '<div class="alert alert-danger" role="alert">';
                        echo '<p>Vous avez échoué cette session.</p>';
                        echo '</div>';
                      }
                  ?>
                </div>
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
      <!-- Add your line of code here -->
  
    </div>
  </div>
</section>
<?php else: ?>
    <section class="our-courses" id="courses">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-heading">
          <h2>My history courses.</h2>
        </div>
      </div>
      <div class="col-lg-12">
 
     
       
      <div class="alert alert-warning" role="alert">
      You Don't have any history courses .    </div>  
    </div>
  </div>
</section>
  <?php endif; ?>
   <?php include 'includ\courses.php'; ?>


</body>
</html>