<?php

session_start();

require '../config/db.php';
require '../vendor/autoload.php';

use Sonata\GoogleAuthenticator\GoogleAuthenticator;

if(!isset($_SESSION['pending_user'])) {
    header(
        "Location: ../views/login.php"
    );

    exit;
}

$stmt = $conn->prepare(
    "SELECT *
     FROM usuarios
     WHERE id = ?"
);

$stmt->execute([
    $_SESSION['pending_user']
]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

$g = new GoogleAuthenticator();

if($g->checkCode($user['secret_2fa'],$_POST['code'])) {

    $_SESSION['authenticated'] = true;

    unset($_SESSION['pending_user']);

    header(
        "Location: ../dashboard.php"
    );

    exit;
}

echo "Código inválido";
