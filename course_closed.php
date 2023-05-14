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

    if ($_SESSION['role'] == 'formateur') {
        $id_formateur =  $_SESSION['id_formateur'];
    }else {
        $id_apprenant = $_SESSION['id_apprenant'];

    }



  

  ?>

<?php
$desired_month = date('m');
$desired_year = date('Y');

$query = "SELECT
  f.id_formation,
  f.sujet,
  f.categorie,
  f.masse_horaire,
  f.description,
  f.image,
  MAX(s.date_debut) AS debut_session,
  MAX(s.date_fin) AS fin_session
FROM formation f
JOIN session s ON f.id_formation = s.id_formation
WHERE s.id_formateur = ?
  AND MONTH(s.date_debut) = ?
  AND YEAR(s.date_debut) = ?
  AND (CURDATE() BETWEEN s.date_debut AND s.date_fin)
  AND (s.etat = 'clôturée')
GROUP BY f.id_formation;";

$stmt = $conn->prepare($query);
$stmt->bindParam(1, $_SESSION['id_formateur']);
$stmt->bindParam(2, $desired_month, PDO::PARAM_INT);
$stmt->bindParam(3, $desired_year, PDO::PARAM_INT);
$stmt->execute();
$enrollme = $stmt->fetchAll(PDO::FETCH_ASSOC);

   // Get the current month and year

echo 'Vous êtes un formateur.'.''.$_SESSION['id_formateur'];

?>
<!DOCTYPE html>
<html>
<head>
  <title>continuous training.</title>
  
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
          <h2>continuous training.                 
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
                <p class="text-muted">Date debut : <?php echo $enrollment['debut_session']; ?> </p>
                <p class="text-muted">Date fin : <?php echo $enrollment['fin_session']; ?> </p>
                <p class="card-text"><?php echo $enrollment['description']; ?></p>
                <div class="d-flex justify-content-between align-items-center">
                  <p class="text-muted"><?php echo $enrollment['categorie']; ?></p> <br>
                
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
          <h2>current training.</h2>
        </div>
      </div>
      <div class="col-lg-12">
 
     
       
      <div class="alert alert-warning" role="alert">
      You do not have any ongoing training.
 
   </div>  
    </div>
  </div>
</section>
  <?php endif; ?>
   <?php include 'includ\courses.php'; ?>


</body>
</html>