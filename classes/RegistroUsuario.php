<?php
require_once __DIR__
. '/../interfaces/RegistroInterface.php';
class RegistroUsuario implements RegistroInterface {
   public function existeCorreo(PDO $conn,string $email): bool {
       $stmt = $conn->prepare(
           "SELECT id
            FROM usuarios
            WHERE email = ?"
       );
       $stmt->execute([$email]);
       return (bool)$stmt->fetch();
   }
   public function guardar(PDO $conn,array $datos): bool {
       $stmt = $conn->prepare(
           "INSERT INTO usuarios
           (
               nombre,
               apellido,
               email,
               password,
               sexo,
               secret_2fa
           )
           VALUES
           (?,?,?,?,?,?)"
       );
       return $stmt->execute([
           $datos['nombre'],
           $datos['apellido'],
           $datos['email'],
           $datos['password'],
           $datos['sexo'],
           $datos['secret']
       ]);
   }
}