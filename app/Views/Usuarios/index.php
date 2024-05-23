<?php echo $this->extend('Layout/principal'); ?>

<?php echo $this->section('titulo') ?>
<?php echo $titulo; ?>
<?php echo $this->endSection() ?>

<?php echo $this->section('estilos') ?>

<!-- Aqui coloco os ESTILOS da View -->
<link href="https://cdn.datatables.net/v/bs4/dt-2.0.3/r-3.0.0/datatables.min.css" rel="stylesheet">

<?php echo $this->endSection() ?>

<?php echo $this->section('conteudo') ?>
<!-- Aqui coloco o CONTEUDO da View -->

<div class="row">
  <div class="col-lg-12">
    <div class="block">
      
      <a href="<?php echo site_url('usuarios/criar'); ?>" class="btn btn-danger mb-5">Criar novo usuário</a>

      <div class="table-responsive">
        <table id="ajaxTable" class="table table-striped table-sm" style="width:100%">

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

<script src="https://cdn.datatables.net/v/bs4/dt-2.0.3/r-3.0.0/datatables.min.js"></script>
  
  <script>
    const DATATABLE_PTBR =  {
    "emptyTable": "Nenhum registro encontrado",
    "info": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
    "infoFiltered": "(Filtrados de _MAX_ registros)",
    "infoThousands": ".",
    "loadingRecords": "Carregando...",
    "lengthMenu": "Exibir _MENU_ resultados por página",
    "zeroRecords": "Nenhum registro encontrado",
    "search": "Pesquisar",
    "paginate": {
        "next": "Próximo",
        "previous": "Anterior",
        "first": "Primeiro",
        "last": "Último"
    },
    "aria": {
        "sortAscending": ": Ordenar colunas de forma ascendente",
        "sortDescending": ": Ordenar colunas de forma descendente"
    },
    "select": {
        "rows": {
            "_": "Selecionado %d linhas",
            "1": "Selecionado 1 linha"
        }
    }
    } 

    new DataTable('#ajaxTable', {
      language: DATATABLE_PTBR,
      ajax: "<?php echo site_url('usuarios/recuperausuarios'); ?>",
      columns: [
        { data: 'imagem' },
        { data: 'nome' },
        { data: 'email' },
        { data: 'ativo' },
      ],
      deferRender: true,
      processing: true,
      language: {
        processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>',
      },
      responsive: true,
      pagingType: $(window).width() < 768 ? "simple" : "simple_numbers",
    });
  </script>


<?php echo $this->endSection() ?>