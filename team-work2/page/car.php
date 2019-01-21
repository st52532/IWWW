<script>
    function hlavni() {
        location.replace("http://localhost:63342/IWWW/team-work2/index.php?page=car&action=read-all")
    }
</script>
<h1>Model</h1>
<?php
if ($_GET["action"] == "read-all") {
    echo "<h2>Všechny auta</h2>";
    $userDao = new CarRepository(Connection::getPdoInstance());
    $allUsersResult = $userDao->getAllCars();

    $model="car";
    $datatable = new DataTableCar($allUsersResult,$model);
    $datatable->addColumn("id", "ID");
    $datatable->addColumn("brandname", "Značka");
    $datatable->addColumn("modelname", "Model");
    $datatable->addColumn("mileage", "Počet km");
    $datatable->addColumn("year", "Rok");
    $datatable->addColumn("power", "Výkon");
    $datatable->addColumn("gearbox", "Převodovka");
    $datatable->addColumn("fuel", "Palivo");
    $datatable->addColumn("color", "Barva");
    $datatable->addColumn("price", "Cena");
    $datatable->render();
}
?>

<?php
if ($_GET["action"] == "delete") {
    echo "<h2>Mazu...</h2>";

    $userDao = new CarRepository(Connection::getPdoInstance());
    $userDao->removeById($_GET["id"]);
    echo '<script type="text/javascript">',
    'hlavni();',
    '</script>'
    ;
}
?>
