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

        <button type="submit">
            Ingresar
        </button>

    </form>

</div>

</body>
</html>