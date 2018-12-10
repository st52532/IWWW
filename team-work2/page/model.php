<script>
    function hlavni() {
        location.replace("http://localhost:63342/IWWW/team-work2/index.php?page=model&action=read-all")
    }
</script>
<h1>Model</h1>
<?php
if ($_GET["action"] == "read-all") {
    echo "<h2>Všechny modely</h2>";
    $userDao = new ModelRepository(Connection::getPdoInstance());
    $allUsersResult = $userDao->getAllModel();

    $model="model";
    $datatable = new DataTable($allUsersResult,$model);
    $datatable->addColumn("idmodel", "ID");
    $datatable->addColumn("namebrand", "Značka");
    $datatable->addColumn("namemodel", "Model");
    $datatable->render();
}
?>

<?php
if ($_GET["action"] == "delete") {
    echo "<h2>Mazu...</h2>";

    $userDao = new ModelRepository(Connection::getPdoInstance());
    $userDao->removeById($_GET["id"]);
    echo '<script type="text/javascript">',
    'hlavni();',
    '</script>'
    ;
}
?>
