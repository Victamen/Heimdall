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

$orden_comp = $_SESSION["orden"];
$fecha_comp = $_SESSION["fecha"];
$id_comp = $_SESSION["mechname"];

$orden = $mysqli->real_escape_string($_POST["orden"]);
$fecha = $mysqli->real_escape_string($_POST["fecha"]);
$id = $mysqli->real_escape_string($_POST["mechname"]);

$hs1 = $mysqli->real_escape_string($_POST['hs1h'].''.$_POST['hs1m'].'00');
$he1 = $mysqli->real_escape_string($_POST['he1h'].''.$_POST['he1m'].'00');
$hs2 = $mysqli->real_escape_string($_POST['hs2h'].''.$_POST['hs2m'].'00');
$he2 = $mysqli->real_escape_string($_POST['he2h'].''.$_POST['he2m'].'00');
$hs3 = $mysqli->real_escape_string($_POST['hs3h'].''.$_POST['hs3m'].'00');
$he3 = $mysqli->real_escape_string($_POST['he3h'].''.$_POST['he3m'].'00');
$hs4 = $mysqli->real_escape_string($_POST['hs4h'].''.$_POST['hs4m'].'00');
$he4 = $mysqli->real_escape_string($_POST['he4h'].''.$_POST['he4m'].'00');
$hs5 = $mysqli->real_escape_string($_POST['hs5h'].''.$_POST['hs5m'].'00');
$he5 = $mysqli->real_escape_string($_POST['he5h'].''.$_POST['he5m'].'00');

$datos = $mysqli->real_escape_string($_POST['datos']);

$datos1 = $mysqli->real_escape_string($_POST['datos1']);
$datos2 = $mysqli->real_escape_string($_POST['datos2']);
$datos3 = $mysqli->real_escape_string($_POST['datos3']);
$datos4 = $mysqli->real_escape_string($_POST['datos4']);
$datos5 = $mysqli->real_escape_string($_POST['datos5']);

$airplane = $mysqli->real_escape_string($_POST['airplane']);
$insp = $mysqli->real_escape_string($_POST['insp']);

