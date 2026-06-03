<?php

session_start();

require '../config/db.php';
require '../classes/HashService.php';
require '../classes/Sanitizador.php';

function volverConError($mensaje)
{
    $_SESSION['error'] = $mensaje;

    header("Location: ../views/login.php");
    exit;
}

$email = Sanitizador::email($_POST['email']);

$password =
$_POST['password'];

$stmt = $conn->prepare(
    "SELECT *
     FROM usuarios
     WHERE email = ?"
);

$stmt->execute([$email]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

$hashService = new HashService();

if(
    $user
    &&
    $hashService->validarHash(
        $password,
        $user['password']
    )
){

    $_SESSION['pending_user']
    =
    $user['id'];

    header(
        "Location: ../views/2fa.php"
    );

    exit;
}

volverConError("Login incorrecto");
