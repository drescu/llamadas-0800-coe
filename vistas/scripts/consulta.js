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
    $("#estado_persona").val("0");
    $("#otro_estado_persona").val();
    $("#otro_tipo_consulta").val();
    $("#nombre").val("");
    $("#apellido").val("");
    $("#tipo_doc").val("DNI");
    $("#numero_doc").val("");
    $("#email").val("");
    $("#telefono").val("");
    $("#estado_consulta").val("0");
    $("#observaciones").val("");
    $("#edad").val("");
    $("#sexo").val("N");
    $("#fechaNac").val("");
    $("#barrio").val("");
    $("#calle").val("");
    $("#buscar_dni").val("");
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
        mostrartipocategoria();
        mostrarfecha();
        $("#uno").show();
        $("#otroestadopersona").hide();
        $("#otrotipoconsulta").hide();
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
        //console.log(data);
        // oculta campos del renaper
        $("#uno").hide();
        //$("#dos").hide();
        //$("#tres").hide();
        
        // datos que devuelvo a la vista
        $("#idconsulta").val(data.idconsulta);
        mostrartipocategoria(data.idtipoconsulta);
        if($("#tipo_consulta").val() == 2) {
            $("#otrotipoconsulta").show();
            $("#otro_tipo_consulta").val(data.otrotipoconsulta);
        } 
        $("#idusuario").val(data.idusuario);
        $("#estado_persona").val(data.estadopersona);
        if($("#estado_persona").val() == 'NA') {
            $("#otroestadopersona").show();
            $("#otro_estado_persona").val(data.otroestadopersona);
        } 
        $("#nombre").val(data.nombre);
        $("#apellido").val(data.apellido);
        $("#tipo_doc").val(data.tipo_doc);
        $("#numero_doc").val(data.numero_doc);
        $("#email").val(data.email);
        $("#telefono").val(data.telefono);
        $("#observaciones").val(data.observaciones);
        $("#estado_consulta").val(data.estadoconsulta);
        $("#sexo").val(data.sexo);
        $("#edad").val(data.edad);
        var fecha_salida = convertDateFormat(data.fecha_nac); // funcion para convertir formato fecha
        $("#fechaNac").val(fecha_salida);
        $("#barrio").val(data.barrio);
        $("#calle").val(data.calle);

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

function mostrartipocategoria(idtipoconsulta) {
    
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
        $("#tipo_consulta").val(idtipoconsulta);
        $("#tipo_consulta option[value='idtipocon']").attr("selected",true);
        $("#tipo_consulta").selectpicker('refresh');
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
    
    // validando el dni
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
       //console.log(res);
        
        var data = JSON.parse(res);
        console.log(data);
        $("#apellido").val(data.apellido);
        //$("#apellido").css('background-color', 'red');
        $("#nombre").val(data.nombres);
        $("#numero_doc").val(data.numeroDocumento);
            var fechaNac = data.fechaNacimiento; // recibe fecha naciemiento
            var fecha_salida = convertDateFormat(fechaNac); // funcion para convertir formato fecha
        $("#fechaNac").val(fecha_salida);
            var edad = calculaEdad(fecha_salida);
        $("#edad").val(edad);
        $("#sexo").val(data.sexo);
        $("#barrio").val(data.monoblock);
        $("#calle").val(data.calle);
    });   
}

// convierte la fecha al formato dd/mm/YYYY
function convertDateFormat(string) {
    var info = string.split('-');
    return info[2] + '/' + info[1] + '/' + info[0];
  }

// Calcula la edad acual
function calculaEdad(birthday) {
    var birthday_arr = birthday.split("/");
    var birthday_date = new Date(birthday_arr[2], birthday_arr[1] - 1, birthday_arr[0]);
    var ageDifMs = Date.now() - birthday_date.getTime();
    var ageDate = new Date(ageDifMs);
    return Math.abs(ageDate.getUTCFullYear() - 1970);
}  

function mostrarfecha() {
    
    var d = new Date();
    var anio = d.getFullYear();
    var mes = d.getMonth() + 1;
    var dia = d.getDate();
    var fecha = dia+"-"+mes+"-"+anio; 
    var desc = 'Fecha: ';
    document.getElementById('fecha').innerHTML = desc + fecha.bold();
    
}

function agregar(idconsulta) { 
    // envio por post, al controlador ajax 
    $.post("../ajax/consulta.php?op=mostrar", {idconsulta : idconsulta}, function(data, status)
    {
        data = JSON.parse(data);
        mostrarform(true);
        
        $("#uno").show();
        //$("#dos").show();
        //$("#tres").show(); 
        $("#buscar_dni").val(data.numero_doc);
        renaper();

        // datos que devuelvo a la vista
        $("#idconsulta").val();
        //$("#tipo_consulta").val(data.idtipoconsulta);
        //mostrartipocategoria(data.idtipoconsulta);
        $("#idusuario").val(data.idusuario);
        $("#estado_persona").val(data.estadopersona);
        $("#otro_estado_persona").val(data.otroestadopersona);
        $("#otro_tipo_consulta").val(data.otrotipoconsulta);
        $("#nombre").val(data.nombre);
        $("#apellido").val(data.apellido);
        $("#tipo_doc").val(data.tipo_doc);
        $("#numero_doc").val(data.numero_doc);
        $("#email").val(data.email);
        $("#telefono").val(data.telefono);
        $("#observaciones").val(data.observaciones);
        $("#estado_consulta").val(data.estadoconsulta);
        $("#sexo").val(data.sexo);
        $("#edad").val(data.edad);
        $("#fechaNac").val(data.fecha_nac);
        $("#barrio").val(data.barrio);
        $("#calle").val(data.calle);
    })
        
}

function verificarEstado() {
    if($("#estado_persona").val() == "NA") {
        $("#otroestadopersona").show();
        $("#otro_estado_persona").focus();
    } else {
        $("#otroestadopersona").hide();
        $("#estado_persona").val() == '';
    }
    
}

function verificarTipo() {
    if($("#tipo_consulta").val() == 2) {
        $("#otrotipoconsulta").show();
        $("#otro_tipo_consulta").focus();
    } else {
        $("#otrotipoconsulta").hide();
        $("#tipo_consulta").val() == '';
    }    
}



function desactivarRequired() {
    
    nombreArchivo = filename();
    
    if(nombreArchivo == 'listado_asesoramiento.php' || nombreArchivo == 'listado_informacion.php') {
        $("#nombre").prop("required",false);
        $("#apellido").prop("required",false);
        $("#numero_doc").prop("required",false);
    }    
}

init();

