<?php include('modulos/encabezado_user.php'); ?>

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
  <!-- CSS loading -->
  <link rel="stylesheet" href="assets/css/loading.css" />
  <!-- fontawesome PRO -->
  <script src="fw_pro.js" crossorigin="anonymous"></script>
  <!-- DataTable -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/2.1.0/css/searchPanes.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/select/1.5.0/css/select.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/colreorder/1.6.1/css/colReorder.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.3.0/css/rowGroup.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/searchbuilder/1.4.0/css/searchBuilder.dataTables.min.css">
  <!-- Sweet Alert2 -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="shortcut icon" href="assets/logoDataSkt.png">
  <title>DATA SKATE - Musica y Elementos</title>
</head>


<!-- Estilos para esta pagina -->
<style>
  .form-floating>.form-control {
    height: calc(1.5em + 1.25rem + 14px);
  }

  .accordion-collapse {
    background-color: white;
  }

  .sorting {
    text-align: center !important;
    font-size: 12px;
  }

  .btnEdit {
    margin: 4px !important;
  }

  input,
  select {
    font-weight: 700 !important;
  }

  .ocultarInputOpcion,
  .ocultarFiltros,
  .ocultarGrupos {
    display: none;
  }

  #contenedor {
    display: none;
  }

  .textoLoading {
    color: white !important;
    text-align: center !important;
  }

  div.dtsp-panesContainer {
    /* width: 100%; */
    background-color: white;
    padding: 7px;
    border-radius: 5px;
    border: 1px solid grey;
    margin-left: auto;
    margin-right: auto;
    display: none;
  }

  .dtrg-group th {
    color: black;
  }

  .dtrg-level-0 th {
    color: whitesmoke;
    font-size: 13px;
    background-color: rgb(133, 130, 130) !important;
  }

  .dtrg-level-1 th {
    background-color: rgb(173, 169, 169) !important;
  }

  /* Oculta el ADD CONDITIONS*/
  .dtsb-searchBuilder {
    display: none;
  }

  /* Oculta agregar y eliminat del menu lateral */
  .opciones {
    display: none;
  }

  .acciones {
    display: none;
  }

  .pcoded-navbar .pcoded-inner-navbar li.pcoded-menu-caption {
    margin-top: 0;
  }
