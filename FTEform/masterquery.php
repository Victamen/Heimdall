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
	$SELECT = "SELECT orden, SUM((TIME_TO_SEC(TIMEDIFF(he1, hs1))) + (TIME_TO_SEC(TIMEDIFF(he2, hs2))) + 
	(TIME_TO_SEC(TIMEDIFF(he3, hs3))) + (TIME_TO_SEC(TIMEDIFF(he4, hs4))) + 
	(TIME_TO_SEC(TIMEDIFF(he5, hs5))))/3600 AS total FROM ftedata 
    WHERE orden LIKE '$mat' 
    AND airplane LIKE '$airplane' 
    AND fecha BETWEEN '$fechas' AND '$fechae'
    AND insp LIKE '$insp' 
    AND id LIKE '$id'
    AND cert LIKE '$cert'
    AND estado LIKE '$estado'";

    //Prepare statement
   	$stmt = $mysqli->prepare($SELECT);
    $stmt->execute();
    $stmt->bind_result($orden, $total);
    $stmt->store_result();
    $rnum = $stmt->num_rows;
?>

<!DOCTYPE HTML>
    <html>
        <body>
            <h1 align="center">Horas trabajadas</h1>
            <table border="1" align="center" style="line-height:25px;">
                <tr>
                    <th>Matrícula avión</th>   
                    <th>Total</th>                    
                </tr>

<?php
    if($rnum == 0) {
      	echo "No hay datos.";
    } 			
    else {	
		while($row = $stmt->fetch()) {
?>               
                <tr>
                    <td><?php printf("%s", $showmat);?></td>
                    <td><?php printf("%s", $total);?></td>
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
