<h1>Palivo</h1>
<?php
if ($_GET["action"] == "read-all") {
    echo "<h2>Všechno palivo</h2>";
    $userDao = new UserRepository(Connection::getPdoInstance());
    $allUsersResult = $userDao->getAllFuel();

    $datatable = new DataTable($allUsersResult);
    $datatable->addColumn("idfuel", "ID");
    $datatable->addColumn("name", "Nazev");
    $datatable->render();


}