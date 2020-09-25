<?php

// Incluimos inicialmente la conexion a la base de datos
require "../config/Conexion.php";

class Consulta {
    
    // Implementamos nuestro constructor
    public function __construct(){
    }  

    // Implementamos un metodo para insertar registros
    public function insertar($idtipoconsulta, $idusuario, $estado_persona, 
                $otro_estado_persona, $nombre, $apellido, $tipo_doc, $numero_doc, $email, $telefono, 
                $estado_consulta, $fecha_nac, $edad, $sexo, $barrio, $calle, $otro_tipo_consulta, $observaciones) 
    {
        $sql = "INSERT INTO consultas (idtipoconsulta, idusuario, estadopersona, otroestadopersona, 
                nombre, apellido, tipo_doc, numero_doc, email, telefono, estadoconsulta, fecha_nac, edad, 
                sexo, barrio, calle, otrotipoconsulta,observaciones, condicion)
                VALUES ('$idtipoconsulta', '$idusuario', '$estado_persona', '$otro_estado_persona', 
                    '$nombre', '$apellido', '$tipo_doc', '$numero_doc', '$email', '$telefono', 
                    '$estado_consulta', '$fecha_nac', '$edad', '$sexo', '$barrio', '$calle', 
                    '$otro_tipo_consulta', '$observaciones', '1')";
        return ejecutarConsulta($sql);       
    } 

    // Implementamos un metodo para editar registros
    public function editar($idconsulta, $idtipoconsulta, $idusuario, $estado_persona, $otro_estado_persona, 
                    $nombre, $apellido, $tipo_doc, $numero_doc, $email, $telefono, 
                    $estado_consulta, $fecha_nac, $edad, $sexo, $barrio, $calle, 
                    $otro_tipo_consulta, $observaciones) 
    {
        $sql = "UPDATE consultas SET idtipoconsulta='$idtipoconsulta', idusuario='$idusuario', 
                    otroestadopersona='$otro_estado_persona', estadopersona='$estado_persona', nombre='$nombre', 
                    apellido='$apellido', tipo_doc='$tipo_doc', numero_doc='$numero_doc', email='$email', 
                    telefono='$telefono', estadoconsulta='$estado_consulta', 
                    fecha_nac='$fecha_nac', edad='$edad', sexo='$sexo', barrio='$barrio', 
                    calle='$calle', otrotipoconsulta='$otro_tipo_consulta',observaciones='$observaciones'
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
        $sql = "SELECT c.idconsulta, CONCAT(u.nombre,', ',u.apellido) AS operador, 
            DATE_FORMAT(c.fecha_registro, '%d/%m/%Y') AS fecha_registro, 
            DATE_FORMAT(c.fecha_registro, '%H:%i') AS hora_registro,
            c.nombre, c.apellido, c.tipo_doc, c.numero_doc, c.estadoconsulta, c.estadopersona,
            t.nombre AS tipo_consulta, c.observaciones
                FROM consultas AS c 
                INNER JOIN usuarios AS u ON (c.idusuario = u.idusuario)
                LEFT JOIN tipos_consultas t ON (c.idtipoconsulta = t.idtipoconsulta)
                WHERE c.condicion = '1' 
                ORDER BY c.idconsulta DESC";
        return ejecutarConsulta($sql);        
    }

    public function selectTipoConsulta($categoria) 
    {
        $sql = "SELECT * FROM tipos_consultas WHERE categoria='$categoria'";
        return ejecutarConsulta($sql);        
    }

}


?>