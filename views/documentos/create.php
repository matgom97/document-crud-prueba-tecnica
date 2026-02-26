<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Crear Documento</title>
    <link rel="stylesheet" href="/document-crud/public/assets/css/style.css">
</head>
<body>

<div style="display:flex; justify-content:space-between; align-items:center;">
    <h2>Documentos</h2>

    <form method="GET" action="/document-crud/public/logout">
        <button type="submit">Cerrar sesión</button>
    </form>
</div>

<hr>

<div class="form-container">
    <div class="form-card">
        <h2>Crear Documento</h2>

        <form method="POST" action="/document-crud/public/documentos">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

            <label>Nombre</label>
            <input type="text" name="nombre" required>

            <label>Contenido</label>
            <textarea name="contenido" required></textarea>

            <label>Tipo</label>
            <select name="tipo_id" required>
                <?php foreach ($tipos as $tipo): ?>
                    <option value="<?= $tipo->id ?>">
                        <?= htmlspecialchars($tipo->nombre) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Proceso</label>
            <select name="proceso_id" required>
                <?php foreach ($procesos as $proceso): ?>
                    <option value="<?= $proceso->id ?>">
                        <?= htmlspecialchars($proceso->nombre) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Guardar</button>
        </form>

        <br>
        <a href="/document-crud/public/documentos">← Volver a la lista</a>
    </div>
</div>

</body>
</html>