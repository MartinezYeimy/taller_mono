<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Ingreso</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>

<h1>Editar Ingreso</h1>
<form method="post" action="index.php?action=update&id=<?= $ingreso['id'] ?>">
    <input type="hidden" name="id" value="<?= $ingreso['id'] ?>">
    
    <label for="codigoEstudiante">Código Estudiante:</label>
    <input type="text" name="codigoEstudiante" value="<?= $ingreso['codigoEstudiante'] ?>" required>
    
    <label for="nombreEstudiante">Nombre Estudiante:</label>
    <input type="text" name="nombreEstudiante" value="<?= $ingreso['nombreEstudiante'] ?>" required>
    
    </select>
    
    <button type="submit">Actualizar</button>
</form>

</body>
</html>
