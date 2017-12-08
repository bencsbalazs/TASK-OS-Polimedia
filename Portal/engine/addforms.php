<?php

	$action=(isset($_POST['action'])) ? $_POST['action'] : false;
	
	require_once('mysql_class.php');
	$MySQL = new MySQL();
	
	switch ($action){
		case "newproject" : NewProjectForm();
		break;
		case "addproject" : AddProjekt();
		break;
		case "newsubject" : NewSubjectForm();
		break;
		case "addsubject": AddSubject();
		break;
		default: print "Hibás függvényhívás!";
		break;
	}
	
function NewProjectForm(){
	print '<form id="addform" name="newproject" method="post" action="engine/addforms.php">
		<input type="hidden" name="action" value="addproject">
		<input type="text" class="form-control" name="projectsortnev" placeholder="Kódnév">
		<input type="text" class="form-control" name="projectlongnev" placeholder="Hosszú név">
	</form>';
}

function AddProjekt(){
	global $MySQL;
	$ln = $_POST['projectlongnev'];
	$sn = $_POST['projectsortnev'];
	$beir = $MySQL->Insert('INSERT INTO projekts (shortname, longname) VALUES ("'.$sn.'", "'.$ln.'")');
	if ($beir) {print "Sikeres rögzítés!";} else {print "Sikertelen rögzítés!";}
	unset($beir);
}

function NewSubjectForm(){
	global $MySQL;
	print '<form id="addform" name="newsubject" method="post" action="engine/addforms.php">
		<input type="hidden" name="action" value="addsubject">
		<input type="text" class="form-control" name="subjectsortnev" placeholder="Rövid név">
		<input type="text" class="form-control" name="subjectlongnev" placeholder="Hosszú név">
		<select name="project">';
		$pr = $MySQL->Query('SELECT id, shortname FROM projekts','multiassoc');
		foreach ($pr as $p){
			print '<option value="'.$p['id'].'">'.$p['shortname'].'</option>';
		}
		print '</select>
	</form>';
}

function AddSubject(){
	global $MySQL;
	$ln = $_POST['subjectlongnev'];
	$sn = $_POST['subjectsortnev'];
	$pr = $_POST['project'];
	$comments_id = 1;
	$presenters_id = 1;
	$beir = $MySQL->Insert('INSERT INTO subjects (fullname, shortname, projekts_id, comments_id,presenters_id) VALUES ("'.$ln.'", "'.$sn.'", '.$pr.', '.$comments_id.', '.$presenters_id.')');
	if ($beir) {print "Sikeres rögzítés!";} else {print "Sikertelen rögzítés!";}
	unset($beir);
}

function NewSectionForm(){
	print '<form id="addform" name="newsubject" method="post" action="engine/addforms.php">
                <input type="hidden" name="action" value="addsection">
                <input type="text" class="form-control" name="sectionnev" placeholder="Név">
	</form>';
}

function AddSection(){
	global $MySQL;
	$sn = $_POST['sectionnev'];
	
}

function NewElementForm(){
	
}

function AddElement(){
	global $MySQL;
}

?>
