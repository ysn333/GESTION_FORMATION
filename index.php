<?php
  include "db/dbconfig.php";
  session_start();

  if (!isset($_SESSION["email"])) {
    header("location: login.php");
  }

  $stmt = $conn->prepare("SELECT * FROM apprenant WHERE email=:email");
  $stmt->bindParam(':email', $email);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  

  if ($result) { 
      if ($result['password'] == $password) {
          $_SESSION['id_formateur'] = $result['id_formateur'];
          $_SESSION['id_apprenant'] = $result['id_apprenant'];
          $_SESSION['firstname'] = $result['firstname'];
          $_SESSION['lastname'] = $result['lastname'];
          $_SESSION['email'] = $result['email'];
          $_SESSION['img'] = $result['img'];
          $_SESSION['role'] = $result['role'];


      }
    }

    if (isset($_SESSION['role']) && $_SESSION['role'] == 'user') {
      // User is an apprenant
      echo '';
    } else if (isset($_SESSION['role']) && $_SESSION['role'] == 'formateur') {
      // User is a formateur
      echo '';
    } else if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
      // User is a admin
      echo 'Vous êtes un admin.';
    } else {
      // User is not logged in
      echo 'Vous n\'êtes pas connecté.';
    }
  $firstname = $_SESSION['firstname'];
  $lastname = $_SESSION['lastname'];
  $email =  $_SESSION['email'];
  $img = $_SESSION['img'];
  $role = $_SESSION['role'];






  

?>



<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    
    
    <?php include 'includ/cdn_css.php' ?>

    <title>home</title>
    <link rel ="icon"  href = "https://www.creativefabrica.com/wp-content/uploads/2020/11/02/Abstract-Logo-Design-Vector-Logo-Graphics-6436279-1-312x208.jpg"  type = "image/x-icon">
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-edu-meeting.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel ="icon"  href = "https://www.creativefabrica.com/wp-content/uploads/2020/11/02/Abstract-Logo-Design-Vector-Logo-Graphics-6436279-1-312x208.jpg"  type = "image/x-icon">

  </head>

<body>



  
<?php include 'includ/header.php' ?>

  <!-- ***** Header Area Start ***** -->

<?php include 'includ/nav.php' ?>


<?php include 'includ/section.php' ?>


<?php include 'includ/pop_up_profil.php' ?>



  <!-- ***** Main Banner Area Start ***** -->
  

  <section class="our-courses " id="courses">
    <div class="container mt-5">

      <div class="row mt-5">
        <div class="col-lg-12 mt-5">

          <div class="section-heading mt-5">
            <br><br><br>
            <h2>Our Popular Courses</h2>
          </div>
        </div>

<?php

$sujet = $_GET['sujet'] ?? '';
$categorie = $_GET['categorie'] ?? '';
$masse_horaire = $_GET['masse_horaire'] ?? '';

// Set up pagination variables
$results_per_page = 6;
$current_page = $_GET['page'] ?? 1;
$offset = ($current_page - 1) * $results_per_page;

// Construct base SQL query
$query = "SELECT COUNT(*) as total FROM formation";
$stmt = $conn->prepare($query);
$stmt->execute();
$total_results = $stmt->fetchColumn();
$total_pages = ceil($total_results / $results_per_page);

