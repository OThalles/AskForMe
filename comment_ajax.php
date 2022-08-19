<?php
require_once('config.php');
require_once('dao/postAswnersDao.php');
require_once('dao/postDao.php');
require('models/Auth.php');
$auth = new Auth($pdo, $base);
$userMe = $auth->checkToken();



$id_post = filter_input(INPUT_POST, 'id_post');
$body = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS);

$postDao = new postDao($pdo);


if($id_post && $body) {
    if($postDao->isMyProfile($id_post) == $userMe->id) { //Checando se a pergunta está no perfil do usuario logado.
    $return = [];                                    //Apenas o usuário logado pode responder as perguntas feitas para ele.

    $newPostAswner = new PostAswners();
    $newPostAswner->user_from = $userMe->id;
    $newPostAswner->body = $body;
    $newPostAswner->post_id = $id_post;
    $newPostAswner->sended_date = date('Y-m-d H:i:s'); 
    $postAswnersDao = new postAswnersDao($pdo);
    $postAswnersDao->addComment($newPostAswner);



    $return = [
        'link' => $base.'/perfil.php?id='.$userMe->id,
        'photo' => $base.'/media/profile/'.$userMe->photo,
        'name' => $userMe->name,
        'body' => $body,
        'sended_date' => date('Y-m-d H:i:s'),
        'error' => '',
    ];
    
}
}

header("Content-type: application/json");
echo json_encode($return);

?>