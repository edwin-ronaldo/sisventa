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
    $resultado = $cliente->inserta_cliente($idcliente, $nomcliente, $ruccliente, $dircliente, $telcliente, $emailcliente);

    if ($resultado) {
        header("Location: listado.php?mensaje=Cliente registrado exitosamente");
    } else {
        header("Location: crear.php?error=Error al registrar cliente");
    }
} else {
    header("Location: listado.php");
}
?> 