// add test if formateur
if ($role == 'formateur') {
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
  GROUP BY f.id_formation;";
  
  $stmt = $conn->prepare($query);
  $stmt->bindParam(1, $_SESSION['id_formateur']);
  $stmt->execute();
  $formations = $stmt->fetchAll(PDO::FETCH_ASSOC);
}else {
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
  LEFT JOIN session s ON f.id_formation = s.id_formation
  ";

  $where_clauses = array();
  if (!empty($sujet)) {
    $where_clauses[] = "f.sujet LIKE '%$sujet%'";
  }
  if (!empty($categorie)) {
    $where_clauses[] = "f.categorie = '$categorie'";
  }
  if (!empty($masse_horaire)) {
    $where_clauses[] = "f.masse_horaire = $masse_horaire";
  }
  if (!empty($where_clauses)) {
    $query .= " WHERE " . implode(" AND ", $where_clauses);
  }

  $query .= " GROUP BY f.id_formation";

  // Add LIMIT and OFFSET clauses for pagination
  $query .= " LIMIT $results_per_page OFFSET $offset";

  // Execute SQL query
  $stmt = $conn->prepare($query);
  $stmt->execute();
  $formations = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
  // Add WHERE clauses based on user input

?>
  


<!-- index.php -->

<!-- ... HTML code ... -->
<form method="get" action="#courses" class="search-form">
  <div class="form-group flex-container">
    <label for="sujet">Sujet</label>
    <input type="text" class="form-control" id="sujet" name="sujet" value="<?php echo $sujet; ?>" placeholder="Entrez un sujet...">
  </div>
  <div class="form-group flex-container">
    <label for="categorie">Catégorie</label>
    <select class="form-control" id="categorie" name="categorie">
      <option value="">Toutes les catégories</option>
      <option value="Informatique" <?php if ($categorie === 'Informatique') echo 'selected'; ?>>Informatique</option>
      <option value="Langues" <?php if ($categorie === 'Langues') echo 'selected'; ?>>Langues</option>
      <option value="gaming" <?php if ($categorie === 'gaming') echo 'selected'; ?>>gaming</option>
      <option value="Developement" <?php if ($categorie === 'Developement') echo 'selected'; ?>>Developement</option>

    </select>
  </div>
  <div class="form-group flex-container">
    <label for="masse_horaire">Masse horaire (heures)</label>
    <input type="number" class="form-control" id="masse_horaire" name="masse_horaire" value="<?php echo $masse_horaire; ?>" placeholder="Entrez une masse horaire...">
  </div>
  <button type="submit" class="btn btn-primary flex-container">Rechercher</button>
</form>


<div class="container">
  <div class="d-flex flex-row flex-wrap justify-content-start">
    <?php foreach ($formations as $formation): ?>
      <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="meeting-item mb-4">
          <div class="thumb">
          <?php 
            $query = $conn->prepare('SELECT * FROM `session` WHERE id_formation = :id');
            $query->bindParam(':id', $formation['id_formation'], PDO::PARAM_INT);
            $query->execute();
            $sessions = $query->fetchAll(PDO::FETCH_ASSOC);
            $has_closed_sessions = false;
            $has_canceled_sessions = false;
            for ($i = 0; $i < count($sessions); $i++) {
              $session = $sessions[$i];
              if ($session['etat'] == 'clôturée') {
                $has_closed_sessions = true;
                $debut_session_date = date(' ( M ', strtotime($session['date_debut']));
                $closed_session_date = date(' M )', strtotime($session['date_fin']));
                break;
              } elseif ($session['etat'] == 'Annulée') {
                $has_canceled_sessions = true;
                $debut_session_date = date('( M ', strtotime($session['date_debut']));
                $canceled_session_date = date(' M )', strtotime($session['date_fin']));
                break;
              }
            }
            if ($has_closed_sessions && $role == 'formateur'): ?>
              <div class="alert alert-primary" role="alert">
                This formation has closed sessions <?php echo $debut_session_date; ?> <?php echo $closed_session_date; ?>.
              </div>
            <?php endif; ?>
            <?php if ($has_canceled_sessions && $role == 'formateur'): ?>
              <div class="alert alert-danger" role="alert">
                This formation has canceled sessions <?php echo $debut_session_date; ?> <?php echo $canceled_session_date; ?>.
              </div>
            <?php endif; ?>
            <div class="price">
              <span><?php echo $formation['masse_horaire']; ?> heures</span>
            </div>
            <a href="courses-details.php?id=<?php echo $formation['id_formation']; ?>">
              <img src="<?php echo $formation['image']; ?>" alt="New Lecturer Meeting" class="meme-img">
            </a>
          </div>
          <div class="down-content">
            <a href="courses-details.php?id=<?php echo $formation['id_formation']; ?>">
              <h4><?php echo $formation['sujet']; ?></h4>
              <h6 id="h6" class="font-italic"><?php echo $formation['categorie']; ?></h6>
              <p id="pragrath"><?php echo $formation['description']; ?></p>
              
              <?php for ($i = 0; $i < count($sessions); $i++) {
                $session = $sessions[$i]; ?>
                <p id="pragrath"><?php echo date('Y , M', strtotime($session['date_debut'])); ?> to <?php echo date(' M ', strtotime($session['date_fin'])); ?></p>
              <?php } ?>
              <button class="btnn btn-primary flex-container"><a href="courses-details.php?id=<?php echo $formation['id_formation']; ?>">Learn More</button>
            </a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<!-- Add pagination links -->


<nav aria-label="Page navigation">
<form method="get" action="#courses" >
  <ul class="pagination">
    <?php if ($current_page > 1): ?>
      <li class="page-item">
        <a class="page-link" href="?page=<?php echo $current_page - 1; ?>&sujet=<?php echo $sujet; ?>&categorie=<?php echo $categorie; ?>&masse_horaire=<?php echo $masse_horaire; ?>" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
          <span class="sr-only">Previous</span>
        </a>
      </li>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
      <li class="page-item <?php if ($i == $current_page) echo 'active'; ?>">
        <a class="page-link" href="?page=<?php echo $i; ?>&sujet=<?php echo $sujet; ?>&categorie=<?php echo $categorie; ?>&masse_horaire=<?php echo $masse_horaire; ?>"><?php echo $i; ?></a>
      </li>
    <?php endfor; ?>

    <?php if ($current_page < $total_pages): ?>
      <li class="page-item">
        <a class="page-link" href="?page=<?php echo $current_page + 1; ?>&sujet=<?php echo $sujet; ?>&categorie=<?php echo $categorie; ?>&masse_horaire=<?php echo $masse_horaire; ?>" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
          <span class="sr-only">Next</span>
        </a>
      </li>
    <?php endif; ?>
  </ul>
  </form>
</nav>

  </section>
  <?php include 'includ/Main.php' ?>


<?php
    // Retrieve data from the database
    $success_count = $conn->query("SELECT COUNT(*) FROM inscription WHERE resultat = 'valid'")->fetchColumn();
    $total_count = $conn->query("SELECT COUNT(*) FROM inscription")->fetchColumn();
    if ($total_count > 0) 
        $success_rate = round(($success_count / $total_count) * 100, 2);
    else ;

    $teacher_count = $conn->query("SELECT COUNT(*) FROM formateur")->fetchColumn();
    $new_student_count = $conn->query("SELECT COUNT(*) FROM apprenant")->fetchColumn();
    $award_count = $conn->query("SELECT COUNT(*) FROM awards")->fetchColumn();

?>

<style>
.alert-danger , .alert-primary{
    padding-left: 8rem;
    border-top-right-radius: 20px;
    border-top-left-radius: 20px;
    margin-bottom: -59px;
    border-color: #f5c2c7;
}
section.our-facts .video img {
  MARGIN-LEFT: 18REM;    padding: 170px 0px;
    max-width: 56px;
}
.meme-img {

  max-width: 100%;
    height: 200px;
}
  .meeting-item {
    margin-right: 20px;
  }
  .meeting-item:last-child {
    margin-right: 23px;
}
.upcoming-meetings {
  margin-top :-100px;
}
.pagination {
  display: flex;
  justify-content: center;
  margin-top: 20px;
}

.page-link {
  background-color: #f6ab35!important;
  border: 1px solid #fff!important;
  color: #333;
  padding: 8px 16px;
  border-radius: 4px;
  transition: background-color 0.3s ease;
}

.page-link:hover {
  background-color: #eee;
  color: #fff!important;
}

.page-item.active .page-link {
  background-color: #007bff;
  border-color: #007bff;
  color: #fff;
}

.page-item:first-child .page-link {
  border-top-left-radius: 4px;
  border-bottom-left-radius: 4px;
}

.page-item:last-child .page-link {
  border-top-right-radius: 4px;
  border-bottom-right-radius: 4px;
}

.page-item.disabled .page-link {
  color: #aaa;
  cursor: not-allowed;
}
#pragrath {
  font-style: italic;
  margin-left: 0px;

}
#h6 {
  color: #f6ab35;

}

