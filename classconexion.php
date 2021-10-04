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

    protected $mi_servidor;
    protected $mi_usuario;
    protected $mi_contrasenia;
    protected $mi_basedatos;
    protected $mi_puerto;

    private $mi_mysqlicon;

    public function __construct() {
        $parametros = new mysql_login();
        $this->mi_servidor=$parametros->servidor;
        $this->mi_usuario=$parametros->usuario;
        $this->mi_contrasenia=$parametros->contrasenia;
        $this->mi_basedatos=$parametros->basedatos;
        $this->mi_puerto=$parametros->puerto;
        $this->mi_mysqlicon = $this->instanciarConexion();
    }

    private function instanciarConexion(){
        try{
            //Cambio
            $mi_retorno = new mysqli($this->mi_servidor,$this->mi_usuario, $this->mi_contrasenia,$this->mi_basedatos,$this->mi_puerto);
            $mi_retorno->set_charset('utf8');
            return $mi_retorno;
        }catch (Exception $e) {
            return null;
        }
    }

    public function getCurrentConnection(){
        return $this->mi_mysqlicon;
    }

}

//DAO

class persona {

    private $cn = null;

    public function __construct($conexion)
    {
        $this->cn = $conexion;
    }

    public function addPersona($consulta){

        $resultado = false;

        try {

            
            return $this->cn->query($consulta);
        } catch (Exception $ex) {
            $resultado = false;
        }
        return $resultado;
    }

}


$micon = new database();

$mipersona = new persona($micon->getCurrentConnection());


echo "Class Conexion Test:<br>";
var_dump($mipersona->addPersona("INSERT INTO persona(nombre,telefono) VALUES('class_con_1','aaa'),('class_con_1.5','aaa');"));
var_dump($mipersona->addPersona("INSERT INTO persona(nombre,telefono) VALUES('class_con_2','bbb');"));

?>