<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $gmail = $_POST['gmail'];
    $contrasena = $_POST['contrasena'];

    // Validar que los campos no estén vacíos
    if (empty($nombre) || empty($gmail) || empty($contrasena)) {
        echo "Todos los campos son obligatorios.";
    } else {
        // Hashear la contraseña
        $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

        // Preparar la consulta para evitar inyección SQL
        $stmt = $conn->prepare("INSERT INTO usuario (nombre, gmail, contrasena) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nombre, $gmail, $hashed_password);

        if ($stmt->execute()) {
            // Redirigir al login si el registro es exitoso
            header("Location: Login.html");
            exit();
        } else {
            // Comprobar si es un error de duplicado
            if ($conn->errno == 1062) {
                echo "Error: El correo electrónico ya está registrado.";
            } else {
                echo "Error: " . $stmt->error;
            }
        }

        $stmt->close();
    }
    $conn->close();
}
?>