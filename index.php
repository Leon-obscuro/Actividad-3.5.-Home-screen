<?php include 'conexion.php'; ?>

<html>
<head>
    <title>Aplicación de Registros</title>
</head>
<body>
    <h1>Registros</h1>
    <a href="agregar.php">Agregar Registro</a>
    <br><br>
    <table border="1">
        <tr>
            <th>Nombre:</th>
            <th>Email:</th>
            <th>Teléfono:</th>
            <th>Acciones:</th>
        </tr>
        <?php
        $sql = "SELECT * FROM registros";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["nombre"]."</td>";
                echo "<td>".$row["email"]."</td>";
                echo "<td>".$row["telefono"]."</td>";
                echo "<td><a href='editar.php?id=".$row["id"]."'>Editar</a> | <a href='eliminar.php?id=".$row["id"]."'>Eliminar</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No hay registros</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
