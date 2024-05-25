<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "ventavision1";

// Intenta establecer la conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verifica si hay algún error en la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se envió el formulario de inicio de sesión
if (isset($_POST['login-submit'])) {
    // Recibir datos del formulario
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    // Consulta preparada para evitar inyección SQL
    $sql = "SELECT * FROM usuarios WHERE email = ? AND contraseña = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usuario, $contraseña);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Usuario encontrado, redirigir según el tipo de usuario
        $row = $result->fetch_assoc();
        if ($row['tipo_usuario'] == 'Administrador') {
            header("Location: ../MENU/menuadmin.html");
            exit();
        } elseif ($row['tipo_usuario'] == 'Empleado') {
            header("Location: ../MENU/menuusuario.html");
            exit();
        }
    } else {
        $error_message = "Usuario o contraseña incorrectos";
    }
}

// Cierra la conexión
$conn->close();
?>
