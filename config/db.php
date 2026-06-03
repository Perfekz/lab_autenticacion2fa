<?php
try {
   $conn = new PDO(
       "mysql:host=localhost;dbname=sistema_2fa;charset=utf8mb4",
       "Hou_user",
       "1234567"
   );
   $conn->setAttribute(
       PDO::ATTR_ERRMODE,
       PDO::ERRMODE_EXCEPTION
   );
} catch(PDOException $e){
   die(
       "Error de conexión: "
       . $e->getMessage()
   );
}