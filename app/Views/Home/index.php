<?php echo $this->extend('Layout/principal'); ?>

<?php echo $this->section('titulo') ?>
    <?php echo $titulo; ?>
<?php echo $this->endSection() ?>

<?php echo $this->section('estilos') ?>
  <!-- Aqui coloco os ESTILOS da View -->
<?php echo $this->endSection() ?>

<?php echo $this->section('conteudo') ?>
  <!-- Aqui coloco o CONTEUDO da View -->
<?php echo $this->endSection() ?>

<?php echo $this->section('scripts') ?>
  <!-- Aqui coloco os SCRIPTS da View -->
<?php echo $this->endSection() ?>

