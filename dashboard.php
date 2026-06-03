<?php

session_start();

if(
    !isset(
        $_SESSION['authenticated']
    )
){
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
</head>
<body>

<h1>
Acceso permitido con 2FA
</h1>

<p>
Bienvenido al sistema.
</p>

</body>
</html>

