-- Sistema de Facturación y Control de Stocks
-- Base de datos: empresa

-- Crear base de datos si no existe
CREATE DATABASE IF NOT EXISTS empresa;
USE empresa;

-- Tabla de Categorías
CREATE TABLE categorias (
    idcategoria CHAR(2) PRIMARY KEY,
    nomcategoria VARCHAR(128) NOT NULL
);

-- Tabla de Proveedores
CREATE TABLE proveedores (
    idproveedor VARCHAR(3) PRIMARY KEY,
    nomproveedor VARCHAR(128) NOT NULL,
    rucproveedor VARCHAR(11),
    dirproveedor VARCHAR(128),
    telproveedor VARCHAR(9),
    emailproveedor VARCHAR(64)
);

-- Tabla de Usuarios
CREATE TABLE usuarios (
    idusuario VARCHAR(3) PRIMARY KEY,
    nomusuario VARCHAR(15) NOT NULL,
    password VARCHAR(255) NOT NULL,
    apellidos VARCHAR(64),
    nombres VARCHAR(64),
    email VARCHAR(64),
    estado CHAR(1) DEFAULT 'A'
);

-- Tabla de Clientes
CREATE TABLE clientes (
    idcliente VARCHAR(10) PRIMARY KEY,
    nomcliente VARCHAR(128) NOT NULL,
    ruccliente VARCHAR(11),
    dircliente VARCHAR(128),
    telcliente VARCHAR(9),
    emailcliente VARCHAR(64)
);

-- Tabla de Condiciones de Venta
CREATE TABLE condicionventa (
    idcondicion CHAR(2) PRIMARY KEY,
    nomcondicion VARCHAR(64) NOT NULL
);

-- Tabla de Productos
CREATE TABLE productos (
    idproducto VARCHAR(10) PRIMARY KEY,
    idproveedor VARCHAR(3),
    nomproducto VARCHAR(128) NOT NULL,
    unimed VARCHAR(15),
    stock INT DEFAULT 0,
    cosuni DECIMAL(10,4) DEFAULT 0,
    preuni DECIMAL(10,4) DEFAULT 0,
    idcategoria CHAR(2),
    estado CHAR(1) DEFAULT 'A',
    FOREIGN KEY (idproveedor) REFERENCES proveedores(idproveedor),
    FOREIGN KEY (idcategoria) REFERENCES categorias(idcategoria)
);

-- Tabla de Facturas
CREATE TABLE facturas (
    idfactura INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    idcliente VARCHAR(10) NOT NULL,
    idusuario VARCHAR(3) NOT NULL,
    fechareg DATETIME DEFAULT CURRENT_TIMESTAMP,
    idcondicion CHAR(2) NOT NULL,
    valorventa DECIMAL(10,4) DEFAULT 0,
    igv DECIMAL(10,4) DEFAULT 0,
    FOREIGN KEY (idcliente) REFERENCES clientes(idcliente),
    FOREIGN KEY (idusuario) REFERENCES usuarios(idusuario),
    FOREIGN KEY (idcondicion) REFERENCES condicionventa(idcondicion)
);

-- Tabla de Detalle de Facturas
CREATE TABLE detallefactura (
    iddetalle INT AUTO_INCREMENT PRIMARY KEY,
    idfactura INT NOT NULL,
    idproducto VARCHAR(10) NOT NULL,
    cant INT NOT NULL,
    cosuni DECIMAL(19,4) DEFAULT 0,
    preuni DECIMAL(10,4) DEFAULT 0,
    FOREIGN KEY (idfactura) REFERENCES facturas(idfactura),
    FOREIGN KEY (idproducto) REFERENCES productos(idproducto)
);

-- Insertar datos iniciales

-- Categorías
INSERT INTO categorias (idcategoria, nomcategoria) VALUES
('01', 'Electrónicos'),
('02', 'Ropa'),
('03', 'Alimentos'),
('04', 'Hogar'),
('05', 'Deportes');

-- Condiciones de Venta
INSERT INTO condicionventa (idcondicion, nomcondicion) VALUES
('CO', 'Contado'),
('CR', 'Crédito');

