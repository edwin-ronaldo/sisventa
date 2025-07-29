<?php
// Include guard to prevent multiple inclusions
if (!defined('PROVEEDOR_INCLUDED')) {
    define('PROVEEDOR_INCLUDED', true);

    include $_SERVER['DOCUMENT_ROOT']."/sisventas/includes/db.php";

    class Proveedor {

        private $idproveedor;
        private $nomproveedor;
        private $rucproveedor;
        private $dirproveedor;
        private $telproveedor;
        private $emailproveedor;
        private $con;

        public function __construct(){
            $cnx = new DBConection();
            $this->con = $cnx->conectar();
        }

        public function listado(){
            $sql = "SELECT * FROM proveedores ORDER BY nomproveedor";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;
        }

        public function buscar($id){
            $sql = "SELECT * FROM proveedores WHERE idproveedor = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        }

        public function create(){
            $sql = "INSERT INTO proveedores (idproveedor, nomproveedor, rucproveedor, dirproveedor, telproveedor, emailproveedor)
                    VALUES (:idproveedor, :nomproveedor, :rucproveedor, :dirproveedor, :telproveedor, :emailproveedor)";
            
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':idproveedor', $this->idproveedor);
            $stmt->bindParam(':nomproveedor', $this->nomproveedor);
            $stmt->bindParam(':rucproveedor', $this->rucproveedor);
            $stmt->bindParam(':dirproveedor', $this->dirproveedor);
            $stmt->bindParam(':telproveedor', $this->telproveedor);
            $stmt->bindParam(':emailproveedor', $this->emailproveedor);
            
            if ($stmt->execute()){
                return true;
            } else {
                return false;
            }
        }
        
        public function update(){
            $sql = "UPDATE proveedores SET nomproveedor = :nomproveedor, rucproveedor = :rucproveedor, 
                    dirproveedor = :dirproveedor, telproveedor = :telproveedor, emailproveedor = :emailproveedor 
                    WHERE idproveedor = :idproveedor";
            
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':idproveedor', $this->idproveedor);
            $stmt->bindParam(':nomproveedor', $this->nomproveedor);
            $stmt->bindParam(':rucproveedor', $this->rucproveedor);
            $stmt->bindParam(':dirproveedor', $this->dirproveedor);
            $stmt->bindParam(':telproveedor', $this->telproveedor);
            $stmt->bindParam(':emailproveedor', $this->emailproveedor);
            
            if ($stmt->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function delete($id){
            $sql = "DELETE FROM proveedores WHERE idproveedor = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $id);
            
            if ($stmt->execute()){
                return true;
            } else {
                return false;
            }
        }

        // Setters
        public function setIdproveedor($id){
            $this->idproveedor = $id;
        }
        public function setNomproveedor($nom){
            $this->nomproveedor = $nom;
        }
        public function setRucproveedor($ruc){
            $this->rucproveedor = $ruc;
        }
        public function setDirproveedor($dir){
            $this->dirproveedor = $dir;
        }
        public function setTelproveedor($tel){
            $this->telproveedor = $tel;
        }
        public function setEmailproveedor($email){
            $this->emailproveedor = $email;
        }

        // Getters
        public function getIdproveedor(){
            return $this->idproveedor;
        }
        public function getNomproveedor(){
            return $this->nomproveedor;
        }
        public function getRucproveedor(){
            return $this->rucproveedor;
        }
        public function getDirproveedor(){
            return $this->dirproveedor;
        }
        public function getTelproveedor(){
            return $this->telproveedor;
        }
        public function getEmailproveedor(){
            return $this->emailproveedor;
        }
    }
}
?> 