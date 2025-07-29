<?php
// Include guard to prevent multiple inclusions
if (!defined('CLIENTE_CONTROLLER_INCLUDED')) {
    define('CLIENTE_CONTROLLER_INCLUDED', true);

    include $_SERVER['DOCUMENT_ROOT']."/sisventas/modelo/cliente.php";

    class ClienteController{

        public function obtener_listado(){
            $listado = new Cliente();
            $res = $listado->listado();
            return $res;
        }

        public function inserta_cliente($id, $nom, $ruc, $dir, $tel, $email){
            $ocliente = new Cliente();
            $ocliente->setIdcliente($id);
            $ocliente->setNomcliente($nom);
            $ocliente->setRuccliente($ruc);
            $ocliente->setDircliente($dir);
            $ocliente->setTelcliente($tel);
            $ocliente->setEmailcliente($email);

            $res = $ocliente->create();
            if ($res){
                return true;
            } else {
                return false;
            }
        }

        public function buscar_cliente($id){
            $cliente = new Cliente();
            $res = $cliente->buscar($id);
            return $res;
        }

        public function actualiza_cliente($id, $nom, $ruc, $dir, $tel, $email){
            $ocliente = new Cliente();
            $ocliente->setIdcliente($id);
            $ocliente->setNomcliente($nom);
            $ocliente->setRuccliente($ruc);
            $ocliente->setDircliente($dir);
            $ocliente->setTelcliente($tel);
            $ocliente->setEmailcliente($email);

            $res = $ocliente->update();
            if ($res){
                return true;
            } else {
                return false;
            }
        }

        public function elimina_cliente($id){
            $ocliente = new Cliente();
            $res = $ocliente->delete($id);
            if ($res){
                return true;
            } else {
                return false;
            }
        }
    }
}
?> 