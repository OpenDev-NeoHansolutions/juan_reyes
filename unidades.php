<?php
if(!isset($_SESSION)) 
{ 
	session_start(); 
}
if (isset($_SESSION["s_username"])){
	ini_set('max_execution_time', 300);
	set_time_limit(300);
?>
<!DOCTYPE html>
<html lang="en">
<!--Iconos-->
<!--https://iconmonstr.com/product-2-svg/-->
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="shortcut icon"
      href="assets/images/favicon.svg"
      type="image/x-icon"
    />
    <title>::. Camiones</title>

    <!-- ========== All CSS files linkup ========= -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/lineicons.css" />
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
  </head>
  <body>
    <!-- ======== sidebar-nav start =========== -->
    <aside class="sidebar-nav-wrapper">
      <div class="navbar-logo">
        <a href="index.php">
			<img src="img/logo.png" alt="logo" />
		</a>
      </div>
      <nav class="sidebar-nav">
        <ul>
          <li class="nav-item nav-item-has-children">
            <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_1" aria-controls="ddmenu_1" aria-expanded="false" aria-label="Toggle navigation">
              <span class="icon">
                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M23 6.066v12.065l-11.001 5.869-11-5.869v-12.131l11-6 11.001 6.066zm-21.001 11.465l9.5 5.069v-10.57l-9.5-4.946v10.447zm20.001-10.388l-9.501 4.889v10.568l9.501-5.069v-10.388zm-5.52 1.716l-9.534-4.964-4.349 2.373 9.404 4.896 4.479-2.305zm-8.476-5.541l9.565 4.98 3.832-1.972-9.405-5.185-3.992 2.177z"/></svg>
              </span>
              <span class="text">Dashboard</span>
            </a>
            <ul id="ddmenu_1" class="collapse dropdown-nav">
              <li>
                <a href="index.php"> Indicadores </a>
              </li>
            </ul>
			<ul id="ddmenu_1" class="collapse dropdown-nav">
              <li>
                <a href="index2.html"> Ejemplos </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="servicios.php">
              <span class="icon">
                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M16.533 14.322l-.061.678h4.304c.146-.643.224-1.313.224-2l-.004-.243.987-1.56.649-1.024c.24.902.368 1.85.368 2.827 0 6.071-4.929 11-11 11-2.642 0-5.067-.933-6.964-2.487.617-.314 1.152-.765 1.564-1.314.891.669 1.91 1.178 3.013 1.481l-.084-.16c-.544-1.045-.994-2.138-1.336-3.265l-.061-.208 1.847-.819c.081.299.171.596.27.891.353 1.058.815 2.079 1.365 3.049.124.219.253.434.386.647.246-.399.48-.804.696-1.219.487-.935.89-1.912 1.196-2.921.068-.223.131-.448.189-.675h-3.587l6.039-2.678zm3.53 2.678h-3.926c-.133.592-.297 1.177-.489 1.753-.338 1.009-.762 1.988-1.262 2.927 2.489-.684 4.548-2.411 5.677-4.68zm-.814-7.711c-1.521-2.411-2.583-4.232-2.583-5.805 0-1.924 1.743-3.484 3.667-3.484 1.925 0 3.667 1.56 3.667 3.484s-1.59 4.221-3.667 7.516l-.002-.003-14.332 6.355.001.074c0 1.656-1.345 3-3 3-1.656 0-3-1.344-3-3s1.344-3 3-3c.914 0 1.733.41 2.283 1.055l13.966-6.192zm-16.026 1.711c-.142.623-.218 1.271-.223 1.936v.064c-.715 0-1.391.167-1.991.464l-.009-.464c0-6.071 4.929-11 11-11 1.139 0 2.238.174 3.272.496-.042.195-.072.394-.089.593-.044.517.001 1.029.105 1.532-.304-.12-.616-.223-.935-.31l.183.359c.578 1.157 1.048 2.37 1.39 3.618l.186.75-4.396 1.962h-2.155c-.044.332-.078.666-.101 1l-2.037.903c.007-.636.048-1.271.122-1.903h-4.322zm6.423-6.689c-2.503.678-4.576 2.41-5.71 4.689h3.958c.094-.408.202-.812.324-1.213.364-1.201.847-2.364 1.428-3.476zm2.353-.104c-.265.443-.516.894-.746 1.356-.52 1.041-.943 2.13-1.25 3.253l-.05.184h4.093c-.069-.262-.144-.523-.225-.781-.351-1.121-.817-2.205-1.377-3.237-.142-.262-.291-.52-.445-.775zm8.334.835c-.759 0-1.375-.616-1.375-1.375 0-.76.616-1.375 1.375-1.375s1.375.615 1.375 1.375c0 .759-.616 1.375-1.375 1.375z"/></svg>              </span>
              <span class="text">Servicios</span>
            </a>
          </li>		  
          <li class="nav-item">
            <a href="clientes.php">
              <span class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M10.118 16.064c2.293-.529 4.428-.993 3.394-2.945-3.146-5.942-.834-9.119 2.488-9.119 3.388 0 5.644 3.299 2.488 9.119-1.065 1.964 1.149 2.427 3.394 2.945 1.986.459 2.118 1.43 2.118 3.111l-.003.825h-15.994c0-2.196-.176-3.407 2.115-3.936zm-10.116 3.936h6.001c-.028-6.542 2.995-3.697 2.995-8.901 0-2.009-1.311-3.099-2.998-3.099-2.492 0-4.226 2.383-1.866 6.839.775 1.464-.825 1.812-2.545 2.209-1.49.344-1.589 1.072-1.589 2.333l.002.619z"/></svg>
              </span>
              <span class="text">Clientes</span>
            </a>
          </li>
		  <li class="nav-item">
            <a href="conductores.php">
              <span class="icon">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M10.119 16.064c2.293-.53 4.427-.994 3.394-2.946-3.147-5.941-.835-9.118 2.488-9.118 3.388 0 5.643 3.299 2.488 9.119-1.065 1.964 1.149 2.427 3.393 2.946 1.985.458 2.118 1.428 2.118 3.107l-.003.828h-1.329c0-2.089.083-2.367-1.226-2.669-1.901-.438-3.695-.852-4.351-2.304-.239-.53-.395-1.402.226-2.543 1.372-2.532 1.719-4.726.949-6.017-.902-1.517-3.617-1.509-4.512-.022-.768 1.273-.426 3.479.936 6.05.607 1.146.447 2.016.206 2.543-.66 1.445-2.472 1.863-4.39 2.305-1.252.29-1.172.588-1.172 2.657h-1.331c0-2.196-.176-3.406 2.116-3.936zm-10.117 3.936h1.329c0-1.918-.186-1.385 1.824-1.973 1.014-.295 1.91-.723 2.316-1.612.212-.463.355-1.22-.162-2.197-.952-1.798-1.219-3.374-.712-4.215.547-.909 2.27-.908 2.819.015.935 1.567-.793 3.982-1.02 4.982h1.396c.44-1 1.206-2.208 1.206-3.9 0-2.01-1.312-3.1-2.998-3.1-2.493 0-4.227 2.383-1.866 6.839.774 1.464-.826 1.812-2.545 2.209-1.49.345-1.589 1.072-1.589 2.334l.002.618z"/></svg>
              </span>
              <span class="text">Conductores</span>
            </a>
          </li>
		  <li class="nav-item active">
            <a href="unidades.php">
              <span class="icon">
				<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M3 18h-2c-.552 0-1-.448-1-1v-2h15v-9h4.667c1.117 0 1.6.576 1.936 1.107.594.94 1.536 2.432 2.109 3.378.188.312.288.67.288 1.035v4.48c0 1.121-.728 2-2 2h-1c0 1.656-1.344 3-3 3s-3-1.344-3-3h-6c0 1.656-1.344 3-3 3s-3-1.344-3-3zm3-1.2c.662 0 1.2.538 1.2 1.2 0 .662-.538 1.2-1.2 1.2-.662 0-1.2-.538-1.2-1.2 0-.662.538-1.2 1.2-1.2zm12 0c.662 0 1.2.538 1.2 1.2 0 .662-.538 1.2-1.2 1.2-.662 0-1.2-.538-1.2-1.2 0-.662.538-1.2 1.2-1.2zm-4-2.8h-14v-10c0-.552.448-1 1-1h12c.552 0 1 .448 1 1v10zm3-6v3h4.715l-1.427-2.496c-.178-.312-.509-.504-.868-.504h-2.42z"/></svg></span>
              <span class="text">Unidades</span>
            </a>
          </li>
          <span class="divider"><hr/></span>
        </ul>
      </nav>
    </aside>
    <div class="overlay"></div>
    <!-- ======== sidebar-nav end =========== -->

    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
      <!-- ========== header start ========== -->
      <header class="header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-5 col-md-5 col-6">
              <div class="header-left d-flex align-items-center">
                <div class="menu-toggle-btn mr-20">
                  <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                    <i class="lni lni-chevron-left me-2"></i>
                  </button>
                </div>
				<div class="header-search d-none d-md-flex">
                  <form action="#">
                    <input type="text" placeholder="Buscar..." id="searchField"/>
                    <button><i class="lni lni-search-alt"></i></button>
                  </form>
                </div>				
              </div>
            </div>
            <div class="col-lg-7 col-md-7 col-6">
              <div class="header-right">
                <!-- profile start -->
                <div class="profile-box ml-15">
                  <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="profile-info">
                      <div class="info">
                        <h6><?php echo $_SESSION["s_name"]?></h6>
                        <div class="image">
                          <img
                            src="assets/images/profile/usuario.png"
                            alt=""
                          />
                          <span class="status"></span>
                        </div>
                      </div>
                    </div>
                    <i class="lni lni-chevron-down"></i>
                  </button>
                  <ul
                    class="dropdown-menu dropdown-menu-end"
                    aria-labelledby="profile"
                  >
                    <li>
                      <a href="off.php"> <i class="lni lni-exit"></i> Salir </a>
                    </li>
                  </ul>
                </div>
                <!-- profile end -->
              </div>
            </div>
          </div>
        </div>
      </header>
      <!-- ========== header end ========== -->

      <!-- ========== section start ========== -->
      <section>
        <div class="container-fluid">
		<!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title d-flex align-items-center flex-wrap mb-30">
                  <h2 class="mr-40">Unidades</h2>
                  <a class="main-btn primary-btn btn-hover btn-sm" data-bs-toggle="modal" data-bs-target="#ModalN">
                    <i class="lni lni-plus mr-5"></i> Nueva Unidad
				  </a>
                </div>
              </div>
              <!-- end col -->
              <div class="col-md-6">
                <div class="breadcrumb-wrapper mb-30">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        Administración de Unidades
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
              <!-- end col -->
            </div>
            <!-- end row -->
          </div>
          <!-- ========== title-wrapper end ========== -->
<!-- Nuevo Cliente -->
<div class="modal fade" id="ModalN" tabindex="-1" aria-labelledby="ModalLabelNC" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabelNC">Nueva Unidad</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	   <form name="nuevo" id="nuevo">
		  <div class="modal-body">
			<div class="form-group">
				<label>Unidad</label>
				<input type="text" maxlength="300" name="unidad"  id="unidad" value="" class="form-control" placeholder="Nombre de la Unidad" required>
			</div>
			<div class="form-group">
				<label>Marca</label>
				<input type="text" maxlength="100" name="marca"  id="marca" value="" class="form-control" placeholder="*Opcional">
			</div>
			<div class="form-group">
				<label>Rendimiento</label>
				<input type="text" maxlength="100" name="rendimiento"  id="rendimiento" value="" class="form-control" placeholder="*Opcional">
			</div>
			<div class="form-group">
				<label>Servicios</label>
				<input type="text" maxlength="100" name="servicios"  id="servicios" value="" class="form-control" placeholder="*Opcional">
			</div>
			<div class="form-group">
				<label>Notas</label>
				<textarea maxlength="400" name="notas"  id="notas" value="" class="form-control" placeholder="*Opcional"></textarea>
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn light-btn btn-sm" onclick="limpiar('unidades')">Limpiar</button>
			<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
			<input type="submit" class="main-btn primary-btn btn-hover btn-sm" id="guardar" value="Guardar">
		  </div>
	   </form>
    </div>
  </div>
</div>
<!-- Termina Nuevo Cliente -->
          <!-- Invoice Wrapper Start -->
          <div class="invoice-wrapper">
            <div class="row">
              <div class="col-12">
                <div class="invoice-card card-style mb-30">
<!-- Contenedor -->
<input type="hidden" name="urlg"  id="urlg" value="inc/guardar_unidad.php">
<input type="hidden" name="urll"  id="urll" value="inc/listar_unidades.php">
<input type="hidden" name="urle"  id="urle" value="inc/eliminar_unidad.php">
<div id="resultados"></div>
<div id="loader"></div>
<div class='ajax'></div>

<!-- Fin Contenedor -->
                </div>
                <!-- End Card -->
              </div>
              <!-- ENd Col -->
            </div>
            <!-- End Row -->
          </div>
          <!-- Invoice Wrapper End -->
        </div>
        <!-- end container -->
      </section>
      <!-- ========== section end ========== -->

      <!-- ========== footer start =========== -->
      <footer class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6 order-last order-md-first">
              <div class="copyright text-center text-md-start">
                <p class="text-sm">
                  Diseño y Desarrollo:
                  <a
                    href="https://opendev.mx"
                    rel="nofollow"
                    target="_blank"
                  >
                    OpenDev
                  </a>
                </p>
              </div>
            </div>
            <!-- end col-->
            <div class="col-md-6">
              <div
                class="
                  terms
                  d-flex
                  justify-content-center justify-content-md-end
                "
              >
              </div>
            </div>
          </div>
          <!-- end row -->
        </div>
        <!-- end container -->
      </footer>
      <!-- ========== footer end =========== -->
    </main>
    <!-- ======== main-wrapper end =========== -->

    <!-- ========= All Javascript files linkup ======== -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/Chart.min.js"></script>
    <script src="assets/js/dynamic-pie-chart.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/fullcalendar.js"></script>
    <script src="assets/js/jvectormap.min.js"></script>
    <script src="assets/js/world-merc.js"></script>
    <script src="assets/js/polyfill.js"></script>
    <script src="assets/js/main.js"></script>
	<script src="js/jquery-3.6.0.min.js"></script>
	<script src="js/script.js"></script>
  </body>
</html>
<?php
}else{header("Location: login.php"); }
?>