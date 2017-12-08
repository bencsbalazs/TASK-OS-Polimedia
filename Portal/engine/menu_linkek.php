<?php

require_once("../data/linkek.php");
session_start();
foreach($linkek as $mp=>$lks){

	if ($mp == "Work" && !isset($_SESSION['blsuser'])) {
		continue;
	} else {
		print '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$mp.' <span class="caret"></span></a><ul class="dropdown-menu">';
		foreach ($lks as $link){
			$disabled = ($link['disabled'] == true) ? ' class="disabled"' : '';
			$dislink = ($link['disabled'] == true) ? 'disabled' : '';
			print '<li'.$disabled.'><a href="'.$link['link'].'" '.$dislink.'>'.$link['nev'].'</a></li>';
		}
		print '</ul></li>';
	}
}

?>
