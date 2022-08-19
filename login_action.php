<?php
require 'config.php';
require_once('models/Auth.php');
$auth = new Auth($pdo,$base);

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, 'password');

if($email && $password) {
    if($auth->validateLogin($email, $password)) {
        header("Location: ".$base."/index.php");
        exit;
    }
}

$_SESSION['flash'] = 'Email ou senha estão incorretos';
header("Location: ".$base."/login.php");
exit;

?>