<?php
if($_SESSION['nivel'] == 9){
include 'includes/funcionesroot.php';
$tabla = $_GET['id'];
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
                    <li class="breadcrumb-item"><a href="#">ROOT</a></li>
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
            Solo vista.
        </div>
        <div class="form">
            <h2 aligncenter>Tablas</h2>
            <div class="input-group mb-0">
                <select name="select" onchange="aceptar()" id="tabla">
                    <option value="">SELECCIONE</option>
                    <option value="cierredia">cierredia</option>
                    <option value="clientes">clientes</option>
                    <option value="cuentaclientes">cuentaclientes</option>
                    <option value="intentos_logueo">intentos_logueo</option>
                    <option value="menu">menu</option>
                    <option value="movcuentaclientes">movcuentaclientes</option>
                    <option value="products">products</option>
                    <option value="prodvend">prodvend</option>
                    <option value="recibo">recibo</option>
                    <option value="remitos">remitos</option>
                    <option value="usuarios">usuarios</option>
                    <option value="usuarios2">usuarios2</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <?PHP ECHO $tabla;?>
                        </h3>
                    </div>

                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <?php
                                    $columna = columnastabla($tabla, $mysqli);
                                    foreach($columna as $col){
                                    echo
                                    '<th>'.$col[0].'</th>';
                                    }
                                    ?>

                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                    
                                    $queryy = mysqli_query($mysqli, "SELECT * FROM $tabla");


                                    if (!$queryy){
                                       die('Error: ' . mysqli_error($mysqli));
                                    }
                                    if(mysqli_num_rows($queryy) > 0){
                                       $response='success';
                                    } 
                                
                                    $column=mysqli_num_fields($queryy);
                                //echo "<table>"; // Creas la tabla
                                while ($row = mysqli_fetch_array($queryy)) {
                                    echo "<tr>"; // Por cada fila
                                    for ($i=0; $i < $column; $i++) {
                                        ?>
                                <td><?php echo $row[$i]; ?></td>
                                <?php
                                    }
                                    echo "</tr>";
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
<script>
function aceptar() {
    var select = document.getElementById('tabla');
    var value = select.options[select.selectedIndex].value;
    Notiflix.Confirm.ask(
        'ACCEDER A TABLA ' + value,
        'Introduzca la clave',
        'tablasroot',
        'Aceptar',
        'Cancel',
        function okCb() {
            location.href = ('?Seccion=tabla&id=' + value);
        },
        function cancelCb() {
            return
        }, {},
    );
}
</script>


<?php
}
?>