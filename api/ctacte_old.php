<?php
session_start();

require '../database.php';
date_default_timezone_set("America/Argentina/Buenos_Aires");

if (isset($_SESSION['user_id'])) {

    $records = $conn->prepare('SELECT users.*, clubs.institucion, clubs.cuit FROM users, clubs WHERE users.cuit = clubs.cuit AND users.id= :id');

    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
        $user = $results;
    } else {
        header("Location: ../index.php");
    }
}

// verifica si el usuario esta logeado
if (!isset($user)) {
    header("Location: ../index.php");
}

if (isset($_GET['opcion'])) {
    $opcion = $_GET['opcion'];
}



if (isset($_POST['opcion'])) {
    $opcion = $_POST['opcion'];
    $cuit = $_POST['cuit'];
    $tipo_comprobante = $_POST['tipoComprobante'];
    $fecha_alta = $_POST['fechaAlta'];
    $concepto = $_POST['concepto'];
    $comentarios = $_POST['comentarios'];
    if ($tipo_comprobante == 'Ticket' || $tipo_comprobante == 'Debito') {
        $pagado = 0;
        $adeudado = $_POST['monto'];
    } else if ($tipo_comprobante == 'Credito') {
        $pagado = $_POST['monto'];
        $adeudado = 0;
    } else {
        $forma_pago = $_POST['forma_pago'];
        $num_comp_pago = $_POST['num_comp_pago'];
        $fecha_pago = $_POST['fecha_pago'];
        $entidad_pago = $_POST['entidad_pago'];
        $id_depositante = $_POST['id_depositante'];
        $num_recibo = $_POST['num_recibo'];
        $pagado = $_POST['monto'];
        $adeudado = 0;
    };
}

