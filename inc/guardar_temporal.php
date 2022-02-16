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
		$cliente=mysqli_real_escape_string($con,(strip_tags($_POST["cliente"],ENT_QUOTES)));
		$unidad=mysqli_real_escape_string($con,(strip_tags($_POST["unidad"],ENT_QUOTES)));
		$conductor=mysqli_real_escape_string($con,(strip_tags($_POST["conductor"],ENT_QUOTES)));
		$fecha=mysqli_real_escape_string($con,(strip_tags($_POST["fecha"],ENT_QUOTES)));
		$unidades=mysqli_real_escape_string($con,(strip_tags($_POST["unidades"],ENT_QUOTES)));
		$precio=mysqli_real_escape_string($con,(strip_tags($_POST["precio"],ENT_QUOTES)));
		if (empty($_POST['comision'])){
			$comision='0';
		}else{
			$comision=$_POST["comision"];
		}
		if (empty($_POST['pago'])){
			$pago='0';
		}else{
			$pago=$_POST["pago"];
		}
		$notas=mysqli_real_escape_string($con,(strip_tags($_POST["notas"],ENT_QUOTES)));

		#$sql = "SELECT * FROM clientes WHERE cliente='$cliente'";
		#$result = $con->query($sql);
		#if(!mysqli_fetch_assoc($result)) {
			$sql = "INSERT INTO temporal(
			folio,cliente,unidad,conductor,fecha,unidades,precio,comision,pago,notas
			) VALUES (
			'$folio','$cliente','$unidad','$conductor','$fecha',$unidades,$precio,$comision,$pago,'$notas')";
			$query = mysqli_query($con,$sql);
			if ($query) {
				$messages[] = "El Servicio ha sido agregado.";
			} else {
				$errors[] = "Lo sentimos, el registro falló. Por favor, vuelva a intentarlo.";
			}
		#}else{
		#	$errors[] = "El Cliente '".$cliente."' ha sido creado anteriormente.";
		#}
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