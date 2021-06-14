<?php
#fem conexion amb la nostra base de dades creant una variable que representi la mateixa.
$host = "localhost";
$database = "Magic_BD";
$user = "root";
$password = "";
$bbdd = mysqli_connect($host, $user, $password, $database);
