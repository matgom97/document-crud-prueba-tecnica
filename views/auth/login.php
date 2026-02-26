<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="/document-crud/public/assets/css/style.css">
</head>
<body>

<div class="login-container">
    <div class="login-card">
        <h2>Iniciar Sesión</h2>

        <?php if (!empty($_SESSION['error'])): ?>
            <p style="color:red; text-align:center;">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </p>
        <?php endif; ?>

        <form method="POST" action="/document-crud/public/login">
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>

            <button type="submit">Ingresar</button>
        </form>
    </div>
</div>

</body>
</html>