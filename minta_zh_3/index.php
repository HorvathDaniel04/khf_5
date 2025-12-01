<?php
	require 'db.php';
	$db = getDb("mydb");

	$sql = ("SELECT Hirek.*
							FROM Hirek
							WHERE Hirek.Datum > '2024-01-01'
							ORDER BY Hirek.Datum DESC");

	//$query = $db -> query("SELECT * FROM Hirek");

	$query = $db -> query($sql);
	$hirek = $query -> fetchALL(PDO::FETCH_ASSOC);

	$query = $db -> query("SELECT * FROM Hozzaszolas");
	$hozzaszolasok = $query -> fetchALL(PDO::FETCH_ASSOC);

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
			<h1>Hirek</h1>
			<p> Minta Bela, NEPTUN
		</header>

		<main>
			<section>
				<?php foreach($hirek as $hir):?>
					<?php 
						$hsz_szam = 0;
						foreach($hozzaszolasok as $hsz){
							if($hir['idHirek'] == $hsz['Hirek_idHirek']){
								$hsz_szam++;
							}
						}
						?>
				<article>
					<h2><?=$hir['Cim']?></h2>
					<i><?=$hir['Datum']?></i>
					<p><?=$hir['Szoveg']?></p>
					<h3><?=$hsz_szam?> hozzaszolas</h3>
					<ul>
						<?php  $flag=0;
								foreach($hozzaszolasok as $hozzaszolas):?>
							<?php if($hir['idHirek'] == $hozzaszolas['Hirek_idHirek']){?>
						<li><strong><?=$hozzaszolas['Szerzo']?>:</strong><?=$hozzaszolas['Szoveg']?></li>
						<?php	$flag++;
								 }?>
						<?php endforeach;?>
						<?php if($flag == 0){?>
							<p>Nincsen komment!</p>
							<?php }?>
					</ul>
					<h3>Uj hozzaszolas irasa</h3>
					<form action="comment.php" method="post">
						<input type="hidden" name="hsz_id" value=<?=$hir['idHirek']?>>
						<label>Nev:</label><br>
						<input type="text" name="nev"><br>
						<label>Szoveg:</label><br>
						<textarea rows="2" name="szoveg"></textarea><br>
						<input type="submit" name="kuldes" value="Kuldes">
						<hr>
					</form>

				</article>
				<?php endforeach;?>

			</section>

		</main>
        
    </body>
</html>
