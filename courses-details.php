<?php
  include "db/dbconfig.php";
  session_start();


  if (!isset($_SESSION["email"])) {
    header("location: login.php");
  }

  $id = $_GET['id'];
  $query = $conn->prepare('SELECT * FROM formation WHERE id_formation = :id');
  $query->bindParam(':id', $id, PDO::PARAM_INT);
  $query->execute();
  $formation = $query->fetch(PDO::FETCH_ASSOC);

  $query = $conn->prepare('SELECT * FROM `session` WHERE id_formation = :id');
  $query->bindParam(':id', $id, PDO::PARAM_INT);
  $query->execute();
  $sessions = $query->fetchAll(PDO::FETCH_ASSOC);

  $firstname = $_SESSION['firstname'];
  $lastname = $_SESSION['lastname'];
  $email =  $_SESSION['email'];
  $img = $_SESSION['img'];

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Template Mo">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <title>course </title>
    <link rel ="icon"  href = "https://www.creativefabrica.com/wp-content/uploads/2020/11/02/Abstract-Logo-Design-Vector-Logo-Graphics-6436279-1-312x208.jpg"  type = "image/x-icon">

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <?php include 'includ/cdn_css.php' ?>


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-edu-meeting.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">

  </head>

<body>

   

  <!-- Sub Header -->
  <div class="sub-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-sm-8">
          <div class="left-content">
          </div>
        </div>
        <div class="col-lg-4 col-sm-4">
          <div class="right-icons">
            <ul>
              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa fa-behance"></i></a></li>
              <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ***** Header Area Start ***** -->
  <?php include 'includ/nav.php' ?>
  <!-- ***** Header Area End ***** -->


  <section class="heading-page header-text" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h6>Get all details</h6>
          <h2>CENTRE TEACHING AND LEARNING TOOLS</h2>
        </div>
      </div>
    </div>
  </section>


  <section class="meetings-page" id="meetings">
  <form id="join-form" action="join_session.php" method="post">

  <div class="container">
    <div class="row">
      <?php foreach ($sessions as $session): ?>
      <div class="col-lg-12">
        <div class="meeting-single-item">
          <div class="row">
            <div class="col-lg-4 col-md-6">
            <div class="thumb">
                <div class="date">
                  <h6><span><?php echo date('M ', strtotime($session['date_debut'])); ?> - <?php echo date('M', strtotime($session['date_fin'])); ?></span></h6>
                </div>
                <img src="<?php echo $formation['image']; ?>" alt="<?php echo $formation['sujet']; ?>">
              </div>
            </div>
            <div class="col-lg-8 col-md-6">
              <div class="down-content">
                <a href="meeting-details.html"><h4><?php echo $formation['sujet']; ?></h4></a>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="hours">
                      <h5><span>● </span> Date</h5>
                      <p>date_debut : <?php echo $session['date_debut']; ?><br> date_fin : <?php echo $session['date_fin']; ?></p>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="location">
                      <h5><span>● </span>  Etat</h5>
                      <p><?php echo $session['etat']; ?></p>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="location">
                      <h5><span>● </span> Categorie</h5>
                      <p><?php echo $formation['categorie']; ?></p>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="location">
                      <h5><span>● </span>  Nombre places max</h5>
                      <p><?php echo $session['nombre_places_max'] ; ?></p>
                    </div>
                  </div>
                  <?php 
                    $query = $conn->prepare('SELECT COUNT(*) AS num_enrolled FROM inscription WHERE id_session = :id_session');
                    $query->bindParam(':id_session', $session['id_session'], PDO::PARAM_INT);
                    $query->execute();
                    $num_enrolled = $query->fetch(PDO::FETCH_ASSOC)['num_enrolled'];
                  ?>
                  <div class="col-lg-6">
                    <div class="location">
                      <h5><span>● </span>  Enrolled Students</h5>
                      <p><?php echo $num_enrolled; ?></p>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <?php 
                      $query = $conn->prepare('SELECT * FROM `formateur` WHERE id_formateur = :id');
                      $query->bindParam(':id', $session['id_formateur'], PDO::PARAM_INT);
                      $query->execute();
                      $formateur = $query->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <div class="location">
                      <h5><span>● </span>  Formateur</h5>
                      <p><?php echo $formateur[0]['firstname'] . ' ' . $formateur[0]['lastname']; ?></p>
                    </div>
                  </div>
                </div>
                <p class="description"><?php echo $formation['description']; ?></p>
                <div class="main-button-red">
                  <a href="join_session.php?id=<?php echo  $session['id_session']; ?>">Join</a>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
    <div class="footer">
      <p>Copyright © 2022 Edu Meeting Co., Ltd. All Rights Reserved. 
          <br>
          Design: <a href="https://templatemo.com" target="_parent" title="free css templates">Yassine</a>
          <br>
          Distibuted By: <a href="https://themewagon.com" target="_blank" title="Build Better UI, Faster">Solicode</a>
        </p>
    </div>
    </form>
  </section>

  <style>
      /* Style for the meetings-page section */
      span {
        color: #ffc107;
      }
      .meeting-single-item .thumb img {
        border-radius: 20px;
        margin-top: 30px;
      }
      .meetings-page {
        background-color: #f8f8f8;
        padding: 80px 0;
        text-align: center;
      }

      .meetings-page h4 {
        color: #333;
        font-weight: bold;
        margin-bottom: 20px;
      }

      .meetings-page p.description {
        color: #777;
        font-size: 16px;
        margin-bottom: 30px;
      }

      .meetings-page .thumb {
        position: relative;
        overflow: hidden;
        margin-bottom: 30px;
      }

      .meetings-page .thumb img {
        width: 100%;
        height: auto;
        transition: all 0.3s ease-in-out;
      }

      .meetings-page .thumb:hover img {
        transform: scale(1.1);
      }

      .meetings-page .down-content {
        text-align: left;
      }

      .meetings-page .hours,
      .meetings-page .location {
        margin-bottom: 20px;
      }

      .meetings-page .share {
        margin-top: 50px;
      }

      .meetings-page .share ul {
        list-style: none;
        padding: 0;
        margin: 0;
      }

      .meetings-page .share ul li {
        display: inline-block;
        margin-right: 20px;
        font-size: 16px;
        color: #333;
      }

      .meetings-page .main-button-red a {
        margin-top: -26px!important;
        MARGIN-LEFT: 35REM;
          background-color: #f5a425;
          color: #fff;
          text-transform: uppercase;
          font-weight: bold;
          padding: 15px 30px;
          display: inline-block;
          border-radius: 25px;
          transition: all 0.3s ease-in-out;
        }

        .meetings-page .main-button-red a:hover {
          background-color: #333;
          color: #fff;
          text-decoration: none;
          border:1PX SOLID #ffc107   ;
        }

              .meetings-page {
          background-color: #f2f2f2;
        }

        .meeting-single-item {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0px 0px 0px rgb(255 255 255);
            border-radius: 20px;
        }
        .meeting-single-item:hover {
          box-shadow: 0px 0px 10px rgb(255 255 255);
        }

        .meeting-single-item .thumb {
          position: relative;
        }

        .meeting-single-item .thumb img {
          width: 100%;
          height: auto;
        }





        .meeting-single-item .thumb .date span {
          font-size: 18px;
          font-weight: bold;
        }

        .meeting-single-item .down-content h4 {
          margin-top: 0;
          font-size: 24px;
          font-weight: bold;
          color: #333;
        }

        .meeting-single-item .down-content p {
          color: #666;
          line-height: 1.8em;
          margin-bottom: 0;
        }

        .meeting-single-item .down-content .hours h5,
        .meeting-single-item .down-content .location h5,
        .meeting-single-item .down-content .share h5 {
          color: #333;
          font-size: 18px;
          font-weight: bold;
          margin-top: 0;
          margin-bottom: 10px;
        }

        .meeting-single-item .down-content .hours p,
        .meeting-single-item .down-content .location p {
          margin-top: 0;
          margin-bottom: 0;
        }

        .main-button-red a {
          display: inline-block;
          background-color: #f44336;
          color: #fff;
          padding: 10px 20px;
          border-radius: 30px;
          text-transform: uppercase;
          font-weight: bold;
          letter-spacing: 2px;
          transition: all 0.3s ease;
        }

        .main-button-red a:hover {
          background-color: #fff;
          color: #f44336;
          border: 1px solid #f44336;
        }

      .meetings-page .main-button-red a:hover {
        background-color: #333;
      }

      .meetings-page .footer {
        margin-top: 80px;
        text-align: center;
        color: #777;
      }
      .meeting-single-item .down-content h4 {
            margin-left: -7px;
            margin-top: -13px;
            font-size: 36px;
            font-weight: bold;
            color: #ffc107;
        }
    </style>
  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

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
  </body>
</html>
