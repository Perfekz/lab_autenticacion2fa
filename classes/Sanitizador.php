<?php
class Sanitizador
{
   public static function texto(string $valor): string {
       return htmlspecialchars(
           trim($valor),
           ENT_QUOTES,
           'UTF-8'
       );
   }
   public static function email(string $valor): string {
       return filter_var(
           trim($valor),
           FILTER_SANITIZE_EMAIL
       );
   }
   public static function entero(string $valor): int {
       return (int) filter_var(
           $valor,
           FILTER_SANITIZE_NUMBER_INT
       );
   }
}