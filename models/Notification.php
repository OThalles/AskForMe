<?php

class Notification {
    public $id;
    public $user_from;
    public $user_to;
    public $body;

}

interface notificationInterface {
    public function getNotificationsUser($user_to);
    public function addNotification($user_to, $user_from, $body, $created_at);
}
