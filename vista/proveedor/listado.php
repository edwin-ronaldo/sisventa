<?php
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/header.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/navbar.php";

include $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/proveedorController.php";

$proveedor = new ProveedorController();
$datos = $proveedor->obtener_listado();

?>
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Listado de Proveedores</h5>
                    <a class="btn btn-primary" href="crear.php" role="button">Nuevo Proveedor</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID Proveedor</th>
                                    <th>Nombre</th>
                                    <th>RUC</th>
                                    <th>Dirección</th>
                                    <th>Teléfono</th>
                                    <th>Email</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if ($datos && count($datos) > 0) {
                                    foreach ($datos as $fila) {
                                        ?>
                                        <tr>
                                            <td><?php echo $fila['idproveedor']; ?></td>
                                            <td><?php echo $fila['nomproveedor']; ?></td>
                                            <td><?php echo $fila['rucproveedor']; ?></td>
                                            <td><?php echo $fila['dirproveedor']; ?></td>
                                            <td><?php echo $fila['telproveedor']; ?></td>
                                            <td><?php echo $fila['emailproveedor']; ?></td>
                                            <td>
                                                <a href="editar.php?id=<?php echo $fila['idproveedor']; ?>" class="btn btn-sm btn-warning">Editar</a>
                                                <a href="eliminar.php?id=<?php echo $fila['idproveedor']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro de eliminar este proveedor?')">Eliminar</a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="7" class="text-center">No hay proveedores registrados</td>
                                    </tr>
                                <?php
                                }
                            ?>  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/footer.php"; ?> 