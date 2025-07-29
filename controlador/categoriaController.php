<?php
// Include guard to prevent multiple inclusions
if (!defined('CATEGORIA_CONTROLLER_INCLUDED')) {
    define('CATEGORIA_CONTROLLER_INCLUDED', true);

    include $_SERVER['DOCUMENT_ROOT']."/sisventas/modelo/categoria.php";

    class CategoriaController{

        public function obtener_listado(){
            $listado = new Categoria();
            $res = $listado->listado();
            return $res;
        }

        public function inserta_categoria($id, $nom){
            $ocategoria = new Categoria();
            $ocategoria->setIdcategoria($id);
            $ocategoria->setNomcategoria($nom);

            $res = $ocategoria->create();
            if ($res){
                return true;
            } else {
                return false;
            }
        }

        public function buscar_categoria($id){
            $categoria = new Categoria();
            $res = $categoria->buscar($id);
            return $res;
        }

        public function actualiza_categoria($id, $nom){
            $ocategoria = new Categoria();
            $ocategoria->setIdcategoria($id);
            $ocategoria->setNomcategoria($nom);

            $res = $ocategoria->update();
            if ($res){
                return true;
            } else {
                return false;
            }
        }

        public function elimina_categoria($id){
            $ocategoria = new Categoria();
            $res = $ocategoria->delete($id);
            if ($res){
                return true;
            } else {
                return false;
            }
        }
    }
}
?> 