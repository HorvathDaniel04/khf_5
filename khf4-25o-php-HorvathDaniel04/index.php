<?php
session_start();

require 'db.php';
$db = getDb();

$query = $db->query("SELECT * FROM konyv");
$konyvek = $query->fetchALL(PDO::FETCH_ASSOC);

$query = $db->query("SELECT * FROM konyv_szerzo");
$konyv_szerzo = $query->fetchALL(PDO::FETCH_ASSOC);

$query = $db->query("SELECT * FROM tag");
$tagok = $query->fetchALL(PDO::FETCH_ASSOC);

$query = $db->query("SELECT * FROM szerzo");
$szerzok = $query->fetchALL(PDO::FETCH_ASSOC);

$query = $db->query("SELECT * FROM kolcsonzesek");
$kolcsonzesek = $query->fetchALL(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="hu">
    <head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Könyvtár</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
    <body>
        
        <h1>Könyvtár</h1>
        <?php if (isset($_GET['msg'])): 
                if ($_GET['msg'] == 'siker'): ?>
        <p style="color: red; font-weight: bold;">
            A(z) '<?= $_GET['id'] ?>' azonosítójú könyv sikeresen frissítve!
        </p>
            <?php elseif ($_GET['msg'] == 'nincs_ilyen_id'): ?>
        <p style="color: red; font-weight: bold;">
            HIBA: nincs '<?= $_GET['id'] ?>' azonosítójú könyv!
        </p>
            <?php endif; ?>
        <?php endif; ?>
        <table>
            <tr>
                <th>Cím</th>
				<th>Nyelv</th>
				<th>Ár</th>
				<th>Szerző(k)</th>  
                <th></th>
            </tr> 
             <?php foreach($konyvek as $konyv):?>
            <tr>
                
                <td><?=$konyv["cim"]?></td>
				<td><?=$konyv["nyelv"]?></td>
				<td><?=$konyv["ar"]?></td>
                <?php  $array = [];
                    foreach($szerzok as $szerzo):
                        foreach($konyv_szerzo as $k_sz): 
                            if($konyv["id"] == $k_sz["konyvid"] && $szerzo["id"] == $k_sz["szerzoid"]){
                                $array[] = $szerzo["vezeteknev"] . " " . $szerzo["keresztnev"];
				            };
                        endforeach;
                    endforeach;?>
                
                <td><?php echo implode(', ', $array);?>
                </td> 
                <td><a href="update.php?id=<?=$konyv["id"]?>">Szerkeszt</a></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>
