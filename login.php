<?php 
require('config.php');

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
    <title>Login Page</title>
</head>
<body>
<div class="box">
    <header> 

    </header>
    <div class="container-login">
            <div class="design-logo-area">

            </div>
            <div class="login-area">
                <div class="box-login">
                    <div class="text-to-form">
                        Acesse sua conta:
                    </div>
                    <?php if(isset($_SESSION['flash'])): ?>
                            <div><?=$_SESSION['flash']?></div>
                        <?php unset($_SESSION['flash'])?>
                        <?php endif; ?>
                    <div class="form-area">
                            <form action="<?=$base?>/login_action.php" method="POST" id="form">
                                <input type="email" name="email" placeholder="Digite seu email">
                                <input type="password" name="password" placeholder="Digite sua senha">
                                <input type="submit">
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
</body>
</html>