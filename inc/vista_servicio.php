<?php
if(!isset($_SESSION))
{
	session_start();
}
if (isset($_SESSION["s_username"])){
	ini_set('max_execution_time', 300);
	set_time_limit(300);

if (empty($_POST['folio'])){
		$errors[] = "Ingresa el Folio.";
}elseif(!empty($_POST['folio'])){
	require_once ("_servidores.php");
	$con = new mysqli(MYSQL1, USER, PASS, DB);
	$con->set_charset("utf8");
	if ($con->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}else{
		$folio=mysqli_real_escape_string($con,(strip_tags(strtoupper($_POST["folio"]),ENT_QUOTES)));
		$query = 'SELECT folio, cliente, unidad, conductor, fecha, unidades,
				CONCAT("$",FORMAT(precio,2)) as precio,
				CONCAT("$",FORMAT(precio*unidades,2))AS bruto,
				comision, pago, notas, fecha_creacion
				from servicios where folio="'.$folio.'"';
		$result = $con->query($query);
		if($result){
			echo '<div class="row mb-30 align-items-center">
                <div class="col-lg-12">
				<h3>Servicio Folio: '.$folio.'</h3><br>
				<div class="table-wrapper table-responsive">
				<table class="table"><tr><th>CLIENTE</th><th>UNIDADES</th><th>CONDUCTOR</th><th>FECHA</th><th>PRECIO</th><th>TOTAL</th><th>NOTAS</th><th>Historial de pagos</th></tr>';
			while($row = mysqli_fetch_assoc($result)){
				echo '<tr><td>'.$row["cliente"].'</td><td>'.$row["unidades"].'</td><td>'.$row["conductor"].'<br>Unidad: '.$row["unidad"].'</td>
				<td>'.$row["fecha"].'</td><td>'.$row["precio"].'</td><td>'.$row["bruto"].'</td><td>'.$row["notas"].'</td>
				<td>
				<select class="form-control">
						<option value="" selected disabled>Historial</option>
				</select>
				</td></tr>';
			}
			$query = 'SELECT CONCAT("$",FORMAT(SUM(precio*unidades),2))AS bruto,
							CONCAT("$",FORMAT(SUM(precio*unidades)*IFNULL(comision/100,0),2))AS comision,
							CONCAT("$",FORMAT(SUM(precio*unidades)-(SUM(precio*unidades)*IFNULL((comision/100),0)),2))AS neto
							from servicios where folio="'.$folio.'"';
			$result = $con->query($query);
			$row = mysqli_fetch_assoc($result);
			echo '<tr><td></td><td></td><td></td><td></td><td>Total Bruto</td><td>'.$row["bruto"].'</td><td></td></tr>';
			echo '<tr><td></td><td></td><td></td><td></td><td>Comisión</td><td>'.$row["comision"].'</td><td></td></tr>';
			echo '<tr><td></td><td></td><td></td><td></td><td>Total Neto</td><td>'.$row["neto"].'</td><td></td></tr>';
			echo '</div></div></div></table>';
			$messages[] = "El Folio ".$folio." ha sido cargado.";
		} else {
			$errors[] = "Lo sentimos, la carga del folio falló. Por favor, vuelva a intentarlo.";
		}
	}
}else{
	$errors[] = "Desconocido.";
}

if (isset($errors)){
	?>
	<div class="alert alert-danger col-12" role="alert" id="success-alert">
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

			<strong>Error!</strong>
			<?php
				foreach ($errors as $error) {
					echo $error;
				}
			?>
	</div>
	<?php
}
if (isset($messages)){
	?>
	<div class="alert alert-success col-12" role="alert" id="success-alert">
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		<strong>!!</strong>
		<?php
			foreach ($messages as $message) {
				echo $message;
			}
		?>
	</div>
	<?php
}

	$con->close();
}else{header("Location: login.php"); }
