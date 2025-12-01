<?php
require 'db.php';
$db = getDb("mydb");

// 1. Ellenőrizzük, hogy a gombot nyomták-e meg
if (isset($_POST['kuldes'])) {

    // 2. Kimentjük az adatokat változókba a POST-ból
    $nev = $_POST['nev'];
    $szoveg = $_POST['szoveg'];
    $hir_id = $_POST['hir_id'];

    // 3. Validálás: Megnézzük, hogy kitöltöttek-e minden mezőt
    // A !empty() azt jelenti: "ha NEM üres"
    if (!empty($nev) && !empty($szoveg) && !empty($hir_id)) {

        // 4. SQL Előkészítése (Prepare)
        // A kérdőjelek (?) helyére kerülnek majd az adatok biztonságosan
        $sql = "INSERT INTO Hozzaszolasok (Szerzo, Szoveg, Hir_idHir) VALUES (?, ?, ?)";
        $stmt = $db->prepare($sql);

        // 5. Adatok kötése és Végrehajtás (Execute)
        // Itt küldjük be a tényleges adatokat a kérdőjelek helyére
        $stmt->execute([$nev, $szoveg, $hir_id]);

        // 6. Siker esetén visszairányítjuk a főoldalra
        header("Location: index.php");
        exit;

    } else {
        // 7. Hibaüzenet, ha valami üres volt
        echo "Hiba: Minden mezőt ki kell tölteni! <a href='index.php'>Vissza</a>";
    }

} else {
    // Ha valaki csak úgy megnyitja a fájlt (nem a gombbal jött)
    header("Location: index.php");
    exit;
}
?>