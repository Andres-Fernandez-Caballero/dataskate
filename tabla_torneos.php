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
  <title>DATA SKATE - Tabla Torneos</title>
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
      <h1>Tabla Torneos</h1>
    </div>
    <div class="col-lg-12">
      <div class="table-responsive">
        <table id="tablaClientes" class="display responsive nowrap compact table-bordered" style="width: 60%">
          <thead class="text-center">
            <tr>
              <th class="text-center">Torneo</th>
              <th class="text-center">Valor</th>
              <th class="text-center">Estado Torneo</th>
              <th class="text-center">Estado Musica y Declaración</th>
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

  <!-- FROMULARIO MODAL CONSULTA/EDICION -->
  <!-- <form class="modal fade" id="modalConsulta" action="api/torneos.php" method="POST"> -->
  <form class="modal fade" id="modalConsulta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title editar" id="exampleModalLabel"></h4>
          <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="col-lg-12">
          <div class="form-group classid">
            <input name="id" type="number" class="form-control form-control-user ocultarID" id="consultarID" placeholder="id" />
          </div>

          <div class="form-group form-floating">
            <input name="torneo" type="text" class="form-control form-control-user form-torneo" id="consultarTorneo" placeholder="Torneo" />
            <label for="floatingInput">Torneos</label></label>
          </div>

          <div class="form-row">
            <div class="form-group form-floating col-6">
              <select name="estadoTorneo" class="form-control form-select form-control-user" id="consultarEstadoTorneo" required>
                <option value=""></option>
                <option value="Abierto">Abierto</option>
                <option value="Cerrado">Cerrado</option>
                <option value="Terminado">Terminado</option>
              </select>
              <label for="floatingSelect">Estado del Torneo</label>
            </div>

            <div class="form-group form-floating col-6">
              <input name="valor" type="number" class="form-control form-valor form-control-user" id="consultarValor" placeholder="Valor" required />
              <label for="floatingInput">Valor</label>
            </div>

            <div class="form-group form-floating col-12">
              <select name="estadoelementos" class="form-control form-select form-control-user" id="consultarEstadoElementos" required>
                <option value=""></option>
                <option value="Abierto">Abierto</option>
                <option value="Cerrado">Cerrado</option>
                <!-- <option value="Terminado">Terminado</option> -->
              </select>
              <label for="floatingSelect">Estado Musica y Declaraciones</label>
            </div>
          </div>

          <div class="mt-2">
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

  <!-- FROMULARIO MODAL ALTA -->
  <form class="modal fade" id="formAlta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Alta Torneo</h4>
          <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="col-lg-12">
          <div class="form-group form-floating mt-3">
            <input name="torneo" type="text" class="form-control form-control-user" id="altaTorneo" placeholder="Torneo" required />
            <label for="floatingInput">Torneo</label>
          </div>

          <div class="form-row">
            <div class="form-group form-floating col-6">
              <select name="estadoTorneo" class="form-control form-select form-control-user" id="altaEstadoTorneo" required>
                <option value="Abierto">Abierto</option>
                <option value="Cerrado">Cerrado</option>
                <option value="Terminado">Terminado</option>
              </select>
              <label for="floatingSelect">Estado del Torneo</label>
            </div>

            <div class="form-group form-floating col-6">
              <input name="valor" type="number" class="form-control form-control-user" id="altaValor" placeholder="Valor" required />
              <label for="floatingInput">Valor</label>
            </div>

            <div class="form-group form-floating col-12">
              <select name="estadoelementos" class="form-control form-select form-control-user" id="altaEstadoElementos" required>
                <option value="Abierto">Abierto</option>
                <option value="Cerrado">Cerrado</option>
                <!-- <option value="Terminado">Terminado</option> -->
              </select>
              <label for="floatingSelect">Estado Musica y Declaraciones</label>
            </div>
          </div>

          <div class="ocultarInputOpcion">
            <input name="opcion" type="text" value="4">
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

  <!-- <script src="js/lecturaTabla_general.js"></script> -->
  <script src="js/editarDatos_general.js"></script>
  <script src="js/altas_general.js"></script>
  <script src="js/eliminarByID.js"></script>
  <script src="js/eliminaTodo.js"></script>
  <script src="js/logout.js"></script>

  <script>
    var id = '';
    var opcion = '';
    var tabla = 'torneos';

    $(document).ready(function() {
      listar();
    });

    // === CARGA LA TABLA CON DATOS - LECTURA TABLA GENERAL ===
    // Accede y vuelca los datos del array en la tabla
    var listar = function() {
      opcion = 0;
      table = $("#tablaClientes").DataTable({
        ajax: {
          method: "GET",
          url: "api/torneos.php",
          data: {
            opcion: opcion
          },
        },
        columns: [{
            data: "nombretorneo"
          },
          {
            defaultContent: "valor"
          },
          {
            data: "estadotorneo"
          },
          {
            data: "estadoelementos"
          },
          {
            data: "id"
          },
          {
            defaultContent: "<button type='button' class='btn btn-info btn-circle btn-sm btnInfo'><i class='fas fa-info-circle'></i></button>	<button type='button' class='btn btn-primary btn-circle btn-sm btnEdit'><i class='fas fa-edit'></i></button></button>	<button type='button' class='btn btn-danger btn-circle btn-sm btnDel'><i class='fas fa-trash'></i></button>"
          }
        ],
        // ESTILOS DE LA TABLA
        dom: '"Bfrtilp"',
        buttons: ["excelHtml5", "pdfHtml5", "print"],
        language: {
          zeroRecords: "No se encontraron resultados",
          lengthMenu: "Mostrar _MENU_ registros",
          infoFiltered: "(filtrado de un total de _MAX_ registros)",
          info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
          zeroRecords: "No se encontraron resultados",
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
        columnDefs: [{
            targets: [4],
            visible: false,
          },
          // fija la columna acciones en la tabla
          {
            responsivePriority: 1,
            targets: 0
          },
          {
            responsivePriority: 2,
            targets: -1
          },
        ],

        createdRow: function(row, data, index) {
          $("td", row).eq(1).css({
            "text-align": "right",
          });
          $("td", row).eq(2).css({
            "text-align": "center",
            "font-size": "18px",
            "font-weight": "600",
          });
          $("td", row).eq(2).css({
            "text-align": "center",
          });
          if (data[2] == "Abierto") {
            $("td", row).eq(2).css({
              "color": "green",
            });
          }
          if (data[2] == "Cerrado") {
            $("td", row).eq(2).css({
              "color": "orange",
            });
          }
          if (data[2] == "Terminado") {
            $("td", row).eq(2).css({
              "color": "red",
            });
          }
          $("td", row).eq(3).css({
            "text-align": "center",
            "font-size": "18px",
            "font-weight": "600",
          });
          $("td", row).eq(3).css({
            "text-align": "center",
          });
          if (data[3] == "Abierto") {
            $("td", row).eq(3).css({
              "color": "green",
            });
          }
          if (data[3] == "Cerrado") {
            $("td", row).eq(3).css({
              "color": "orange",
            });
          }
          if (data[3] == "Terminado") {
            $("td", row).eq(3).css({
              "color": "red",
            });
          }
          $("td", row).eq(4).css({
            "text-align": "center",
          });
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
    var estado = '';
    var obtener_data_editar = function(tbody, table) {
      $(tbody).on("click", "button.btnEdit", function() {
        var data = table.row($(this).parents("tr")).data();
        id = data['id'];
        // estado = data['estadotorneo'];
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
        const parrafo = document.querySelector(".editar");
        parrafo.textContent = "Información Torneo"

      });

      // Muestra formulario modo Edición
      $(document).on("click", ".btnEdit", function() {
        if (estado == 'Archivado') {
          $(".form-control").prop('disabled', true);
          $(".form-torneo").prop('disabled', true);
          $(".form-select").prop('disabled', true);
          $(".form-valor").prop('disabled', true);
          $('#botonAceptar').hide();
        } else {
          $(".form-control").prop('disabled', false);
          $(".form-torneo").prop('disabled', true);
          $(".form-select").prop('disabled', false);
          $(".form-valor").prop('disabled', false);
          $('#botonAceptar').show();
        }
        $(".labelDatosAdicionales").hide();
        const parrafo = document.querySelector(".editar");
        parrafo.textContent = "Editar Torneo"

      });
      // consulta a base de datos según ID y opcion

      fetch(
          `api/torneos.php?id=${id}&opcion=${opcion}`, {
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
          $("#consultarTorneo").val(datos[0].nombretorneo);
          $("#consultarValor").val(datos[0].valor);
          $("#consultarEstadoTorneo").val(datos[0].estadotorneo);
          $("#consultarEstadoElementos").val(datos[0].estadoelementos);

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

    // === Veerifica si se quiere TERMINAR el torneo pero los elementos estan ABIERTOS y viceversa ===
    var select1 = document.getElementById('consultarEstadoTorneo');
    var select2 = document.getElementById('consultarEstadoElementos');
    // Agregar un event listener al primer select
    select1.addEventListener('change', function() {
      // Obtener los valores seleccionados
      var valorSelect1 = select1.options[select1.selectedIndex].text;
      var valorSelect2 = select2.options[select2.selectedIndex].text;

      // Comparar los valores
      if (valorSelect1 === 'Terminado' && valorSelect2 === 'Abierto') {
        $('#modalConsulta').modal('hide');
        Swal.fire({
          title: "Atención!",
          html: '<p style="font-size:20px">No se puede <b>TERMINAR</b> el Torneo si la <b>Musica y Declaracion</b> esta en estado ABIERTO, debe cambiar este ultimo a CERRADO</p>',
          icon: "error"
        });
      }
    });

    select2.addEventListener('change', function() {
      // Obtener los valores seleccionados
      var valorSelect1 = select1.options[select1.selectedIndex].text;
      var valorSelect2 = select2.options[select2.selectedIndex].text;
      // Comparar los valores
      if (valorSelect2 === 'Abierto' && valorSelect1 === 'Terminado') {
        $('#modalConsulta').modal('hide');
        Swal.fire({
          title: "Atención!",
          html: '<p style="font-size:20px">No se puede <b>ABRIR</b> la <b>Musica y Declaracion</b> si el TORNEO esta en estado TERMINADO, debe cambiar este ultimo a ABIERTO o CERRADO</p>',
          icon: "error"
        });
      }
    });
    // === FIN Veerifica si se quiere TERMINAR el torneo pero los elementos estan ABIERTOS y viceversa ===

    // === EDITAR LOS DATOS en la BD by ID ===
    var urlEdit = 'api/torneos.php';
    // === FIN ACTUALIZAR DATOS ===

    // === ALTA de DATOS ===
    var urlAlta = 'api/torneos.php';
    // === FIN Alta DATOS ===

    function refresh() {
      table.ajax.reload(null, false);
    }
  </script>
</body>

</html>