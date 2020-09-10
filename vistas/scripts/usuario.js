var tabla;

// Funcion que se ejecuta al inicio 
function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit",function(e) {
        guardaryeditar(e);
    })

    $("#imagenmuestra").hide();
    // Mostramos los permisos
    $.post("../ajax/usuario.php?op=permisos&id=", function(r) {
        $("#permisos").html(r);
    });
}

// Funcion limpiar 
function limpiar() {
    $("#user").val("");
    $("#clave").val("");
    $("#nombre").val("");
    $("#apellido").val("");
    $("#email").val("");
    $("#telefono").val("");
    $("#numero_doc").val("");
    $("#tipo_doc").val("DNI");
    $("#turno").val("M");
    $("#idusuario").val("");
}

// Funcion mostrar formulario
function mostrarform(flag) {
    limpiar();
    if(flag) {
        // muestra el formulario de alta
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#nombre").focus();
        $("#btnGuardar").prop("disabled",false);
        $("#btnAgregar").hide();
    } else {
        // muestra el listado principal
        $("#listadoregistros").show(); 
        $("#formularioregistros").hide();
        $("#btnAgregar").show();
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
            url: "../ajax/usuario.php?op=listar",
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
        url: "../ajax/usuario.php?op=guardaryeditar",
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

function mostrar(idusuario) { 
    // envio por post, al controlador ajax 
    $.post("../ajax/usuario.php?op=mostrar", {idusuario : idusuario}, function(data, status)
    {
        data = JSON.parse(data);
        mostrarform(true);

        // datos que devuelvo a la vista
        $("#user").val(data.user);
        $("#clave").val(data.clave);
        $("#nombre").val(data.nombre);
        $("#apellido").val(data.apellido);
        $("#email").val(data.email);
        $("#telefono").val(data.telefono);
        $("#tipo_doc").val(data.tipo_doc);
        $("#tipo_doc").selectpicker('refresh');
        $("#numero_doc").val(data.numero_doc);
        $("#turno").val(data.turno);
        $("#idusuario").val(data.idusuario);
    });
    $.post("../ajax/usuario.php?op=permisos&id="+idusuario, function(r) {
        $("#permisos").html(r);
    });
}

function desactivar(idusuario) {
    bootbox.confirm("¿Está seguro que desea desactivar este usuario?", function(result){
        if(result) {
            $.post("../ajax/usuario.php?op=desactivar",{idusuario : idusuario},function(e){
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

function activar(idusuario) {
    bootbox.confirm("¿Está seguro que desea activar este usuario?", function(result){
        if(result) {
            $.post("../ajax/usuario.php?op=activar",{idusuario : idusuario},function(e){
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

init();

