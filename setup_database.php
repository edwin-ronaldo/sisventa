<?php
// Script para configurar la base de datos
include 'includes/db.php';

echo "<h2>Configuración de la Base de Datos</h2>";

$db = new DBConection();

// Paso 1: Verificar y crear la base de datos
echo "<h3>Paso 1: Verificando la base de datos...</h3>";
if ($db->verificarBaseDatos()) {
    echo "✓ Base de datos verificada/creada correctamente.<br><br>";
} else {
    echo "✗ Error al verificar/crear la base de datos.<br><br>";
    exit;
}

// Paso 2: Crear las tablas
echo "<h3>Paso 2: Creando las tablas...</h3>";
try {
    $pdo = $db->conectar();
    
    if ($pdo === false) {
        echo "✗ No se pudo conectar a la base de datos.<br><br>";
        exit;
    }
    
    // Crear tabla categorias
    $sql = "CREATE TABLE IF NOT EXISTS categorias (
        idcategoria CHAR(2) PRIMARY KEY,
        nomcategoria VARCHAR(128) NOT NULL
    )";
    $pdo->exec($sql);
    echo "✓ Tabla 'categorias' creada.<br>";
    
    // Crear tabla proveedores
    $sql = "CREATE TABLE IF NOT EXISTS proveedores (
        idproveedor VARCHAR(3) PRIMARY KEY,
        nomproveedor VARCHAR(128) NOT NULL,
        rucproveedor VARCHAR(11),
        dirproveedor VARCHAR(128),
        telproveedor VARCHAR(9),
        emailproveedor VARCHAR(64)
    )";
    $pdo->exec($sql);
    echo "✓ Tabla 'proveedores' creada.<br>";
    
    // Crear tabla usuarios
    $sql = "CREATE TABLE IF NOT EXISTS usuarios (
        idusuario VARCHAR(3) PRIMARY KEY,
        nomusuario VARCHAR(15) NOT NULL,
        password VARCHAR(255) NOT NULL,
        apellidos VARCHAR(64),
        nombres VARCHAR(64),
        email VARCHAR(64),
        estado CHAR(1) DEFAULT 'A'
    )";
    $pdo->exec($sql);
    echo "✓ Tabla 'usuarios' creada.<br>";
    
    // Crear tabla clientes
    $sql = "CREATE TABLE IF NOT EXISTS clientes (
        idcliente VARCHAR(10) PRIMARY KEY,
        nomcliente VARCHAR(128) NOT NULL,
        ruccliente VARCHAR(11),
        dircliente VARCHAR(128),
        telcliente VARCHAR(9),
        emailcliente VARCHAR(64)
    )";
    $pdo->exec($sql);
    echo "✓ Tabla 'clientes' creada.<br>";
    
    // Crear tabla condicionventa
    $sql = "CREATE TABLE IF NOT EXISTS condicionventa (
        idcondicion CHAR(2) PRIMARY KEY,
        nomcondicion VARCHAR(64) NOT NULL
    )";
    $pdo->exec($sql);
    echo "✓ Tabla 'condicionventa' creada.<br>";
    
    // Crear tabla productos
    $sql = "CREATE TABLE IF NOT EXISTS productos (
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
    )";
    $pdo->exec($sql);
    echo "✓ Tabla 'productos' creada.<br>";
    
    // Crear tabla facturas
    $sql = "CREATE TABLE IF NOT EXISTS facturas (
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
    )";
    $pdo->exec($sql);
    echo "✓ Tabla 'facturas' creada.<br>";
    
    // Crear tabla detallefactura
    $sql = "CREATE TABLE IF NOT EXISTS detallefactura (
        iddetalle INT AUTO_INCREMENT PRIMARY KEY,
        idfactura INT NOT NULL,
        idproducto VARCHAR(10) NOT NULL,
        cant INT NOT NULL,
        cosuni DECIMAL(19,4) DEFAULT 0,
        preuni DECIMAL(10,4) DEFAULT 0,
        FOREIGN KEY (idfactura) REFERENCES facturas(idfactura),
        FOREIGN KEY (idproducto) REFERENCES productos(idproducto)
    )";
    $pdo->exec($sql);
    echo "✓ Tabla 'detallefactura' creada.<br><br>";
    
} catch (PDOException $e) {
    echo "✗ Error al crear las tablas: " . $e->getMessage() . "<br><br>";
    exit;
}

// Paso 3: Insertar datos iniciales
echo "<h3>Paso 3: Insertando datos iniciales...</h3>";

