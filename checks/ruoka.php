<?php

$connect = mysql_connect('localhost' , 'root' , 'leevi637e');

if (!$connect) {

	die ('Yhteyden muodostus ep�onnistui!');
	
}
else {

	if ($_POST["date"] && $_POST["lista"]) {
		
		$date = $_POST["date"];
		$lista = $_POST["lista"];
		
		echo ("$date <br><br>");
		echo ("$lista <br><br>");
		
		$db_selected = mysql_select_db('yll�pito' , $connect);
		
		if (!$db_selected) {
		
			die ("Tietokanna valinta ep�onnistui!");
		
		}
		else {
		
			$query = mysql_query("INSERT INTO ruoka VALUES ('' , '$date' , '$lista')");
			
			if ($query) {
			
				echo ("Onnistui! <br> <a href='../yllapito.php'>Takaisin<a>");
			
			}
			else die (mysql_error());
		
		}
	}
	else die ('T�yt� molemmat kent�t!');

}

?>