<?php
if(!isset($_SESSION)) 
{ 
	session_start(); 
}

$username = $_POST['username'];
$password = $_POST['password'];

    if ($username!=NULL) 
	{
		//Comprobacion del envio del nombre de usuario y password
		if ($password==NULL) 
		{
			header("Location: login.php");
		}else
		{
			#Conexion a Servidor
			include 'inc/_servidores.php';
			$con = new mysqli(MYSQL1, USER, PASS, DB);
			$con->set_charset("utf8");
			// Check connection
			if ($con->connect_error) {
				die("Connection failed: " . $con->connect_error);
			}
			$query = "SELECT nombre,usuario,password FROM usuarios WHERE usuario = '$username'";
			$result = $con->query($query);
			$row = mysqli_fetch_assoc($result);
			$username_u = utf8_encode($row["usuario"]);
			$password_u = utf8_encode($row["password"]);
			$name_u = utf8_encode($row["nombre"]);
			if($username_u == $username)
			{
				if($password_u != $password) 
				{
					header("Location: login.php");
				}else
				{
						$_SESSION["s_username"] = $username_u;
						$_SESSION["s_name"] = $name_u;
						header("Location: index.php");
				}
			}else
			{
				header("Location: login.php");
			}
			$con->close();
		}
    }else
	{
			header("Location: login.php");
	}
    ?> 
