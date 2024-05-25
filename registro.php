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

// Verificar si se ha enviado el formulario de registro
if (isset($_POST['registro-submit'])) {
    // Recibir datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $contraseña = $_POST['contraseña_reg'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $tipo_usuario = $_POST['tipo-usuario'];

    // Insertar datos en la base de datos
    $sql = "INSERT INTO usuarios (nombre, apellido, contraseña, email, telefono, tipo_usuario) VALUES ('$nombre', '$apellido', '$contraseña', '$email', '$telefono', '$tipo_usuario')";

    if ($conn->query($sql) === TRUE) {
        // Registro exitoso, redirigir a la página de login
        header("Location: login.html");
        exit();
    } else {
        // Error al registrar
        echo "Error al registrar: " . $sql . "<br>" . $conn->error;
    }
}

// Cierra la conexión
$conn->close();
?>
