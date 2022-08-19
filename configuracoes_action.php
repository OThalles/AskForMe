<?php
require('models/Auth.php');
require_once('config.php');
require_once('dao/UserDao.php');
require_once('helpers/Resize.php');
$auth = new Auth($pdo, $base);
$userMe = $auth->checkToken();

$userDao = new UserDao($pdo);

$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
$birthdate = filter_input(INPUT_POST, 'birthdate');
$email =  filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, 'password');
$confirmPassword = filter_input(INPUT_POST, 'confirmpassword');

$maxquantity = 80;
if($email && $name) {
    if(strlen($name) < $maxquantity) {
        $userMe->name = trim($name);
    } else {
        $_SESSION['flash'] = 'Insira um nome válido';
        header("Location: ".$base."/configuracoes.php");
        exit;
    }
    if($email != $userMe->email) {
        $userMe->email = trim($email);
    }
} else { 
    header("Location: ".$base."/configuracoes.php");
    exit;
}

if(strlen($description) < 350) {
    $userMe->description = trim($description);
} else {
    $_SESSION['flash'] = 'Número de caracteres excedido no campo descrição.';
    header("Location: ".$base."/configuracoes.php");
    exit;
}


$birthdate = explode('/', $birthdate);
if(count($birthdate) != 3) {
    $_SESSION['flash'] = 'Data de nascimento inválida';
    header("Location: ".$base."/configuracoes.php");
    exit;
}

$birthdate = $birthdate[2].'-'.$birthdate[1].'-'.$birthdate[0];
if(strtotime($birthdate) === false) {
    $_SESSION['flash'] = 'Data de nascimento inválida';
    header("Location: ".$base."/configuracoes.php");
    exit;

}
$userMe->birthdate = trim($birthdate);


if($password) {
    $hash = password_verify($password, $userMe->password);
    if($password == $confirmPassword) {
        if($hash==False) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $userMe->password = $hash;
        $_SESSION['token'] = ''; // Desconectar o usuário ao mudar a senha.
        } else {
            $_SESSION['flash'] = 'Você já utiliza essa senha';
        }
    } else {
        $_SESSION['flash'] = 'As senhas não conferem';
    }
}

$receivedPhoto = $_FILES['photo'];

if(isset($receivedPhoto) && !empty($receivedPhoto['tmp_name'])) {
    if(in_array($receivedPhoto['type'], ['image/png', 'image/jpg', 'image/jpeg'])) {
        $hash = md5(time().rand(0,9999)).".jpg";
        $photo = move_uploaded_file($_FILES['photo']['tmp_name'], './media/profile/'.$hash);
        $obResize = new Resize(__DIR__.'\\media\\profile\\'.$hash);
        $obResize->resize(500);
        $obResize->saveImg(__DIR__.'\\media\\profile\\'.$hash, 100);
        $userMe->photo = $hash;
        
    } else {
        $_SESSION['flash'] = 'Formato de imagem não suportado';
        header("Location: ".$base."/configuracoes.php");
        exit;
    }
}

$userDao->update($userMe);
header("Location: ".$base."/configuracoes.php");
exit;




?>