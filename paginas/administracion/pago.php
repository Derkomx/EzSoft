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
                        <h1>Recibo</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Recibo</li>
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
                            Esto es solamente un comprobante de pago.
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
                                                $nremito = 0;
                                                $client = $_GET['hash'];
                                                $vend = $_SESSION['id_usuario'];
                                                $fecha = date("d-m-Y"); 
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
                                        Para
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
                                        <b>Recibo N° <?php echo $nremito; ?></b><br>
                                        <br>
                                        <b>Fecha de Recibo: <?php echo $fecha; ?></b> <br>
                                    </div>
                                    <!-- /.col -->
                                </div>

                                <div class="row">
                                    <!-- /.col -->
                                    <div class="col">

                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <?php 
                                                        
                                                        $subtotal = cuentacte($client, $mysqli);
                                                        ?>
                                                    <th style="width:50%">Saldo cuenta Corriente: $</th>
                                                    <td id="sub">$<?php echo number_format($subtotal,2);?></td>
                                                </tr>
                                                <tr>
                                                    <th>Modo de Pago:</th>
                                                    <td><select name="metodo" id="metodo">
                                                        <option value="EFECTIVO">EFECTIVO</option>
                                                        <option value="TRANSFERENCIA">TRANSFERENCIA</option>
                                                        <option value="CHEQUE">CHEQUE</option>
                                                    </select></td>
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

<script src="librerias/notiflix3.2.5/dist/notiflix-confirm-aio-3.2.5.min.js"></script>
<script>
function aceptar(elemento) {
    var hash = <?php echo $client; ?>;
    var metodo = document.getElementById("metodo").value;
    Notiflix.Confirm.prompt(
        'PAGO',
        'Va a realizar un pago mediante ' + metodo + ' por el valor de:',
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
                    Tipo: 'nuevopago',
                    metodo: metodo,
                    hash: hash,
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
                        location.href = ('?Seccion=pagofinal&recibo=' + Resultado.success + '&hash=' +
                            hash);
                    }
                }
            })
        },
        function cancelo() {
           
        }, )
}
</script>