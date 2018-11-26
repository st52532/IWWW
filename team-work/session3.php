<?php
include('config3.php');
session_start();

$user_check = $_SESSION['login_user'];

$ses_sql = mysqli_query($db,"select username from admin where username = '$user_check' ");

$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

$login_session = $row['username'];

if(!isset($_SESSION['login_user'])){
   // header("location:login3.php");
    echo "ntbiotnbintibnty tnbmytnb k bikytbytikhmtm k tmbhoymnbtknb  mrohbmoymn yotmyo5hmboythmomtovbgyoohmtoymhjoum6n oytmnhotynytmnoty";
}
?>