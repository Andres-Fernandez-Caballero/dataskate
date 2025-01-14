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
  <link rel="stylesheet" href="assets/css/stylesplus.css" />
  <!-- CSS loading -->
  <link rel="stylesheet" href="assets/css/loading.css" />
  <!-- fontawesome PRO -->
  <script src="fw_pro.js" crossorigin="anonymous"></script>

  <!-- DataTable -->
  <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css" rel="stylesheet" />
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css"> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/2.2.0/css/searchPanes.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/searchbuilder/1.6.0/css/searchBuilder.dataTables.min.css">
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css"> -->

  <!-- Sweet Alert2 -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="shortcut icon" href="assets/logoDataSkt.png">
  <title>DATA SKATE - Cobros por aprobar</title>
</head>


<style>
  .textoLoading {
    color: white !important;
    text-align: center !important;
  }

  .encabezado {
    background: gainsboro;
  }

  .detalle td,
  .encabezado th {
    font-size: 14px;
  }

  .dtrg-start td {
    background-color: #F0FFF0 !important;
    font-weight: 700;
  }

  .dtrg-start :hover {
    background-color: #F0FFFF !important;
    cursor: pointer;
  }

  .delete {
    display: none;
  }

  /* Oculta agregar y eliminat del menu lateral */
  .opciones {
    display: none;
  }

  .pcoded-navbar .pcoded-inner-navbar li.pcoded-menu-caption:first-child {
    display: none;
  }

  .pcoded-navbar .pcoded-inner-navbar li.pcoded-menu-caption {
    margin-top: 0;
  }
