<?php 
require('config.php');
require('models/Auth.php');
$auth = new Auth($pdo, $base);

/**
* Checa se está logado, caso esteja e entre em login.php será direcionado para perfil.php
* @param bool
*/
if($auth->ifLogged()==true) {
    header("Location: ".$base."/perfil.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=$base?>/assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/903ee0eee6.js" crossorigin="anonymous"></script>
    <title>Login</title>
</head>
<body>
<div class="box">
    <header> 

    </header>
    <div class="container-login">
            <div class="design-logo-area">
                <h2 class="title">AskForMe!</h2>
                <h2 class="phrase-keyboard-machine" id="keyboard">Faça e responda perguntas!</h2>
            </div>
            <div class="login-area">
                <div class="box-login">
                    <div class="text-to-form">
                        Acesse sua conta:
                    </div>
                    <?php if(isset($_SESSION['flash'])): ?>
                            <div class="warning" style="color: red"><?=$_SESSION['flash']?></div>
                        <?php unset($_SESSION['flash'])?>
                        <?php endif; ?>
                    <div class="form-area">
                            <form action="<?=$base?>/login_action.php" method="POST" id="form">
                                <input class="email" type="email" name="email" placeholder="Digite seu email">
                                <input type="password" name="password" placeholder="Digite sua senha">
                                <input type="submit" value="Fazer Login">
                            </form>
                    </div>
                    <hr class="division-login-box"/>
                    <div class="sign-up-text">
                        Ainda não tem conta? <a href="<?=$base?>/signup.php">Crie sua conta</a>
                    </div>
                    </div>
                    
            </div>
            
    </div>
</div>
    <script src="<?=$base?>/assets/js/keyboardmachine.js"></script>
</body>
</html>
    