<?php

require '../security/csrf.php';

$error = $_SESSION['error'] ?? null;

unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">

    <h2>Registro de Usuario</h2>

    <form method="POST" action="../controllers/C_register.php">

        <input
            type="text"
            name="nombre"
            placeholder="Nombre"
            required
        >

        <input
            type="text"
            name="apellido"
            placeholder="Apellido"
            required
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
            minlength="8"
            required
        >

        <input
            type="password"
            name="confirm"
            placeholder="Confirmar contraseña"
            minlength="8"
            required
        >

        <select name="sexo" required>
            <option value="">Seleccione</option>
            <option value="M">Masculino</option>
            <option value="F">Femenino</option>
        </select>

        <input
            type="hidden"
            name="csrf"
            value="<?= generarToken() ?>"
        >

        <?php if($error): ?>
            <div class="error">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <button type="submit">
            Registrar
        </button>

        <a
            href="login.php"
            class="link">¿Ya tienes una cuenta? Inicia sesión aquí</a>

    </form>

</div>

<script>

document.querySelector("form").addEventListener(
    "submit",
    function(e){

        const p1 =
        document.querySelector('[name=password]').value;

        const p2 =
        document.querySelector('[name=confirm]').value;

        if(p1 !== p2){

            alert(
                "Las contraseñas no coinciden"
            );

            e.preventDefault();
        }
    }
);

</script>

</body>
</html>
