 <?php
 include 'includes/remito.php';
 $id_usuario = $_SESSION['id_usuario'];
 ?>
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
                         <?php
                         $cantprod = cantprod($id_usuario, $mysqli);
                         ?>
                         <h3><?php echo $cantprod; ?></h3>

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
                        <?php
                         $cantvent = cantventas($id_usuario, $mysqli);
                         ?>
                         <h3><?php echo $cantvent; ?></h3>

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
                        <?php
                         $cantclientes = cantclientes($id_usuario, $mysqli);
                         ?>
                         <h3><?php echo $cantclientes; ?></h3>

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
                     <?php
                         $balancecuentas = balancecuentas($id_usuario, $mysqli);
                         ?>
                         <h3>$<?php echo $balancecuentas; ?></h3>

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
                                     <th>Cantidad Vendida</th>
                                     <th>Nombre</th>
                                     <th>Precio</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php 
                                    $productos = [];
                                    $productos = prodmasvend($id_usuario, $mysqli);
									foreach($productos as $name2) {
										echo '<tr>
										<td>'.$name2[3].'</td>
										<td>'.$name2[1].'</a></td>'.
                                        '<td>$'.number_format($name2[2],2).'</td>'.
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
                                     <th>Cantidad de Compras</th>
                                     <th>Cliente</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php 
									$clientes = clientesmascompras($id_usuario, $mysqli);
									foreach($clientes as $name) {
										echo '<tr>
										<td>'.$name[0].'</td>
										<td>'.$name[1].'</a></td>'.
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