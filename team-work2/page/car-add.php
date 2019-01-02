<script>
    function hlavni() {
        location.replace("http://localhost:63342/IWWW/team-work2/index.php?page=car&action=read-all")
    }
</script>
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

            //zacatek
            echo "*****";
            $rnd = rand(0, 99);
            //echo date("yzHis");
            //echo $rnd;
            $folder = date("yzHis") . "" . $rnd;
            $fullPath = "photos/" . $folder . "/";

            //echo $_FILES['uploaded_file'];

            if (!file_exists($fullPath)) {
                mkdir($fullPath, 0777, true);
            }


            $target_dir = $fullPath;
            for ($i = 0; $i < sizeof($_FILES["fileToUpload"]); $i++) {

                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$i]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
                if (isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$i]);
                    if ($check !== false) {
                        echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        echo "File is not an image.";
                        $uploadOk = 0;
                    }
                }
// Check if file already exists
                if (file_exists($target_file)) {
                    echo "Sorry, file already exists.";
                    $uploadOk = 0;
                }
// Check file size
                if ($_FILES["fileToUpload"]["size"][$i] > 500000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
// Allow certain file formats
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif") {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
// Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file)) {
                        echo "The file " . basename($_FILES["fileToUpload"]["name"][$i]) . " has been uploaded.";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            }

            // echo "<img src='".$fullPath .$_FILES["fileToUpload"]["name"]. "' alt='error'>";

            //konec
            //success
            $userDao = new CarRepository(Connection::getPdoInstance());
            $allUsersResult = $userDao->insertCar($_POST["mileage"], $_POST["year"], $_POST["power"], $_POST["gearbox"], $_POST["fuel"], $_POST["color"], $_POST["price"], $_POST["brandmodel"], $_POST["prew"], $folder);


            $successFeedback = "Model byl přidán";
            //echo "<h1>".$_POST["fileToUpload"]."</h1>";
            echo 'Vkladam...';
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
    $userDao = new ModelRepository(Connection::getPdoInstance());
    $allUsersResult = $userDao->getAllModel();

    $datatable = new Dropdown($allUsersResult, "brandmodel");
    $datatable->addColumn("idmodel", "ID");
    $datatable->addColumn("namebrand", "Nazev");
    $datatable->addColumn("namemodel", "Nazev");
    $datatable->render();

    ?>
    Počet km:<br>
    <input type="number" name="mileage" placeholder="Počet km"/>
    Rok výroby:<br>
    <input type="number" name="year" placeholder="Rok výroby"/>
    Výkon v kw:<br>
    <input type="number" name="power" placeholder="Výkon"/>
    Převodovka:<br>
    <select name="gearbox">
        <option value="manuální">Manuální</option>
        <option value="automatická">Automatická</option>
        <option value="poloautomatická">Poloautomatická</option>
    </select>
    Palivo:<br>
    <select name="fuel">
        <option value="benzín">Benzín</option>
        <option value="nafta">Nafta</option>
        <option value="elektřina">Elektřina</option>
        <option value="ethanol">Ethanol</option>
        <option value="hybridní">Hybridní</option>
        <option value="lpg">LPG</option>
        <option value="cng">CNG</option>
        <option value="vodík">Vodík</option>
    </select>

    Barva:<br>
    <input type="text" name="color" placeholder="Barva"/>
    Cena v kč:<br>
    <input type="number" name="price" placeholder="Cena"/>
    Fotografie:
    <!--<input type="file" name="file[]" id="file" accept="image/x-png,image/gif,image/jpg,image/jpeg" multiple>-->
    <input type="file" name="fileToUpload[]" id="fileToUpload" onchange="displayFiles();" multiple>
    <p>Náhled</p>
    <div id="list"></div>
    <input type="submit" value="Nahrát" name="submit">
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

            //pole.innerHTML = file.name;
            //pole.innerHTML = str;
        }
    </script>
    <h2>Vybava</h2>
    <?php
    $userDao = new EquipmentRepository(Connection::getPdoInstance());
    $allUsersResult = $userDao->getAllEquipment();

    $datatable = new JsonEquipment($allUsersResult, "brandmodel");
    $json = json_decode($datatable->get());

    foreach ($json as $item) {
        echo '<input type="checkbox" name="equipment" id=' . $item->idequipment . ' value=' . $item->idequipment . '>';
        echo $item->value . '<br>';
    }


    ?>
    <h2>Specialni vybava</h2>
    <?php
    $userDao = new SpecEquipmentRepository(Connection::getPdoInstance());
    $allUsersResult = $userDao->getAllEquipment();

    $datatable = new JsonSpecEquipment($allUsersResult, "brandmodel");
    $json = json_decode($datatable->get());

    foreach ($json as $item) {
        echo $item->name . '<br>';
        echo '<input type="text"  name="equipment" id=' . $item->idspec_equipment . ' value=' . $item->idspec_equipment . '><br>';
    }


    ?>
</form>