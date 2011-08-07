<?php
if(!isset($_SESSION)) {
	session_start();

} else {
	header('Location: index.php');

}
include_once('rsc/functions.php');

$dbo = new SQLiteDatabase("rsc/db.sqlite");

$tableArray = $dbo->arrayQuery("SELECT * FROM users;") 
or die('I had fail selecting the db');
$userindex = findIndexByName($tableArray, $_SESSION['pass']);

if(!($tableArray[$userindex]['role'] == 0)) {
	header('Location: index.php');
} else {
	$username = $tableArray[$userindex]['name'];
	$avatar = $tableArray[$userindex]['avatar'];
	$role = $tableArray[$userindex]['role'];

}



?>
<!doctype html>

<!-- HEAD -->
<html>

<head>
<title>i.0x08.org</title>
<link rel="stylesheet" href="rsc/style.css" type="text/css"/>
</head>

<!-- BODY -->

<body>
<div id="container">
<div id="leftside">
	<div class="announce">
	<center><p style="text-align: center;">Name: <?php echo $username; ?></p></center>

	<center><img src="<?php echo $avatar; ?>"></center>
	<?php
	if($role == 0) {
		echo "<center><p style=\"text-align: center;\">Hi admin!</p></center>";
	} else {
		echo "<center><p style=\"text-align: center;\">Hi, ".$username."</p></center>";
	}
	?>
	</div>
	<?php
	if($role == 0) {
		echo "<ul class=\"avmenu\">
		<li><a href=\"profile.php\">Home</a></li>
		<li><a href=\"register.php\">Register</a></li>
		<li><a href=\"userlist.php\">User list</a></li>
		<li><a href=\"contact.php\">Contact</a></li>
		<li><a href=\"admin.php\">Admin</a></li>
		<li><a href=\"prefs.php\">Account settings</a></li>

		<li><a href=\"about.php\">About</a></li>
		<li><a href=\"index.php\">Logout</a></li>

	</ul>";
	} else {
		echo "<ul class=\"avmenu\">
		<li><a href=\"profile.php\">Home</a></li>
		<li><a href=\"register.php\">Register</a></li>
		<li><a href=\"userlist.php\">User list</a></li>
		<li><a href=\"contact.php\">Contact</a></li>
		<li><a href=\"prefs.php\">Account settings</a></li>

		<li><a href=\"about.php\">About</a></li>
		<li><a href=\"index.php\">Logout</a></li>

	</ul>";
	}
	?>
	
	
</div>

<pre>
              _ _   _ ______ _______ 
             | | \ | |  ____|__   __|
 ______ _  __| |  \| | |__     | |   
|_  / _` |/ _` | . ` |  __|    | |   
 / / (_| | (_| | |\  | |____   | |   
/___\__,_|\__,_|_| \_|______|  |_|   
                                     
</pre>


<div id="container2"> 

<center><p>Hi root</p></center>
<form action="rsc/chperms.php" method="post">

<?php
	
	$dbo = new SQLiteDatabase("rsc/db.sqlite");

   //$username = str_replace("'","''",$username)

   // Verify that user is in database
	$tableArray = $dbo->arrayQuery("SELECT name FROM users;");
	// Retrieve password from result
		echo($tableArray[1]['role']);

   // Validate that password is correct
	//echo "<ul>";
	echo "<div id=\"imgcontainer\">";
	
	foreach($tableArray as $key=>$value){
		if($tableArray[$key][0] == $username) {
			echo "<p id=\"coolp\" style=\"text-align: left;\"><code>Hi, ".$username."</code></p>";
					echo($tableArray[$key]['role']);

		} else {

			if(!(in_array($tableArray[$key][0], $admins))) {
				echo "<p id=\"coolp\" style=\"text-align: left;\"><code>".htmlentities($tableArray[$key][0])." - User permissions: <input type=\"radio\" name=\"group1\" value=\"0\"> Admin <input type=\"radio\" name=\"group1\" value=\"1\" checked> User<br></code></p><input type=\"hidden\" id=\"admin\" name=\"admin\" value=\"".$tableArray[$key][0]."\" />";
			} else {
				echo "<p id=\"coolp\" style=\"text-align: left;\"><code>".htmlentities($tableArray[$key][0])." - User permissions: <input type=\"radio\" name=\"group1\" value=\"0\" checked> Admin <input type=\"radio\" name=\"group1\" value=\"1\"> User<br></code></p><input type=\"hidden\" id=\"admin\" name=\"admin\" value=\"".$tableArray[$key][0]."\" /><input type=\"hidden\" id=\"admin\" name=\"isadmin\" value=\"".$username."\" />";
			}
			

		}

	}
	
	echo "</div>";
	
	//echo "</ul>";

?>
<center><INPUT type="submit" value="Send"></center></form>
</div>

</div>
</body>
</html>