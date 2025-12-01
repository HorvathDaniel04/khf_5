<?php
	session_start();
	require 'db.php';
	$db = getDb("mydb");

	$sql = "SELECT Filmek.*, AVG(Ertekeles.Pontszam) as atlag, COUNT(Ertekeles.Pontszam) as valasz_db
			FROM Filmek
			LEFT JOIN Ertekeles ON Filmek.idFilmek = Ertekeles.Filmek_idFilmek
			WHERE Filmek.Ev > 2000
			GROUP BY Filmek.idFilmek
			ORDER BY Filmek.Ev";

	$query = $db->query($sql);
	$filmek = $query -> fetchALL(PDO::FETCH_ASSOC);

	$query = $db->query("SELECT * FROM Ertekeles");
	$ertekelesek = $query -> fetchALL(PDO::FETCH_ASSOC);
	
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
			<h1>Filmek</h1>
			<p>Horvath Daniel, UNBY1Z</p>
		</header>
		<section>
			<?php foreach($filmek as $film){?>
			<?php $flag = 0;?>
					<article class="filmek">
						<h2><?=$film['Cim']?></h2>
						<i><?=$film['Ev']?></i>
						<p><strong>Ertekeles: </strong><?=round($film['atlag'], 2)?> (<?=$film['valasz_db']?> valasz)</p>
						<ul>
							<?php foreach($ertekelesek as $ertekeles){?>
								<?php if($ertekeles['Filmek_idFilmek'] == $film['idFilmek']){?>
								<?php $flag++; ?>
							<li><strong><?=$ertekeles['Szerzo']?>:</strong><?=$ertekeles['Pontszam']?>/5</li>
							<?php }?>
							<?php }?>
						</ul>
							<?php if($flag == 0){?>
						<p>Nincs ertekeles</p>
							<?php }?>
						
					</article>
				<?php } ?>
		</section>
		<section>
			<article>
				<h2>Ertekeles</h2>
				<form action="rate.php" method="post">
					<label>Film:</label>
					<select name="id">
						<?php foreach($filmek as $f):?>
						<option value="<?=$f['idFilmek']?>"><?=$f['Cim']?></option>
						<?php endforeach?>
					</select><br><br>
					<label>Nev:</label>
					<input type="text" name="name"><br><br>
					<label>Pontszam:</label>
					<input type="number" name="pontszam"><br><br>
					<input type="submit" name="kuldes" value="Kuldes">
				</form>
				<?php if($_SESSION['error']){?>
					<p>Nem jo input!</p>
				<?php	}?>
			</article>
		</section>
    </body>
</html>
