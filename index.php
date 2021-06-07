<!DOCTYPE html>
<html>

<head>
    <title>Magic DB</title>
    <h1>Magic DB</h1>
    <?php
    require "includes/head.php";
    ?>
</head>

<body>
    
    <?php
    if (!$bbdd) {
        echo "Error";
        print(mysqli_connect_error());
    }
    ?>
    

</body>

</html>