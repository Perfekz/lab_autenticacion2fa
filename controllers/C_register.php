<?php

require '../config/db.php';
require '../classes/Sanitizador.php';
require '../classes/HashService.php';
require '../classes/RegistroUsuario.php';
require '../security/csrf.php';
require '../vendor/autoload.php';

use Sonata\GoogleAuthenticator\GoogleAuthenticator;

if(!validarToken($_POST['csrf'])) {
    die("Token CSRF inválido");
}

$nombre = Sanitizador::texto($_POST['nombre']);

$apellido = Sanitizador::texto($_POST['apellido']);

$email = Sanitizador::email($_POST['email']);

$sexo = $_POST['sexo'];

if(!in_array($sexo,['M','F'])){
    die("Sexo inválido");
}

if($_POST['password'] !== $_POST['confirm']){
    die(
        "Las contraseñas no coinciden"
    );
}

$registro = new RegistroUsuario();

if($registro->existeCorreo($conn,$email)){
    die("Correo ya registrado");
}

$hashService = new HashService();

$hash = $hashService->generarHash($_POST['password']);

$g = new GoogleAuthenticator();

$secret = $g->generateSecret();

$registro->guardar(
    $conn,
    [
        'nombre' => $nombre,
        'apellido' => $apellido,
        'email' => $email,
        'password' => $hash,
        'sexo' => $sexo,
        'secret' => $secret
    ]
);

header(
    "Location: ../views/login.php"
);

exit;
