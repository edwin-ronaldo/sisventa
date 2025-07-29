<?php
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/header.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/navbar.php";

include $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/ventaController.php";

$venta = new VentaController();
$datos = $venta->ranking_ventas();

?>
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Ranking de Ventas por Importe</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Posición</th>
                                    <th>Factura #</th>
                                    <th>Fecha</th>
                                    <th>Cliente</th>
                                    <th>Subtotal</th>
                                    <th>IGV</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if ($datos && count($datos) > 0) {
                                    $posicion = 1;
                                    foreach ($datos as $fila) {
                                        $total = $fila['valorventa'] + $fila['igv'];
                                        $badgeClass = $posicion == 1 ? 'bg-warning' : ($posicion == 2 ? 'bg-secondary' : ($posicion == 3 ? 'bg-info' : 'bg-light'));
                                        ?>
                                        <tr>
                                            <td>
                                                <span class="badge <?php echo $badgeClass; ?> fs-6">
                                                    <?php echo $posicion; ?>°
                                                </span>
                                            </td>
                                            <td><?php echo $fila['idfactura']; ?></td>
                                            <td><?php echo date('d/m/Y', strtotime($fila['fecha'])); ?></td>
                                            <td><?php echo $fila['nomcliente']; ?></td>
                                            <td>S/ <?php echo number_format($fila['valorventa'], 2); ?></td>
                                            <td>S/ <?php echo number_format($fila['igv'], 2); ?></td>
                                            <td><strong>S/ <?php echo number_format($total, 2); ?></strong></td>
                                        </tr>
                                    <?php
                                        $posicion++;
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="7" class="text-center">No hay ventas registradas</td>
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