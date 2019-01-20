<script>
    function hlavni() {
        location.replace("http://localhost:63342/IWWW/team-work2/index.php?page=model&action=read-all")
    }
</script>
<form method="post">
    <?php
    $errorFeedbacks = array();
    $successFeedback = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST["email"])) {
            $feedbackMessage = "Alespoň email je povinná";
            array_push($errorFeedbacks, $feedbackMessage);
        }

        if (empty($errorFeedbacks)) {


            // Usage 2:
            $options = [
                'cost' => 11
            ];
            $heslo = password_hash($_POST["password"], PASSWORD_BCRYPT, $options);

            $userDao = new UserRepository(Connection::getPdoInstance());
            $allUsersResult = $userDao->insertUser($_POST["email"],$_POST["username"],$heslo,$_POST["description"],$_POST["role"]);
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

        // Usage 2:
        $options = [
        'cost' => 11
        ];
        echo password_hash('rasmuslerdorf', PASSWORD_BCRYPT, $options)."\n";
        // $2y$11$6DP.V0nO7YI3iSki4qog6OQI5eiO6Jnjsqg7vdnb.JgGIsxniOn4C
        // See the password_hash() example to see where this came from.
        $hash = '$2y$11$5JuKTmNEJ9mvxc4j9tl12OlpNFy5gnLUDZ/geakncYYeoClavkiY2';

        if (password_verify('rasmuslerdorf', $hash)) {
        echo 'Password is valid!';
        } else {
        echo 'Invalid password.';
        }

        Email:<br>
        <input type="email" name="email" placeholder="Email"/>
        Uživatelské jméno:<br>
        <input type="text" name="username" placeholder="Uživatelské jméno"/>
        Heslo:<br>
        <input type="password" name="password" placeholder="Heslo"/>
        Popisek:<br>
        <input type="text" name="description" placeholder="Popisek"/>
        Role:<br>
        <select name="role">
            <option value="admin">Admin</option>
            <option value="sale">Prodej</option>
            <option value="reservation">Rezervace</option>
        </select>
        <input type="submit" name="isSubmitted" value="Vložit">
</form>