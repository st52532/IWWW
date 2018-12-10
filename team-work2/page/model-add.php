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
        if (empty($_POST["brand"])) {
            $feedbackMessage = "Alespoň značka je povinná";
            array_push($errorFeedbacks, $feedbackMessage);
        }

        if (empty($errorFeedbacks)) {
            //success
            $userDao = new ModelRepository(Connection::getPdoInstance());
            $allUsersResult = $userDao->insertModel( $_POST["name"],$_POST["brand"]);

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
        Značka:<br>
        <?php
        $userDao = new BrandRepository(Connection::getPdoInstance());
        $allUsersResult = $userDao->getAllBrands();

        $datatable = new Dropdown($allUsersResult,"brand");
        $datatable->addColumn("idbrand", "ID");
        $datatable->addColumn("name", "Nazev");
        $datatable->render();

        ?>
        Model:<br>
        <input type="text" name="name" placeholder="Model"/>
        <input type="submit" name="isSubmitted" value="Vložit">
</form>