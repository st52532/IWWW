<script>
    function hlavni() {
        document.getElementById('link').click();
    }
</script>
<?php
$errorFeedbacks = array();
$successFeedback = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['import'])) {

        $brandDao = new BrandRepository(Connection::getPdoInstance());
        $modelDao = new ModelRepository(Connection::getPdoInstance());


        $neco = $_FILES["fileToUpload"]['tmp_name'];
        $retezec = file_get_contents($neco);
        $rozparsovan = json_decode($retezec, true);
        foreach ($rozparsovan as $item) {
            $brandExist = $brandDao->ifExist($item["brand"]);

            if ($brandExist[0] == '1') {
                $idBrand = $brandDao->getIdByName($item["brand"])[0];
                $modelExist = $modelDao->ifExist($item["model"], $idBrand);
                if ($modelExist[0] == '1') {
                } elseif ($modelExist[0] == '0') {
                    $modelDao->insertModel($item["model"], $idBrand);
                }

            } else if ($brandExist[0] == '0') {
                $brandDao->insertBrand($item["brand"]);
                $idBrand = $brandDao->getIdByName($item["brand"])[0];
                $modelDao->insertModel($item["model"], $idBrand);
            }
        }
      echo "Import dokončen";

}

?>
<?php
$errorFeedbacks = array();
$successFeedback = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['export'])) {


    $userDao = new ModelRepository(Connection::getPdoInstance());
    $allUsersResult = $userDao->getAllModel();

    $arr = array();
    foreach ($allUsersResult as $key => $value) {
        array_push($arr, array(
            "brand" => $value["namebrand"],
            "model" => $value["namemodel"]
        ));
    }
    $nazev = 'export2.json';

    $data = json_encode($arr, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
    $myfile = fopen($nazev, "w");
    fwrite($myfile, $data);
    fclose();

    echo '<a id="link" href="http://localhost:63342/IWWW/team-work2/export2.json" download></a>';

    $successFeedback = "Export dokončen";
    echo '<script type="text/javascript">',
    'hlavni();',
    '</script>';

}

?>
<?php
if (!empty($errorFeedbacks)) {
    echo "Form contains following errors:<br>";
    foreach ($errorFeedbacks as $errorFeedback) {
        echo $errorFeedback . "<br>";
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($successFeedback)) {
    echo $successFeedback;
}
?>
<h1>Import</h1>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" name="import" value="Import">
</form>
<h1>Export</h1>
<form method="post">
    <input type="submit" name="export" value="Export">
</form>

