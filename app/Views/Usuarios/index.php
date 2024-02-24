<?php echo $this->extend('Layout/principal'); ?>

<?php echo $this->section('titulo') ?>
<?php echo $titulo; ?>
<?php echo $this->endSection() ?>

<?php echo $this->section('estilos') ?>
<!-- Aqui coloco os ESTILOS da View -->
  <link href="https://cdn.datatables.net/v/bs4/dt-2.0.0/r-3.0.0/datatables.min.css" rel="stylesheet">
<?php echo $this->endSection() ?>

<?php echo $this->section('conteudo') ?>
<!-- Aqui coloco o CONTEUDO da View -->

<div class="row">

  <div class="col-lg-12">
    <div class="block">
      
      <div class="table-responsive">
        <table id="ajaxTable" class="table table-striped table-sm" stype="width: 100%;">

          <thead>
            <tr>
              <th>Imagem</th>
              <th>Nome</th>
              <th>E-mail</th>
              <th>Situação</th>
            </tr>
          </thead>
     
        </table>
      </div>
    </div>
  </div>

</div>




<?php echo $this->endSection() ?>

<?php echo $this->section('scripts') ?>
<!-- Aqui coloco os SCRIPTS da View -->
  <script src="https://cdn.datatables.net/v/bs4/dt-2.0.0/r-3.0.0/datatables.min.js">

  </script>

<?php echo $this->endSection() ?>