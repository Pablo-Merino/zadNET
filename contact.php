<!doctype html>

<!-- HEAD -->
<html>

<head>
<title>i.0x08.org</title>
<link rel="stylesheet" href="rsc/style.css" type="text/css"/>
</head>

<body>
<div id="container">
<div id="leftside">
	<div class="announce">
	<center><p style="text-align: center;">zadNET</p></center>
	<center><p style="text-align: center;">Today is: <?php echo date('d/m/Y'); ?></p></center>
	<center><p style="text-align: center;">Login:</p></center>

	<form action="rsc/db.php" method="post">

<input name="user" type="text" id="user" size="20" placeholder="Username"><br>
<input name="pass" type="password" id="pass" size="20" placeholder="Password"><br>
<center><INPUT type="submit" value="Send"></center>
</form>


	</div>
	<ul class="avmenu">
		<li><a href="./">Home</a></li>
		<li><a href="register.php">Register</a></li>
		<li><a href="userlist.php">User list</a></li>

		<li><a href="contact.php">Contact</a></li>
		<li><a href="about.php">About</a></li>
	</ul>
	
	
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
<p id="coolp">Contact on <a href="mailto:pablo.perso1995@gmail.com">my email</a> here :)</p>
</div>

</div>
</body>
</html>