<?php
require_once 'config.php';

class Ingreso {
    private $db;

    public function __construct() {
        $this->db = dbConnect();
    }

    private function executeQuery($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public static function getAll() {
        $db = dbConnect();
        $stmt = $db->query("SELECT * FROM ingresos");
        return $stmt->fetchAll();
    }

    public static function getById($id) {
        $sql = "SELECT * FROM ingresos WHERE id = :id";
        $params = ['id' => $id];
        return self::executeStaticQuery($sql, $params)->fetch();
    }

    public static function create($data) {
        $sql = "INSERT INTO ingresos (codigoEstudiante, nombreEstudiante, idPrograma, fechaIngreso, horaIngreso, horaSalida, idResponsable, idSala, created_at) 
                VALUES (:codigoEstudiante, :nombreEstudiante, :idPrograma, :fechaIngreso, :horaIngreso, :horaSalida, :idResponsable, :idSala, NOW())";
        self::executeStaticQuery($sql, $data);
    }

    public static function update($id, $data) {
        $sql = "UPDATE ingresos SET codigoEstudiante = :codigoEstudiante, nombreEstudiante = :nombreEstudiante, updated_at = NOW() WHERE id = :id";
        $data['id'] = $id;
        self::executeStaticQuery($sql, $data);
    }

    public static function delete($id) {
        $sql = "DELETE FROM ingresos WHERE id = :id";
        self::executeStaticQuery($sql, ['id' => $id]);
    }

    public static function isWithinAllowedHours($fechaIngreso, $horaIngreso) {
        $diaSemana = date('w', strtotime($fechaIngreso)); 
        $horaIngreso = strtotime($horaIngreso); 

        $horaInicio = strtotime($diaSemana >= 1 && $diaSemana <= 5 ? '07:00' : '07:00');
        $horaFin = strtotime($diaSemana >= 1 && $diaSemana <= 5 ? '20:50' : ($diaSemana == 6 ? '16:30' : null));
        
        return ($horaIngreso >= $horaInicio && $horaIngreso <= $horaFin);
    }

    public static function isRoomAvailable($fechaIngreso, $horaIngreso, $idSala) {
        $horaIngreso = date('H:i', strtotime($horaIngreso)); 
        $diaSemana = date('l', strtotime($fechaIngreso)); 

        $sql = "SELECT * FROM horarios_salas WHERE idSala = :idSala AND dia = :diaSemana AND horaInicio <= :horaIngreso AND horaFin >= :horaIngreso";
        $stmt = self::executeStaticQuery($sql, ['idSala' => $idSala, 'diaSemana' => $diaSemana, 'horaIngreso' => $horaIngreso]);
        return $stmt->rowCount() == 0;
    }

    public function buscarIngresos($fechaInicio, $fechaFin, $codigoEstudiante, $idPrograma, $idResponsable) {
        $sql = "SELECT ingresos.*, programas.nombre as nombrePrograma, responsables.nombre as nombreResponsable
                FROM ingresos
                LEFT JOIN programas ON ingresos.idPrograma = programas.id
                LEFT JOIN responsables ON ingresos.idResponsable = responsables.id
                WHERE 1=1";

        $params = [];
        if ($fechaInicio && $fechaFin) {
            $sql .= " AND fechaIngreso BETWEEN :fechaInicio AND :fechaFin";
            $params['fechaInicio'] = $fechaInicio;
            $params['fechaFin'] = $fechaFin;
        }
        if ($codigoEstudiante) {
            $sql .= " AND codigoEstudiante LIKE :codigoEstudiante";
            $params['codigoEstudiante'] = "%$codigoEstudiante%";
        }
        if ($idPrograma) {
            $sql .= " AND idPrograma = :idPrograma";
            $params['idPrograma'] = $idPrograma;
        }
        if ($idResponsable) {
            $sql .= " AND idResponsable = :idResponsable";
            $params['idResponsable'] = $idResponsable;
        }

        return self::executeStaticQuery($sql, $params)->fetchAll(PDO::FETCH_ASSOC); 
    }

    private static function executeStaticQuery($sql, $params = []) {
        $db = dbConnect();
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
?>
