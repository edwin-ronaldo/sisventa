<?php
// Include guard to prevent multiple inclusions
if (!defined('VENTA_CONTROLLER_INCLUDED')) {
    define('VENTA_CONTROLLER_INCLUDED', true);

    include $_SERVER['DOCUMENT_ROOT']."/sisventas/modelo/venta.php";
    include $_SERVER['DOCUMENT_ROOT']."/sisventas/modelo/detalleventa.php";

    class VentaController{

        public function obtener_listado(){
            $listado = new Venta();
            $res = $listado->listado();
            return $res;
        }

        public function buscar_venta($id){
            $venta = new Venta();
            $res = $venta->buscar($id);
            return $res;
        }

        public function registrar_venta($fecha, $idcliente, $idusuario, $idcondicion, $valorventa, $igv, $detalles){
            $oventa = new Venta();
            $oventa->setFecha($fecha);
            $oventa->setIdcliente($idcliente);
            $oventa->setIdusuario($idusuario);
            $oventa->setIdcondicion($idcondicion);
            $oventa->setValorventa($valorventa);
            $oventa->setIgv($igv);

            $idfactura = $oventa->create();
            
            if ($idfactura){
                // Registrar detalles de la venta
                foreach ($detalles as $detalle) {
                    $odetalle = new DetalleVenta();
                    $odetalle->setIdfactura($idfactura);
                    $odetalle->setIdproducto($detalle['idproducto']);
                    $odetalle->setCant($detalle['cantidad']);
                    $odetalle->setCosuni($detalle['cosuni']);
                    $odetalle->setPreuni($detalle['preuni']);
                    $odetalle->create();
                }
                return $idfactura;
            } else {
                return false;
            }
        }

        public function ventas_por_fecha($fechaInicio, $fechaFin){
            $venta = new Venta();
            $res = $venta->ventasPorFecha($fechaInicio, $fechaFin);
            return $res;
        }

        public function ventas_por_cliente($idcliente){
            $venta = new Venta();
            $res = $venta->ventasPorCliente($idcliente);
            return $res;
        }

        public function ventas_por_producto($idproducto){
            $venta = new Venta();
            $res = $venta->ventasPorProducto($idproducto);
            return $res;
        }

        public function ranking_ventas(){
            $venta = new Venta();
            $res = $venta->rankingVentas();
            return $res;
        }

        public function obtener_detalle_venta($idfactura){
            $detalle = new DetalleVenta();
            $res = $detalle->listadoPorFactura($idfactura);
            return $res;
        }

        public function obtener_stock_producto($idproducto){
            $detalle = new DetalleVenta();
            $res = $detalle->obtenerStockProducto($idproducto);
            return $res;
        }

        public function obtener_precio_producto($idproducto){
            $detalle = new DetalleVenta();
            $res = $detalle->obtenerPrecioProducto($idproducto);
            return $res;
        }
    }
}
?> 