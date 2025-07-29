<?php
// Include guard to prevent multiple inclusions
if (!defined('PRODUCTO_INCLUDED')) {
    define('PRODUCTO_INCLUDED', true);

    include $_SERVER['DOCUMENT_ROOT']."/sisventas/includes/db.php";

    class Producto {

        private $idproducto;
        private $idproveedor;
        private $nomprodu;
        private $unimed;
        private $stock;
        private $preuni;
        private $cosuni;
        private $idcategoria;
        private $estado;
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
            
            $sql = "SELECT p.*, pr.nomproveedor, c.nomcategoria 
                    FROM productos p 
                    LEFT JOIN proveedores pr ON p.idproveedor = pr.idproveedor 
                    LEFT JOIN categorias c ON p.idcategoria = c.idcategoria 
                    ORDER BY p.nomproducto";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;
        }

        public function buscar($id){
            $sql = "SELECT p.*, pr.nomproveedor, c.nomcategoria 
                    FROM productos p 
                    LEFT JOIN proveedores pr ON p.idproveedor = pr.idproveedor 
                    LEFT JOIN categorias c ON p.idcategoria = c.idcategoria 
                    WHERE p.idproducto = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        }

        public function create(){
            $sql = "INSERT INTO productos (idproducto, idproveedor, nomproducto, unimed, stock, preuni, cosuni, idcategoria, estado)
                    VALUES (:idproducto, :idproveedor, :nomproducto, :unimed, :stock, :preuni, :cosuni, :idcategoria, :estado)";
            
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':idproducto', $this->idproducto);
            $stmt->bindParam(':idproveedor', $this->idproveedor);
            $stmt->bindParam(':nomproducto', $this->nomprodu);
            $stmt->bindParam(':unimed', $this->unimed);
            $stmt->bindParam(':stock', $this->stock);
            $stmt->bindParam(':preuni', $this->preuni);
            $stmt->bindParam(':cosuni', $this->cosuni);
            $stmt->bindParam(':idcategoria', $this->idcategoria);
            $stmt->bindParam(':estado', $this->estado);
            
            if ($stmt->execute()){
                return true;
            } else {
                return false;
            }
        }
        
        public function update(){
            $sql = "UPDATE productos SET idproveedor = :idproveedor, nomproducto = :nomproducto, 
                    unimed = :unimed, stock = :stock, preuni = :preuni, cosuni = :cosuni, 
                    idcategoria = :idcategoria, estado = :estado 
                    WHERE idproducto = :idproducto";
            
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':idproducto', $this->idproducto);
            $stmt->bindParam(':idproveedor', $this->idproveedor);
            $stmt->bindParam(':nomproducto', $this->nomprodu);
            $stmt->bindParam(':unimed', $this->unimed);
            $stmt->bindParam(':stock', $this->stock);
            $stmt->bindParam(':preuni', $this->preuni);
            $stmt->bindParam(':cosuni', $this->cosuni);
            $stmt->bindParam(':idcategoria', $this->idcategoria);
            $stmt->bindParam(':estado', $this->estado);
            
            if ($stmt->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function delete($id){
            $sql = "DELETE FROM productos WHERE idproducto = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $id);
            
            if ($stmt->execute()){
                return true;
            } else {
                return false;
            }
        }


        public function setIdproducto($id){
            $this->idproducto = $id;
        }
        public function setIdproveedor($id){
            $this->idproveedor = $id;
        }
        public function setNomprodu($nom){
            $this->nomprodu = $nom;
        }
        public function setUnimed($und){
            $this->unimed = $und;
        }
        public function setStock($stk){
            $this->stock = $stk;
        }
        public function setPreuni($pre){
            $this->preuni = $pre;
        }
        public function setCosuni($cos){
            $this->cosuni = $cos;
        }
        public function setIdcategoria($id){
            $this->idcategoria = $id;
        }
        public function setEstado($estado){
            $this->estado = $estado;
        }
        public function getIdproducto(){
            return $this->idproducto;
        }
        public function getIdproveedor(){
            return $this->idproveedor;
        }
        public function getNomprodu(){
            return $this->nomprodu;
        }
        public function getUnimed(){
            return $this->unimed;
        }
        public function getStock(){
            return $this->stock;
        }
        public function getPreuni(){
            return $this->preuni;
        }
        public function getCosuni(){
            return $this->cosuni;
        }
        public function getIdcategoria(){
            return $this->idcategoria;
        }
        public function getEstado(){
            return $this->estado;
        }

    }
}
?>