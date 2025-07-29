<?php
include $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/ProductoController.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['idproducto'];
    $nom = $_POST['nombre'];
    $unimed = $_POST['unimed'];
    $stock = $_POST['stock'];
    $preuni = $_POST['preuni'];
    $cosuni = $_POST['cosuni'];
    $proveedor = $_POST['idproveedor'];
    $categoria = $_POST['idcategoria'];
    $estado = $_POST['estado'];

    $control = new ProductoController();
    $resultado = $control->actualiza_producto($id, $nom, $unimed, $stock, $preuni, $cosuni, $proveedor, $categoria, $estado);

    if ($resultado) {
        header("Location: listado.php?mensaje=Producto actualizado exitosamente");
    } else {
        header("Location: editar.php?id=$id&error=No se pudo actualizar el producto");
    }
} else {
    header("Location: listado.php");
}
?>
