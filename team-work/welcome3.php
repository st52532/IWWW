<?php
include('session3.php');
?>
<html">

<head>
    <title>Welcome </title>
</head>

<body>
Welcome <?php echo $login_session;

$sql = "SELECT id, username FROM admin";
$result = mysqli_query($db,$sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Username: " . $row["username"]."<br>";
    }
} else {
    echo "0 results";
}
?>

<h2><a href = "index.php">Index</a></h2>
<h2><a href = "logout3.php">Sign Out</a></h2>
</body>

</html>