<?php
session_start();
require_once('Login.php');


$path = pathinfo($_GET['file']);

unlink($_GET['file']);
header('Location:' . $_GET['location']);

?>