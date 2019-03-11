<?php

//Datos para conectar.
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "fte";
    
//Crear conexión.
$mysqli = new mysqli($host, $dbUsername, $dbPassword, $dbname);

session_start();
$_SESSION["idm"];

$orden = $mysqli->real_escape_string($_POST['orden']);
$fecha = $mysqli->real_escape_string($_POST['fecha']);
$mechname = $mysqli->real_escape_string($_POST['mechname']);

//Si hay error en la conexión.
if(mysqli_connect_error()) {
	die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
} 
else {   
	$_SESSION["orden"] = $orden;
	$_SESSION["fecha"] = $fecha;
	$_SESSION["mechname"] = $mechname;

	//Borrado de la Base de Datos los datos del mecánico seleccionado.
    $DELETE_RECORD = "DELETE FROM ftedata WHERE 
    ftedata.orden = '$orden' AND ftedata.fecha = '$fecha' AND ftedata.id = '$mechname'";


    $action = $mysqli->prepare($DELETE_RECORD);
    $action->execute();
    $action->close();

    header('Location: /FTEform/mechupdate_cheers.html');
   	
   	$mysqli->close();
}
?>
