var tabla;

// Funcion que se ejecuta al inicio 
function init() {
    mostrarform(false);
    listar();
    
    $("#formulario").on("submit",function(e) {
        guardaryeditar(e);
    })

}


// Funcion limpiar 
function limpiar() {
    $("#idconsulta").val("");
    //$("#tipo_consulta").val("");
    $("#estado_persona").val("0");
    $("#nombre").val("");
    $("#apellido").val("");
    $("#tipo_doc").val("DNI");
    $("#numero_doc").val("");
    $("#email").val("");
    $("#telefono").val("");
    $("#estado_consulta").val("0");
    $("#observaciones").val("");
}

// Funcion mostrar formulario
function mostrarform(flag) { 
    limpiar();
    if(flag) {
        // muestra el formulario de alta
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#buscar_dni").focus();
        $("#btnGuardar").prop("disabled",false);
        $("#superior").hide();
        $("#frmRenaper").hide();
        mostrartipocategoria();
    } else {
        // muestra el listado principal
        $("#listadoregistros").show(); 
        $("#formularioregistros").hide();
        $("#superior").show();
    }
}

// Funcion cancelar form
function cancelarform() {
    limpiar();
    mostrarform(false);
}
  
// Funcion listar
function listar() { 
    tabla=$('#tbllistado').dataTable(
        {
        "aProcessing": true,    // Activamos el procesamiento del datatables
        "aServerSide": true,    // Paginacion y filtrado realizados por el servidor
        dom: 'Bfrtip',          // Definimos los elementos del control de tabla
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ],
        "ajax": {
            url: "../ajax/consulta.php?op=listar",
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10,            // paginacion
        "order": [[ 0, "desc" ]]        // orden de datos: columna, orden
    }).DataTable(); 
}

function guardaryeditar(e) { 
    e.preventDefault();     // no se activara la accion predeterminada del evento 
    $("#btnGuardar").prop("disabled",true);
    var formData = new FormData($("#formulario")[0]);
    
    $.ajax({
        url: "../ajax/consulta.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(datos) {
            bootbox.alert(datos);
            mostrarform(false);
            tabla.ajax.reload();
        } 
    });
    limpiar();
}

function mostrar(idconsulta) { 
    // envio por post, al controlador ajax 
    $.post("../ajax/consulta.php?op=mostrar", {idconsulta : idconsulta}, function(data, status)
    {
        data = JSON.parse(data);
        mostrarform(true);
        
        // datos que devuelvo a la vista
        $("#idconsulta").val(data.idconsulta);
        $("#tipo_consulta").val(data.idtipoconsulta);
        //$('#tipo_consulta').selectpicker('refresh');
        $("#idusuario").val(data.idusuario);
        $("#estado_persona").val(data.estadopersona);
        $("#nombre").val(data.nombre);
        $("#apellido").val(data.apellido);
        $("#tipo_doc").val(data.tipo_doc);
        $("#numero_doc").val(data.numero_doc);
        $("#email").val(data.email);
        $("#telefono").val(data.telefono);
        $("#observaciones").val(data.observaciones);
        $("#estado_consulta").val(data.estadoconsulta);
    })
}

function desactivar(idconsulta) {
    bootbox.confirm("¿Está seguro que desea eliminar esta consulta?", function(result){
        if(result) {
            $.post("../ajax/consulta.php?op=desactivar",{idconsulta : idconsulta},function(e){
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

function mostrartipocategoria() {
    
    nombreArchivo = filename();
    
    switch (nombreArchivo) {
        case 'listado_salud.php':
            categoria = 1; 
        break;
        case 'listado_asistencia.php':
            categoria = 2; 
        break;
        case 'listado_asesoramiento.php':
            categoria = 3; 
        break;
        case 'listado_transporte.php':
            categoria = 4; 
        break;
        case 'listado_informacion.php':
            categoria = 5; 
        break;
        default:
            categoria = null; 
        break;    
    }
    $.post("../ajax/consulta.php?op=selectTipoConsulta",{categoria : categoria},function(r){
        $("#tipo_consulta").html(r);
        //$("#tipo_consulta").selectpicker('refresh');
        //bootbox.alert(r);
    });
}

// Funcion que devuelve el nombre del archivo actual (ej: salud_listado)
function filename(){
    var rutaAbsoluta = self.location.href;   
    var posicionUltimaBarra = rutaAbsoluta.lastIndexOf("/");
    var rutaRelativa = rutaAbsoluta.substring( posicionUltimaBarra + "/".length , rutaAbsoluta.length );
    return rutaRelativa;  
}

function renaper() {
    
    // obteniendo el dni ingresado por el usuario 
    var dni = $("#buscar_dni").val();
    
    // valida el dni ingresado (si ingresan un dni, debe tener 7 u 8 caracteres)
    
    if($.trim(dni) == "") {
        bootbox.alert("Ingrese un DNI");
        $("#buscar_dni").focus();
        return false;        
    } else if (dni.length != 7 && dni.length != 8) {
        bootbox.alert("Cantidad de caracteres Incorrectos");
        $("#buscar_dni").focus();
        return false; 
    } else {
        var patron = /^[0-9]*$/; // patron de validacion
        if (patron.test(dni)== false) {
            bootbox.alert("El Dni debe ser Númerico");
            $("#buscar_dni").focus();
            return fale;
        }
    }
    $.post("../ajax/renaper.php",{dni:dni},function(res){
       
        var data = JSON.parse(res);
        console.log(data);
        $("#apellido").val(data.apellido);
        $("#nombre").val(data.nombres);
        $("#numero_doc").val(data.numeroDocumento);

    });   
}
    
init();