-- Proveedores
INSERT INTO proveedores (idproveedor, nomproveedor, rucproveedor, dirproveedor, telproveedor, emailproveedor) VALUES
('001', 'ElectroMax S.A.', '20123456789', 'Av. Principal 123', '123456789', 'info@electromax.com'),
('002', 'TextilPro', '20234567890', 'Calle Comercial 456', '234567890', 'ventas@textilpro.com'),
('003', 'Alimentos Frescos', '20345678901', 'Plaza Central 789', '345678901', 'pedidos@alimentos.com'),
('004', 'Hogar y Más', '20456789012', 'Zona Industrial 321', '456789012', 'contacto@hogarymas.com'),
('005', 'Deportes Elite', '20567890123', 'Centro Deportivo 654', '567890123', 'info@deporteselite.com'),
('006', 'Tecnología Avanzada', '20678901234', 'Parque Tecnológico 987', '678901234', 'ventas@tecavanzada.com'),
('007', 'Moda Express', '20789012345', 'Galería Moda 147', '789012345', 'pedidos@modaexpress.com'),
('008', 'Supermercado Central', '20890123456', 'Mall Central 258', '890123456', 'compras@supercentral.com'),
('009', 'Decoración Plus', '20901234567', 'Showroom 369', '901234567', 'info@decoracionplus.com'),
('010', 'Fitness Pro', '20112345678', 'Centro Fitness 741', '012345678', 'ventas@fitnesspro.com');

-- Usuarios
INSERT INTO usuarios (idusuario, nomusuario, password, apellidos, nombres, email, estado) VALUES
('001', 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrador', 'Sistema', 'admin@sistema.com', 'A'),
('002', 'vendedor1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'García', 'María', 'maria@empresa.com', 'A'),
('003', 'vendedor2', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'López', 'Carlos', 'carlos@empresa.com', 'A');

-- Clientes
INSERT INTO clientes (idcliente, nomcliente, ruccliente, dircliente, telcliente, emailcliente) VALUES
('CLI001', 'Juan Pérez', '20123456789', 'Av. Libertad 123', '123456789', 'juan.perez@email.com'),
('CLI002', 'María González', '20234567890', 'Calle San Martín 456', '234567890', 'maria.gonzalez@email.com'),
('CLI003', 'Carlos Rodríguez', '20345678901', 'Plaza Mayor 789', '345678901', 'carlos.rodriguez@email.com'),
('CLI004', 'Ana Martínez', '20456789012', 'Zona Residencial 321', '456789012', 'ana.martinez@email.com'),
('CLI005', 'Luis Fernández', '20567890123', 'Centro Comercial 654', '567890123', 'luis.fernandez@email.com'),
('CLI006', 'Carmen Silva', '20678901234', 'Parque Industrial 987', '678901234', 'carmen.silva@email.com'),
('CLI007', 'Roberto Torres', '20789012345', 'Galería Central 147', '789012345', 'roberto.torres@email.com'),
('CLI008', 'Patricia Ruiz', '20890123456', 'Mall Plaza 258', '890123456', 'patricia.ruiz@email.com'),
('CLI009', 'Miguel Herrera', '20901234567', 'Showroom 369', '901234567', 'miguel.herrera@email.com'),
('CLI010', 'Sofia Vargas', '20112345678', 'Centro Empresarial 741', '012345678', 'sofia.vargas@email.com');

-- Productos
INSERT INTO productos (idproducto, idproveedor, nomproducto, unimed, stock, cosuni, preuni, idcategoria, estado) VALUES
('PROD001', '001', 'Laptop HP Pavilion', 'unidad', 15, 2500.00, 3200.00, '01', 'A'),
('PROD002', '002', 'Camisa de Algodón', 'unidad', 50, 25.00, 45.00, '02', 'A'),
('PROD003', '003', 'Arroz Premium', 'kg', 100, 3.50, 5.00, '03', 'A'),
('PROD004', '004', 'Sofá de 3 Plazas', 'unidad', 8, 800.00, 1200.00, '04', 'A'),
('PROD005', '005', 'Pelota de Fútbol', 'unidad', 30, 35.00, 60.00, '05', 'A'),
('PROD006', '006', 'Smartphone Samsung', 'unidad', 20, 1800.00, 2400.00, '01', 'A'),
('PROD007', '007', 'Vestido de Fiesta', 'unidad', 25, 80.00, 150.00, '02', 'A'),
('PROD008', '008', 'Aceite de Oliva', 'litro', 40, 8.00, 12.00, '03', 'A'),
('PROD009', '009', 'Lámpara de Mesa', 'unidad', 35, 45.00, 75.00, '04', 'A'),
('PROD010', '010', 'Raqueta de Tenis', 'unidad', 18, 120.00, 200.00, '05', 'A'); 