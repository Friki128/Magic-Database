<!DOCTYPE html>
<html>

<head>
    <title>Taula</title>
    <?php
    require "includes/head.php";
    ?>
</head>

<body>
<form action="taula.php" method="GET">
        <label>Tabla</label>
        <select name="tabla">
            <option value=0>Autor</option>
            <option value=1>Bloque</option>
            <option value=2>Carta</option>
            <option value=3>Coleccion</option>
            <option value=4>Habilidad</option>
            <!--<option value = 5>Ilustracion</option>-->
            <option value=6>Personaje</option>
            <option value=7>Plano</option>
            <option value=8>Tipo</option>
        </select>
        <button type="submit">Elegir</button>


        <?php
    if (isset($_GET["tabla"])) {
        switch ($_GET["tabla"]) {
            case 1:
                $columnas = array("Bloque","Nombre_Bloque","Nombre_Plano",0);
                break;
            case 2:
                $columnas = array("Carta","Nombre_Carta","Rareza","Subtipo","Coste","Definicion","Nombre_Personaje",0);
                break;
            case 3:
                $columnas = array("Coleccion","Nombre_Coleccion","Fecha","Nombre_Bloque",0);
                break;
            case 4:
                $columnas = array("Habilidad","Nombre_Habilidad","Definicion");
                break;
                # case 5:
                #    $columnas=array(array());
                #   break;
            case 6:
                $columnas = array("Personaje","Nombre_Personaje","Descripcion","Historia","Nombre_Plano",0);
                break;
            case 7:
                $columnas = array("Plano","Nombre_Plano","Historia","Descripcion");
                break;
            case 8:
                $columnas = array("Tipo","Nombre_Tipo","Definicion");
                break;
            default:
                $columnas = array("Autor","idAutor","Nombre_Autor");
                break;
        }
    }
    ?>
<!--
    </form>
    <form action="taula.php" method="GET">
        <label>Nombre</label>
        <select name="filtro1">
            <?php
            #$query = "SELECT Nombre_Personaje FROM Personaje ORDER BY Nombre_Personaje";
            #$result = mysqli_query($bbdd, $query);
            #while ($row = mysqli_fetch_assoc($result)) {
            #    echo "<option value = \"$row[Nombre_Personaje]\"> $row[Nombre_Personaje]</option>";
            #}
            #$Where = "";
            #if (isset($_GET["filtro1"])) {
             #   $Where = "WHERE Nombre_Personaje=\"$_GET[filtro1]\"";
            #}
            ?>

        </select>
        <button type="submit">Submit</button>
    </form>
    -->
    <?php
    echo "<h1>".$columnas[0]."</h1>";
    ?>
    
    <table>
        <thead>
            <tr>
            <?php
            if (isset($columnas)){
            $control=0;
            echo "<th>Eliminar</th>";
                foreach($columnas as $columna){
                    if (!$columna==0 && !$control==0){
                    echo "<th>". $columna ."</th>";

                    }
                    $control=1;
                    if ($columna==0){
                        $numero=(count($columnas));
                        $numero-=2;
                        $columnas[$numero]="fk".$columnas[$numero];
                    }
                }
            }
            ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM ".$columnas[0]." $Where ORDER BY  ".$columnas[1].";";
            $result = mysqli_query($bbdd, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td><a href=\"eliminarapi.php?id=".$columnas[0]."&Filtro=".$row[$columnas[1]]."\">Eliminar</a></td>";
                foreach($columnas as $columna){
                    if (!$columna==0){
                        
                        echo "<td>".$row[$columna]."</td>";
                        }
        

        }
         echo "</tr>";
            }
            ?>
        </tbody>

    </table>
</body>

</html>