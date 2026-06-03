<?php

session_start();

if(!isset($_SESSION['authenticated'])) {
    header(
        "Location: views/login.php"
    );

    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

    <h1>
        Acceso permitido con 2FA
    </h1>

    <p>
        Bienvenido al sistema.
    </p>

    <a
        href="logout.php"
        class="logout"
    >
        Cerrar Sesión
    </a>

</div>

</body>
</html>
