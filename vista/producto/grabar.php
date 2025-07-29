<?php
include $_SERVER['DOCUMENT_ROOT']."/sisventas/controlador/ProductoController.php"; 

// Obtener datos del formulario
$id = $_POST["idproducto"];
$idproveedor = $_POST["idproveedor"];
$nom = strtoupper($_POST["txtnomprodu"]);
$unimed = strtoupper($_POST["txtunimed"]);
$stock = $_POST["txtstock"];
$preuni = $_POST["txtpreuni"];
$cosuni = $_POST["txtcosuni"];
$idcategoria = $_POST["idcategoria"];
$estado = $_POST["estado"];

// Llamar al controlador
$producto = new ProductoController();
$res = $producto->inserta_producto($id, $idproveedor, $nom, $unimed, $stock, $preuni, $cosuni, $idcategoria, $estado);

// Redirigir según resultado
if ($res) {
    header("Location: listado.php?mensaje=Producto agregado exitosamente");
    exit();
} else {
    header("Location: crear.php?error=No se pudo agregar el producto");
    exit();
}
