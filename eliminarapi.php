
<?php
require "includes/mysql.php";
$columnas = array(13, "Autor", "Bloque", "Coleccion", "Coleccion_Carta", "Coleccion_Habilidad", "Habilidad", "Habilidad_Carta", "Ilustracion", "Personaje", "Plano", "Tipo", "Tipo_Carta");
if (isset($_GET["id"])){
if ($_GET["id"]=="Autor" || $_GET["id"]=="Ilustracion") {
    $extra="id";
}
else{
    $extra="Nombre_";
}

for ($a = 1; $a < $columnas[0]; $a++) {
    $query = "SELECT fk$extra" . $_GET["id"] . " FROM " . $columnas[$a] . " WHERE fk$extra" . $_GET["id"] . "=\"" . $_GET["Filtro"] . "\";";
    $fail = mysqli_query($bbdd, $query);
    
    if($fail) {
        $error = "No se puede eliminar porque existen tablas con informacion de esta.";
        header("Location:Fallo.php?error=" . $error);
    } 
    
}


    $query = "DELETE FROM " . $_GET["id"] . " WHERE ". $extra. $_GET["id"] . " = \"" . $_GET["Filtro"] . "\";";
    $fail = mysqli_query($bbdd, $query);
    if ($fail) {
        header("Location:Correcto.php");
    } else {
        $error=mysqli_error($bbdd);
        header("Location:Fallo.php?error=" . $error);
    }

}
else{
    $query="DELETE FROM ".$_GET["combi"]." WHERE ".$_GET["Borrar1"]."=\"".$_GET["Filtro1"]."\"&&".$_GET["Borrar2"]."=\"".$_GET["Filtro2"]."\";";
    $fail = mysqli_query($bbdd, $query);
    if ($fail) {
        header("Location:Correcto.php");
    } else {
        echo $query;
        $error=mysqli_error($bbdd);
        header("Location:Fallo.php?error=" . $error);
    }
}