<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include_once('controller/UserController.php');
$action = basename($_SERVER['REQUEST_URI']);
$controller = new UserController();
$controller->getAction($action);
?>
