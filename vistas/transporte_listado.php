<?php
// Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}
else 
{
  require "header.php";

  if($_SESSION['transporte'] == 1) 
  {
    ?>
    <!--Contenido-->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-header with-border" id="superior">
                <h1 class="box-title">Consulta
                  <button id="btnAgregar" class="btn btn-success" onclick="mostrarform(true)">
                    <i class="fa fa-plus-circle"></i> Agregar</button>
                </h1>
                <div class="box-tools pull-right">
                </div>
              </div>
              <!-- /.box-header -->
              <!-- centro -->
              <div class="panel-body table-responsive" id="listadoregistros">
                <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                  <thead>
                    <th>Opciones</th>
                    <th>Nombre/s</th>
                    <th>Apellido/s</th>
                    <th>Tipo Doc.</th>
                    <th>Numero Doc.</th>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                  <th>Opciones</th>
                    <th>Nombre/s</th>
                    <th>Apellido/s</th>
                    <th>Tipo Doc.</th>
                    <th>Numero Doc.</th>
                  </tfoot>
                </table>
              </div>
              
              <?php
              require "transporte_registro.php";
              ?>
              
              <!--Fin centro -->
            </div><!-- /.box -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
    <!--Fin-Contenido-->
    <?php
  }
  else {
    require "noacceso.php";
  }  
  
  require "footer.php";
  ?>
  <script type="text/javascript" src="scripts/consulta.js"></script>

  <?php
}
ob_end_flush();
?>
