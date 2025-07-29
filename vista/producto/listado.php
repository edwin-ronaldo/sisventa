<?php
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/header.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/navbar.php";

include $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/productoController.php";

$producto = new ProductoController();
$datos = $producto->obtener_listado();
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Listado de Productos</h5>
                    <a class="btn btn-primary" href="crear.php" role="button">Nuevo Producto</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID Producto</th>
                                    <th>Descripción</th>
                                    <th>Proveedor</th>
                                    <th>Categoría</th>
                                    <th>Unidad</th>
                                    <th>Stock</th>
                                    <th>Precio Unit.</th>
                                    <th>Costo Unit.</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if ($datos && count($datos) > 0) {
                                    foreach ($datos as $fila) {
                                        ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($fila['idproducto']); ?></td>
                                            <td><?php echo htmlspecialchars($fila['nomproducto']); ?></td>
                                            <td><?php echo htmlspecialchars($fila['nomproveedor'] ?? 'N/A'); ?></td>
                                            <td><?php echo htmlspecialchars($fila['nomcategoria'] ?? 'N/A'); ?></td>
                                            <td><?php echo htmlspecialchars($fila['unimed']); ?></td>
                                            <td><?php echo htmlspecialchars($fila['stock']); ?></td>
                                            <td><?php echo number_format($fila['preuni'], 2); ?></td>
                                            <td><?php echo number_format($fila['cosuni'], 2); ?></td>
                                            <td>
                                                <a href="editar.php?id=<?php echo urlencode($fila['idproducto']); ?>" class="btn btn-sm btn-warning">Editar</a>
                                                <a href="eliminar.php?id=<?php echo urlencode($fila['idproducto']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro de eliminar este producto?')">Eliminar</a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="9" class="text-center">No hay productos registrados</td>
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
