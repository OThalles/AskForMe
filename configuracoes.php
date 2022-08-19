<?php 
require 'config.php';
require_once('models/Auth.php');
$auth = new Auth($pdo,$base);
$userMe = $auth->checkToken(); 

$explodeBirthDate = explode('-',$userMe->birthdate);
$birthdate = $explodeBirthDate[2].'/'.$explodeBirthDate[1].'/'.$explodeBirthDate[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?=$base?>/assets/css/style.css">
    <title>Configurações</title>
</head>
<body class="site">
<div class="box-header">
        <?php require('./partials/header.php');?>
    </div>
    <?php if(isset($_SESSION['flash'])): ?>
    <div class="warning-container">
        <span style="color:white"><?=$_SESSION['flash'];?></span>
        <?php unset($_SESSION['flash'])?>
    </div>
    <?php endif;?>
<div class="posts-container">

    <div class="infos-user">
    <div class="photo-profile-area">
            <div class="photo">
                <img src="<?=$base?>/media/profile/<?=$userMe->photo?>" id="imgpic">
            </div>  
                <div class="change-photo-button">
                    Mudar avatar
                </div>
            </div>
    </div>

    <div class="config-box">
    <form action="<?=$base?>/configuracoes_action.php" method="POST" enctype="multipart/form-data">
        <div class="general-infos">
        <input id="upload-photo" type="file" name="photo" accept="image/png,image/jpeg,image/jpg">

        <div class="form-title">
        <label for="name">Nome:</label>
        </div>
        <div class="form-config">
        <input required type="text" name="name" value="<?=$userMe->name?>">
        </div>

        <div class="form-title">
        <label for="dsecription">Descrição:</label>
        </div>
        <div class="form-config">
        <input required type="text" name="description" value="<?=$userMe->description?>">
        </div>

        <div required class="form-title">
        <label for="birthdate">Data de nascimento:</label>
        </div>
        <div class="form-config">
        <input required type="text" id="birthdate" name="birthdate" value="<?=$birthdate?>">
        </div>

        </div>


        <div class="credentials-infos">
            <div class="form-title">
            Email:
            </div>
            <div class="form-config">
            <input required type="email" name="email" value="<?=$userMe->email?>">
            </div>

            <div class="form-title">
            Senha:
            </div>
            <div class="form-config">
            <input type="password" name="password">
            </div>

            <div class="form-title">
            Confirmar senha:
            </div>
            <div class="form-config">
            <input type="password" name="confirmpassword">
            </div>


        </div>

        <input type="submit" class="submitinput">
   
    </form>
    <div class="save-button-container">
        <div id="saveinfos">Salvar alterações</div>
    </div>
    </div>

<div class="config-menu-container">
    <ul>
        <li id="info-menu">Informações gerais</li>
        <li id="cred-menu">Credenciais</li>
    </ul>
</div>
</div>
<footer>
    <?php require('./partials/footer.php'); ?>
</footer>
<script src="<?=$base;?>/assets/js/configscript.js"></script>
<script src="https://unpkg.com/imask"></script>
    <script>

            IMask(
                document.getElementById('birthdate'),
                {mask:'00/00/0000'}

            );

    </script>
</body>
</html>