<!DOCTYPE html>
<html lang="es">

<head>
  <!-- Meta -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <meta name="author" content="Phoenixcoded" />
  <!-- Favicon icon -->
  <!-- <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon" /> -->
  <!-- vendor css -->
  <link rel="stylesheet" href="assets/css/styles.css" />
  <!-- AOS -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <!-- Sweet Alert2 -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="shortcut icon" href="assets/logoDataSkt.png">
  <title>DATA SKATE</title>
</head>

<style>
  .fixed-button {
    display: none;
  }

  .auth-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    min-width: 100%;
    min-height: 100vh;
    background: #d6d8d9;
    /* background-image: url(assets/vector02.jpg);
    background-size: cover;
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat; */
  }

  .card {
    box-shadow: 2px 2px 10px rgb(165, 165, 165);
  }
</style>

<body>
  <!-- [ auth-signin ] start -->
  <div class="auth-wrapper flex">
    <h1>DATA SKATE</h1>
  </div>
  <!-- [ auth-signin ] end -->



  <!-- Required Js -->
  <script src="assets/js/vendor-all.min.js"></script>
  <script src="assets/js/plugins/bootstrap.min.js"></script>
  <script src="assets/js/pcoded.min.js"></script>
  <!-- AOS -->

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

  <script>
    Swal.fire({
      title: "DISCULPAS!!",
      text: "En estos momentos estamos actualizando el sitio, intente ingresar mas tarde!",
      icon: "warning"
    });
  </script>

</body>

</html>