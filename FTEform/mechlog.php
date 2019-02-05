<?php

//Datos para conectar.
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "fte";
    
//Crear conexión.
$mysqli = new mysqli($host, $dbUsername, $dbPassword, $dbname);

$mechid = $mysqli->real_escape_string(strtolower($_POST['mechid']));
$mechkey = $mysqli->real_escape_string($_POST['mechkey']);

if(!empty($mechid) || !empty($mechkey)) {
    if(mysqli_connect_error()) {
     	die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } 
    else {   
        session_start();
        session_regenerate_id(true);
        $_SESSION["idm"] = $mechid; 
        $SELECT = "SELECT mechid, mechkey FROM mechdata WHERE mechid = ? AND mechkey = ?";
        $SELECT2 = "SELECT iniciales FROM mechcert WHERE iniciales = '$mechid'";

        //Prepare statement
    	$stmt = $mysqli->prepare($SELECT);
        $stmt->bind_param("ss", $mechid, $mechkey);
        $stmt->execute();
        $stmt->bind_result($mechid, $mechkey);
        $stmt->store_result();
        $rnum = $stmt->num_rows;
        $stmt->close();

        $stmt2 = $mysqli->prepare($SELECT2);
        $stmt2->execute();
        $stmt2->bind_result($iniciales);
        $stmt2->store_result();
        $rnum2 = $stmt2->num_rows;
        $stmt2->close();

     	if($rnum == 0) {   
            header('Location: /FTEform/index.html');
     	} 			
        else {	
        	if($mechid == 'administrador') {
        		header('Location: /FTEform/menuempress.html');
        	}
        	else {
        		if($rnum2 == 0) {
        			header('Location: /FTEform/menumech.html');
        		}
        		else {
        			header('Location: /FTEform/menucert.html');
        		}	
        	}
        }  	

     	$mysqli->close();
    }
} 
else {
 	echo "Se necesita rellenar todos los campos";
 	die();
}
?>
