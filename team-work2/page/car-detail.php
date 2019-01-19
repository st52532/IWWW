<script>
    function hlavni() {
        // location.replace("http://localhost:63342/IWWW/team-work2/index.php?page=brand&action=read-all")
    }
</script>
<?php
$errorFeedbacks = array();
$successFeedback = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["tel"])) {
    if (isset($_POST['submit'])) {
        $feedbackMessage = "name is required";
        array_push($errorFeedbacks, $feedbackMessage);
    }

    if (empty($errorFeedbacks)) {
        //success

        $userDao = new ReservationRepository(Connection::getPdoInstance());
        $userDao->insertReservation($_POST["id"], $_POST["name"], $_POST["email"], $_POST["tel"]);
        $successFeedback = "Zarezervovano";
        echo '<script type="text/javascript">',
        'hlavni();',
        '</script>';
    }
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

<?php
if (empty($errorFeedbacks)) { //load data origin data from database
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
} else { //in case of any error, load data
    $nameValue = $_POST["name"];
}
?>
<div class="detail">
    <h1><?= $brandnameValue ?> <?= $modelnameValue ?></h1>
    <div class="galerie">
        <?php
        $files = glob("photos/" . $folderValue . "/*.*");

        for ($i = 0; $i < count($files); $i++) {

            $image = $files[$i];
            if ($i == 0) {
                echo '<div class="velky">';
                echo '<img src="' . $image . '" alt="Gallery #2" />';
                echo '</div>';
            } else {
                echo '<div class="maly">';
                echo '<img src="' . $image . '" alt="Gallery #2" />';
                echo '</div>';
            }
        }
        ?>

    </div>
    <h3>Informace o voze</h3>
    <table class="specEquip">
        <tr><th>Cena: </th><td><b><?= $priceValue ?> Kč</b></td></tr>
        <tr><th>Tachometr: </th><td><?= $mileageValue ?> km</td></tr>
        <tr><th>Rok: </th><td><?= $yearValue ?></td></tr>
        <tr><th>Výkon: </th><td><?= $powerValue ?> kw</td></tr>
        <tr><th>Převodovka: </th><td><?= $gearboxValue ?></td></tr>
        <tr><th>Palivo: </th><td><?= $fuelValue ?></td></tr>
        <tr><th>Barva: </th><td><?= $colorValue ?></td></tr>
        <tr><th>Datum vložení: </th><td><?= $date2[2] ?>.<?= $date2[1] ?>.<?= $date2[0] ?></td></tr>
    </table>
    <h3>Výbava</h3>
    <?php
    $equipDao = new EquipmentRepository(Connection::getPdoInstance());
    $allCarsResul = $equipDao->getEquipmentById($_GET["id"]);

    echo "<ul class='equipment'>";
    foreach ($allCarsResul as $value) {
        echo "<li>" . $value[0] . "</li>";
    }
    echo "</ul>";

    ?>
    <h3>Specifikace vozu</h3>
    <?php
    $equipDao = new SpecEquipmentRepository(Connection::getPdoInstance());
    $allCarsResul = $equipDao->getEquipmentById($_GET["id"]);

    echo "<table class='specEquip'>";
    foreach ($allCarsResul as $value) {
        echo "<tr><th>" . $value[0] ."</th><td>" . $value[2] ."</td></tr>";
    }
    echo "</table>";

    ?>
    <div class="reservation">
    <h2>Rezervace</h2>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $_GET["id"] ?>">
        Jméno a příjmení: <input type="text" name="name" value=""><br>
        Email: <input type="email" name="email" value=""><br>
        Telefon: <input type="tel" name="tel" value=""><br>
        <input type="submit" value="Rezervovat">
    </form>
    </div>
</div>