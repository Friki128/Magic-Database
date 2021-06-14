<!DOCTYPE html>
<html>

<head>
    <title>Insertar</title>
    <img src="img/INSERTAR.png"></img>
    <?php
    require "includes/head.php";
    ?>
</head>

<body>
    <?php
    $THISURL = "insertar_carta.php";
    require "includes/seleccion_tabla.php";
    ?>
    <?php
     if (isset($_GET["tabla"])) {
        $tabla = $_GET["tabla"];
        
    }
    if (isset($_GET["id"])) {
        $tabla = $_GET["id"];
        
    }
if (isset($tabla)) {
    $switchable = $tabla;
    require "includes/lista_tabla.php";
}
$adicionales="";

    for ($a = 1; $a < $columnas[0]; $a++) {
    if($columnas[$a][0]==2 ){
        if (isset($_POST[$columnas[$a][2]])){
            $adicionales=$adicionales."&".$columnas[$a][2]."=".$_POST[$columnas[$a][2]];
        }
    }
    }

    if (isset($_GET["tabla"])) {
        $tabla = $_GET["tabla"];
        $URL = "insertarapi_carta.php?tabla=".$_GET["tabla"].$adicionales;
    }
    if (isset($_GET["id"])) {
        $tabla = $_GET["id"];
        $URL = "editar.php?tabla=".$_GET["id"];
    }
    
    $control = 0;


    if (isset($columnas)) {
        echo "<div><img src=\"img/inserta.png\" height=\"40\"></img></div>";
        echo "<div><table align=\"Center\"><thead><tr><th>Tipo</th><th>Input</th></tr></thead><tbody>";
        echo "<form action=$URL method=\"POST\" enctype=\"multipart/form-data\">";
        for ($a = 1; $a < $columnas[0]; $a++) {
            $valor = "";
            if (isset($_GET["id"]) && $columnas[$a][0] == 0) {
                $query = "SELECT " . $columnas[$a][1] . " FROM " . $_GET["id"] . " WHERE " . $columnas[1][1] . "=\"" . $_GET["Filtro"] . "\";";
                $result = mysqli_query($bbdd, $query);
                $row = mysqli_fetch_assoc($result);
                $valor = $row[$columnas[$a][1]];
            }
            $nombre = "Nombre_" . $columnas[$a][1];
            switch ($columnas[$a][0]) {
                case 0:
                    echo "<tr>";
                    echo "<td>" . $columnas[$a][1] . "</td>
                <td><input type='" . $columnas[$a][2] . "' maxlength='" . $columnas[$a][3] . "' required value=\"" . addcslashes($valor, '"\\') . "\" name='" . $columnas[$a][1] . "' /></td>";
                    echo "</tr>";
                    break;
                case 1:
                    if (isset($_GET["id"])) {

                        $nombre2 = "fk" . $nombre;
                        $query = "SELECT $nombre2 FROM " . $_GET["id"] . " WHERE " . $columnas[1][1] . "=\"" . $_GET["Filtro"] . "\";";
                        $result = mysqli_query($bbdd, $query);
                        $row = mysqli_fetch_assoc($result);
                        $valor = $row[$nombre2];
                    }
                    $extra="fkNombre_";
                    $value=$nombre;
                    $Select=$value;
                    if($columnas[$a][1]=="Ilustracion"||$columnas[$a][1]=="Autor"){
                        $extra="fkid";
                        $value="idAutor";
                        $Select=$value.",".$nombre;
                    }
                    
                    echo "<tr><td>" . $columnas[$a][1] . "</td>
                <td><select name=".$extra . $columnas[$a][1] . ">";
                    $query = "SELECT $Select FROM " . $columnas[$a][1] . " ORDER BY $nombre";
                    $result = mysqli_query($bbdd, $query);
            
                    while ($row = mysqli_fetch_assoc($result)) {
                        if (isset($_GET["id"]) && $row[$nombre] == $valor) {
                            echo "<option value =\"$row[$value]\" selected> $row[$nombre]</option>";
                        } else {
                            echo "<option value =\"$row[$value]\"> $row[$nombre]</option>";
                        }
                    }
                    echo "</select></td></tr>";
                    break;
                case 2:
                   
                        $columnas[$a][1] = $_POST[$columnas[$a][2]];
                    
                    $control = 1;
                    $nombre = "Nombre_" . $columnas[$a][2];

                    for ($b = 0; $b < $columnas[$a][1]; $b++) {
                        echo "<tr><td>" . $columnas[$a][2] . "</td>
                   <td><select name=" . $columnas[$a][2] . $b.">";
                        $query = "SELECT $nombre FROM " . $columnas[$a][2] . " ORDER BY $nombre";
                        $result = mysqli_query($bbdd, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            
                                echo "<option value = \"$row[$nombre]\"> $row[$nombre]</option>";
                        }
                        echo "</select></td></tr>";
                    }
                    break;
            }
        }
        echo " <tr><td></td><td><button type=\"submit\">Submit</form></td></tr>
            </form>";
        echo "</tbody></table></div>";
    }

    if ($control == 1) {
        echo "<div><img src=\"img/PROPIEDADES_A_ANADIR.png\" height=\"40\"></img></div>";
        echo "<div><table align=\"Center\"><thead><tr><th>Tipo</th><th>Input</th></tr></thead><tbody>";
        echo "<form action=\"insertar_carta.php?tabla=$tabla\" method=\"POST\">";
        for ($a = 1; $a < $columnas[0]; $a++) {
            if ($columnas[$a][0] == 2) {
                echo "<tr>";
                echo "<td>" . $columnas[$a][2] . "</td>";
                echo "<td><input type=\"number\" name=" . $columnas[$a][2] . " value=\"0\"></td>";
                echo "</tr>";
            }
        }

        echo "<tr><td></td><td><button type=\"submit\">Submit</form></td></tr>";
        echo "</form>";
        echo "</tbody></table></div>";
    }

    ?>




</body>

</html>