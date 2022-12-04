<?php 

require_once "../control/dbh.inc.php";
$statement = $pdo->prepare("DELETE FROM appointment WHERE appointment_id=:id");
$statement->bindValue(":id",$_GET["app_id"]);
$statement->execute();
header("Location: visits.php?mess=deleted");
?>