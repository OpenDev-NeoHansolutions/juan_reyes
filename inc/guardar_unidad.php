<?php
if(!isset($_SESSION)) 
{ 
	session_start(); 
}
if (isset($_SESSION["s_username"])){
	ini_set('max_execution_time', 300);
	set_time_limit(300);

if (empty($_POST['unidad'])){
		$errors[] = "Ingresa el nombre de la Unidad.";
}elseif(!empty($_POST['unidad'])){
	require_once ("_servidores.php");
	$con = new mysqli(MYSQL1, USER, PASS, DB);
	$con->set_charset("utf8");
	if ($con->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}else{
		$unidad=mysqli_real_escape_string($con,(strip_tags(strtoupper($_POST["unidad"]),ENT_QUOTES)));
		$marca=mysqli_real_escape_string($con,(strip_tags($_POST["marca"],ENT_QUOTES)));
		$rendimiento=mysqli_real_escape_string($con,(strip_tags($_POST["rendimiento"],ENT_QUOTES)));
		$servicios=mysqli_real_escape_string($con,(strip_tags($_POST["servicios"],ENT_QUOTES)));
		$notas=mysqli_real_escape_string($con,(strip_tags($_POST["notas"],ENT_QUOTES)));
		$sql = "SELECT * FROM unidades WHERE unidad='$unidad'";
		$result = $con->query($sql);
		if(!mysqli_fetch_assoc($result)) {
			$sql = "INSERT INTO unidades(
			unidad,marca,rendimiento,servicios,notas
			 ) VALUES (
			'$unidad','$marca','$rendimiento','$servicios','$notas')";
			$query = mysqli_query($con,$sql);
			if ($query) {
				$messages[] = "La Unidad '".$unidad."' ha sido creada con éxito.";
			} else {
				$errors[] = "Lo sentimos, el registro falló. Por favor, vuelva a intentarlo.";
			}
		}else{
			$errors[] = "La Unidad '".$unidad."' ha sido creada anteriormente.";
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