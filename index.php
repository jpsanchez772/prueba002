<?php
$conn = mysqli_connect("BD_ENTREGA_1:3306", "root", "123456789", "usuarios");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Verificar si se ha seleccionado el campo "ID_USUARIO"
if (isset($_GET['campo']) && $_GET['campo'] === 'ID_USUARIO') {
    $query = "SELECT ID_USUARIO, NOMBRE, APELLIDOS FROM CLIENTES WHERE ID_USUARIO = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $_GET['valor']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    $query = "SELECT ID_USUARIO, NOMBRE, APELLIDOS FROM CLIENTES";
    $result = mysqli_query($conn, $query);
}

if (mysqli_num_rows($result) > 0) {
    echo '<!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=1, initial-scale=1.0">
        <title>Resultados de la consulta</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f2f2f2;
                margin: 0;
                padding: 20px;
            }

            h1 {
                color: #333;
                text-align: center;
            }

            table {
                border-collapse: collapse;
                width: 100%;
                background-color: #fff;
                margin-top: 20px;
            }

            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }

            th {
                background-color: #f2f2f2;
            }

            /* Estilos adicionales para la tabla */
            tr:nth-child(even) {
                background-color: #f9f9f9;
            }

            tr:hover {
                background-color: #ebebeb;
            }
        </style>
    </head>

    <body>
        <h1>Resultados de la consulta</h1>
        <table>
            <thead>
                <tr>
                    <th>ID_USUARIO</th>
                    <th>NOMBRE</th>
                    <th>APELLIDOS</th>
                </tr>
            </thead>
            <tbody>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>
                <td>' . $row["ID_USUARIO"] . '</td>
                <td>' . $row["NOMBRE"] . '</td>
                <td>' . $row["APELLIDOS"] . '</td>
            </tr>';
    }

    echo '</tbody>
        </table>
    </body>

    </html>';
} else {
    echo "No se encontraron resultados.";
}

mysqli_close($conn);
?>