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

if($_SESSION['pass'] == $tableArray[$userindex][2]) {
	$username = $tableArray[$userindex]['name'];
	$avatar = $tableArray[$userindex]['avatar'];
} else {
	header('Location: index.php');
}

if(!$username) {
	header('Location: index.php');

}

$username = $tableArray[$userindex]['name'];
$avatar = $tableArray[$userindex]['avatar'];
$role = $tableArray[$userindex]['role'];

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

<center><p>Welcome to your profile, <?php echo strip_tags($username); ?> ;)

</p></center>
<form action="rsc/upload.php" method="post" enctype="multipart/form-data">
  
      <label for="file">Select a file:</label> 

      <input type="file" name="userfile" id="file">
    
      <button>Upload File</button>

</form> 
<br>
<form action="rsc/status.php" method="post">
<center><input name="status" type="text" id="user" size="50" placeholder="Write here your status  :D"><INPUT type="submit" value="Send"></center>
<input type="hidden" name="username" value="<?php echo strip_tags($username); ?>">

</form>
<?php
//$username = $_SESSION['user_name'];
$dirname = $tableArray[$userindex]['userdir'];
$dir = opendir($dirname);
$bitlydir = getDir();
$files = getFilesFromDir($dirname); 
$array = array('users/'.$username.'/index.php', 'users/'.$username.'/status.sts');
foreach ($array as $key => $value) {
    $keyunset = array_search($value, $files);
   	unset($files[$keyunset]);

}


echo "<p id=\"coolp\">Your photos:</h2>";
	echo "<div id=\"imgcontainer\">";
if(!$files) {
echo "<p id=\"coolp\">No files! Upload some!</p>";
} else {
	foreach($files as $files) {
		$filelink = get_isgd_url('http://'.$bitlydir.$files);
		echo "<a href=\"".$filelink."\"><img src=\"".$files."\" style=\"border-style: none; margin-top: 10px; margin-bottom: 10px; margin-right: 10px; margin-left: 10px;\"></a>&nbsp;";
	}
}

	echo "</div><br>";
echo "<p id=\"coolp\">Your statuses</p>";
$parsed = readStatuses("users/".$username."/status.sts");
foreach($parsed as $statuses) {
	echo "<div id=\"imgcontainer\">";
	echo "<p id=\"coolp\">".strip_tags($statuses)."</p>";
	echo "</div><br>";
}

?>
</div>

</div>
</body>
</html>