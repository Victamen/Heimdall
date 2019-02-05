<?php
//Muestra datos mínimos para vista rápida sobre todas las órdenes más recientes de ese avión.

//Datos para conectar.
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "fte";

//Crear conexión.
$mysqli = new mysqli($host, $dbUsername, $dbPassword, $dbname);

$mat = "%{$_POST['mat']}%";

//Si hay error en la conexión.
if(mysqli_connect_error()) {
   	die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
} 
else {   
    $SELECT = "SELECT orden, insp, datos, cert, MAX(fecha), estado, cierre
    FROM ftedata WHERE orden LIKE ? GROUP BY orden ORDER BY orden ASC";

    //Prepare statement
   	$stmt = $mysqli->prepare($SELECT);
    $stmt->bind_param("s", $mat);
    $stmt->execute();
    $stmt->bind_result($orden, $insp, $datos, $cert, $fecha, $estado, $cierre);
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
                    <th>Tipo inspección</th> 
                    <th>Datos</th>
                    <th>Certificador</th>
                    <th>Fecha</th>          
                    <th>Estado</th>  
                    <th>Cierre</th>                        
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
                    <td><?php printf("%s", $insp);?></td>
                    <td><?php printf("%s", $datos);?></td>
                    <td><?php printf("%s", $cert);?></td>
                    <td><?php printf("%s", $fecha);?></td>
                    <td><?php printf("%s", $estado);?></td>
                    <td><?php printf("%s", $cierre);?></td>
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
