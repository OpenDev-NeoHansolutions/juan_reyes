<?php
if(!isset($_SESSION)) 
{ 
	session_start(); 
}
if (isset($_SESSION["s_username"])){
	ini_set('max_execution_time', 300);
	set_time_limit(300);

	#Conexion a Servidor MySQL
	include '_servidores.php';
	$con = new mysqli(MYSQL1, USER, PASS, DB);
	$con->set_charset("utf8");
	if ($con->connect_error) {
		die("Connection failed: " . $con->connect_error);
	}
		$sql = "SELECT * FROM temporal";
		$result = $con->query($sql);
		if(mysqli_num_rows($result)>0) {
?>

            <div class="row mt-5 mb-3 align-items-center">
                <div class="col-md-3">
				<h3>Nuevo Servicio</h3><br>
                  <input type="text" class="form-control" placeholder="Buscar..." id="searchField">
                </div><br>
                <div class="col-md-2 text-right">
                  <span>Mostrar:</span>
                        <select class="custom-select" name="rowsPerPage" id="changeRows">
                            <option value="1">1</option>
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="15">15</option>
                        </select>
                </div>
            </div>
            <div id="root"></div>
			<button type="button" class="btn danger-btn-outline btn-sm" onclick="limpiar('temporal')">Limpiar</button>
			<a class="main-btn success-btn btn-hover btn-sm" onclick="guardar()">
                <i class="lni lni-plus mr-5"></i> Guardar
			</a>
        </div>
    </div>
	<?PHP
	$query = 'SELECT folio,cliente,unidad,conductor,fecha,CONCAT("$",FORMAT(precio,2))AS precio,unidades,CONCAT("$",FORMAT((precio*unidades),2))AS bruto,CONCAT("$",FORMAT((precio*unidades)*(comision/100),2))AS total,comision,CONCAT("$",FORMAT((precio*unidades)-((precio*unidades)*(comision/100)),2))AS neto,notas,pago,id FROM temporal ORDER BY folio';
	$result = $con->query($query);
	#header('Content-Type: application/json; charset=utf-8');
	$data=array();
	$num=0;
	while($row = mysqli_fetch_assoc($result)){
		$data[]=$row;
		$data[$num]["precio"]=$data[$num]["precio"]." <label class='text-black-50'>".$data[$num]["unidades"]."U</label>";
		$data[$num]["comision"]=$data[$num]["total"]." <label class='text-black-50'>".$data[$num]["comision"]."%</label>";
		$id="'".$row["id"]."'";
		$data[$num]["accion"]='<div class="action"><button class="text-danger" onclick="elimina('.$id.')"><i class="lni lni-trash-can"></i></button></div>';
		if($row["pago"]==1){
			$data[$num]["pago"]='<span class="status-btn success-btn">Pagado</span>';
		}else{
			$data[$num]["pago"]='<span class="status-btn close-btn">Pendiente</span>';
		}
		$num++;
	}
	?>	
    <script src="./js/table-sortable.js"></script>
    <script>
		var columns = {
			folio: 'Folio',
			cliente: 'Cliente',
			unidad: 'Unidad',
			conductor: 'Conductor',
			fecha: 'Fecha',
			precio: 'Precio',
			bruto: 'Total Bruto',
			comision: 'Comisión',
			neto: 'Total Neto',
			pago: 'Estado',
			accion: 'Accion',
		}
        var table = $('#root').tableSortable({
			data: <?PHP echo json_encode($data);?>,
            columns: columns,
            searchField: '#searchField',
            responsive: {
                1100: {
                    columns: {
                        folio: 'Folio',
                        cliente: 'Cliente',
						pago: 'Estado',
						accion: 'Accion',
                    },
                },
            },
            rowsPerPage: 10,
            pagination: true,
            tableWillMount: function() {
                console.log('table will mount')
            },
            tableDidMount: function() {
                console.log('table did mount')
            },
            tableWillUpdate: function() {console.log('table will update')},
            tableDidUpdate: function() {console.log('table did update')},
            tableWillUnmount: function() {console.log('table will unmount')},
            tableDidUnmount: function() {console.log('table did unmount')},
            onPaginationChange: function(nextPage, setPage) {
                setPage(nextPage);
            }
        });

        $('#changeRows').on('change', function() {
            table.updateRowsPerPage(parseInt($(this).val(), 10));
        })
    </script>
	<?php
		}
	?>
            <div class="row mt-5 mb-3 align-items-center">
                <!-- <div class="col-md-3">				
                  <input type="text" class="form-control" placeholder="Buscar..." id="searchField2">
                </div><br> -->
                <div class="col-md-2 text-right">
				  <a href="inc/excel_servicios.php"><i class="lni lni-save"></i> EXCEL </a><br>
                  <span>Mostrar:</span>
                        <select class="custom-select" name="rowsPerPage" id="changeRows2">
                            <option value="1">1</option>
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="50">50</option>
                        </select>
                </div>
            </div>
            <div id="root2"></div>
        </div>
    </div>
	<?PHP
	$query = 'SELECT folio,
			cliente,
			conductor,
			fecha,
			CONCAT("$",FORMAT(precio,2))AS precio,
			unidades,
			CONCAT("$",FORMAT((precio*unidades),2))AS bruto,
			CONCAT("$",FORMAT((precio*unidades)*IFNULL(comision/100,0),2))AS comisiontotal,
			IFNULL(comision,0) AS comision,
			CONCAT("$",FORMAT((precio*unidades)-IFNULL((precio*unidades)*(comision/100),0),2))AS neto,
			pago,
			CASE WHEN pago=0 
				THEN 
					CONCAT("$",FORMAT(IFNULL((SELECT sum(abono) FROM abonos WHERE folio=servicios.folio),0),2))
				ELSE 
					CONCAT("$",FORMAT((precio*unidades),2))
				END AS abono,
			CASE WHEN pago=0 
				THEN 
					CONCAT("$",FORMAT((precio*unidades)-IFNULL((SELECT sum(abono) FROM abonos WHERE folio=servicios.folio),0),2))
				ELSE 
					CONCAT("$",FORMAT(0,2))
				END AS deuda,
			id 
			FROM servicios ORDER BY folio';
	$result = $con->query($query);
	#header('Content-Type: application/json; charset=utf-8');
	$data=array();
	$num=0;
	while($row = mysqli_fetch_assoc($result)){
		$data[]=$row;
		$folio=$row["folio"];
		$folioa="'".$row["folio"]."'";
		$data[$num]["folio"]='<div class="action"><button class="text-success" onclick="vista('.$folioa.')"><i class="lni lni-indent-increase"></i></button>'.$row["folio"].'</div>';
		$data[$num]["precio"]=$data[$num]["precio"]." <label class='text-black-50'>".$data[$num]["unidades"]."U</label>";
		$data[$num]["comision"]='<div class="action"><button class="text-primary" onclick="comision('.$folioa.')" data-bs-toggle="modal" data-bs-target="#ComisionM"><i class="lni lni-pencil"></i></button><label class="text-black-50">'.$data[$num]["comision"]."% =&nbsp;</label>".$data[$num]["comisiontotal"]."</div>";
		$id="'".$row["id"]."'";
		$pid="p".$row["id"];
		$abono=$data[$num]["abono"];
		if($row["pago"]==1){
			$data[$num]["abono"]='<div class="action"><button class="text-success"><i class="lni lni-checkmark-circle"></i></button>'.$abono.'</div>';
			$data[$num]["accion"]='<div class="form-group form-switch toggle-switch">
								<input onclick="pagar('.$id.')" type="checkbox" name="'.$pid.'" id="'.$pid.'" value="1" class="form-check-input" checked>
								<span class="status-btn success-btn">Pagado</span></div>';
		}else{
			$data[$num]["abono"]='<div class="action"><button class="text-primary" onclick="abono('.$folioa.')" data-bs-toggle="modal" data-bs-target="#AbonoM"><i class="lni lni-circle-plus"></i></button>'.$abono.'</div>';
			$data[$num]["accion"]='<div class="form-group form-switch toggle-switch">
								<input onclick="pagar('.$id.')" type="checkbox" name="'.$pid.'" id="'.$pid.'" value="0" class="form-check-input">
								<span class="status-btn close-btn">Pendiente</span></div>';
		}
		$num++;
	}
	?>	
    <script src="./js/table-sortable.js"></script>
    <script>
		var columns = {
			folio: 'Folio',
			cliente: 'Cliente',
			conductor: 'Conductor',
			fecha: 'Fecha',
			precio: 'Precio',
			bruto: 'Total Bruto',
			comision: 'Comisión',
			neto: 'Total Neto',
			deuda: 'Deuda',
			abono: 'Abono',
			accion: 'Estado',
		}
        var table2 = $('#root2').tableSortable({
			data: <?PHP echo json_encode($data);?>,
            columns: columns,
            searchField: '#searchField2',
            responsive: {
                1100: {
                    columns: {
                        folio: 'Folio',
                        cliente: 'Cliente',
						comision: 'Comisión',
						abono: 'Abono',
						accion: 'Estado'
                    },
                },
            },
            rowsPerPage: 10,
            pagination: true,
            tableWillMount: function() {
                console.log('table will mount')
            },
            tableDidMount: function() {
                console.log('table did mount')
            },
            tableWillUpdate: function() {console.log('table will update')},
            tableDidUpdate: function() {console.log('table did update')},
            tableWillUnmount: function() {console.log('table will unmount')},
            tableDidUnmount: function() {console.log('table did unmount')},
            onPaginationChange: function(nextPage, setPage) {
                setPage(nextPage);
            }
        });

        $('#changeRows2').on('change', function() {
            table2.updateRowsPerPage(parseInt($(this).val(), 10));
        })
    </script>
<?php
	$con->close();
}else{header("Location: login.php"); }
?>	