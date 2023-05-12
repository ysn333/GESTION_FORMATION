
<header class="header-area header-sticky">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <nav class="main-nav">
                      <!-- ***** Logo Start ***** -->
                      <a href="index.php" class="logo">
                          Edu Meeting
                      </a>
                      <!-- ***** Logo End ***** -->
                      <!-- ***** Menu Start ***** -->
                      <ul class="nav">
                          <li class="scroll-to-section"><a href="index.php" class="active">Home</a></li>
                          <li class="scroll-to-section"><a href="#courses">Courses</a></li> 
                          <li class="scroll-to-section"><a href="#apply"> Meeting</a></li>
                          <li class="scroll-to-section"><a href="#contact">Contact Us</a></li>
                          <li class="has-sub">
                              <a href="javascript:void(0)">Profil</a>
                              <ul class="sub-menu">
                                
                                  <li id='profil'><button type="button" class="  bt btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"> <img id="img_profil" src="files/profiles/<?php echo $img ?>" alt=""><?php echo ' '. $firstname . ' ' . $lastname ; ?></button></li>
                                  <li><a id='My_registered_courses' href="My_registered_courses.php">My registered</a></li>
                                  <li><a id='My_registered_courses' href="My_current_training.php">My current training.</a></li>
                                  <li><a id='My_registered_courses' href="My_history_courses.php">My history </a></li>
                                  
                                  <li><a id='logout' href="includ/logout.php">logout</a></li>

                              </ul>
                          </li> 
                      </ul>        
                      <a class='menu-trigger'>
                          <span>Menu</span>
                      </a>
                      <!-- ***** Menu End ***** -->
                  </nav>
              </div>
          </div>
      </div>
  </header>
  <style>
    .sub-menu {
        margin-left: -139px;
    }

  #My_registered_courses {
    background-color: #1f272b;

    border-radius: 5px;
    text-decoration: none;
    color: #fff!important;
  }
  #My_registered_courses:hover {
    background-color: #37404a;
  }

  
  #profil {
    background-color: #1f272b;
    border-radius: 5px;
    text-decoration: none;
    color: #fff!important;  
  }
  .bt {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border-radius: 5px;
    background-color: #007bff;
    border: none;
    box-shadow: none;
    background-color: #1f272b!important;
    text-transform: uppercase;
}


#logout {
  background-color: #a12c2f;
  border-radius: 5%;
  color: #fff!important;
}
  </style>