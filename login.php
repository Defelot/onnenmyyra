<?php
session_start();
session_regenerate_id([ $delete_old_session = true ]);
 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<HTML>
	<?php include('includes/head.php'); ?>
	<BODY>
		<form method='POST' action='login.php'>
			<label>K�ytt�j�nimi: <input type='text' name='user' /></label><br>
			<label>Salasana: <input type='password' name='pass' /></label><br>
			<input type='submit' value='Kirjaudu' name='submit' />
		</form>
		<?php
		if (isset($_POST["submit"])) {
			$user = $_POST["user"];
			$pass = md5($_POST["pass"]);
			if ($user && $pass) {
				$connect = mysql_connect('localhost' , 'k�ytt�j�' , 'salasana');
				if(!$connect) {
					die ('Tietokantaan yhdist�minen ep�onnistui!');
				}
				else {
					$user = mysql_real_escape_string($user);
					$pass = mysql_real_escape_string($pass);
					$db = mysql_select_db('yll�pito' , $connect);
					if (!$db) {
						die ('Tietokannan valitseminen ep�onnistui!');
					}
					else {
						$query = mysql_query("SELECT * FROM k�ytt�j�t WHERE k�ytt�j�='$user' AND salasana='$pass'");
						if ($query) {
							mysql_fetch_array($query);
							$numrows = mysql_num_rows($query);
							if ($numrows > 0) {
								$_SESSION["user"] = 1;
								
								header('Location: yllapito.php');
							}
							else echo ('V��r� k�ytt�j�nimi tai salasana!');
						}
						else die ('??');
					}
				}
			}
			else echo ('T�yt� molemmat kent�t!');
		}
		?>
	</BODY>
</HTML>