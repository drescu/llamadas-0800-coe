<?php

// Incluimos inicialmente la conexion a la base de datos
require "../config/Conexion.php";

class Usuario {
    
    // Implementamos nuestro constructor
    public function __construct(){
    }  

    // Implementamos un metodo para insertar registros
    public function insertar($user, $clave, $nombre, $apellido, $email, $telefono, 
                    $tipo_doc, $numero_doc, $turno, $permisos) 
    { 
        $sql = "INSERT INTO usuarios (user, clave, nombre, apellido, email, telefono,
                tipo_doc, numero_doc, turno, condicion)
                VALUES ('$user', '$clave', '$nombre', '$apellido', '$email', '$telefono', 
                '$tipo_doc', '$numero_doc', '$turno', '1')";
        //return ejecutarConsulta($sql);
        $idusuarionew = ejecutarConsulta_retornarID($sql);
        
        $num_elementos = 0;
        $sw = true;

        while ($num_elementos < count($permisos)) {
            $sql_detalle = "INSERT INTO usuarios_permisos (idusuario, idpermiso) 
            VALUES ('$idusuarionew', '$permisos[$num_elementos]')";
            ejecutarConsulta($sql_detalle) or $sw = false;
            $num_elementos = $num_elementos + 1;     
        }
        return $sw;
    } 

    // Implementamos un metodo para editar registros
    public function editar($idusuario, $user, $clave, $nombre, $apellido, $email, $telefono, 
                    $tipo_doc, $numero_doc, $turno, $permisos) 
    {
        $sql = "UPDATE usuarios SET user='$user', clave='$clave', nombre='$nombre', 
                apellido='$apellido', email='$email', telefono='$telefono', tipo_doc='$tipo_doc',
                numero_doc='$numero_doc', turno='$turno'
                WHERE idusuario='$idusuario'"; 
        ejecutarConsulta($sql);
        
        // Eliminamos todos los permisos asignados para volverlos a registrar
        $sqldel = "DELETE FROM usuarios_permisos WHERE idusuario = '$idusuario'";
        ejecutarConsulta($sqldel);

        $num_elementos = 0;
        $sw = true;

        while ($num_elementos < count($permisos)) {
            $sql_detalle = "INSERT INTO usuarios_permisos (idusuario, idpermiso) 
            VALUES ('$idusuario', '$permisos[$num_elementos]')";
            ejecutarConsulta($sql_detalle) or $sw = false;
            $num_elementos = $num_elementos + 1;     
        }
        return $sw;

    } 

     // Implementamos un metodo para desactivar un registro
     public function desactivar($idusuario) 
    {
        $sql = "UPDATE usuarios SET condicion='0' WHERE idusuario='$idusuario'";
        return ejecutarConsulta($sql);       
    } 

    // Implementamos un metodo para activar un registro
    public function activar($idusuario) 
    {
        $sql = "UPDATE usuarios SET condicion='1' WHERE idusuario='$idusuario'";
        return ejecutarConsulta($sql);       
    } 

    // Implementamos un metodo para mostrar los datos de un registro a modificar
    public function mostrar($idusuario) 
    {
        $sql = "SELECT * FROM usuarios WHERE idusuario='$idusuario'";
        return ejecutarConsultaSimpleFila($sql);       
    } 

    // Implementamos un metodo para listar los registros
    public function listar() 
    {
        $sql = "SELECT * FROM usuarios";
        return ejecutarConsulta($sql);        
    }

    // Implementar un método para listar los permisos marcados
    public function listarmarcados($idusuario) 
    {
        $sql = "SELECT * FROM usuarios_permisos WHERE idusuario='$idusuario'";
        return ejecutarConsulta($sql);        
    }

}

?>