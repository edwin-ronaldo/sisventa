<?php
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/ProductoController.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/modelo/proveedor.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/modelo/categoria.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/header.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/navbar.php";

// Validar que venga el ID por GET
if (!isset($_GET['id'])) {
    header("Location: listado.php?error=ID de producto no especificado");
    exit();
}

$control = new ProductoController();
$producto = $control->buscar_producto($_GET['id']);

// Validar que el producto exista
if (!$producto) {
    header("Location: listado.php?error=Producto no encontrado");
    exit();
}

// Obtener proveedores y categorías para los selects
$provObj = new Proveedor();
$proveedores = $provObj->listado();

$catObj = new Categoria();
$categorias = $catObj->listado();
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Editar Producto</h5>
                </div>
                <div class="card-body">
                    <form action="update.php" method="POST">
                        <!-- ID oculto para enviar -->
                        <input type="hidden" name="idproducto" value="<?= $producto['idproducto'] ?>">

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del Producto</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" value="<?= htmlspecialchars($producto['nomproducto']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="unimed" class="form-label">Unidad de Medida</label>
                            <input type="text" class="form-control" name="unimed" id="unimed" value="<?= htmlspecialchars($producto['unimed']) ?>" required>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="number" class="form-control" name="stock" id="stock" value="<?= $producto['stock'] ?>" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="preuni" class="form-label">Precio Unitario</label>
                                <input type="text" class="form-control" name="preuni" id="preuni" value="<?= $producto['preuni'] ?>" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="cosuni" class="form-label">Costo Unitario</label>
                                <input type="text" class="form-control" name="cosuni" id="cosuni" value="<?= $producto['cosuni'] ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="idproveedor" class="form-label">Proveedor</label>
                                <select name="idproveedor" id="idproveedor" class="form-select" required>
                                    <option value="">Seleccione</option>
                                    <?php foreach ($proveedores as $prov): ?>
                                        <option value="<?= $prov['idproveedor'] ?>" <?= ($producto['idproveedor'] == $prov['idproveedor']) ? 'selected' : '' ?>>
                                            <?= $prov['nomproveedor'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="idcategoria" class="form-label">Categoría</label>
                                <select name="idcategoria" id="idcategoria" class="form-select" required>
                                    <option value="">Seleccione</option>
                                    <?php foreach ($categorias as $cat): ?>
                                        <option value="<?= $cat['idcategoria'] ?>" <?= ($producto['idcategoria'] == $cat['idcategoria']) ? 'selected' : '' ?>>
                                            <?= $cat['nomcategoria'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select name="estado" id="estado" class="form-select" required>
                                <option value="A" <?= ($producto['estado'] == 'A') ? 'selected' : '' ?>>Activo</option>
                                <option value="I" <?= ($producto['estado'] == 'I') ? 'selected' : '' ?>>Inactivo</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="listado.php" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Actualizar Producto</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/footer.php"; ?>
