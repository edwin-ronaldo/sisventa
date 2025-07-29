<?php
include $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/clienteController.php";

$id = $_GET['id'] ?? '';

if ($id) {
    $cliente = new ClienteController();
    $resultado = $cliente->elimina_cliente($id);

    if ($resultado) {
        header("Location: listado.php?mensaje=Cliente eliminado exitosamente");
    } else {
        header("Location: listado.php?error=Error al eliminar cliente");
    }
} else {
    header("Location: listado.php?error=ID de cliente no válido");
}
?> 