</style>

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

  <!-- LOADING -->
  <?php include('modulos/loading.php'); ?>
  <!-- END LOADING -->

  <!-- [ Main Content ] start -->
  <div class="pcoded-main-container mt-4">
    <div class="text-center pb-3">
      <h1>Cobros pendientes de aprobación</h1>
    </div>

    <div class="col-lg-10 ms-auto me-auto">
      <div class="table-responsive">
        <table id="detalleCtaCte" class="display responsive nowrap compact table-bordered" style="width: 100%">
          <thead class="text-center encabezado">
            <tr>
              <th class="text-center">Instirucion</th>
              <th class="text-center">Concepto</th>
              <th class="text-center">Tipo Comp</th>
              <th class="text-center">N° Transaccion</th>
              <th class="text-center">Fecha Comp</th>
              <th class="text-center">Fecha Pago</th>
              <th class="text-center">Forma Pago</th>
              <th class="text-center">Comp. Pago</th>
              <th class="text-center">DNI</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Referencia</th>
              <th class="text-center">Adeudado</th>
              <th class="text-center">Pagado</th>
              <th class="text-center">CUIT</th>
              <th class="text-center">CUIT/CUIL Depositante</th>
              <th class="text-center">Recibo Oficial</th>
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


  <!-- FROMULARIO MODAL CONSULTA COMPROBANTE -->
  <!-- <form class="modal fade" id="formComAlta" action="api/ctacte.php" method="POST"> -->
  <form class="modal fade" id="formComAlta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title titulo" id="exampleModalLabel">Alta Comprobantes</h4>
          <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>

        <div class="col-lg-12">


          <div class="modal-body">
            <div class="form-group form-floating">
              <select name="cuit" class="form-select cuit" id="consultarCuit" required>
                <option value=""></option>
                <?php //Completa el SELECT on los datos de la tabla CLUBS
                $select = mysqli_query($con, "SELECT * FROM clubs");
                while ($clubs = mysqli_fetch_row($select)) {
                ?>
                  <option value="<?php echo $clubs[1] ?>"><?php echo $clubs[2] ?></option>
                <?php } ?>
              </select>
              <label for="floatingSelect">Club</label>
            </div>

            <div class="row">
              <div class="form-floating mb-3 col-md-6">
                <input type="tetx" class="form-control comp" name="tipoComprobante" id="consultarTipoComprobante" placeholder="Tipo Comprobante">
                <label for="floatingInput">Tipo Comprobante</label>
              </div>

              <div class="form-floating mb-3 col-md-6">
                <input name="id" type="number" class="form-control id" id="consultarID" placeholder="N° Transacción" />
                <label for="floatingInput">N° Transacción</label>
              </div>
            </div>

            <div class="form-floating mb-3">
              <input type="date" class="form-control fechaComp" name="fechaAlta" id="consultarFechaAlta" placeholder="Fecha del comprobante" required>
              <label for="floatingInput">Fecha del comprobante</label>
            </div>

            <div class="form-group form-floating">
              <select name="concepto" class="form-select concepto" id="consultarConcepto" required>
                <option value=""></option>
                <option value="AFILIACION">AFILIACION</option>
                <option value="LICENCIAS">LICENCIAS</option>
                <option value="PASES">PASES</option>
                <?php //Completa el SELECT on los datos de la tabla CLUBS
                $select = mysqli_query($con, "SELECT * FROM torneo ORDER BY nombretorneo");
                while ($torneo = mysqli_fetch_row($select)) {
                ?>
                  <option value="<?php echo $torneo[1] ?>"><?php echo $torneo[1] ?></option>
                <?php } ?>
              </select>
              <label for="floatingSelect">Concepto</label>
            </div>

            <div class="form-floating mb-3">
              <input type="number" class="form-control monto" name="monto" id="consultarMonto" placeholder="Monto" required>
              <label for="floatingInput">Monto</label>
            </div>

            <!-- datos CtaCte para recibos-->
            <div class="SeccionCtaCte form-row recibos_grup">
              <div class="form-group form-floating col-md-6">
                <select name="forma_pago" class="form-select recibos" id="consultarForma_pago" required>
                  <option value=""></option>
                  <option value="Deposito">Deposito</option>
                  <option value="Efectivo">Efectivo</option>
                  <option value="Transferencia">Transferencia</option>
                </select>
                <label for="floatingSelect">Forma de pago</label>
              </div>

              <div class="form-floating mb-3 col-md-6">
                <input type="text" class="form-control recibos" name="num_comp_pago" id="consultarNum_comp_pago" placeholder="Numero comprobante">
                <label for="floatingInput">Numero comprobante</label>
              </div>

              <div class="form-floating mb-3 col-md-6">
                <input type="date" class="form-control recibos" name="fecha_pago" id="consultarFecha_pago" placeholder="Fecha de pago" required>
                <label for="floatingInput">Fecha de pago</label>
              </div>

              <div class="form-floating mb-3 col-md-6">
                <input type="text" class="form-control recibos" name="entidad_pago" id="consultarEntidad_pago" placeholder="Monto">
                <label for="floatingInput">Entidad</label>
              </div>
              <div class="form-floating mb-3 col-md-6">
                <input type="text" class="form-control recibos" name="id_depositante" id="consultarId_depositante" placeholder="CUIT/CUIL a facturar" required>
                <label for="floatingInput">CUIT/CUIL a facturar</label>
              </div>
              <div class="form-floating mb-3 col-md-6">
                <input type="text" class="form-control recibos" name="num_recibo" id="consultarNum_recibo" placeholder="N° de Recibo Oficial">
                <label for="floatingInput">N° de Recibo Oficial</label>
              </div>
            </div>

            <!-- ACTUALIZAR y VER FOTO -->
            <div class="mb-2 d-flex justify-content-center">
              <a href="#" class="badge badge-info" id="enlaceFoto" target="_blank">Ver Comprobante</a>
            </div>

            <div class="form-floating col-md-13">
              <textarea name="comentarios" class="form-control" placeholder="Comentarios" id="consultarComentario" style="height: 100px"></textarea>
              <label for="altaComentario">Comentarios</label>
            </div>
          </div>

          <div>
            <label class="labelDatosAdicionales mb-0"><b>Alta:</b>
              <input name="datosAlta" type="text" class="datosAdicionales" id="datosAlta" disabled />
            </label>
            <label class="labelDatosAdicionales"><b>Ultima modificación:</b>
              <input name="datosMod" type="text" class="datosAdicionales" id="datosMod" disabled />
            </label>
          </div>

          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal" id="botonCancel">
              Cancelar
            </button>
          </div>

        </div>
      </div>
    </div>
    </div>
  </form>
  <!-- FIN FROMULARIO MODAL CONSULTA COMPROBANTE -->

  <script src=" https://code.jquery.com/jquery-3.7.0.js"></script>

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
  <script src="  https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/searchpanes/2.2.0/js/dataTables.searchPanes.min.js"></script>
  <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
  <script src="https://cdn.datatables.net/colreorder/1.6.1/js/dataTables.colReorder.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/rowgroup/1.3.0/js/dataTables.rowGroup.min.js"></script>
  <script src="https://cdn.datatables.net/searchbuilder/1.4.0/js/dataTables.searchBuilder.min.js"></script>
  <!-- <script src="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css"></script> -->

  <!-- Librerias para exportar la tabla a distintos documentos -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

  <script src="js/logout.js"></script>
  <script src="js/eliminarByID.js"></script>

  <script>
    var id = '';
    var cuit = <?php echo $user['cuit'] ?>;
    var opcion = '';
    var saldo = 0;
    var tabla = 'ctacte_prerecibos';
    var table;
    var institucion = "<?php echo $user['institucion'] ?>";
    var tipoCbte = '';


    $(document).ready(function() {
      detalle();
    });

    // === CARGA LA TABLA CON DATOS - LECTURA TABLA GENERAL ===
    // Accede y vuelca los datos del array en la tabla
    var detalle = function() {
      opcion = 1;
      // muestra el resumen de la CtaCte
      var collapsedGroups = {};

      table = $("#detalleCtaCte").DataTable({
        destroy: true,
        ajax: {
          method: "GET",
          url: "api/ctacte_prerecibo.php?",
          data: {
            opcion: opcion,
            cuit: cuit,
          },
        },
        columns: [{
            data: "institucion"
          }, {
            data: "concepto"
          },
          {
            data: "tipo_comprobante"
          },
          {
            data: "id"
          },
          {
            data: "fecha_alta"
          },
          {
            data: "fecha_pago"
          },
          {
            data: "forma_pago"
          },
          {
            data: "num_comp_pago"
          },
          {
            data: "dnipatinador"
          },
          {
            data: "nombrepatinador"
          },
          {
            data: "tipolicencia"
          },
          {
            data: "adeudado"
          },
          {
            data: "pagado"
          },
          {
            data: "cuit"
          },
          {
            data: "id_depositante"
          },
          {
            data: "num_recibo"
          },
          {
            defaultContent: "<button type='button' class='btn btn-secondary btn-circle btn-sm btnConfirm'><i class='feather icon-thumbs-up'></i></button> <button type='button' class='btn btn-info btn-circle btn-sm btnInfo'><i class='fas fa-info-circle'></i></button>"
          },
        ],
        // dom: '"QBfrtil"',
        dom: '"Bfrtil"',
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
        },
        // Estilo a las celdas
        createdRow: function(row, data, index) {
          $("td", row).eq(0).css({
            "text-align": "center",
          });
          $("td", row).eq(1).css({
            "text-align": "center",
          });
          $("td", row).eq(2).css({
            "text-align": "center",
          });
          $("td", row).eq(3).css({
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
            "text-align": "right",
          });
          $("td", row).eq(8).css({
            "text-align": "center",
          });
        },
        // Oculta columnas
        columnDefs: [{
            targets: [8, 9, 10, 11, 13, 14, 15],
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
          {
            responsivePriority: 3,
            targets: -5
          },
          {
            responsivePriority: 4,
            targets: -6
          },
        ],
        fixedHeader: {
          header: true,
        },
        lengthMenu: [
          [200, 500, -1],
          [200, 500, "All"],
        ], //indica opciones de renglon en pantalla
        // Scrool de pantalla
        deferRender: true,
        scrollX: true,
        scrollY: 700,
        scrollCollapse: true,
        scroller: true,
        // Tabla responsive
        responsive: true,
        // Ordenamiento por columna

        rowGroup: {
          dataSrc: [8],
          // agrupamiento de filas

          startRender: function(rows, group) {
            var collapsed = !!collapsedGroups[group];

            // verifica si las filas estan colapsadas
            rows.nodes().each(function(r) {
              r.style.display = 'none';
              if (collapsed) {
                r.style.display = '';
              }
            });

            // suma la columna deuda
            var deuda = rows
              .data()
              .pluck(6)
              .reduce(function(a, b) {
                return a + b.replace(/[^\d]/g, '') * 1;
              }, 0) / 100;

            // suma la columna pago
            var pago = rows
              .data()
              .pluck(7)
              .reduce(function(a, b) {
                return a + b.replace(/[^\d]/g, '') * 1;
              }, 0) / 100;
            // obtiene el saldo de la CtaCte
            var saldo = deuda - pago;
            // muestra información en el renglon agrupado
            return $('<tr/>')
              .append('<td colspan="17">' + group + ' - Total: ' + $.fn.dataTable.render.number(',', '.', 2).display(saldo) + ' (' + rows.count() + ')' + '</td>')
              .attr('data-name', group)
              .toggleClass('collapsed', collapsed);

          },
        },
      });

      // agrupa o desagrupa cuando se hace click sobre el encabezado del grupo
      $('#detalleCtaCte tbody').on('click', 'tr.dtrg-start', function() {
        var name = $(this).data('name');
        collapsedGroups[name] = !collapsedGroups[name];
        table.draw(true);
      });

      // Selecciona el ID cuando se preciona el boton INFO
      $('#detalleCtaCte tbody').on("click", "button.btnInfo", function() {
        var data = table.row($(this).parents("tr")).data();
        id = data['id'];
        consultarUnComprobante(id);
      });
      // Selecciona el ID cuando se preciona el boton EDIT
      $('#detalleCtaCte tbody').on("click", "button.btnConfirm", function() {
        var data = table.row($(this).parents("tr")).data();
        tipoCbte = data['tipo_comprobante']
        id = data['id'];
        concepto = data['concepto'];
        tipo_comprobante = data['tipo_comprobante'];
        confirmaPrereciboID(id, concepto, tipo_comprobante);
      });

    }
    // ===  FIN CARGA LA TABLA CON DATOS ===


    // === CONSULTAR DATOS DE UN COMPROBANTE ===
    function consultarUnComprobante(id) {
      $('#formComAlta').modal('show');

      opcion = 6;
      // Mustra formulario modo Info
      $(document).on("click", ".btnInfo", function() {
        $(".form-control").prop('disabled', true);
        $(".form-select").prop('disabled', true);
        $(".btn-aceptar").hide();
        $(".labelDatosAdicionales").show();
        let titulo = document.querySelector(".titulo");
        titulo.textContent = "Información Comprobante";
      });

      // Muestra formulario modo Edición
      $(document).on("click", ".btnEdit", function() {
        $(".form-control").prop('disabled', false);
        $(".form-select").prop('disabled', false);
        $(".cuit").prop('disabled', true);
        $(".comp").prop('disabled', true);
        $(".id").prop('disabled', true);
        $(".btn-aceptar").show();
        $(".labelDatosAdicionales").hide();
        if (tipoCbte == 'Ticket' || tipoCbte == 'Debito' || tipoCbte == 'Credito') {
          $(".recibos").prop('disabled', true);
        } else if (tipoCbte == 'Recibo') {
          $(".recibos").prop('disabled', false);
        }
        $("#consultarNum_recibo").prop("disabled", true);
        $("#consultarFechaAlta").prop("disabled", true);
        let titulo = document.querySelector(".titulo");
        titulo.textContent = "Modificar Comprobante";
      });
      // consulta a base de datos según ID y opcion
      fetch(
          `api/ctacte_prerecibo.php?id=${id}&opcion=${opcion}`, {
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
          $("#consultarID2").val(datos[0].id);
          $("#consultarCuit").val(datos[0].cuit);
          $("#consultarCuit2").val(datos[0].cuit);
          $("#consultarTipoComprobante").val(datos[0].tipo_comprobante);
          $("#consultarTipoComprobante2").val(datos[0].tipo_comprobante);
          $("#consultarFechaAlta").val(datos[0].fecha_alta);
          $("#consultarFechaAlta2").val(datos[0].fecha_alta);
          $("#consultarConcepto").val(datos[0].concepto);
          $("#consultarConcepto2").val(datos[0].concepto);
          $("#consultarNum_comp_pago").val(datos[0].num_comp_pago);
          $("#consultarForma_pago").val(datos[0].forma_pago);
          $("#consultarFecha_pago").val(datos[0].fecha_pago);
          $("#consultarEntidad_pago").val(datos[0].entidad_pago);
          $("#consultarComentario").val(datos[0].comentarios);
          $("#consultarId_depositante").val(datos[0].id_depositante);
          $("#consultarNum_recibo").val(datos[0].num_recibo);

          if (datos[0].foto !== null && datos[0].foto !== undefined && datos[0].foto !== "") {
            $("#enlaceFoto").attr("href", 'foto/' + datos[0].foto).attr("target", "_blank");
          } else {
            $("#enlaceFoto").attr("href", '#').attr("target", "");
          }

          if (datos[0].tipo_comprobante == 'Ticket' || datos[0].tipo_comprobante == 'Debito') {
            $("#consultarMonto").val(datos[0].adeudado);
            $("#consultarMonto2").val(datos[0].adeudado);
          } else {
            $("#consultarMonto").val(datos[0].pagado);
            $("#consultarMonto2").val(datos[0].pagado);
          }

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

    // === CONFIRMAR REGISTRACION por ID (INDIVIDUAL) === 
    function confirmaPrereciboID(id, concepto, tipo_comprobante) {
      Swal.fire({
        title: 'Atención!',
        html: `Confirma la registración del:<br>` + `<b style="font-size: 25px;">` + tipo_comprobante + " " + id + " - " + concepto + `</b>`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          confirmarReciboID(id)
        };
      });
    }

    function confirmarReciboID(id) {
      $('#modalLoading').modal('show');
      opcion = 5;
      fetch(
          `api/ctacte_prerecibo.php?id=${id}&opcion=${opcion}`, {
            method: 'GET',
            headers: {
              Accept: "application/json",
              "Content-Type": "application/json",
            },
          },
        )
        .then((respuesta) => respuesta.json())
        .then((datos) => {
          setTimeout(function() {
            $('#modalLoading').modal('hide');

            if (datos == 1) {
              Swal.fire({
                icon: "success",
                title: "Ok!",
                text: "Rgistración exitoso!!",
              }).then((result) => {
                refresh();

                // consulta la cantidad de recibos provisorios sin procesar
                opcion = 2;
                fetch(
                    `api/ctacte_prerecibo.php?opcion=${opcion}`, {
                      method: 'GET',
                      headers: {
                        Accept: "application/json",
                        "Content-Type": "application/json",
                      },
                    },
                  )
                  .then((respuesta) => respuesta.json())
                  .then((datos) => {
                    if (datos != 0) {
                      // actualiza la cantidad en el aviso de recibo provisorio
                      var spanElement = document.getElementById("cantidaPreRecibos");
                      spanElement.textContent = datos;
                      spanElement.style.display = "inline";
                    } else {
                      var spanElement = document.getElementById("avisoPreRecibos");
                      spanElement.style.display = "none";
                    }
                  });

              });
            } else {
              $('#modalLoading').modal('hide');
              Swal.fire({
                icon: "error",
                title: "Ups..!",
                text: datos,
              });
            }

          }, 1000);
        });
    }
    // === FIN CONFIRMAR REGISTRACION por ID === 

    function refresh() {
      table.ajax.reload(null, false);
    }
  </script>

</body>

</html>