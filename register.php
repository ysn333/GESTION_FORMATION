<?php
include "db/dbconfig.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/register.css">
        <link rel ="icon"  href = "https://www.creativefabrica.com/wp-content/uploads/2020/11/02/Abstract-Logo-Design-Vector-Logo-Graphics-6436279-1-312x208.jpg"  type = "image/x-icon">

    <title>register</title>
</head>
<body>
  <div class="form-body">
    <div class="row">
        <div class="form-holder">
            <div class="form-content">
                <div class="form-items">
                    <h3>Register Today</h3>
                    <p>Fill in the data below.</p>

<form class="requires-validation" action="register_post.php" method="POST">
    <div class="col-md-12">
        <input class="form-control" type="text" name="firstname" placeholder="first name" required>
        <div class="invalid" ><?php if (isset($first_name_errer)) {echo $first_name_errer ;}?></div>
    </div>

    <div class="col-md-12">
        <input class="form-control" type="text" name="lastname" placeholder="last name" required>
        <div class="invalid"><?php if (isset($last_name_errer)) {echo $last_name_errer ;}?></div>
    </div>

    <div class="col-md-12">
        <input class="form-control" type="email" name="email" placeholder="E-mail Address" required>
        <div class="invalid"><?php if (isset($email_errer)) {echo $email_errer ;}?></div>
    </div>

    <div class="col-md-12">
        <input class="form-control" type="password" name="password" placeholder="Password" required>
        <div class="invalid"><?php if (isset($password_errer)) {echo $password_errer ;}?></div>
    </div>

    <div class="col-md-12">
        <input class="form-control" type="password" name="confirm_password" placeholder="Confirm Password" required>
        <div class="invalid"><?php if (isset($confirm_password_errer)) {echo $confirm_password_errer ;}?></div>
    </div>

    <div class="form-button mt-3">
        <button id="submit" type="submit" name="submit" class="btn btn-primary">Register</button>
    </div> <br>

    <a href="login.php">log in</a>
</form>

                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .invalid{
        color: #ff606e;
    }
</style>
</body>
</html>