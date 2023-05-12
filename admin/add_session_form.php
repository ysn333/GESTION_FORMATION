<?php
session_start();


include "../db/dbconfig.php";

if(isset($_POST["submit"])){
  $date_debut = $_POST['date_debut'];
  $date_fin = $_POST['date_fin'];
  $nombre_places_max = $_POST['nombre_places_max'];
  $etat = $_POST['etat'];
  $id_formation = $_POST['id_formation'];
  $id_formateur = $_POST['id_formateur'];

  $sql = "INSERT INTO session (date_debut, date_fin, nombre_places_max, etat, id_formation, id_formateur) VALUES (:date_debut, :date_fin, :nombre_places_max, :etat, :id_formation, :id_formateur)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':date_debut', $date_debut);
  $stmt->bindParam(':date_fin', $date_fin);
  $stmt->bindParam(':nombre_places_max', $nombre_places_max);
  $stmt->bindParam(':etat', $etat);
  $stmt->bindParam(':id_formation', $id_formation);
  $stmt->bindParam(':id_formateur', $id_formateur);

  if ($stmt->execute()) {
      echo "New session record created successfully";
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
  <title>add session</title>
</head>
<body>

<?php include 'includ\nav.php'; ?>

<div class="container mt-5">
      <div class="row mt-5">
        <div class="col-lg-12 mt-5">  
            <form method="POST" >
                <div class="form-group mt-5">
                <label for="date_debut">Date de début:</label>
                <input type="date" class="form-control" id="date_debut" name="date_debut" required>
                </div>
                <div class="form-group">
                <label for="date_fin">Date de fin:</label>
                <input type="date" class="form-control" id="date_fin" name="date_fin" required>
                </div>
                <div class="form-group">
                <label for="nombre_places_max">Nombre de places max:</label>
                <input type="number" class="form-control" id="nombre_places_max" name="nombre_places_max" required>
                </div>
                <div class="form-group">
                <label for="etat">Etat:</label>
                <select  class="form-control" id="etat" name="etat" required>
                    <option value="in process of registration">in process of registration</option>
                </select>
                </div>
                <div class="form-group">
                    <label for="id_formation">ID Formation:</label>
                    <select class="form-control" id="id_formation" name="id_formation" required>
                        <?php
                        include "../db/dbconfig.php";
                        $sql = "SELECT id_formation FROM formation";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $formations = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach($formations as $formation){
                        echo "<option value='". $formation['id_formation'] ."'>". $formation['id_formation'] ."</option>";
                        }
                        ?>
                    </select>
                    </div>
                    <div class="form-group">
                    <label for="id_formateur">ID Formateur:</label>
                    <select class="form-control" id="id_formateur" name="id_formateur" required>
                        <?php
                        $sql = "SELECT id_formateur FROM formateur";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $formateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach($formateurs as $formateur){
                        echo "<option value='". $formateur['id_formateur'] ."'>". $formateur['id_formateur'] ."</option>";
                        }
                        ?>
                    </select>
                    </div>
                <button type="submit" class="btn btn-primary" name="submit">Ajouter</button>
            </form>
        </div>
    </div>
</div>

  <!-- JavaScript and jQuery -->
</body>
</html>