</style>
          



<section class="our-facts">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="row">
          <div class="col-lg-12">
            <h2>A Few Facts About Our University</h2>
          </div>
          <div class="col-lg-6">
            <div class="row">
              <div class="col-12">
                <div class="count-area-content percentage">
                  <div class="count-digit"><?php echo $success_rate; ?></div>
                  <div class="count-title">Succesed Students</div>
                </div>
              </div>
              <div class="col-12">
                <div class="count-area-content">
                  <div class="count-digit"><?php echo $teacher_count; ?></div>
                  <div class="count-title">Current Teachers</div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="row">
              <div class="col-12">
                <div class="count-area-content new-students">
                  <div class="count-digit"><?php echo $new_student_count; ?></div>
                  <div class="count-title">New Students</div>
                </div>
              </div> 
              <div class="col-12">
                <div class="count-area-content">
                  <div class="count-digit"><?php echo $award_count; ?></div>
                  <div class="count-title">Awards</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> 
      <div class="col-lg-6 align-self-center">
        <div class="video">
          <a href="https://www.youtube.com/watch?v=HndV87XpkWg" target="_blank"><img src="assets/images/play-icon.png" alt=""></a>
        </div>
      </div>
    </div>
  </div>
</section>
  <section class="contact-us" id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 align-self-center">
          <div class="row">
            <div class="col-lg-12">
            <form id="contact" method="post" action="index.php">
  <div class="row">
    <div class="col-lg-12">
      <h2>Let's get in touch</h2>
    </div>
    <div class="col-lg-4">
      <fieldset>
        <input name="name" type="text" id="name" placeholder="YOUR NAME...*" required="">
        <div class="invalid-feedback">Please enter your name.</div>
      </fieldset>
    </div>
    <div class="col-lg-4">
      <fieldset>
        <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*" placeholder="YOUR EMAIL..." required="">
        <div class="invalid-feedback">Please enter a valid email address.</div>
      </fieldset>
    </div>
    <div class="col-lg-4">
      <fieldset>
        <input name="subject" type="text" id="subject" placeholder="SUBJECT...*" required="">
        <div class="invalid-feedback">Please enter the subject of your message.</div>
      </fieldset>
    </div>
    <div class="col-lg-12">
      <fieldset>
        <textarea name="message" type="text" class="form-control" id="message" placeholder="YOUR MESSAGE..." required=""></textarea>
        <div class="invalid-feedback">Please enter your message.</div>
      </fieldset>
    </div>
    <div class="col-lg-12">
      <fieldset>
        <button type="submit" id="form-submit" class="button">SEND MESSAGE NOW</button>
      </fieldset>
    </div>
  </div>
  <br>
  <div id="success-message" class="alert alert-success" role="alert" style="display:none;">
  Your message was sent successfully!
