<script>
    function hlavni() {
        location.replace("http://localhost:63342/IWWW/team-work2/index.php?page=brand&action=read-all")
    }
</script>
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

        echo $_POST["name"];
        echo $_POST["id"];

        $userDao = new BrandRepository(Connection::getPdoInstance());
        $userDao->update($_POST["id"],$_POST["name"]);
        $successFeedback = "Značka byla updat";
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

<?php
if (empty($errorFeedbacks)) { //load data origin data from database
    $userDao = new BrandRepository(Connection::getPdoInstance());
    $allUsersResult = $userDao->getBrandById($_GET["id"]);
    //echo array_values($all);
    print_r($allUsersResult);
    echo "<h2>".$allUsersResult["name"]."</h2>";

    $nameValue = $allUsersResult["name"];
} else { //in case of any error, load data
    $nameValue = $_POST["name"];
}
?>

<form method="post">
    <input type="hidden" name="id" value="<?= $_GET["id"]; ?>">
    <input type="text" name="name" placeholder="Značka" value="<?= $nameValue?>"/>
    <input type="submit" name="isSubmitted" value="Vložit">
</form>