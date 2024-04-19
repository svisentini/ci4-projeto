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

        <?php echo $this->include('Usuarios/_form'); ?>

        <div class="form-group mt-5 mb-2">

          <input id="btn-salvar" type="submit" value="Salvar" class="btn btn-danger btn-sm mr-2">
          <a href="<?php echo site_url("usuarios/exibir/$usuario->id") ?>" class="btn btn-sm btn-secondary ml-2">Voltar</a>

        </div>

        <?php echo form_close(); ?>

      </div> <!-- FIM do "block-body" -->
    </div> <!-- FIM do "block" -->
  </div> <!-- FIM "col-lg-6" -->
</div> <!-- FIM "row" -->


<?php echo $this->endSection() ?>

<?php echo $this->section('scripts') ?>
<!-- Aqui coloco os SCRIPTS da View -->

<script>
  $(document).ready(function() {

    $("#form").on('submit', function(e) {

      //alert('Chegou ate aqui');
      e.preventDefault();

      $.ajax({
        type: 'POST',
        url: '<?php echo site_url('usuarios/atualizar'); ?>',
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        // Ações antes de Enviar a requisição !
        beforeSend: function(){
          $("#response").html('');  // Limpando a div response
          $("#btn-salvar").val('Por favor aguarde ...'); // Altera o que esta escrito no botao de salvar !
        },
        // Definir o que ocorre no Sucesso
        success: function(response){
          $("#btn-salvar").val('Salvar'); // Volta o que estava escrito originalmente no botao de salvar !
          $("#btn-salvar").removeAttr("disabled"); // Retirando o atributo disabled, o botao ficara habilitado denovo.
        },

      });

    });

  });
</script>

<?php echo $this->endSection() ?>