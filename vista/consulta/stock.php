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
                <div class="card-header">
                    <h5 class="mb-0">Consulta de Stock de Productos</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID Producto</th>
                                    <th>Producto</th>
                                    <th>Proveedor</th>
                                    <th>Categoría</th>
                                    <th>Unidad</th>
                                    <th>Stock Actual</th>
                                    <th>Precio Unit.</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if ($datos && count($datos) > 0) {
                                    foreach ($datos as $fila) {
                                        $stockClass = $fila['stock'] <= 10 ? 'table-warning' : ($fila['stock'] == 0 ? 'table-danger' : '');
                                        $estado = $fila['estado'] == 'A' ? 'Activo' : 'Inactivo';
                                        ?>
                                        <tr class="<?php echo $stockClass; ?>">
                                            <td><?php echo $fila['idproducto']; ?></td>
                                            <td><?php echo $fila['nomproducto']; ?></td>
                                            <td><?php echo $fila['nomproveedor'] ?? 'N/A'; ?></td>
                                            <td><?php echo $fila['nomcategoria'] ?? 'N/A'; ?></td>
                                            <td><?php echo $fila['unimed']; ?></td>
                                            <td>
                                                <strong><?php echo $fila['stock']; ?></strong>
                                                <?php if ($fila['stock'] <= 10): ?>
                                                    <span class="badge bg-warning">Stock Bajo</span>
                                                <?php endif; ?>
                                                <?php if ($fila['stock'] == 0): ?>
                                                    <span class="badge bg-danger">Sin Stock</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>S/ <?php echo number_format($fila['preuni'], 2); ?></td>
                                            <td>
                                                <span class="badge <?php echo $fila['estado'] == 'A' ? 'bg-success' : 'bg-secondary'; ?>">
                                                    <?php echo $estado; ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="8" class="text-center">No hay productos registrados</td>
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