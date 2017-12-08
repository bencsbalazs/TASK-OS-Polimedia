<?php
	header("charset: utf-8");
	/*
	 * Adatok definiálása
	 */
	unset($CONF);
	$CONF = new stdClass();
	$CONF -> moodle = array(
		'host' => 'localhost',
		'user' => 'root',
		'pass' => 'onlinestud_01',
		'name' => 'osmoodle'
	);
	$CONF -> id = 54;
	/*
	 * Adatbáziskapcsolat a moodle-el.
	 */
	$link = mysqli_connect($CONF->moodle['host'], $CONF->moodle['user'], $CONF->moodle['pass'], $CONF->moodle['name']);
	if (!$link) {die('Not connected : ' . mysql_error());}
	mysqli_set_charset($link, 'utf8');
	/*
	 * Kapcsolat az OS adatbázissal.
	 */
	require_once('mysql_class.php');
	$MySQL = new MySQL();
	/*
	 * Változók definiálása
	 */
	$crs = array();
	/*
	 * HTML fejléc
	 */
	print '<div class="row"><div class="container"><div class="col-lg-12">';
	/*
	 * Kurzusok lekérdezése
	 */
	$courses = mysqli_query($link, "SELECT id, fullname FROM mdl_course");
	while ($course = mysqli_fetch_assoc($courses)){$crs[$course['id']] = $course['fullname'];}
	
	$new_course_id = $MySQL->Query("SELECT MAX(id) FROM subjects","single");
	if (!$new_course_id) {$new_course_id=1;} else {$new_course_id++;}
	
	/*
	 * Szekciók lekérdezése
	 */
	$sections = mysqli_query($link, "SELECT name, sequence FROM mdl_course_sections WHERE course=$CONF->id");
	
	$new_section_id = $MySQL->Query("SELECT MAX(id) FROM sections","single");
	if (!$new_section_id) {$new_section_id=1;} else {$new_section_id++;}
	
	print '<h1>'.$crs[$CONF->id].' (INSERT INTO subjects (id, fullname) VALUES ('.$new_course_id.',"'.$crs[$CONF->id].'");)</h1><ul data-role="listview" data-inset="true" data-shadow="false">';
	/*
	 * Szekciók elemzése
	 */
	$section_number = 1;
	while ($row = mysqli_fetch_assoc($sections)) {
		print '<li data-role="collapsible" data-inset="false"><h2>'.$row["name"].' (INSERT INTO sections (id, name, subjects_id, number) VALUES ('.$new_section_id.',"'.$row["name"].'",'.$new_course_id.','.$section_number.'))</h2><ul data-role="listview" data-theme="b">';
		$element_number = 1;
		/*
		 * Szekciók felbontása
		 */
		foreach(explode(",",$row['sequence']) as $n){
			
			/*
			 * Elemek azonosítása
			 */
			$modul = mysqli_query($link, "SELECT mdl_modules.name, mdl_course_modules.instance, mdl_course_modules.indent FROM mdl_course_modules JOIN mdl_modules ON mdl_course_modules.module=mdl_modules.id WHERE mdl_course_modules.id=$n");
			$mod = mysqli_fetch_assoc($modul);
			$i=$mod["instance"];$n=$mod["name"];$d=intval($mod["indent"]);
			/*
			 * Objektumok nevének és típusának kiírása
			 */
			$sql = mysqli_query($link, "SELECT name FROM mdl_$n WHERE id='$i'");
			$e = mysqli_fetch_array($sql);
			switch($mod['name']) {
				case ("video"): $dbquery="Query(INSERT INTO videos (title, sections_id, number, indent) VALUES(".$e[0]."), ".$new_section_id.",".$element_number.", ".$d.");";
				break;
				case ("url"): $dbquery="Query(INSERT INTO videos (title, sections_id, number, indent) VALUES(".$e[0]."), ".$new_section_id.",".$element_number.", ".$d.");";
				break;
				case (""):
				default: $dbquery="Kivétel";
				break;
			}
			print "<li>".str_repeat("&nbsp;&nbsp;&nbsp;",$d).$mod['name']." : ".$e[0]." ->".$dbquery."</li>";			
		$element_number++;
		}
		print "</ul></li>";
		$section_number++;
		$new_section_id++;
	}
	/*
	 * HTML zárása, kezelőfüggvények
	 */
	print '</ul></div></div></div>';

?>