</div>
</form>



<style>
  .is-invalid {
    border-color: #dc3545 !important;
  }

  .invalid-feedback {
    display: none;
    color: #dc3545;
  }

  .is-invalid + .invalid-feedback {
    display: block;
  }
</style>

            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="right-info">
            <ul>
              <li>
                <h6>Phone Number</h6>
                <span>060-125-6544</span>
              </li>
              <li>
                <h6>Email Address</h6>
                <span>YSN!@gmail.edu</span>
              </li>
              <li>
                <h6>Street Address</h6>
                <span>Tanger - RJ, 22795-008,  Maroc</span>
              </li>
              <li>
                <h6>Website URL</h6>
                <span>www.meeting.edu</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="footer">
      <p>Copyright © 2022 Edu Meeting Co., Ltd. All Rights Reserved. 
          <br>
          Design: Yasine
          <br>
          Distibuted By: Solicode
        </p>
    </div>
  </section>


  <script>
$(document).ready(function() {
  $('#contact').submit(function(event) {
    event.preventDefault();

    // Retrieve the values from the form
    var name = $('#name').val();
    var email = $('#email').val();
    var subject = $('#subject').val();
    var message = $('#message').val();

    // Validate the inputs
    var isValid = true;
    if (name.trim() == '') {
      $('#name').addClass('is-invalid');
      $('#name + .invalid-feedback').text('Please enter your name.');
      isValid = false;
    } else {
      $('#name').removeClass('is-invalid');
      $('#name + .invalid-feedback').text('');
    }
    if (email.trim() == '' || !isValidEmail(email)) {
      $('#email').addClass('is-invalid');
      $('#email + .invalid-feedback').text('Please enter a valid email address.');
      isValid = false;
    } else {
      $('#email').removeClass('is-invalid');
      $('#email + .invalid-feedback').text('');
    }
    if (subject.trim() == '') {
      $('#subject').addClass('is-invalid');
      $('#subject + .invalid-feedback').text('Please enter the subject of your message.');
      isValid = false;
    } else {
      $('#subject').removeClass('is-invalid');
      $('#subject + .invalid-feedback').text('');
    }
    if (message.trim() == '') {
      $('#message').addClass('is-invalid');
      $('#message + .invalid-feedback').text('Please enter your message.');
      isValid = false;
    } else {
      $('#message').removeClass('is-invalid');
      $('#message + .invalid-feedback').text('');
    }

    if (isValid) {
      // Do something with the values, for example, send them to the server using AJAX
      $.ajax({
        type: 'POST',
        url: 'index.php',
        data: { name: name, email: email, subject: subject, message: message },
        success: function() {
          $('#success-message').fadeIn();
          $('#contact')[0].reset();
        }
      });
    }
  });

  function isValidEmail(email) {
    // Use a regular expression to check that the email is valid
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }
});
  </script>
  <?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);
  $file = 'contact.json';
  $existingData = file_get_contents($file);
  $existingDataArray = json_decode($existingData, true);
  $existingDataArray[] = $data;
  $jsonData = json_encode($existingDataArray, JSON_PRETTY_PRINT);
  file_put_contents($file, $jsonData);

} else {

}

