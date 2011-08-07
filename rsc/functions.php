<?php
$admins = array("zad0xsis");
function findIndexByName ($array, $name) {
  		foreach ($array as $index => $entry)
    		 if ($entry['password'] === $name) return $index;
  		return null; // or "false", or "-1", or whatever 
}
function checkIfUserExists ($array, $name) {
  		foreach ($array as $index => $entry)
    		 if ($entry['name'] === $name) return $index;
  		return null; // or "false", or "-1", or whatever 
}
function checkUserPass($username, $password){
   //global $connection;
	$dbo = new SQLiteDatabase("db.sqlite");

   //$username = str_replace("'","''",$username)
	if(ctype_alnum($username)) {
		$tableArray = $dbo->arrayQuery("SELECT * FROM users;");

		$userindex = findIndexByName($tableArray, $password);
	
		if($password == $tableArray[$userindex][2] && $username == $tableArray[$userindex][0]){
			session_start();

			$_SESSION['pass']  = $tableArray[$userindex][2];
			header('Location: ../profile.php');

		} else {
			echo "I don't recognize your username/password :/ <a href=\"../index.php\">Go home</a>";
		}
    } else {
    
    		echo "I don't recognize your username/password :/ <a href=\"../index.php\">Go home</a>";

    }
   // Verify that user is in database	
}
function getFilesFromDir($dir) { 

  $files = array(); 
  if ($handle = opendir($dir)) { 
    while (false !== ($file = readdir($handle))) { 
        if ($file != "." && $file != "..") { 
            if(is_dir($dir.'/'.$file)) { 
                $dir2 = $dir.'/'.$file; 
                $files[] = getFilesFromDir($dir2); 
            } 
            else { 
              $files[] = $dir.'/'.$file; 
            } 
        } 
    } 
    closedir($handle); 
  } 

  return array_flat($files); 
} 

function array_flat($array) { 

  foreach($array as $a) { 
    if(is_array($a)) { 
      $tmp = array_merge($tmp, array_flat($a)); 
    } 
    else { 
      $tmp[] = $a; 
    } 
  } 

  return $tmp; 
} 
function get_isgd_url($url)  
{  
  //get content
  $ch = curl_init();  
  $timeout = 5;  
  curl_setopt($ch,CURLOPT_URL,'http://is.gd/api.php?longurl='.$url);  
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
  curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);  
  $content = curl_exec($ch);  
  curl_close($ch);
  
  //return the data
  return $content;  
}
function getDir() {
	$server = $_SERVER["SERVER_NAME"];
	$requesturi = dirname($_SERVER["REQUEST_URI"]);
	$path = $requesturi."/";
	$dir = $server.$path;
return($dir);
}
function register($username, $password, $avatar) {
	
	$dbo = new SQLiteDatabase("db.sqlite");

   //$username = str_replace("'","''",$username)
	$tableArray = $dbo->arrayQuery("SELECT * FROM users;");

	if(ctype_alnum($username)) {
		$userindex = checkIfUserExists($tableArray, $username);
			if($username == $tableArray[$userindex][0]){
				echo "Username is in use, please check other username, <a href=\"../register.php\">try again</a>";
			} else {
				if(!$avatar) {
					$avatar = "rsc/avatar.png";
				}

				$adduser = $dbo->arrayQuery("INSERT INTO users(name, avatar, password, userdir, role) VALUES('".$username."', '".$avatar."', '".$password."', 'users/".$username."', 1);");
				$dirname = "../users/".$username;
				mkdir($dirname, 0777);
				$index = 'index.php';
				$status = 'status.sts';
				$userindex = '../users/'.$username.'/index.php';
				$userstatus = '../users/'.$username.'/status.sts';
				if (!copy($index, $userindex)) {
    				echo "Failed when registering :( <a href=\"../index.php\">Go home</a>";
				}
				if (!copy($status, $userstatus)) {
					echo "Failed when registering :( <a href=\"../index.php\">Go home</a>";
				}
				echo "Registered sucesfully :D Login on <a href=\"../index.php\">the home</a>";

			}
			
	} else {
			echo "String Rejected: <b>Bad Characters, only letters or numbers</b>";
		}
	// Retrieve password from result

   // Validate that password is correct

	}

function remove_value_from_array($array, $value) {
$pos = array_search($value, $array);

// Remove from array
unset($array[$pos]);

}
function readStatuses($file) {
$lines = file_get_contents($file);

if(!$lines) {
	return array("No status updates, add one!");
}
if($lines == "") {
	return array("No status updates, add one!");

}
$lines = substr($lines, 3);
$parsed = explode("|-|", $lines);

	return $parsed;
}
function readPosts($file) {
$lines = file_get_contents($file);
$parsed = explode("|-|", $lines);

	foreach($parsed as $posts) {
		echo "<pre>";
		$posts = explode("&", $value); //for comments
		echo "<div id=\"imgcontainer\">";
		echo "<p id=\"coolp\">".$posts."</p>";
		echo "</div>";
		echo "</pre>";
	}
}
function newStatus($data, $file) {
	$lines = file_get_contents($file);
	$handle = fopen($file, 'w');
	$data = $lines.$data;
	fwrite($handle, $data); 
	fclose($handle); 

}
function listUsers() {
   //global $connection;
	$dbo = new SQLiteDatabase("db.sqlite");

   //$username = str_replace("'","''",$username)

   // Verify that user is in database
	$tableArray = $dbo->arrayQuery("SELECT name FROM users;");
	// Retrieve password from result

   // Validate that password is correct

	print_r($tableArray);
}
function recurse_copy($src,$dst) { 
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
                recurse_copy($src . '/' . $file,$dst . '/' . $file); 
            } 
            else { 
                copy($src . '/' . $file,$dst . '/' . $file); 
            } 
        } 
    } 
    closedir($dir); 
} 
function recursivelyrmdir($dir) { 
   if (is_dir($dir)) { 
     $objects = scandir($dir); 
     foreach ($objects as $object) { 
       if ($object != "." && $object != "..") { 
         if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object); 
       } 
     } 
     reset($objects); 
     rmdir($dir); 
   } 
 } 
?>