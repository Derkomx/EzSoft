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
                                <!-- title row -->
                                <div class="row">
                                    <div class="col-12">
                                        <h4>
                                            <i class="fas fa-globe"></i> Ez Soft
                                            <?php
                                                include 'includes/remito.php';
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
                                        <b>Remito N° <?php echo $nremito; ?></b><br>
                                        <br>
                                        <b>Fecha de Pago: <?php echo $fecha; ?></b> <br>
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
                                                    <th>Previo Unidad</th>
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
                                                                        '<td>'.$ID[0].'</td>'.
                                                                        '<td>$'.$ID[2].'</td>'.
                                                                        '<td>$'.$ID[3].'</td>'.
                                                                        '</tr>';
                                                            }
                                                        ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <div class="row">
                                    <!-- /.col -->
                                    <div class="col">
                                        <p class="lead">Fecha de presupuesto: <?php echo $fecha; ?></p>

                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <?php 
                                                        $subtotal=[];
                                                        $subtotal = subtotal($nremito, $mysqli);
                                                        ?>
                                                    <th style="width:50%">Subtotal: $</th>
                                                    <td id="sub">$<?php echo $subtotal[0];?></td>
                                                </tr>
                                                <tr>
                                                    <th>Descuento:</th>
                                                    <td>$<input id="desc" onchange="calcu()" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <th>Total:</th>
                                                    <td id="td">$<?php echo $subtotal[0]; ?></td>
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
                                <button onclick="aceptar()" type="button" class="btn btn-success float-right"><i
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
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script>
function calcu() {
    var desc = document.getElementById("desc").value;
    var sub2 = document.getElementById("sub").innerText;
    var sub = parseInt(sub2.replace('$', ''))
    var calc = '$' + (sub - desc);
    document.getElementById("td").innerHTML = calc;
}
</script>
<script src="librerias/notiflix3.2.5/dist/notiflix-confirm-aio-3.2.5.min.js"></script>
<script>
function aceptar(elemento) {
    var tot = document.getElementById("td").innerText;
    var total = parseInt(tot.replace('$', ''))
    var nremito = <?php echo $nremito;?>;
    var hash = <?php echo $client;?>;
    var descuento = document.getElementById("desc").value;
    Notiflix.Confirm.prompt(
        'PAGO',
        'El total a abonar es de ' + tot + ', ingrese lo que abonara y presione Aceptar',
        '',
        'Aceptar',
        'Cancelar',
        function acepto(acepto) {
            var pago = acepto;
            $.ajax({
                type: 'POST',
                url: 'Inyector.php',
                data: {
                    Archivo: 'productos2.php',
                    Tipo: 'remito2',
                    remito: nremito,
                    hash: hash,
                    descuento: descuento,
                    total: total,
                    pago: pago
                },
                dataType: 'html',
                success: function(data) {
                    var Resultado = JSON.parse(data);
                    Notiflix.Loading.Remove();

                    if (Resultado.error) {
                        Notiflix.Notify.Failure(Resultado.error);
                        return;

                    }
                    if (Resultado.success) {
                        /////////////////////////////////////////////
                        location.href = ('?Seccion=remitofinal&remito=' + Resultado.success + '&hash=' +
                            hash);
                    }
                }
            })
        },
        function cancelo() {
            $.ajax({
                type: 'POST',
                url: 'Inyector.php',
                data: {
                    Archivo: 'productos2.php',
                    Tipo: 'cancelaremito',
                    remito: nremito,
                    hash: hash,
                },
                dataType: 'html',
                success: function(data) {
                    var Resultado = JSON.parse(data);
                    Notiflix.Loading.Remove();

                    if (Resultado.error) {
                        Notiflix.Notify.Failure(Resultado.error);
                        return;

                    }
                    if (Resultado.success) {
                        /////////////////////////////////////////////
                        location.href = ('?Seccion=carrito');
                    }
                }
            })
        }, )
}
</script>
<!--</body>-->
<?php
    //<!-- Font Awesome -->
    //<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    //<!-- Theme style -->
    //<link rel="stylesheet" href="librerias/lte/css/adminlte.min.css">




    ////////////////////////////////////////////



    //<!-- jQuery -->
    //<script src="librerias/jquery/jquery.min.js"></script>
    //<!-- Bootstrap 4 -->
    //<script src="librerias/bootstrap/js/bootstrap.bundle.min.js"></script>
    //<!-- AdminLTE App -->
    //<script src="librerias/lte/js/adminlte.min.js"></script>
    //<!-- AdminLTE for demo purposes -->
    //<script src="lbirerias/lte/js/demo.js"></script>

?>