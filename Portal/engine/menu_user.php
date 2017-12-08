<?php
require_once("mysql_class.php");
$MySQL = new MySQL();
session_start();
	if (isset($_SESSION['blsuser'])){
		$usr=$_SESSION['blsuser'];
		$ud = $MySQL->Query("SELECT `firstname`, `lastname`, `szerep` FROM `users` WHERE `id`=$usr","assoc");
		print '
		<li><a href="#lista">Ellenőrzés</a></li>
		<li><a href="#synchronize">Szinkronizálás</a></li>
		<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$ud['firstname'].' '.$ud['lastname'].' <span class="caret"></span></a><ul class="dropdown-menu"><li><a href="engine/logout.php">Kilépés</a></li></ul></li>';
	} else {
		print '<li><a href="#" data-toggle="modal" data-target="#myModal">Belépés</a></li>';
	}
unset($MySQL);

?>
