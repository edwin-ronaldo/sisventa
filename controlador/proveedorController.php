<?php
// Include guard to prevent multiple inclusions
if (!defined('PROVEEDOR_CONTROLLER_INCLUDED')) {
    define('PROVEEDOR_CONTROLLER_INCLUDED', true);

    include $_SERVER['DOCUMENT_ROOT']."/sisventas/modelo/proveedor.php";

    class ProveedorController{

        public function obtener_listado(){
            $listado = new Proveedor();
            $res = $listado->listado();
            return $res;
        }

        public function inserta_proveedor($id, $nom, $ruc, $dir, $tel, $email){
            $oproveedor = new Proveedor();
            $oproveedor->setIdproveedor($id);
            $oproveedor->setNomproveedor($nom);
            $oproveedor->setRucproveedor($ruc);
            $oproveedor->setDirproveedor($dir);
            $oproveedor->setTelproveedor($tel);
            $oproveedor->setEmailproveedor($email);

            $res = $oproveedor->create();
            if ($res){
                return true;
            } else {
                return false;
            }
        }

        public function buscar_proveedor($id){
            $proveedor = new Proveedor();
            $res = $proveedor->buscar($id);
            return $res;
        }

        public function actualiza_proveedor($id, $nom, $ruc, $dir, $tel, $email){
            $oproveedor = new Proveedor();
            $oproveedor->setIdproveedor($id);
            $oproveedor->setNomproveedor($nom);
            $oproveedor->setRucproveedor($ruc);
            $oproveedor->setDirproveedor($dir);
            $oproveedor->setTelproveedor($tel);
            $oproveedor->setEmailproveedor($email);

            $res = $oproveedor->update();
            if ($res){
                return true;
            } else {
                return false;
            }
        }

        public function elimina_proveedor($id){
            $oproveedor = new Proveedor();
            $res = $oproveedor->delete($id);
            if ($res){
                return true;
            } else {
                return false;
            }
        }
    }
}
?> 