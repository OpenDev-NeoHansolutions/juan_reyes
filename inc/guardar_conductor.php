<?php
if(!isset($_SESSION)) 
{ 
	session_start(); 
}
if (isset($_SESSION["s_username"])){
	ini_set('max_execution_time', 300);
	set_time_limit(300);

if (empty($_POST['nombre'])){
		$errors[] = "Ingresa el nombre del Conductor.";
}elseif(!empty($_POST['nombre'])){
	require_once ("_servidores.php");
	$con = new mysqli(MYSQL1, USER, PASS, DB);
	$con->set_charset("utf8");
	if ($con->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}else{
		$nombre=mysqli_real_escape_string($con,(strip_tags(strtoupper($_POST["nombre"]),ENT_QUOTES)));
		$direccion=mysqli_real_escape_string($con,(strip_tags($_POST["direccion"],ENT_QUOTES)));
		$telefono=mysqli_real_escape_string($con,(strip_tags($_POST["telefono"],ENT_QUOTES)));
		$sql = "SELECT * FROM conductores WHERE nombre='$nombre'";
		$result = $con->query($sql);
		if(!mysqli_fetch_assoc($result)) {
			$sql = "INSERT INTO conductores(
			nombre,direccion,telefono
			 ) VALUES (
			'$nombre','$direccion','$telefono')";
			$query = mysqli_query($con,$sql);
			if ($query) {
				$messages[] = "El Conductor '".$nombre."' ha sido creado con éxito.";
			} else {
				$errors[] = "Lo sentimos, el registro falló. Por favor, vuelva a intentarlo.";
			}
		}else{
			$errors[] = "El Conductor '".$nombre."' ha sido creado anteriormente.";
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