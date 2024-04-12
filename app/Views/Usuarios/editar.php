<?php echo $this->extend('Layout/principal'); ?>

<?php echo $this->section('titulo') ?>
<?php echo $titulo; ?>
<?php echo $this->endSection() ?>

<?php echo $this->section('estilos') ?>
<!-- Aqui coloco os ESTILOS da View -->
<?php echo $this->endSection() ?>

<?php echo $this->section('conteudo') ?>
<!-- Aqui coloco o CONTEUDO da View -->
<div class="row">
  <div class="col-lg-6">
    <div class="block">
      <div class="block-body">

        <!-- Exibira os retornos do backend -->
        <div id="response">

        </div>

        <?php echo form_open('/', ['id' => 'form'], ['id' => "$usuario->id"]) ?>

          <div class="form-group mt-5 mb-2">

            <input id="btn-salvar" type="submit" value="Salvar" class="btn btn-danger mr-2">
            <a href="<?php echo site_url("usuarios/exibir/$usuario->id") ?>" class="btn btn-secondary ml-2">Voltar</a>

          </div>

        <?php echo form_close(); ?>

      </div> <!-- FIM do "block-body" -->
    </div> <!-- FIM do "block" -->
  </div> <!-- FIM "col-lg-6" -->
</div> <!-- FIM "row" -->


<?php echo $this->endSection() ?>

<?php echo $this->section('scripts') ?>
<!-- Aqui coloco os SCRIPTS da View -->
<?php echo $this->endSection() ?>