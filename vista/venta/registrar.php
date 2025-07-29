<?php
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/header.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/navbar.php";

include $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/clienteController.php";
include $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/productoController.php";
include $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/ventaController.php";

$cliente = new ClienteController();
$producto = new ProductoController();
$venta = new VentaController();

$clientes = $cliente->obtener_listado();
$productos = $producto->obtener_listado();
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Registrar Venta</h5>
                </div>
                <div class="card-body">
                    <form id="ventaForm" action="procesar.php" method="POST">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="fecha" class="form-label">Fecha *</label>
                                <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="idcliente" class="form-label">Cliente *</label>
                                <select class="form-select" id="idcliente" name="idcliente" required>
                                    <option value="">Seleccione un cliente</option>
                                    <?php foreach ($clientes as $cli): ?>
                                        <option value="<?php echo $cli['idcliente']; ?>"><?php echo $cli['nomcliente']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="idcondicion" class="form-label">Condición *</label>
                                <select class="form-select" id="idcondicion" name="idcondicion" required>
                                    <option value="">Seleccione</option>
                                    <option value="CO">Contado</option>
                                    <option value="CR">Crédito</option>
                                </select>
                            </div>
                        </div>

                        <hr>
                        <h6>Detalle de Productos</h6>
                        
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="idproducto" class="form-label">Producto</label>
                                <select class="form-select" id="idproducto">
                                    <option value="">Seleccione un producto</option>
                                    <?php foreach ($productos as $prod): ?>
                                        <option value="<?php echo $prod['idproducto']; ?>" 
                                                data-precio="<?php echo $prod['preuni']; ?>"
                                                data-stock="<?php echo $prod['stock']; ?>">
                                            <?php echo $prod['nomproducto']; ?> - Stock: <?php echo $prod['stock']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="number" class="form-control" id="cantidad" min="1" value="1">
                            </div>
                            <div class="col-md-2">
                                <label for="precio" class="form-label">Precio Unit.</label>
                                <input type="number" class="form-control" id="precio" step="0.01" readonly>
                            </div>
                            <div class="col-md-2">
                                <label for="subtotal" class="form-label">Subtotal</label>
                                <input type="number" class="form-control" id="subtotal" step="0.01" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">&nbsp;</label>
                                <button type="button" class="btn btn-success d-block" id="agregarProducto">Agregar</button>
                            </div>
                        </div>

                        <div class="table-responsive mb-3">
                            <table class="table table-striped" id="tablaDetalle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unit.</th>
                                        <th>Subtotal</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="detalleBody">
                                </tbody>
                            </table>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-6">Subtotal:</div>
                                            <div class="col-6 text-end">
                                                <span id="totalSubtotal">S/ 0.00</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6">IGV (18%):</div>
                                            <div class="col-6 text-end">
                                                <span id="totalIgv">S/ 0.00</span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-6"><strong>Total:</strong></div>
                                            <div class="col-6 text-end">
                                                <strong><span id="totalGeneral">S/ 0.00</span></strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="valorventa" id="valorventa" value="0">
                        <input type="hidden" name="igv" id="igv" value="0">
                        <input type="hidden" name="idusuario" value="001">
                        <input type="hidden" name="detalles" id="detalles" value="">

                        <div class="d-flex justify-content-between mt-3">
                            <a href="../index.php" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary" id="btnGuardar" disabled>Registrar Venta</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let detalleVenta = [];
let contador = 0;

document.getElementById('idproducto').addEventListener('change', function() {
    const option = this.options[this.selectedIndex];
    const precio = option.getAttribute('data-precio');
    const stock = option.getAttribute('data-stock');
    
    document.getElementById('precio').value = precio || '';
    document.getElementById('cantidad').max = stock || 1;
    calcularSubtotal();
});

document.getElementById('cantidad').addEventListener('input', calcularSubtotal);

function calcularSubtotal() {
    const cantidad = parseFloat(document.getElementById('cantidad').value) || 0;
    const precio = parseFloat(document.getElementById('precio').value) || 0;
    const subtotal = cantidad * precio;
    document.getElementById('subtotal').value = subtotal.toFixed(2);
}

document.getElementById('agregarProducto').addEventListener('click', function() {
    const idproducto = document.getElementById('idproducto').value;
    const cantidad = parseFloat(document.getElementById('cantidad').value);
    const precio = parseFloat(document.getElementById('precio').value);
    const subtotal = parseFloat(document.getElementById('subtotal').value);
    
    if (!idproducto || cantidad <= 0 || precio <= 0) {
        alert('Por favor complete todos los campos del producto');
        return;
    }
    
    const option = document.getElementById('idproducto').options[document.getElementById('idproducto').selectedIndex];
    const nomproducto = option.text.split(' - ')[0];
    
    const item = {
        id: contador++,
        idproducto: idproducto,
        nomproducto: nomproducto,
        cantidad: cantidad,
        precio: precio,
        subtotal: subtotal
    };
    
    detalleVenta.push(item);
    actualizarTabla();
    actualizarTotales();
    limpiarCampos();
});

function actualizarTabla() {
    const tbody = document.getElementById('detalleBody');
    tbody.innerHTML = '';
    
    detalleVenta.forEach(item => {
        const row = tbody.insertRow();
        row.innerHTML = `
            <td>${item.nomproducto}</td>
            <td>${item.cantidad}</td>
            <td>S/ ${item.precio.toFixed(2)}</td>
            <td>S/ ${item.subtotal.toFixed(2)}</td>
            <td>
                <button type="button" class="btn btn-sm btn-danger" onclick="eliminarItem(${item.id})">
                    Eliminar
                </button>
            </td>
        `;
    });
}

function eliminarItem(id) {
    detalleVenta = detalleVenta.filter(item => item.id !== id);
    actualizarTabla();
    actualizarTotales();
}

function actualizarTotales() {
    const subtotal = detalleVenta.reduce((sum, item) => sum + item.subtotal, 0);
    const igv = subtotal * 0.18;
    const total = subtotal + igv;
    
    document.getElementById('totalSubtotal').textContent = `S/ ${subtotal.toFixed(2)}`;
    document.getElementById('totalIgv').textContent = `S/ ${igv.toFixed(2)}`;
    document.getElementById('totalGeneral').textContent = `S/ ${total.toFixed(2)}`;
    
    document.getElementById('valorventa').value = subtotal.toFixed(2);
    document.getElementById('igv').value = igv.toFixed(2);
    document.getElementById('detalles').value = JSON.stringify(detalleVenta);
    
    document.getElementById('btnGuardar').disabled = detalleVenta.length === 0;
}

function limpiarCampos() {
    document.getElementById('idproducto').value = '';
    document.getElementById('cantidad').value = '1';
    document.getElementById('precio').value = '';
    document.getElementById('subtotal').value = '';
}
</script>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/footer.php"; ?> 