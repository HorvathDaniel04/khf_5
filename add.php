<?php
	require 'db.php';
	$db = getDb("mintazh4");

	if(empty($_POST)) {
        echo"Nem kaptam használható adatot!";
        exit();
    }

    if(empty($_POST["varosid"])) {
        echo "Nem kaptam megfelelő ID-t!";
        exit();
    }
    $varosid = $_POST["varosid"];

    if(empty($_POST["nev"])) {
        echo "Nem írtál be nevet!";
        exit();
    }
    $nev = $_POST["nev"];

    if(empty($_POST["cim"])) {
        echo "Nem írtál be címet!";
        exit();
    }
    $cim = $_POST["cim"];

    if(empty($_POST["ertekeles"])) {
        echo "Nem írtál be értékelést!";
        exit();
    }

    if($_POST["ertekeles"]<1 || $_POST["ertekeles"]>5) {
        echo "Nem érvényes értékelés!";
    }
    $ertekeles = $_POST["ertekeles"];

    $statement = $db->prepare("SELECT * from varos where varosid = :varosid");
    $statement->bindParam("varosid", $varosid, PDO::PARAM_INT);
    $statement -> execute();

    if($statement->rowCount() === 0) {
        echo "Nem létezik ez a város!";
        exit();
    }

    $statement = $db->prepare("INSERT INTO szallas (nev, cim, ertekeles, varos2id) values (:nev, :cim, :ertekeles, :varosid)");
    $statement->bindParam("nev", $nev, PDO::PARAM_STR);
    $statement->bindParam("cim", $cim, PDO::PARAM_STR);
    $statement->bindParam("ertekeles", $ertekeles, PDO::PARAM_INT);
    $statement->bindParam("varosid", $varosid, PDO::PARAM_INT);
    $statement->execute();

    header("Location: index.php");
?>  