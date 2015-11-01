<?php

include 'config.php';



$sql = "SELECT idTrabajo, descripcion, fotoTrabajo, porcentaje, tituloTrabajo FROM trabajos WHERE idUsuario =:id";



try {

	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	

	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$stmt = $dbh->prepare($sql);  

	$stmt->bindParam("id", $_GET['id']);

	$stmt->execute();

	$trabajos = $stmt->fetchAll(PDO::FETCH_OBJ);

	$dbh = null;

	echo '{"item":'. json_encode($trabajos) .'}'; 

} catch(PDOException $e) {

	echo '{"error":{"text":'. $e->getMessage() .'}}'; 

}



?>