<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Documentos</title>
    <link rel="stylesheet" href="/document-crud/public/assets/css/style.css">
</head>
<body>

<div style="display:flex; justify-content:space-between; align-items:center;">
    <h2>Lista de Documentos</h2>

    <form method="GET" action="/document-crud/public/logout">
        <button type="submit">Cerrar sesión</button>
    </form>
</div>

<hr>

<!-- Formulario de búsqueda -->
<form method="GET" action="/document-crud/public/documentos" style="margin-bottom:15px;">
    <input 
        type="text" 
        name="q" 
        placeholder="Buscar por nombre o código"
        value="<?= htmlspecialchars($_GET['q'] ?? '') ?>"
    >
    <button type="submit">Buscar</button>
</form>

<a href="/document-crud/public/documentos/create">Crear Documento</a>

<br><br>

<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Código</th>
            <th>Tipo</th>
            <th>Proceso</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($documentos) > 0): ?>
            <?php foreach ($documentos as $doc): ?>
                <tr>
                    <td><?= $doc->id ?></td>
                    <td><?= htmlspecialchars($doc->nombre) ?></td>
                    <td><?= htmlspecialchars($doc->codigo) ?></td>
                    <td><?= htmlspecialchars($doc->tipo->nombre) ?></td>
                    <td><?= htmlspecialchars($doc->proceso->nombre) ?></td>
                    <td>
                        <a href="/document-crud/public/documentos/edit?id=<?= $doc->id ?>">Editar</a>

                        <form method="POST" action="/document-crud/public/documentos/delete" style="display:inline;">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                            <input type="hidden" name="id" value="<?= $doc->id ?>">
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No se encontraron documentos.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>