<?php
//Muestra último avión operado en el Hangar con esa matrícula.

//Datos para conectar.
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "fte";
    
//create connection
$mysqli = new mysqli($host, $dbUsername, $dbPassword, $dbname);

$mat = "%{$_POST['mat']}%";

//Si hay error en la conexión.
if(mysqli_connect_error()) {
   	die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
} 
else {   
    $SELECT = "SELECT orden, fecha, cert, airplane, insp, datos, estado 
    FROM ftedata WHERE orden LIKE ? ORDER BY fecha DESC LIMIT 1";

    //Prepare statement
   	$stmt = $mysqli->prepare($SELECT);
    $stmt->bind_param("s", $mat);
    $stmt->execute();
    $stmt->bind_result($orden, $fecha, $cert, $airplane, $insp, $datos, $estado);
    $stmt->store_result();
    $rnum = $stmt->num_rows;
?>

<!DOCTYPE HTML>
    <html>
        <body>
            <h1 align="center">Horas trabajadas</h1>
            <table border="1" align="center" style="line-height:25px;">
                <tr>
                    <th>Orden</th>
                    <th>Fecha</th> 
                    <th>Certificador</th>
                    <th>Avioneta</th>
                    <th>Tipo inspección</th>    
                    <th>datos</th>            
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
                    <td><?php printf("%s", $orden);?></td>
                    <td><?php printf("%s", $fecha);?></td>
                    <td><?php printf("%s", $cert);?></td>
                    <td><?php printf("%s", $airplane);?></td>
                    <td><?php printf("%s", $insp);?></td>
                    <td><?php printf("%s", $datos);?></td>
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
