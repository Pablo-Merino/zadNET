<?php
include_once('functions.php');
$data = "|-|".$_POST['status'];
$user = $_POST['username'];
if(!$_POST['status']) {
	echo "You have to write an status! <a href=\"../profile.php\">Go home</a>";
} else {
	newStatus($data, "../users/".$user."/status.sts");
	header('Location: ../profile.php');
}

?>