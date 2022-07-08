<?php
require('config.php');
require('models/Auth.php');

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
$birthdate = filter_input(INPUT_POST, 'birthdate');

if($name && $email && $password && $birthdate) {
    $auth = new Auth($pdo, $base);
    
    $birthdate = explode('/', $birthdate);

    if(count($birthdate) != 3) {
        $_SESSION['flash'] = "A data de nascimento é inválida 1";
        header('Location: '.$base.'/signup.php');
        exit;
    }

    $birthdate = $birthdate[2].$birthdate[1].$birthdate[0];
    if(strtotime($birthdate) === false) {
        $_SESSION['flash'] = "A data de nascimento é invalida 2";
        header("Location: signup.php");
        exit;
    } 


     if($auth->EmailExists($email)===false) {
        $auth->registerUser($name, $email, $password, $birthdate);
        header("Location: signup.php");
     } else {
        $_SESSION['flash'] = "Esse e-mail já existe";
        header("Location: signup.php");
     }
}

?>