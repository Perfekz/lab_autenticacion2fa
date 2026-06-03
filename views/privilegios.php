<?php

require '../config/db.php';

$stmt =
$conn->query(
    "SHOW GRANTS FOR 'Hou_user'@'localhost'"
);

$resultados =
$stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Privilegios BD</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">

    <h2>Privilegios del Usuario</h2>

    <p>
        Comando utilizado:
    </p>

    <pre>
SHOW GRANTS FOR 'Hou_user'@'localhost';
    </pre>

    <?php foreach($resultados as $fila): ?>

        <pre><?= current($fila) ?></pre>

    <?php endforeach; ?>

</div>

</body>
</html>
