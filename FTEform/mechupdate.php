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
$_SESSION["mechname"];
$_SESSION["orden"];
$_SESSION["fecha"];

$id = $_SESSION["mechname"];
$orden = $_SESSION["orden"];
$fecha = $_SESSION["fecha"];

//Si hay error en la conexión.
if(mysqli_connect_error()) {
	die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
} 
else {   
  	$INSERT = "INSERT INTO ftedata (id, orden, fecha, cert, airplane, insp, datos,
    hs1, he1, datos1, hs2, he2, datos2, hs3, he3, datos3, hs4, he4, datos4, hs5, he5, datos5, estado) 
    	VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $INSERTCP = "INSERT INTO ftecp (idc, ordenc, fechac, certc, airplanec, inspc, datosc,
    hs1c, he1c, datos1c, hs2c, he2c, datos2c, hs3c, he3c, datos3c, hs4c, he4c, datos4c, hs5c, he5c, datos5c, estadoc) 
    	VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    			
   	//Inserto en tabla comparativa.
    $incp = $mysqli->prepare($INSERTCP);
    $incp->bind_param("sssssssiisiisiisiisiiss", $id, $orden, $fecha, $cert, $airplane, $insp, $datos,
        $hs1, $he1, $datos1, $hs2, $he2, $datos2, $hs3, $he3, $datos3, $hs4, $he4, $datos4, $hs5, $he5, $datos5, $estado);
    $incp->execute();
    $incp->close();

    //Inserto en tabla comparativa.
    $inmat = $mysqli->prepare($INSERTMAT);
    $inmat->bind_param("sss", $ord, $airplane, $insp);
    $inmat->execute();
    $inmat->close();

    //Compruebo datos en tabla comparativa con datos en tabla principal (horas correctas).
    $result = $mysqli->prepare($COM);
    $result->bind_param("ssssiiiiiiiiiiiiiiiiiiii", $id, $fecha, $idc, $fechac, 
        $hs1c, $hs2c, $hs3c, $hs4c, $hs5c, 
        $he1c, $he2c, $he3c, $he4c, $he5c,
        $hs1, $hs2, $hs3, $hs4, $hs5, 
        $he1, $he2, $he3, $he4, $he5);
    $result->execute();
    $result->bind_result($id, $fecha, $idc, $fechac, 
        $hs1c, $hs2c, $hs3c, $hs4c, $hs5c, 
        $he1c, $he2c, $he3c, $he4c, $he5c,
        $hs1, $hs2, $hs3, $hs4, $hs5, 
        $he1, $he2, $he3, $he4, $he5);
    $result->store_result();
    $care = $result->num_rows;
    $result->close();

    //Compruebo datos en tabla comparativa con datos en tabla principal (matrículas acorde inspección).
    $result = $mysqli->prepare($COM2);
    $result->bind_param("sss", $ord, $plane, $kind);
    $result->execute();
    $result->bind_result($ord, $plane, $kind);
    $result->store_result();
    $care2 = $result->num_rows;
    $result->close();

    //Compruebo datos en tabla comparativa con datos en tabla principal (si alguien ha certificado esta orden).
    $result = $mysqli->prepare($COM3);
    $result->bind_param("ssss", $idc, $orden, $ordenc, $cert);
    $result->execute();
    $result->bind_result($orden, $ordenc);
    $result->store_result();
    $care3 = $result->num_rows;
    $result->close();

    //Si son correctos, inserto.
    if($id != '' && $care == 0 && $care2 != 0) {
    	//Si soy certificador y no está certificada la orden.
        if($care3 == 0 && $amicertif == 'yes') {
    		$cert = $_SESSION["idm"];

    		$result = $mysqli->prepare($INSERT);
    		$result->bind_param("sssssssiisiisiisiisiiss", $id, $orden, $fecha, $cert, $airplane, $insp, $datos,
            $hs1, $he1, $datos1, $hs2, $he2, $datos2, $hs3, $he3, $datos3, $hs4, $he4, $datos4, 
            $hs5, $he5, $datos5, $estado);
    		$result->execute();
       		$result->close();
    	}
    	else {
    		$cert = ' ';

    		$result = $mysqli->prepare($INSERT);
    		$result->bind_param("sssssssiisiisiisiisiiss", $id, $orden, $fecha, $cert, $airplane, $insp, $datos,
            $hs1, $he1, $datos1, $hs2, $he2, $datos2, $hs3, $he3, $datos3, $hs4, $he4, $datos4, 
            $hs5, $he5, $datos5, $estado);
    		$result->execute();
       		$result->close();
    	}
    	
        header('Location: /FTEform/successcert.html');
    } 
    else {//Si son incorrectos, salgo.
    	header('Location: /FTEform/failurecert.html');
    } 

    //Limpio mi tabla comparativa.
    $incp = $mysqli->prepare("DELETE FROM ftecp WHERE idc != ''");
	$incp->bind_param('s', $idc);
	$incp->execute(); 
	$incp->close();

    //Limpio mi tabla comparativa.
    $inmat = $mysqli->prepare("DELETE FROM mat WHERE ord != ''");
    $inmat->bind_param('s', $ord);
    $inmat->execute(); 
    $inmat->close();

    $mysqli->close();
}
?>
