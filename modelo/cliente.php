<?php
// Include guard to prevent multiple inclusions
if (!defined('CLIENTE_INCLUDED')) {
    define('CLIENTE_INCLUDED', true);

    include $_SERVER['DOCUMENT_ROOT']."/sisventas/includes/db.php";

    class Cliente {

        private $idcliente;
        private $nomcliente;
        private $ruccliente;
        private $dircliente;
        private $telcliente;
        private $emailcliente;
        private $con;

        public function __construct(){
            $cnx = new DBConection();
            $this->con = $cnx->conectar();
            
            // Verificar si la conexión fue exitosa
            if ($this->con === false) {
                throw new Exception("No se pudo establecer la conexión con la base de datos");
            }
        }

        public function listado(){
            // Verificar si la conexión está disponible
            if ($this->con === false || $this->con === null) {
                throw new Exception("No hay conexión disponible con la base de datos");
            }
            
            $sql = "SELECT * FROM clientes ORDER BY nomcliente";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;
        }

        public function buscar($id){
            $sql = "SELECT * FROM clientes WHERE idcliente = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        }

        public function create(){
            $sql = "INSERT INTO clientes (idcliente, nomcliente, ruccliente, dircliente, telcliente, emailcliente)
                    VALUES (:idcliente, :nomcliente, :ruccliente, :dircliente, :telcliente, :emailcliente)";
            
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':idcliente', $this->idcliente);
            $stmt->bindParam(':nomcliente', $this->nomcliente);
            $stmt->bindParam(':ruccliente', $this->ruccliente);
            $stmt->bindParam(':dircliente', $this->dircliente);
            $stmt->bindParam(':telcliente', $this->telcliente);
            $stmt->bindParam(':emailcliente', $this->emailcliente);
            
            if ($stmt->execute()){
                return true;
            } else {
                return false;
            }
        }
        
        public function update(){
            $sql = "UPDATE clientes SET nomcliente = :nomcliente, ruccliente = :ruccliente, 
                    dircliente = :dircliente, telcliente = :telcliente, emailcliente = :emailcliente 
                    WHERE idcliente = :idcliente";
            
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':idcliente', $this->idcliente);
            $stmt->bindParam(':nomcliente', $this->nomcliente);
            $stmt->bindParam(':ruccliente', $this->ruccliente);
            $stmt->bindParam(':dircliente', $this->dircliente);
            $stmt->bindParam(':telcliente', $this->telcliente);
            $stmt->bindParam(':emailcliente', $this->emailcliente);
            
            if ($stmt->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function delete($id){
            $sql = "DELETE FROM clientes WHERE idcliente = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $id);
            
            if ($stmt->execute()){
                return true;
            } else {
                return false;
            }
        }

        // Setters
        public function setIdcliente($id){
            $this->idcliente = $id;
        }
        public function setNomcliente($nom){
            $this->nomcliente = $nom;
        }
        public function setRuccliente($ruc){
            $this->ruccliente = $ruc;
        }
        public function setDircliente($dir){
            $this->dircliente = $dir;
        }
        public function setTelcliente($tel){
            $this->telcliente = $tel;
        }
        public function setEmailcliente($email){
            $this->emailcliente = $email;
        }

        // Getters
        public function getIdcliente(){
            return $this->idcliente;
        }
        public function getNomcliente(){
            return $this->nomcliente;
        }
        public function getRuccliente(){
            return $this->ruccliente;
        }
        public function getDircliente(){
            return $this->dircliente;
        }
        public function getTelcliente(){
            return $this->telcliente;
        }
        public function getEmailcliente(){
            return $this->emailcliente;
        }
    }
}
?> 