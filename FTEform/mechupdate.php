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
    //Inserción en tabla temporal.   
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


    //Inserción en BD si se ha editado el formulario.
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
    AND ftedata.id = '$id_comp' AND ftecp.hs1c != '00:00:00'";

    $UPDATE_HE1 = "UPDATE ftedata, ftecp SET 
    ftedata.he1 = ftecp.he1c WHERE ftedata.orden = '$orden_comp' AND ftedata.fecha = '$fecha_comp' 
    AND ftedata.id = '$id_comp' AND ftecp.he1c != '00:00:00'";

    $UPDATE_HS2 = "UPDATE ftedata, ftecp SET 
    ftedata.hs2 = ftecp.hs2c WHERE ftedata.orden = '$orden_comp' AND ftedata.fecha = '$fecha_comp' 
    AND ftedata.id = '$id_comp' AND ftecp.hs2c != '00:00:00'";

    $UPDATE_HE2 = "UPDATE ftedata, ftecp SET 
    ftedata.he2 = ftecp.he2c WHERE ftedata.orden = '$orden_comp' AND ftedata.fecha = '$fecha_comp' 
    AND ftedata.id = '$id_comp' AND ftecp.he2c != '00:00:00'";

    $UPDATE_HS3 = "UPDATE ftedata, ftecp SET 
    ftedata.hs3 = ftecp.hs3c WHERE ftedata.orden = '$orden_comp' AND ftedata.fecha = '$fecha_comp' 
    AND ftedata.id = '$id_comp' AND ftecp.hs3c != '00:00:00'";

    $UPDATE_HE3 = "UPDATE ftedata, ftecp SET 
    ftedata.he3 = ftecp.he3c WHERE ftedata.orden = '$orden_comp' AND ftedata.fecha = '$fecha_comp' 
    AND ftedata.id = '$id_comp' AND ftecp.he3c != '00:00:00'";

    $UPDATE_HS4 = "UPDATE ftedata, ftecp SET 
    ftedata.hs4 = ftecp.hs4c WHERE ftedata.orden = '$orden_comp' AND ftedata.fecha = '$fecha_comp' 
    AND ftedata.id = '$id_comp' AND ftecp.hs4c != '00:00:00'";

    $UPDATE_HE4 = "UPDATE ftedata, ftecp SET 
    ftedata.he4 = ftecp.he4c WHERE ftedata.orden = '$orden_comp' AND ftedata.fecha = '$fecha_comp' 
    AND ftedata.id = '$id_comp' AND ftecp.he4c != '00:00:00'";

    $UPDATE_HS5 = "UPDATE ftedata, ftecp SET 
    ftedata.hs5 = ftecp.hs5c WHERE ftedata.orden = '$orden_comp' AND ftedata.fecha = '$fecha_comp' 
    AND ftedata.id = '$id_comp' AND ftecp.hs5c != '00:00:00'";

    $UPDATE_HE5 = "UPDATE ftedata, ftecp SET 
    ftedata.he5 = ftecp.he5c WHERE ftedata.orden = '$orden_comp' AND ftedata.fecha = '$fecha_comp' 
    AND ftedata.id = '$id_comp' AND ftecp.he5c != '00:00:00'";


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


    //$DELETE_RECORD = "DELETE FROM ftedata WHERE 
    //ftedata.orden = '$orden_comp' AND ftedata.fecha = '$fecha_comp' AND ftedata.id = '$id_comp'";

    //Ejecución de sentencias preparadas INSERT.
    $action = $mysqli->prepare($INSERT_ORDER);
    $action->bind_param("s", $orden);
    $action->execute();
    $action->close();

    $action = $mysqli->prepare($INSERT_DATE);
    $action->bind_param("s", $fecha);
    $action->execute();
    $action->close();

    $action = $mysqli->prepare($INSERT_ID);
    $action->bind_param("s", $id);
    $action->execute();
    $action->close();


    $action = $mysqli->prepare($INSERT_HS1);
    $action->bind_param("s", $hs1);
    $action->execute();
    $action->close();

    $action = $mysqli->prepare($INSERT_HE1);
    $action->bind_param("s", $he1);
    $action->execute();
    $action->close();

    $action = $mysqli->prepare($INSERT_HS2);
    $action->bind_param("s", $hs2);
    $action->execute();
    $action->close();

    $action = $mysqli->prepare($INSERT_HE2);
    $action->bind_param("s", $he2);
    $action->execute();
    $action->close();

    $action = $mysqli->prepare($INSERT_HS3);
    $action->bind_param("s", $hs3);
    $action->execute();
    $action->close();

    $action = $mysqli->prepare($INSERT_HE3);
    $action->bind_param("s", $he3);
    $action->execute();
    $action->close();

    $action = $mysqli->prepare($INSERT_HS4);
    $action->bind_param("s", $hs4);
    $action->execute();
    $action->close();

    $action = $mysqli->prepare($INSERT_HE4);
    $action->bind_param("s", $he4);
    $action->execute();
    $action->close();

    $action = $mysqli->prepare($INSERT_HS5);
    $action->bind_param("s", $hs5);
    $action->execute();
    $action->close();

    $action = $mysqli->prepare($INSERT_HE5);
    $action->bind_param("s", $he5);
    $action->execute();
    $action->close();


    $action = $mysqli->prepare($INSERT_PLANE);
    $action->bind_param("s", $airplane);
    $action->execute();
    $action->close();

    $action = $mysqli->prepare($INSERT_INSP);
    $action->bind_param("s", $insp);
    $action->execute();
    $action->close();

    $action = $mysqli->prepare($INSERT_DATOS);
    $action->bind_param("s", $datos);
    $action->execute();
    $action->close();


    $action = $mysqli->prepare($INSERT_DATOS1);
    $action->bind_param("s", $datos1);
    $action->execute();
    $action->close();

    $action = $mysqli->prepare($INSERT_DATOS2);
    $action->bind_param("s", $datos2);
    $action->execute();
    $action->close();

    $action = $mysqli->prepare($INSERT_DATOS3);
    $action->bind_param("s", $datos3);
    $action->execute();
    $action->close();

    $action = $mysqli->prepare($INSERT_DATOS4);
    $action->bind_param("s", $datos4);
    $action->execute();
    $action->close();

    $action = $mysqli->prepare($INSERT_DATOS5);
    $action->bind_param("s", $datos5);
    $action->execute();
    $action->close();



    //Ejecución de sentencias preparadas UPDATE.
    $action = $mysqli->prepare($UPDATE_ORDER);
    $action->execute();
    $action->close();
    
    $action = $mysqli->prepare($UPDATE_FECHA);
    $action->execute();
    $action->close();

    $action = $mysqli->prepare($UPDATE_ID);
    $action->execute();
    $action->close();


    $action = $mysqli->prepare($UPDATE_HS1);
    $action->execute();
    $action->close();

    $action = $mysqli->prepare($UPDATE_HE1);
    $action->execute();
    $action->close();

    $action = $mysqli->prepare($UPDATE_HS2);
    $action->execute();
    $action->close();

    $action = $mysqli->prepare($UPDATE_HE2);
    $action->execute();
    $action->close();

    $action = $mysqli->prepare($UPDATE_HS3);
    $action->execute();
    $action->close();

    $action = $mysqli->prepare($UPDATE_HE3);
    $action->execute();
    $action->close();

    $action = $mysqli->prepare($UPDATE_HS4);
    $action->execute();
    $action->close();

    $action = $mysqli->prepare($UPDATE_HE4);
    $action->execute();
    $action->close();

    $action = $mysqli->prepare($UPDATE_HS5);
    $action->execute();
    $action->close();

    $action = $mysqli->prepare($UPDATE_HE5);
    $action->execute();
    $action->close();


    $action = $mysqli->prepare($UPDATE_PLANE);
    $action->execute();
    $action->close();

    $action = $mysqli->prepare($UPDATE_INSP);
    $action->execute();
    $action->close();

    $action = $mysqli->prepare($UPDATE_DATOS);
    $action->execute();
    $action->close();


    $action = $mysqli->prepare($UPDATE_DATOS1);
    $action->execute();
    $action->close();

    $action = $mysqli->prepare($UPDATE_DATOS2);
    $action->execute();
    $action->close();

    $action = $mysqli->prepare($UPDATE_DATOS3);
    $action->execute();
    $action->close();

    $action = $mysqli->prepare($UPDATE_DATOS4);
    $action->execute();
    $action->close();

    $action = $mysqli->prepare($UPDATE_DATOS5);
    $action->execute();
    $action->close();


    //$action = $mysqli->prepare($DELETE_RECORD);
    //$action->execute();
    //$action->close();

    header('Location: /FTEform/mechupdate_cheers.html');

    //Limpio mi tabla comparativa.
    $incp = $mysqli->prepare("DELETE FROM ftecp WHERE idc != ''");
	$incp->execute(); 
	$incp->close();


    $mysqli->close();
}
?>
