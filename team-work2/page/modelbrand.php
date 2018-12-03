<h1>Model Značka</h1>
<?php
if ($_GET["action"] == "read-all") {
    echo "<h2>Všechny modely a značky</h2>";
    $userDao = new UserRepository(Connection::getPdoInstance());
    $allUsersResult = $userDao->getAllModelAndBrands();

    $datatable = new DataTable($allUsersResult);
    $datatable->addColumn("id", "ID");
    $datatable->addColumn("brand", "Značka");
    $datatable->addColumn("model", "Model");
    $datatable->render();


}
?>