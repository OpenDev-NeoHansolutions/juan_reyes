<?php
if(!isset($_SESSION)) 
{ 
	session_start(); 
}
if (isset($_SESSION["s_username"])){
	ini_set('max_execution_time', 300);
	set_time_limit(300);

	#Conexion a Servidor MySQL
	include '_servidores.php';
	$con = new mysqli(MYSQL1, USER, PASS, DB);
	$con->set_charset("utf8");
	if ($con->connect_error) {
		die("Connection failed: " . $con->connect_error);
	}
	$query = 'SELECT folio AS FOLIO,
			cliente AS CLIENTE,
			conductor AS CONDUCTOR,
			fecha AS FECHA,
			CONCAT("$",FORMAT(precio,2))AS precio,
			unidades AS UNIDADES,
			CONCAT("$",FORMAT((precio*unidades),2))AS BRUTO,
			CONCAT("$",FORMAT((precio*unidades)*IFNULL(comision/100,0),2))AS COMISIONTOTAL,
			CONCAT(IFNULL(comision,0)," %") AS COMISION,
			CONCAT("$",FORMAT((precio*unidades)-IFNULL((precio*unidades)*(comision/100),0),2))AS NETO,
			pago AS PAGO,
			CASE WHEN pago=0 
				THEN 
					CONCAT("$",FORMAT(IFNULL((SELECT sum(abono) FROM abonos WHERE folio=servicios.folio),0),2))
				ELSE 
					CONCAT("$",FORMAT((precio*unidades),2))
				END AS ABONO,
			CASE WHEN pago=0 
				THEN 
					CONCAT("$",FORMAT((precio*unidades)-IFNULL((SELECT sum(abono) FROM abonos WHERE folio=servicios.folio),0),2))
				ELSE 
					CONCAT("$",FORMAT(0,2))
				END AS DEUDA,
			id AS ID
			FROM servicios ORDER BY folio';
	$result = $con->query($query);
	#header('Content-Type: application/json; charset=utf-8');
	$data=array();
	$num=0;
	while($row = mysqli_fetch_assoc($result)){
		$data[]=$row;
		if($row["PAGO"]==1){
			$data[$num]["PAGO"]='Pagado';
		}else{
			$data[$num]["PAGO"]='Pendiente';
		}
		$num++;
	}
	$con->close();

#EXCEL
function filterData(&$str){
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}
// Name for Excel file
$file = "Servicios-" . date('dmY') . ".xlsx";
// Headers to force download Excel file
header("Content-Disposition: attachment; filename=\"$file\"");
header("Content-Type: application/vnd.ms-excel");

$flag = false;
foreach($data as $row) {
    if(!$flag) {
        // Set column names as first row
        echo implode("\t", array_keys($row)) . "\n";
        $flag = true;
    }
    // Filter data
    array_walk($row, 'filterData');
    echo implode("\t", array_values($row)) . "\n";
	}exit;


}else{header("Location: login.php"); }
?>	