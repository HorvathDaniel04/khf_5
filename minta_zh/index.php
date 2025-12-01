<?php
	require 'db.php';
	$db = getDb("mydb");

	$sql = "SELECT Hir.*, COUNT(Hozzaszolasok.idHozzaszolasok) as hsz_szam 
        FROM Hir 
        LEFT JOIN Hozzaszolasok ON Hir.idHir = Hozzaszolasok.Hir_idHir
        WHERE Hir.Datum > '2024-01-01'
        GROUP BY Hir.idHir
        ORDER BY Hir.Datum DESC";

	$query = $db->query($sql);
	$hirek = $query->fetchALL(PDO::FETCH_ASSOC);

	$query = $db->query("Select * from Hozzaszolasok");
	$hozzaszolasok = [];

	while($row = $query->fetch(PDO::FETCH_ASSOC)){
		$hozzaszolasok[$row["Hir_idHir"]][] = $row;
	}
	//var_dump($hirek);
	//var_dump($hozzaszolasok);
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
			<h1><strong> Hírek </strong></h1>
			<p>Horvath Daniel, UNBY1Z</p>
		</header>
		<main>
			<section>
				<?php foreach($hirek as $hir):?>
				<article>
					<h1> <?=$hir["CIm"]?>	</h1>
					<i> <?=$hir["Datum"] ?></i>
					<p> <?=$hir["Szoveg"] ?></p>
					<h3> <?=$hir["hsz_szam"] ?> hozzászólás</h3>
					<?php if(isset($hozzaszolasok[$hir["idHir"]])){ ?>
					<ul>
						<?php foreach($hozzaszolasok[$hir["idHir"]] as $hsz): ?>
						<li>
							<strong>  <?=$hsz["Szerzo"] ?>  </strong>: <?=$hsz["Szoveg"] ?>
						</li>
						<?php endforeach; ?>
					</ul>
					<?php } 
						else{
							echo "<p><i>Nincs hozzászólás</i><p>";
						}?>
					
					<form action="comment.php" method="post">
						<input type="hidden" name="hir_id" value="<?= $hir['idHir'] ?>">
						<label>Név:</label><br>
						<input type="text" name="nev"><br><br>
						<label>Szöveg:</label><br>
						<textarea name="szoveg"></textarea> <br><br>
						<input type="submit" name="kuldes" value="Küldés">
					</form>
					<hr>
				</article>
				<?php endforeach; ?>


		</main>
    </body>
</html>
