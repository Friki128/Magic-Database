<!DOCTYPE html>
<head>
<title>Error</title>
    <?php
    require "includes/head.php";
    ?>
</head>
<body>
<?php


$query="DELETE FROM ".$_GET["id"]." WHERE Nombre_".$_GET["id"]." = \"".$_GET["Filtro"]."\";";

$fail=mysqli_query($bbdd, $query);
    if ($fail){
        header("Location:Correcto.php");
    }
    else{
        $error=mysqli_error($bbdd);
        header("Location:Fallo.php?error=".$error."");
    }
?>

</body>
