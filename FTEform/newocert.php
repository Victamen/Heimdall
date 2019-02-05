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
$id = $_SESSION["idm"];

$orden = $mysqli->real_escape_string($_POST['orden'].''.$_POST['num'].''.$_POST['ann']);
$mat = $mysqli->real_escape_string($_POST['orden']);
$amicertif = $_POST['amicertif'];

//Si hay error en la conexión.
if(mysqli_connect_error()) {
	die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
} 
else {   
	$_SESSION["ordm"] = $orden;
	$_SESSION["matt"] = $mat;
	$_SESSION["ami"] = $amicertif;

	$COM = "SELECT orden FROM ftedata WHERE orden = ?";

	//Compruebo datos en tabla comparativa con datos en tabla principal (compruebo si existe orden).
    $result = $mysqli->prepare($COM);
    $result->bind_param("s", $orden);
    $result->execute();
    $result->bind_result($orden);
    $result->store_result();
    $care = $result->num_rows;
    $result->close();

    //Si no existe orden la creo, sino relleno una existente.
    if($id != '' && $care == 0) {
    	header('Location: /FTEform/formucertinsp.html');
    }
    else{
    	if($id != '') {
    		header('Location: /FTEform/formucertnoinsp.html');
    	}
    	else {
    		header('Location: /FTEform/failurecert.html');
    	}
    }
   	
   	$mysqli->close();
}
?>
