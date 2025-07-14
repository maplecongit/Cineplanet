<?php
session_start();        // Inicia sesión para acceder a $_SESSION
session_unset();        // Limpia todas las variables de sesión
session_destroy();      // Destruye la sesión
header("Location: login.php"); // Redirige al login (o donde quieras)
exit;
?>
