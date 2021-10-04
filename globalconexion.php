<?php

$gcon = new mysqli("localhost",
        "root", 
        "",
        "ps_crud_max",
        3306);

global $gcon;

function ejecutarConsulta($sql){
    global $gcon;
    return $gcon->query($sql);
}

echo "Global Conexion Test:<br>";
var_dump(ejecutarConsulta("INSERT INTO persona(nombre,telefono) VALUES('global_con_1','aaa'),('global_con_1.5','aaa');"));
var_dump(ejecutarConsulta("INSERT INTO persona(nombre,telefono) VALUES('global_con_1','bb');"));

?>