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
			Total de los Remitos emitidos, si quiere visualizar uno, haz click en su ID.
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Remitos</h3>
					</div>

					<div class="card-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>ID remito</th>
									<th>Cliente</th>
                                    <th>Fecha</th>
                                    <th>total</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									include 'includes/remito.php';
									$id_usuario = 1;
									$clientes = ventastot($id_usuario, $mysqli);
									foreach($clientes as $name) {
										echo '<tr>
										<td><a href="?Seccion=remitofinal&remito='.$name[0].'&hash='.$name[1].'">'.$name[0].'</td>
										<td>'.$name[2].'</a></td>'.
                                        '<td>'.$name[3].'</td>'.
                                        '<td>$'.$name[4].'</td>'.
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
				search:         "Buscar:",
				info:           "Mostrando _START_ a _END_ de _TOTAL_ entradas",
				zeroRecords:    "No se encontraron resultados",
				infoEmpty:      "Mostrando 0 de 0 de 0 entradas",
				lengthMenu:     "Mostrar _MENU_ entradas",
				infoFiltered:   "(filtrado de _MAX_ total entradas)",
				"paginate": {
					"first":      "Primero",
					"last":       "Último",
					"next":       "Siguiente",
					"previous":   "Anterior"
				},
			}
		});
    });
</script>
