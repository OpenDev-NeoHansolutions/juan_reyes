<?php
if(!isset($_SESSION)) 
{ 
	session_start(); 
}
if (isset($_SESSION["s_username"])){
	ini_set('max_execution_time', 300);
	set_time_limit(300);

if (empty($_POST['cliente'])){
		$errors[] = "Ingresa el nombre del Cliente.";
}elseif(!empty($_POST['cliente'])){
	require_once ("_servidores.php");
	$con = new mysqli(MYSQL1, USER, PASS, DB);
	$con->set_charset("utf8");
	if ($con->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}else{
		$cliente=mysqli_real_escape_string($con,(strip_tags(strtoupper($_POST["cliente"]),ENT_QUOTES)));
		$raz_social=mysqli_real_escape_string($con,(strip_tags($_POST["raz_social"],ENT_QUOTES)));
		$actividad=mysqli_real_escape_string($con,(strip_tags($_POST["actividad"],ENT_QUOTES)));
		$direccion=mysqli_real_escape_string($con,(strip_tags($_POST["direccion"],ENT_QUOTES)));
		$contacto=mysqli_real_escape_string($con,(strip_tags($_POST["contacto"],ENT_QUOTES)));
		$telefono=mysqli_real_escape_string($con,(strip_tags($_POST["telefono"],ENT_QUOTES)));
		$sql = "SELECT * FROM clientes WHERE cliente='$cliente'";
		$result = $con->query($sql);
		if(!mysqli_fetch_assoc($result)) {
			$sql = "INSERT INTO clientes(
			cliente,raz_social,actividad,direccion,contacto,telefono
			 ) VALUES (
			'$cliente','$raz_social','$actividad','$direccion','$contacto','$telefono')";
			$query = mysqli_query($con,$sql);
			if ($query) {
				$messages[] = "El Cliente '".$cliente."' ha sido creado con éxito.";
			} else {
				$errors[] = "Lo sentimos, el registro falló. Por favor, vuelva a intentarlo.";
			}
		}else{
			$errors[] = "El Cliente '".$cliente."' ha sido creado anteriormente.";
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