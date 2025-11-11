<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre_cliente'];
    $destino = $_POST['destino'];
    $personas = $_POST['personas'];
    $inicio = $_POST['fecha_inicio'];
    $fin = $_POST['fecha_fin'];
    $pago = $_POST['metodo_pago'];
    $total = $_POST['total'];

    $sql = "INSERT INTO paquetes (nombre_cliente, destino, personas, fecha_inicio, fecha_fin, metodo_pago, total)
            VALUES ('$nombre', '$destino', '$personas', '$inicio', '$fin', '$pago', '$total')";

    if ($conn->query($sql) === TRUE) {
        echo "<h2>✅ Paquete guardado exitosamente</h2>";
        echo "<a href='index.php'>Volver al inicio</a>";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
