<!DOCTYPE html>
<html>

<head>
    <title>Insertar</title>
    <h1>Insertar</h1>
    <?php
    require "includes/head.php";
    ?>
</head>

<body>
    <form action="insertar_carta.php" method="GET">
        <label>Tabla</label>
        <select name="tabla">
            <option value=0>Autor</option>
            <option value=1>Bloque</option>
            <option value=2>Carta</option>
            <option value=3>Coleccion</option>
            <option value=4>Habilidad</option>
            <option value=5>Ilustracion</option>
            <option value=6>Personaje</option>
            <option value=7>Plano</option>
            <option value=8>Tipo</option>
        </select>
        <button type="submit">Elegir</button>

    </form>
    <?php
    if (isset($_GET["tabla"])) {
        switch ($_GET["tabla"]) {
            case 1:
                $columnas = array(3, array(0, "Nombre_Bloque", "text", "30"), array(1, "Plano", "text", "30"));
                break;
            case 2:
                $columnas = array(10, array(0, "Nombre_Carta", "text", "50"), array(0, "Rareza", "number", "5"), array(0, "Subtipo", "text", "50"), array(0, "Coste", "text", "40"), array(0, "Definicion", "text", "100"), array(1,"Personaje", "text", "30"), array(2,0,"Coleccion", "_Carta"), array(2,0,"Habilidad","_Carta"), array(2,0,"Tipo","_Carta"));
                break;
            case 3:
                $columnas = array(4, array(0, "Coleccion", "text", "30"), array(0, "Fecha", "text", "10"), array(1, "Bloque", "text", "30"));
                break;
            case 4:
                $columnas = array(4, array(0, "Nombre_Habilidad", "text", "30"), array(0, "Definicion", "text", "255"), array(2,"Coleccion","_Habilidad"));
                break;
                case 5:
                $columnas=array(4,array(0, "Fecha", "date", "30"), array(1,"Autor", "text", "30"), array(1, "Bloque", "text", "30"));
                break;
            case 6:
                $columnas = array(5, array(0, "Nombre_Personaje", "text", "30"), array(0, "Descripcion", "text", "255"), array(0, "Historia", "text", "255"), array(1, "Plano", "text", "30"));
                break;
            case 7:
                $columnas = array(4, array(0, "Nombre_Plano", "text", "30"), array(0, "Historia", "text", "255"), array(0, "Descripcion", "text", "255"));
                break;
            case 8:
                $columnas = array(3, array(0, "Nombre_Tipo", "text", "20"), array(0, "Definicion", "text", "255"));
                break;
            default:
                $columnas = array(2, array(0, "Nombre_Autor", "text", 30));
                break;
        }
    }
$control=0;


    if (isset($columnas)) {
        echo "<h1>Inserta</h1>";
        echo "<form action=\"insertarapi_carta.php\" method=\"POST\">";
        for ($a = 1; $a < $columnas[0]; $a++) {
            $nombre = "Nombre_" . $columnas[$a][1];
            switch ($columnas[$a][0]) {
                case 0:
                    echo "<label>" . $columnas[$a][1] . "</label>
                <input type=" . $columnas[$a][2] . " maxlength=" . $columnas[$a][3] . " required name=" . $columnas[$a][1] . " />";
                    break;
                case 1:
                    echo "<label>" . $columnas[$a][1] . "</label>
                <select name=" . $columnas[$a][1] . ">";
                    $query = "SELECT $nombre FROM " . $columnas[$a][1] . " ORDER BY $nombre";
                    $result = mysqli_query($bbdd, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value = $row[$nombre]> $row[$nombre]</option>";
                    }
                    echo "</select>";
                    break;
                    case 2:
                   $control=1;
                   $nombre = "Nombre_" . $columnas[$a][2];
                   $columnas[$a][1]=$_POST["".$columnas[$a][2].""];
                   for ($b=0;$b<$columnas[$a][1];$b++){
                   echo "<label>" . $columnas[$a][2] . "</label>
                   <select name=" . $columnas[$a][2] . ">";
                       $query = "SELECT $nombre FROM " . $columnas[$a][2] . " ORDER BY $nombre";
                       $result = mysqli_query($bbdd, $query);
                       while ($row = mysqli_fetch_assoc($result)) {
                           echo "<option value = $row[$nombre]> $row[$nombre]</option>";
                       }
                       echo "</select>";
                    }
                    break;
            }
        }
        echo " <button type=\"submit\">Submit</button>
            </form>";
    }
if ($control==1){
echo "<form action=\"insertar_carta.php?tabla=$_GET[tabla]\" method=\"POST\">";
echo "<h1>Propiedades a añadir</h1>";
for ($a=1;$a<$columnas[0];$a++){
if ($columnas[$a][0]==2){
    echo "<label>".$columnas[$a][2]."</label>";
    echo"<input type=\"number\" name=".$columnas[$a][2]." value=\"0\">";
}
}
echo "<button type=\"submit\">Submit</form>";
}

    ?>
    
    
    
    
</body>

</html>