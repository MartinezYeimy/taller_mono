<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css.css">

    <script>
    window.onload = function() {
        var filterContainer = document.getElementById("filter-container");
        var table = document.querySelector("table");

       
        filterContainer.style.display = "none"; 
    };

    function toggleFilters() {
        var filterContainer = document.getElementById("filter-container");
        var button = document.getElementById("toggle-filter-button");

        if (filterContainer.style.display === "none" || filterContainer.style.display === "") {
            filterContainer.style.display = "flex";
            button.textContent = "Ocultar filtros";
        } else {
            filterContainer.style.display = "none";
            button.textContent = "Filtrar";
        }
    }
</script>
</head>

<body>
<div class="button-container">
        <a href="index.php?action=create" class="button">Registrar Ingreso</a>
        <a href="index.php?action=createSchedule" class="button">Registrar Horario de Sala</a>
    </div>

    <button type="button" id="toggle-filter-button" onclick="toggleFilters()">Filtrar</button>

    <div id="filter-container" class="filter-container">
    <form id="filter-form">
  <label for="start-date">Fecha de inicio:</label>
  <input type="date" id="start-date" name="start-date" required>
  
  <label for="end-date">Fecha de fin:</label>
  <input type="date" id="end-date" name="end-date" required>
  
  <button type="submit">Filtrar</button>
</form>
        <form method="GET" action="index.php">
            <input type="hidden" name="controller" value="Ingreso">
            <input type="hidden" name="action" value="index">
            <label>Código Estudiante:</label>
            <input type="text" name="codigoEstudiante" value="<?= $_GET['codigoEstudiante'] ?? '' ?>">

            <label>Programa:</label>
            <select name="idPrograma">
                <option value="">Todos</option>
                <?php foreach ($programas as $programa): ?>
                    <option value="<?= $programa['id'] ?>" 
                        <?= isset($_GET['idPrograma']) && $_GET['idPrograma'] == $programa['id'] ? 'selected' : '' ?>>
                        <?= $programa['nombre'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Responsable:</label>
            <select name="idResponsable">
                <option value="">Todos</option>
                <?php foreach ($responsables as $responsable): ?>
                    <option value="<?= $responsable['id'] ?>" 
                        <?= isset($_GET['idResponsable']) && $_GET['idResponsable'] == $responsable['id'] ? 'selected' : '' ?>>
                        <?= $responsable['nombre'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Filtrar</button>
        </form>
    </div>
    <table>
    <tr>
        <th>Código</th>
        <th>Nombre del estudiante</th>
        <th>Programa</th>
        <th>Fecha Ingreso</th>
        <th>Hora Ingreso</th>
        <th>Hora Salida</th>
        <th>Sala</th>
        <th>Responsable Ingreso</th>
        <th>Acciones</th>
    </tr>
    <?php if (!empty($ingresos)): ?>
    <?php foreach ($ingresos as $ingreso): ?>
    <tr>
        <td><?= htmlspecialchars($ingreso['codigoEstudiante']) ?></td>
        <td><?= htmlspecialchars($ingreso['nombreEstudiante']) ?></td>
        
        <td>
            <?php 
                $programaNombre = '';
                foreach ($programas as $programa) {
                    if ($programa['id'] == $ingreso['idPrograma']) {
                        $programaNombre = $programa['nombre'];
                        break;
                    }
                }
                echo htmlspecialchars($programaNombre);
            ?>
        </td>
        
        <td><?= htmlspecialchars($ingreso['fechaIngreso']) ?></td>
        <td><?= htmlspecialchars($ingreso['horaIngreso']) ?></td>
        <td><?= htmlspecialchars($ingreso['horaSalida']) ?></td>
        <td><?= htmlspecialchars($ingreso['idSala']) ?></td>

        <td>
            <?php 
            
                $responsableNombre = '';
                foreach ($responsables as $responsable) {
                    if ($responsable['id'] == $ingreso['idResponsable']) {
                        $responsableNombre = $responsable['nombre'];
                        break;
                    }
                }
                echo htmlspecialchars($responsableNombre);
            ?>
        </td>
        
        <td>
            <a href="index.php?action=edit&id=<?= $ingreso['id'] ?>">Modificar</a>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="7">No se encontraron resultados</td></tr>
    <?php endif; ?>
</table>
</body>
</html>