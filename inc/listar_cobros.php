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
?>
            <div class="row mt-5 mb-3 align-items-center">
                <div class="col-md-3">
				<h3>Servicios por cobrar</h3><br>
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

	<?PHP
	$query = 'SELECT s.folio,
					s.cliente,
					s.fecha, 
					CONCAT(GREATEST(datediff(curdate(),s.fecha),0)," Días") AS atraso,
					CONCAT("$",FORMAT(s.precio,2))AS precio,
					SUM(s.unidades) AS unidades,
					CONCAT("$",FORMAT(SUM(s.precio*s.unidades),2))AS bruto,
					CONCAT("$",FORMAT(SUM(s.precio*s.unidades)*IFNULL(s.comision/100,0),2))AS comisiontotal,
					IFNULL(s.comision,0) as comision,
					CONCAT("$",FORMAT(SUM(s.precio*s.unidades)-(SUM(s.precio*s.unidades)*IFNULL((s.comision/100),0)),2))AS neto,
					CONCAT("$",FORMAT(IFNULL((SELECT SUM(abono) FROM abonos WHERE folio=s.folio),0),2))AS abono,
					CONCAT("$",FORMAT(SUM(s.precio*s.unidades)-IFNULL((SELECT SUM(abono) FROM abonos WHERE folio=s.folio),0),2)) AS deuda
					FROM servicios s WHERE s.pago=0 group by s.cliente,s.folio ORDER BY s.cliente,s.folio';
	$result = $con->query($query);
	#header('Content-Type: application/json; charset=utf-8');
	$data=array();
	$num=0;
	while($row = mysqli_fetch_assoc($result)){
		$data[]=$row;
		$data[$num]["precio"]=$data[$num]["precio"]." <label class='text-black-50'>".$data[$num]["unidades"]."U</label>";
		$data[$num]["comision"]='<div class="action"><label class="text-black-50">'.$data[$num]["comision"]."% =&nbsp;</label>".$data[$num]["comisiontotal"]."</div>";
		$data[$num]["pago"]='<span class="status-btn close-btn">Pendiente</span>';
		$num++;
	}
	?>	
    <script src="./js/table-sortable.js"></script>
    <script>
		var columns = {
			folio: 'Folio',
			cliente: 'Cliente',
			fecha: 'Fecha',
			atraso: 'Atraso',
			precio: 'Precio',
			comision: 'Comision',
			neto: 'Neto',
			abono: 'Abono',
			deuda: 'Deuda',
			bruto: 'Total',
			pago: 'Pago',
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
						atraso: 'Atraso',
						deuda: 'deuda',
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
	$con->close();
}else{header("Location: login.php"); }
?>	