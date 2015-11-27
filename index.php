<?php
/* Este es el frontController */

// Ruta de la aplicación
define('SERVER_ROOT', realpath(dirname(__FILE__)));

// Ruta para el cliente
define('SITE_ROOT', 'http://mvcsquib.dev');

// Ejecutar el router.php
require_once(SERVER_ROOT . '/controllers/' . 'router.php');

?>
