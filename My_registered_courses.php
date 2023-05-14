

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


  if (isset($_POST['unenroll'])) { 
      $id_session = $_POST['unenroll']; 
      $stmt = $conn->prepare("DELETE FROM inscription WHERE id_apprenant = :id_apprenant AND id_session = :id_session"); 
      $stmt->bindParam(':id_apprenant', $id_apprenant); 
      $stmt->bindParam(':id_session', $id_session); 
      $stmt->execute(); 
      $courses_canceled++; // increment the counter variable
      header("location: My_registered_courses.php"); 
  } 
  

  ?>

<?php

$current_date = date('Y-m-d');

if (isset($_GET['sujet'])) {

  $category = $conn->quote($_GET['category']);
  $sujet = $conn->quote($_GET['sujet']);

  $stmt = $conn->prepare("SELECT formation.id_formation, formation.sujet,
    formation.categorie, formation.masse_horaire, formation.description,
    formation.image, session.id_session, session.date_debut, session.date_fin,
    session.etat FROM inscription JOIN session ON inscription.id_session = session.id_session JOIN formation ON session.id_formation = formation.id_formation WHERE inscription.id_apprenant = :id_apprenant AND (inscription.resultat = 'null') AND session.date_debut > :current_date 
    AND session.etat NOT IN ('en cours', 'clôturée') AND formation.categorie = :category AND formation.sujet = :sujet ");

  $stmt->bindParam(':id_apprenant', $id_apprenant);

  $stmt->bindParam(':category', $category);
  $stmt->bindParam(':sujet', $sujet);

} else {

  $stmt = $conn->prepare("SELECT formation.id_formation, formation.sujet,
    formation.categorie, formation.masse_horaire, formation.description,
    formation.image, session.id_session, session.date_debut, session.date_fin,
    session.etat FROM inscription JOIN session ON inscription.id_session = session.id_session JOIN formation ON session.id_formation = formation.id_formation WHERE inscription.id_apprenant = :id_apprenant AND (inscription.resultat = 'null') AND session.date_debut > :current_date 
    AND session.etat NOT IN ('en cours', 'clôturée') ");

  $stmt->bindParam(':id_apprenant', $id_apprenant);
  $stmt->bindParam(':current_date', $current_date);

}

$stmt->execute();
$enrollments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
  <title>My registered courses.</title>
  
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



  <?php if (count($enrollments) > 0): ?>
    <section class="our-courses" id="courses">
  <div class="container">
    <div class="row">
    <div class="col-lg-12">
  <form method="GET" action="" class="search-form">
    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="subject">Subject</label>
        <input type="text" class="form-control" name="search" id="sujet" placeholder="Enter subject">
      </div>
      <div class="form-group col-md-4">
        <label for="category">Category</label>
        <input type="text" class="form-control" name="category" id="categorie" placeholder="Enter category">
      </div>
      <div class="form-group col-md-4">
        <label for="date-range">Date range</label>
        <div class="input-group">
          <input type="date" class="form-control" name="date_debut" id="start-date">
          <div class="input-group-prepend input-group-append">
            <span class="input-group-text">to</span>
          </div>
          <input type="date" class="form-control" name="date_fin" id="end-date">
        </div>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Search</button>
  </form>
</div>
<?php foreach ($enrollments as $enrollment): ?>
  <div class="col-md-4">
    <div class="card mb-4 box-shadow" style="border: 1px solid #ccc; border-radius: 5px; box-shadow: 0 2px 2px rgba(0, 0, 0, 0.3); transition: all 0.3s ease;">
      <?php if(isset($enrollment['etat']) && $enrollment['etat'] == 'Annulée'): ?>
        <div class="card-header bg-danger text-white">Annulée</div>
      <?php endif; ?>
      <img class="card-img-top w-100 h-75" src="<?php echo $enrollment['image']; ?>" alt="<?php echo $formation['sujet']; ?>" style="height: 200px;">
      <div class="card-body">
        <a href="courses-details.php?id=<?php echo $enrollment['id_formation']; ?>">
          <h4 class="card-title"><?php echo $enrollment['sujet']; ?></h4>
          <p class="text-muted">Date debut : <?php echo $enrollment['date_debut']; ?> </p>
          <p class="text-muted">Date fin : <?php echo $enrollment['date_fin']; ?> </p> <br>
          <p class="card-text"><?php echo $enrollment['description']; ?></p>
          <div class="d-flex justify-content-between align-items-center">
            <p class="text-muted"><?php echo $enrollment['categorie']; ?></p> <br>
            <?php if(isset($enrollment['etat']) && $enrollment['etat'] != 'Annulée'): ?>
              <form method="post">
                <button type="submit" name="unenroll" value="<?php echo $enrollment['id_session'] ?>" style="border: none; border-radius: 5px; background-color: #ff0000; color: #ffffff; font-size: 16px; padding: 0.5rem 1rem; transition: all 0.3s ease;">Unsubscribe</button>
              </form>
            <?php endif; ?>
          </div>
        </a>
      </div>
    </div>
  </div>
<?php endforeach; ?>
<div class="col-lg-12">
  <?php if ($search_string != '' || $category_string != '' || ($start_date != '' && $end_date != '')): ?>
    <div class="alert alert-info" role="alert">
      <?php if ($search_string != ''): ?>
        <p>Search: <?php echo $search_string; ?></p>
      <?php endif; ?>
      <?php if ($category_string != ''): ?>
        <p>Category: <?php echo $category_string; ?></p>
      <?php endif; ?>
      <?php if ($start_date != '' && $end_date != ''): ?>
        <p>Date range: <?php echo $start_date; ?> to <?php echo $end_date; ?></p>
      <?php endif; ?>
    </div>
  <?php endif; ?>
</div>
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
          <h2>My courses</h2>
        </div>
      </div>
      <div class="col-lg-12">
 
     
       
      <div class="alert alert-warning" role="alert">
        You are not registered in any course.
    </div>  
    </div>
  </div>
</section>


  <?php endif; ?>
 

   <?php include 'includ\courses.php'; ?>
   
<style>
    .search-form {
  margin: 20px 0;
  padding: 20px;
  background-color: #f1f1f1;
  border-radius: 5px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.form-row {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
}

.form-group {
  width: 30%;
}

.form-control {
  width: 100%;
  height: 40px;
  padding: 10px;
  font-size: 16px;
  border-radius: 5px;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

label {
  font-size: 16px;
  font-weight: bold;
  margin-bottom: 10px;
  display: block;
}

button[type="submit"] {
  background-color: #007bff;
  color: #fff;
  border: none;
  padding: 10px 20px;
  font-size: 16px;
  border-radius: 5px;
  cursor: pointer;
  transition: all 0.3s ease-in-out;
}

button[type="submit"]:hover {
  background-color: #0056b3;
}
</style>
</body>
</html>
