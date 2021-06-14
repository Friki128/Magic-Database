<!DOCTYPE html>
<html>
<!-- Pagina principal del nostre projecte final -->
<head>
    <container>
    <title>Magic DB</title>
    <div><img src="img/MAGIC_DB.png"></img></div>
    <?php
    require "includes/head.php";
    ?>
    </container>
</head>

<body>

<div><a>En Magic DB podemos insertar contenido a las tablas, editarlo, borrarlo, o visualizarlo.</a></div>
<div><img src="img/Eleshnor.png"></img></div>
    <?php
    #En cas de que no puguesim conectar-nos a la nostra base de datos aquest condicional mostrara el error per pantalla.
    if (!$bbdd) {
        echo "<div>Error</div>";
        print(mysqli_connect_error());
    }
    ?>


</body>

</html>