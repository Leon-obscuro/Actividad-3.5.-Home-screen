<?php include 'conexion.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Agregar Registro</title>
</head>
<body>
    <h1>Agregar Registro</h1>
    <form action="agregar.php" method="POST">
        Nombre: <input type="text" name="nombre" required><br>
        Email: <input type="email" name="email" required><br>
        Teléfono: <input type="text" name="telefono" required><br>
        <input type="submit" value="Agregar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];

        // Usar prepared statements para evitar inyecciones SQL
        $stmt = $conn->prepare("INSERT INTO registros (nombre, email, telefono) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nombre, $email, $telefono);

        if ($stmt->execute() === TRUE) {
            echo "Registro agregado correctamente";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
    $conn->close();
    ?>
</body>
</html>
