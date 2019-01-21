<script>
    function hlavni() {
        location.replace("http://localhost:63342/IWWW/team-work2/index.php?page=model&action=read-all")
    }
</script>
<?php
$reservationDao = new UserRepository(Connection::getPdoInstance());
$carResult = $reservationDao->getById($_GET["id"]);

$emailValue = $carResult["email"];
$usernameValue = $carResult["username"];
$passwordValue = $carResult["password"];
$descriptionValue = $carResult["description"];
$roleValue = $carResult["role"];
?>
<form method="post">

    <?php
    $errorFeedbacks = array();
    $successFeedback = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST["password"])) {
            $feedbackMessage = "Heslo je povinne";
            array_push($errorFeedbacks, $feedbackMessage);
        }

        if (empty($errorFeedbacks)) {


            // Usage 2:
            $options = [
                'cost' => 11
            ];
            $heslo = password_hash($_POST["password"], PASSWORD_BCRYPT, $options);

            $userDao = new UserRepository(Connection::getPdoInstance());
            $allUsersResult = $userDao->updateUser($_POST["email"],$_POST["username"],$heslo,$_POST["description"],$_POST["role"], $_POST["id"]);
          //  (:email,:username,:password,:description,:role)");

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
        Email:<br>
        <input type="email" name="email" value='<?=$emailValue ?>' placeholder="Email"/>
        Uživatelské jméno:<br>
        <input type="text" name="username" value='<?php echo $usernameValue ?>' placeholder="Uživatelské jméno"/>
        Heslo:<br>
        <input type="password" name="password" placeholder="Heslo"/>
        Popisek:<br>
        <input type="text" name="description" value=' <?php echo $descriptionValue?>' placeholder="Popisek"/>
        Role:<br>
        <select name="role">
            <option value="admin">Admin</option>
            <option value="sale">Prodej</option>
            <option value="reservation">Rezervace</option>
        </select>
        <script>
            var ddlArray = new Array();
            var ddl = document.getElementsByName('role');
            var pole = ddl[0];
            for (i = 0; i < pole.options.length; i++) {
                if (pole.options[i].value == "<?php echo $roleValue?>") {
                    pole.options[i].selected = 'selected';
                }
            }
        </script>
        <input type="hidden" name="id" value="<?php echo $_GET["id"]?>">
        <input type="submit" name="isSubmitted" value="Vložit">
</form>