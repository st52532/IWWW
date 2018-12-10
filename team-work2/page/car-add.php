<script>
    function hlavni() {
        location.replace("http://localhost:63342/IWWW/team-work2/index.php?page=car&action=read-all")
    }
</script>
<form method="post">
    <?php
    $errorFeedbacks = array();
    $successFeedback = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST["brandmodel"])) {
            $feedbackMessage = "Alespoň značka je povinná";
            array_push($errorFeedbacks, $feedbackMessage);
        }

        if (empty($errorFeedbacks)) {
            //success
            $userDao = new CarRepository(Connection::getPdoInstance());
            $allUsersResult = $userDao->insertCar($_POST["mileage"],$_POST["year"],$_POST["power"],$_POST["gearbox"],$_POST["fuel"],$_POST["color"],$_POST["price"],$_POST["brandmodel"]);
            echo $_POST["brandmodel"];
            echo $_POST["mileage"];
            echo $_POST["year"];
            echo $_POST["power"];
            echo $_POST["gearbox"];
            echo $_POST["fuel"];
            echo $_POST["color"];
            echo $_POST["price"];

            $successFeedback = "Model byl přidán";
            echo 'Vkladam...';
            echo '<div class="loader"></div>';
            echo '<script type="text/javascript">',
            'hlavni();',
            '</script>'
            ;
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

    <form method="post">
        Značka a model:<br>
        <?php
        $userDao = new ModelRepository(Connection::getPdoInstance());
        $allUsersResult = $userDao->getAllModel();

        $datatable = new Dropdown($allUsersResult,"brandmodel");
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
            <option value="manual">Manuální</option>
            <option value="automatic">Automatická</option>
            <option value="poloautomatic">Poloautomatická</option>
        </select>
        Palivo:<br>
        <select name="fuel">
            <option value="petrol">Benzín</option>
            <option value="diesel">Nafta</option>
            <option value="electric">Elektřina</option>
            <option value="ethanol">Ethanol</option>
            <option value="hybrid">Hybridní</option>
            <option value="lpg">LPG</option>
            <option value="cng">CNG</option>
            <option value="hydrogen">Vodík</option>
        </select>

        Barva:<br>
        <input type="text" name="color" placeholder="Barva"/>
        Cena v kč:<br>
        <input type="number" name="price" placeholder="Cena"/>
        <input type="submit" name="isSubmitted" value="Vložit">
    </form>