<?php
// Include guard to prevent multiple inclusions
if (!defined('PRODUCTO_CONTROLLER_INCLUDED')) {
    define('PRODUCTO_CONTROLLER_INCLUDED', true);

    include $_SERVER['DOCUMENT_ROOT']."/sisventas/modelo/producto.php";

    class ProductoController{

        public function obtener_listado(){

            $listado = new Producto();
           $res = $listado->listado();
            return $res;

        }

        public function inserta_producto($id, $idproveedor, $nom, $und, $stock, $precio, $costo, $idcategoria, $estado){
            $oprodu = new Producto();
            $oprodu->setIdproducto($id);
            $oprodu->setIdproveedor($idproveedor);
            $oprodu->setNomprodu($nom);
            $oprodu->setUnimed($und);
            $oprodu->setStock($stock);
            $oprodu->setPreuni($precio);
            $oprodu->setCosuni($costo);
            $oprodu->setIdcategoria($idcategoria);
            $oprodu->setEstado($estado);

            $res = $oprodu->create();
            if ($res){
                return true;
            } else {
                return false;
            }
        }

        public function buscar_producto($id){
            $producto = new Producto();
            $res = $producto->buscar($id);
            return $res;
        }

        public function actualiza_producto($id, $idproveedor, $nom, $und, $stock, $precio, $costo, $idcategoria, $estado){
            $oprodu = new Producto();
            $oprodu->setIdproducto($id);
            $oprodu->setIdproveedor($idproveedor);
            $oprodu->setNomprodu($nom);
            $oprodu->setUnimed($und);
            $oprodu->setStock($stock);
            $oprodu->setPreuni($precio);
            $oprodu->setCosuni($costo);
            $oprodu->setIdcategoria($idcategoria);
            $oprodu->setEstado($estado);

            $res = $oprodu->update();
            if ($res){
                return true;
            } else {
                return false;
            }
        }

        public function elimina_producto($id){
            $oprodu = new Producto();
            $res = $oprodu->delete($id);
            if ($res){
                return true;
            } else {
                return false;
            }
        }


    }
}
?>