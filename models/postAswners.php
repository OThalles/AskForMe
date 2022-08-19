<?php

class postAswners {
    public $id;
    public $post_id;
    public $user_from;
    public $body;
    public $sended_date;
}

interface postAswnersInterface {
    
    public function addComment(PostAswners $aswner);
    public function getAswners($id_post);
    
}