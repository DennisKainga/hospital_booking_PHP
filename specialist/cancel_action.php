<?php 
require_once "../control/dbh.inc.php";
$statement = $pdo->prepare("UPDATE appointment SET appointment_status=8 WHERE appointment_patient_id=:id");
$statement->bindValue(":id",$_GET["pid"]);
$statement->execute();
header("Location: app.php?mess=approved");
?>