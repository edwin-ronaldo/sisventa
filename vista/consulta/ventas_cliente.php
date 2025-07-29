<?php
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/header.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/navbar.php";

include $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/ventaController.php";
include $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/clienteController.php";

$venta = new VentaController();
$cliente = new ClienteController();
$datos = [];
$clientes = $cliente->obtener_listado();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idcliente = $_POST['idcliente'];
    $datos = $venta->ventas_por_cliente($idcliente);
}
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Consulta de Ventas por Cliente</h5>
                </div>
                <div class="card-body">
                    <form method="POST" class="mb-4">
                        <div class="row">
                            <div class="col-md-8">
                                <label for="idcliente" class="form-label">Seleccionar Cliente</label>
                                <select class="form-select" id="idcliente" name="idcliente" required>
                                    <option value="">Seleccione un cliente</option>
                                    <?php foreach ($clientes as $cli): ?>
                                        <option value="<?php echo $cli['idcliente']; ?>"><?php echo $cli['nomcliente']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">&nbsp;</label>
                                <button type="submit" class="btn btn-primary d-block">Consultar</button>
                            </div>
                        </div>
                    </form>

                    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['idcliente'])): ?>
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
                                            <td colspan="7" class="text-end"><strong>Total del Cliente:</strong></td>
                                            <td><strong>S/ <?php echo number_format($totalGeneral, 2); ?></strong></td>
                                        </tr>
                                    <?php
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="8" class="text-center">No se encontraron ventas para este cliente</td>
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