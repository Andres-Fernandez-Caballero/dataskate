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
    $id = $_POST['id'];
    $opcion = $_POST['opcion'];
    // $musica1 = $_POST['musica1'];
    // $musica2 = $_POST['musica2'];
    // $elemetntos = $_POST['elementos'];
}

switch ($opcion) {
    case 0:
        // LISTA TORNEO 
        // // Consulta de todos los patinadores según Administradores o según Usuarios
        $cuit = $user['cuit'];

        if ($user['acceso'] === 'tecnico' || $user['acceso'] === 'delegado') {

            $sql = "SELECT
            buenafe.dnibuenafe,
            IFNULL(patinadores.sexopatinador, '**') AS sexopatinador,
            IFNULL(
                patinadores.apellidopatinador,
                '**'
            ) AS apellidopatinador,
            IFNULL(
                patinadores.nombrepatinador,
                '**EMPADRONAR**'
            ) AS nombrepatinador,
            IFNULL(
                DATE_FORMAT(
                    patinadores.fechanacpatinador,
                    '%d-%m-%Y'
                ),
                '**'
            ) AS fechanacimiento,
            IFNULL(
                YEAR(CURDATE()) - YEAR(patinadores.fechanacpatinador),
                '**') AS edad,
            buenafe.disciplina,
            buenafe.divisional,
            buenafe.eficiencia,
            buenafe.categoria,
            IFNULL(patinadores.tipolicencia, '**') AS tipolicencia,
            buenafe.torneo,
            IFNULL(
                    clubs.institucion,
                    buenafe.institucionalta
                ) AS institucion,
            concat_ws(' - ', buenafe.disciplina, buenafe.divisional, buenafe.eficiencia, buenafe.categoria) AS nivel,
            disciplinas.ordendisciplina,
            divisional.ordendivisional,
            eficiencia.ordeneficiencia,
            categorias.ordencategoria,
            buenafe.id,
            buenafe.programa1,
            buenafe.musica1,
            buenafe.musica2,
            buenafe.elementos
            FROM
                buenafe
            LEFT JOIN patinadores ON buenafe.dnibuenafe = patinadores.dnipatinador
            LEFT JOIN clubs ON patinadores.cuit = clubs.cuit
            LEFT JOIN users ON buenafe.dnialta = users.dni
            LEFT JOIN divisional ON buenafe.divisional = divisional.divisional
            LEFT JOIN eficiencia ON buenafe.eficiencia = eficiencia.eficiencia
            LEFT JOIN categorias ON buenafe.categoria = categorias.categoria
            LEFT JOIN disciplinas ON buenafe.disciplina = disciplinas.disciplina
            LEFT JOIN torneo ON buenafe.torneo = torneo.nombretorneo
            WHERE (patinadores.cuit=$cuit OR buenafe.cuitalta=$cuit) AND estadoelementos='Abierto' AND buenafe.estado='ACTIVO' ORDER BY patinadores.sexopatinador, apellidopatinador";
        } else if ($user['acceso'] === 'invitado') {
            $sql = "SELECT
            buenafe.dnibuenafe,
            IFNULL(patinadores.sexopatinador, '**') AS sexopatinador,
            IFNULL(
                patinadores.apellidopatinador,
                '**'
            ) AS apellidopatinador,
            IFNULL(
                patinadores.nombrepatinador,
                '**EMPADRONAR**'
            ) AS nombrepatinador,
            IFNULL(
                DATE_FORMAT(
                    patinadores.fechanacpatinador,
                    '%d-%m-%Y'
                ),
                '**'
            ) AS fechanacimiento,
            IFNULL(
                YEAR(CURDATE()) - YEAR(patinadores.fechanacpatinador),
                '**') AS edad,
            buenafe.disciplina,
            buenafe.divisional,
            buenafe.eficiencia,
            buenafe.categoria,
            IFNULL(patinadores.tipolicencia, '**') AS tipolicencia,
            buenafe.torneo,
            IFNULL(
                    clubs.institucion,
                    buenafe.institucionalta
                ) AS institucion,
            concat_ws(' - ', buenafe.disciplina, buenafe.divisional, buenafe.eficiencia, buenafe.categoria) AS nivel,
            disciplinas.ordendisciplina,
            divisional.ordendivisional,
            eficiencia.ordeneficiencia,
            categorias.ordencategoria,
            buenafe.id,
            -- buenafe.estado,
            buenafe.programa1,
            buenafe.musica1,
            buenafe.musica2,
            buenafe.elementos
            FROM
                buenafe
            LEFT JOIN patinadores ON buenafe.dnibuenafe = patinadores.dnipatinador
            LEFT JOIN clubs ON patinadores.cuit = clubs.cuit
            LEFT JOIN users ON buenafe.dnialta = users.dni
            LEFT JOIN divisional ON buenafe.divisional = divisional.divisional
            LEFT JOIN eficiencia ON buenafe.eficiencia = eficiencia.eficiencia
            LEFT JOIN categorias ON buenafe.categoria = categorias.categoria
            LEFT JOIN disciplinas ON buenafe.disciplina = disciplinas.disciplina
            LEFT JOIN torneo ON buenafe.torneo = torneo.nombretorneo
            WHERE buenafe.estado='ACTIVO' AND torneo.estadotorneo<>'Terminado' ORDER BY buenafe.torneo, patinadores.sexopatinador, apellidopatinador";
        } else { // ADMINISTRADOR
            $sql = "SELECT
            buenafe.dnibuenafe,
            IFNULL(patinadores.sexopatinador, '**') AS sexopatinador,
            IFNULL(
                patinadores.apellidopatinador,
                '**'
            ) AS apellidopatinador,
            IFNULL(
                patinadores.nombrepatinador,
                '**EMPADRONAR**'
            ) AS nombrepatinador,
            IFNULL(
                DATE_FORMAT(
                    patinadores.fechanacpatinador,
                    '%d-%m-%Y'
                ),
                '**'
            ) AS fechanacimiento,
            IFNULL(
                YEAR(CURDATE()) - YEAR(patinadores.fechanacpatinador),
                '**') AS edad,
            buenafe.disciplina,
            buenafe.divisional,
            buenafe.eficiencia,
            buenafe.categoria,
            IFNULL(patinadores.tipolicencia, '**') AS tipolicencia,
            buenafe.torneo,
            IFNULL(
                    clubs.institucion,
                    buenafe.institucionalta
                ) AS institucion,
            concat_ws(' - ', buenafe.disciplina, buenafe.divisional, buenafe.eficiencia, buenafe.categoria) AS nivel,
            disciplinas.ordendisciplina,
            divisional.ordendivisional,
            eficiencia.ordeneficiencia,
            categorias.ordencategoria,
            buenafe.id,
            -- buenafe.estado,
            buenafe.programa1,
            buenafe.musica1,
            buenafe.musica2,
            buenafe.elementos
            FROM
                buenafe
            LEFT JOIN patinadores ON buenafe.dnibuenafe = patinadores.dnipatinador
            LEFT JOIN clubs ON patinadores.cuit = clubs.cuit
            LEFT JOIN users ON buenafe.dnialta = users.dni
            LEFT JOIN divisional ON buenafe.divisional = divisional.divisional
            LEFT JOIN eficiencia ON buenafe.eficiencia = eficiencia.eficiencia
            LEFT JOIN categorias ON buenafe.categoria = categorias.categoria
            LEFT JOIN disciplinas ON buenafe.disciplina = disciplinas.disciplina
            WHERE buenafe.estado='ACTIVO' ORDER BY buenafe.torneo, patinadores.sexopatinador, apellidopatinador";
        }

        $result = mysqli_query($conexion, $sql);
        while ($fila = mysqli_fetch_array($result)) {
            $arreglo["data"][] = $fila;
        }

        // echo json_encode($arreglo);

        if (!isset($arreglo["data"])) {
            echo json_encode($fila);
        } else {
            echo json_encode($arreglo);
        }
        break;

    case 1:
        // Actualiza los datos MUSICA 1
        // Verifica si se ha enviado un archivo
        if (!empty($_FILES["musica1"]["name"])) {
            // Obtiene el ID del registro a actualizar
            $id = $_POST['id'];

            // MUSIACA 1
            // Verifica si hay un archivo anterior en la DB
            $sql = "SELECT musica1 FROM buenafe WHERE id = $id";
            $result = mysqli_query($conexion, $sql);
            $row = mysqli_fetch_assoc($result);
            // arma la ruta del archivo consultado
            $previousFile = $row['musica1'];
            $previousFilePath = "../" . $row['musica1'];

            // // Elimina el archivo anterior si existe
            if (!empty($previousFile)) {
                unlink($previousFilePath);
            }

            $fileName = basename($_FILES["musica1"]["name"]);
            $allowTypes = array('mp3', 'MP3'); //topo de archivos permitidos
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

            if (in_array($fileType, $allowTypes)) {
                // Sube el nuevo archivo
                $randomNumber = rand(1000, 9999);
                $targetDirectory = "../musica/";
                $targetFile = $targetDirectory . $randomNumber . '_' . basename($_FILES["musica1"]["name"]);
                $targetDirectoryDB = "musica/";
                $targetFileDB = $targetDirectoryDB . $randomNumber . '_' . basename($_FILES["musica1"]["name"]);

                $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

                if (move_uploaded_file($_FILES["musica1"]["tmp_name"], $targetFile)) {
                    // Actualiza la ruta del archivo en la base de datos
                    $filePathInDatabase = mysqli_real_escape_string($conexion, $targetFileDB);
                    $sql = "UPDATE buenafe SET musica1 = '$filePathInDatabase' WHERE id = $id";
                    if (mysqli_query($conexion, $sql)) {
                        echo json_encode("1");
                        break;
                    } else {
                        echo json_encode("Error al actualizar la música en la base de datos: " . mysqli_error($conexion));
                        break;
                    }
                } else {
                    echo json_encode("Error al subir el nuevo archivo de música.");
                    break;
                }
            } else {
                echo json_encode("Solo se permiten archivos MP3");
                break;
            }
        } else {
            echo json_encode("Nose pudo subir el archivo MP3");
        }

        break;

    case 2:
        // Actualiza los datos MUSICA 1
        // Verifica si se ha enviado un archivo
        if (!empty($_FILES["musica2"]["name"])) {
            // Obtiene el ID del registro a actualizar
            $id = $_POST['id'];

            // MUSIACA 1
            // Verifica si hay un archivo anterior en la DB
            $sql = "SELECT musica2 FROM buenafe WHERE id = $id";
            $result = mysqli_query($conexion, $sql);
            $row = mysqli_fetch_assoc($result);
            // arma la ruta del archivo consultado
            $previousFile = $row['musica2'];
            $previousFilePath = "../" . $row['musica2'];

            // // Elimina el archivo anterior si existe
            if (!empty($previousFile)) {
                unlink($previousFilePath);
            }

            $fileName = basename($_FILES["musica2"]["name"]);
            $allowTypes = array('mp3', 'MP3'); //topo de archivos permitidos
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

            if (in_array($fileType, $allowTypes)) {
                // Sube el nuevo archivo
                $randomNumber = rand(1000, 9999);
                $targetDirectory = "../musica/";
                $targetFile = $targetDirectory . $randomNumber . '_' . basename($_FILES["musica2"]["name"]);
                $targetDirectoryDB = "musica/";
                $targetFileDB = $targetDirectoryDB . $randomNumber . '_' . basename($_FILES["musica2"]["name"]);

                $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

                if (move_uploaded_file($_FILES["musica2"]["tmp_name"], $targetFile)) {
                    // Actualiza la ruta del archivo en la base de datos
                    $filePathInDatabase = mysqli_real_escape_string($conexion, $targetFileDB);
                    $sql = "UPDATE buenafe SET musica2 = '$filePathInDatabase' WHERE id = $id";
                    if (mysqli_query($conexion, $sql)) {
                        echo json_encode("1");
                        break;
                    } else {
                        echo json_encode("Error al actualizar la música en la base de datos: " . mysqli_error($conexion));
                        break;
                    }
                } else {
                    echo json_encode("Error al subir el nuevo archivo de música.");
                    break;
                }
            } else {
                echo json_encode("Solo se permiten archivos MP3");
                break;
            }
        } else {
            echo json_encode("Nose pudo subir el archivo MP3");
        }

        break;

    case 3:
        // Actualiza los datos ELEMENTOS
        // Verifica si se ha enviado un archivo
        if (!empty($_FILES["elementos"]["name"])) {
            // Obtiene el ID del registro a actualizar
            $id = $_POST['id'];

            // MUSIACA 1
            // Verifica si hay un archivo anterior en la DB
            $sql = "SELECT elementos FROM buenafe WHERE id = $id";
            $result = mysqli_query($conexion, $sql);
            $row = mysqli_fetch_assoc($result);
            // arma la ruta del archivo consultado
            $previousFile = $row['elementos'];
            $previousFilePath = "../" . $row['elementos'];

            // // Elimina el archivo anterior si existe
            if (!empty($previousFile)) {
                unlink($previousFilePath);
            }

            $fileName = basename($_FILES["elementos"]["name"]);
            $allowTypes = array('pdf', 'PDF'); //topo de archivos permitidos
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

            if (in_array($fileType, $allowTypes)) {
                // Sube el nuevo archivo
                $randomNumber = rand(1000, 9999);
                $targetDirectory = "../elementos/";
                $targetFile = $targetDirectory . $randomNumber . '_' . basename($_FILES["elementos"]["name"]);
                $targetDirectoryDB = "elementos/";
                $targetFileDB = $targetDirectoryDB . $randomNumber . '_' . basename($_FILES["elementos"]["name"]);

                $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

                if (move_uploaded_file($_FILES["elementos"]["tmp_name"], $targetFile)) {
                    // Actualiza la ruta del archivo en la base de datos
                    $filePathInDatabase = mysqli_real_escape_string($conexion, $targetFileDB);
                    $sql = "UPDATE buenafe SET elementos = '$filePathInDatabase' WHERE id = $id";
                    if (mysqli_query($conexion, $sql)) {
                        echo json_encode("1");
                        break;
                    } else {
                        echo json_encode("Error al actualizar el ELEMENTOS en la base de datos");
                        break;
                    }
                } else {
                    echo json_encode("Error al subir el nuevo archivo de ELEMENTOS.");
                    break;
                }
            } else {
                echo json_encode("Solo se permiten archivos PDF");
                break;
            }
        } else {
            echo json_encode("Nose pudo subir el archivo PDF");
        }

        break;

    case 4:
        // Baja MUSICA 1 by ID
        $id = $_GET['id'];

        $sql = "SELECT buenafe.musica1 FROM buenafe WHERE buenafe.id = '$id'";
        $result = mysqli_query($conexion, $sql);
        $row = mysqli_fetch_assoc($result);

        if (mysqli_query($conexion, $sql)) {
            if (!empty($row['musica1'])) {                 //verifica si exsite nombre de archivo en la tabla
                $filePath = "../" . $row['musica1'];  // establece la ruta del archivo
                if (file_exists($filePath)) {           // verifica si esxite el archivo físico
                    unlink($filePath);                  // elimina archivo físico
                }
                // Elimina el registro de la tabla
                $sql = "UPDATE buenafe SET musica1 = null WHERE id = $id";
                if (mysqli_query($conexion, $sql)) {
                    echo json_encode('1');
                    break;
                } else {
                    echo json_encode("No se pudo eliminar la MUSICA 1 de la Base de Datos");
                    break;
                };
            } else {
                echo json_encode("No hay MUSICA 1 para eliminar");
                break;
            }
        } else {
            echo json_encode("No hay MUSICA 1 para eliminar");
        }

        break;

    case 5:
        // Baja MUSICA 2 by ID
        $id = $_GET['id'];

        $sql = "SELECT buenafe.musica2 FROM buenafe WHERE buenafe.id = '$id'";
        $result = mysqli_query($conexion, $sql);
        $row = mysqli_fetch_assoc($result);

        if (mysqli_query($conexion, $sql)) {
            if (!empty($row['musica2'])) {                 //verifica si exsite nombre de archivo en la tabla
                $filePath = "../" . $row['musica2'];  // establece la ruta del archivo
                if (file_exists($filePath)) {           // verifica si esxite el archivo físico
                    unlink($filePath);                  // elimina archivo físico
                }
                // Elimina el registro de la tabla
                $sql = "UPDATE buenafe SET musica2 = null WHERE id = $id";
                if (mysqli_query($conexion, $sql)) {
                    echo json_encode('1');
                    break;
                } else {
                    echo json_encode("No se pudo eliminar la MUSICA 2 de la Base de Datos");
                    break;
                };
            } else {
                echo json_encode("No se puedo eliminar MUSICA 2");
                break;
            }
        } else {
            echo json_encode("No hay MUSICA 2 para eliminar");
        }

        break;

    case 6:
        // Baja ELEMENTOS by ID
        $id = $_GET['id'];

        $sql = "SELECT buenafe.elementos FROM buenafe WHERE buenafe.id = '$id'";
        $result = mysqli_query($conexion, $sql);
        $row = mysqli_fetch_assoc($result);

        if (mysqli_query($conexion, $sql)) {
            if (!empty($row['elementos'])) {                 //verifica si exsite nombre de archivo en la tabla
                $filePath = "../" . $row['elementos'];  // establece la ruta del archivo
                if (file_exists($filePath)) {           // verifica si esxite el archivo físico
                    unlink($filePath);                  // elimina archivo físico
                }
                // Elimina el registro de la tabla
                $sql = "UPDATE buenafe SET elementos = null WHERE id = $id";
                if (mysqli_query($conexion, $sql)) {
                    echo json_encode('1');
                    break;
                } else {
                    echo json_encode("No se pudo eliminar el DOCUMENTO de la Base de Datos");
                    break;
                };
            } else {
                echo json_encode("No se pudo eliminar el DOCUMENTO");
                break;
            }
        } else {
            echo json_encode("No hay DOCUMENTO para eliminar");
        }

        break;
}
