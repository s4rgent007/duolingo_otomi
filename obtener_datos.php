<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "otomingo_pedro";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode([
        'success' => false,
        'mensaje' => 'Error de conexión: ' . $conn->connect_error
    ]);
    exit();
}

header('Content-Type: application/json');


header('Content-Type: application/json');


if (!isset($_SESSION['id_usuario'])) {
    echo json_encode([
        'success' => false,
        'mensaje' => 'No hay sesión iniciada'
    ]);
    exit();
}


$id_usuario = $_SESSION['id_usuario'];
//$sql = "SELECT * FROM progreso WHERE id_usuario = ?";
$sql ="
SELECT
    u.nombre,
    u.email,
    u.nivel,
    u.pais,
    p.porcentaje,
    p.experiencia,
    p.racha,
    p.fecha_resgistro,
    p.id_curso
FROM usuario u
INNER JOIN progreso p
    ON u.id_usuario = p.id_usuario
WHERE u.id_usuario = ?
";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode([
        'success' => false,
        'error_sql' => $conn->error
    ]);
    exit();
}

$stmt->bind_param("i", $id_usuario);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();


$resultado = $stmt->get_result();


if ($fila = $resultado->fetch_assoc()) {


    echo json_encode([
        'success' => true,
        'datos' => $fila
    ]);


} else {


    echo json_encode([
        'success' => false,
        'mensaje' => 'Perfil no encontrado'
    ]);
}


$stmt->close();
$conn->close();
?>