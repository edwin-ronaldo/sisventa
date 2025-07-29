<?php
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/header.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/navbar.php";
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Nuevo Proveedor</h5>
                </div>
                <div class="card-body">
                    <form action="grabar.php" method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="idproveedor" class="form-label">ID Proveedor *</label>
                                <input type="text" class="form-control" id="idproveedor" name="idproveedor" required maxlength="10">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nomproveedor" class="form-label">Nombre *</label>
                                <input type="text" class="form-control" id="nomproveedor" name="nomproveedor" required maxlength="50">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="rucproveedor" class="form-label">RUC</label>
                                <input type="text" class="form-control" id="rucproveedor" name="rucproveedor" maxlength="11">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="telproveedor" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telproveedor" name="telproveedor" maxlength="15">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="dirproveedor" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="dirproveedor" name="dirproveedor" maxlength="100">
                        </div>
                        <div class="mb-3">
                            <label for="emailproveedor" class="form-label">Email</label>
                            <input type="email" class="form-control" id="emailproveedor" name="emailproveedor" maxlength="64">
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="listado.php" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar Proveedor</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/footer.php"; ?>
