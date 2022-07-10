<?php
require_once('config.php');
unset($_SESSION['token']);
header("Location: ".$base."/login.php");
exit;
?>