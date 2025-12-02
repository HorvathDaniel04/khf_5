<?php
	require 'db.php';
	$db = getDb("mydb");

	$sql="SELECT Varos.*, AVG(Szallas.Ertekeles) as atlag
			FROM Varos
			LEFT JOIN Szallas ON Varos.idVaros = Szallas.Varos_idVaros
			GROUP BY Varos.idVaros
			HAVING atlag >= 4
			ORDER BY atlag DESC";


	$query = $db->query($sql);
	$varosok = $query->fetchALL(PDO::FETCH_ASSOC);

	$query = $db->query("SELECT * FROM Szallas");
	$szallasok = $query->fetchALL(PDO::FETCH_ASSOC);
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
			<h1>Szallasok</h1>
			<p>Horvath Daniel, UNBY1Z</p>
		</header>
		
		<section>
			<h2>Hol szeretnel megszallni?</h2>
			<form action="index.php" method="get">
				<select name="keres_id">
					<?php foreach ($varosok as $varos): ?>
					<option value="<?=$varos['idVaros']?>"><?=$varos['Nev']?> (<?=round($varos['atlag'], 2)?> atlagos ertekeles)</option>
					<?php endforeach;?>
				</select>
				<input type="submit" name="keres" value="Keres">
			</form>
		</section>
		<?php if(isset($_GET['keres'])){?>
		<section>
			<h2>Szallasok</h2>
			<?php foreach($szallasok as $szallas):?>
				<?php if($szallas['Varos_idVaros'] == $_GET['keres_id']){?>
			<article>
				<h3><?=$szallas['Nev']?> (<?=$szallas['Ertekeles']?>)</h3>
				<i><?=$szallas['Cim']?></i>
				<hr>
			</article>
					<?php }?>
			<?php endforeach; ?>
		</section>

		<section>
			<h2>Uj szallas felvetele</h2>
			<form action="">
				<label>Nev:</label>
				<input type="text" name="nev">
				<label>Cim:</label>
				<input type="text" name="cim">
				<label>Ertekeles:</label>
				<input type="text" name="ertekeles">
				<input type="submit" name="kuldes" value="Kuldes">

			</form>
		</section>
        <?php }?>
    </body>
</html>
