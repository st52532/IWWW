<?php
/**
 * Created by PhpStorm.
 * User: Petr
 * Date: 29.10.2018
 * Time: 8:07
 */

include 'config.php';

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Pripojeni selhalo: " . $conn->connect_error);
}
echo "Uspesne pripojeno";

$sql = "SELECT id, username, password,email,description,created FROM user";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    echo '<table style="border:1px #00830a solid">';
    echo '<tr><th>ID</th><th>USERNAME</th><th>PASSWORD</th><th>EMAIL</th><th>DESCRIPTION</th><th>CREATED</th><th>UPDATE</th><th>DELETE</th></tr>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>';
        echo $row["id"];
        echo '</td>';
        echo '<td>';
        echo $row["username"];
        echo '</td>';
        echo '<td>';
        echo $row["password"];
        echo '</td>';
        echo '<td>';
        echo $row["email"];
        echo '</td>';
        echo '<td>';
        echo $row["description"];
        echo '</td>';
        echo '<td>';
        echo $row["created"];
        echo '</td>';
        echo'<td><button type="button">Update</button></td>';
        echo'<td><button type="button">Delete</button></td>';
        echo '</tr>';
    }
} else {
    echo "0 vysledku";
}
$conn->close();