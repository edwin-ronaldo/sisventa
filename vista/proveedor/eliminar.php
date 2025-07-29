<?php
include $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/ProveedorController.php";

if (isset($_GET['id'])) {
    $control = new ProveedorController();
    $resultado = $control->elimina_proveedor($_GET['id']);

    if ($resultado) {
        header("Location: listado.php?mensaje=Proveedor eliminado correctamente");
    } else {
        header("Location: listado.php?error=Error al eliminar proveedor");
    }
} else {
    header("Location: listado.php?error=ID no especificado");
}
?>
