<?php
require_once "../control/dbh.inc.php";

$statement = $pdo->prepare("DELETE FROM ailment WHERE ailment_id=:id");
$statement->bindValue(":id",$_GET["aid"]);
$statement->execute();
$app_id = $_GET["app_id"];
$pid = $_GET["pid"];
header("Location: visit.php?mess=deleted&app_id=$app_id&pid=$pid");

?>