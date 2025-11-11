<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gmail = $_POST['gmail'];
    $contrasena = $_POST['contrasena'];

    if (empty($gmail) || empty($contrasena)) {
        echo "El correo y la contraseña son obligatorios.";
    } else {
        $stmt = $conn->prepare("SELECT ID_Usuario, nombre, contrasena FROM usuario WHERE gmail = ?");
        $stmt->bind_param("s", $gmail);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $nombre, $hashed_password);
            $stmt->fetch();

            if (password_verify($contrasena, $hashed_password)) {
                // Iniciar sesión
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $id;
                $_SESSION['nombre'] = $nombre;

                // Redirigir a la página de bienvenida o al index
                header("Location: index.php");
                exit();
            } else {
                echo "Contraseña incorrecta.";
            }
        } else {
            echo "No se encontró ningún usuario con ese correo electrónico.";
        }

        $stmt->close();
    }
    $conn->close();
}
?>