//Si hay error en la conexión.
if(mysqli_connect_error()) {
	die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
} 
else {   
    $INSERT_ORDER = "INSERT INTO ftecp (ordenc) VALUES(?)";
    $INSERT_DATE = "INSERT INTO ftecp (fechac) VALUES(?)";
    $INSERT_ID = "INSERT INTO ftecp (idc) VALUES(?)";

    $INSERT_HS1 = "INSERT INTO ftecp (hs1c) VALUES(?)";
    $INSERT_HE1 = "INSERT INTO ftecp (he1c) VALUES(?)";
    $INSERT_HS2 = "INSERT INTO ftecp (hs2c) VALUES(?)";
    $INSERT_HE2 = "INSERT INTO ftecp (he2c) VALUES(?)";
    $INSERT_HS3 = "INSERT INTO ftecp (hs3c) VALUES(?)";
    $INSERT_HE3 = "INSERT INTO ftecp (he3c) VALUES(?)";
    $INSERT_HS4 = "INSERT INTO ftecp (hs4c) VALUES(?)";
    $INSERT_HE4 = "INSERT INTO ftecp (he4c) VALUES(?)";
    $INSERT_HS5 = "INSERT INTO ftecp (hs5c) VALUES(?)";
    $INSERT_HE5 = "INSERT INTO ftecp (he5c) VALUES(?)";

    $INSERT_PLANE = "INSERT INTO ftecp (airplanec) VALUES(?)";
    $INSERT_INSP = "INSERT INTO ftecp (inspc) VALUES(?)";
    $INSERT_DATOS = "INSERT INTO ftecp (datosc) VALUES(?)";

    $INSERT_DATOS1 = "INSERT INTO ftecp (datos1c) VALUES(?)";
    $INSERT_DATOS2 = "INSERT INTO ftecp (datos2c) VALUES(?)";
    $INSERT_DATOS3 = "INSERT INTO ftecp (datos3c) VALUES(?)";
    $INSERT_DATOS4 = "INSERT INTO ftecp (datos4c) VALUES(?)";
    $INSERT_DATOS5 = "INSERT INTO ftecp (datos5c) VALUES(?)";



    $UPDATE_ORDER = "UPDATE ftedata, ftecp SET 
    ftedata.orden = ftecp.ordenc WHERE ftedata.orden = '$orden_comp' AND ftedata.fecha = '$fecha_comp' 
    AND ftedata.id = '$id_comp' AND ftecp.ordenc != ''";

    $UPDATE_FECHA = "UPDATE ftedata, ftecp SET 
    ftedata.fecha = ftecp.fechac WHERE ftedata.orden = '$orden_comp' AND ftedata.fecha = '$fecha_comp' 
    AND ftedata.id = '$id_comp' AND ftecp.fechac != ''";

    $UPDATE_ID = "UPDATE ftedata, ftecp SET 
    ftedata.id = ftecp.idc WHERE ftedata.orden = '$orden_comp' AND ftedata.fecha = '$fecha_comp' 
    AND ftedata.id = '$id_comp' AND ftecp.idc != ''";

    

    $UPDATE_HS1 = "UPDATE ftedata, ftecp SET 
    ftedata.hs1 = ftecp.hs1c WHERE ftedata.orden = '$orden_comp' AND ftedata.fecha = '$fecha_comp' 
    AND ftedata.id = '$id_comp' AND ftecp.hs1c != ''";

    $UPDATE_HE1 = "UPDATE ftedata, ftecp SET 
    ftedata.he1 = ftecp.he1c WHERE ftedata.orden = '$orden_comp' AND ftedata.fecha = '$fecha_comp' 
    AND ftedata.id = '$id_comp' AND ftecp.he1c != ''";

    $UPDATE_HS2 = "UPDATE ftedata, ftecp SET 
    ftedata.hs2 = ftecp.hs2c WHERE ftedata.orden = '$orden_comp' AND ftedata.fecha = '$fecha_comp' 
    AND ftedata.id = '$id_comp' AND ftecp.hs2c != ''";

    $UPDATE_HE2 = "UPDATE ftedata, ftecp SET 
    ftedata.he2 = ftecp.he2c WHERE ftedata.orden = '$orden_comp' AND ftedata.fecha = '$fecha_comp' 
    AND ftedata.id = '$id_comp' AND ftecp.he2c != ''";

    $UPDATE_HS3 = "UPDATE ftedata, ftecp SET 
    ftedata.hs3 = ftecp.hs3c WHERE ftedata.orden = '$orden_comp' AND ftedata.fecha = '$fecha_comp' 
    AND ftedata.id = '$id_comp' AND ftecp.hs3c != ''";

    $UPDATE_HE3 = "UPDATE ftedata, ftecp SET 
    ftedata.he3 = ftecp.he3c WHERE ftedata.orden = '$orden_comp' AND ftedata.fecha = '$fecha_comp' 
    AND ftedata.id = '$id_comp' AND ftecp.he3c != ''";

    $UPDATE_HS4 = "UPDATE ftedata, ftecp SET 
    ftedata.hs4 = ftecp.hs4c WHERE ftedata.orden = '$orden_comp' AND ftedata.fecha = '$fecha_comp' 
    AND ftedata.id = '$id_comp' AND ftecp.hs4c != ''";

    $UPDATE_HE4 = "UPDATE ftedata, ftecp SET 
    ftedata.he4 = ftecp.he4c WHERE ftedata.orden = '$orden_comp' AND ftedata.fecha = '$fecha_comp' 
    AND ftedata.id = '$id_comp' AND ftecp.he4c != ''";

    $UPDATE_HS5 = "UPDATE ftedata, ftecp SET 
    ftedata.hs5 = ftecp.hs5c WHERE ftedata.orden = '$orden_comp' AND ftedata.fecha = '$fecha_comp' 
    AND ftedata.id = '$id_comp' AND ftecp.hs5c != ''";

    $UPDATE_HE5 = "UPDATE ftedata, ftecp SET 
    ftedata.he5 = ftecp.he5c WHERE ftedata.orden = '$orden_comp' AND ftedata.fecha = '$fecha_comp' 
    AND ftedata.id = '$id_comp' AND ftecp.he5c != ''";



    $UPDATE_PLANE = "UPDATE ftedata, ftecp SET 
    ftedata.airplane = ftecp.airplanec WHERE ftedata.orden = '$orden_comp' AND ftedata.fecha = '$fecha_comp' 
    AND ftedata.id = '$id_comp' AND ftecp.airplanec != ''";

    $UPDATE_INSP = "UPDATE ftedata, ftecp SET 
    ftedata.insp = ftecp.inspc WHERE ftedata.orden = '$orden_comp' AND ftedata.fecha = '$fecha_comp' 
    AND ftedata.id = '$id_comp' AND ftecp.inspc != ''";

    $UPDATE_DATOS = "UPDATE ftedata, ftecp SET 
    ftedata.datos = ftecp.datosc WHERE ftedata.orden = '$orden_comp' AND ftedata.fecha = '$fecha_comp' 
    AND ftedata.id = '$id_comp' AND ftecp.datosc != ''";



    $UPDATE_DATOS1 = "UPDATE ftedata, ftecp SET 
    ftedata.datos1 = ftecp.datos1c WHERE ftedata.orden = '$orden_comp' AND ftedata.fecha = '$fecha_comp' 
    AND ftedata.id = '$id_comp' AND ftecp.datos1c != ''";

    $UPDATE_DATOS2 = "UPDATE ftedata, ftecp SET 
    ftedata.datos2 = ftecp.datos2c WHERE ftedata.orden = '$orden_comp' AND ftedata.fecha = '$fecha_comp' 
    AND ftedata.id = '$id_comp' AND ftecp.datos2c != ''";

    $UPDATE_DATOS3 = "UPDATE ftedata, ftecp SET 
    ftedata.datos3 = ftecp.datos3c WHERE ftedata.orden = '$orden_comp' AND ftedata.fecha = '$fecha_comp' 
    AND ftedata.id = '$id_comp' AND ftecp.datos3c != ''";

    $UPDATE_DATOS4 = "UPDATE ftedata, ftecp SET 
    ftedata.datos4 = ftecp.datos4c WHERE ftedata.orden = '$orden_comp' AND ftedata.fecha = '$fecha_comp' 
    AND ftedata.id = '$id_comp' AND ftecp.datos4c != ''";

    $UPDATE_DATOS5 = "UPDATE ftedata, ftecp SET 
    ftedata.datos5 = ftecp.datos5c WHERE ftedata.orden = '$orden_comp' AND ftedata.fecha = '$fecha_comp' 
    AND ftedata.id = '$id_comp' AND ftecp.datos5c != ''";



    $DELETE_RECORD = "DELETE FROM ftedata WHERE 
    ftedata.orden = '$orden_comp' AND ftedata.fecha = '$fecha_comp' AND ftedata.id = '$id_comp'";


    			
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
