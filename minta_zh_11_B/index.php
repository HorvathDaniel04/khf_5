<?php
	session_start();
	require 'db.php';
	$db = getDb("mydb");

	$sql = "SELECT Varosok.*, AVG(Naplobejegyzesek.Homerseklet) as atlag 
			FROM Varosok
			LEFT JOIN Naplobejegyzesek ON Varosok.idVarosok = Naplobejegyzesek.Varosok_idVarosok
			WHERE Varosok.Lakossag > 1
			GROUP BY Varosok.idVarosok
			ORDER BY Varosok.Lakossag DESC";



	$query = $db ->query($sql);
	$varosok = $query->fetchALL(PDO::FETCH_ASSOC);

	$query = $db ->query("SELECT *	FROM Naplobejegyzesek ");
	$naplobejegyzes = $query->fetchALL(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="hu">
    <head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>ZH</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
    <body>
		
		<header>
			<h1>Idojaras</h1>
			<p>Horvath Daniel, UNBY1Z</p>
		</header>
		<section>
			<table>
				<tr>
					<th>Nev</th>
					<th>Lakossag</th>
					<th>Atlaghomerseklet</th>
				</tr>
				<?php foreach($varosok as $varos):?>
					<tr class="varos">
						<td><?=$varos['Nev']?></td>
						<td><?=$varos['Lakossag']?></td>
						<td><?=round($varos['atlag'],2)?> °C</td>
					</tr>
					<tr>
						<td colspan="3">
							<ul>
								<?php $flag = 0;
									foreach($naplobejegyzes as $sor):
									if($sor['Varosok_idVarosok'] == $varos['idVarosok']){
										$flag++;
								?>
								<li><?=$sor['Datum']?>: <?=$sor['Homerseklet']?>°C </li>
								<?php } ?>
				
								<?php endforeach; ?>
								<?php 
									if($flag == 0):?>
										<li><i>Nincs adat</i></li>
									<?php endif;?>
							</ul>
						</td>
						
					</tr>
				<?php endforeach;?>
				
			</table>
		</secion>
		<aside>
			<h2>Homerseklet naplozas</h2>
			<form action="log.php" method="post">
				<label>Varos:</label>
				<select name="id">
					<?php foreach($varosok as $varos2):?> 
						<option value="<?=$varos2['idVarosok']?>"> <?=$varos2['Nev']?> </option>
						<?php endforeach; ?>
				</select><br><br>
				<label>Datum:</label>
				<input type="date" name="datum"> <br><br>
				<label>Homerseklet:</label>
				<input type="text" name="homerseklet"><br><br>
				<input type="submit" name="kuldes" value="Kuldes">
				<?php if($_SESSION['error']){?>
				<label>Kerem adjon meg datumot es homersekletet is, valamint valasszon egy varos!</label>
				<?php }?>
			</form>
		</aside>
        
    </body>
</html>
