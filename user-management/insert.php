<?php
$datumek = new DateTime();
echo '<html>';
echo '<body>';

echo '<form action="user.php?action=new" method="get">';
echo 'Username: <input type="text" name="username"><br>';
echo 'Password: <input type="password" name="password"><br>';
echo 'Email: <input type="text" name="email"><br>';
echo 'Description: <input type="text" name="description"><br>';
echo 'Created: <input type="text" name="created" value="'.$datumek->format("Y-m-d H:i:s").'"><br>';
echo '<input type="submit">';
echo '</form>';

echo '</body>';
echo '</html>';