switch ($opcion) {
    case 0:
        // Carga la tabla cta cte general (resumen)
        $cuit = $user['cuit'];

        if ($user['acceso'] != 'administrador') {
            $sql = "SELECT ctacte.cuit, clubs.institucion, FORMAT(SUM(ctacte.adeudado - ctacte.pagado), 2) AS saldo, ctacte.id FROM ctacte, clubs WHERE ctacte.cuit=clubs.cuit AND ctacte.cuit=$cuit GROUP BY ctacte.cuit";
        } else {
            $sql = "SELECT ctacte.cuit, clubs.institucion, FORMAT(SUM(ctacte.adeudado - ctacte.pagado), 2) AS saldo, ctacte.id FROM ctacte, clubs WHERE ctacte.cuit=clubs.cuit GROUP BY ctacte.cuit;";
        };

        // $sql = "SELECT ctacte.cuit, clubs.institucion, FORMAT(SUM(ctacte.adeudado - ctacte.pagado), 2) AS saldo, ctacte.id FROM ctacte, clubs WHERE ctacte.cuit=clubs.cuit GROUP BY ctacte.cuit;";

        $result = mysqli_query($conexion, $sql);
        while ($fila = mysqli_fetch_array($result)) {
            $arreglo["data"][] = $fila;
        }
        if (empty($arreglo)) {
            echo json_encode($array = [
                "cuit" => "-",
                "institucion" => "-",
                "saldo" => "-",
                "id" => "-",
            ]);
        } else {
            echo json_encode($arreglo);
        }

        break;

    case 1:
        /// Carga la tabla cta cte general (detalle)
        $cuit = $_GET['cuit'];

        $sql = "SELECT
        ctacte.concepto,
        ctacte.tipo_comprobante,
        ctacte.id,
        DATE_FORMAT(ctacte.fecha_alta, '%d-%m-%Y') AS fecha_alta,
        IF(
            ctacte.fecha_pago <> '',
            DATE_FORMAT(ctacte.fecha_pago, '%d-%m-%Y'),
            '-'
        ) AS fecha_pago,
        IFNULL(ctacte.num_comp_pago,'-') AS num_comp_pago,
        FORMAT(ctacte.adeudado, 2) AS adeudado,
        FORMAT(ctacte.pagado, 2) AS pagado,
        clubs.institucion,
        clubs.cuit,
        IFNULL(ctacte.dnipatinador,'-') AS dnipatinador,
        IFNULL(ctacte.forma_pago,'-') AS forma_pago,
        IFNULL(ctacte.tipolicencia,'-') AS tipolicencia,
        IFNULL(CONCAT(patinadores.nombrepatinador,' ',patinadores.apellidopatinador),'-') AS nombrepatinador,
        IFNULL(ctacte.id_depositante,'-') AS id_depositante,
        IFNULL(ctacte.num_recibo,'-') AS num_recibo
    FROM
        ctacte
    LEFT JOIN patinadores ON ctacte.dnipatinador = patinadores.dnipatinador
    LEFT JOIN clubs ON ctacte.cuit = clubs.cuit
    WHERE
        ctacte.cuit = $cuit";


        $result = mysqli_query($conexion, $sql);

        while ($fila = mysqli_fetch_array($result)) {
            $arreglo["data"][] = $fila;
        }
        if (empty($arreglo)) {
            echo json_encode($array = [
                "concepto" => "-",
                "tipo_comprobante" => "-",
                "fecha_alta" => "-",
                "fecha_pago" => "-",
                "num_comp_pago" => "-",
                "id" => "-",
                "adeudado" => "-",
                "pagado" => "-",
                "dnipatinador" => "-",
                "forma_pago" => "-",
            ]);
        } else {
            echo json_encode($arreglo);
        }
        break;

    case 2:
        // Consulta SALDO por CUIT para detalle agrupado
        $cuit = $_GET['cuit'];

        $sql = "SELECT ctacte.*, FORMAT(SUM(ctacte.adeudado), 2) AS adeudado, FORMAT(SUM(ctacte.pagado), 2) AS pagado, FORMAT(SUM(ctacte.adeudado - ctacte.pagado), 2) AS saldo FROM ctacte WHERE ctacte.cuit=$cuit GROUP BY ctacte.cuit;";

        $result = mysqli_query($conexion, $sql);

        $datos = array();
        while ($fila = mysqli_fetch_array($result)) {
            array_push($datos, $fila);
        }
        echo json_encode($datos);
        break;

    case 3:
        // Baja comprobantes by ID
        $id = $_GET['id'];

        $sql = "DELETE FROM ctacte WHERE ctacte.id = '$id';";
        if (mysqli_query($conexion, $sql)) {
            echo json_encode('1');
        } else {
            echo json_encode('0');
        };
        break;

    case 4:
        // Altas comprobantes

        $dnialta = $user['dni'];
        $nombrealta = $user['nombre'];
        $apellidoalta = $user['apellido'];
        $cuitalta = $user['cuit'];
        $institucionalta = $user['institucion'];
        $fechaalta = date('Y-m-d');

        if ($tipo_comprobante == 'Ticket' || $tipo_comprobante == 'Debito' || $tipo_comprobante == 'Credito') {
            $sql = "INSERT INTO ctacte (cuit, tipo_comprobante, fecha_alta, concepto, adeudado, pagado, comentarios, dnialta, apellidoalta, nombrealta, cuitalta, institucionalta, fechaalta) VALUES ('$cuit', '$tipo_comprobante', '$fecha_alta', '$concepto', '$adeudado', '$pagado', '$comentarios', '$dnialta', '$apellidoalta', '$nombrealta', '$cuitalta', '$institucionalta', '$fechaalta')";
        } else {
            $sql = "INSERT INTO ctacte (cuit, tipo_comprobante, fecha_alta, concepto, forma_pago, num_comp_pago, entidad_pago, pagado, adeudado, fecha_pago, comentarios, id_depositante, num_recibo, dnialta, apellidoalta, nombrealta, cuitalta, institucionalta, fechaalta) VALUES ('$cuit', '$tipo_comprobante', '$fecha_alta', '$concepto', '$forma_pago', '$num_comp_pago', '$entidad_pago', '$pagado', '$adeudado', '$fecha_pago', '$comentarios', '$id_depositante', '$num_recibo', '$dnialta', '$apellidoalta', '$nombrealta', '$cuitalta', '$institucionalta', '$fechaalta')";
        };

        if (mysqli_query($conexion, $sql)) {
            echo json_encode('1');
        } else {
            echo json_encode('El comprobante no pudo registrarse!');
        };

        break;

    case 5:
        //consulta detalle cta cte segun CUIT
        $id = $_GET['id'];

        $sql = "SELECT ctacte.*, clubs.institucion FROM ctacte, clubs WHERE ctacte.id= '$id' AND ctacte.cuit=clubs.cuit;";

        $result = mysqli_query($conexion, $sql);

        $datos = array();
        while ($fila = mysqli_fetch_array($result)) {
            array_push($datos, $fila);
        }
        echo json_encode($datos);
        break;

    case 6:
        //consulta detalle cta cte segun ID
        $id = $_GET['id'];

        $sql = "SELECT ctacte.*, DATE_FORMAT(ctacte.fecha_alta, '%Y-%m-%d') AS fecha_alta, IF(ctacte.fecha_pago<>'', DATE_FORMAT(ctacte.fecha_pago, '%Y-%m-%d'),'-') AS fecha_pago, clubs.institucion, DATE_FORMAT(ctacte.fechaalta, '%d-%m-%Y') AS newfechaalta, DATE_FORMAT(ctacte.fechamod, '%d-%m-%Y') AS newfechamod FROM ctacte, clubs WHERE ctacte.cuit=clubs.cuit AND ctacte.id=$id;";

        $result = mysqli_query($conexion, $sql);

        $datos = array();
        while ($fila = mysqli_fetch_array($result)) {
            array_push($datos, $fila);
        }
        echo json_encode($datos);
        break;

    case 7:
        // Actualiza los datos
        $id = $_POST['id'];

        $dnimod = $user['dni'];
        $nombremod = $user['nombre'];
        $apellidomod = $user['apellido'];
        $cuitmod = $user['cuit'];
        $institucionmod = $user['institucion'];
        $fechamod = date('Y-m-d');

        // seleccionar si se acualiza RECIBO o LBF
        if ($tipo_comprobante === 'Ticket' || $tipo_comprobante == 'Debito' || $tipo_comprobante == 'Credito') {
            $sql = "UPDATE ctacte SET comentarios='$comentarios', dnimod = '$dnimod', nombremod = '$nombremod', apellidomod = '$apellidomod', cuitmod = '$cuitmod', institucionmod = '$institucionmod', fechamod = '$fechamod' WHERE ctacte.id = $id;";
        } else {
            $sql = "UPDATE ctacte SET  tipo_comprobante = '$tipo_comprobante', fecha_alta = '$fecha_alta', concepto = '$concepto', tipo_comprobante = '$tipo_comprobante', pagado='$pagado', adeudado='$adeudado', forma_pago='$forma_pago', num_comp_pago='$num_comp_pago', fecha_pago='$fecha_pago', entidad_pago='$entidad_pago', comentarios='$comentarios', id_depositante='$id_depositante', num_recibo='$num_recibo', dnimod = '$dnimod', nombremod = '$nombremod', apellidomod = '$apellidomod', cuitmod = '$cuitmod', institucionmod = '$institucionmod', fechamod = '$fechamod' WHERE ctacte.id = $id;";
        }

        if (mysqli_query($conexion, $sql)) {
            echo json_encode('1');
        } else {
            echo json_encode('0');
        }
        break;

    case 8:
        // Baja CtaCte by CUIT
        $cuit = $_GET['cuit'];

        $dnibaja = $user['dni'];
        $nombrebaja = $user['nombre'];
        $apellidobaja = $user['apellido'];
        $institucionbaja = $user['institucion'];
        $recicledtabla = 'CatCte';

        $sql = "INSERT INTO recicled(
            recicleddni,
            reciclednombre,
            recicledapellido,
            recicledinstitucion,
            recicledtabla,
            dnibaja,
            nombrebaja,
            apellidobaja,
            institucionbaja,
            fechabaja
        )
        VALUES(
            (
            SELECT
                ctacte.cuit AS recicleddni
            FROM
                ctacte
            WHERE
                ctacte.cuit = $cuit
            GROUP BY
                ctacte.cuit
        ),
        '-',
        '-',
        (
            SELECT
                clubs.institucion AS recicledinstitucion
            FROM
                clubs
            WHERE
                clubs.cuit = $cuit
        ),
        '$recicledtabla',
        '$dnibaja',
        '$nombrebaja',
        '$apellidobaja',
        '$institucionbaja',
        CURRENT_DATE())";

        // $sql = "DELETE FROM ctacte WHERE ctacte.cuit = '$cuit';";
        if (mysqli_query($conexion, $sql)) {
            $sql = "DELETE FROM ctacte WHERE ctacte.cuit = '$cuit';";
            if (mysqli_query($conexion, $sql)) {
                echo json_encode('1');
            } else {
                echo json_encode('0');
            };
        } else {
            echo json_encode('0');
        };
        break;
}
mysqli_close($conexion);
