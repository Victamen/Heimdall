<?php
//Muestra todos los datos personales de esa orden y los trabajadores si certificas.

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

//Si hay error en la conexión.
if(mysqli_connect_error()) {
   	die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
} 
else {   
    $COM2 = "SELECT id, orden, cert FROM ftedata WHERE orden = '$orden' AND cert = '$id'";

    //Compruebo datos en tabla comparativa con datos en tabla principal.
    $result = $mysqli->prepare($COM2);
    $result->execute();
    $result->bind_result($id, $orden, $cert);
    $result->store_result();
    $care2 = $result->num_rows;
    $result->close();

    if($care2 == 0 AND $id != 'administrador') {
        $SELECT = "SELECT id, orden, fecha, cert, airplane, insp, datos,
        hs1, he1, datos1, hs2, he2, datos2, hs3, he3, datos3, hs4, he4, datos4, hs5, he5, datos5, estado 
        FROM ftedata WHERE id = ? AND orden = ?";

    	//Prepare statement
   		$stmt = $mysqli->prepare($SELECT);
    	$stmt->bind_param("ss", $id, $orden);
    	$stmt->execute();
        $stmt->bind_result($id, $orden, $fecha, $cert, $airplane, $insp, $datos, 
        $hs1, $he1, $datos1, $hs2, $he2, $datos2, $hs3, $he3, $datos3, $hs4, $he4, $datos4, $hs5, $he5, $datos5, 
        $estado);
    	$stmt->store_result();
    	$rnum = $stmt->num_rows;
    }
    else {
    	$SELECT = "SELECT id, orden, fecha, cert, airplane, insp, datos,
        hs1, he1, datos1, hs2, he2, datos2, hs3, he3, datos3, hs4, he4, datos4, hs5, he5, datos5, estado 
        FROM ftedata WHERE orden = ?";

    	//Prepare statement
   		$stmt = $mysqli->prepare($SELECT);
    	$stmt->bind_param("s", $orden);
    	$stmt->execute();
    	$stmt->bind_result($id, $orden, $fecha, $cert, $airplane, $insp, $datos, 
        $hs1, $he1, $datos1, $hs2, $he2, $datos2, $hs3, $he3, $datos3, $hs4, $he4, $datos4, $hs5, $he5, $datos5, 
        $estado);
    	$stmt->store_result();
    	$rnum = $stmt->num_rows;
    }  
?>

<!DOCTYPE HTML>
    <html>
        <body>
            <h1 align="center">Horas trabajadas</h1>
            <table border="1" align="center" style="line-height:25px;">
                <tr>
                    <th>ID</th>
                    <th>Orden</th>
                    <th>Fecha</th> 
                    <th>Certificador</th>
                    <th>Avioneta</th>
                    <th>Tipo inspección</th> 
                    <th>datos</th> 
                    <th>hs1</th>
                    <th>he1</th>
                    <th>datos1</th>
                    <th>hs2</th>
                    <th>he2</th>
                    <th>datos2</th>
                    <th>hs3</th>
                    <th>he3</th>
                    <th>datos3</th>
                    <th>hs4</th>
                    <th>he4</th>
                    <th>datos4</th>
                    <th>hs5</th>
                    <th>he5</th>
                    <th>datos5</th>    
                    <th>estado</th>                               
                </tr>

<?php
    if($rnum == 0) {
      	echo "No hay datos.";
    } 			
    else {	
		while($row = $stmt->fetch()) {
?>               
                <tr>
                    <td><?php printf("%s", $id);?></td>
                    <td><?php printf("%s", $orden);?></td>
                    <td><?php printf("%s", $fecha);?></td>
                    <td><?php printf("%s", $cert);?></td>
                    <td><?php printf("%s", $airplane);?></td>
                    <td><?php printf("%s", $insp);?></td>
                    <td><?php printf("%s", $datos);?></td>
                    <td><?php printf("%s", $hs1);?></td>
                    <td><?php printf("%s", $he1);?></td>
                    <td><?php printf("%s", $datos1);?></td>
                    <td><?php printf("%s", $hs2);?></td>
                    <td><?php printf("%s", $he2);?></td>
                    <td><?php printf("%s", $datos2);?></td>
                    <td><?php printf("%s", $hs3);?></td>
                    <td><?php printf("%s", $he3);?></td>
                    <td><?php printf("%s", $datos3);?></td>
                    <td><?php printf("%s", $hs4);?></td>
                    <td><?php printf("%s", $he4);?></td>
                    <td><?php printf("%s", $datos4);?></td>
                    <td><?php printf("%s", $hs5);?></td>
                    <td><?php printf("%s", $he5);?></td>
                    <td><?php printf("%s", $datos5);?></td>
                    <td><?php printf("%s", $estado);?></td>
                </tr>          
<?php
        }
        
    }	
    	
    $stmt->close();
    $mysqli->close();
}
?>
</table>
</body>
</html>
