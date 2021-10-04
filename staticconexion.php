<?php
//Credenciales
class mysql_login{
    protected $servidor;
    protected $usuario;
    protected $contrasenia;
    protected $basedatos;
    protected $puerto;

    public function __construct(){
        $this->servidor="localhost";
        $this->usuario="root";
        $this->contrasenia="";
        $this->basedatos="ps_crud_max";
        $this->puerto=3306;
    }
}

//Wrapper
class database extends mysql_login{


    private static $mi_mysqlicon;

    public static function getInstance() {
        if(!self::$mi_mysqlicon) { // If no instance then make one
            
            $parametros = new mysql_login();

            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

            self::$mi_mysqlicon = new mysqli($parametros->servidor,
                $parametros->usuario, 
                $parametros->contrasenia,
                $parametros->basedatos,
                $parametros->puerto);

            self::$mi_mysqlicon->set_charset('utf8');


            
        }

        return self::$mi_mysqlicon;
    }

}


$midb = database::getInstance();

echo "Static Conexion Test:<br>";
var_dump($midb->query("INSERT INTO persona(nombre,telefono) VALUES('static_con_1','aaa'),('static_con_1.5','aaa');"));
var_dump($midb->query("INSERT INTO persona(nombre,telefono) VALUES('static_con_2','bbb');"));


?>