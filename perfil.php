<?php 
require_once('config.php');
require_once('models/Auth.php');
require_once('dao/UserDao.php');
require_once('dao/postDao.php');
$auth = new Auth($pdo, $base);
$userMe = $auth->checkToken(); 

$id = filter_input(INPUT_GET, 'id');

$UserDao = new UserDao($pdo);
$PostDao = new postDao($pdo);
if(!$id) { 
    $id = $userMe->id;
}

$user = $UserDao->getUserById($id);
$posts = $PostDao->getPostsProfile($id);


if(!$user) {
    header("Location: ".$base."/perfil.php?id=".$userMe->id);
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=$base?>/assets/css/style.css">
    <script src="https://kit.fontawesome.com/903ee0eee6.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Início</title>
</head>
<body class="site">

    <div class="box-header">
        <?php require('./partials/header.php');?>
    </div>

    <div class="insert-comment-container">
        <?php require('./partials/insert-comment.php'); ?>
    </div>

<div class="posts-container">
    <?php require('./partials/photo-profile-area.php'); ?>
    <div class="posts-area">
        <?php foreach($posts as $item): ?>

            <?php require('./partials/posts.php'); ?>

        <?php endforeach; ?>
    </div>
    <?php require('./partials/recommended-users.php'); ?>

</div>


<footer>
    <?php require('./partials/footer.php'); ?>
</footer>

</body>
</html>