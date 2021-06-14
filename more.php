<!DOCTYPE html>
<html>
<!-- Aquest es el document on arribas quan un proces ha sigut executat amb exit -->

<head>
    
    
    <?php
    require "includes/mysql.php";
   echo "<title>".$_GET["Filtro"]."</title>";
   echo "<div><img src=\"img/" . $_GET["id"] . ".png\" height=\"40\"></img></div>";
    $switchable=$_GET["id"];
    require "includes/lista_tabla.php";
    require "includes/head.php";
    echo "<div><h1>".$_GET["Filtro"]."</h1></div>";
    ?>
</head>

<body>
<?php
echo "<nav><ul><li><a href=\"eliminarapi.php?id=" . $_GET["id"] . "&Filtro=" . $_GET["Filtro"] . "\"><img src=\"img/eliminar.png\" height=\"50\"></img></a></li>";
echo "<li><a href=\"insertar_carta.php?id=" . $_GET["id"] . "&Filtro=" . $_GET["Filtro"] . "\"><img src=\"img/editar.png\" height=\"50\"></img></a></li></ul></nav>";
if ($_GET["id"]=="Carta"){
    $query="SELECT idIlustracion FROM Ilustracion WHERE fkNombre_Carta=\"".$_GET["Filtro"]."\"";
    $result=mysqli_query($bbdd,$query);
    echo "<div><table align=\"Center\"><thead><tr><th>Ilustraciones</th></tr></thead><tbody>";
    while($row=mysqli_fetch_assoc($result)){
    echo"<tr><td><img src=\"img/".$row["idIlustracion"].".jpg\" height=\"300\"></img></td></tr>";
    }
    echo"</tbody></table></div>";
}
$query="SELECT * FROM ".$_GET["id"]." WHERE ".$columnas[1][1]."=\"".$_GET["Filtro"]."\";";
$result=mysqli_query($bbdd,$query);
echo"<div><table class=\"conborde\" align=\"Center\"><thead><tr><th>Columna</th><th>Valor</th></tr></thead><tbody>";
while($row=mysqli_fetch_assoc($result)){
for ($a = 1; $a < $columnas[0]; $a++) {
    if ($columnas[$a][0] != 2 && $columnas[$a][1]!="Historia") {
        echo "<tr><td>".$columnas[$a][1]."</td>";
        if($columnas[$a][0]==1){
            
            if ($columnas[$a][1]=="Autor"||$columnas[$a][1]=="Ilustracion"){
                $columnas[$a][1]="fkid".$columnas[$a][1];
            }
            else{
                $columnas[$a][1]="fkNombre_".$columnas[$a][1];
            }
        }
        if ($columnas[$a][1] == "Imagen") {
            echo "<td><img src=\"img/" . $row[$columnas[1][1]] . ".jpg\" height=\"200\"></img></td>";
        } else {
            if ($columnas[$a][1] != "Historia") {
                echo "<td>" . $row[$columnas[$a][1]] . "</td>";
            }
        }
    echo "</tr>";
    }
}
}
echo "</tbody></table></div>";

for ($a = 1; $a < $columnas[0]; $a++) {
    if ($columnas[$a][0] == 2) {
        $query="SELECT fkNombre_".$columnas[$a][2]." FROM ".$columnas[$a][2].$columnas[$a][3]." WHERE fkNombre_".$_GET["id"]."=\"".$_GET["Filtro"]."\";";
        $result=mysqli_query($bbdd,$query);
        echo "<div><h1>".$columnas[$a][2]."</h1></div>";
        echo"<div><table class=\"conborde\" align=\"Center\">";
while($row=mysqli_fetch_assoc($result)){
    echo "<thead><tr><th>Eliminar</th><th>".$columnas[$a][2]."</th></tr></thead><tbody>";
    

        echo "<tr><td><a href=\"eliminarapi.php?combi=" . $columnas[$a][2].$columnas[$a][3] . "&Filtro1=" . $_GET["Filtro"] . "&Borrar1=fkNombre_".$_GET["id"]."&Filtro2=" . $row["fkNombre_".$columnas[$a][2]]."&Borrar2=fkNombre_".$columnas[$a][2]."\"><img src=\"img/eliminar.png\" height=\"30\"></img></a></td>";
        echo "<td>".$row["fkNombre_".$columnas[$a][2]]."</td>";
    echo "</tr>";
    
    }
    echo "</tbody></table></div><thead><tr><th></th></tr></thead><tbody>";
    echo "<div><table align=\"Center\"><form action=\"insertarapi_carta.php?tabla=".$_GET["id"]."&multi=".$columnas[$a][2]."&Filtro=".$_GET["Filtro"]."\" method=\"POST\"><td></tr><select name=".$columnas[$a][2].">";
    $query="SELECT Nombre_".$columnas[$a][2]." FROM ".$columnas[$a][2]." ORDER BY Nombre_".$columnas[$a][2].";";
    $result=mysqli_query($bbdd,$query);
    while($row=mysqli_fetch_assoc($result)){
        echo "<option value=\"".$row["Nombre_".$columnas[$a][2]]."\">".$row["Nombre_".$columnas[$a][2]]."</option>";
    }
    echo "</select></tr><tr><td><button type=\"submit\">Añadir</button></td></tr></tbody></form></table></div>";
}
}
for ($a = 1; $a < $columnas[0]; $a++) {
if ($columnas[$a][1]=="Historia"){
    $query="SELECT * FROM ".$_GET["id"]." WHERE ".$columnas[1][1]."=\"".$_GET["Filtro"]."\";";
    $result=mysqli_query($bbdd,$query);
    while($row=mysqli_fetch_assoc($result)){
echo "<div><table class=\"conborde\" align=\"Center\"><thead><tr><th>Historia</th></tr></thead><tbody><tr><td>".$row[$columnas[$a][1]]."</td></tr></tbody></table></div>";
    }
}
}
?>
</body>

</html>