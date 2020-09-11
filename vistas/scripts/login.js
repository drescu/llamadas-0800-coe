$("#frmAcceso").on('submit',function(e) {
    e.preventDefault();
    usera = $(" #usera").val();
    clavea = $("#clavea").val();

    $.post("../ajax/usuario.php?op=verificar",
        {"usera":usera, "clavea":clavea},
        function(data)
        {
            if (data != "null") {
                $(location).attr("href","inicio.php");
            } else {
                bootbox.alert("Usuario y/o Contraseña incorrecto/s");
            }
        });
})