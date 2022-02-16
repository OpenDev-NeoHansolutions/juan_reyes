<?php
if(!isset($_SESSION)) 
{ 
	session_start(); 
}
if (isset($_SESSION["s_username"])){
	ini_set('max_execution_time', 300);
	set_time_limit(300);

if (empty($_POST['foliocomision'])){
		$errors[] = "Ingresa el Folio.";
}elseif(!empty($_POST['foliocomision'])){
	require_once ("_servidores.php");
	$con = new mysqli(MYSQL1, USER, PASS, DB);
	$con->set_charset("utf8");
	if ($con->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}else{
		$foliocomision=mysqli_real_escape_string($con,(strip_tags(strtoupper($_POST["foliocomision"]),ENT_QUOTES)));
		$comision=mysqli_real_escape_string($con,(strip_tags($_POST["comision"],ENT_QUOTES)));
		$notascomision=mysqli_real_escape_string($con,(strip_tags($_POST["notascomision"],ENT_QUOTES)));
		$sql = "UPDATE servicios SET
		comision='$comision',notas='$notascomision'
		WHERE folio='$foliocomision'";
		$query = mysqli_query($con,$sql);
		if ($query) {
			$messages[] = "La comisión ha sido cargada.";
		} else {
			$errors[] = "Lo sentimos, el registro falló. Por favor, vuelva a intentarlo.";
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