<?php
//först måste man vara  inloggad för att kunna logga ut 
session_start();
session_destroy();
setcookie('email', '', time()-7200);//tar bort den tiden som vi tidigare la in

header("location: login.php");

?>