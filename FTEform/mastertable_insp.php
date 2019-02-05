<?php
//Muestra total horas inspección en rango de fecha con filtros personalizados.

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
$mat = "%{$_POST['mat']}%";
$showmat = $mysqli->real_escape_string($_POST['mat']);
$airplane = "%{$_POST['airplane']}%";
$fechas = $mysqli->real_escape_string($_POST['fechas']);
$fechae = $mysqli->real_escape_string($_POST['fechae']);
$insp = "%{$_POST['insp']}%";
$id = "%{$_POST['id']}%";
$cert = "%{$_POST['cert']}%";
$estado = "%{$_POST['estado']}%";

//Si hay error en la conexión.
if(mysqli_connect_error()) {
   	die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
} 
else {  
	//Multiply hours *2.4 to get from 100 minutes format to 60 minutes format
	$SELECT = "SELECT orden, airplane, insp, cert, MIN(fecha), estado, cierre, count(distinct orden) 
	AS num_insp 
	FROM ftedata 
    WHERE orden LIKE '$mat' 
    AND airplane LIKE '$airplane' 
    AND fecha BETWEEN '$fechas' AND '$fechae'
    AND insp LIKE '$insp' 
    AND id LIKE '$id'
    AND cert LIKE '$cert'
    AND estado LIKE '$estado'
    GROUP BY insp ORDER BY orden ASC";

    //Prepare statement
   	$stmt = $mysqli->prepare($SELECT);
    $stmt->execute();
    $stmt->bind_result($orden, $airplane, $insp, $cert, $fecha, $estado, $cierre, $num_insp);
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
                    <th>Avión</th> 
                    <th>Inspección</th> 
                    <th>Certificador</th> 
                    <th>Fecha inicio</th> 
                    <th>Estado</th> 
                    <th>Fecha cierre</th>  
                    <th>Numero inspecciones</th>                
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
                    <td><?php printf("%s", $airplane);?></td>
                    <td><?php printf("%s", $insp);?></td>
                    <td><?php printf("%s", $cert);?></td>
                    <td><?php printf("%s", $fecha);?></td>
                    <td><?php printf("%s", $estado);?></td>
                    <td><?php printf("%s", $cierre);?></td>
                    <td><?php printf("%s", $num_insp);?></td>
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