</style>
<!-- FIN Estilos para esta pagina -->

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
    <div class="text-center">
      <h1>Musica y Declaración de Elementos</h1>
      <h1><?php echo $user['institucion'] ?></h1>
    </div>

    <!-- toma el tipo de acceso y password del usuario -->
    <div class="ocultarInputOpcion">
      <input name="tipoAcceso" id="tipoAcceso" type="text" value="<?php echo $user['acceso'] ?>">
      <input type="text" name="userPass" id="userPass" value="<?php echo $user['password'] ?>">
    </div>

    <!-- CARGA VIA EXCEL -->
    <section id="contenedor"></section>
    <!-- local -->
    <div class="col-lg-12 row mb-0 mt-4 pb-2" id="altaExcel">
      <!-- Filtros y Grupos de la Tabla -->
      <div class="form-row col-md-3 m-0">
        <div class="form-group mb-0 pl-1">
          <button class="btn btn-secondary mostrarFiltros" id="mostrarFiltros" name="filtros" onclick="mostrarFiltros()" title="Filtros DESACTIVADOS"><i class="fas fa-filter"></i></button>
          <button class="btn btn-success ocultarFiltros" id="ocultarFiltros" name="filtros" onclick="ocultarFiltros()" title="Filtros ACTIVADOS"><i class="fas fa-filter"></i></button>
        </div>
      </div>
    </div>
    <!-- FIN Filtros y Grupos de la Tabla -->

    <div class="col-lg-12">
      <div class="table-responsive">
        <table id="tablaClientes" class="display responsive nowrap compact table-bordered" style="width: 100%">
          <thead class="text-center">
            <tr>
              <th>DNI</th>
              <th>Sexo</th>
              <th>Apellido</th>
              <th>Nombres</th>
              <th>Fecha Nacimiento</th>
              <th>Edad</th>
              <th>Disciplina</th>
              <th>Divisional</th>
              <th>Eficiencia</th>
              <th>Categoria</th>
              <th>Tipo Licencia</th>
              <th>Torneo</th>
              <th>Institución</th>
              <th>Nivel</th>
              <th>Orden Disciplina</th>
              <th>Orden Divisional</th>
              <th>Orden Eficiencia</th>
              <th>Orden Categoria</th>
              <th>id</th>
              <th>Programa</th>
              <th>Musica 1</th>
              <th>Musica 2</th>
              <th>PDF Elementos</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->

  <!-- FROMULARIO MODAL MUSICA 1 -->
  <!-- <form class="modal fade" id="formMusica1" action="api/music_elements.php" method="POST"> -->
  <form class="modal fade" id="formMusica1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header mb-3">
          <h4 class="modal-title" id="exampleModalLabel">Carga de MUSICA 1</h4>
          <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="col-lg-12">
          <h6 class="mb-3" id="patinadorMusica1"></h6>
          <h6 class="mb-3" id="disciplinaMusica1"></h6>

          <div class="input-group cust-file-button mb-3">
            <div class="custom-file">
              <input name="musica1" type="file" class="custom-file-input" id="consultarMusica1" onChange="onLoadConsultaMusica1(event.target.files)" accept=".mp3, .MP3" required>
              <label class="custom-file-label" for="consultarMusica1" id="textoMusica1"></label>
            </div>
          </div>
        </div>

        <div class="ocultarInputOpcion">
          <input name="opcion" type="text" value="1">
          <input name="id" type="text" id="consultarID">
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
  <!-- FIN FROMULARIO MODAL MUSICA 1 -->

  <!-- FROMULARIO MODAL MUSICA 2 -->
  <!-- <form class="modal fade" id="formComAlta" action="api/music_elements.php" method="POST"> -->
  <form class="modal fade" id="formMusica2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header mb-3">
          <h4 class="modal-title" id="exampleModalLabel">Carga de MUSICA 2</h4>
          <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="col-lg-12">
          <h6 class="mb-3" id="patinadorMusica2"></h6>
          <h6 class="mb-3" id="disciplinaMusica2"></h6>

          <div class="input-group cust-file-button mb-3">
            <div class="custom-file">
              <input name="musica2" type="file" class="custom-file-input" id="consultarMusica2" onChange="onLoadConsultaMusica2(event.target.files)" accept=".mp3, .MP3" required>
              <label class="custom-file-label" for="consultarMusica2" id="textoMusica2"></label>
            </div>
          </div>
        </div>

        <div class="ocultarInputOpcion">
          <input name="opcion" type="text" value="2">
          <input name="id" type="text" id="consultarID_2">
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
  <!-- FIN FROMULARIO MODAL MUSICA 2 -->

  <!-- FROMULARIO MODAL MUSICA 2 -->
  <!-- <form class="modal fade" id="formComAlta" action="api/music_elements.php" method="POST"> -->
  <form class="modal fade" id="formElementos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header mb-3">
          <h4 class="modal-title" id="exampleModalLabel">Carga Declaracion Elementos</h4>
          <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="col-lg-12">
          <h6 class="mb-3" id="patinadorElementos"></h6>
          <h6 class="mb-3" id="disciplinaElementos"></h6>

          <div class="input-group cust-file-button mb-3">
            <div class="custom-file">
              <input name="elementos" type="file" class="custom-file-input" id="consultarElementos" onChange="onLoadConsultaElementos(event.target.files)" accept=".pdf, .PDF" required>
              <label class="custom-file-label" for="consultarElementos" id="textoElementos"></label>
            </div>
          </div>
        </div>

        <div class="ocultarInputOpcion">
          <input name="opcion" type="text" value="3">
          <input name="id" type="text" id="consultarID_3">
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
  <!-- FIN FROMULARIO MODAL MUSICA 2 -->


  <!-- SCRIPTS -->

  <!-- <script src="https://code.jquery.com/jquery-3.6.1.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
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
  <!-- libreria para mover columnas -->
  <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/searchpanes/2.1.0/js/dataTables.searchPanes.min.js"></script>
  <script src="https://cdn.datatables.net/select/1.5.0/js/dataTables.select.min.js"></script>
  <script src="https://cdn.datatables.net/colreorder/1.6.1/js/dataTables.colReorder.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/rowgroup/1.3.0/js/dataTables.rowGroup.min.js"></script>
  <script src="https://cdn.datatables.net/searchbuilder/1.4.0/js/dataTables.searchBuilder.min.js"></script>
  <!-- Librerias para exportar la tabla a distintos documentos -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

  <!-- <script src="js/lecturaTabla_general.js"></script> -->
  <script src="js/logout.js"></script>

  <script>
    var opcion = '';
    var userPass = $("#userPass").val();
    var tipoAcceso = $("#tipoAcceso").val();

    $(document).ready(function() {
      opcion = 6;
      fetch(`api/torneos.php?opcion=${opcion}`, {
          method: "GET",
          headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
          },
        })
        .then((respuesta) => respuesta.json())
        .then((datos) => {
          // console.log(datos);
          if (datos == 1) {
            listar();
          } else {
            Swal.fire({
              icon: 'warning',
              title: 'Listas cerradas!',
              text: 'No hay Lista de Buena Fe para mostrar!',
            }).then((result) => {
              location.href = "users_home.php";
            });
          }
        });
    });

    // === CARGA LA TABLA CON DATOS ===
    // Accede y vuelca los datos del array en la tabla
    var listar = function() {
      opcion = 0;
      table = $("#tablaClientes").DataTable({
        ajax: {
          method: "GET",
          url: "api/music_elements.php",
          data: {
            opcion: opcion
          },
        },
        columns: [{
            data: "dnibuenafe"
          },
          {
            data: "sexopatinador"
          },
          {
            data: "apellidopatinador"
          },
          {
            data: "nombrepatinador"
          },
          {
            data: "fechanacimiento"
          },
          {
            data: "edad"
          },
          {
            data: "disciplina"
          },
          {
            data: "divisional"
          },
          {
            data: "eficiencia"
          },
          {
            data: "categoria"
          },
          {
            data: "tipolicencia"
          },
          {
            data: "torneo"
          },
          {
            data: "institucion"
          },
          {
            data: "nivel" // NIVEL: disciplina - divisional - eficiencia - categoria - horatorneo
          },
          {
            data: "ordendisciplina"
          },
          {
            data: "ordendivisional"
          },
          {
            data: "ordeneficiencia"
          },
          {
            data: "ordencategoria"
          },
          {
            data: "id"
          },
          {
            data: "programa1"
          },
          {
            data: "musica1",
            render: function(data, type) {
              if (data === null || data === '') {
                return "<button type='button' class='btn btn-primary btn-circle btn-sm btnEdit1'><i class='fas fa-edit'></i></button>";
                return data
              };
              if (data !== null) {
                return '<audio controls title="' + data + '">' + '<source src="' + data + '" type="audio/mpeg">' + 'Tu navegador no soporta el elemento de audio.</audio> ' + " <button type='button' class='btn btn-primary btn-circle btn-sm btnEdit1' style='margin-top: -40px;'><i class='fas fa-edit'></i></button> <button type='button' class='btn btn-danger btn-circle btn-sm btnDel1' style='margin-top: -40px;'><i class='fas fa-trash'></i></button>";
                return data
              };
            }
          },
          {
            data: "musica2",
            render: function(data, type) {
              if (data === null || data === '') {
                return "<button type='button' class='btn btn-primary btn-circle btn-sm btnEdit2'><i class='fas fa-edit'></i></button>";
                return data
              };
              if (data !== null) {
                return '<audio controls title="' + data + '">' + '<source src="' + data + '" type="audio/mpeg">' + 'Tu navegador no soporta el elemento de audio.</audio> ' + " <button type='button' class='btn btn-primary btn-circle btn-sm btnEdit2' style='margin-top: -40px;'><i class='fas fa-edit'></i></button> <button type='button' class='btn btn-danger btn-circle btn-sm btnDel2' style='margin-top: -40px;'><i class='fas fa-trash'></i></button>";
                return data
              };
            }
          },
          {
            data: "elementos",
            render: function(data, type) {
              if (data === null || data === '') {
                return "<button type='button' class='btn btn-primary btn-circle btn-sm btnEdit3'><i class='fas fa-edit'></i></button>";
                return data
              };
              if (data !== null) {
                return '<a href="' + data + '" target="_blank" title="' + data + '"><button type="button" class="btn btn-outline-secondary btn-circle btn-sm" style="font-size: 40px !important;"><i class="fas fa-file-pdf"></i></button></a>' + '<a href="' + data + '" download="' + data + '"> <button type="button" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-arrow-alt-down"></i></button></a>' + " <button type='button' class='btn btn-primary btn-circle btn-sm btnEdit3'><i class='fas fa-edit'></i></button> <button type='button' class='btn btn-danger btn-circle btn-sm btnDel3'><i class='fas fa-trash'></i></button>";
                return data
              };
            }
          },
        ],

        // ESTILO TABLA
        lengthMenu: [
          [10, 25, 50, -1],
          [10, 25, 50, "All"],
        ], //configura cantidad de lineas por pantala
        // columnas a ordenar
        order: [
          [11, "asc"],
          [14, "asc"],
          [15, "asc"],
          [16, "asc"],
          [17, "asc"],
        ],
        // Agrupamiento de columna
        rowGroup: {
          dataSrc: [11, 13],
          // cuenat la cantidad de filas de cada grupo
          startRender: function(rows, group) {
            return group + " (" + rows.count() + ")";
          },
        },
        // paneles de busqueda filtros
        searchPanes: {
          viewTotal: true,
          layout: "columns-5",
          initCollapsed: true,
        },
        // definicion de columnas en el filtro
        columnDefs: [{
            searchPanes: {
              show: true,
            },
            targets: [5, 6, 7, 8, 9, 10, 11],
          },
          {
            searchPanes: {
              show: false,
            },
            targets: [0, 2, 3, 12, 14, 15, 16, 17, 20, 21, 22],
          },
          {
            // oculta columnas
            targets: [4, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18],
            visible: false,
          },
        ],
        //colReorder: true, // drag and drop columnas de la tabla
        // Tabla con scroll
        // scrollY: 500,
        // Paginación de la taba
        // paging: true,
        dom: '"QPfrtilp"', // Filtro Si agregamos una P en el DOM aparece el buscar
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
        createdRow: function(row, data, index) {
          //pintar una celda en rojo
          if (data[3] == "**EMPADRONAR**") {
            //pinta en rojo una fila
            $("td", row).css({
              "background-color": "#ff5252",
              color: "white",
              "border-style": "solid",
              "border-color": "#bdbdbd",
            });
          }
          //Si el orden de DISCIPLINA es 0 o nulo pinta en rojo la celda de DISCIPLINA
          if (data[14] == 0 || data[14] == "null") {
            //Pinta en rojo una celda
            $("td", row).eq(6).css({
              "background-color": "#ff5252",
              color: "white",
            });
          }
          //Si el orden de DIVISIONAL es 0 o nulo pinta en rojo la celda de DIVISIONAL
          if (data[15] == 0 || data[15] == "null") {
            //Pinta en rojo una celda
            $("td", row).eq(7).css({
              "background-color": "#ff5252",
              color: "white",
            });
          }
          //Si el orden de EFICIENCIA es 0 o nulo pinta en rojo la celda de EFICIENCIA
          if (data[16] == 0 || data[16] == "null") {
            //Pinta en rojo una celda
            $("td", row).eq(8).css({
              "background-color": "#ff5252",
              color: "white",
            });
          }
          //Si el orden de CATEGORIA es 0 o nulo pinta en rojo la celda de CATEGORIA
          if (data[17] == 0 || data[17] == "null") {
            //Pinta en rojo una celda
            $("td", row).eq(9).css({
              "background-color": "#ff5252",
              color: "white",
            });
          }
          // Estilo a la celda
          $("td", row).eq(0).css({
            "text-align": "center",
            "font-size": "14px",
          });
          $("td", row).eq(1).css({
            "text-align": "center",
          });
          $("td", row).eq(2).css({
            "font-size": "14px",
          });
          $("td", row).eq(3).css({
            "font-size": "14px",
          });
          $("td", row).eq(4).css({
            "text-align": "center",
            "font-size": "14px",
          });
          $("td", row).eq(5).css({
            "text-align": "center",
            "font-size": "14px",
          });
          $("td", row).eq(6).css({
            "font-size": "14px",
          });
          $("td", row).eq(7).css({
            "text-align": "center",
          });
          $("td", row).eq(8).css({
            "text-align": "center",
          });
          $("td", row).eq(9).css({
            "text-align": "center",
          });
        },
      });
      filtros();

      // Trae los datos de MUSICA 1 cuando se presiona el boton edit
      $('#tablaClientes tbody').on("click", "button.btnEdit1", function() {
        nombre = '';
        apellido = '';
        disciplina = '';
        musica1 = '';
        id = '';
        var data = table.row($(this).parents("tr")).data();
        nombre = data['nombrepatinador'];
        apellido = data['apellidopatinador'];
        disciplina = data['disciplina'];
        musica1 = data['musica1'];
        id = data['id'];

        // console.log(nombre + " " + apellido + " " + disciplina + " " + musica1 + " " + id)
        consultarMusica1(id, nombre, apellido, disciplina, musica1);
      });

      // Trae los datos de MUSICA 1 cuando se presiona el boton edit
      $('#tablaClientes tbody').on("click", "button.btnEdit2", function() {
        nombre = '';
        apellido = '';
        disciplina = '';
        musica2 = '';
        id = '';
        var data = table.row($(this).parents("tr")).data();
        nombre = data['nombrepatinador'];
        apellido = data['apellidopatinador'];
        disciplina = data['disciplina'];
        musica2 = data['musica2'];
        id = data['id'];

        // console.log(nombre + " " + apellido + " " + disciplina + " " + musica2 + " " + id)
        consultarMusica2(id, nombre, apellido, disciplina, musica2);
      });

      // Trae los datos de MUSICA 1 cuando se presiona el boton edit
      $('#tablaClientes tbody').on("click", "button.btnEdit3", function() {
        nombre = '';
        apellido = '';
        disciplina = '';
        musica2 = '';
        id = '';
        var data = table.row($(this).parents("tr")).data();
        nombre = data['nombrepatinador'];
        apellido = data['apellidopatinador'];
        disciplina = data['disciplina'];
        elementos = data['elementos'];
        id = data['id'];

        // console.log(nombre + " " + apellido + " " + disciplina + " " + musica2 + " " + id)
        consultarElementos(id, nombre, apellido, disciplina, elementos);
      });

      // Trae los datos de MUSICA 1 cuando se presiona el boton Borrar
      $('#tablaClientes tbody').on("click", "button.btnDel1", function() {
        nombre = '';
        apellido = '';
        disciplina = '';
        musica1 = '';
        id = '';
        dato = '';
        opcion = '';
        var data = table.row($(this).parents("tr")).data();
        nombre = data['nombrepatinador'];
        apellido = data['apellidopatinador'];
        disciplina = data['disciplina'];
        dato = 'MUSICA 1';
        id = data['id'];
        opcion = 4;

        // console.log(nombre + " " + apellido + " " + disciplina + " " + musica2 + " " + id)
        confirmarBorrarDato(id, nombre, apellido, disciplina, dato, opcion);
      });

      $('#tablaClientes tbody').on("click", "button.btnDel2", function() {
        nombre = '';
        apellido = '';
        disciplina = '';
        musica1 = '';
        id = '';
        dato = '';
        opcion = '';
        var data = table.row($(this).parents("tr")).data();
        nombre = data['nombrepatinador'];
        apellido = data['apellidopatinador'];
        disciplina = data['disciplina'];
        dato = 'MUSICA 2';
        id = data['id'];
        opcion = 5;

        // console.log(nombre + " " + apellido + " " + disciplina + " " + musica2 + " " + id)
        confirmarBorrarDato(id, nombre, apellido, disciplina, dato, opcion);
      });

      $('#tablaClientes tbody').on("click", "button.btnDel3", function() {
        nombre = '';
        apellido = '';
        disciplina = '';
        musica1 = '';
        id = '';
        dato = '';
        opcion = '';
        var data = table.row($(this).parents("tr")).data();
        nombre = data['nombrepatinador'];
        apellido = data['apellidopatinador'];
        disciplina = data['disciplina'];
        dato = 'ELEMENTOS';
        id = data['id'];
        opcion = 6;

        // console.log(nombre + " " + apellido + " " + disciplina + " " + musica2 + " " + id)
        confirmarBorrarDato(id, nombre, apellido, disciplina, dato, opcion);
      });
    }
    // ===  FIN CARGA LA TABLA CON DATOS ===


    // === CONSULTAR DATOS MUSICA 1 ===
    function consultarMusica1(id, nombre, apellido, disciplina, dato) {
      $('#formMusica1').modal('show');
      $("#consultarID").val(id);

      // completa los textos de los IMPUTS
      if (musica1 === null) {
        document.getElementById('textoMusica1').innerHTML = 'Subir Musica 1 (MP3)';
        var input = document.getElementById('consultarMusica1');
        input.value = '';
      } else {
        document.getElementById('textoMusica1').innerHTML = musica1;
      }

      // Muestra el nombre , apelli y disciplina en el modal
      document
        .getElementById('patinadorMusica1')
        .innerHTML = "Patinador/a: " + nombre + " " + apellido

      document
        .getElementById('disciplinaMusica1')
        .innerHTML = "Disciplina: " + disciplina
    }
    // === FIN CONSULTAR DATOS ===

    // === CONSULTAR DATOS MUSICA 2 ===
    function consultarMusica2(id, nombre, apellido, disciplina, musica2) {
      $('#formMusica2').modal('show');
      $("#consultarID_2").val(id);

      // completa los textos de los IMPUTS
      if (musica2 === null) {
        document.getElementById('textoMusica2').innerHTML = 'Subir Musica 2 (MP3)';
        var input = document.getElementById('consultarMusica2');
        input.value = '';
      } else {
        document.getElementById('textoMusica2').innerHTML = musica2;
      }

      // Muestra el nombre , apellido y disciplina en el modal
      document
        .getElementById('patinadorMusica2')
        .innerHTML = "Patinador/a: " + nombre + " " + apellido

      document
        .getElementById('disciplinaMusica2')
        .innerHTML = "Disciplina: " + disciplina
    }
    // === FIN CONSULTAR DATOS ===

    // === CONSULTAR DATOS ELEMENTOS ===
    function consultarElementos(id, nombre, apellido, disciplina, elementos) {
      $('#formElementos').modal('show');
      $("#consultarID_3").val(id);

      // completa los textos de los IMPUTS
      if (elementos === null) {
        document.getElementById('textoElementos').innerHTML = 'Subir declaración Elementos (PDF)';
        var input = document.getElementById('consultarElementos');
        input.value = '';
      } else {
        document.getElementById('textoElementos').innerHTML = elementos;
      }

      // Muestra el nombre , apellido y disciplina en el modal
      document
        .getElementById('patinadorElementos')
        .innerHTML = "Patinador/a: " + nombre + " " + apellido

      document
        .getElementById('disciplinaElementos')
        .innerHTML = "Disciplina: " + disciplina
    }
    // === FIN CONSULTAR DATOS ===


    // === CARGA MUSICA 1 A LA BD ===
    var formulario1 = document.getElementById("formMusica1");
    document
      .getElementById("formMusica1")
      .addEventListener("submit", function(e) {
        e.preventDefault();
        var datos = new FormData(formulario1);
        // envian los datos a modificar en la base de datos
        fetch(`api/music_elements.php`, {
            method: "POST",
            body: datos,
            headers: {
              Accept: "application/json",
            },
          })
          .then((respuesta) => respuesta.json())
          .then((datos) => {
            // $('#modalConsulta').modal('hide');
            $('#formMusica1').modal('hide');
            mensajeProceso(datos)
          })
          .catch((error) => {
            $("#formMusica1").modal('hide');
            // $('#modalConsulta').modal('hide');
            mensajeError(error);
          });
      });
    // === FIN CARGA MUSICA 1 A LA BD ===

    // === CARGA MUSICA 2 A LA BD ===
    var formulario2 = document.getElementById("formMusica2");
    document
      .getElementById("formMusica2")
      .addEventListener("submit", function(e) {
        e.preventDefault();
        var datos = new FormData(formulario2);
        // envian los datos a modificar en la base de datos
        fetch(`api/music_elements.php`, {
            method: "POST",
            body: datos,
            headers: {
              Accept: "application/json",
            },
          })
          .then((respuesta) => respuesta.json())
          .then((datos) => {
            // $('#modalConsulta').modal('hide');
            $('#formMusica2').modal('hide');
            mensajeProceso(datos)
          })
          .catch((error) => {
            $("#formMusica2").modal('hide');
            // $('#modalConsulta').modal('hide');
            mensajeError(error);
          });
      });
    // === FIN CARGA MUSICA 2 A LA BD ===

    // === CARGA ELEMENTOS A LA BD ===
    var formulario3 = document.getElementById("formElementos");
    document
      .getElementById("formElementos")
      .addEventListener("submit", function(e) {
        e.preventDefault();
        var datos = new FormData(formulario3);
        // envian los datos a modificar en la base de datos
        fetch(`api/music_elements.php`, {
            method: "POST",
            body: datos,
            headers: {
              Accept: "application/json",
            },
          })
          .then((respuesta) => respuesta.json())
          .then((datos) => {
            // $('#modalConsulta').modal('hide');
            $('#formElementos').modal('hide');
            mensajeProceso(datos)
          })
          .catch((error) => {
            $("#formElementos").modal('hide');
            // $('#modalConsulta').modal('hide');
            mensajeError(error);
          });
      });
    // === FIN CARGA ELEMENTOS A LA BD ===

    // === MENSAJE DE LOS PEOCESOS de CARGA ===
    function mensajeProceso(datos) {
      if (datos == 1) {
        Swal.fire({
          icon: "success",
          title: "Ok!",
          text: "Datos actualizados!",
        }).then((result) => {
          refresh();
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "Ups..!",
          text: datos,
        });
      }
    }

    function mensajeError(error) {
      console.error("Error en la solicitud:", error);
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Hubo un error SQL al intentar modificar!. Por favor, inténtalo de nuevo.",
      });
    }
    // === FIN MENSAJE DE LOS PEOCESOS DE CARGA ===

    // === BORRA ARCHIVO CARGADO ===
    function confirmarBorrarDato(id, nombre, apellido, disciplina, dato, opcion) {
      Swal.fire({
        title: "Esta seguro?",
        html: '<p>Esta por borrar </p><b>' + dato + '</b>' + `<p>de: </p>` + '<b>' + nombre + ' ' + apellido + '</b>' + '<p>Disciplina: </p>' + '<b>' + disciplina + '</b>',
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Aceptar",
        cancelButtonText: "Cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
          borrarDato(id, opcion)
        }
      });

      function borrarDato() {
        fetch(
            `api/music_elements.php?id=${id}&opcion=${opcion}`, {
              method: 'GET',
              headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
              },
            },
          )
          .then((respuesta) => respuesta.json())
          .then((datos) => {
            if (datos == 1) {
              Swal.fire({
                icon: "success",
                title: "Ok!",
                text: "Eliminación exitosa!",
              }).then((result) => {
                refresh();
              });
            } else {
              Swal.fire({
                icon: "error",
                title: "Ups..!",
                text: datos,
              });
            }
          })
          .catch((error) => {
            $("#formComAlta").modal('hide');
            // $('#modalConsulta').modal('hide');
            console.error("Error en la solicitud:", error);
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "Hubo un error SQL al intentar modificar!. Por favor, inténtalo de nuevo.",
            });
          });
      }
    }

    // === FIN BORRA ARCHIVO CARGADO ===


    // == CARGAR ARCHIVO COMPROBANTES ==
    function onLoadConsultaMusica1(files) {
      if (files[0].name && files[0]) {
        document
          .getElementById('textoMusica1')
          .innerHTML = files[0].name;
      }
    }

    function onLoadConsultaMusica2(files) {
      if (files[0].name && files[0]) {
        document
          .getElementById('textoMusica2')
          .innerHTML = files[0].name;
      }
    }

    function onLoadConsultaElementos(files) {
      if (files[0].name && files[0]) {
        document
          .getElementById('textoElementos')
          .innerHTML = files[0].name;
      }
    }
    // == FIN CARGAR ARCHIVO COMPROBANTES ==

    // === MOSTRAR - OCULTAR FILTRO ===
    var valorFiltro = localStorage.mostrarFiltro_users_musica;

    function filtros() {
      if (valorFiltro == 1) {
        mostrarFiltros()
      } else {
        ocultarFiltros()
      }
    }

    function mostrarFiltros() {
      var mostrarFiltro_users_musica = 1;
      localStorage.mostrarFiltro_users_musica = mostrarFiltro_users_musica;
      $('#mostrarFiltros').hide();
      $('#ocultarFiltros').show();
      $('.dtsp-panesContainer').show();
      $('.dtsb-searchBuilde').show();
    }

    function ocultarFiltros() {
      var mostrarFiltro_users_musica = 0;
      localStorage.mostrarFiltro_users_musica = mostrarFiltro_users_musica;
      $('#mostrarFiltros').show();
      $('#ocultarFiltros').hide();
      $('.dtsp-panesContainer').hide();
      $('.dtsb-searchBuilder').hide();
    }
    // === FIN MOSTRAR - OCULTAR FILTRO ===

    function refresh() {
      table.ajax.reload(null, false);
    }
  </script>
</body>

</html>