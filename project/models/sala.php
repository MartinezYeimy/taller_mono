<?php
require_once 'config.php';

class Sala {
    public static function getAll() {
        $db = dbConnect();
        $stmt = $db->query("SELECT * FROM salas");
        return $stmt->fetchAll();
    }
}
?>

