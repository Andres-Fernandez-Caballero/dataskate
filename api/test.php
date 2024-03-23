<?php

use PhpParser\Node\Expr\Empty_;

session_start();

require '../database.php';

date_default_timezone_set("America/Argentina/Buenos_Aires");

// BORRADO MASIVO DE COMPROBANTES
$cuit = 1001;
// Consulta SQL para obtener la lista de nombres de archivo
$sql = "SELECT prerecibos.foto FROM prerecibos WHERE prerecibos.cuit = '$cuit'";
$result = mysqli_query($conexion, $sql);
// Verificar si la consulta tuvo éxito
if ($result) {
    // Iterar sobre los resultados y eliminar los archivos
    while ($row = mysqli_fetch_assoc($result)) {
        if (!empty($row['foto'])) {                 //verifica si exsite nombre de archivo en la tabla
            $filePath = '../foto/' . $row['foto'];  // establece la ruta del archivo
            if (file_exists($filePath)) {           // verifica si esxite el archivo físico
                unlink($filePath);                  // elimina archivo físico
            }
        }
    }
}
// Liberar el resultado

mysqli_close($conexion);
