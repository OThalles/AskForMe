<?php
require('config.php');
require('models/Auth.php');

$name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
$password = filter_input(INPUT_POST, 'password');
$birthdate = filter_input(INPUT_POST, 'birthdate');

if($name && $email && $password && $birthdate) {
    $auth = new Auth($pdo, $base);
    
    $birthdate = explode('/', $birthdate);

    if(count($birthdate) != 3) {
        $_SESSION['flash'] = "A data de nascimento é inválida";
        header('Location: '.$base.'/signup.php');
        exit;
    }

    $birthdate = $birthdate[2].$birthdate[1].$birthdate[0];
    if(strtotime($birthdate) === false) {
        $_SESSION['flash'] = "A data de nascimento é invalida";
        header("Location: signup.php");
        exit;
    } 


     if($auth->EmailExists($email)===false) {
        $auth->registerUser($name, $email, $password, $birthdate);
        $_SESSION['flash'] = 'Sua conta foi criada, pode fazer login';
        header("Location: login.php");
        exit;
     } else {
        $_SESSION['flash'] = "Esse e-mail já existe";
        header("Location: signup.php");
        exit;
     }
}

?>