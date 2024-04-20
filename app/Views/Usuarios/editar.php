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
        beforeSend: function() {
          $("#response").html(''); // Limpando a div response
          $("#btn-salvar").val('Por favor aguarde ...'); // Altera o que esta escrito no botao de salvar !
        },
        // Definir o que ocorre no SUCESSO
        success: function(response) {
          $("#btn-salvar").val('Salvar'); // Volta o que estava escrito originalmente no botao de salvar !
          $("#btn-salvar").removeAttr("disabled"); // Retirando o atributo disabled, o botao ficara habilitado denovo.

          // Verifica se no response tem uma chave 'erro'
          if (!response.erro) {
            // Atualizar o token para permitir submeter o formulario novamente
            // senão o codeigniter nao permite >> por segurança
            $('[name=csrf_ordem]').val(response.token);

            if (response.info) {
              $("#response").html('<div class="alert alert-info">' + response.info + '</div>');
            }

          } else {
            // Existem erros de validação
          }

        },
        // Definir o que ocorre no ERRO (Erro de Processamento)
        error: function() {
          alert('Não foi possível processar a solicitação. Entre em contato com o suporte técnico.');
          $("#btn-salvar").val('Salvar'); // Volta o que estava escrito originalmente no botao de salvar !
          $("#btn-salvar").removeAttr("disabled"); // Retirando o atributo disabled, o botao ficara habilitado denovo.
        },

      });

    });

  });
</script>

<?php echo $this->endSection() ?>