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
        $success = "✅ Registro exitoso. <a href='login.php'>Iniciar sesión</a>";
    } else {
        $error = "❌ Error: " . $stmt->error;
    }

    $stmt->close();
}
?>


<!-- Formulario de Registro -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - Cineplanet</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: #f5f5f5;
            margin: 0;
        }
        .register-box {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 500px;
            width: 100%;
        }
        h2 {
            color: #004fa3;
            margin-bottom: 10px;
        }
        input {
            width: 100%;
            padding: 12px;
            margin: 6px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #004fa3;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
        button:hover {
            background: #003974;
        }
        .login-link {
            margin-top: 20px;
        }
        .login-link a {
            text-decoration: none;
            color: #d9004d;
        }
        .mensaje {
            margin: 10px 0;
            color: green;
        }
        .error {
            margin: 10px 0;
            color: red;
        }
    </style>
</head>
<body>

<div class="register-box">
    <h2>Regístrate</h2>
    <small>Ingresa tus datos para crear tu cuenta Cineplanet.</small>

    <?php
        if (isset($success)) echo "<p class='mensaje'>$success</p>";
        if (isset($error)) echo "<p class='error'>$error</p>";
    ?>

    <form method="post">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="apellido_paterno" placeholder="Apellido paterno" required>
        <input type="text" name="apellido_materno" placeholder="Apellido materno" required>
        <input type="text" name="telefono" placeholder="Teléfono" required>
        <input type="email" name="correo" placeholder="Correo electrónico" required>
        <input type="text" name="dni" placeholder="DNI" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Registrarse</button>
    </form>

    <div class="login-link">
        <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
    </div>
</div>

</body>
</html>
