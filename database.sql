CREATE DATABASE IF NOT EXISTS vsi_adventure;
USE vsi_adventure;

CREATE TABLE IF NOT EXISTS usuario (
    ID_Usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    gmail VARCHAR(255) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS paquetes (
    ID_paquete INT AUTO_INCREMENT PRIMARY KEY,
    nombre_cliente VARCHAR(255) NOT NULL,
    destino VARCHAR(255) NOT NULL,
    personas INT NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL,
    metodo_pago VARCHAR(255) NOT NULL
);