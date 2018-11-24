<?php
ob_start();
session_start();
include "config.php";
?>
<!DOCTYPE html>
<html lang="cs">
<title>Autobazar Kůlič</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="w3-theme-black.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
	html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif;}
	.w3-sidebar {
		z-index: 3;
		width: 250px;
		top: 43px;
		bottom: 0;
		height: inherit;
	}
</style>
<body>
<nav>
    <a href="<?= BASE_URL; ?>">Home</a>
    <a href="<?= BASE_URL . "?page=blog" ?>">Blog</a>

    <?php if (!empty($_SESSION["user_id"])) { ?>
        <a href="<?= BASE_URL . "?page=users" ?>">Users</a>
        <a href="<?= BASE_URL . "?page=logout" ?>">Logout</a>
    <?php } else { ?>
        <a href="<?= BASE_URL . "?page=login" ?>">Login</a>
    <?php } ?>
</nav>
<?php
include 'navbar.php';
include 'sidebar.php';
?>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main" style="margin-left:250px">

	<div class="radek padding64">
		<div class="tretina w3-container">
			<p class="w3-border w3-padding-large w3-padding-96 w3-center">AD</p>
		</div>
		<div class="dveTretiny w3-container">
			<h1 class="w3-text-teal">Název Model auta</h1>

<table style="width:100%">
  <tr>
    <th>Rok výroby</th>
    <td>2010</td> 
  </tr>
   <tr>
    <th>Palivo</th>
    <td>Benzín</td> 
  </tr> 
  <tr>
    <th>Obsah motoru</th>
    <td>1980</td> 
  </tr>
  <tr>
    <th>Stav tachometru</th>
    <td>54231</td> 
  </tr>
   <tr>
    <th>Převodovka</th>
    <td>Manuální</td> 
  </tr>
   <tr>
    <th>Výkon</th>
    <td>98 kW</td> 
  </tr>
</table>

			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum
				dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
		</div>
	</div>

	<!-- Pagination -->
	<div class="w3-center padding32">
		<div class="w3-bar">
			<a class="w3-button w3-black" href="#">1</a>
			<a class="w3-button w3-hover-black" href="#">2</a>
			<a class="w3-button w3-hover-black" href="#">3</a>
			<a class="w3-button w3-hover-black" href="#">4</a>
			<a class="w3-button w3-hover-black" href="#">5</a>
			<a class="w3-button w3-hover-black" href="#">»</a>
		</div>
	</div>

	<footer id="myFooter">
		<div class="w3-container w3-theme-l2 padding32">
			<h4>Footer</h4>
		</div>

		<div class="w3-container w3-theme-l1">
			<p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
		</div>
	</footer>

	<!-- END MAIN -->
</div>

<script>
    // Get the Sidebar
    var mySidebar = document.getElementById("mySidebar");

    // Get the DIV with overlay effect
    var overlayBg = document.getElementById("myOverlay");

    // Toggle between showing and hiding the sidebar, and add overlay effect
    function w3_open() {
        if (mySidebar.style.display === "block") {
            mySidebar.style.display = "none";
            overlayBg.style.display = "none";
        } else {
            mySidebar.style.display = "block";
            overlayBg.style.display = "block";
        }
    }

    // Close the sidebar with the close button
    function w3_close() {
        mySidebar.style.display = "none";
        overlayBg.style.display = "none";
    }
</script>

</body>
</html>