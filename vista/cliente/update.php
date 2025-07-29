<?php
include $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/clienteController.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idcliente = $_POST['idcliente'];
    $nomcliente = $_POST['nomcliente'];
    $ruccliente = $_POST['ruccliente'];
    $dircliente = $_POST['dircliente'];
    $telcliente = $_POST['telcliente'];
    $emailcliente = $_POST['emailcliente'];

    $cliente = new ClienteController();
    $resultado = $cliente->actualiza_cliente($idcliente, $nomcliente, $ruccliente, $dircliente, $telcliente, $emailcliente);

    if ($resultado) {
        header("Location: listado.php?mensaje=Cliente actualizado exitosamente");
    } else {
        header("Location: editar.php?id=" . $idcliente . "&error=Error al actualizar cliente");
    }
} else {
    header("Location: listado.php");
}
?> 