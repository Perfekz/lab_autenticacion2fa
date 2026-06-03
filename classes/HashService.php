<?php
require_once __DIR__ . '/../interfaces/HashInterface.php';
class HashService implements HashInterface {
   public function generarHash(string $texto): string {
       return password_hash(
           $texto,
           PASSWORD_BCRYPT
       );
   }
   public function validarHash(string $texto,string $hash): bool {
       return password_verify(
           $texto,
           $hash
       );
   }
}