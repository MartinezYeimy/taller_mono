<?php
require_once 'config.php';

class Responsable {
    private $db;

    public static function getAll() {
        $db = dbConnect();
        $stmt = $db->query("SELECT * FROM responsables");
        return $stmt->fetchAll();
    }

    public function __construct() {
        $this->db = dbConnect();
    }
    
    public function obtenerResponsables() {
        $sql = "SELECT * FROM responsables";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

