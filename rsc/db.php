<?php
include_once('functions.php');
$user = $_POST['user'];
$pass = md5($_POST['pass']);
if(!$user || !$pass){
	echo "Whoops, error sending post, <a href=\"../index.php\">relogin</a>";
} else {
checkUserPass($user, $pass);

}
?>