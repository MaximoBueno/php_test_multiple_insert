<?php
//Nota: Estos errores solo se ven al no aplicar ningun ORM
//desplegar todos los errores de mysql al realizar pruebas
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$gcon = new mysqli(
    "localhost",
    "root",
    "",
    "ps_crud_max",
    3306
);

global $gcon;

function ejecutarConsulta($sql)
{
    global $gcon;

    limpiarMemoria();

    return $gcon->query($sql);
}

//Limpiar la memoria cuando un objeto o resultado se queda en la instancia del mysqli para evitar bloqueos de consulta.
function limpiarMemoria()
{
    global $gcon;

    while ($gcon->more_results()) {
        $gcon->next_result();
        if ($res = $gcon->store_result()) {
            $res->free();
        }
    }
}



echo "Global Conexion Test:<br>";

$miInsert = "INSERT INTO persona(nombre,telefono) VALUES('global_con_1','aaa'), ('global_con_1.5','bb');";
$miSP = "CALL sp_persona ('aa', 'bb');";

var_dump(ejecutarConsulta($miSP));
var_dump(ejecutarConsulta($miInsert));
