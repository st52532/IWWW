<script>
    function hlavni() {
        location.replace("http://localhost:63342/IWWW/team-work2/index.php?page=reservation&action=read-all")
    }
</script>
<h1>Prodej</h1>
<?php
if ($_GET["action"] == "read-all") {
    echo "<h2>Všechen prodej</h2>";
    $reservationDao = new SaleRepository(Connection::getPdoInstance());
    $allReservationResult = $reservationDao->getAllSale();
//idsale,c.idcar as carid,b.name as brandname, m.name as modelname
    $model="reservation";
    $datatable = new DataTableSale($allReservationResult,$model);
    $datatable->addColumn("idsale", "ID");
    $datatable->addColumn("carid", "ID Auta");
    $datatable->addColumn("brandname", "Značka");
    $datatable->addColumn("modelname", "Model");
    $datatable->addColumn("price", "Cena v Kč");
    $datatable->render();
}
?>

<?php
if ($_GET["action"] == "delete") {
    echo "<h2>Mazu...</h2>";

    $reservationDao = new ReservationRepository(Connection::getPdoInstance());
    $reservationDao->removeById($_GET["id"]);
    echo '<script type="text/javascript">',
    'hlavni();',
    '</script>'
    ;
}
?>