?>
  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendoqr/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/video.js"></script>
    <script src="assets/js/slick-slider.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
      
        //according to loftblog tut
        $('.nav li:first').addClass('active');

        var showSection = function showSection(section, isAnimate) {
          var
          direction = section.replace(/#/, ''),
          reqSection = $('.section').filter('[data-section="' + direction + '"]'),
          reqSectionPos = reqSection.offset().top - 0;

          if (isAnimate) {
            $('body, html').animate({
              scrollTop: reqSectionPos },
            800);
          } else {
            $('body, html').scrollTop(reqSectionPos);
          }

        };

        var checkSection = function checkSection() {
          $('.section').each(function () {
            var
            $this = $(this),
            topEdge = $this.offset().top - 80,
            bottomEdge = topEdge + $this.height(),
            wScroll = $(window).scrollTop();
            if (topEdge < wScroll && bottomEdge > wScroll) {
              var
              currentId = $this.data('section'),
              reqLink = $('a').filter('[href*=\\#' + currentId + ']');
              reqLink.closest('li').addClass('active').
              siblings().removeClass('active');
            }
          });
        };

        $('.main-menu, .responsive-menu, .scroll-to-section').on('click', 'a', function (e) {
          e.preventDefault();
          showSection($(this).attr('href'), true);
        });

        $(window).scroll(function () {
          checkSection();
        });
    </script>
<script type="text/javascript">
                document.getElementById("primary").onchange = function () {
                    document.getElementById("image").src = URL.createObjectURL(primary.files[0]); // Preview new image

                    document.getElementById("cancel").style.display = "block";
                    document.getElementById("confirm").style.display = "block";

                    document.getElementById("upload").style.display = "none";
                }

                var userImage = document.getElementById('image').src;
                document.getElementById("cancel").onclick = function () {
                    document.getElementById("image").src = userImage; // Back to previous image

                    document.getElementById("cancel").style.display = "none";
                    document.getElementById("confirm").style.display = "none";

                    document.getElementById("upload").style.display = "block";
                }


            </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/a5fdcae6a3.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
.search-form {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    max-width: 1459px;
    margin: 0 auto;
    padding: 26px;
    background-color: #f2f2f2;
    border-radius: 10px;
    margin-right: 38px;
    margin-bottom: 4rem;
}
  
  .form-group {
    flex-basis: calc(33.33% - 10px);
    margin-bottom: 10px;
  }

  .form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
  }

  .form-control {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid #ccc;
    box-shadow: none;
  }

  .btn {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border-radius: 5px;
    background-color: #007bff;
    border: none;
    box-shadow: none;
    background-color: #f6ab35!important;
    text-transform: uppercase;
  }
  .btnn {
    margin-left: 17rem;
    width: 34%;
    padding: 5px;
    font-size: 16px;
    border-radius: 5px;
    /* background-color: #007bff; */
    border: none;
    box-shadow: none;
    background-color: #f6ab35!important;
    text-transform: uppercase;
    color: #fff!important;
    margin-top: 0.5rem;
}
a {
    text-decoration: none !important;
    color: #fff!important; 
}

  .btn:hover {
    background-color: #0062cc;
  }

  @media (max-width: 768px) {
    .form-group {
      flex-basis: 100%;
    }
  }
</style>

<style>

  .card {
    height: 400PX;
  }
  .modal {
  margin-top: 91px;
}
.fa-regular, .far  , .upload .fa {
    margin-top: 9px;
    font-weight: 400;
}
</style>

</body>
</html>