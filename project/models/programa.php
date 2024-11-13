
<?php
require_once 'config.php';

class Programa {
    private $db;

    public static function getAll() {
        $db = dbConnect();
        $stmt = $db->query("SELECT * FROM programas");
        return $stmt->fetchAll();
    }
    
    public function __construct() {
        $this->db = dbConnect();
    }

    public function obtenerProgramas() {
        $sql = "SELECT * FROM programas";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

