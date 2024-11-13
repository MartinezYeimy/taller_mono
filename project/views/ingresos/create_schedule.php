<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>

<h1>Registrar Horario de Sala</h1>
<form method="post" action="index.php?action=createSchedule">
    <label>Día:
        <select name="dia" required>
            <option value="Lunes">Lunes</option>
            <option value="Martes">Martes</option>
            <option value="Miércoles">Miércoles</option>
            <option value="Jueves">Jueves</option>
            <option value="Viernes">Viernes</option>
            <option value="Sábado">Sábado</option>
        </select>
    </label><br>
    <label>Materia: <input type="text" name="materia" required></label><br>
    <label>Hora Inicio: <input type="time" name="horaInicio" required></label><br>
    <label>Hora Fin: <input type="time" name="horaFin" required></label><br>
    <label>Programa:
        <select name="idPrograma">
            <?php foreach ($programas as $programa): ?>
                <option value="<?= $programa['id'] ?>"><?= htmlspecialchars($programa['nombre']) ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <label>Sala:
        <select name="idSala">
            <?php foreach ($salas as $sala): ?>
                <option value="<?= $sala['id'] ?>"><?= htmlspecialchars($sala['nombre']) ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <button type="submit">Guardar</button>
</form>
<a href="index.php">Volver</a>
 
</body>
</html>



