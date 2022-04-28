 <!-- Preloader -->
 <div class="preloader flex-column justify-content-center align-items-center">
     <img class="animation__shake" src="media/logo.png" alt="Ez - Soft" height="60" width="60">
 </div>
 <!-- Cabezera de contenido -->
 <section class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6"></div>
             <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                     <li class="breadcrumb-item"><a href="#">ventas</a></li>
                 </ol>
             </div>
         </div>
     </div>
 </section>

 <!-- Contenido -->
 <section class="content">
     <div class="container-fluid">
         <div class="alert alert-info text-center" role="alert">
             <i class="fas fa-info-circle"></i>
             Aqui se muestran datos importantes para tu negocio.
         </div>

         <div class="row">
             <div class="col-lg-3 col-6">
                 <!-- small box -->
                 <div class="small-box bg-info">
                     <div class="inner">
                         <h3>150</h3>

                         <p>Productos</p>
                     </div>
                     <div class="icon">
                         <i class="ion ion-android-cart"></i>
                     </div>
                 </div>
             </div>
             <div class="col-lg-3 col-6">
                 <!-- small box -->
                 <div class="small-box bg-info">
                     <div class="inner">
                         <h3>12502</h3>

                         <p>Ventas</p>
                     </div>
                     <div class="icon">
                         <i class="ion ion-bag"></i>
                     </div>
                 </div>
             </div>
             <div class="col-lg-3 col-6">
                 <!-- small box -->
                 <div class="small-box bg-success">
                     <div class="inner">
                         <h3>15</h3>

                         <p>Clientes</p>
                     </div>
                     <div class="icon">
                         <i class="ion ion-android-contact"></i>
                     </div>
                 </div>
             </div>
             <div class="col-lg-3 col-6">
                 <!-- small box -->
                 <div class="small-box bg-warning">
                     <div class="inner">
                         <h3>$<span>12502</span></h3>

                         <p>Balance Cuentas Corriente</p>
                     </div>
                     <div class="icon">
                         <i class="ion ion-bag"></i>
                     </div>
                 </div>
             </div>
         </div>

         <div class="row">
             <div class="col-md-12">
                 <div class="card">
                     <div class="card-header">
                         <h3 class="card-title">Productos mas vendidos</h3>
                     </div>
                     <div class="card-body">
                         <table id="1" class="table table-bordered table-striped">
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Nombre</th>
                                     <th>Precio</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php 
									include 'includes/remito.php';
									$id_usuario = $_SESSION['id_usuario'];
									$clientes = ventastot($id_usuario, $mysqli);
									foreach($clientes as $name) {
										echo '<tr>
										<td><a href="?Seccion=remitofinal&remito='.$name[0].'&hash='.$name[1].'">'.$name[0].'</td>
										<td>'.$name[2].'</a></td>'.
                                        '<td>'.$name[3].'</td>'.
										'</tr>';
									}
								?>
                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
         </div>
         <div class="row">
             <div class="col-md-12">
                 <div class="card">
                     <div class="card-header">
                         <h3 class="card-title">Clientes con mas compras</h3>
                     </div>
                     <div class="card-body">
                         <table id="2" class="table table-bordered table-striped">
                             <thead>
                                 <tr>
                                     <th>ID</th>
                                     <th>Cliente</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php 
									//$clientes = ventastot($id_usuario, $mysqli);
									foreach($clientes as $name) {
										echo '<tr>
										<td><a href="?Seccion=remitofinal&remito='.$name[0].'&hash='.$name[1].'">'.$name[0].'</td>
										<td>'.$name[2].'</a></td>'.
										'</tr>';
									}
								?>
                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>

 <script>
$(document).ready(function() {
    $('#1').DataTable({
        responsive: true,
        language: {
            search: "Buscar:",
            info: "Mostrando _START_ a _END_ de _TOTAL_ entradas",
            zeroRecords: "No se encontraron resultados",
            infoEmpty: "Mostrando 0 de 0 de 0 entradas",
            lengthMenu: "Mostrar _MENU_ entradas",
            infoFiltered: "(filtrado de _MAX_ total entradas)",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });
});
$(document).ready(function() {
    $('#2').DataTable({
        responsive: true,
        language: {
            search: "Buscar:",
            info: "Mostrando _START_ a _END_ de _TOTAL_ entradas",
            zeroRecords: "No se encontraron resultados",
            infoEmpty: "Mostrando 0 de 0 de 0 entradas",
            lengthMenu: "Mostrar _MENU_ entradas",
            infoFiltered: "(filtrado de _MAX_ total entradas)",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });
});
 </script>