<?php
include_once('functions.php');
$permission = $_POST['group1'];

if(!$permission) {
	echo "POST request has failed :( <a href=\"../profile.php\">Try again</a>";


} else {
	$name = $_POST['admin'];
	$isadmin = $_POST['isadmin'];
	if(in_array($isadmin, $admins)) {
		$dbo = new SQLiteDatabase("db.sqlite");
	
		$test2 = $dbo->arrayQuery("UPDATE users SET role=".$permission." WHERE name='".$name."'");

		header('Location: ../admin.php');

	} else {
		echo "Whoops, you're not an admin :( <a href=\"../profile.php\">Try again</a>";
	}
}

?>
