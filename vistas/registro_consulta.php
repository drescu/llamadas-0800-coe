<!-- Formulario de registro de eventos -->
<?php 
  $idusuario = $_SESSION['idusuario'];
?>

<div class="panel-body" id="formularioregistros">
  <form name="formulario" id="formulario" method="POST">

    <!-- row 0 -->
    <div class="panel panel-success">
      <div class="panel-heading">Operador<?=": <strong>".strtoupper($_SESSION['nombre']." ".$_SESSION['apellido'])."</strong>";?>
        <br><div id="fecha"></div> 
      </div>
    </div>
    <!-- -------- -->

    <!-- row 1 -->
    <div class="row" id="uno">
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <input type="text" class="form-control" name="buscar_dni" id="buscar_dni" maxlength="8"
          placeholder="Ingrese un DNI">
      </div>
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <button class="btn btn-primary" onclick="renaper()" type="button">
          <i class="fa fa-search"></i> Renaper</button>
      </div>
    </div>
    <!-- -------- -->

    <!-- row 2 -->
    <div class="row" id="dos">
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label>Apellidos/s:</label>
        <input type="text" class="form-control" name="apellido" id="apellido" maxlength="50" required>
      </div>
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label>Nombre/s:</label>
        <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50" required>
      </div>
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label>Sexo:</label>
        <select name="sexo" id="sexo" class="form-control">
          <option value="N">Elija una opción</option>
          <option value="M">M</option>
          <option value="F">F</option>
          <option value="O">Otra/o</option>
        </select>
      </div>
    </div> 
    <!-- -------- -->

    <!-- row 3 -->
    <div class="row" id="tres">
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label>Tipo Documento:</label>
        <select name="tipo_doc" id="tipo_doc" class="form-control">
          <option value="DNI">DNI</option>
          <option value="CUIT">CUIT</option>
          <option value="LC">Libreta Cívica</option>
          <option value="LE">Libreta de Enrolamiento</option>
          <option value="CI">Cédula de Identidad</option>
          <option value="DE">Documento Extranjero o Pasaporte</option>
          <option value="DNIF">DNI Femenino</option>
          <option value="DNIM">DNI Masculino</option>
          <option value="DNI">Cédula migratoria o Documento transitorio</option>
          <option value="IND">Indocumentado</option>
        </select>
      </div>
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label>Número Documento:</label>
        <input type="text" class="form-control" name="numero_doc" id="numero_doc" maxlength="20" required>
        <!-- Envio el id de la consulta -->
        <input type="hidden" name="idconsulta" id="idconsulta">
        <!-- Determina que categoria eligio el usuario (salud, asistencia, transporte, etc) -->
        <input type="hidden" name="categoria" id="categoria">
        <input type="hidden" class="form-control" name="idusuario" id="idusuario" value="<?=$_SESSION['idusuario']?>">
      </div>
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label>Fecha Nac.:</label>
        <input type="text" class="form-control" name="fechaNac" id="fechaNac" placeholder="dd/mm/aaaa"> 
      </div>
    </div> 
    <!-- -------- -->

    <!-- row 4 -->
    <div class="row">
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label>Edad:</label>
        <input type="text" class="form-control" name="edad" id="edad">
      </div>
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label>Barrio:</label>
        <input type="text" class="form-control" name="barrio" id="barrio"> 
      </div>
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label>Calle:</label>
        <input type="text" class="form-control" name="calle" id="calle">
      </div>
    </div> 
    <!-- -------- -->

    <!-- row 5 -->
    <div class="row">
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label>Teléfono:</label>
        <input type="text" class="form-control" name="telefono" id="telefono" maxlength="30">
      </div>
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label>Email:</label>
        <input type="email" class="form-control" name="email" id="email" maxlength="30">
      </div>
    </div> 
    <!-- -------- -->

    <!-- row 6 -->
    <div class="row">
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label>Estado Persona:</label>
        <select name="estado_persona" id="estado_persona" class="form-control" onchange="verificarEstado()">
          <option value="0">Elija una opción</option>
          <option value="PO">Positivo</option>
          <option value="NE">Negativo</option>
          <option value="HV">Hisopado por viajes particulares o laborales</option>
          <option value="HS">Hisopado por cuestiones de salud</option>
          <option value="CE">Contacto estrecho</option>
          <option value="NA">Ninguna de las anteriores</option>
        </select>
      </div>
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12" id="otroestadopersona">
        <label>Otro estado:</label>
        <input type="text" class="form-control" name="otro_estado_persona" id="otro_estado_persona" maxlength="50">
      </div>
    </div>
    <!-- -------- -->
    
    <!-- row 7 -->
    <div class="row"> 
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12"> 
        <label>Tipo Consulta:</label>
        <select name="tipo_consulta" id="tipo_consulta" onchange="verificarTipo()" class="form-control selectpicker">
        </select>
      </div>
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12" id="otrotipoconsulta">
        <label>Otro tipo:</label>
        <input type="text" class="form-control" name="otro_tipo_consulta" id="otro_tipo_consulta" maxlength="50">
      </div>
    </div>
    <!-- -------- -->

    <!-- row 8 -->
    <div class="row">  
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label>Estado Consulta:</label>
        <select name="estado_consulta" id="estado_consulta" class="form-control">
          <option value="0">Elija una opción</option>
          <option value="R">Resuelto</option>
          <option value="P">Pendiente</option>
          <option value="D">Derivado</option>
        </select>
      </div>
    </div>
    <!-- -------- -->

    <!-- row 9 -->
    <div class="row">
      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <label>Observaciones:</label>
        <textarea class="form-control" name="observaciones" id="observaciones"></textarea>
      </div>
    </div>
    <!-- ------ -->

    <!-- row 10 -->
    <div class="row">
      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <button class="btn btn-danger" onclick="cancelarform()" type="button">
          <i class="fa fa-arrow-circle-left"></i>  Cancelar
        </button>
        <button class="btn btn-primary" onclick="desactivarRequired()" type="submit" id="btnGuardar">
          <i class="fa fa-save"></i> Guardar
        </button>
      </div>
    </div>
    <!-- ------ -->

    <!-- fin -->
  </form>
</div>