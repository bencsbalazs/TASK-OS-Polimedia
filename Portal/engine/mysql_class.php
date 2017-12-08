<?php
require_once("settings.php");
class MySQL{
	
	var $connection;
	private $sql;
	public $result = false;
	
	public function __construct(){
		global $CFG;
		$this -> connection = mysql_connect(
			$CFG->DataBase['host'], 
			$CFG->DataBase['user'], 
			$CFG->DataBase['pass']
		) or die (
			print "Hiba az adatbázis-szerver adataiban!"
		);
		mysql_set_charset('utf8',$this->connection);
		mysql_select_db(
			$CFG->DataBase['name'], 
			$this->connection
		) or die(
			print "Hiba! Nem találom a megadott adatbázist!"
		);
	}
	
	public function __destruct() {
		mysql_close($this -> connection);
	}
	
	function Disconnect() {
		mysql_close($this -> connection);
	}
	
	public function Query($sql, $data='default') {
		$query = mysql_query($sql);
		if ($query==null || $query==false) {$result="Nincs eredmény!";} 
		else {
			switch ($data) {
				case "single" :
				$eredmeny=mysql_fetch_array($query);
				$result=$eredmeny[0];
				break;
				case "array" :
				$result=mysql_fetch_array($query);
				break;
				case "assoc" :
				$result=mysql_fetch_assoc($query);
				break;
				case "multiarray" :
				while ($sor = mysql_fetch_array($query)){$result[] = $sor[0];}
				break;
				case "multiassoc" :
				while ($sor = mysql_fetch_assoc($query)){$result[] = $sor;}
				break;
				default :
				$result=$query;
				break;
			}
		}
		return $result;
	}
	
	public function Insert($sql) {
		$query=mysql_query($sql);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}
	
	public function Delete($honnan, $attributum, $ertek) {
		$query=mysql_query("DELETE FROM $honnan WHERE $attributum=$ertek");
		if ($query) {
			$result=true;
		} else {
			$result=false;
		}
		return $result;
	}
}
?>
