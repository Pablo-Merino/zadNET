<?php
include_once('functions.php');
$newnick = $_POST['nick'];
$oldnick = $_POST['username'];

if(!$oldnick) {
	echo "POST request has failed :( <a href=\"../profile.php\">Try again</a>";


} else {
	if(ctype_alnum($newnick)) { 
		$newnick = $_POST['nick'];
		$oldnick = $_POST['username'];
		$dbo = new SQLiteDatabase("db.sqlite");
		
		$test2 = $dbo->arrayQuery("UPDATE users SET name='".$newnick."' WHERE name='".$oldnick."'");
		$test3 = $dbo->arrayQuery("UPDATE users SET userdir='users/".$newnick."' WHERE name='".$newnick."'");

		recurse_copy("../users/".$oldnick."/", "../users/".$newnick."/");
		recursivelyrmdir("../users/".$oldnick."/");
		header('Location: ../prefs.php');

	} else {
		echo "String Rejected: <b>Bad Characters, only letters or numbers</b>";

	}
}
?>
