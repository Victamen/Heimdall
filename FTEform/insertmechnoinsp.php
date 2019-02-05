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
$_SESSION["ordm"];

$id = $_SESSION["idm"];
$orden = $_SESSION["ordm"];
$fecha = $mysqli->real_escape_string($_POST['fecha']);

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

$datos1 = $mysqli->real_escape_string($_POST['datos1']);
$datos2 = $mysqli->real_escape_string($_POST['datos2']);
$datos3 = $mysqli->real_escape_string($_POST['datos3']);
$datos4 = $mysqli->real_escape_string($_POST['datos4']);
$datos5 = $mysqli->real_escape_string($_POST['datos5']);

 
//Si hay error en la conexión.
if(mysqli_connect_error()) {
	die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
} 
else {   
  	$INSERT = "INSERT INTO ftedata (id, orden, fecha, hs1, he1, datos1, hs2, he2, datos2, 
  		hs3, he3, datos3, hs4, he4, datos4, hs5, he5, datos5) 
    	VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $INSERTCP = "INSERT INTO ftecp (idc, ordenc, fechac, hs1c, he1c, datos1c, hs2c, he2c, datos2c, 
    	hs3c, he3c, datos3c, hs4c, he4c, datos4c, hs5c, he5c, datos5c) 
    	VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $UPDATECERT = "UPDATE ftecp, ftedata SET 
    ftecp.certc = ftedata.cert,
    ftecp.airplanec = ftedata.airplane,
    ftecp.inspc = ftedata.insp,
    ftecp.datosc = ftedata.datos,
    ftecp.estadoc = ftedata.estado
    WHERE ftecp.ordenc = ftedata.orden";

    $UPDATECERT2 = "UPDATE ftedata, ftecp SET 
    ftedata.cert = ftecp.certc,
    ftedata.airplane = ftecp.airplanec,
    ftedata.insp = ftecp.inspc,
    ftedata.datos = ftecp.datosc,
    ftedata.estado = ftecp.estadoc
    WHERE ftedata.orden = ftecp.ordenc";

    $COM = "SELECT id, fecha, idc, fechac, hs1c, hs2c, hs3c, hs4c, hs5c, he1c, he2c, he3c, he4c, he5c, 
    hs1, hs2, hs3, hs4, hs5, he1, he2, he3, he4, he5 FROM ftedata, ftecp 
    WHERE id = idc AND fecha = fechac AND 
    	((((hs1c >= hs1) AND (hs1c < he1)) || ((hs1c >= hs2) AND (hs1c < he2)) || 
    	((hs1c >= hs3) AND (hs1c < he3)) || ((hs1c >= hs4) AND (hs1c < he4)) || 
    	((hs1c >= hs5) AND (hs1c < he5))) || /*hs1c*/
    	(((he1c > hs1) AND (he1c <= he1)) || ((he1c > hs2) AND (he1c <= he2)) || 
    	((he1c > hs3) AND (he1c <= he3)) || ((he1c > hs4) AND (he1c <= he4)) || 
    	((he1c > hs5) AND (he1c <= he5))) || /*he1c*/
    	(((hs1c >= he1) AND (hs1c <= hs2) AND (he1c > hs2)) || 
    	((hs1c >= he2) AND (hs1c <= hs3) AND (he1c > hs3)) || 
    	((hs1c >= he3) AND (hs1c <= hs4) AND (he1c > hs4)) ||
    	((hs1c >= he4) AND (hs1c <= hs5) AND (he1c > hs5))) ||/*R1*/
    	(((hs2c >= hs1) AND (hs2c < he1)) || ((hs2c >= hs2) AND (hs2c < he2)) || 
    	((hs2c >= hs3) AND (hs2c < he3)) || ((hs2c >= hs4) AND (hs2c < he4)) || 
    	((hs2c >= hs5) AND (hs2c < he5))) || /*hs2c*/
    	(((he2c > hs1) AND (he2c <= he1)) || ((he2c > hs2) AND (he2c <= he2)) || 
    	((he2c > hs3) AND (he2c <= he3)) || ((he2c > hs4) AND (he2c <= he4)) || 
    	((he2c > hs5) AND (he2c <= he5))) || /*he2c*/
    	(((hs2c >= he1) AND (hs2c <= hs2) AND (he2c > hs2)) || 
    	((hs2c >= he2) AND (hs2c <= hs3) AND (he2c > hs3)) || 
    	((hs2c >= he3) AND (hs2c <= hs4) AND (he2c > hs4)) ||
    	((hs2c >= he4) AND (hs2c <= hs5) AND (he2c > hs5))) ||/*R2*/
    	(((hs3c >= hs1) AND (hs3c < he1)) || ((hs3c >= hs2) AND (hs3c < he2)) || 
    	((hs3c >= hs3) AND (hs3c < he3)) || ((hs3c >= hs4) AND (hs3c < he4)) || 
    	((hs3c >= hs5) AND (hs3c < he5))) || /*hs3c*/
    	(((he3c > hs1) AND (he3c <= he1)) || ((he3c > hs2) AND (he3c <= he2)) || 
    	((he3c > hs3) AND (he3c <= he3)) || ((he3c > hs4) AND (he3c <= he4)) || 
    	((he3c > hs5) AND (he3c <= he5))) || /*he3c*/
    	(((hs3c >= he1) AND (hs3c <= hs2) AND (he3c > hs2)) || 
    	((hs3c >= he2) AND (hs3c <= hs3) AND (he3c > hs3)) || 
    	((hs3c >= he3) AND (hs3c <= hs4) AND (he3c > hs4)) ||
    	((hs3c >= he4) AND (hs3c <= hs5) AND (he3c > hs5))) ||/*R3*/
    	(((hs4c >= hs1) AND (hs4c < he1)) || ((hs4c >= hs2) AND (hs4c < he2)) || 
    	((hs4c >= hs3) AND (hs4c < he3)) || ((hs4c >= hs4) AND (hs4c < he4)) || 
    	((hs4c >= hs5) AND (hs4c < he5))) || /*hs4c*/
    	(((he4c > hs1) AND (he4c <= he1)) || ((he4c > hs2) AND (he4c <= he2)) || 
    	((he4c > hs3) AND (he4c <= he3)) || ((he4c > hs4) AND (he4c <= he4)) || 
    	((he4c > hs5) AND (he4c <= he5))) || /*he4c*/
    	(((hs4c >= he1) AND (hs4c <= hs2) AND (he4c > hs2)) || 
    	((hs4c >= he2) AND (hs4c <= hs3) AND (he4c > hs3)) || 
    	((hs4c >= he3) AND (hs4c <= hs4) AND (he4c > hs4)) ||
    	((hs4c >= he4) AND (hs4c <= hs5) AND (he4c > hs5))) ||/*R4*/
    	(((hs5c >= hs1) AND (hs5c < he1)) || ((hs5c >= hs2) AND (hs5c < he2)) || 
    	((hs5c >= hs3) AND (hs5c < he3)) || ((hs5c >= hs4) AND (hs5c < he4)) || 
    	((hs5c >= hs5) AND (hs5c < he5))) || /*hs5c*/
    	(((he5c > hs1) AND (he5c <= he1)) || ((he5c > hs2) AND (he5c <= he2)) || 
    	((he5c > hs3) AND (he5c <= he3)) || ((he5c > hs4) AND (he5c <= he4)) || 
    	((he5c > hs5) AND (he5c <= he5))) ||/*he5c*/
    	(((hs5c >= he1) AND (hs5c <= hs2) AND (he5c > hs2)) || 
    	((hs5c >= he2) AND (hs5c <= hs3) AND (he5c > hs3)) || 
    	((hs5c >= he3) AND (hs5c <= hs4) AND (he5c > hs4)) ||
    	((hs5c >= he4) AND (hs5c <= hs5) AND (he5c > hs5)))/*R5*/)"; 

    $COM4 = "SELECT orden FROM ftedata, ftecp WHERE orden = ordenc AND estado = 'abierta'"; 

        			
   	//Inserto en tabla comparativa.
    $incp = $mysqli->prepare($INSERTCP);
    $incp->bind_param("sssiisiisiisiisiis", $id, $orden, $fecha, $hs1, $he1, $datos1, $hs2, $he2, $datos2,  
        $hs3, $he3, $datos3, $hs4, $he4, $datos4, $hs5, $he5, $datos5);
    $incp->execute();
    $incp->close();

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

    //Compruebo datos en tabla comparativa con datos en tabla principal (si la orden está abierta).
    $result = $mysqli->prepare($COM4);
    $result->bind_param("sss", $orden, $ordenc, $estado);
    $result->execute();
    $result->bind_result($orden);
    $result->store_result();
    $care4 = $result->num_rows;
    $result->close();

    //Si son correctos, inserto.
    if($id != '' && $care == 0 && $care4 != 0) {
    	$result = $mysqli->prepare($INSERT);
    	$result->bind_param("sssiisiisiisiisiis", $id, $orden, $fecha, $hs1, $he1, $datos1, 
    		$hs2, $he2, $datos2, $hs3, $he3, $datos3, $hs4, $he4, $datos4, $hs5, $he5, $datos5);
    	$result->execute();
       	$result->close();

       	$result = $mysqli->prepare($UPDATECERT);
        $result->execute();
        $result->close();

        $result = $mysqli->prepare($UPDATECERT2);
        $result->execute();
        $result->close();

        header('Location: /FTEform/successmech.html');
    } 
    else {//Si son incorrectos, salgo.
    	header('Location: /FTEform/failuremech.html');
    } 

    //Limpio mi tabla comparativa.
    $incp = $mysqli->prepare("DELETE FROM ftecp WHERE idc != ''");
	$incp->bind_param('s', $idc);
	$incp->execute(); 
	$incp->close();

    $mysqli->close();
}
?>
