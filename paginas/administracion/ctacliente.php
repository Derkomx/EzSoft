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
                       <li class="breadcrumb-item"><a href="#">Cuenta de Cliente</a></li>
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
               Movimiento de la cuenta del cliente.
           </div>

           <div class="row">
               <div class="col-md-12">
                   <div class="card">
                       <div class="card-header">
                           <h3 class="card-title">Cuentas Corrientes</h3>
                       </div>

                       <div class="card-body">
                           <table id="example1" class="table table-bordered table-striped">
                               <thead>
                                   <tr>
                                       <th>Movimiento</th>
                                       <th>Monto</th>
                                       <th>Fecha</th>
                                   </tr>
                               </thead>
                               <tbody>
                                   <?php 
									include 'includes/remito.php';
									$cliente = $_GET['hash'];
									$clientes = climovimientos($cliente, $mysqli);
									foreach($clientes as $name) {
										echo '<tr>'.
										'<td>'.$name[0].'</td>'.
										'<td>$'.$name[1].'</td>'.
                                        '<td>'.$name[2].'</td>'.
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
    $('#example1').DataTable({
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