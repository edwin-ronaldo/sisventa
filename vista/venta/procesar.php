<?php
include $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/ventaController.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fecha = $_POST['fecha'];
    $idcliente = $_POST['idcliente'];
    $idusuario = $_POST['idusuario'];
    $idcondicion = $_POST['idcondicion'];
    $valorventa = $_POST['valorventa'];
    $igv = $_POST['igv'];
    $detalles = json_decode($_POST['detalles'], true);

    if (!$detalles || count($detalles) == 0) {
        header("Location: registrar.php?error=Debe agregar al menos un producto");
        exit;
    }

    $venta = new VentaController();
    $resultado = $venta->registrar_venta($fecha, $idcliente, $idusuario, $idcondicion, $valorventa, $igv, $detalles);

    if ($resultado) {
        header("Location: listado.php?mensaje=Venta registrada exitosamente. Factura #" . $resultado);
    } else {
        header("Location: registrar.php?error=Error al registrar la venta");
    }
} else {
    header("Location: registrar.php");
}
?> 