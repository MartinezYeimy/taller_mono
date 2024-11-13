<?php
require_once 'config.php';

$controller = $_GET['controller'] ?? 'Ingreso'; 
$action = $_GET['action'] ?? 'index'; 

$controllerName = $controller . 'Controller';
$controllerFile = "controllers/$controllerName.php";

if (file_exists($controllerFile)) {
    require_once $controllerFile;

    if (class_exists($controllerName)) {
        $controllerObj = new $controllerName();

        switch ($action) {
            case 'index':
                $controllerObj->index();
                break;
            case 'create':
                $controllerObj->create();
                break;
            case 'edit':
                $controllerObj->edit();
                break;
            case 'update':
                $controllerObj->update();
                break;
            case 'delete':
                $controllerObj->delete();
                break;
            case 'createSchedule':
                $controllerObj->createSchedule();
                break;
            default:
                echo "Error: Acción '$action' no válida.";
                break;
        }
    } else {
        echo "Error: El controlador '$controllerName' no existe.";
    }
} else {
    echo "Error: El archivo del controlador '$controllerName.php' no fue encontrado.";
}
?>

