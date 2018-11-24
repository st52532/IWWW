<h1>Users</h1>>
<?php
if($_GET["action"]=="read-all"){
    echo "<h2>All users</h2>";
    $userDao = new UserDao(Connection::getPdoInstance());
    $allUsersResult=$userDao->getAllUsers();

    $dataTable = new DataTable($allUsersResult);
    $dataTable->addColumn("id","ID");
    $dataTable->addColumn("email","Email");
    $dataTable->addColumn("created","Created");
    $dataTable->render();

}

else if($_GET["action"]=="by-email"){
    //TODO
}