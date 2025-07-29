<?php
// Activar errores para depuración
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Verifica que se haya enviado el formulario por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir el controlador del proveedor
    include_once $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/ProveedorController.php";

    // Obtener datos del formulario
    $id = $_POST['idproveedor'];
    $nombre = $_POST['nomproveedor'];
    $ruc = $_POST['rucproveedor'];
    $telefono = $_POST['telproveedor'];
    $direccion = $_POST['dirproveedor'];
    $email = $_POST['emailproveedor'];

    // Crear instancia del controlador y llamar método
    $controlador = new ProveedorController();
    $resultado = $controlador->inserta_proveedor($id, $nombre, $ruc, $direccion, $telefono, $email);

    if ($resultado) {
        // Redirigir al listado con mensaje de éxito
        header("Location: listado.php?mensaje=ok");
        exit();
    } else {
        // Redirigir al crear con mensaje de error
        header("Location: crear.php?mensaje=error");
        exit();
    }
} else {
    // Si alguien accede directo a grabar.php sin formulario
    header("Location: listado.php");
    exit();
}
