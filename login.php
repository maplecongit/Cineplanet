<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    $password = $_POST["password"];

    $sql = "SELECT id_cliente, password, nombre FROM cliente WHERE correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $cliente = $result->fetch_assoc();

        if (password_verify($password, $cliente['password'])) {
            $_SESSION['id_cliente'] = $cliente['id_cliente'];
            $_SESSION['nombre'] = $cliente['nombre'];
            header("Location: index.php");
            exit;
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Correo no encontrado.";
    }

    $stmt->close();
}
?>

<!-- Formulario HTML -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión - Cineplanet</title>
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
        .login-box {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        h2 {
            color: #004fa3;
            margin-bottom: 10px;
        }
        input {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
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
        }
        button:hover {
            background: #003974;
        }
        .register-section {
            margin-top: 30px;
        }
        .register-section a {
            text-decoration: none;
            background: #d9004d;
            color: white;
            padding: 10px 20px;
            border-radius: 30px;
            display: inline-block;
        }
        .register-section a:hover {
            background: #b8003f;
        }
        small {
            display: block;
            margin-bottom: 20px;
            color: #666;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Iniciar sesión</h2>
    <small>Ingresa a tu cuenta para disfrutar de los beneficios.</small>

    <form method="POST">
        <input type="email" name="correo" placeholder="Correo electrónico" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Ingresar</button>
    </form>

    <div class="register-section">
        <p>¿No eres socio?</p>
        <a href="registro.php">Únete</a>
    </div>
</div>

</body>
</html>
