<!-- Formulario de registro de eventos -->
<?php 
  $idusuario = $_SESSION['idusuario'];
?>

<div class="panel-body" id="formularioregistros">
  <form name="formulario" id="formulario" method="POST">
    <!-- row 0 -->
    <div class="row">
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <input type="text" class="form-control" name="buscar_dni" id="buscar_dni" maxlength="8"
         placeholder="Ingrese un DNI">
      </div>
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <button class="btn btn-success" onclick="renaper()" type="button">
          <i class="fa fa-serch"></i>Busqueda Renaper</button>
      </div>
    </div>
    <!-- fin row 0 -->

    <!-- row 1 -->
    <div class="row">
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label>Id Usuario:</label>
        <input type="text" class="form-control" name="idusuario" id="idusuario" value="<?=$idusuario?>">
      </div>
    </div> 
    <!-- fin row 1 -->

    <!-- row 2 -->
    <div class="row">
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
      </div>
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label>Apellidos/s:</label>
        <input type="text" class="form-control" name="apellido" id="apellido" maxlength="50" required>
      </div>
    </div> <!-- fin row 2 -->
    <div class="row">
      <!-- row 3 -->
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label>Nombre/s:</label>
        <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50" required>
      </div>
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label>Estado Persona:</label>
        <select name="estado_persona" id="estado_persona" class="form-control">
          <option value="0">Elija una opción</option>
          <option value="PO">Positivo</option>
          <option value="NE">Negativo</option>
          <option value="HV">Hisopado por viajes particulares o laborales</option>
          <option value="HS">Hisopado por cuestiones de salud</option>
          <option value="CE">Contacto estrecho</option>
        </select>
      </div>
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label>Tipo Consulta:</label>
        <select name="tipo_consulta" id="tipo_consulta" class="form-control">
        </select>
      </div>
    </div> <!-- fin row 3 -->
    <div class="row">
      <!-- row 4 -->
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label>Email</label>
        <input type="email" class="form-control" name="email" id="email" maxlength="30">
      </div>
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label>Teléfono:</label>
        <input type="text" class="form-control" name="telefono" id="telefono" maxlength="30">
      </div>
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label>Estado Consulta:</label>
        <select name="estado_consulta" id="estado_consulta" class="form-control">
          <option value="0">Elija una opción</option>
          <option value="R">Resuelto</option>
          <option value="P">Pendiente</option>
          <option value="D">Derivado</option>
        </select>
      </div>
    </div> <!-- fin row 4 -->
    <div class="row">
      <!-- row 5 -->
      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <label>Observaciones:</label>
        <textarea class="form-control" name="observaciones" id="observaciones"></textarea>
      </div>



    </div> <!-- fin row 5 -->

    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar">
        <i class="fa fa-save"></i> Guardar</button>
      <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i>
        Cancelar</button>
    </div>

    <!-- fin -->
  </form>
</div>