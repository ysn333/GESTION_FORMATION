<!DOCTYPE html>
<html lang="en">
<head>

<head>
    <meta charset="UTF-8">
    <title>My Registered Courses</title>
    <link rel="stylesheet" href="path/to/your/css/file.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<?php include "includ\congratulations.php"; ?>


<?php
    include "db/dbconfig.php";

    session_start();

    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $email = $_SESSION['email'];
    $id_apprenant = $_SESSION['id_apprenant'];
    $id_session = $_GET['id'];

    $stmt = $conn->prepare("SELECT date_debut FROM session WHERE id_session = :id_session");
    $stmt->bindParam(':id_session', $id_session);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

if (!empty($_SESSION["id_apprenant"])) {
    $id_apprenant = $_SESSION['id_apprenant'];
    $id_session = $_GET['id'];

    // Retrieve the maximum capacity of the session
    $max_capacity_stmt = $conn->prepare("SELECT nombre_places_max FROM session WHERE id_session = :id_session");
    $max_capacity_stmt->bindParam(':id_session', $id_session);
    $max_capacity_stmt->execute();
    $max_capacity = $max_capacity_stmt->fetchColumn();

    // Retrieve the session information
    $stmt = $conn->prepare("SELECT * FROM session WHERE id_session = :id_session");
    $stmt->bindParam(':id_session', $id_session);
    $stmt->execute();
    $session = $stmt->fetch(PDO::FETCH_ASSOC);


    // Count the number of learners already registered for the session
    $num_registered_stmt = $conn->prepare("SELECT COUNT(*) FROM inscription WHERE id_session = :id_session");
    $num_registered_stmt->bindParam(':id_session', $id_session);
    $num_registered_stmt->execute();
    $num_registered = $num_registered_stmt->fetchColumn();

    if ($num_registered >= $max_capacity) {
        // Display a message indicating that the session is full
        $msg = '<div class="alert alert-danger text-center">
        <h4>Sorry, this session is full. The maximum number of enrollments has been reached.</h4>
        <a class="btn btn-outline-dark" href="My_registered_courses.php">My registered courses</a>
        </div>';
    } elseif ($session['etat'] === 'completed' || $session['etat'] === 'clôturée' || $session['etat'] === 'Annulée' || $session['etat'] === 'en cours') {
        // Display a message indicating that the session is not available for registration
        $msg = '<div class="alert alert-danger text-center">
        <h4>Sorry, this session is not available for registration at this time.</h4>
        <a class="btn btn-outline-dark" href="My_registered_courses.php">My registered courses</a>
        </div>';
    } else {
        // Check if the trainee is already registered for another course on the same date
        $stmt = $conn->prepare("SELECT * FROM session WHERE id_session = :id_session");
        $stmt->bindParam(':id_session', $id_session);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $date_fin = $result['date_fin'];
        $date_debut = $result['date_debut'];

        if (is_array($result) && isset($result['date_debut'])) {
           

            $overlapSessionsStmt = $conn->prepare("SELECT COUNT(*) FROM inscription i 
                INNER JOIN session s ON s.id_session = i.id_session
                WHERE i.id_apprenant = :id_apprenant
                AND (
                    (s.date_debut >= :date_debut AND s.date_debut <= :date_fin)
                    OR (s.date_fin >= :date_debut AND s.date_fin <= :date_fin)
                    OR (s.date_debut <= :date_debut AND s.date_fin >= :date_fin)
                )");
            $overlapSessionsStmt->bindParam(':id_apprenant', $id_apprenant);
            $overlapSessionsStmt->bindParam(':date_debut', $date_debut);
            $overlapSessionsStmt->bindParam(':date_fin', $date_fin);
            $overlapSessionsStmt->execute();
            $overlapSessionsData = $overlapSessionsStmt->fetchColumn();

            // Check if the trainee is already enrolled in this session
            $alreadyEnrolledStmt = $conn->prepare("SELECT * FROM inscription WHERE id_apprenant = :id_apprenant AND id_session = :id_session");
            $alreadyEnrolledStmt->bindParam(':id_apprenant', $id_apprenant);
            $alreadyEnrolledStmt->bindParam(':id_session', $id_session);
            $alreadyEnrolledStmt->execute();
            $alreadyEnrolledData = $alreadyEnrolledStmt->fetchAll(PDO::FETCH_NUM);

            // Check if the trainee has enrolled in more than 2 other sessions
            $current_year = date('Y');
            $stmt = $conn->prepare("SELECT s.* FROM inscription i
                                    INNER JOIN session s ON s.id_session = i.id_session
                                    WHERE i.id_apprenant = :id_apprenant
                                    AND YEAR(s.date_debut) = :current_year");
            $stmt->bindParam(':id_apprenant', $id_apprenant);
            $stmt->bindParam(':current_year', $current_year);
            $stmt->execute();
            $registered_sessions = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($alreadyEnrolledData) == 0 && count($registered_sessions) < 2 && $overlapSessionsData == 0) {

                $insertStmt = $conn->prepare("INSERT INTO inscription(id_apprenant, id_session) VALUES (:id_apprenant, :id_session)");
                $insertStmt->bindParam(':id_apprenant', $id_apprenant);
                $insertStmt->bindParam(':id_session', $id_session);
                $insertStmt->execute();

                $msg = '<div class="alert alert-success text-center">
                <h4>You have joined the session</h4>
                <a class="btn btn-outline-dar" href="My_registered_courses.php">My registered courses</a>
                </div>';

            }elseif ($overlapSessionsData > 0) {

                $msg = '<div class="alert alert-danger text-center">
                <h4>You are already registered for a course on the same date</h4>
                <a class="btn btn-outline-dark" href="My_registered_courses.php">My registered courses</a>
                </div>';

            } elseif (count($alreadyEnrolledData) > 0) {

                $msg = '<div class="alert alert-danger text-center">
                <h4>You have already joined this session</h4>
                <a class="btn btn-outline-dark" href="My_registered_courses.php">My registered courses</a>
                </div>';

            } elseif (count($registered_sessions) >= 2) {
                $msg = '<div class="alert alert-danger text-center">
                <h4>You have already joined 2 sessions</h4>
                <a class="btn btn-outline-dark" href="My_registered_courses.php">My registered courses</a>
                </div>';
            } else {
                $msg = '<div class="alert alert-danger text-center">
                <h4>You are already registered for a course on the same date</h4>
                <a class="btn btn-outline-dark" href="My_registered_courses.php">My registered courses</a>
                </div>';

            }


        } else {
            $msg = '<div class="alert alert-danger text-center">
                <h4>Oops, something went wrong</h4>
                <a class="btn btn-outline-dark" href="My_registered_courses.php">My registered courses</a>
                </div>';
        }

    }


} else {
    header("Location: login.php");
}

function checksession($array, $id)
{
    foreach ($array as $item) {
        if ($item[0] == $id) return true;
        return false;
    }
}

function checkIfAlreadyRegistered($id_apprenant,
$id_session)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM inscription WHERE id_apprenant = :id_apprenant AND id_session = :id_session");
    $stmt->bindParam(':id_apprenant', $id_apprenant);
    $stmt->bindParam(':id_session', $id_session);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        return true;
    } else {
        return false;
    }
}




