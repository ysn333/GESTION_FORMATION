<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Profil</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <form action="includ/update_profile_image.php" enctype="multipart/form-data" method="post">
                <div class="upload">
                    <div id="affishier-img">
                        <img src="files/profiles/<?= $img ?>" id="image">
                    </div>

                    <div class="rightRound" id="upload">
                        <input type="file" name="primary" id="primary" accept=".jpg, .jpeg, .png">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </div>

                    <div class="leftRound" id="cancel" style="display: none;">
                        <i class="fa-regular fa-trash-can"></i>
                    </div>
                    <div class="rightRound" id="confirm" style="display: none;">
                        <input type="submit" name="update">
                        <i class="fa fa-check"></i>
                    </div>
            </div>

            </form>

            <div class="modal-body">
    <form action="includ/update_profile.php" method="POST">
        <div class="mb-3">
            <label for="firstname" class="form-label">First Name:</label>
            <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $firstname; ?>">
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">Last Name:</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $lastname; ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
</div>
  <a id='My_registered_courses' href="My_registered_courses.php">My_registered_courses</a>
</div>

<style>
  #My_registered_courses {
    color: blue;
    text-decoration: none;
    font-weight: bold;
  }
  #My_registered_courses:hover {
    color: red;
    text-decoration: underline;
  }
</style>
  
    </div>
  </div>
</div>