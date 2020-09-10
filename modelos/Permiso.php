<?php

// Incluimos inicialmente la conexion a la base de datos
require "../config/Conexion.php";

class Permiso {
    
    // Implementamos nuestro constructor
    public function __construct(){
    }   

    // Implementamos un metodo para listar los registros
    public function listar() 
    {
        $sql = "SELECT * FROM permisos";
        return ejecutarConsulta($sql);        
    }

}


?>