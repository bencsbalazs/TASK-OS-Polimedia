<?php

// Ez a fájl tartalmazza a menürendszer linkjeit. 
// Megjelenik a menüsorban is, és ugyanaz a lista a 
// főoldali dobozokban is, más formázással.
// Ha módosítani kell a menün, azt ebben a tömbben tedd!!!

	$linkek = array(
		"Belső leírások"=>array(
			array("nev"=>"OS bemutatkozás","link"=>"#","disabled"=>true),
			array("nev"=>"OS kiajánló","link"=>"#","disabled"=>true),
			array("nev"=>"OS tananyag fejlesztési specifikáció","link"=>"#","disabled"=>true)
		),
		"Online kurzusok fejlesztése"=>array(
			array("nev"=>"Projektjeink","link"=>"#","disabled"=>true,"login"=>true),
			array("nev"=>"Kurzusaink","link"=>"#","disabled"=>true,"login"=>true),
			array("nev"=>"Videók","link"=>"#","disabled"=>true,"login"=>true),
			array("nev"=>"Tananyag hibabejelentő","link"=>"#","disabled"=>true),
			array("nev"=>"Tananyaghasználati GYIK","link"=>"#","disabled"=>true)
		),
		"Tanároknak"=>array(
			array("nev"=>"Forgatókönyv sablon","link"=>"#","disabled"=>true),
			array("nev"=>"Forgatókönyv készítési útmutató","link"=>"#","disabled"=>true),
			array("nev"=>"Animációs forgatókönyv","link"=>"#","disabled"=>true),
			array("nev"=>"Polimédia jótanácsok","link"=>"#polimediajotanacsok","disabled"=>false),
			array("nev"=>"Due online oktatási stratégia","link"=>"#","disabled"=>true),
			array("nev"=>"Polimédia naptár","link"=>"http://onlinestudium.hu/polimedia","disabled"=>false),
			array("nev"=>"Animációs mintatár","link"=>"#animaciok","disabled"=>false),
			array("nev"=>"Minta videók","link"=>"#videok","disabled"=>false)
			
		),
		"Projektjeink"=>array(
			array("nev"=>"MÁV moodle","link"=>"http://onlinestudium.hu/mav","disabled"=>false),
			array("nev"=>"MÁV statisztika","link"=>"http://onlinestudium.hu/bls/moodlestat","disabled"=>false),
			array("nev"=>"HFIP moodle","link"=>"http://hfip.onlinestudium.hu","disabled"=>false),
			array("nev"=>"GYSEV moodle","link"=>"#","disabled"=>true),
			array("nev"=>"TÁMOP 4.2.2. projekt","link"=>"http://onlinestudium.hu/tamop422","disabled"=>false),
			array("nev"=>"MeMOOC","link"=>"#","disabled"=>true),
			array("nev"=>"HUNLINE","link"=>"#","disabled"=>true)
		),
		
		"HASIT"=>array(
			array("nev"=>"HASIT rendszer","link"=>"#","disabled"=>true),
			array("nev"=>"HASIT GYIK","link"=>"#","disabled"=>true),
			array("nev"=>"HASIT hibabejelentő","link"=>"#","disabled"=>true)
		),
		"Work"=>array(
			array("nev"=>"Minőségirányítási kézikönyv","link"=>"#kezikonyv","disabled"=>true),
			array("nev"=>"Polimédia naptár","link"=>"http://onlinestudium.hu/polimedia","disabled"=>false),
			array("nev"=>"Animáció gyűjtemény","link"=>"#animaciok","disabled"=>false),
			array("nev"=>"Adatbázisok","link"=>"#","disabled"=>true),
			array("nev"=>"Szabadságnaptár","link"=>"#szabadsagnaptar","disabled"=>false),
			array("nev"=>"DUE telefonkönyv","link"=>"http://old.uniduna.hu/telefonkonyv","disabled"=>false),
			array("nev"=>"Levelező","link"=>"https://login.microsoftonline.com","disabled"=>false),
			array("nev"=>"Letöltőközpont","link"=>"https://e5.onthehub.com/WebStore/Support/ContactUs.aspx?ws=56dbf401-6b9b-e011-969d-0030487d8897","disabled"=>false)
		)
	);

?>
