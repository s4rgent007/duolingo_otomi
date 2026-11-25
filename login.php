<?php
// Datos de conexión
$servername = "localhost";
$username = "root"; // usuario por defecto en XAMPP
$password = "";     // contraseña vacía por defecto
$dbname = "otomingo_pedro";
// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);
// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
// Obtener datos del formulario
$email = $_POST['email'];
$pass = $_POST['contrasena'];
// Preparar consulta segura
$stmt = $conn->prepare("SELECT * FROM usuario WHERE email = ? AND contraseña = ?");
$stmt->bind_param("ss", $email, $pass);
$stmt->execute();
$result = $stmt->get_result();
// Validar usuario
if ($result->num_rows > 0) {


    $usuario = $result->fetch_assoc();


    session_start();


    $_SESSION['usuario'] = $usuario['email'];
    $_SESSION['id_usuario'] = $usuario['id_usuario'];
    $_SESSION['nombre'] = $usuario['nombre'];


    echo "<script>
            window.location.href='unidad_animales.html';
          </script>";
    exit();
}
$stmt->close();
$conn->close();
?>