<?php
include('modulos/encabezado_user_admin.php');

// cuenta cantidad de patinadores Activos, que estan en lista de buena fe
$sql = "SELECT buenafe.dnibuenafe FROM buenafe GROUP BY buenafe.dnibuenafe";
if ($result = mysqli_query($conexion, $sql)) {
  $patinadoresBuenaFe = mysqli_num_rows($result);
}

// patinadores incriptos en cada torneo
$sql = "SELECT torneo, COUNT(dnibuenafe) AS cantidad FROM buenafe GROUP BY torneo";
$result_0 = mysqli_query($conexion, $sql);

// cuenta cantidad de CLUBS cargados como activos
$sql = "SELECT clubs.cuit FROM clubs WHERE clubs.institucion<>'LEPAA' GROUP BY clubs.cuit";
if ($result = mysqli_query($conexion, $sql)) {
  $clubsActivos = mysqli_num_rows($result);
}

$sql = "SELECT clubs.tipoafiliacion, COUNT(clubs.institucion) AS cantidad FROM clubs WHERE clubs.institucion<>'LEPAA' GROUP BY clubs.tipoafiliacion";
$result_1 = mysqli_query($conexion, $sql);

// Cuenta los tipo de licencias empadronadas - SOLO LEPAA
$sql = "SELECT patinadores.dnipatinador, clubs.tipoafiliacion FROM patinadores, clubs WHERE patinadores.cuit=clubs.cuit AND clubs.tipoafiliacion<>'AFILIADO-RIO' AND clubs.tipoafiliacion<>'INVITADO' GROUP BY patinadores.dnipatinador";
if ($result = mysqli_query($conexion, $sql)) {
  $patinadoresEmpadronados = mysqli_num_rows($result);
}

$sql = "SELECT patinadores.tipolicencia, COUNT(patinadores.dnipatinador) AS cantidad FROM patinadores, clubs WHERE patinadores.cuit=clubs.cuit AND clubs.tipoafiliacion<>'AFILIADO-RIO' AND clubs.tipoafiliacion<>'INVITADO' GROUP BY patinadores.tipolicencia
";
$result_2 = mysqli_query($conexion, $sql);

// Cuenta los tipo de licencias empadronadas - NO LEPAA
$sql = "SELECT patinadores.dnipatinador, clubs.tipoafiliacion FROM patinadores, clubs WHERE patinadores.cuit=clubs.cuit AND (clubs.tipoafiliacion='AFILIADO-RIO' OR clubs.tipoafiliacion='INVITADO') GROUP BY patinadores.dnipatinador";
if ($result = mysqli_query($conexion, $sql)) {
  $patinadoresEmpadronadosNL = mysqli_num_rows($result);
}

$sql = "SELECT patinadores.tipolicencia, COUNT(patinadores.dnipatinador) AS cantidad FROM patinadores, clubs WHERE patinadores.cuit=clubs.cuit AND (clubs.tipoafiliacion='AFILIADO-RIO' OR clubs.tipoafiliacion='INVITADO') GROUP BY patinadores.tipolicencia
";
$result_3 = mysqli_query($conexion, $sql);

// cierra conexion
mysqli_close($conexion);
?>

<!-- Fin PHP -->


<!DOCTYPE html>
<html lang="es">

<head>
  <!-- Meta -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="" />
  <meta name="keywords" content="" />

  <meta http-equiv="Expires" content="0" />
  <meta http-equiv="Last-Modified" content="0" />
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate" />
  <meta http-equiv="Pragma" content="no-cache" />
  <!-- Boostrap Style -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Favicon icon -->
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon" />
  <!-- vendor css -->
  <link rel="stylesheet" href="assets/css/styles.css" />
  <link rel="stylesheet" href="assets/css/stylesplus.css" />
  <!-- Boostrap Style -->
  <!-- <link rel="stylesheet" href="assets/css/plugins/bootstrap.min.css"> -->
  <!-- fontawesome PRO -->
  <script src="fw_pro.js" crossorigin="anonymous"></script>
  <!-- DataTable -->
  <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css" rel="stylesheet" />
  <!-- Sweet Alert2 -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="shortcut icon" href="assets/logoDataSkt.png">
  <title>DATA SKATE - Home</title>
</head>


<style>
  .card {
    backdrop-filter: blur(5px);
  }

  @media screen and (max-width: 1360px) {
    span {
      font-size: 10px;
    }
  }
</style>

