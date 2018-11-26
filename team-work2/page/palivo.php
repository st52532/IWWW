<h1>Palivo</h1>
<?php
if ($_GET["action"] == "read-all") {
    echo "<h2>Všechno palivo</h2>";
    $userDao = new UserRepository(Connection::getPdoInstance());
    $allUsersResult = $userDao->getAllPalivo();

    $datatable = new DataTable($allUsersResult);
    $datatable->addColumn("id", "ID");
    $datatable->addColumn("name", "Nazev");
    $datatable->render();


} else if ($_GET["action"] == "by-email") {
    echo "<h2>Palivo podle emailu</h2>";

    ?>

    <form method="post">
        <input type="text" name="mail" placeholder="insert email address" >
        <input type="submit" value="Find by email">
    </form>

    <?php

    if (!empty($_POST["mail"])) {
        $userDao = new UserRepository(Connection::getPdoInstance());
        $usersByEmail = $userDao->getByEmail($_POST["mail"]);
        $datatable = new DataTable($usersByEmail);
        $datatable->addColumn("id", "ID");
        $datatable->addColumn("email", "Email");
        $datatable->addColumn("created", "Created");
        $datatable->render();
    }
}
?>