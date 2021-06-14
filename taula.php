<!DOCTYPE html>
<html>

<head>
    <title>Tablas</title>
    <div><img src="img/TABLAS.png"></img></div>
    <?php
    require "includes/head.php";
    ?>
</head>

<body>


    <?php
    $THISURL = "taula.php";
    require "includes/seleccion_tabla.php";
    if (isset($_GET["tabla"])) {
        $switchable = $_GET["tabla"];
        require "includes/lista_tabla.php";
    }
    ?>
    <?php
    echo "<div><form action=\"taula.php?tabla=$_GET[tabla]\" method=\"POST\">";
    echo "<label>Filtro</label>";
    echo "<input type=\"text\" required name=\"filtro1\">";
    ?>
    <button type="submit">Submit</button>
    </form></div>
    <?php
    $b=1;
     if (isset($_GET["tabla"]) && $_GET["tabla"]=="Autor") {
        $b=2;
    }
    $Where = "";
    if (isset($_POST["filtro1"])) {
        $Where = "WHERE " . $columnas[$b][1] . "=\"$_POST[filtro1]\"";
    }
    if (isset($_GET["tabla"])){
    echo "<div><img src=\"img/" . $_GET["tabla"] . ".png\" height=\"40\"></img></div>";
    }
    ?>

    <div><table class="conborde" align="center">
        <thead>
            <tr>
                <?php
                if (isset($columnas)) {

                    echo "<th>Eliminar</th>";
                    echo "<th>Editar</th>";
                    echo "<th>More</th>";
                    for ($a = 1; $a < $columnas[0]; $a++) {
                        if ($columnas[$a][0] != 2 && $columnas[$a][1] != "Historia") {
                            
                                echo "<th>" . $columnas[$a][1] . "</th>";
                            if ($columnas[$a][0] == 1 && ($columnas[$a][1]=="Autor" || $columnas[$a][1]=="Ilustracion")){
                                $columnas[$a][1]="fkid".$columnas[$a][1];
                            }
                            else if ($columnas[$a][0] == 1){
                                $columnas[$a][1]="fkNombre_".$columnas[$a][1];
                            }
                        }
                    }
                }

                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM " . $_GET["tabla"] . " $Where ORDER BY  " . $columnas[1][1] . ";";
            $result = mysqli_query($bbdd, $query);
            while ($row = mysqli_fetch_assoc($result)) {


                echo "<tr>";
                echo "<td><a href=\"eliminarapi.php?id=" . $_GET["tabla"] . "&Filtro=" . $row[$columnas[1][1]] . "\"><img src=\"img/eliminar.png\" height=\"30\"></img></a></td>";
                echo "<td><a href=\"insertar_carta.php?id=" . $_GET["tabla"] . "&Filtro=" . $row[$columnas[1][1]] . "\"><img src=\"img/editar.png\" height=\"30\"></img></a></td>";
                echo "<td><a href=\"more.php?id=" . $_GET["tabla"] . "&Filtro=" . $row[$columnas[1][1]] . "\"><img src=\"img/see.png\" height=\"30\"></img></a></td>";
                for ($a = 1; $a < $columnas[0]; $a++) {
                    if ($columnas[$a][0] != 2) {
                        if ($columnas[$a][1] == "Imagen") {

                            echo "<td><img src=\"img/" . $row[$columnas[1][1]] . ".jpg\" height=\"200\"></img></td>";
                        } else {
                            if ($columnas[$a][1] != "Historia") {
                                echo "<td>" . $row[$columnas[$a][1]] . "</td>";
                            }
                        }
                    }
                }
                echo "</tr>";
            }
            ?>
        </tbody>

    </table></div>
</body>

</html>