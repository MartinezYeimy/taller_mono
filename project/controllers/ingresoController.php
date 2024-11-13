<?php
require_once 'models/Ingreso.php';
require_once 'models/Programa.php';
require_once 'models/Sala.php';
require_once 'models/HorarioSala.php';
require_once 'models/Responsable.php';

class IngresoController {
    public function index() {
        $ingresos = Ingreso::getAll();
        $ingresoModel = new Ingreso();
        $programaModel = new Programa();
        $responsableModel = new Responsable();
    
        $fechaInicio = $_GET['fechaInicio'] ?? '';
        $fechaFin = $_GET['fechaFin'] ?? '';
        $codigoEstudiante = $_GET['codigoEstudiante'] ?? '';
        $idPrograma = $_GET['idPrograma'] ?? '';
        $idResponsable = $_GET['idResponsable'] ?? '';
    
        $ingresos = $ingresoModel->buscarIngresos($fechaInicio, $fechaFin, $codigoEstudiante, $idPrograma, $idResponsable);
        $programas = $programaModel->obtenerProgramas();
        $responsables = $responsableModel->obtenerResponsables();
    
       require_once 'views/ingresos/index.php';
    }
    
    public function create() {
        $programas = Programa::getAll();
        $salas = Sala::getAll();
        $responsables = Responsable::getAll();
        $error = null; 

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fechaIngreso = $_POST['fechaIngreso'];
            $horaIngreso = $_POST['horaIngreso'];
            $idSala = $_POST['idSala'];

            if (!Ingreso::isWithinAllowedHours($fechaIngreso, $horaIngreso)) {
                $error = "Error: Ingreso fuera del horario permitido.";
            }
            elseif (!Ingreso::isRoomAvailable($fechaIngreso, $horaIngreso, $idSala)) {
                $error = "Error: La sala no está disponible en ese horario.";
            } else {
                $data = [
                    'codigoEstudiante' => $_POST['codigoEstudiante'],
                    'nombreEstudiante' => $_POST['nombreEstudiante'],
                    'idPrograma' => $_POST['idPrograma'],
                    'fechaIngreso' => $fechaIngreso,
                    'horaIngreso' => $horaIngreso,
                    'horaSalida' => $_POST['horaSalida'],
                    'idResponsable' => $_POST['idResponsable'],
                    'idSala' => $idSala,
                ];
                Ingreso::create($data);
                header('Location: index.php');
                exit();
            }
        }
        require 'views/ingresos/create.php';
    }

    public function edit() {
        $id = $_GET['id'];
        $ingreso = Ingreso::getById($id);
        $programas = Programa::getAll();
       require 'views/ingresos/edit.php';
    }

    public function update() {
        $id = $_POST['id'];
        $data = [
            'codigoEstudiante' => $_POST['codigoEstudiante'],
            'nombreEstudiante' => $_POST['nombreEstudiante'],
        ];
        Ingreso::update($id, $data);
        header('Location: index.php');
        exit();
    }

    public function delete() {
        $id = $_GET['id'];
        Ingreso::delete($id);
        header('Location: index.php');
        exit();
    }

    public function createSchedule() {
        $programas = Programa::getAll();
        $salas = Sala::getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'dia' => $_POST['dia'],
                'materia' => $_POST['materia'],
                'horaInicio' => $_POST['horaInicio'],
                'horaFin' => $_POST['horaFin'],
                'idPrograma' => $_POST['idPrograma'],
                'idSala' => $_POST['idSala'],
            ];
            HorarioSala::create($data);
            header('Location: index.php');
            exit();
        }
       require 'views/ingresos/create_schedule.php';
    }
}
?>
