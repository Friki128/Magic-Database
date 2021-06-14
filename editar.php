<?php
$switchable=$_GET["tabla"];
require "includes/lista_tabla.php";
require "includes/mysql.php";
$nombre_tablas="";


for ($a = 2; $a < $columnas[0]; $a++) {
    if ($columnas[$a][0]!=2 && $columnas[$a][1]!="Imagen"){
        if ($columnas[$a][0]==1){
            
            if ($columnas[$a][1]=="Autor"||$columnas[$a][1]=="Ilustracion"){
                $columnas[$a][1]="fkid_".$columnas[$a][1];
            }
            else{
                $columnas[$a][1]="fkNombre_".$columnas[$a][1];
            }
        }
    
    if ($a != 2){
        $nombre_tablas=$nombre_tablas.",";
    }
    $nombre_tablas=$nombre_tablas.$columnas[$a][1]."='".$_POST[$columnas[$a][1]]."'";
}
}

$query = "UPDATE ".$_GET["tabla"]." SET $nombre_tablas WHERE ".$columnas[1][1]."=\"".$_POST[$columnas[1][1]]."\";";
$fail = mysqli_query($bbdd, $query);

if ($fail) {
   header("Location:Correcto.php");
} else {
   $error = mysqli_error($bbdd);
   header("Location:Fallo.php?error=".$error."");
}