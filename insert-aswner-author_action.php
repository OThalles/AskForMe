<?php
require('config.php');
require_once('dao/postAswnersDao');
require('models/Auth.php');
$auth = new Auth($pdo, $base);
$userMe = $auth->checkToken();

$aswner = filter_input(INPUT_POST, 'owner-profile-form');

if($aswner) {
    $newAswner = new postAswnersDao($pdo);
    $newAswner->addComment($userMe, $aswner, $id_post);
}

?>