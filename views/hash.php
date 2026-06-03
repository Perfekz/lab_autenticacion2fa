<?php

require '../classes/HashService.php';

$hash = '';
$validacion = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $hashService = new HashService();

    if (isset($_POST['generar'])) {

        $hash = $hashService->generarHash($_POST['texto']);

    }

    if (isset($_POST['validar'])) {

        $resultado = $hashService->validarHash(
            $_POST['texto_validar'],
            $_POST['hash_validar']
        );

        $validacion =
        $resultado
        ? 'Hash válido'
        : 'Hash inválido';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Prueba de Hash</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">

    <h2>Generar Hash</h2>

    <form method="POST">

        <input
            type="text"
            name="texto"
            placeholder="Texto"
            required
        >

        <button
            type="submit"
            name="generar"
        >
            Generar Hash
        </button>

    </form>

    <?php if($hash): ?>

        <textarea rows="4" readonly><?= $hash ?></textarea>

    <?php endif; ?>

    <hr>

    <h2>Validar Hash</h2>

    <form method="POST">

        <input
            type="text"
            name="texto_validar"
            placeholder="Texto original"
            required
        >

        <textarea
            name="hash_validar"
            rows="4"
            placeholder="Hash"
            required
        ></textarea>

        <button
            type="submit"
            name="validar"
        >
            Validar Hash
        </button>

    </form>

    <?php if($validacion): ?>

        <p><?= $validacion ?></p>

    <?php endif; ?>

</div>

</body>
</html>
