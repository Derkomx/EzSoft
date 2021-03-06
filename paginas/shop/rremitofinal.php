<head>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

</head>
<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="media/logo.png" alt="Ez - Soft" height="60" width="60">
</div>
<!--<body class="hold-transition sidebar-mini">-->
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
                                <div class="row justify-content-md-center">
                                    <h1>X</h1>
                                </div>
                                <div class="p-5  row justify-content-md-center">
                                    <i></i> DOCUMENTO NO VALIDO COMO FACTURA
                                </div>
                                <!-- title row -->
                                <div class="row">
                                    <div class="col-12">
                                        <h4>
                                            <!--<i class="fas fa-globe"></i> Recibo by Ez-Soft-->
                                            <?php
                                                include 'includes/funciones.php';
                                                $nremito = $_GET['remito'];
                                                $client = $_GET['hash'];
                                                $vend = 1;
                                                $fecha = fecharemito($nremito, $mysqli); 
                                                ?>
                                            <small class="float-right">Fecha: <?php echo $fecha; ?></small>
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
                                                $vendedor = datosvendedor($vend, $mysqli);
                                                ?>
                                            <strong><?php echo $vendedor[0];?></strong><br>
                                            <?php echo $vendedor[1];?><br>
                                            <?php echo $vendedor[2];?>, <?php echo $vendedor[3];?><br>
                                            <?php echo $vendedor[4];?><br>
                                            <?php echo $vendedor[5];?>
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">
                                        Para
                                        <address>
                                            <?php
                                                $cliente = [];
                                                $cliente = datoscliente($client, $vend, $mysqli);                                                
                                                ?>
                                            <strong><?php echo $cliente[0];?></strong><br>
                                            <?php echo $cliente[1];?><br>
                                            <?php echo $cliente[2];?>, <?php echo $cliente[3];?><br>
                                            <?php echo $cliente[4];?><br>
                                            <?php echo $cliente[5];?>
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">
                                        <b>Recibo N?? <?php echo $nremito; ?></b><br>
                                        <br>


                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- Table row -->
                                <div class="p-4 row">
                                    <div class="col-xs 12 table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Cantidad</th>
                                                    <th>Producto</th>

                                                    <th>Precio Unitario</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                        $productos = [];
                                                        $productos = prodenremito($nremito, $mysqli);
                                                            foreach($productos as $ID) {                                                                                                                      
                                                                echo    '<tr>'.
                                                                        '<td>'.$ID[1].'</td>'.
                                                                        '<td>'.$ID[4].'</td>'.
                                                                        
                                                                        '<td>$'.number_format($ID[2],2).'</td>'.
                                                                        '<td>$'.number_format($ID[3],2).'</td>'.
                                                                        '</tr>';
                                                            }
                                                        ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <div class="p-5 row">
                                    <!-- /.col -->
                                    <div class="col">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <?php 
                                                        $datos=[];
                                                        $datos = subtotal($nremito, $mysqli);
                                                        $datos2 = [];
                                                        $datos2 = ctacliente($client, $nremito, $mysqli);
                                                        ?>
                                                    <th style="width:50%">Subtotal:</th>
                                                    <td>$<?php echo number_format($datos[0],2); ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Descuento:</th>
                                                    <td>$<?php echo number_format($datos[1],2);?></td>
                                                </tr>
                                                <tr>
                                                    <th>Total:</th>
                                                    <td>$<?php echo number_format($datos[2],2);?></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th>Abonado:</th>
                                                    <td>$<?php echo number_format($datos2[0],2);?></td>
                                                </tr>
                                                <tr>
                                                    <th>Metodo de Pago:</th>
                                                    <td><?php echo $datos2[1];?></td>
                                                </tr>
                                                <tr>
                                                    <th>Saldo Cuenta Corriente:</th>
                                                    <td>$<?php echo number_format($datos2[2],2);?></td>
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
                                <button id="BTNTICKET" type="button" class="btn btn-info float-left">Ticket</button>
                                <button id="BTNACEPTAR" type="button" class="btn btn-success float-right">
                                    Descargar
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
<!-- /.control-sidebar -->
</div>
<section id="R_T" hidden>
    <div class="ticket">
        <p class="centrado">X
            <br>DOCUMENTO NO VALIDO COMO FACTURA
        </p>
        <p class="centrado"><?php echo $vendedor[0];?>
            <br> <?php echo $vendedor[2];?>, <?php echo $vendedor[3];?>
            <br><?php echo $fecha; ?>
        </p>
        <table>
            <thead>
                <tr>
                    <th class="cantidad">Cant.</th>
                    <th class="producto">Producto</th>
                    <th class="precio">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($productos as $ID) {                                                                                                                      
                    echo    '<tr>'.
                            '<td class="cantidad">'.$ID[1].'</td>'.
                            '<td class="producto">'.$ID[4].'</td>'.                                                                        
                            '<td class="precio">$'.number_format($ID[3],2).'</td>'.
                            '</tr>';
                }
            ?>
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                    <th class="cantidad2">Subtotal:</th>
                    <th class="producto2">$<?php echo number_format($datos[0],2); ?></th>
                </tr>
            </thead>
        </table>
        <table>
            <thead>
                <tr>
                    <th class="cantidad2">Descuento:</th>
                    <th class="producto2">$<?php echo number_format($datos[1],2);?></th>
                </tr>
            </thead>
        </table>
        <table>
            <thead>
                <tr>
                    <th class="cantidad2">Total:</th>
                    <th class="producto2">$<?php echo number_format($datos[2],2);?></th>
                </tr>
            </thead>
        </table>
        <p class="centrado">??GRACIAS POR SU COMPRA!
            <br>EZ-SOFT
        </p>
    </div>
</section>
<!-- ./wrapper -->
<script>
document.querySelector("#BTNTICKET").addEventListener("click", function() {
    var div = document.querySelector("#R_T");

    imprimirElemento2(div);
});
</script>
<script>
function imprimirElemento2(elemento) {
    var ventana = window.open('', '', 'height=800px,width=600px resizable=yes');
    ventana.document.write('<html><head><title>' + <?php echo $nremito ?> + '</title>');
    ventana.document.write('<link rel="stylesheet" href="CSS/ticket.css">');
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

<script>
document.querySelector("#BTNACEPTAR").addEventListener("click", function() {
    var div = document.querySelector("#R_X");

    imprimirElemento(div);
});
</script>
<script>
function imprimirElemento(elemento) {
    var ventana = window.open('', '', 'height=800px,width=600px resizable=yes');
    ventana.document.write('<html><head><title>' + <?php echo $nremito ?> + '</title>');
    ventana.document.write('<link rel="stylesheet" href="librerias/lte/css/adminlte.min.css">');
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