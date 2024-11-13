<?php
require_once 'config.php';

class Estudiante {
    public static function getAll() {
        $db = dbConnect();
        $stmt = $db->query("SELECT * FROM estudiantes");
        return $stmt->fetchAll();
    }
}
?>



