<?php
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/ProveedorController.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/header.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/navbar.php";

// Validar que venga el ID por GET
if (!isset($_GET['id'])) {
    header("Location: listado.php?error=ID de proveedor no especificado");
    exit();
}

$control = new ProveedorController();
$proveedor = $control->buscar_proveedor($_GET['id']);

// Validar que el proveedor exista
if (!$proveedor) {
    header("Location: listado.php?error=Proveedor no encontrado");
    exit();
}
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Editar Proveedor</h5>
                </div>
                <div class="card-body">
                    <form action="update.php" method="POST">
                        <!-- ID oculto para enviar -->
                        <input type="hidden" name="idproveedor" value="<?= $proveedor['idproveedor'] ?>">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="idproveedor_display" class="form-label">ID Proveedor</label>
                                <input type="text" class="form-control" id="idproveedor_display" value="<?= $proveedor['idproveedor'] ?>" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="form-label">Nombre *</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($proveedor['nomproveedor']) ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="ruc" class="form-label">RUC</label>
                                <input type="text" class="form-control" id="ruc" name="ruc" value="<?= htmlspecialchars($proveedor['rucproveedor']) ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" value="<?= htmlspecialchars($proveedor['telproveedor']) ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" value="<?= htmlspecialchars($proveedor['dirproveedor']) ?>">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($proveedor['emailproveedor']) ?>">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="listado.php" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-warning">Actualizar Proveedor</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/footer.php"; ?>
