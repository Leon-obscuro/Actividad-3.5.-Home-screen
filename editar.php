<?php include 'conexion.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Registro</title>
</head>
<body>
    <h1>Editar Registro</h1>
    <?php
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $conn->prepare("SELECT * FROM registros WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
    <form action="editar.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        Nombre: <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>" required><br>
        Email: <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br>
        Teléfono: <input type="text" name="telefono" value="<?php echo $row['telefono']; ?>" required><br>
        <input type="submit" value="Guardar Cambios">
    </form>
    <?php
        } else {
            echo "No se encontró el registro";
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];

        // Usar prepared statement para actualizar el registro
        $stmt = $conn->prepare("UPDATE registros SET nombre=?, email=?, telefono=? WHERE id=?");
        $stmt->bind_param("sssi", $nombre, $email, $telefono, $id);

        if ($stmt->execute() === TRUE) {
            echo "Registro actualizado correctamente";
        } else {
            echo "Error al actualizar el registro: " . $stmt->error;
        }

        $stmt->close();
    }
    $conn->close();
    ?>
</body>
</html>
