<!-- Formulario de registro de eventos -->

<div class="panel-body" id="formularioregistros">
  <form name="formulario" id="formulario" method="POST">
    <div class="row">
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label>Nombre/s:</label>
        <input type="hidden" name="idusuario" id="idusuario">
        <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50" placeholder="Nombres" required>
      </div>
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label>Apellidos/s:</label>
        <input type="text" class="form-control" name="apellido" id="apellido" maxlength="50" placeholder="Apellidos"
          required>
      </div>
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
    </div> <!-- row -->
    <div class="row">
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label>Número Documento:</label>
        <input type="text" class="form-control" name="numero_doc" id="numero_doc" maxlength="20"
        placeholder="Número de documento">
      </div>
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label>Email:</label>
        <input type="email" class="form-control" name="email" id="email" maxlength="50"
        placeholder="Email">
      </div>
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label>Teléfono:</label>
        <input type="text" class="form-control" name="telefono" id="telefono" maxlength="30"
        placeholder="Teléfono">
      </div>
    </div> <!-- row -->
    <div class="row">
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label>Turno:</label>
        <select name="turno" id="turno" class="form-control">
          <option value="M">Mañana</option>
          <option value="T">Tarde</option>
          <option value="N">Noche</option>
        </select>
      </div>
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label>Usuario:</label>
        <input type="text" class="form-control" name="user" id="user" maxlength="20" 
        placeholder="Nombre de usuario" required>
      </div>
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label>Contraseña:</label>
        <input type="password" class="form-control" name="clave" id="clave" maxlength="64" 
        placeholder="Contraseña" required>
      </div>
    </div> <!-- row -->
    <div class="row">
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label>Permisos:</label>
        <ul style="list-style: none;" id="permisos">
  
        </ul>
      </div>
    </div> <!-- row -->
    

    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar">
        <i class="fa fa-save"></i> Guardar</button>
      <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i>
        Cancelar</button>
    </div>
  </form>
</div>