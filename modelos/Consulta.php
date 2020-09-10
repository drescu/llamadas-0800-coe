<?php

// Incluimos inicialmente la conexion a la base de datos
require "../config/Conexion.php";

class Consulta {
    
    // Implementamos nuestro constructor
    public function __construct(){
    }  

    // Implementamos un metodo para insertar registros
    public function insertar($idtipoconsulta, $idusuario, $fecha, $estadopersona, $nombre, 
                    $apellido, $tipo_doc, $numero_doc, $email, $telefono, $estadocunsulta, 
                    $observaciones) 
    {
        $sql = "INSERT INTO consultas (idtipoconsulta, idusuario, fecha, estadopersona, nombre, apellido, 
                tipo_doc, numero_doc, email, telefono, estadocunsulta, observaciones)
                VALUES ('$idtipoconsulta', '$idusuario', '$fecha', '$estadopersona', '$nombre', 
                    '$apellido', '$tipo_doc', '$numero_doc', '$email', '$telefono', '$estadocunsulta', 
                    '$observaciones')";
        return ejecutarConsulta($sql);       
    } 

    // Implementamos un metodo para editar registros
    public function editar($idconsulta, $idtipoconsulta, $idusuario, $fecha, $estadopersona, 
                    $nombre, $apellido, $tipo_doc, $numero_doc, $email, $telefono, 
                    $estadocunsulta, $observaciones) 
    {
        $sql = "UPDATE consultas SET idtipoconsulta='$idtipoconsulta', idusuario='$idusuario', 
                    fecha='$fecha', estadopersona='$estadopersona', nombre='$nombre', 
                    apellido='$apellido', tipo_doc='$tipo_doc', numero_doc='$numero_doc', 
                    email='$email', telefono='$telefono', estadocunsulta='$estadocunsulta', 
                    observaciones='$observaciones'
                WHERE idconsulta='$idconsulta'"; 
        return ejecutarConsulta($sql);       
    } 

     // Implementamos un metodo para desactivar un registro
     public function desactivar($idconsulta) 
    {
        $sql = "UPDATE consultas SET condicion='0' WHERE idconsulta='$idconsulta'";
        return ejecutarConsulta($sql);       
    } 

    // Implementamos un metodo para mostrar los datos de un registro a modificar
    public function mostrar($idconsulta) 
    {
        $sql = "SELECT * FROM consultas WHERE idconsulta='$idconsulta'";
        return ejecutarConsultaSimpleFila($sql);       
    } 

    // Implementamos un metodo para listar los registros
    public function listar() 
    {
        $sql = "SELECT idconsulta, nombre, apellido, tipo_doc, numero_doc
                FROM consultas";
        return ejecutarConsulta($sql);        
    }

}


?>