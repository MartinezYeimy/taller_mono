<?php
 function dbConnect() {
        $host = 'localhost';
        $db = 'ingresos_salas_db';
        $user = 'root';
        $pass = '';

        try {
            $pdo = new PDO(
                "mysql:host=$host;dbname=$db",
                $user,
                $pass,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
            return $pdo;
        } catch (PDOException $e) {
            die('Error en la conexión: ' . $e->getMessage());
        }
    }

?>


