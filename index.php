<?php
include_once('controller/UserController.php');
$action = basename($_SERVER['REQUEST_URI']);
$controller = new UserController();
$controller->getAction($action);
?>
