<?php
if(!isset($_SESSION)) 
{ 
	session_start(); 
}
if (isset($_SESSION["s_username"])){
	ini_set('max_execution_time', 300);
	set_time_limit(300);

if (empty($_POST['folioabono'])){
		$errors[] = "Ingresa el Folio.";
}elseif(!empty($_POST['folioabono'])){
	require_once ("_servidores.php");
	$con = new mysqli(MYSQL1, USER, PASS, DB);
	$con->set_charset("utf8");
	if ($con->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}else{
		$folioabono=mysqli_real_escape_string($con,(strip_tags(strtoupper($_POST["folioabono"]),ENT_QUOTES)));
		$abono=mysqli_real_escape_string($con,(strip_tags($_POST["abono"],ENT_QUOTES)));
		$fechaabono=mysqli_real_escape_string($con,(strip_tags($_POST["fechaabono"],ENT_QUOTES)));
		$notasabono=mysqli_real_escape_string($con,(strip_tags($_POST["notasabono"],ENT_QUOTES)));
		$sql = "INSERT INTO abonos(
		folio,abono,fecha,notas
		) VALUES (
		'$folioabono',$abono,'$fechaabono','$notasabono')";
		$query = mysqli_query($con,$sql);
		if ($query) {
			$messages[] = "El abono ha sido agregado.";
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