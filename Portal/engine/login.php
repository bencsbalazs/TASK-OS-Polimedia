<?php

require_once("mysql_class.php");
$MySQL = new MySQL();

$u = (isset($_POST["user"])) ? $_POST["user"] : false;
$p = (isset($_POST["pass"])) ? $_POST["pass"] : false;

if (!$p || !$u) {
	die("Nincs adat!");
} else {
	$q=$MySQL->Query("SELECT id,username,password FROM users WHERE username='$u'","assoc");
	if ($q){
		if ($q['password'] == md5($p)){
			session_set_cookie_params(600,"/");
			session_start();
			$_SESSION['blsuser'] = $q['id'];
			print "ok";
		} else {die("Hiba!");}
	} else {die("Hiba!");}
}
unset($u);unset($p);unset($q);

?>
