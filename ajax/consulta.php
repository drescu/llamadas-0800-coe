<?php
require_once "../modelos/Consulta.php";

$consulta = new Consulta();

$idconsulta = isset($_POST["idconsulta"])? limpiarCadena($_POST["idconsulta"]) : "";
$idtipoconsulta = isset($_POST["tipo_consulta"])? limpiarCadena($_POST["tipo_consulta"]) : "";
$idusuario = isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]) : "";
$estado_persona = isset($_POST["estado_persona"])? limpiarCadena($_POST["estado_persona"]) : "";
$otro_estado_persona = isset($_POST["otro_estado_persona"])? limpiarCadena($_POST["otro_estado_persona"]) : "";
$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]) : "";
$apellido = isset($_POST["apellido"])? limpiarCadena($_POST["apellido"]) : "";
$tipo_doc = isset($_POST["tipo_doc"])? limpiarCadena($_POST["tipo_doc"]) : "";
$numero_doc = isset($_POST["numero_doc"])? limpiarCadena($_POST["numero_doc"]) : "";
$email = isset($_POST["email"])? limpiarCadena($_POST["email"]) : "";
$telefono = isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]) : "";
$estado_consulta = isset($_POST["estado_consulta"])? limpiarCadena($_POST["estado_consulta"]) : "";
$observaciones = isset($_POST["observaciones"])? limpiarCadena($_POST["observaciones"]) : "";
$categoria = isset($_POST["categoria"])? limpiarCadena($_POST["categoria"]) : ""; 
$fecha_nacimiento = isset($_POST["fechaNac"])? limpiarCadena($_POST["fechaNac"]) : "";
$fecha_nac = date('Y-m-d', strtotime($fecha_nacimiento));
if($fecha_nac == '' || $fecha_nac == '1970-01-01' || empty($fecha_nac)) {$fecha_nac = null;}
$edad = isset($_POST["edad"])? limpiarCadena($_POST["edad"]) : "";
$sexo = isset($_POST["sexo"])? limpiarCadena($_POST["sexo"]) : "";
$barrio = isset($_POST["barrio"])? limpiarCadena($_POST["barrio"]) : "";
$calle = isset($_POST["calle"])? limpiarCadena($_POST["calle"]) : "";
$otro_tipo_consulta = isset($_POST["otro_tipo_consulta"])? limpiarCadena($_POST["otro_tipo_consulta"]) : "";

switch ($_GET["op"]) { 
    case 'guardaryeditar': 
        if (empty($idconsulta)) { 
            $rspta = $consulta->insertar($idtipoconsulta, $idusuario, $estado_persona, 
            $otro_estado_persona, $nombre, $apellido, $tipo_doc, $numero_doc, $email, $telefono, 
            $estado_consulta, $fecha_nac, $edad, $sexo, $barrio, $calle, $otro_tipo_consulta,
            $observaciones);
            echo $rspta ? "Consulta registrada" : "Consulta NO pudo ser registrada";
        } else { 
            $rspta = $consulta->editar($idconsulta, $idtipoconsulta, $idusuario, $estado_persona, 
            $otro_estado_persona, $nombre, $apellido, $tipo_doc, $numero_doc, $email, $telefono, 
            $estado_consulta, $fecha_nac, $edad, $sexo, $barrio, $calle, $otro_tipo_consulta,
            $observaciones);
            echo $rspta ? "Consulta actualizada" : "Consulta NO se pudo actualizar";
        }
    break;
    
    case 'mostrar':
        $rspta = $consulta->mostrar($idconsulta); 
        // Codificar el resultado utilizando JSON
        echo json_encode($rspta);
    break;

    case 'listar':
        $rspta = $consulta->listar(); 
        // Vamos a declarar un array
        $data = Array();
        
        while ($reg = $rspta->fetch_object()) {
            switch ($reg->estadoconsulta) {
                case 'R':
                    $reg->estadoconsulta = 'Resuelto';
                    break;
                
                case 'P':
                    $reg->estadoconsulta = 'Pendiente';
                    break;
                case 'D':
                    $reg->estadoconsulta = 'Derivado';
                    break;
                default:
                    $reg->estadoconsulta = '';
                    break;
            }

            switch ($reg->estadopersona) {
                case 'PO':
                    $reg->estadopersona = 'Positivo';
                    break;      
                case 'NE':
                    $reg->estadopersona = 'Negativo';
                    break;
                case 'HV':
                    $reg->estadopersona = 'Hisopado por viajes particulares o laborales';
                    break;
                case 'HS':
                    $reg->estadopersona = 'Hisopado por cuestiones de salud';
                    break; 
                case 'CE':
                    $reg->estadopersona = 'Contacto estrecho';
                    break;     
                case 'NA':
                    $reg->estadopersona = 'Ninguna de las anteriores';
                    break;                     
                default:
                    $reg->estadopersona = '';
                    break;
            }
            
            $data[] = array(
                "0" => '<button class="btn btn-warning" onclick="mostrar('.$reg->idconsulta.')">
                       <i class="fa fa-pencil"></i></button>',
                "1" => ' <button class="btn btn-danger" onclick="desactivar('.$reg->idconsulta.')">
                       <i class="fa fa-close"></i></button>',
                "2" => '<button class="btn btn-primary" onclick="agregar('.$reg->idconsulta.')">
                       <i class="fa fa-plus-square"></i></button>',
                "3" => $reg->operador,
                "4" => $reg->fecha_registro,
                "5" => $reg->hora_registro, 
                "6" => $reg->apellido,
                "7" => $reg->nombre,
                "8" => $reg->tipo_doc,
                "9" => $reg->numero_doc,
                "10" => $reg->estadoconsulta,
                "11" => $reg->estadopersona,
                "12" => $reg->tipo_consulta,
                "13" => $reg->observaciones
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
  
    case 'desactivar':
        $rspta = $consulta->desactivar($idconsulta);
        echo $rspta ? "Consulta eliminada" : "Consulta no pudo ser eliminada";
    break;

    case 'selectTipoConsulta':
        
        $rspta = $consulta->selectTipoConsulta($categoria);
        
        echo '<option value="1">Elija una opción</option>';
        while ($reg = $rspta->fetch_object()) { 
           
            echo '<option value="'.$reg->idtipoconsulta.'">'.$reg->nombre.'</option>';
        }
        echo '<option value="2">Otras</option>';
    break;
}

?>