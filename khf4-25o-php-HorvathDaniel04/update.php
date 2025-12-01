<?php

session_start();

include 'db.php';
$db = getDb();

$error_cim = false;
$error_nyelv = false;
$error_ar = false;

if(isset($_POST['szerkeszt']) && !empty($_POST['cim']) && !empty($_POST['nyelv']) && !empty($_POST['ar']) ){
    $id = $_POST['id'];
    $nyelv = $_POST['nyelv'];
    $ar = $_POST['ar'];
    $cim = $_POST['cim'];

    $sql = "UPDATE konyv SET cim = :cim, nyelv = :nyelv, ar = :ar WHERE id = :id";

    $stmt = $db->prepare($sql);
    $stmt -> execute([':cim' => $cim, ':nyelv' => $nyelv, ':ar' => $ar, ':id' => $id]);

    header("Location: index.php?msg=siker&id=$id");
    exit;
}
if(isset($_POST['szerkeszt'])){
    $id = $_POST['id'];
    $nyelv = $_POST['nyelv'];
    $ar = $_POST['ar'];
    $cim = $_POST['cim'];
    if(empty($cim)){
        $error_cim =1;
    }
    if(empty($nyelv)){
        $error_nyelv =1;
    }
    if(empty($ar)){
        $error_ar    =1;
    }

    $konyv = [
            'id' => $id,
            'cim' => $cim,
            'nyelv' => $nyelv,
            'ar' => $ar
        ];
}
if(!isset($konyv)){
    if (!isset($_GET['id'])) {
        header("Location: index.php");
        exit;
    }

    $id = $_GET['id'];
    $stmt = $db->prepare("SELECT * FROM konyv WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $konyv = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$konyv) {
        header("Location: index.php?msg=nincs_ilyen_id&id=$id");
        exit;
    }
}

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
        <form action="update.php" method="post">
            <h1>Könyv szerkesztése</h1>
            <!-- TODO: form további részei -->
             <input type="hidden" name="id" value="<?=$konyv['id']?>">
             <label><strong>Cim:</strong></label>
             <input type="text" name="cim" value="<?=$konyv['cim']?>">
             <?php if ($error_cim): ?>
                     <div class="message"><?php echo "A cim megadasa kotelezo!"; ?></div>
             <?php endif; ?>
             <label><strong>Nyelv:</strong></label>
             <input type="text" name="nyelv" value="<?=$konyv['nyelv']?>">
             <?php if ($error_nyelv): ?>
                     <div class="message"><?php echo "A nyelv megadasa kotelezo!"; ?></div>
             <?php endif; ?>
             <label><strong>Ar:</strong></label>
             <input type="number" name="ar" value="<?=$konyv['ar']?>">
             <?php if ($error_ar): ?>
                     <div class="message"><?php echo "Az ar megadasa kotelezo!"; ?></div>
             <?php endif; ?>
             <input type="submit" name="szerkeszt" value="szerkeszt">
        </form>
    </body>
</html>