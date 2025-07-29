<?php
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/header.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/navbar.php";

include $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/ventaController.php";

$venta = new VentaController();
$datos = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fechaInicio = $_POST['fecha_inicio'];
    $fechaFin = $_POST['fecha_fin'];
    $datos = $venta->ventas_por_fecha($fechaInicio, $fechaFin);
}
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Consulta de Ventas por Fecha</h5>
                </div>
                <div class="card-body">
                    <form method="POST" class="mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                            </div>
                            <div class="col-md-4">
                                <label for="fecha_fin" class="form-label">Fecha Fin</label>
                                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">&nbsp;</label>
                                <button type="submit" class="btn btn-primary d-block">Consultar</button>
                            </div>
                        </div>
                    </form>

                    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
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
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if ($datos && count($datos) > 0) {
                                        $totalGeneral = 0;
                                        foreach ($datos as $fila) {
                                            $total = $fila['valorventa'] + $fila['igv'];
                                            $totalGeneral += $total;
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
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                        <tr class="table-info">
                                            <td colspan="7" class="text-end"><strong>Total General:</strong></td>
                                            <td><strong>S/ <?php echo number_format($totalGeneral, 2); ?></strong></td>
                                        </tr>
                                    <?php
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="8" class="text-center">No se encontraron ventas en el rango de fechas especificado</td>
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