<body class="">

  <!-- [ Header ] start -->
  <?php include('modulos/header.php') ?>
  <!-- [ Header ] end -->

  <!-- [ navigation menu ] start -->
  <?php include('modulos/navmenu.php') ?>
  <!-- [ navigation menu ] end -->

  <!-- LOGOUT MPODAL-->
  <?php include('modulos/logout.php'); ?>
  <!-- End LOGOUT -->




  <!-- [ Main Content ] start -->
  <div class="pcoded-main-container container-home">
    <h1 class="mb-2 text-center">DATA SKATE</h1>
    <div class="pcoded-content">

      <!-- Patinadores activos -->
      <div class="col-xl-3">
        <div class="card flat-card badge-light-success shadow">
          <div class="row-table">
            <div class="col-sm-3 card-body text-green">
              <i class="fas fa-trophy"></i>
            </div>
            <div class="col-sm-9">
              <h4 class="text-c-blue num" data-val="<?php echo  $patinadoresBuenaFe ?>">0</h4>
              <h6 class="text-c-blue">Patinadores activos</h6>
            </div>
          </div>
        </div>
      </div>

      <!-- Patinadores inscriptos por torneo -->
      <div class="col-xl-12">
        <div class="card flat-card badge-light-success shadow">
          <div class="card-body text-green">
            <div class="row text-center">
              <?php
              if (mysqli_num_rows($result_0) > 0) {
                foreach ($result_0 as $inscriptos) {
              ?>
                  <div class="col">
                    <h4 class="m-0 text-c-blue num" data-val="<?php echo $inscriptos['cantidad'] ?>">0</h4>
                    <span class="text-c-blue"><?php echo $inscriptos['torneo']; ?></span>
                  </div>
              <?php
                }
              }
              ?>
            </div>
          </div>
        </div>
      </div>

      <div class="d-flex justify-content-between">
        <!-- Patinadores Empadronados LEPAA-->
        <div class="col-xl-5">
          <div class="card support-bar badge-light-light shadow">
            <div class="card-body pb-0">
              <div>
                <h2 class="m-0 text-c-blue num" data-val="<?php echo  $patinadoresEmpadronados ?>">0</h2>
              </div>
              <span class="text-c-blue">Patinadores Empadronados</span>
            </div>
            <div id="support-chart"></div>
            <div class="card-footer bg-primary text-white">
              <div class="row text-center">
                <?php
                if (mysqli_num_rows($result_2) > 0) {
                  foreach ($result_2 as $tipolicencia) {
                ?>
                    <div class="col">
                      <h4 class="m-0 text-white num" data-val="<?php echo $tipolicencia['cantidad'] ?>">0</h4>
                      <span><?php echo $tipolicencia['tipolicencia']; ?></span>
                    </div>
                <?php
                  }
                }
                ?>
              </div>
            </div>
          </div>
        </div>

        <!-- Patinadores Empadronados NO LEPAA-->
        <div class="col-xl-5">
          <div class="card support-bar badge-light-light shadow">
            <div class="card-body pb-0">
              <div>
                <h2 class="m-0 text-c-blue num" data-val="<?php echo  $patinadoresEmpadronadosNL ?>">0</h2>
              </div>
              <span class="text-c-blue">Patinadores Empadronados - AFILIADOS</span>
            </div>
            <div id="support-chart"></div>
            <div class="card-footer bg-primary text-white">
              <div class="row text-center">
                <?php
                if (mysqli_num_rows($result_3) > 0) {
                  foreach ($result_3 as $tipolicencia) {
                ?>
                    <div class="col">
                      <h4 class="m-0 text-white num" data-val="<?php echo $tipolicencia['cantidad'] ?>">0</h4>
                      <span><?php echo $tipolicencia['tipolicencia']; ?></span>
                    </div>
                <?php
                  }
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Clbes Inscriptos -->
      <div class="col-xl-12">
        <div class="card support-bar badge-light-light shadow">
          <div class="card-body pb-0">
            <div>
              <h2 class="m-0 text-c-blue num" data-val="<?php echo  $clubsActivos ?>">0</h2>
            </div>
            <span class="text-c-blue">Clubes inscriptos</span>
          </div>
          <div id="support-chart"></div>
          <div class="card-footer bg-primary text-white">
            <div class="row text-center">
              <?php
              if (mysqli_num_rows($result_1) > 0) {
                foreach ($result_1 as $tipoafiliacion) {
              ?>
                  <div class="col">
                    <h4 class="m-0 text-white num" data-val="<?php echo $tipoafiliacion['cantidad'] ?>">0</h4>
                    <span><?php echo $tipoafiliacion['tipoafiliacion']; ?></span>
                  </div>
              <?php
                }
              }
              ?>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

  <!-- [ Main Content ] end -->


  <!-- Mensaje de error de Acceso a SYSTEM LEPA -->
  <?php if (!empty($_SESSION['mensajeAcceso'])) : ?>
    <?php if ($_SESSION['valorAcceso'] == 0) : ?>
      <p><?= '<script>Swal.fire("","' .  $_SESSION['mensajeAcceso'] . '","error");</script>'; ?></p>
      <?php $_SESSION['mensajeAcceso'] = '' ?>
    <?php endif; ?>
  <?php endif; ?>
  <!-- END de error de Acceso a SYSTEM LEPA -->

  <!-- Required Js -->
  <script src="assets/js/vendor-all.min.js"></script>
  <script src="assets/js/plugins/bootstrap.min.js"></script>
  <script src="assets/js/pcoded.min.js"></script>

  <script>
    function logoutModal() {
      $('#logoutModal').modal('show');
    }

    // animacion de numeros
    let valueDisplays = document.querySelectorAll(".num");
    let interval = 500; //velocidad de los numeros

    valueDisplays.forEach((valueDisplay) => {
      let startValue = 0;
      let endValue = parseInt(valueDisplay.getAttribute("data-val"));
      // console.log(endValue);
      if (endValue != 0) {
        let duration = Math.floor(interval / endValue);
        let counter = setInterval(function() {
          startValue += 1;
          valueDisplay.textContent = startValue;
          if (startValue == endValue) {
            clearInterval(counter);
          }
        }, duration);
      };
    });
  </script>
</body>

</html>