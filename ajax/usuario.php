<?php
session_start();
require_once "../modelos/Usuario.php";

$usuario = new Usuario();

$idusuario = isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]) : ""; 
$user = isset($_POST["user"])? limpiarCadena($_POST["user"]) : ""; 
$clave = isset($_POST["clave"])? limpiarCadena($_POST["clave"]) : "";
$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]) : "";
$apellido = isset($_POST["apellido"])? limpiarCadena($_POST["apellido"]) : "";
$email = isset($_POST["email"])? limpiarCadena($_POST["email"]) : "";
$telefono = isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]) : "";
$tipo_doc = isset($_POST["tipo_doc"])? limpiarCadena($_POST["tipo_doc"]) : "";
$numero_doc = isset($_POST["numero_doc"])? limpiarCadena($_POST["numero_doc"]) : "";
$turno = isset($_POST["turno"])? limpiarCadena($_POST["turno"]) : "";

switch ($_GET["op"]) {
    case 'guardaryeditar':
        
        // Hash SHA256 en la contraseña
        $clavehash = hash("SHA256", $clave); 
        
        if (empty($idusuario)) {  
            $rspta = $usuario->insertar($user, $clavehash, $nombre, $apellido, $email, $telefono, 
            $tipo_doc, $numero_doc, $turno, $_POST['permiso']); 
            echo $rspta ? "Usuario registrado" : "No se pudieron registrar todos los datos del usuario";
        } else { 
            $rspta = $usuario->editar($idusuario, $user, $clavehash, $nombre, $apellido, $email, $telefono, 
            $tipo_doc, $numero_doc, $turno, $_POST['permiso']);
            echo $rspta ? "Usuario actualizado" : "Usuario No se pudo actualizar";
        }
    break;
    
    case 'mostrar':
        $rspta = $usuario->mostrar($idusuario); 
        // Codificar el resultado utilizando JSON
        echo json_encode($rspta);
    break;

    case 'listar':
        $rspta = $usuario->listar(); 
        // Vamos a declarar un array
        $data = Array();
        
        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => ($reg->condicion) ?  
                            // condicion verdadera
                            '<button class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')">
                            <i class="fa fa-pencil"></i></i></button>'.
                            ' <button class="btn btn-danger" onclick="desactivar('.$reg->idusuario.')">
                            <i class="fa fa-close"></i></i></button>' 
                            //  condicion falsa
                            : '<button class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')">
                            <i class="fa fa-pencil"></i></i></button>'.
                            ' <button class="btn btn-primary" onclick="activar('.$reg->idusuario.')">
                            <i class="fa fa-check"></i></i></button>',
                "1" => $reg->nombre,
                "2" => $reg->apellido,
                "3" => $reg->tipo_doc,
                "4" => $reg->numero_doc,
                "5" => $reg->telefono,
                "6" => $reg->email,
                "7" => $reg->user,
                "8" => ($reg->condicion) ? '<span class="label bg-green">Activado</span>'
                                         : '<span class="label bg-red">Desactivado</span>'
            );
        }
        $results = array(
            "sEcho" => 1, // Informacion para el datatables
            "iTotalRecords" => count($data), // enviamos el total de registros al datatables
            "iTotalDisplayRecords" => count($data), // enviamos el total de registros a visualizar
            "aaData" => $data     // envio el array completo
        );
        echo json_encode($results);
    break;
  
    case 'activar':
        $rspta = $usuario->activar($idusuario);
        echo $rspta ? "Usuario activado" : "Usuario no pudo ser activado";
    break;
    
    case 'desactivar':
        $rspta = $usuario->desactivar($idusuario);
        echo $rspta ? "Usuario desactivado" : "Usuario no pudo ser desactivar";
    break;

    case 'permisos':
        // Obtenemos todos los permisos de la tabla permisos
        require_once "../modelos/Permiso.php";
        $permiso = new Permiso();
        $rspta = $permiso->listar();
        
        // Obtener los permisos asignados al usuario
        $id = $_GET['id'];
        $marcados = $usuario->listarmarcados($id);
        // Declaramos el array para almacenar todos los permisos marcados
        $valores = array();

        // Almacenar los permisos asignados al usuario en el array
        while ($per = $marcados->fetch_object()) {
            array_push($valores, $per->idpermiso);
        }

        //Mostramos la lista de permisos en la vista y si están o no marcados
        while ($reg = $rspta->fetch_object()) {
            $sw = in_array($reg->idpermiso, $valores) ? 'checked' : '';
            echo '<li><input type="checkbox" '.$sw.' name="permiso[]" 
                  value="'.$reg->idpermiso.'">'.$reg->nombre.'</li>';
        }

    break;

    case 'verificar':
        $usera = $_POST['usera'];
        $clavea = $_POST['clavea'];

        // Hash SHA256 en la contraseña
        $clavehash = hash("SHA256", $clavea); 

        $rspta = $usuario->verificar($usera, $clavehash);

        $fetch = $rspta->fetch_object();

        if (isset($fetch)) {
            // Declaramos las variables de sesion
            $_SESSION['idusuario'] = $fetch->idusuario;        
            $_SESSION['nombre'] = $fetch->nombre; 
            $_SESSION['apellido'] = $fetch->apellido;    
            $_SESSION['user'] = $fetch->user;  
            
            // Obtenemos los permisos del usuario
            $marcados = $usuario->listarmarcados($fetch->idusuario);

            // Declaramos el array para almacenar todos los permisos marcados
            $valores = array();

            // Almacenamos los permisos marcados en el array
            while ($per = $marcados->fetch_object()) {
                array_push($valores, $per->idpermiso);
            }

            // Determinamos los accesos del usuario
            in_array(1, $valores) ? $_SESSION['salud'] = 1 : $_SESSION['salud'] = 0;
            in_array(2, $valores) ? $_SESSION['asistencia'] = 1 : $_SESSION['asistencia'] = 0;
            in_array(3, $valores) ? $_SESSION['asesoramiento'] = 1 : $_SESSION['asesoramiento'] = 0;
            in_array(4, $valores) ? $_SESSION['transporte'] = 1 : $_SESSION['transporte'] = 0;
            in_array(5, $valores) ? $_SESSION['informacion'] = 1 : $_SESSION['informacion'] = 0;
            in_array(6, $valores) ? $_SESSION['acceso'] = 1 : $_SESSION['acceso'] = 0;

        }
        echo json_encode($fetch);
    break;

    case 'salir':
        // Limpiamos las variables de session
        session_unset();

        // Destruimos la session
        session_destroy();

        // Redireccionamos al login
        header("Location: ../index.php");
    break;

}
?>