<?php
// Include guard to prevent multiple inclusions
if (!defined('CATEGORIA_INCLUDED')) {
    define('CATEGORIA_INCLUDED', true);

    include $_SERVER['DOCUMENT_ROOT']."/sisventas/includes/db.php";

    class Categoria {

        private $idcategoria;
        private $nomcategoria;
        private $con;

        public function __construct(){
            $cnx = new DBConection();
            $this->con = $cnx->conectar();
        }

        public function listado(){
            $sql = "SELECT * FROM categorias ORDER BY nomcategoria";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;
        }

        public function buscar($id){
            $sql = "SELECT * FROM categorias WHERE idcategoria = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        }

        public function create(){
            $sql = "INSERT INTO categorias (idcategoria, nomcategoria) VALUES (:idcategoria, :nomcategoria)";
            
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':idcategoria', $this->idcategoria);
            $stmt->bindParam(':nomcategoria', $this->nomcategoria);
            
            if ($stmt->execute()){
                return true;
            } else {
                return false;
            }
        }
        
        public function update(){
            $sql = "UPDATE categorias SET nomcategoria = :nomcategoria WHERE idcategoria = :idcategoria";
            
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':idcategoria', $this->idcategoria);
            $stmt->bindParam(':nomcategoria', $this->nomcategoria);
            
            if ($stmt->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function delete($id){
            $sql = "DELETE FROM categorias WHERE idcategoria = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $id);
            
            if ($stmt->execute()){
                return true;
            } else {
                return false;
            }
        }

        // Setters
        public function setIdcategoria($id){
            $this->idcategoria = $id;
        }
        public function setNomcategoria($nom){
            $this->nomcategoria = $nom;
        }

        // Getters
        public function getIdcategoria(){
            return $this->idcategoria;
        }
        public function getNomcategoria(){
            return $this->nomcategoria;
        }
    }
}
?> 