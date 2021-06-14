<?php
$switchable=$_GET["tabla"];
require "includes/lista_tabla.php";
require "includes/mysql.php";
$nombre_tablas="";
$b=1;
if (isset($_GET["multi"])){
$query="INSERT INTO ".$_GET["multi"]."_".$_GET["tabla"]." (fkNombre_".$_GET["multi"].",fkNombre_".$_GET["tabla"].") VALUES (\"".$_POST[$_GET["multi"]]."\",\"".$_GET["Filtro"]."\");";
$fail=mysqli_query($bbdd,$query);
if($fail){
    header("Location:Correcto.php");
   }
   else{
       echo $query;
    #$error=mysqli_error($bbdd);
    #header("Location:Fallo.php?error=".$error."");
   }
}
else{
if ($columnas[1][1]=="idAutor"||$columnas[1][1]=="idIlustracion"){
    $b=2;
}

for ($a = $b; $a < $columnas[0]; $a++) {
    if ($columnas[$a][0]!=2 && $columnas[$a][1]!="Imagen"){
        if ($columnas[$a][0]==1){
            
            if ($columnas[$a][1]=="Autor"||$columnas[$a][1]=="Ilustracion"){
                $columnas[$a][1]="fkid".$columnas[$a][1];
            }
            else{
                $columnas[$a][1]="fkNombre_".$columnas[$a][1];
            }
        }
    
    if ($a != $b && $columnas[$a-1][1]!="Imagen"){
        $nombre_tablas=$nombre_tablas.",";
        $valores_tablas=$valores_tablas.",";
    }
    $nombre_tablas=$nombre_tablas.$columnas[$a][1];
    $valores_tablas=$valores_tablas."\"".$_POST[$columnas[$a][1]]."\"";
}
if ($columnas[$a][1]=="Imagen"){
    $query="SELECT idIlustracion FROM Ilustracion";
    $results=mysqli_query($bbdd,$query);
    while($row=mysqli_fetch_assoc($results)){
        $file_newname=$row["idIlustracion"]+1;
    }
    $file=$_FILES['Imagen'];
    $file_name=$file['name'];
    $file_tmp=$file['tmp_name'];
    $file_size=$file['size'];
    $file_dest="/opt/lampp/htdocs/Magic_Final/img/".$file_newname.".jpg";
    $file_error=$file['error'];
    
   $error=move_uploaded_file($file_tmp, $file_dest);
}
$f=true;
if ($columnas[$a][1]==2){
    $f=false;
}
}

$query = "INSERT INTO ".$_GET["tabla"]." ($nombre_tablas) VALUES ($valores_tablas);";
$fail = mysqli_query($bbdd, $query);

if ($fail) {
    if($f){
  header("Location:Correcto.php");
    }
   
} else {
    $error = mysqli_error($bbdd);
    header("Location:Fallo.php?error=".$error."");
}

for ($a = $b; $a < $columnas[0]; $a++) {
if ($columnas[$a][0]==2 && isset($columnas[$a][1])){
    $num=$_GET[$columnas[$a][2]];
    for($c = 0; $c<$num; $c++){
        $valor=$columnas[$a][2].$c;
    $query="INSERT INTO ".$columnas[$a][2].$columnas[$a][3]." (fkNombre_".$columnas[$a][2].",fkNombre".$columnas[$a][3].") VALUES (\"".$_POST[$valor]."\",\"".$_POST[$columnas[1][1]]."\");";
   $fail=mysqli_query($bbdd, $query);
   if($fail){
    header("Location:Correcto.php");
   }
   else{
    $error=mysqli_error($bbdd);
    header("Location:Fallo.php?error=".$error."");
   }
}
}
}
}