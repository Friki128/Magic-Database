<!DOCTYPE html>
<html>

<head>
    <title>Insertar</title>
    <?php
    require "includes/head.php";
    ?>
</head>

<body>
    <?php
    $nombre_personajev = $_POST["nombre_personaje"];
    $descripcionv = $_POST["descripcion"];
    $historiav = $_POST["historia"];
    $planov = $_POST["plano"];
    $query = "INSERT INTO Personaje (Nombre_Personaje, Descripcion, Historia, fkNombre_Plano) VALUES (\"$nombre_personajev\",\"$descripcionv\",\"$historiav\",\"$planov\");";
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

</html>