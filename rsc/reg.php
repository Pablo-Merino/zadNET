<?php
include_once('functions.php');
$username = strip_tags($_POST['user']);

//$user = htmlentities($_POST['user']);
$pass = md5($_POST['pass']);
$avatar = $_POST['avatar'];

register($username, $pass, $avatar);

?>
