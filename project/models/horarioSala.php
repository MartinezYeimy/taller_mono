<?php
require_once 'config.php';

class HorarioSala {
    public static function create($data) {
        $db = dbConnect();
        $stmt = $db->prepare("INSERT INTO horarios_salas (dia, materia, horaInicio, horaFin, idPrograma, idSala) VALUES (:dia, :materia, :horaInicio, :horaFin, :idPrograma, :idSala)");
        $stmt->execute($data);
        return $db->lastInsertId();
    }

    public static function getAll() {
        $db = dbConnect();
        $stmt = $db->query("SELECT * FROM horarios_salas");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
