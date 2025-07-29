<?php
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/header.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/navbar.php";
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="jumbotron bg-primary text-white">
                <h1 class="display-4">🏪 Sistema de Ventas y Control de Stocks</h1>
                <p class="lead">Sistema completo de gestión comercial con control de inventario, ventas y reportes.</p>
                <hr class="my-4">
                <p>Accede directamente a los módulos desde el menú de navegación.</p>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-4 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">👥 Gestión de Clientes</h5>
                    <p class="card-text">Administra la información de tus clientes</p>
                    <a href="vista/cliente/listado.php" class="btn btn-primary">Ver Clientes</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">📦 Gestión de Productos</h5>
                    <p class="card-text">Controla tu inventario y productos</p>
                    <a href="vista/producto/listado.php" class="btn btn-success">Ver Productos</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">💰 Registrar Ventas</h5>
                    <p class="card-text">Registra nuevas ventas y facturas</p>
                    <a href="vista/venta/registrar.php" class="btn btn-warning">Nueva Venta</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">📊 Consultas y Reportes</h5>
                    <p class="card-text">Accede a reportes de ventas, stock y análisis</p>
                    <a href="vista/consulta/stock.php" class="btn btn-info">Ver Consultas</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">⚙️ Configuración</h5>
                    <p class="card-text">Configura proveedores, categorías y usuarios</p>
                    <a href="vista/proveedor/listado.php" class="btn btn-secondary">Ver Configuración</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/footer.php"; ?>
