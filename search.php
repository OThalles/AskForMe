<?php 
require 'config.php';
require_once('models/Auth.php');
require_once('dao/UserDao.php');
$auth = new Auth($pdo,$base);
$userMe = $auth->checkToken(); 

$name = filter_input(INPUT_GET, 's');

$userDao = new UserDao($pdo);
$foundUsers = $userDao->searchUsers($name);
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
<div class="search-container">
<div class=users_found>
    <?php if($foundUsers): ?>
    <?php foreach($foundUsers as $user): ?>
        <div class="user">
        <div class="photo-finded-user">
        <a href="<?=$base?>/perfil.php?id=<?=$user->id?>"><img src="<?=$base?>/media/profile/<?=$user->photo?>" alt="error"></a>
        </div>
        <div class="user-finded-name">
            <a href="<?=$base?>/perfil.php?id=<?=$user->id?>"><?=$user->name?></a>
        </div>
</div>
<?php endforeach; ?>
    <?php endif; ?>






</div>
</div>
<footer>
    <?php require('./partials/footer.php'); ?>
</footer>
<script src="<?=$base;?>/assets/js/configscript.js"></script>
</body>
</html>