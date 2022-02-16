<?php
if(!isset($_SESSION)) 
{ 
	session_start(); 
}
if (isset($_SESSION["s_username"])){
	ini_set('max_execution_time', 300);
	set_time_limit(300);
?>

            <div class="row mt-5 mb-3 align-items-center">
                <!-- <div class="col-md-3">
                  <input type="text" class="form-control" placeholder="Buscar..." id="searchField">
                </div><br> -->
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
        </div>
    </div>
	<?PHP	
	#Conexion a Servidor MySQL
	include '_servidores.php';
	$con = new mysqli(MYSQL1, USER, PASS, DB);
	$con->set_charset("utf8");
	if ($con->connect_error) {
		die("Connection failed: " . $con->connect_error);
	}
	$query = 'SELECT cliente,raz_social,actividad,direccion,contacto,telefono,fecha_creacion,id from clientes order by cliente';
	$result = $con->query($query);
	#header('Content-Type: application/json; charset=utf-8');
	$data=array();
	$num=0;
	while($row = mysqli_fetch_assoc($result)){
		$data[]=$row;
		$id="'".$row["id"]."'";
		$data[$num]["id"]='<div class="action"><button class="text-danger" onclick="elimina('.$id.')"><i class="lni lni-trash-can"></i></button></div>';
		$num++;
	}
	?>	
    <script src="./js/table-sortable.js"></script>
    <script>
		var columns = {
			cliente: 'Cliente',
			raz_social: 'Razón Social',
			actividad: 'Actividad',
			direccion: 'Dirección',
			contacto: 'Contacto',
			telefono: 'Telefono',
			fecha_creacion: 'Fecha Creación',
			id: 'Accion',
		}
        var table = $('#root').tableSortable({
			data: <?PHP echo json_encode($data);?>,
            columns: columns,
            searchField: '#searchField',
            responsive: {
                1100: {
                    columns: {
                        cliente: 'Cliente',
                        raz_social: 'Razón Social',
						id: 'Accion',
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