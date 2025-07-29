<?php
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/header.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/navbar.php";

include $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/ventaController.php";
include $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/productoController.php";

$venta = new VentaController();
$producto = new ProductoController();
$datos = [];
$productos = $producto->obtener_listado();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idproducto = $_POST['idproducto'];
    $datos = $venta->ventas_por_producto($idproducto);
}
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Consulta de Ventas por Producto</h5>
                </div>
                <div class="card-body">
                    <form method="POST" class="mb-4">
                        <div class="row">
                            <div class="col-md-8">
                                <label for="idproducto" class="form-label">Seleccionar Producto</label>
                                <select class="form-select" id="idproducto" name="idproducto" required>
                                    <option value="">Seleccione un producto</option>
                                    <?php foreach ($productos as $prod): ?>
                                        <option value="<?php echo $prod['idproducto']; ?>"><?php echo $prod['nomproducto']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">&nbsp;</label>
                                <button type="submit" class="btn btn-primary d-block">Consultar</button>
                            </div>
                        </div>
                    </form>

                    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['idproducto'])): ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Factura #</th>
                                        <th>Fecha</th>
                                        <th>Cliente</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unit.</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if ($datos && count($datos) > 0) {
                                        $totalGeneral = 0;
                                        $cantidadTotal = 0;
                                        foreach ($datos as $fila) {
                                            $totalGeneral += $fila['subtotal'];
                                            $cantidadTotal += $fila['cant'];
                                            ?>
                                            <tr>
                                                <td><?php echo $fila['idfactura']; ?></td>
                                                <td><?php echo date('d/m/Y', strtotime($fila['fecha'])); ?></td>
                                                <td><?php echo $fila['nomcliente']; ?></td>
                                                <td><?php echo $fila['nomproducto']; ?></td>
                                                <td><?php echo $fila['cant']; ?></td>
                                                <td>S/ <?php echo number_format($fila['preuni'], 2); ?></td>
                                                <td><strong>S/ <?php echo number_format($fila['subtotal'], 2); ?></strong></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                        <tr class="table-info">
                                            <td colspan="4" class="text-end"><strong>Totales:</strong></td>
                                            <td><strong><?php echo $cantidadTotal; ?></strong></td>
                                            <td></td>
                                            <td><strong>S/ <?php echo number_format($totalGeneral, 2); ?></strong></td>
                                        </tr>
                                    <?php
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="7" class="text-center">No se encontraron ventas para este producto</td>
                                        </tr>
                                    <?php
                                    }
                                ?>  
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/footer.php"; ?> 