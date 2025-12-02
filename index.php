<?php
	require 'db.php';
	$db = getDb("mintazh4");

	$result = $db->query("select v.*, avg(sz.ertekeles) as atlag
			from varos v left outer join szallas sz
			on sz.varos2id = v.varosid
			group by v.varosid
			having avg(sz.ertekeles) > 2.0
			order by avg(sz.ertekeles) desc");
	$varosok = $result -> fetchAll(PDO::FETCH_ASSOC);

	$result2 = $db->query("SELECT * from szallas");
	$szallasok = [];
	while ($row = $result2->fetch(PDO::FETCH_ASSOC)) {
		$szallasok[$row['varos2id']][] = $row;
	}

	$kivalasztott = null;

	if(isset($_GET['varos'])) {
		$kivalasztott = $_GET['varos'];
	} elseif (!empty($varosok)) {
      
        $kivalasztott = $varosok[0]['varosid'];
	}
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
			<h1>Szállások</h1>
			<div>Mózes Boglárka, PCA3MF</div>
		</header>
        
		<main>
			<section>
				<h2>Hol szeretnél megszállni?</h2>
				<form method="get">
					
					<select  id="varos" name="varos">
						<?php foreach ($varosok as $varos):	?>
						<option value="<?= $varos['varosid']?>"><?= $varos['nev'] ?> (<?= $varos['atlag'] ?> átlagos értékelés)</option>
						<?php endforeach?>
					</select>
				
					<input type="submit" value="Keres">
				</form>
			</section>
			<section>
				<h2>Szállások</h2>
				
				<?php if (isset($szallasok[$kivalasztott])):?>	
				<?php foreach ($szallasok[$kivalasztott] as $szallas):	?>
					<h4> <?= $szallas['nev'] ?> (<?= $szallas['ertekeles'] ?>)</h4>
					<i><?= $szallas['cim'] ?></i>
					<hr>
					<?php endforeach?>
				<?php else:?>
					<i>Nincs szállás!</i>	
				<?php endif?>
	
				
			</section>
			<section>
				<h2>Új szállás felvétele</h2>
				<form action="add.php" method="post">
					<label for="nev">Név:</label>
					<input type="text" name="nev" id="nev">

					<label for="cim">Cím:</label>
					<input type="text" name="cim" id="cim">

					<label for="ertekeles">Értékelés:</label>
					<input type="text" name="ertekeles" id="ertekeles">

					<input type="submit" name="kuld" value="Küldés">
					<input type="hidden" id="varosid" name="varosid" value="<?= $kivalasztott ?>">
				</form>
			</section>
		</main>
    </body>
</html>
