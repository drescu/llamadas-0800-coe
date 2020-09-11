<!-- Formulario de registro de eventos -->

<div class="panel-body" id="formularioregistros">
  <form name="formulario" id="formulario" method="POST">  
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
        <input type="hidden" name="idconsulta" id="idconsulta">
        <input type="text" class="form-control" name="numero_doc" id="numero_doc" maxlength="20" required>
      </div>
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label>Nombre/s:</label>
        <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50" required>
    </div>
    </div>
    <div class="row">
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <label>Apellido/s:</label>
        <input type="text" class="form-control" name="apellido" id="apellido" maxlength="50" required>
      </div>
    </div>

    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar">
        <i class="fa fa-save"></i> Guardar</button>
      <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i>
      Cancelar</button>
    </div>

    <!--boton de prueba axios-->
    <div class="row">
      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <label>Sexo:</label><br>
          <label class="radio-inline">
            <input type="radio" name="sexo" id="sexo1" value="M">M
          </label>
          <label class="radio-inline">
            <input type="radio" name="sexo" id="sexo2" value="F">F
          </label>
        </div>
      </div>

      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <input type="text" class="form-control" name="buscar" id="buscar">
      </div>
      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">  
        <button class="btn btn-warning" onclick="buscarrenaper()" type="button">
        <i class="fa fa-search"></i>Buscar</button>
      </div>  
    </div>  
    <!-- fin -->
  </form>
</div>