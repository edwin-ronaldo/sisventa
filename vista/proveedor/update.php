<?php
include $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/ProveedorController.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['idproveedor'];
    $nom = $_POST['nombre'];
    $ruc = $_POST['ruc'];
    $dir = $_POST['direccion'];
    $tel = $_POST['telefono'];
    $email = $_POST['email'];

    $control = new ProveedorController();
    $resultado = $control->actualiza_proveedor($id, $nom, $ruc, $dir, $tel, $email);

    if ($resultado) {
        header("Location: listado.php?mensaje=Proveedor actualizado exitosamente");
    } else {
        header("Location: editar.php?id=$id&error=No se pudo actualizar el proveedor");
    }
} else {
    header("Location: listado.php");
}
?>
