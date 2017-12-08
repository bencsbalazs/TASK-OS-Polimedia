<?php

	require_once("mysql_class.php");
	$MySQL = new MySQL();
	if ( is_session_started() === FALSE ) session_start();
	
	$tantargy = (isset($_GET['id'])) ? $_GET['id'] : $_SESSION['tantargy'];
	$_SESSION['tantargy'] = $tantargy;
	
	$adatok = $MySQL->Query("SELECT * FROM sections WHERE subjects_id=$tantargy ORDER BY number","multiassoc");
	if (!is_array($adatok)) {print "Nincs megjeleníthető adat.";} else {
		foreach ($adatok as $f){
			
		}
	}

function is_session_started()
{
    if ( php_sapi_name() !== 'cli' ) {
        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
        } else {
            return session_id() === '' ? FALSE : TRUE;
        }
    }
    return FALSE;
}
?>
