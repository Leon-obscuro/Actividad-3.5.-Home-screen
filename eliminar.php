<?php include 'conexion.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Eliminar Registro</title>
</head>
<body>
    <h1>Eliminar Registro</h1>
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
    <p>¿Estás seguro de eliminar el registro de <?php echo $row['nombre']; ?>?</p>
    <form action="eliminar.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <input type="submit" value="Eliminar">
    </form>
    <?php
        } else {
            echo "No se encontró el registro";
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];

        // Usar prepared statement para eliminar el registro
        $stmt = $conn->prepare("DELETE FROM registros WHERE id=?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute() === TRUE) {
            echo "Registro eliminado correctamente";
        } else {
            echo "Error al eliminar el registro: " . $stmt->error;
        }

        $stmt->close();
    }
    $conn->close();
    ?>
</body>
</html>
