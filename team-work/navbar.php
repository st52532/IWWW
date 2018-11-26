<?php
/**
 * Created by PhpStorm.
 * User: Petr
 * Date: 24.11.2018
 * Time: 14:33
 */
?><div class="w3-top">
	<div class="w3-bar w3-theme w3-top w3-left-align w3-large">
		<a class="w3-bar-item w3-button w3-right w3-hide-large w3-hover-white w3-large w3-theme-l1" href="javascript:void(0)" onclick="w3_open()"><i class="fa fa-bars"></i></a>
		<a href="#" class="w3-bar-item w3-button w3-theme-l1">Autobazar Kůlič</a>
		<a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white">O nás</a>
		<a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Hodnoty</a>
		<a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Novinky</a>
		<a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Kontakt</a>
		<a href="#" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white">Klienti</a>
		<a href="#" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white">Partneři</a>


          <!--  <?php if (!empty($_SESSION["user_id"])) { ?>
                <a href="<?= BASE_URL . "?page=users" ?>" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Moje informace</a>
                <a href="<?= BASE_URL . "?page=logout" ?>" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Odhlásit</a>
            <?php } else { ?>
                <a href="<?= BASE_URL . "?page=login" ?>" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Přihlásit</a>
            <?php } ?>-->
        <?php if (!empty($_SESSION["login_user"])) { ?>
            <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white">Prihlasen jako            <?php echo $login_session;?></a>
            <a href="logout3.php" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white">Odhlásit</a>
        <?php } else { ?>
            <a href="login3.php" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white">Přihlásit</a>
        <?php } ?>

	</div>
</div>