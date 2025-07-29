<?php
// Include guard to prevent multiple inclusions
if (!defined('DETALLEVENTA_INCLUDED')) {
    define('DETALLEVENTA_INCLUDED', true);

    include $_SERVER['DOCUMENT_ROOT']."/sisventas/includes/db.php";

    class DetalleVenta {

        private $iddetalle;
        private $idfactura;
        private $idproducto;
        private $cant;
        private $cosuni;
        private $preuni;
        private $con;

        public function __construct(){
            $cnx = new DBConection();
            $this->con = $cnx->conectar();
        }

        public function listado(){
            $sql = "SELECT df.*, p.nomproducto 
                    FROM detallefactura df 
                    LEFT JOIN productos p ON df.idproducto = p.idproducto 
                    ORDER BY df.iddetalle";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;
        }

        public function buscar($id){
            $sql = "SELECT df.*, p.nomproducto 
                    FROM detallefactura df 
                    LEFT JOIN productos p ON df.idproducto = p.idproducto 
                    WHERE df.iddetalle = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        }

        public function buscarPorFactura($idfactura){
            $sql = "SELECT df.*, p.nomproducto 
                    FROM detallefactura df 
                    LEFT JOIN productos p ON df.idproducto = p.idproducto 
                    WHERE df.idfactura = :idfactura";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':idfactura', $idfactura);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;
        }

        public function create(){
            $sql = "INSERT INTO detallefactura (idfactura, idproducto, cant, cosuni, preuni)
                    VALUES (:idfactura, :idproducto, :cant, :cosuni, :preuni)";
            
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':idfactura', $this->idfactura);
            $stmt->bindParam(':idproducto', $this->idproducto);
            $stmt->bindParam(':cant', $this->cant);
            $stmt->bindParam(':cosuni', $this->cosuni);
            $stmt->bindParam(':preuni', $this->preuni);
            
            if ($stmt->execute()){
                return true;
            } else {
                return false;
            }
        }
        
        public function update(){
            $sql = "UPDATE detallefactura SET idfactura = :idfactura, idproducto = :idproducto, 
                    cant = :cant, cosuni = :cosuni, preuni = :preuni 
                    WHERE iddetalle = :iddetalle";
            
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':iddetalle', $this->iddetalle);
            $stmt->bindParam(':idfactura', $this->idfactura);
            $stmt->bindParam(':idproducto', $this->idproducto);
            $stmt->bindParam(':cant', $this->cant);
            $stmt->bindParam(':cosuni', $this->cosuni);
            $stmt->bindParam(':preuni', $this->preuni);
            
            if ($stmt->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function delete($id){
            $sql = "DELETE FROM detallefactura WHERE iddetalle = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $id);
            
            if ($stmt->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function deletePorFactura($idfactura){
            $sql = "DELETE FROM detallefactura WHERE idfactura = :idfactura";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':idfactura', $idfactura);
            
            if ($stmt->execute()){
                return true;
            } else {
                return false;
            }
        }

        // Métodos adicionales para consultas
        public function listadoPorFactura($idfactura){
            $sql = "SELECT df.*, p.nomproducto, p.unimed 
                    FROM detallefactura df 
                    LEFT JOIN productos p ON df.idproducto = p.idproducto 
                    WHERE df.idfactura = :idfactura";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':idfactura', $idfactura);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function obtenerStockProducto($idproducto){
            $sql = "SELECT stock FROM productos WHERE idproducto = :idproducto";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':idproducto', $idproducto);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado['stock'] ?? 0;
        }

        public function obtenerPrecioProducto($idproducto){
            $sql = "SELECT preuni, cosuni FROM productos WHERE idproducto = :idproducto";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':idproducto', $idproducto);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        // Setters
        public function setIddetalle($id){
            $this->iddetalle = $id;
        }
        public function setIdfactura($id){
            $this->idfactura = $id;
        }
        public function setIdproducto($id){
            $this->idproducto = $id;
        }
        public function setCant($cant){
            $this->cant = $cant;
        }
        public function setCosuni($cos){
            $this->cosuni = $cos;
        }
        public function setPreuni($pre){
            $this->preuni = $pre;
        }

        // Getters
        public function getIddetalle(){
            return $this->iddetalle;
        }
        public function getIdfactura(){
            return $this->idfactura;
        }
        public function getIdproducto(){
            return $this->idproducto;
        }
        public function getCant(){
            return $this->cant;
        }
        public function getCosuni(){
            return $this->cosuni;
        }
        public function getPreuni(){
            return $this->preuni;
        }
    }
}
?> 