// Check if the event was created successfully
if ($stmt->errorCode() !== '00000') {
    $errorInfo = $stmt->errorInfo();
    echo "Error creating event: {$errorInfo[2]}\n";
} else {
    echo "Event created successfully\n";
}

?>


<style>
.alert-danger {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 500px;
    padding: 30px;
    border-radius: 8px;
    background-color: #FF5252;
    color: #fff;
    font-size: 22px;
    font-weight: bold;
    text-align: center;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.4);
    opacity: 0;
    transition: all 0.5s ease-in-out;
}

.alert-danger {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 500px;
    padding: 30px;
    border-radius: 8px;
    background-color: #FF5252;
    color: #fff;
    font-size: 22px;
    font-weight: bold;
    text-align: center;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.4);
    opacity: 0;
    transition: all 0.5s ease-in-out;
}

.alert-success {
    position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 500px;
  padding: 30px;
  border-radius: 8px;
  background-color: #34c240;
  color: #fff;
  font-size: 22px;
  font-weight: bold;
  text-align: center;
  box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.4);
  opacity: 0;
  transition: all 0.5s ease-in-out;
}

.alert.show {
    opacity: 1;
}

.btn-outline-dark {
    color: #fff;
    border-color: #fff;
}

.btn-outline-dar {
    color: #fff;
    border-color: #fff;
}

.btn-outline-dark:hover {
    color: #fff;
    background-color: #FF5252;
    border-color: #FF5252;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var alertBox = document.querySelector(".alert");
    alertBox.classList.add("show");
    setTimeout(function(){
        alertBox.classList.remove("show");
        setTimeout(function() {
            window.location.href = "My_registered_courses.php";
        }, 500);
    }, 2000);
});
</script>';
<body>
<div class="card">
<?php     echo $msg .' ' .$overlapSessionsData; ?>
</div>


</body>
</html>