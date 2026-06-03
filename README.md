# Autenticación 2FA en PHP

Este proyecto es un sistema de autenticación de usuarios con segundo factor (2FA) construido en PHP y MySQL. El flujo combina validación de credenciales tradicionales con un código TOTP generado por Google Authenticator.

## Qué hace este proyecto

- Registra usuarios con datos personales básicos: nombre, apellido, email y sexo.
- Almacena la contraseña con `password_hash` usando `PASSWORD_BCRYPT`.
- Genera un secreto 2FA único durante el registro con `sonata-project/google-authenticator`.
- Muestra un código QR que los usuarios pueden escanear con Google Authenticator o Authy.
- Valida el código de 6 dígitos en un segundo paso antes de permitir el acceso.
- Protege el registro con un token CSRF y sanitiza las entradas antes de guardarlas.

## Conceptos aplicados en el proyecto

- Autenticación de dos factores (2FA): se usa TOTP para requerir un segundo factor adicional después de validar la contraseña.
- Hasheo de contraseñas: se emplea `password_hash()` y `password_verify()` para guardar y verificar contraseñas de forma segura.
- CSRF: el formulario de registro implementa un token CSRF para reducir riesgos de envío de formularios desde orígenes no autorizados.
- Sanitización de inputs: los datos del usuario se limpian antes de procesarlos para evitar inyección de HTML y otros datos maliciosos.
- Sesiones PHP: el sistema utiliza `$_SESSION` para almacenar el usuario pendiente de 2FA y el estado de autenticación del usuario.
- Arquitectura separada: divide la lógica de presentación (`views`), controladores (`controllers`) y servicios de negocio (`classes`).
- Uso de librerías externas: la dependencia `sonata-project/google-authenticator` proporciona las funciones necesarias para generar y validar códigos TOTP.

## Estructura del proyecto

- `views/`
  - `register.php` — formulario de registro con validación básica y token CSRF.
  - `login.php` — formulario de inicio de sesión.
  - `2fa.php` — pantalla de verificación 2FA; construye un URI `otpauth://` y usa `api.qrserver.com` para mostrar el código QR.
  - `hash.php`, `privilegios.php` — vistas adicionales incluidas en el proyecto (no parte del flujo central de 2FA).
- `controllers/`
  - `C_register.php` — procesa el registro, valida los datos, genera hash y secreto 2FA, y guarda al usuario.
  - `C_login.php` — valida el email y la contraseña, y setea `pending_user` en sesión para el siguiente paso.
  - `C_verify_2fa.php` — valida el código TOTP contra el secreto guardado en la base de datos.
- `classes/`
  - `HashService.php` — ofrece métodos para generar y verificar hashes de contraseña.
  - `RegistroUsuario.php` — comprueba si un email ya existe y guarda el nuevo usuario.
  - `Sanitizador.php` — sanitiza texto, email y datos numéricos antes de procesarlos.
- `config/`
  - `db.php` — conexión a la base de datos MySQL con PDO.
- `security/`
  - `csrf.php` — crea y valida el token CSRF usado en el formulario de registro.
- `dashboard.php` — área protegida a la que se accede solo tras completar 2FA.
- `logout.php` — destruye la sesión y redirige al login.
- `vendor/` — dependencias instaladas con Composer, incluyendo `sonata-project/google-authenticator`.

## Requisitos

- PHP 7.4 o superior.
- MySQL o MariaDB.
- Composer.
- Servidor local como WAMP o XAMPP.

## Uso del sistema

1. Abre `views/register.php` en tu navegador.
2. Crea un usuario nuevo con email y contraseña.
3. Inicia sesión en `views/login.php`.
4. Se redirige automáticamente a `views/2fa.php`.
5. Escanea el código QR con Google Authenticator o Authy.
6. Ingresa el código de 6 dígitos y accede a `dashboard.php`.

## Flujo de autenticación detallado

1. Registro:
   - `views/register.php` envía datos a `controllers/C_register.php`.
   - `C_register.php` valida el token CSRF con `security/csrf.php`.
   - Sanitiza campos con `classes/Sanitizador.php`.
   - Genera el hash de contraseña con `classes/HashService.php`.
   - Genera el secreto 2FA con `GoogleAuthenticator::generateSecret()`.
   - Guarda el usuario en la tabla `usuarios`.
2. Login:
   - `views/login.php` envía credenciales a `controllers/C_login.php`.
   - `C_login.php` compara la contraseña con el hash guardado.
   - Si es correcto, guarda `pending_user` en sesión y redirige a `views/2fa.php`.
3. 2FA:
   - `views/2fa.php` obtiene el secreto 2FA del usuario y construye un URI `otpauth://totp/MiSistema:email?...`.
   - Muestra un QR generado por `https://api.qrserver.com/v1/create-qr-code/`.
   - `controllers/C_verify_2fa.php` valida el código TOTP usando `GoogleAuthenticator::checkCode()`.
   - Si el código es correcto, se crea la sesión `authenticated` y se accede al dashboard.

## Seguridad aplicada

- Contraseñas almacenadas con `password_hash(..., PASSWORD_BCRYPT)`.
- Token CSRF para evitar envíos de formulario maliciosos en el registro.
- Sanitización de los datos de entrada con `Sanitizador`.
- Control de sesión en `dashboard.php` y `C_verify_2fa.php` para bloquear acceso directo.
- Separación de la verificación de credenciales del paso 2FA.

---

Este laboratorio ha sido desarrollado por estudiantes de la Universidad Tecnológica de Panamá:

Nombres: Erick Hou 8-1017-473 y Jessica Zheng 8-1033-370

Correo: erick.hou@utp.ac.pa y jessica.zheng@utp.ac.pa

Curso: Desarrollo de Software VII

Instructor del Laboratorio: Irina Fong

Fecha de ejecución: 03/06/2026
