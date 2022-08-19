<?php
require_once('config.php');
require_once('dao/postlikesDao.php');
require('models/Auth.php');
$auth = new Auth($pdo, $base);
$userMe = $auth->checkToken();


$post_id = filter_input(INPUT_POST, 'post_id');

if(!empty($post_id)) {
    $return = [];

    $newPostLike = new Postlike();
    $newPostLike->user_id = $userMe->id;
    $newPostLike->post_id = intval($post_id);
    $postLikeDao = new PostLikesDao($pdo);
    $postLikeDao->insertLike($newPostLike);

    $return = [
        'newclass' => ''

    ];
    

}

header("Content-type: application/json");
echo json_encode($return);

?>