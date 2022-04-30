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
                       <li class="breadcrumb-item"><a href="#">Productos</a></li>
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
               Aqui se encuentran todos los productos, haz click en Eliminar para borrarlo.
           </div>

           <div class="row">
               <div class="col-md-12">
                   <div class="card">
                       <div class="card-header">
                           <h3 class="card-title">Productos</h3>
                       </div>

                       <div class="card-body">
                           <table id="example1" class="table table-bordered table-striped">
                               <thead>
                                   <tr>
                                       <th>#</th>
                                       <th>Nombre</th>
                                       <th>Valor</th>
                                       <th>Codigo</th>
                                       <th>Eliminar</th>
                                   </tr>
                               </thead>
                               <tbody>
                                   <?php 
									include 'includes/funciones.php';
									$id_usuario = $_SESSION['id_usuario'];
									$clientes = totalproductos($id_usuario, $mysqli);
									foreach($clientes as $name) {
										echo '<tr>
										<td>'.$name[0].'</td>
										<td class="'.$name[0].'" value="'.$name[1].'">'.$name[1].'</a></td>'.
                                        '<td>$'.number_format($name[2],2).'</td>'.
                                        '<td>'.$name[3].'</td>'.
                                        '<td>
                                        <button class="btn btn-danger" id="'.$name[0].'" onclick="eliminar(this)" >Eliminar</button>
                                        </td>'.
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
   <script>
//const cards = document.getElementById('cards')
function eliminar(btn) {

    var nombre1 = document.getElementsByClassName(btn.id);
    //console.log(btn.id);
    if (btn.id.length == 0) {
        console.log('Error raro...')

    } else {
        Notiflix.Confirm.show(
            'Aviso',
            'Estas por eliminar el producto ' + (nombre1[0].firstChild).data + ', estas seguro?',
            'Si',
            'No',
            function si() {
                location.href = ('#');
                $.ajax({
                    type: 'POST',
                    url: 'Inyector.php',
                    data: {
                        Archivo: 'ajax.php',
                        Tipo: 'eliminar',
                        id: btn.id,
                    },
                    dataType: 'html',
                    success: function(data) {
                        var Resultad = JSON.parse(data);
                        //console.log(Resultado.success)
                        if (Resultad.error) {
                            Notiflix.Notify.Failure(Resultad.error);
                            return;
                        }
                        if (Resultad.success){
                            window.location.reload();
                        }
                    }
                })
            },
            function no() {
                return
            },
        )
    }
}
   </script>