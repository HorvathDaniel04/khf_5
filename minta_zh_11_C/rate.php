<?php
    session_start();
	require 'db.php';
	$db = getDb("mydb");

    $query = $db->query("SELECT * FROM Filmek");
	$filmek = $query -> fetchALL(PDO::FETCH_ASSOC);


    if(isset($_POST['kuldes'])){
        $szerzo = $_POST['name'];
        $pontszam = $_POST["pontszam"];
        $id = $_POST["id"];
        if(!empty($szerzo) && !empty($pontszam)){
            $flag_pontszam = false;
            $flag_film = false;
            if($pontszam<=5 && $pontszam>=1 && is_numeric($pontszam)){
                $flag_pontszam = true;
            }
            foreach($filmek as $film){
                if($film['idFilmek'] == $id){
                    $flag_film = true;
                }
            }
            if($flag_film && $flag_pontszam){
                $query = "INSERT INTO Ertekeles (Szerzo, Pontszam, Filmek_idFilmek) 
                            VALUES(:szerzo, :pontszam, :id);";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':szerzo', $szerzo);
                $stmt->bindParam(':pontszam', $pontszam);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $_SESSION['error'] = false;
                header("Location: index.php");
                exit;
            }
            else{
                $_SESSION['error'] = true;
                header("Location: index.php");
                exit;
            }
        }
        else{
            $_SESSION['error'] = true;
            header("Location: index.php");
            exit;
        }

    }
    else{
        header("Location: index.php");
        exit;
    }

?>