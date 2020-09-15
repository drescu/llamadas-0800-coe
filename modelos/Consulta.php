<?php

// Incluimos inicialmente la conexion a la base de datos
require "../config/Conexion.php";

class Consulta {
    
    // Implementamos nuestro constructor
    public function __construct(){
    }  

    // Implementamos un metodo para insertar registros
    public function insertar($idtipoconsulta, $idusuario, $estado_persona, $nombre, 
                    $apellido, $tipo_doc, $numero_doc, $email, $telefono, $estado_consulta, 
                    $observaciones) 
    {
        $sql = "INSERT INTO consultas (idtipoconsulta, idusuario, estadopersona, nombre, apellido, 
                tipo_doc, numero_doc, email, telefono, estadoconsulta, observaciones, condicion)
                VALUES ('$idtipoconsulta', '$idusuario', '$estado_persona', '$nombre', 
                    '$apellido', '$tipo_doc', '$numero_doc', '$email', '$telefono', '$estado_consulta', 
                    '$observaciones', '1')";
        return ejecutarConsulta($sql);       
    } 

    // Implementamos un metodo para editar registros
    public function editar($idconsulta, $idtipoconsulta, $idusuario, $estado_persona, 
                    $nombre, $apellido, $tipo_doc, $numero_doc, $email, $telefono, 
                    $estado_consulta, $observaciones) 
    {
        $sql = "UPDATE consultas SET idtipoconsulta='$idtipoconsulta', idusuario='$idusuario', 
                    estadopersona='$estado_persona', nombre='$nombre', apellido='$apellido', 
                    tipo_doc='$tipo_doc', numero_doc='$numero_doc', email='$email', 
                    telefono='$telefono', estadoconsulta='$estado_consulta', observaciones='$observaciones'
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
                FROM consultas WHERE condicion = '1' ORDER BY idconsulta DESC";
        return ejecutarConsulta($sql);        
    }

    public function selectTipoConsulta($categoria) 
    {
        $sql = "SELECT * FROM tipos_consultas WHERE categoria='$categoria'";
        return ejecutarConsulta($sql);        
    }

}


?>