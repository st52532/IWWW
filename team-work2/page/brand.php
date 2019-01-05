<script>
    function hlavni() {
        location.replace("http://localhost:63342/IWWW/team-work2/index.php?page=brand&action=read-all")
    }
</script>
<h1>Značka</h1>
<?php
if ($_GET["action"] == "read-all") {
    echo "<h2>Všechny značky</h2>";
    $userDao = new BrandRepository(Connection::getPdoInstance());
    $allUsersResult = $userDao->getAllBrands();

    $datatable = new DataTable($allUsersResult,"brand-update");
    $datatable->addColumn("idbrand", "ID");
    $datatable->addColumn("name", "Značka");
    $datatable->render();
}
?>

<?php
if ($_GET["action"] == "delete") {
    echo "<h2>Mazu...</h2>";

    $userDao = new BrandRepository(Connection::getPdoInstance());
    $userDao->removeById($_GET["id"]);
    echo '<script type="text/javascript">',
    'hlavni();',
    '</script>'
    ;
}
?>