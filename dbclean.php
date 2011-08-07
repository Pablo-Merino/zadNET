<?php
$dbo = new SQLiteDatabase("rsc/db.sqlite");

$test = $dbo->arrayQuery("DROP TABLE users;");

$test1 = $dbo->arrayQuery("CREATE TABLE \"users\"(name text, avatar text, password text, userdir text, role numeric);");
$password = md5("zad0xsis");
$test2 = $dbo->arrayQuery("INSERT INTO users(name, avatar, password, userdir, role) VALUES('zad0xsis', 'http://es.gravatar.com/userimage/17503042/86ae3c2e40e7b5cdde3935c57e2da86b.jpg?size=100', '$password', 'users/zad0xsis', 0);");

?>