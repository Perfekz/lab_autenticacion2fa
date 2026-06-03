<?php
interface RegistroInterface {
   public function existeCorreo(PDO $conn,string $email): bool;
   public function guardar(PDO $conn,array $datos): bool;
}