// Verificar si ya existen datos
$stmt = $pdo->query("SELECT COUNT(*) FROM categorias");
$count = $stmt->fetchColumn();

if ($count == 0) {
    // Insertar categorías
    $sql = "INSERT INTO categorias (idcategoria, nomcategoria) VALUES
    ('01', 'Electrónicos'),
    ('02', 'Ropa'),
    ('03', 'Alimentos'),
    ('04', 'Hogar'),
    ('05', 'Deportes')";
    $pdo->exec($sql);
    echo "✓ Categorías insertadas.<br>";
    
    // Insertar condiciones de venta
    $sql = "INSERT INTO condicionventa (idcondicion, nomcondicion) VALUES
    ('CO', 'Contado'),
    ('CR', 'Crédito')";
    $pdo->exec($sql);
    echo "✓ Condiciones de venta insertadas.<br>";
    
    // Insertar proveedores
    $sql = "INSERT INTO proveedores (idproveedor, nomproveedor, rucproveedor, dirproveedor, telproveedor, emailproveedor) VALUES
    ('001', 'ElectroMax S.A.', '20123456789', 'Av. Principal 123', '123456789', 'info@electromax.com'),
    ('002', 'TextilPro', '20234567890', 'Calle Comercial 456', '234567890', 'ventas@textilpro.com'),
    ('003', 'Alimentos Frescos', '20345678901', 'Plaza Central 789', '345678901', 'pedidos@alimentos.com'),
    ('004', 'Hogar y Más', '20456789012', 'Zona Industrial 321', '456789012', 'contacto@hogarymas.com'),
    ('005', 'Deportes Elite', '20567890123', 'Centro Deportivo 654', '567890123', 'info@deporteselite.com')";
    $pdo->exec($sql);
    echo "✓ Proveedores insertados.<br>";
    
    // Insertar usuarios
    $sql = "INSERT INTO usuarios (idusuario, nomusuario, password, apellidos, nombres, email, estado) VALUES
    ('001', 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrador', 'Sistema', 'admin@sistema.com', 'A'),
    ('002', 'vendedor1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'García', 'María', 'maria@empresa.com', 'A'),
    ('003', 'vendedor2', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'López', 'Carlos', 'carlos@empresa.com', 'A')";
    $pdo->exec($sql);
    echo "✓ Usuarios insertados.<br>";
    
    // Insertar clientes
    $sql = "INSERT INTO clientes (idcliente, nomcliente, ruccliente, dircliente, telcliente, emailcliente) VALUES
    ('CLI001', 'Juan Pérez', '20123456789', 'Av. Libertad 123', '123456789', 'juan.perez@email.com'),
    ('CLI002', 'María González', '20234567890', 'Calle San Martín 456', '234567890', 'maria.gonzalez@email.com'),
    ('CLI003', 'Carlos Rodríguez', '20345678901', 'Plaza Mayor 789', '345678901', 'carlos.rodriguez@email.com'),
    ('CLI004', 'Ana Martínez', '20456789012', 'Zona Residencial 321', '456789012', 'ana.martinez@email.com'),
    ('CLI005', 'Luis Fernández', '20567890123', 'Centro Comercial 654', '567890123', 'luis.fernandez@email.com')";
    $pdo->exec($sql);
    echo "✓ Clientes insertados.<br>";
    
    // Insertar productos
    $sql = "INSERT INTO productos (idproducto, idproveedor, nomproducto, unimed, stock, cosuni, preuni, idcategoria, estado) VALUES
    ('PROD001', '001', 'Laptop HP Pavilion', 'unidad', 15, 2500.00, 3200.00, '01', 'A'),
    ('PROD002', '002', 'Camisa de Algodón', 'unidad', 50, 25.00, 45.00, '02', 'A'),
    ('PROD003', '003', 'Arroz Premium', 'kg', 100, 3.50, 5.00, '03', 'A'),
    ('PROD004', '004', 'Sofá de 3 Plazas', 'unidad', 8, 800.00, 1200.00, '04', 'A'),
    ('PROD005', '005', 'Pelota de Fútbol', 'unidad', 30, 35.00, 60.00, '05', 'A')";
    $pdo->exec($sql);
    echo "✓ Productos insertados.<br>";
    
} else {
    echo "✓ Los datos ya existen en la base de datos.<br>";
}

echo "<br><h3>¡Configuración completada!</h3>";
echo "<p>La base de datos ha sido configurada correctamente. Ahora puedes acceder al sistema.</p>";
echo "<p><a href='index.php'>Ir al inicio</a></p>";
?> 