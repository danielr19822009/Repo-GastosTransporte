 ---  base de datos Transportes
DROP DATABASE IF EXISTS transporte;
create database transporte;
use transporte;


CREATE TABLE usuarios (
    cod_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nomb_usuario VARCHAR(50) NOT NULL,
    ape_usuario VARCHAR(50) NOT NULL,
    doc_usuario VARCHAR(50) NOT NULL,
    contrasena VARCHAR(100) NOT NULL,
    rol_usuario ENUM('admin', 'guest') DEFAULT 'guest'
);



-- Tabla de tipos de transporte
CREATE TABLE tipo_transporte (
    cod_tipotransporte INT PRIMARY KEY AUTO_INCREMENT,
    nomb_transporte ENUM('taxi', 'moto') DEFAULT 'taxi'
);



CREATE TABLE clientes (
    cod_cliente INT PRIMARY KEY AUTO_INCREMENT,
    nombre_cliente VARCHAR(100) NOT NULL,
    direccion VARCHAR(255),
    telefono VARCHAR(50),
    email VARCHAR(100)
);



CREATE TABLE gastos_transporte (
    cod_transporte INT PRIMARY KEY AUTO_INCREMENT,
    origen VARCHAR(100) not null,
    destino VARCHAR(100) not NULL,
    fecha DATE NOT NULL,
    valor DECIMAL(10, 2) NOT NULL,
    descripcion VARCHAR(255),
    cod_usuario INT,
    cod_tipotransporte int,
    cod_cliente int,
    FOREIGN KEY (cod_usuario) REFERENCES usuarios(cod_usuario),
    FOREIGN KEY (cod_tipotransporte) REFERENCES tipo_transporte(cod_tipotransporte),
    FOREIGN KEY (cod_cliente) REFERENCES clientes(cod_cliente)
);



-- Primero, asegúrate de estar en la base de datos correcta
USE transporte;

-- Insertar usuarios
INSERT INTO usuarios (nomb_usuario, ape_usuario, doc_usuario, contrasena, rol_usuario) VALUES
('daniel', 'Pérez', '7126504', '123', 'admin'),
('María', 'González', '987654321', 'password2', 'guest');

-- Insertar tipos de transporte
INSERT INTO tipo_transporte (nomb_transporte) VALUES
('taxi'),
('moto');

-- Insertar clientes
INSERT INTO clientes (nombre_cliente, direccion, telefono, email) VALUES
('Carlos Rodríguez', 'Calle 123', '123456789', 'carlos@example.com'),
('Laura Martínez', 'Avenida 456', '987654321', 'laura@example.com');

-- Insertar gastos de transporte
INSERT INTO gastos_transporte (origen, destino, fecha, valor, descripcion, cod_usuario, cod_tipotransporte, cod_cliente) VALUES
('Oficina', 'Aeropuerto', '2024-10-01', 50.00, 'Viaje al aeropuerto', 1, 1, 1),
('Casa', 'Centro Comercial', '2024-10-02', 30.00, 'Compras en el centro', 2, 2, 2);
