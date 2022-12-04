<?php

require_once "../control/dbh.inc.php";
$statement = $pdo->prepare("UPDATE appointment SET appointment_status=2 WHERE appointment_id=:id");
$statement->bindValue(":id",$_GET["app_id"]);
$statement->execute();
header("Location: app.php?mess=completed");
?>