<?php include('modulos/encabezado_user_admin.php'); ?>

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
  <!-- vendor css -->
  <link rel="stylesheet" href="assets/css/styles.css" />
  <!-- CSS adicional - propio -->
  <link rel="stylesheet" href="assets/css/stylesplus.css" />
  <!-- fontawesome PRO -->
  <script src="fw_pro.js" crossorigin="anonymous"></script>
  <!-- DataTable -->
  <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" />
  <!-- Sweet Alert2 -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="shortcut icon" href="assets/logoDataSkt.png">
  <title>DATA SKATE - Usuarios</title>
</head>


<body class="">

  <!-- [ Header ] start -->
  <?php include('modulos/header.php'); ?>
  <!-- [ Header ] end -->

  <!-- [ navigation menu ] start -->
  <?php include('modulos/navmenu_tablas.php'); ?>
  <!-- [ navigation menu ] end -->

  <!-- LOGOUT MPODAL-->
  <?php include('modulos/logout.php'); ?>
  <!-- End LOGOUT -->

  <!-- [ Main Content ] start -->
  <div class="pcoded-main-container mt-4">
    <div class="text-center">
      <h1>Usuarios</h1>
    </div>
    <div class="col-lg-12">
      <div class="table-responsive">
        <table id="tablaClientes" class="display responsive nowrap compact table-bordered" style="width: 100%">
          <thead class="text-center">
            <tr>
              <th class="text-center">DNI</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Apellido</th>
              <th class="text-center">Email</th>
              <th class="text-center">Institucion</th>
              <th class="text-center">Acceso</th>
              <th class="text-center">Ingreso al Sistema</th>
              <th class="text-center">ID</th>
              <th class="text-center">Acciones</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->

  <!-- FROMULARIO MODAL CONSULTA/EDICION USUARIO -->
  <form class="modal fade" id="modalConsulta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Información Usuario</h4>
          <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="col-lg-12">
          <div class="form-group classid">
            <input name="id" type="number" class="form-control form-control-user ocultarID" id="consultarID" placeholder="id" />
          </div>
          <div class="form-group form-floating">
            <input name="dni" type="number" class="form-control form-control-user" id="consultarDni" placeholder="DNI" />
            <label for="floatingInput">DNI</label>
          </div>

          <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0 form-floating">
              <input name="nombre" type="text" class="form-control form-control-user" id="consultarFirstName" placeholder="Nombre" />
              <label for="floatingInput">Nombre</label>
            </div>
            <div class="col-sm-6 mb-3 form-floating">
              <input name="apellido" type="text" class="form-control form-control-user" id="consultarLastName" placeholder="Apellido" />
              <label class="ml-3" for="floatingInput">Apellido</label>
            </div>
            <div class="col-sm-12 mb-3 mb-sm-0 form-floating">
              <input name="email" type="email" class="form-control form-control-user" id="consultarEmail" placeholder="Email" required />
              <label class="ml-3" for="floatingInput">E-mail</label>
            </div>
          </div>

          <div class="form-group form-floating">
            <select name="cuit" class="form-select" id="consultarCuit">
              <?php //Completa el SELECT on los datos de la tabla CLUBS
              $select = mysqli_query($con, "SELECT * FROM clubs ORDER BY institucion");
              while ($clubs = mysqli_fetch_row($select)) {
              ?>
                <option value="<?php echo $clubs[1] ?>"><?php echo $clubs[2] ?></option>
              <?php } ?>
            </select>
            <label for="floatingSelect">Institucion</label>
          </div>

          <div class="form-group form-floating">
            <select name="acceso" class="form-select" id="consultarAcceso" required>
              <option value=""></option>
              <option value="tecnico">Tecnico</option>
              <option value="delegado">Delegado</option>
              <option value="administrador">Administrador</option>
              <option value="invitado">Invitado</option>
            </select>
            <label for="floatingSelect">Acceso</label>
          </div>

          <div class="form-group form-floating">
            <select name="estadoacceso" class="form-select" id="consultarEstadoAcceso" required>
              <option value=""></option>
              <option value="BLOQUEADO">BLOQUEADO</option>
              <option value="DESBLOQUEADO">DESBLOQUEADO</option>
            </select>
            <label for="floatingSelect">Estado</label>
          </div>

          <div>
            <label class="labelDatosAdicionales mb-0"><b>Alta:</b>
              <input name="datosAlta" type="text" class="datosAdicionales" id="datosAlta" disabled />
            </label>
            <label class="labelDatosAdicionales"><b>Ultima modificación:</b>
              <input name="datosMod" type="text" class="datosAdicionales" id="datosMod" disabled />
            </label>
          </div>

          <div class="ocultarInputOpcion">
            <input name="opcion" type="text" value="2">
          </div>

          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal" id="botonCancel">
              Cancelar
            </button>
            <button class="btn btn-primary btn-modificar" type="submit" id="botonAceptar">Aceptar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!-- END CONSULTA/EDICION USUARIO -->

  <!-- FROMULARIO MODAL ALTA USUARIOS -->
  <form class="modal fade" id="formAlta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Alta Usuario</h4>
          <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="col-lg-12">

          <div class="form-group form-floating mt-3">
            <input type="number" class="form-control form-control-user" id="altaDni" onchange="altaNuevo()" placeholder="DNI / Licencia" required />
            <label for="floatingInput">DNI / Licencia</label>
          </div>

          <div class="form-group form-floating mt-3">
            <input name="dni" type="number" class="form-control form-control-user" id="altaDni2" placeholder="ID" required />
            <label for="floatingInput">ID</label>
          </div>

          <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0 form-floating">
              <input name="nombre" type="text" class="form-control form-control-user inactivo" id="altaFirstName" placeholder="Nombre" required />
              <label class="ml-3" for="floatingInput">Nombre</label>
            </div>
            <div class="col-sm-6 mb-3 form-floating">
              <input name="apellido" type="text" class="form-control form-control-user inactivo" id="altaLastName" placeholder="Apellido" required />
              <label class="ml-3" for="floatingInput">Apellido</label>
            </div>

            <div class="col-sm-12 mb-3 mb-sm-0 form-floating">
              <input name="email" type="email" class="form-control form-control-user" id="altaEmail" placeholder="Email" required />
              <label class="ml-3" for="floatingInput">E-mail</label>
            </div>

          </div>

          <div class="form-group form-floating">
            <select name="cuit" class="form-select inactivo" id="altaCuit" required>
              <option value=""></option>
              <?php //Completa el SELECT on los datos de la tabla CLUBS
              $select = mysqli_query($con, "SELECT * FROM clubs ORDER BY institucion");
              while ($clubs = mysqli_fetch_row($select)) {
              ?>
                <option value="<?php echo $clubs[1] ?>"><?php echo $clubs[2] ?></option>
              <?php } ?>
            </select>
            <label for="floatingSelect">Institucion</label>
          </div>
          <div class="form-group form-floating">
            <select name="acceso" class="form-select" id="altaAcceso" required>
              <option value=""></option>
              <option value="tecnico">Tecnico</option>
              <option value="delegado">Delegado</option>
              <option value="administrador">Administrador</option>
              <option value="invitado">Invitado</option>
            </select>
            <label for="floatingSelect">Acceso</label>
          </div>

          <div class="form-group row">
            <div class="col-sm-6 form-floating">
              <input name="password" type="password" class="form-control form-control-user" id="altaInputPassword" placeholder="Password" onkeypress="validarInput(event)" required />
              <label class="ml-3" for="floatingInput">Password</label>
            </div>
            <div class="col-sm-6 form-floating">
              <input name="confirm_password" type="password" class="form-control form-control-user" id="altaRepeatPassword" placeholder="Repetir Password" onkeypress="validarInput(event)" required />
              <label class="ml-3" for="floatingInput">Repetir Password</label>
            </div>
            <div style="color: red;">No se permiten caracteres especiales como: "/?()*_:;-\... etc</div>
          </div>

          <div class="ocultarInputOpcion">
            <input name="opcion" type="text" value="4">
          </div>

          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal" id="botonCancel">
              Cancelar
            </button>
            <button class="btn btn-primary btn-alta" type="submit" id="botonAceptar">Aceptar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!-- FIN FROMULARIO MODAL ALTA USUARIOS -->

  <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
  <!-- Boostrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Required Js -->
  <script src="assets/js/vendor-all.min.js"></script>
  <script src="assets/js/plugins/bootstrap.min.js"></script>
  <script src="assets/js/pcoded.min.js"></script>

  <!-- Apex Chart -->
  <script src="assets/js/plugins/apexcharts.min.js"></script>

  <!-- custom-chart js -->
  <script src="assets/js/pages/dashboard-main.js"></script>

  <!-- Datatable -->
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>

  <!-- Librerias para exportar la tabla a distintos documentos -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

  <script src="js/lecturaTabla_general.js"></script>
  <script src="js/editarDatos_general.js"></script>
  <script src="js/eliminarByID.js"></script>
  <!-- El alta de usuarios se hace desde esta pagina -->
  <script src="js/eliminaTodo.js"></script>
  <script src="js/logout.js"></script>

  <script>
    var id = 0;
    var opcion = '';
    var tabla = 'usuarios';

    // === CARGA LA TABLA CON DATOS - LECTURA TABLA GENERAL ===
    // var opcionDataTable = 'general';
    // opcion = 0;
    // url = `http://www.lepaa.com.ar/api/users.php?opcion=${opcion}`;
    // var url = `api/users.php?opcion=${opcion}`;

    $(document).ready(function() {
      listar();
    });

    // === CARGA LA TABLA CON DATOS ===
    // Accede y vuelca los datos del array en la tabla
    var listar = function() {
      opcion = 0;
      table = $("#tablaClientes").DataTable({
        ajax: {
          method: "GET",
          url: "api/users.php",
          data: {
            opcion: opcion
          },
        },
        columns: [{
            data: "dni"
          }, {
            data: "nombre"
          },
          {
            data: "apellido"
          },
          {
            data: "email"
          },
          {
            data: "institucion"
          },
          {
            data: "acceso"
          },
          {
            data: "estadoacceso"
          },
          {
            data: "id"
          },
          {
            defaultContent: "<button type='button' class='btn btn-info btn-circle btn-sm btnInfo'><i class='fas fa-info-circle'></i></button>	<button type='button' class='btn btn-primary btn-circle btn-sm btnEdit'><i class='fas fa-edit'></i></button></button>	<button type='button' class='btn btn-danger btn-circle btn-sm btnDel'><i class='fas fa-trash'></i></button>"
          },
        ],
        // ESTILOS DE LA TABLA
        lengthMenu: [15, 25, 50, 75, 100], //indica opciones de cantidad renglon en pantalla
        columnDefs: [
          // === Oculta columnas ===
          {
            targets: [7],
            visible: false,
          },
          // === fija la columna acciones en la tabla ===
          {
            responsivePriority: 1,
            targets: 0
          },
          {
            responsivePriority: 2,
            targets: -1
          },
        ],
        // columnas a ordenar
        order: [
          [1, "asc"],
          [2, "asc"],
        ],
        createdRow: function(row, data, index) {
          $("td", row).eq(0).css({
            "text-align": "center",
          });
          $("td", row).eq(4).css({
            "text-align": "center",
          });
          $("td", row).eq(5).css({
            "text-align": "center",
          });
          $("td", row).eq(6).css({
            "text-align": "center",
          });
          $("td", row).eq(7).css({
            "text-align": "center",
          });
        },

        dom: '"Bfrtilp"',
        buttons: ["excelHtml5", "pdfHtml5", "print"],
        language: {
          lengthMenu: "Mostrar _MENU_ registros",
          zeroRecords: "No se encontraron resultados",
          emptyTable: "Ningún dato disponible en esta tabla",
          infoFiltered: "(filtrado de un total de _MAX_ registros)",
          info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
          infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
          search: "Buscar:",
          paginate: {
            next: "Siguiente",
            previous: "Anterior",
          },
          searchPanes: {
            clearMessage: "Borrar todo",
            title: "Filtros Activos - %d",
            showMessage: "Mostrar Todo",
            collapseMessage: "Ocultar Todo",
          },
          buttons: {
            colvis: "Seleccionar Columnas",
          },
        },
      });
      obtener_data_editar("#tablaClientes tbody", table);
      obtener_data_info("#tablaClientes tbody", table);
      obtener_data_borrar("#tablaClientes tbody", table);
    }
    // ===  FIN CARGA LA TABLA CON DATOS ===


    // Obtiene el ID para mostrar datos
    var obtener_data_info = function(tbody, table) {
      $(tbody).on("click", "button.btnInfo", function() {
        var data = table.row($(this).parents("tr")).data();
        id = data['id'];
        consultarUnCliente(id);
      });
    }

    // Obtiene el ID para editar datos
    var obtener_data_editar = function(tbody, table) {
      $(tbody).on("click", "button.btnEdit", function() {
        var data = table.row($(this).parents("tr")).data();
        id = data['id'];
        consultarUnCliente(id);
      });
    }

    // Obtiene el ID para Eliminar un dato
    var obtener_data_borrar = function(tbody, table) {
      $(tbody).on("click", "button.btnDel", function() {
        var data = table.row($(this).parents("tr")).data();
        id = data['id'];
        eliminarCliente(id);
      });
    }
    // ===  FIN CARGA LA TABLA CON DATOS ===

    // === CONSULTAR DATOS ===
    function consultarUnCliente(id) {
      opcion = 1;
      $('#modalConsulta').modal('show');

      // Mustra formulario modo Info
      $(document).on("click", ".btnInfo", function() {
        $(".form-control").prop('disabled', true);
        $(".form-select").prop('disabled', true);
        $('#botonAceptar').hide();
        $(".labelDatosAdicionales").show();
      });

      // Muestra formulario modo Edición
      $(document).on("click", ".btnEdit", function() {
        $(".form-control").prop('disabled', false);
        $(".form-select").prop('disabled', false);
        $("#consultarDni").prop('disabled', true);
        $(".labelDatosAdicionales").hide();
        $('#botonAceptar').show();
      });
      // consulta a base de datos según ID y opcion
      fetch(
          `api/users.php?id=${id}&opcion=${opcion}`, {
            method: 'GET',
            headers: {
              Accept: "application/json",
              "Content-Type": "application/json",
            },

          },
        )
        .then((respuesta) => respuesta.json())
        .then((datos) => {
          // Carga el formulario con los datos obtenidos
          $("#consultarID").val(datos[0].id);
          $("#consultarDni").val(datos[0].dni);
          $("#consultarFirstName").val(datos[0].nombre);
          $("#consultarLastName").val(datos[0].apellido);
          $("#consultarCuit").val(datos[0].cuit);
          $("#consultarInstitucion").val(datos[0].institucion);
          $("#consultarAcceso").val(datos[0].acceso);
          $("#consultarEstadoAcceso").val(datos[0].estadoacceso);
          $("#consultarEmail").val(datos[0].email)

          var alta = datos[0].nombrealta + ' ' + datos[0].apellidoalta + ' - ' + datos[0].newfechaalta
          if (datos[0].nombrealta === null || datos[0].nombrealta === '') {
            alta = "by System"
            $("#datosAlta").val(alta);
          } else {
            $("#datosAlta").val(alta);
          }

          var modificado = datos[0].nombremod + ' ' + datos[0].apellidomod + ' - ' + datos[0].newfechamod
          if (datos[0].nombremod === null || datos[0].nombremod === '') {
            modificado = "Sin modificacion"
            $("#datosMod").val(modificado);
          } else {
            $("#datosMod").val(modificado);
          }
        });
    }
    // === FIN CONSULTAR DATOS ===

    // === ACTUALIZA LOS DATOS en la BD ===
    var urlEdit = 'api/users.php';
    // === FIN ACTUALIZAR DATOS ===

    // === ALTA de USUARIO ===
    function altaNuevo() {
      $(".form-control").prop('disabled', false);
      $(".form-select").prop('disabled', false);
      // $(".inactivo").prop('disabled', true);
      $('#botonAceptar').show();
      $('#formAlta').modal('show');

      var dni = $("#altaDni").val();
      console.log(dni)
      opcion = 6;

      if (dni != '') {
        fetch(
            `api/users.php?dni=${dni}&opcion=${opcion}`, {
              method: "GET",
              headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
              },
            }
          )
          .then((respuesta) => respuesta.json())
          .then((datos) => {
            console.log(datos)
            if (datos != 0) {
              $("#altaFirstName").val(datos[0].nombre);
              $("#altaLastName").val(datos[0].apellido);
              $("#altaEmail").val(datos[0].email);
              $("#altaDni2").val(datos[0].dni);
            };
          });
      };
    }

    var formularioAlta = document.getElementById('formAlta');
    document.getElementById('formAlta').addEventListener('submit', function(e) {
      e.preventDefault();
      var datos = new FormData(formularioAlta);

      // verifica si las passwords son iguales
      var password = $("#altaInputPassword").val();
      var repeatPassword = $("#altaRepeatPassword").val();
      if (password === repeatPassword) {
        // envia los datos a crear en la base de datos
        fetch(
            'api/users.php', {
              method: 'POST',
              body: datos,
              headers: {
                Accept: "application/json",
              },
            },
          )
          .then((respuesta) => respuesta.json())
          .then((datos) => {
            $('#formAlta').modal('hide');
            if (datos == 1) {
              Swal.fire({
                icon: 'success',
                title: 'Ok!',
                text: 'Usuario Ingresado con exito!',
              }).then((result) => {
                $("#formAlta").trigger("reset");
                refresh()
              });
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Ups..!',
                text: datos,
              })
            };
          });
      } else {
        $('#formAlta').modal('hide');
        Swal.fire({
          icon: 'error',
          title: 'Ups..!',
          text: 'Las contraseñas no coinciden!',
        })
      };
    });

    // NO PERMITE INGRSAR CARACTERES ESPECIALES EN LA PASSWORD
    function validarInput(event) {
      var tecla = event.key;
      // Lista de caracteres permitidos (alfanuméricos y algunos especiales)
      var caracteresPermitidos = /^[0-9a-zA-Z]*$/;
      // Verificar si la tecla presionada está permitida
      if (!caracteresPermitidos.test(tecla)) {
        event.preventDefault();
      }
    }

    function refresh() {
      table.ajax.reload(null, false);
    }
  </script>
</body>

</html>