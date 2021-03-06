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
                    <li class="breadcrumb-item"><a href="#">Venta</a></li>
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
            Selecciona un cliente de la lista para poder generar una venta a el mismo.
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Clientes</h3>
                    </div>

                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Cliente</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
									include 'includes/funciones.php';
									$id_usuario = $_SESSION['id_usuario'];
									$clientes = todosclientes($id_usuario, $mysqli);
									//href="?Seccion=productos&hash='.$name[0].'"
									foreach($clientes as $name) {
										echo '<tr>
										<td>'.$name[0].'</td>
										<td class = "seleccionar"><u>'.$name[1].'</u></td>'.
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
                "last": "??ltimo",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });
});
</script>
<script>

$(document).ready(function() { //Espera a que el documento este listo
    $(".seleccionar").click(function(evento) { //selecciono el td que tenga de nombre de clase "editar"
        var id_producto = $(this).prev(); //obtengo la celda previa de donde se hizo click
        var nombre = $(this);

        Notiflix.Confirm.show(
            'Aviso',
            'Estas por vender a ' + nombre.html() +
            ', elige el modo de visualizacion de tus productos',
            'Catalogo',
            'Tabla',
            function catalogo() {
                location.href = ('?Seccion=productoscatalogo&hash=' + id_producto.html());
            },
            function tabla() {
                location.href = ('?Seccion=productostabla&hash=' + id_producto.html());
            },
        )
        
    })
})
</script>