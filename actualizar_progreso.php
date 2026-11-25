<?php
ini_set('session.gc_maxlifetime', (string) (30 * 24 * 60 * 60));
session_start();


header("Content-Type: application/json");


$conexion = new mysqli(
    "localhost",
    "root",
    "",
    "otomingo_pedro"
);


if ($conexion->connect_error) {


    echo json_encode([
        "success" => false,
        "mensaje" => "Error de conexión"
    ]);


    exit;
}


if (!isset($_SESSION['id_usuario'])) {


    echo json_encode([
        "success" => false,
        "mensaje" => "Debes iniciar sesión"
    ]);


    exit;
}


$datos = json_decode(
    file_get_contents("php://input"),
    true
);


$puntajeGanado = (int)$datos["experienciaGanada"];


$idUsuario = $_SESSION["id_usuario"];


$sql = "
UPDATE progreso
SET
    experiencia = experiencia + ?,
    racha = racha + 1,
    porcentaje = LEAST(porcentaje + 5,100)
WHERE id_usuario = ?
";


$stmt = $conexion->prepare($sql);


$stmt->bind_param(
    "ii",
    $puntajeGanado,
    $idUsuario
);


$resultado = $stmt->execute();


echo json_encode([
    "success" => $resultado
]);


$stmt->close();
$conexion->close();
?>