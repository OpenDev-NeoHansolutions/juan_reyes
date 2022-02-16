<?php
  include('inc/_servidores.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <select name="proveedor" class="form-control">
      <option value="" selected disabled> Historial de pago</option>
      <?php
      require_once ("inc/_servidores.php");
    	$con = new mysqli(MYSQL1, USER, PASS, DB);
    	$con->set_charset("utf8");
    	if ($con->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
    	}else{
        $sql1 = mysqli_query($con, "SELECT fecha, abono FROM abonos WHERE folio=15");
          $result_sql1 = mysqli_num_rows($sql1);
          while ($data1 = mysqli_fetch_array($sql1)) {
            echo '<option>'."Abono: ".$data1["abono"]." | ". "Fecha: " .$data1["fecha"].'</option>';
          }
      }s
      ?>
    </select>
  </body>
</html>
