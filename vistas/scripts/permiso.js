var tabla;

// Funcion que se ejecuta al inicio 
function init() {
    mostrarform(false);
    listar();
}

// Funcion mostrar formulario
function mostrarform(flag) {
    //limpiar();
    if(flag) {
        // muestra el formulario de alta
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled",false);
        $("#btnAgregar").hide();
    } else {
        // muestra el listado principal
        $("#listadoregistros").show(); 
        $("#formularioregistros").hide();
        $("#btnAgregar").hide();
    }
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
            url: "../ajax/permiso.php?op=listar",
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 5,            // paginacion
        "order": [[ 0, "desc" ]]        // orden de datos: columna, orden
    }).DataTable(); 
}

init();
