<?php
    session_start();
	require 'db.php';
	$db = getDb("mydb");

    $query = $db ->query("SELECT * FROM Varosok");
	$varosok = $query->fetchALL(PDO::FETCH_ASSOC);
    if(isset($_POST['kuldes'])){
        $datum=$_POST['datum'];
        $homerseklet=$_POST['homerseklet'];
        $varos=$_POST['id'];
        
        $flag=0;
        foreach($varosok as $v){
            if($v['idVarosok'] == $varos){
                $flag = 1;
            }
        }

        if(!empty($datum) && !empty($homerseklet) && $flag==1){
           $sql = "INSERT INTO Naplobejegyzesek (Datum, Homerseklet, Varosok_idVarosok) VALUES(:datum, :homerseklet, :varosid)";
           $stmt = $db->prepare($sql);
            $stmt->bindParam(':datum', $datum);
            $stmt->bindParam(':homerseklet', $homerseklet);
            $stmt->bindParam(':varosid', $varos);
            $stmt->execute();
            $_SESSION['error'] = false;
            header("Location: index.php");
            exit;
        }
        else{
            $_SESSION['error'] = 'true';
            header("Location: index.php");
            exit;
        }
    }

    else{
        header("Location: index.php");
        exit;
    }
?>