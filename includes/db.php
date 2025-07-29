<?php
// Include guard to prevent multiple inclusions
if (!defined('DB_INCLUDED')) {
    define('DB_INCLUDED', true);

    include 'config.php';

    class DBConection{

    public function conectar(){
        try {
            // Crear una nueva conexión PDO
            $pdo = new PDO("mysql:host=" .DBHOST. ";dbname=" .DBNAME. ";charset=utf8", DBUSER, DBPASS);
            // Configurar el modo de error de PDO para excepciones
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
            //echo "Conexión exitosa a la base de datos.";
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error en la conexión: " . $e->getMessage();
            // Retornar false en lugar de null para mejor manejo de errores
            return false;
        }
    }

    // Método para verificar si la base de datos existe
    public function verificarBaseDatos(){
        try {
            // Intentar conectar sin especificar la base de datos
            $pdo = new PDO("mysql:host=" .DBHOST. ";charset=utf8", DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Verificar si la base de datos existe
            $stmt = $pdo->query("SHOW DATABASES LIKE '" . DBNAME . "'");
            $existe = $stmt->rowCount() > 0;
            
            if (!$existe) {
                // Crear la base de datos si no existe
                $pdo->exec("CREATE DATABASE IF NOT EXISTS " . DBNAME . " CHARACTER SET utf8 COLLATE utf8_general_ci");
                echo "Base de datos '" . DBNAME . "' creada exitosamente.<br>";
            }
            
            return true;
        } catch (PDOException $e) {
            echo "Error al verificar/crear la base de datos: " . $e->getMessage();
            return false;
        }
    }

    // Método para ejecutar el script SQL de la base de datos
    public function ejecutarScriptSQL($archivoSQL){
        try {
            $pdo = new PDO("mysql:host=" .DBHOST. ";dbname=" .DBNAME. ";charset=utf8", DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Leer el archivo SQL
            $sql = file_get_contents($archivoSQL);
            
            // Ejecutar el script SQL
            $pdo->exec($sql);
            
            echo "Script SQL ejecutado exitosamente.<br>";
            return true;
        } catch (PDOException $e) {
            echo "Error al ejecutar el script SQL: " . $e->getMessage();
            return false;
        }
    }
    }
}
?>
