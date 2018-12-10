<?php
$errorFeedbacks = array();
$successFeedback = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //todo more validation rules
    if (empty($_POST["name"])) {
        $feedbackMessage = "name is required";
        array_push($errorFeedbacks, $feedbackMessage);
    }

    if (empty($errorFeedbacks)) {
        //success
        $neco = $_POST["name"];

        $userDao = new BrandRepository(Connection::getPdoInstance());
        $allUsersResult = $userDao->insertBrand( $_POST["name"]);
        $successFeedback = "Značka byla přidána";
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
    <input type="text" name="name" placeholder="Značka"/>
    <input type="submit" name="isSubmitted" value="Vložit">
</form>