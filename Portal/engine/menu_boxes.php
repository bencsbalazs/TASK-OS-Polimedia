<?php
require_once("../data/linkek.php");
session_start();
foreach($linkek as $box=>$doboz){
	if ($box == "Work" && !isset($_SESSION['blsuser'])) {
		continue;
	} else {
	print '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading">'.$box.'</div>
					<div class="panel-body list-group">';
					foreach ($doboz as $link){
						$disabled = ($link['disabled'] == true) ? ' disabled' : '';
						print '<a class="list-group-item '.$disabled.'" href="'.$link['link'].'">'.$link['nev'].'</a>';
					}
	print '</div></div></div>';
	}				
}
?>
