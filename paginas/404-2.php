  <!-- Preloader -->

  <script>
Notiflix.Report.Failure(
        'Atencion',
        'Para ingresar al sistema debe abonar la cuota del mismo, valor USD$12 o su equivalente en moneda local <br/><br/>-Ez Soft',
        'Aceptar',
        function ok() {
            location.href = ('includes/Logout.php');
            },
        )
  </script>