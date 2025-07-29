<?php
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/header.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/navbar.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/modelo/proveedor.php";
include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/modelo/categoria.php";

// Obtener proveedores y categorías para los selects
$provObj = new Proveedor();
$proveedores = $provObj->listado();

$catObj = new Categoria();
$categorias = $catObj->listado();
?>

<div class="card mt-4">
  <div class="card-body">
    <h5 class="card-title">Nuevo Producto</h5>

    <form method="POST" name="fproducto" action="grabar.php">
        <div class="mb-3">
            <label class="form-label">ID Producto:</label>
            <input type="text" class="form-control" name="idproducto" placeholder="ID Producto" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción:</label>
            <input type="text" class="form-control" name="txtnomprodu" placeholder="Nombre Producto" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Unidad de Medida:</label>
            <input type="text" class="form-control" name="txtunimed" placeholder="Unidad Medida" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stock:</label>
            <input type="number" class="form-control" name="txtstock" placeholder="Stock" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Precio Unitario:</label>
            <input type="text" class="form-control" name="txtpreuni" placeholder="Precio Unitario" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Costo Unitario:</label>
            <input type="text" class="form-control" name="txtcosuni" placeholder="Costo Unitario" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Proveedor:</label>
            <select name="idproveedor" class="form-select" required>
                <option value="">Seleccione un proveedor</option>
                <?php foreach ($proveedores as $prov): ?>
                    <option value="<?= $prov['idproveedor'] ?>"><?= $prov['nomproveedor'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Categoría:</label>
            <select name="idcategoria" class="form-select" required>
                <option value="">Seleccione una categoría</option>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?= $cat['idcategoria'] ?>"><?= $cat['nomcategoria'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Estado:</label>
            <select name="estado" class="form-select" required>
                <option value="A">Activo</option>
                <option value="I">Inactivo</option>
            </select>
        </div>

        <div>
            <input type="submit" class="btn btn-success" value="Grabar">
            <input type="reset" class="btn btn-secondary" value="Limpiar">
            <a href="listado.php" class="btn btn-link">Cancelar</a>
        </div>
    </form>
  </div>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/vista/layout/footer.php"; ?>
