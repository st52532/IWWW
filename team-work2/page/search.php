<?php
$errorFeedbacks = array();
$successFeedback = "";

 if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (empty($_GET["brand"])) {
        $feedbackMessage = "Alespoň značka je povinná";
        array_push($errorFeedbacks, $feedbackMessage);
    }

    if (empty($errorFeedbacks)) {
        $yearFromValue = "";
        $yearToValue = "";
        $mileageFromValue = "";
        $mileageToValue = "";
        $priceFromValue = "";
        $priceToValue = "";
        $idBrandValue = "";
        $idModelValue = "";

        if (empty($_GET["brand"]) == true) {
            $idBrandValue = "'%'";
        } else {
            $idBrandValue = $_GET["brand"];
        }

        if ($_GET["model"] == "0") {
            $idModelValue = "%";
        } else {
            $idModelValue = $_GET["model"];
        }

        if (empty($_GET["yearfrom"]) == true) {
            $yearFromValue = "1970";
        } else {
            $yearFromValue = $_GET["yearfrom"];
        }

        if (empty($_GET["yearto"]) == true) {
            $yearToValue = date("Y");
        } else {
            $yearToValue = $_GET["yearto"];
        }

        if (empty($_GET["mileagefrom"]) == true) {
            $mileageFromValue = 0;
        } else {
            $mileageFromValue = $_GET["mileagefrom"];
        }

        if (empty($_GET["mileageto"]) == true) {
            $mileageToValue = 9999999;
        } else {
            $mileageToValue = $_GET["mileageto"];
        }

        if (empty($_GET["pricefrom"]) == true) {
            $priceFromValue = 0;
        } else {
            $priceFromValue = $_GET["pricefrom"];
        }

        if (empty($_GET["priceto"]) == true) {
            $priceToValue = 9999999;
        } else {
            $priceToValue = $_GET["priceto"];
        }

        echo "<h1>Výsledek vyhledávání</h1>";

        $userDao = new CarRepository(Connection::getPdoInstance());
        $allCarsResult = $userDao->getCarByParameter($idBrandValue, $idModelValue, $yearFromValue, $yearToValue, $mileageFromValue, $mileageToValue, $priceFromValue, $priceToValue);

        $carItems = new CarItem($allCarsResult);
        $carItems->render();

    }
}

?>