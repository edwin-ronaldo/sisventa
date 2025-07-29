<?php
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/header.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/navbar.php";

include $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/clienteController.php";

$id = $_GET['id'] ?? '';
$cliente = new ClienteController();
$datos = $cliente->buscar_cliente($id);

if (!$datos) {
    header("Location: listado.php?error=Cliente no encontrado");
    exit;
}
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Editar Cliente</h5>
                </div>
                <div class="card-body">
                    <form action="update.php" method="POST">
                        <input type="hidden" name="idcliente" value="<?php echo $datos['idcliente']; ?>">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="idcliente_display" class="form-label">ID Cliente</label>
                                <input type="text" class="form-control" id="idcliente_display" value="<?php echo $datos['idcliente']; ?>" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nomcliente" class="form-label">Nombre *</label>
                                <input type="text" class="form-control" id="nomcliente" name="nomcliente" value="<?php echo $datos['nomcliente']; ?>" required maxlength="128">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="ruccliente" class="form-label">RUC</label>
                                <input type="text" class="form-control" id="ruccliente" name="ruccliente" value="<?php echo $datos['ruccliente']; ?>" maxlength="11">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="telcliente" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telcliente" name="telcliente" value="<?php echo $datos['telcliente']; ?>" maxlength="9">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="dircliente" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="dircliente" name="dircliente" value="<?php echo $datos['dircliente']; ?>" maxlength="128">
                        </div>
                        <div class="mb-3">
                            <label for="emailcliente" class="form-label">Email</label>
                            <input type="email" class="form-control" id="emailcliente" name="emailcliente" value="<?php echo $datos['emailcliente']; ?>" maxlength="64">
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="listado.php" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-warning">Actualizar Cliente</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/footer.php"; ?> 