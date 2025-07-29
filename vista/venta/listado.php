<?php
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/header.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/navbar.php";

include $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/ventaController.php";

$venta = new VentaController();
$datos = $venta->obtener_listado();

?>
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Listado de Ventas</h5>
                    <a class="btn btn-primary" href="registrar.php" role="button">Nueva Venta</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Factura #</th>
                                    <th>Fecha</th>
                                    <th>Cliente</th>
                                    <th>Vendedor</th>
                                    <th>Condición</th>
                                    <th>Subtotal</th>
                                    <th>IGV</th>
                                    <th>Total</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if ($datos && count($datos) > 0) {
                                    foreach ($datos as $fila) {
                                        $total = $fila['valorventa'] + $fila['igv'];
                                        ?>
                                        <tr>
                                            <td><?php echo $fila['idfactura']; ?></td>
                                            <td><?php echo date('d/m/Y', strtotime($fila['fecha'])); ?></td>
                                            <td><?php echo $fila['nomcliente']; ?></td>
                                            <td><?php echo $fila['nomusuario']; ?></td>
                                            <td><?php echo $fila['nomcondicion']; ?></td>
                                            <td>S/ <?php echo number_format($fila['valorventa'], 2); ?></td>
                                            <td>S/ <?php echo number_format($fila['igv'], 2); ?></td>
                                            <td><strong>S/ <?php echo number_format($total, 2); ?></strong></td>
                                            <td>
                                                <a href="detalle.php?id=<?php echo $fila['idfactura']; ?>" class="btn btn-sm btn-info">Ver Detalle</a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="9" class="text-center">No hay ventas registradas</td>
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