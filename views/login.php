<?php
session_start();

$error = $_SESSION['error'] ?? null;

unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
        <link rel="stylesheet"
            href="../css/style.css">
</head>
<body>

<div class="container">

    <h2>Iniciar Sesión</h2>

    <form
        method="POST"
        action="../controllers/C_login.php"
    >

        <input
            type="email"
            name="email"
            placeholder="Correo"
            required
        >

        <input
            type="password"
            name="password"
            placeholder="Contraseña"
            required
        >

        <?php if($error): ?>
            <div class="error">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <button type="submit">
            Ingresar
        </button>

        <a
            href="register.php"
            class="link">¿No tienes cuenta? Regístrate aquí</a>

    </form>

</div>

</body>
</html>