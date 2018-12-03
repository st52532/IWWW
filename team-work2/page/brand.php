<h1>Značka</h1>
<?php
if ($_GET["action"] == "read-all") {
    echo "<h2>Všechny značky</h2>";
    $userDao = new UserRepository(Connection::getPdoInstance());
    $allUsersResult = $userDao->getAllBrands();

    $datatable = new DataTable($allUsersResult);
    $datatable->addColumn("id", "ID");
    $datatable->addColumn("name", "Nazev");
    $datatable->render();


}
?>