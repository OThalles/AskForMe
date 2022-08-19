<?php

class Post {
    public $id;
    public $user_from;
    public $user_to;
    public $body;
    public $sended_date;

}

interface postInterface {
    public function sendPostToUser(Post $post);
    public function findUserByPost($id_post);
    public function getPostsProfile($id);
}
