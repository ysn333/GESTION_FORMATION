 <!-- Bootstrap core JavaScript -->
 <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/accordions.js"></script>

    <script language="javascript" type="text/javascript" src="assets/js/moment.min.js"></script>
    <script language="javascript" type="text/javascript" src="assets/js/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/daterangepicker.css" />


<style>
    img {
        height: 100px;
    }
    .card {
  border: 1px solid #ccc;
  border-radius: 5px;
  box-shadow: 0 2px 2px rgba(0, 0, 0, 0.3);
  transition: all 0.3s ease;
}

section.our-courses {
    padding-bottom: 130px;
    height: 100pc;
}

.card:hover {
  box-shadow: 0 4px 4px rgba(0, 0, 0, 0.3);
  transform: translateY(-5px);
}

.card-img-top {
  object-fit: cover;
  height: 200px;
}

.card-title {
  font-size: 1.2rem;
  font-weight: bold;
  margin-bottom: 0.5rem;
}

.card-text {
  font-size: 1rem;
  line-height: 1.5;
  margin-bottom: 1rem;
}

.card small {
  font-size: 0.8rem;
}

.card button {
  border: none;
  border-radius: 5px;
  background-color: #ff0000;
  color: #ffffff;
  font-size: 16px;
  padding: 0.5rem 1rem;
  transition: all 0.3s ease;
}

.card button:hover {
  background-color: #cc0000;
}

.card {
    height: 400PX;
  }
  .modal {
  margin-top: 250px;
}
</style>
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