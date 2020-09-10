<?php
require_once "../modelos/Consulta.php";

$consulta = new Consulta();

$idconsulta = isset($_POST["idconsulta"])? limpiarCadena($_POST["idconsulta"]) : "";
$idtipoconsulta = isset($_POST["idtipoconsulta"])? limpiarCadena($_POST["idtipoconsulta"]) : ""; 
$idusuario = isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]) : "";
$fecha = isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]) : "";
$estadopersona = isset($_POST["estadopersona"])? limpiarCadena($_POST["estadopersona"]) : "";
$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]) : "";
$apellido = isset($_POST["apellido"])? limpiarCadena($_POST["apellido"]) : "";
$tipo_doc = isset($_POST["tipo_doc"])? limpiarCadena($_POST["tipo_doc"]) : "";
$numero_doc = isset($_POST["numero_doc"])? limpiarCadena($_POST["numero_doc"]) : "";
$email = isset($_POST["email"])? limpiarCadena($_POST["email"]) : "";
$telefono = isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]) : "";
$estadocunsulta = isset($_POST["estadocunsulta"])? limpiarCadena($_POST["estadocunsulta"]) : "";
$observaciones = isset($_POST["observaciones"])? limpiarCadena($_POST["observaciones"]) : "";

switch ($_GET["op"]) {
    case 'guardaryeditar':
        if (empty($idconsulta)) {  
            $rspta = $consulta->insertar($idtipoconsulta, $idusuario, $fecha, $estadopersona, 
            $nombre, $apellido, $tipo_doc, $numero_doc, $email, $telefono, $estadocunsulta, 
            $observaciones);
            echo $rspta ? "Consulta registrada" : "Consulta NO pudo ser registrada";
        } else { 
            $rspta = $consulta->editar($idconsulta, $idtipoconsulta, $idusuario, $fecha, $estadopersona, 
            $nombre, $apellido, $tipo_doc, $numero_doc, $email, $telefono, $estadocunsulta, 
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
            $data[] = array(
                "0" => '<button class="btn btn-warning" onclick="mostrar('.$reg->idconsulta.')">
                       <i class="fa fa-pencil"></i></button>'.
                       ' <button class="btn btn-danger" onclick="desactivar('.$reg->idconsulta.')">
                       <i class="fa fa-close"></i></button>',
                "1" => $reg->nombre,
                "2" => $reg->apellido,
                "3" => $reg->tipo_doc,
                "4" => $reg->numero_doc
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

    /*
    case 'selectCategoria':
        require_once "../modelos/Categoria.php";
        $categoria = new Categoria();
        
        $rspta = $categoria->select();

        while ($reg = $rspta->fetch_object()) {
            echo '<option value='.$reg->idcategoria.'>'.$reg->nombre.'</option>';
        }
        
    break;
    */
}

?>