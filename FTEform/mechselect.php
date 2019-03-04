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

	//$COM = "SELECT orden, fecha, id FROM ftedata WHERE orden = ? AND fecha = ? AND id = ?";

    header('Location: /FTEform/formuedit_update.html');
   	
   	$mysqli->close();
}
?>
