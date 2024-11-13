<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>

<h1>Registrar Ingreso</h1>
<?php if (isset($error)): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>
<form method="post" action="index.php?action=create">
    <label>Código del Estudiante: <input type="text" name="codigoEstudiante" required></label><br>
    <label>Nombre del Estudiante: <input type="text" name="nombreEstudiante" required></label><br>
    <label>Programa: 
        <select name="idPrograma">
            <?php foreach ($programas as $programa): ?>
                <option value="<?= $programa['id'] ?>"><?= htmlspecialchars($programa['nombre']) ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <label>Fecha de Ingreso: <input type="date" name="fechaIngreso" required></label><br>
    <label>Hora de Ingreso: <input type="time" name="horaIngreso" required></label><br>
    <label>Responsable:
        <select name="idResponsable">
            <?php foreach ($responsables as $responsable): ?>
                <option value="<?= $responsable['id'] ?>"><?= htmlspecialchars($responsable['nombre']) ?></option>
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
