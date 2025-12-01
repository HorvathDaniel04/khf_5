<?php
	require 'db.php';
	$db = getDb("mydb");
if(isset($_POST['kuldes'])){

        $nev = $_POST['nev'];
        $szoveg =$_POST['szoveg'];
        $hsz_id = $_POST['hsz_id'];
        
    if(!empty($nev) && !empty($szoveg) && !empty($hsz_id)){
        
        $query = "INSERT INTO Hozzaszolas (Szerzo, Szoveg, Hirek_idHirek) VALUE(:nev, :szoveg, :hsz_id)";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':nev', $nev);
        $stmt->bindParam(':szoveg', $szoveg);
        $stmt->bindParam(':hsz_id', $hsz_id);
        $stmt->execute();
        header("Location: index.php");
        exit;
    }

    else{
        echo "Kerem toltse ki a Nev es a Szoveg mezot is egy letezo cikknel!  <a href='index.php'>Vissza a fooldalra</a>";
    }
}
else{
     header("Location: index.php");
     exit;
}
?>