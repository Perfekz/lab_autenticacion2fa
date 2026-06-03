<?php
interface HashInterface
{
   public function generarHash(string $texto): string;
   public function validarHash(string $texto,string $hash): bool;
}