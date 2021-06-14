<?php
#Taula on es comproba quina taula s'ha d'aplicar.
switch ($switchable) {
    case "Bloque":
        $columnas = array(3, array(0, "Nombre_Bloque", "text", "30"), array(1, "Plano", "text", "30"));
        break;
    case "Carta":
        $columnas = array(10, array(0, "Nombre_Carta", "text", "50"), array(0, "Rareza", "number", "5"), array(0, "Subtipo", "text", "50"), array(0, "Coste", "text", "40"), array(0, "Definicion", "text", "100"), array(1,"Personaje", "text", "30"), array(2,0,"Coleccion", "_Carta"), array(2,0,"Habilidad","_Carta"), array(2,0,"Tipo","_Carta"));
        break;
    case "Coleccion":
        $columnas = array(4, array(0, "Nombre_Coleccion", "text", "30"), array(0, "Fecha", "text", "10"), array(1, "Bloque", "text", "30"));
        break;
    case "Habilidad":
        $columnas = array(4, array(0, "Nombre_Habilidad", "text", "30"), array(0, "Definicion", "text", "255"), array(2,0,"Coleccion","_Habilidad"));
        break;
    case "Ilustracion":
        $columnas=array(6,array(4,"idIlustracion","number","30"),array(0,"Imagen","file","30 accept=\"image/jpg\""),array(0, "Fecha_Ilustracion", "date", "30"), array(1,"Autor", "text", "30"), array(1, "Carta", "text", "30"));
        break;
    case "Personaje":
        $columnas = array(5, array(0, "Nombre_Personaje", "text", "30"), array(0, "Descripcion", "text", "255"), array(0, "Historia", "text", "255"), array(1, "Plano", "text", "30"));
        break;
    case "Plano":
        $columnas = array(4, array(0, "Nombre_Plano", "text", "30"), array(0, "Historia", "text", "255"), array(0, "Descripcion", "text", "255"));
        break;
    case "Tipo":
        $columnas = array(3, array(0, "Nombre_Tipo", "text", "20"), array(0, "Definicion", "text", "255"));
        break;
    default:
        $columnas = array(3,array(4,"idAutor","number","30"),array(0, "Nombre_Autor", "text", "30"));
        break;
}