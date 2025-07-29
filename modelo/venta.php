<?php
// Include guard to prevent multiple inclusions
if (!defined('VENTA_INCLUDED')) {
    define('VENTA_INCLUDED', true);

    include $_SERVER['DOCUMENT_ROOT']."/sisventas/includes/db.php";

    class Venta {

        private $idfactura;
        private $fecha;
        private $idcliente;
        private $idusuario;
        private $idcondicion;
        private $valorventa;
        private $igv;
        private $con;

        public function __construct(){
            $cnx = new DBConection();
            $this->con = $cnx->conectar();
        }

        public function listado(){
            $sql = "SELECT f.*, c.nomcliente, u.nomusuario, cv.nomcondicion 
                    FROM facturas f 
                    LEFT JOIN clientes c ON f.idcliente = c.idcliente 
                    LEFT JOIN usuarios u ON f.idusuario = u.idusuario 
                    LEFT JOIN condicionventa cv ON f.idcondicion = cv.idcondicion 
                    ORDER BY f.fecha DESC";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;
        }

        public function buscar($id){
            $sql = "SELECT f.*, c.nomcliente, u.nomusuario, cv.nomcondicion 
                    FROM facturas f 
                    LEFT JOIN clientes c ON f.idcliente = c.idcliente 
                    LEFT JOIN usuarios u ON f.idusuario = u.idusuario 
                    LEFT JOIN condicionventa cv ON f.idcondicion = cv.idcondicion 
                    WHERE f.idfactura = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        }

        public function create(){
            $sql = "INSERT INTO facturas (fecha, idcliente, idusuario, idcondicion, valorventa, igv)
                    VALUES (:fecha, :idcliente, :idusuario, :idcondicion, :valorventa, :igv)";
            
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':fecha', $this->fecha);
            $stmt->bindParam(':idcliente', $this->idcliente);
            $stmt->bindParam(':idusuario', $this->idusuario);
            $stmt->bindParam(':idcondicion', $this->idcondicion);
            $stmt->bindParam(':valorventa', $this->valorventa);
            $stmt->bindParam(':igv', $this->igv);
            
            if ($stmt->execute()){
                return $this->con->lastInsertId();
            } else {
                return false;
            }
        }
        
        public function update(){
            $sql = "UPDATE facturas SET fecha = :fecha, idcliente = :idcliente, 
                    idusuario = :idusuario, idcondicion = :idcondicion, 
                    valorventa = :valorventa, igv = :igv 
                    WHERE idfactura = :idfactura";
            
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':idfactura', $this->idfactura);
            $stmt->bindParam(':fecha', $this->fecha);
            $stmt->bindParam(':idcliente', $this->idcliente);
            $stmt->bindParam(':idusuario', $this->idusuario);
            $stmt->bindParam(':idcondicion', $this->idcondicion);
            $stmt->bindParam(':valorventa', $this->valorventa);
            $stmt->bindParam(':igv', $this->igv);
            
            if ($stmt->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function delete($id){
            $sql = "DELETE FROM facturas WHERE idfactura = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $id);
            
            if ($stmt->execute()){
                return true;
            } else {
                return false;
            }
        }

        // Métodos adicionales para consultas
        public function ventasPorFecha($fechaInicio, $fechaFin){
            $sql = "SELECT f.*, c.nomcliente, u.nomusuario, cv.nomcondicion 
                    FROM facturas f 
                    LEFT JOIN clientes c ON f.idcliente = c.idcliente 
                    LEFT JOIN usuarios u ON f.idusuario = u.idusuario 
                    LEFT JOIN condicionventa cv ON f.idcondicion = cv.idcondicion 
                    WHERE f.fecha BETWEEN :fechaInicio AND :fechaFin 
                    ORDER BY f.fecha DESC";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':fechaInicio', $fechaInicio);
            $stmt->bindParam(':fechaFin', $fechaFin);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function ventasPorCliente($idcliente){
            $sql = "SELECT f.*, c.nomcliente, u.nomusuario, cv.nomcondicion 
                    FROM facturas f 
                    LEFT JOIN clientes c ON f.idcliente = c.idcliente 
                    LEFT JOIN usuarios u ON f.idusuario = u.idusuario 
                    LEFT JOIN condicionventa cv ON f.idcondicion = cv.idcondicion 
                    WHERE f.idcliente = :idcliente 
                    ORDER BY f.fecha DESC";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':idcliente', $idcliente);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function ventasPorProducto($idproducto){
            $sql = "SELECT f.*, c.nomcliente, p.nomproducto, df.cant, df.preuni, 
                    (df.cant * df.preuni) as subtotal
                    FROM facturas f 
                    LEFT JOIN detallefactura df ON f.idfactura = df.idfactura 
                    LEFT JOIN productos p ON df.idproducto = p.idproducto 
                    LEFT JOIN clientes c ON f.idcliente = c.idcliente 
                    WHERE df.idproducto = :idproducto 
                    ORDER BY f.fecha DESC";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':idproducto', $idproducto);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function rankingVentas(){
            $sql = "SELECT f.idfactura, f.fecha, c.nomcliente, f.valorventa, f.igv, 
                    (f.valorventa + f.igv) as total 
                    FROM facturas f 
                    LEFT JOIN clientes c ON f.idcliente = c.idcliente 
                    ORDER BY (f.valorventa + f.igv) DESC 
                    LIMIT 10";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Setters
        public function setIdfactura($id){
            $this->idfactura = $id;
        }
        public function setFecha($fecha){
            $this->fecha = $fecha;
        }
        public function setIdcliente($id){
            $this->idcliente = $id;
        }
        public function setIdusuario($id){
            $this->idusuario = $id;
        }
        public function setIdcondicion($id){
            $this->idcondicion = $id;
        }
        public function setValorventa($valor){
            $this->valorventa = $valor;
        }
        public function setIgv($igv){
            $this->igv = $igv;
        }

        // Getters
        public function getIdfactura(){
            return $this->idfactura;
        }
        public function getFecha(){
            return $this->fecha;
        }
        public function getIdcliente(){
            return $this->idcliente;
        }
        public function getIdusuario(){
            return $this->idusuario;
        }
        public function getIdcondicion(){
            return $this->idcondicion;
        }
        public function getValorventa(){
            return $this->valorventa;
        }
        public function getIgv(){
            return $this->igv;
        }
    }
}
?> 