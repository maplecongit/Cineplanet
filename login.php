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
<form method="post">
    <input type="email" name="correo" placeholder="Correo" required><br>
    <input type="password" name="password" placeholder="Contraseña" required><br>
    <button type="submit">Iniciar sesión</button>
</form>

<p>¿no tienes cuenta? <a href="registro.php">registra sesión aquí</a></p>
