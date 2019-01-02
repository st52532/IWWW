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
    $userDao = new CarRepository(Connection::getPdoInstance());
    $allUsersResult = $userDao->getCarById($_GET["id"]);

    $brandnameValue = $allUsersResult["brandname"];
    $modelnameValue = $allUsersResult["modelname"];
    $folderValue = $allUsersResult["folder"];
    $imageValue = $allUsersResult["image"];
} else { //in case of any error, load data
    $nameValue = $_POST["name"];
}
?>
<div class="detail">
    <h1><?= $brandnameValue?> <?= $modelnameValue?></h1>
    <div class="galerie">
<?php
$files = glob("photos/".$folderValue."/*.*");

for ($i=0; $i<count($files); $i++)

{

    $image = $files[$i];
    if($i==0) {
        echo '<div class="velky">';
        echo '<img src="' . $image . '" alt="Gallery #2" />';
        echo '</div>';
    }
    else{
        echo '<div class="maly">';
        echo '<img src="' . $image . '" alt="Gallery #2" />';
        echo '</div>';
    }
}
?>
    </div>
    <h2>Rezervace</h2>
    <form action="/action_page.php" method="get">
        Jméno a příjmení: <input type="text" name="name"><br>
        Email: <input type="email" name="email"><br>
        Telefon: <input type="tel" name="tel"><br>
        <input type="submit" value="Rezervovat">
    </form>
</div>