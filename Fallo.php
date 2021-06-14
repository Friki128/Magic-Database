<!DOCTYPE html>
<html>
<!-- Aquest es el document on arribas quan un proces no ha sigut executat amb exit -->

<head>
    <title>Error</title>
    <div><img src="img/ERROR.png"></img></div>
    <?php
    require "includes/head.php";
    ?>
</head>

<body>
    <?php
    #Mostram el error per pantalla que obtenem amb el metode GET
    echo "<div>".$_GET["error"]."</div>";
    ?>

</body>

</html>