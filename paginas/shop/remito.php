<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>-Ez Soft-</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../librerias/lte/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Remito</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Remito</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="callout callout-info">
                                <h5><i class="fas fa-info"></i> Nota:</h5>
                                Esto es solamente un comprobante de entrega de un producto y no una Factura Fiscal.
                            </div>

                            <div id="R_X">
                                <!-- Main content -->
                                <div class="invoice p-3 mb-3">
                                    <!-- title row -->
                                    <div class="row">
                                        <div class="col-12">
                                            <h4>
                                                <i class="fas fa-globe"></i> Ez Soft
                                                <?php
                                                include '../../includes/remito.php'
                                                $nremito = $_GET['remito'];
                                                //$fecha = fecharemito(); 
                                                ?>
                                                <small class="float-right">Fecha: 2/10/2014</small>
                                            </h4>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- info row -->
                                    <div class="row invoice-info">
                                        <div class="col-sm-4 invoice-col">
                                            De:
                                            <address>
                                                <?php 
                                                $vendedor = [];
                                                //$vendedor = datosvendedor();
                                                ?>
                                                <strong>Nombre Vendedor</strong><br>
                                                Direccion<br>
                                                Provincia, Codigo Postal<br>
                                                Telefono<br>
                                                Email
                                            </address>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 invoice-col">
                                            Para
                                            <address>
                                                <?php
                                                $cliente = [];
                                                //$cliente = datoscliente();                                                
                                                ?>
                                                <strong>nombre del que se le vendio</strong><br>
                                            </address>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 invoice-col">
                                            <b>Remito N° <?php echo $nremito; ?></b><br>
                                            <br>
                                            <b>Fecha de Pago: <?php //echo $fecha; ?></b> <br>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                    <!-- Table row -->
                                    <div class="row">
                                        <div class="col-12 table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Cantidad</th>
                                                        <th>Producto</th>
                                                        <th>Codigo de Producto</th>
                                                        <th>Description</th>
                                                        <th>Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <?php
                                                        $productos = [];
                                                        $productos = prodenremito($nremito);
                                                        
                                                            foreach($productos as $ID) {
                                                                $HTML = file_get_contents('Publicaciones/HTML/'.$ID[0].'.html');

                                                                echo '<div class="row pb-4">'.
                                                                    '<div class="col-md-5">'.
                                                                        '<div class="fh5co_hover_news_img">'.
                                                                            '<div class="fh5co_news_img"><img src="Publicaciones/Preview/'.$ID[0].'.jpeg" alt=""/></div>'.
                                                                            '<div></div>'.
                                                                        '</div>'.
                                                                    '</div>'.
                                                                    '<div class="col-md-7 animate-box">'.
                                                                        '<a href="?Seccion=VerPublicacion&Publicacion='.$ID[0].'" class="fh5co_magna py-2">'.$ID[1].'</a> <a href="?Seccion=VerPublicacion&Publicacion='.$ID[0].'" class="fh5co_mini_time py-3">'.$ID[2].'</a>
                                                                        <div class="fh5co_consectetur">
                                                                            '.substr(strip_tags($HTML, '<br>'), 0, 256).'...
                                                                        </div>
                                                                    </div>
                                                                </div>';
                                                            }
                                                        ?>
                                                        <td>1</td>
                                                        <td>Tintura Roja marca random</td>
                                                        <td>43</td>
                                                        <td> Te deja el pelo rojo </td>
                                                        <td>$1500</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                    <div class="row">
                                        <!-- /.col -->
                                        <div class="col-6">
                                            <p class="lead">Fecha de presupuesto: <?php //echo $fecha; ?></p>

                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <?php 
                                                        //$subtotal = subtotal();
                                                        ?>
                                                        <th style="width:50%">Subtotal:</th>
                                                        <td><?php //echo $subtotal; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Descuento:</th>
                                                        <td><input>%?</input></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total:</th>
                                                        <td>$250.30</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                            </div>
                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
                                <div class="col-12">
                                    <button id="BTNACEPTAR" type="button" class="btn btn-success float-right"><i
                                            class="far fa-credit-card"></i>
                                        Aceptar
                                    </button>
                                </div>
                            </div>
                            <!-- /.invoice -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- /.container-fluid -->
            </section>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        Copyright &copy; 2022 <a href="">Ez-Soft</a>.
        <div class="float-right d-none d-sm-inline-block">
            <b> Ver.</b> 1.0.0
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../../librerias/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../librerias/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../librerias/lte/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../lbirerias/lte/js/demo.js"></script>
    <script>
    document.querySelector("#BTNACEPTAR").addEventListener("click", function() {
        var div = document.querySelector("#R_X");
        imprimirElemento(div);
    });
    </script>
    <script>
    function imprimirElemento(elemento) {
        var ventana = window.open('', '', 'height=600,width=800 resizable=yes');
        ventana.document.write('<html><head><title>' + document.title + '</title>');
        ventana.document.write('<link rel="stylesheet" href="../../librerias/lte/css/adminlte.min.css">');
        ventana.document.write('</head><body >');
        ventana.document.write(elemento.innerHTML);
        ventana.document.write('</body></html>');
        ventana.document.close();
        ventana.onload = function() {
            ventana.print();

        };
        return true;
    }
    </script>
</body>

</html>