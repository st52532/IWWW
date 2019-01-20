<script>
    function hlavni() {
        location.replace("http://localhost:63342/IWWW/team-work2/index.php?page=reservation&action=read-all")
    }
</script>
<h1>Rezervace</h1>
<?php
if ($_GET["action"] == "read-all") {
    echo "<h2>Všechny rezervace</h2>";
    $reservationDao = new ReservationRepository(Connection::getPdoInstance());
    $allReservationResult = $reservationDao->getAllReservations();

    $model="reservation";
    $datatable = new DataTableReservation($allReservationResult,$model);
    $datatable->addColumn("idreservation", "ID");
    $datatable->addColumn("name_surname", "Jméno a příjmení");
    $datatable->addColumn("email", "Email");
    $datatable->addColumn("phone", "Telefon");
    $datatable->addColumn("carid", "ID auta");
    $datatable->addColumn("brandname", "Značka");
    $datatable->addColumn("modelname", "Model");
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
