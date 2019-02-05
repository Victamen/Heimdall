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

$orden = $mysqli->real_escape_string($_POST['orden']);
$cierre = $mysqli->real_escape_string($_POST['cierre']);

//Si hay error en la conexión.
if(mysqli_connect_error()) {
	die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
} 
else {   

	$COM = "SELECT orden FROM ftedata WHERE orden = ?";
	$COM2 = "SELECT orden FROM ftedata WHERE orden = ? AND estado = 'abierta'";
	$COM3 = "SELECT orden FROM ftedata WHERE orden = ? AND estado = 'cerrada'";

	$OPEN = "UPDATE ftedata SET estado = 'abierta' WHERE orden = ?";
	$CLOSE = "UPDATE ftedata SET estado = 'cerrada' WHERE orden = ?";
    $ENDWO = "UPDATE ftedata SET cierre = '$cierre' WHERE orden = ?";

	//Compruebo datos en tabla comparativa con datos en tabla principal (compruebo si existe orden).
    $result = $mysqli->prepare($COM);
    $result->bind_param("s", $orden);
    $result->execute();
    $result->bind_result($orden);
    $result->store_result();
    $care = $result->num_rows;
    $result->close();

	//Compruebo datos en tabla comparativa con datos en tabla principal (compruebo si orden abierta).
    $result = $mysqli->prepare($COM2);
    $result->bind_param("s", $orden);
    $result->execute();
    $result->bind_result($orden);
    $result->store_result();
    $care2 = $result->num_rows;
    $result->close();

    //Compruebo datos en tabla comparativa con datos en tabla principal (compruebo si orden cerrada).	
    $result = $mysqli->prepare($COM3);
    $result->bind_param("s", $orden);
    $result->execute();
    $result->bind_result($orden);
    $result->store_result();
    $care3 = $result->num_rows;
    $result->close();

	//Si no existe orden, ignoro la petición.
    if($id != '' && $care != 0) {
    	//Si está bierta, la cierro.
    	if($care2 != 0) {
    		$result = $mysqli->prepare($CLOSE);
            $result->bind_param("s", $orden);
            $result->execute();
            $result->close();

            $result = $mysqli->prepare($ENDWO);
            $result->bind_param("s", $orden);
            $result->execute();
            $result->close();
        	header('Location: /FTEform/successempress_close.html');
    	}
    	else {
    		//Si está cerrada, la abro.
    		if($care3 != 0) {
    			$result = $mysqli->prepare($OPEN);
            	$result->bind_param("s", $orden);
            	$result->execute();
            	$result->close();

                $result = $mysqli->prepare($ENDWO);
                $result->bind_param("s", $orden);
                $result->execute();
                $result->close();
        		header('Location: /FTEform/successempress_open.html');
    		}
    	}
    }
    else {
    	header('Location: /FTEform/menuempress.html');
    }

    $mysqli->close();
}
?>
