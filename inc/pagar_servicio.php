<?php
if(!isset($_SESSION)) 
{ 
	session_start(); 
}
if (isset($_SESSION["s_username"])){
	ini_set('max_execution_time', 300);
	set_time_limit(300);

require_once ("_servidores.php");
$con = new mysqli(MYSQL1, USER, PASS, DB);
$con->set_charset("utf8");
if ($con->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}else{
	$id=$_POST['id'];
	if ($_POST['pago']==1){
		$pago='0';
	}
	if ($_POST['pago']==0){
		$pago='1';
	}
	$sql = "UPDATE camiones.servicios SET pago=".$pago." WHERE id=".$id.";";
	$result = $con->query($sql);
	if($result) {
			$messages[] = "El Servicio ha sido modificado con éxito.";
	}else{
		$errors[] = "El Servicio no se ha modificado.";
	}
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