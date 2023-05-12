<?php
include "../db/dbconfig.php";
session_start();

if(isset($_POST["submit"])){
  $sujet = $_POST['sujet'];
  $categorie = $_POST['categorie'];
  $masse_horaire = $_POST['masse_horaire'];
  $description = $_POST['description'];

  if(isset($_FILES['image']) && $_FILES['image']['error'] === 0){
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    $allowed_exts = array("jpg", "jpeg", "png", "gif");

    // Check if the uploaded file is an image
    if(in_array($image_ext, $allowed_exts)){
      $image_path = "uploads/" . uniqid() . "." . $image_ext;
      move_uploaded_file($image_tmp, $image_path);
    } else {
      echo "Error: The uploaded file is not an image.";
      exit;
    }
  } else {
    echo "Error: No image was uploaded.";
    exit;
  }

  $sql = "INSERT INTO formation (sujet, categorie, masse_horaire, description, image) VALUES (:sujet, :categorie, :masse_horaire, :description, :image)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':sujet', $sujet);
  $stmt->bindParam(':categorie', $categorie);
  $stmt->bindParam(':masse_horaire', $masse_horaire);
  $stmt->bindParam(':description', $description);
  $stmt->bindParam(':image', $image_path);

  if ($stmt->execute()) {
      echo "New formation record created successfully";
  } else {
      echo "Error: " . $stmt->errorInfo()[2];
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <title>add formation</title>
</head>
<body>

<?php include 'includ\nav.php'; ?>

<div class="container mt-5">
      <div class="row mt-5">
        <div class="col-lg-12 mt-5">  
            <form method="POST" action="add_formation.php" enctype="multipart/form-data">
                <div class="form-group mt-5">
                <label for="sujet">Sujet:</label>
                <input type="text" class="form-control" id="sujet" name="sujet" required>
                </div>
                <div class="form-group">
                <label for="categorie">Catégorie:</label>
                <input type="text" class="form-control" id="categorie" name="categorie" required>
                </div>
                <div class="form-group">
                <label for="masse_horaire">Masse horaire:</label>
                <input type="text" class="form-control" id="masse_horaire" name="masse_horaire" required>
                </div>
                <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
                </div>
                <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Ajouter</button>
            </form>
        </div>
    </div>
</div>

  <!-- JavaScript and jQuery -->
</body>
</html>