<?php
require('dao/postDao.php');
require('config.php');
require('models/Auth.php');
$auth = new Auth($pdo, $base);
$userMe = $auth->checkToken();


$id = filter_input(INPUT_GET, 'id');
$body = filter_input(INPUT_POST, 'body');

if($id && $body) {
    if(!empty($id) && !empty($body)) {
        $postDao = new Post();
        $postDao->user_to = $id;
        $postDao->user_from = $userMe->id;
        $postDao->body = $body;
        $postDao->sended_date = date('Y-m-d H:i:s');
        $newPost = new postDao($pdo);
        $newPost->sendPostToUser($postDao);
        header("Location: ".$base."/perfil.php?id=".$id);
    }
}




?>