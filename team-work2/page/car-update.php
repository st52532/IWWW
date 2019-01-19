<script>
    function hlavni() {
        // location.replace("http://localhost:63342/IWWW/team-work2/index.php?page=car&action=read-all")
    }
</script>
<?php
$reservationDao = new CarRepository(Connection::getPdoInstance());
$carResult = $reservationDao->getCarById($_GET["id"]);

$brandnameValue = $carResult["brandname"];
$modelnameValue = $carResult["modelname"];
$folderValue = $carResult["folder"];
$imageValue = $carResult["image"];
$yearValue = $carResult["year"];
$mileageValue = $carResult["mileage"];
$powerValue = $carResult["power"];
$gearboxValue = $carResult["gearbox"];
$fuelValue = $carResult["fuel"];
$colorValue = $carResult["color"];
$priceValue = $carResult["price"];
$date1 = explode(" ", $carResult["date"]);
$date2 = explode("-", $date1[0]);
$brandId = $carResult["idbrand"];
?>
<form enctype="multipart/form-data" method="POST">
    <?php
    $errors = array();
    $successFeedback = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST["brandmodel"])) {
            $feedbackMessage = "Alespoň značka je povinná";
            array_push($errors, $feedbackMessage);
        }


        if (empty($errors)) {

            $carDao = new CarRepository(Connection::getPdoInstance());
            $carDao->updateCar($_POST["mileage"], $_POST["year"], $_POST["power"], $_POST["gearbox"], $_POST["fuel"], $_POST["color"], $_POST["price"], $_POST["brandmodel"], $_POST["idcar"]);

            $lastIndex = $_POST["idcar2"];

            $equipDao = new EquipmentRepository(Connection::getPdoInstance());
            $equipDao->delete($lastIndex);
            foreach ($_POST["equipment"] as $key => $data) {
                if (is_array($data)) {
                    displayRecursiveResults($data);
                } elseif (is_object($data)) {
                    displayRecursiveResults($data);
                } else {
                    $equipDao->insertCarEquipment($key, $lastIndex);
                }
            }


            $equipDao2 = new SpecEquipmentRepository(Connection::getPdoInstance());
            $equipDao2->delete($lastIndex);
            foreach ($_POST["specEquipment"] as $key => $data) {
                if (is_array($data)) {
                    displayRecursiveResults($data);
                } elseif (is_object($data)) {
                    displayRecursiveResults($data);
                } else {
                    if (!empty($data)) {
                        echo "SpecialEquip IDCar:" . $lastIndex . " IDSpecialEquip: " . $key . " Data: " . $data . "<br />";
                        $equipDao2->insertEquipment($lastIndex, $key, $data);
                    }
                }
            }

            $successFeedback = "Model byl upraven<br>";
            echo '<div class="loader"></div>';
            echo '<script type="text/javascript">',
            'hlavni();',
            '</script>';
        }
    }

    ?>

    <?php
    if (!empty($errors)) {
        echo "Form contains following errors:<br>";
        foreach ($errors as $errorFeedback) {
            echo $errorFeedback . "<br>";
        }
    } else if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($successFeedback)) {
        echo $successFeedback;
    }
    ?>


    Značka a model:<br>
    <?php
    $carDao = new ModelRepository(Connection::getPdoInstance());
    $allEquipResult = $carDao->getAllModel();

    $datatable = new Dropdown($allEquipResult, "brandmodel");
    $datatable->addColumn("idmodel", "ID");
    $datatable->addColumn("namebrand", "Nazev");
    $datatable->addColumn("namemodel", "Nazev");
    $datatable->render();

    ?>
    <script>
        var ddlArray = new Array();
        var ddl = document.getElementsByName('brandmodel');
        var pole = ddl[0];
        for (i = 0; i < pole.options.length; i++) {
            if (pole.options[i].value == "<?php echo $brandId?>") {
                pole.options[i].selected = 'selected';
            }
        }
    </script>
    Počet km:<br>
    <input type="number" name="mileage" value=<?php echo $mileageValue ?> placeholder="Počet km"/>
    Rok výroby:<br>
    <input type="number" name="year" value=<?php echo $yearValue ?> placeholder="Rok výroby"/>
    Výkon v kw:<br>
    <input type="number" name="power" value=<?php echo $powerValue ?> placeholder="Výkon"/>
    Převodovka:<br>
    <select name="gearbox">
        <option value="Manuální">Manuální</option>
        <option value="Automatická">Automatická</option>
        <option value="Poloautomatická">Poloautomatická</option>
    </select>
    <script>
        var ddlArray = new Array();
        var ddl = document.getElementsByName('gearbox');
        var pole = ddl[0];
        for (i = 0; i < pole.options.length; i++) {
            if (pole.options[i].value == "<?php echo $gearboxValue?>") {
                pole.options[i].selected = 'selected';
            }
        }
    </script>
    Palivo:<br>
    <select name="fuel">
        <option value="Benzín">Benzín</option>
        <option value="Nafta">Nafta</option>
        <option value="Elektřina">Elektřina</option>
        <option value="Ethanol">Ethanol</option>
        <option value="Hybridní">Hybridní</option>
        <option value="LPG">LPG</option>
        <option value="CNG">CNG</option>
        <option value="Vodík">Vodík</option>
    </select>
    <script>
        var ddlArray = new Array();
        var ddl = document.getElementsByName('fuel');
        var pole = ddl[0];
        for (i = 0; i < pole.options.length; i++) {
            if (pole.options[i].value == "<?php echo $fuelValue?>") {
                pole.options[i].selected = 'selected';
            }
        }
    </script>

    Barva:<br>
    <input type="text" name="color" value=<?php echo $colorValue ?> placeholder="Barva"/>
    Cena v kč:<br>
    <input type="number" name="price" value=<?php echo $priceValue ?> placeholder="Cena"/>
    <!--Fotografie:
    <input type="file" name="fileToUpload[]" id="fileToUpload" onchange="displayFiles();" multiple>
    <p>Náhled</p>
    <div id="list"></div>
    <script>
        var files = document.getElementById("fileToUpload");

        function displayFiles() {
            var list = document.getElementById("list");
            list.innerHTML = "";
            var records = files.files.length;
            var str = "";
            for (i = 0; i < records; i++) {
                var file = files.files[i];

                var node = document.createElement("input");
                node.setAttribute("type", "radio");
                node.setAttribute("name", "prew");
                node.setAttribute("value", file.name);
                list.appendChild(node);

                var text = document.createTextNode(file.name);
                list.appendChild(text);
            }
        }
    </script>-->
    <h2>Vybava</h2>
    <?php
    $equipDao = new EquipmentRepository(Connection::getPdoInstance());
    $allEquipResult = $equipDao->getAllEquipment();

    $datatable = new JsonEquipment($allEquipResult, "brandmodel");
    $json = json_decode($datatable->get());

    $vysledek = $equipDao->getEquipmentById($_GET["id"]);

    foreach ($json as $item) {
        echo '<input type="checkbox" name="equipment[' . $item->idequipment . ']" id=' . $item->idequipment . ' value=' . $item->idequipment;
        $index = $item->idequipment;
        foreach ($vysledek as $item2) {
            if ($index == $item2[1]) {
                echo " checked";
            }
        }
        echo '>';
        echo $item->value . '<br>';
    }
    ?>
    <h2>Specialni vybava</h2>
    <?php
    $carDao = new SpecEquipmentRepository(Connection::getPdoInstance());
    $allEquipResult = $carDao->getAllEquipment();

    $datatable = new JsonSpecEquipment($allEquipResult, "brandmodel");
    $json = json_decode($datatable->get());

    $vysledek = $carDao->getEquipmentById($_GET["id"]);

    foreach ($json as $item) {
        echo $item->name . '<br>';
        echo '<input type="text"  name="specEquipment[' . $item->idspecific_equipment . ']" id=' . $item->idspecific_equipment;

        $index = $item->idspecific_equipment;

        foreach ($vysledek as $item2) {
            if ($index == $item2[1]) {
                echo " value=" . $item2[2];
            }
        }
        echo "><br>";

    }


    ?>
    <input type="hidden" name="idcar2" value="<?php echo $_GET["id"]?>">
    <input type="submit" value="Nahrát" name="submit">
</form>