<?php
require_once "../control/dbh.inc.php";

// $statement = $pdo->prepare("DELETE FROM specialist WHERE specialist_id=:id");
// $statement->bindValue(":id",$_GET["id"]);
// $statement->execute();
// unset($statement);
$statement = $pdo->prepare("DELETE FROM login WHERE login_id=:id");
$statement->bindValue(":id",$_GET["lid"]);
$statement->execute();
header("Location: index.php?mess=deleted");

?>