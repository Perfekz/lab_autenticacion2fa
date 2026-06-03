<?php

session_start();

require '../config/db.php';

if(!isset($_SESSION['pending_user'])){
    header("Location: login.php");
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

$secret = $user['secret_2fa'];

$app = "MiSistema";

$otpauth = "otpauth://totp/".$app.":".$user['email']."?secret=".$secret."&issuer=".$app;

$qr = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=".urlencode($otpauth);

?>

<!DOCTYPE html>
<html>
<head>
    <title>2FA</title>
    <link rel="stylesheet"
          href="../css/style.css">
</head>
<body>

<div class="container">

    <h2>Autenticación 2FA</h2>

    <div class="qr">
        <img src="<?= $qr ?>">
    </div>

    <form
        method="POST"
        action="../controllers/C_verify_2fa.php"
    >

        <input
            type="text"
            name="code"
            placeholder="Código de 6 dígitos"
            required
        >

        <button type="submit">
            Verificar
        </button>

    </form>

</div>

</body>
</html>
