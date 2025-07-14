<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $apellido_paterno = $_POST["apellido_paterno"];
    $apellido_materno = $_POST["apellido_materno"];
    $telefono = $_POST["telefono"];
    $correo = $_POST["correo"];
    $dni = $_POST["dni"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO cliente (nombre, apellido_paterno, apellido_materno, telefono, correo, dni, password)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $nombre, $apellido_paterno, $apellido_materno, $telefono, $correo, $dni, $password);
    
    if ($stmt->execute()) {
        echo "✅ Registro exitoso. <a href='login.php'>Iniciar sesión</a>";
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!-- Formulario de Registro -->
<form method="post">
    <input type="text" name="nombre" placeholder="Nombre" required><br>
    <input type="text" name="apellido_paterno" placeholder="Apellido paterno" required><br>
    <input type="text" name="apellido_materno" placeholder="Apellido materno" required><br>
    <input type="text" name="telefono" placeholder="Teléfono" required><br>
    <input type="email" name="correo" placeholder="Correo" required><br>
    <input type="text" name="dni" placeholder="DNI" required><br>
    <input type="password" name="password" placeholder="Contraseña" required><br>
    <button type="submit">Registrarse</button>
</form>

<p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
