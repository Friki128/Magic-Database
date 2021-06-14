<?php
echo "<div>";
#Formulari on pots seleccionar la taula amb la que vols treballar.
echo "<form action=$THISURL method=\"GET\">
        <label>Tabla</label>
        <select name=\"tabla\">
        <option value=\"Autor\">Autor</option>
            <option value=\"Bloque\">Bloque</option>
            <option value=\"Carta\">Carta</option>
            <option value=\"Coleccion\">Coleccion</option>
            <option value=\"Habilidad\">Habilidad</option>
            <option value=\"Ilustracion\">Ilustracion</option>
            <option value=\"Personaje\">Personaje</option>
            <option value=\"Plano\">Plano</option>
            <option value=\"Tipo\">Tipo</option>
        </select>
        <button type=\"submit\">Elegir</button>

    </form></div>";
    ?>