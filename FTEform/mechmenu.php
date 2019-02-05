<?php

session_start();
$_SESSION["idm"];
$mechid = $_SESSION["idm"];

if(!empty($mechid)) {
 	$host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "fte";
    
    //create connection
    $mysqli = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if(mysqli_connect_error()) {
     	die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } 
    else {   
        $SELECT = "SELECT mechid FROM mechdata WHERE mechid = ?";
        $SELECT2 = "SELECT iniciales FROM mechcert WHERE iniciales = '$mechid'";

        //Prepare statement
    	$stmt = $mysqli->prepare($SELECT);
        $stmt->bind_param("s", $mechid);
        $stmt->execute();
        $stmt->bind_result($mechid);
        $stmt->store_result();
        $rnum = $stmt->num_rows;
        $stmt->close();

        $stmt2 = $mysqli->prepare($SELECT2);
        $stmt2->bind_param("s", $iniciales);
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
