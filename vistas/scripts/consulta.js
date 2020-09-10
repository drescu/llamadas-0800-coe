var tabla;

// Funcion que se ejecuta al inicio 
function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit",function(e) {
        guardaryeditar(e);
    })
}

    /*
    // cargamos los items al select categoria
    $.post("../ajax/evento.php?op=selectCategoria", function(r)
    {
        // datos que devuelvo a la vista
        $("#idcategoria").html(r);
        $("#idcategoria").selectpicker('refresh');
    });

    $("#imagenmuestra").hide();
    */


// Funcion limpiar 
function limpiar() {
    $("#idconsulta").val("");
    $("#tipo_doc").val("DNI");
    $("#numero_doc").val("");
    $("#nombre").val("");
    $("#apellido").val("");
    //$("#pueblo_indigena1").prop("checked", false);
    //$("#pueblo_indigena2").prop("checked", false);
    //$("#etnia").val("");
    //$("#etnia").prop("disabled", true);
    
}

// Funcion mostrar formulario
function mostrarform(flag) {
    limpiar();
    if(flag) {
        // muestra el formulario de alta
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#numero_doc").focus();
        $("#btnGuardar").prop("disabled",false);
        $("#superior").hide();
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

function buscarrenaper() {
    var urlLogin = 'https://federador.msal.gob.ar/masterfile-federacion-service/api/usuarios/aplicacion/login';
    var nombre = 'HQgdGgMcFxMaCl4SEh8FDFwNEksCCBwZEUYCABAAAw==';
    var clave = 'RgwLQFRJASxAEEQOJiMjPkY=';
    var codDominio = '2.16.840.1.113883.2.10.58';
    var sexo = 2;
    var dni = 27451387;
    var urlrequest ='https://federador.msal.gob.ar/masterfile-federacion-service/api/personas/renaper?nroDocumento='+dni+'&idSexo='+sexo;
    //var token;
    
    
    axios.post(urlLogin, {  
            'nombre': nombre,
            'clave': clave,
            'codDominio':codDominio    
    })
    .then(function(response) {
        var token = response.data.token; // guardo el token devuelto
        //alert(token);
        
        axios.get(urlrequest, {
            header: {
                'token':'ffsdfsd',
                'codDominio':codDominio
            }    
        })
        .then(function(res) {
            //console.log(token);
        //mensaje.innerHTML = response.data.title;
        })
        .catch(function(err) {
            //alert(token);
            console.log(err);
        });     


    })
    .catch(function(err) {
        alert(err);
        //mensaje.innerText = 'Error de conexión ' + err;
    });
    //token1 = this.token;
    //alert(token1);
    axios.get(urlrequest, {
        params: {
            'token':this.token,
            'codDominio':this.codDominio
        }
    //responseType: 'json', 
    })
    .then(function(res) {
        console.log(res);
    //mensaje.innerHTML = response.data.title;
    })
    .catch(function(err) {
        console.log(err);
    });  
    

    
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
        //$('#idcategoria').selectpicker('refresh');
        $("#nombre").val(data.nombre);
        $("#apellido").val(data.apellido);
        $("#tipo_doc").val(data.tipo_doc);
        $("#numero_doc").val(data.numero_doc);
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
/*
function comprobar() {      
    if (document.getElementById("pueblo_indigena2").checked) {
        $("#etnia").prop("disabled", false);
        $("#etnia").focus();
    } else {
        $("#etnia").val("");
        $("#etnia").prop("disabled", true);
    }     
}*/ 

init();
