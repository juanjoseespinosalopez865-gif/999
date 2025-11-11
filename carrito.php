<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $destino = $_POST['destino'];
    $personas = $_POST['pasajeros'];
    $inicio = $_POST['fecha_ida'];
    $fin = $_POST['fecha_regreso'];
    $pago = $_POST['pago'];

    // Usar sentencias preparadas para prevenir inyección SQL
    $sql = "INSERT INTO paquetes (nombre_cliente, destino, personas, fecha_inicio, fecha_fin, metodo_pago)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisss", $nombre, $destino, $personas, $inicio, $fin, $pago);

    if ($stmt->execute()) {
        echo "<h2>✅ Paquete guardado exitosamente</h2>";
        echo "<a href='index.php'>Volver al inicio</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
