<?= $this->extend('Layout/template') ?>

<!-- Css -->
<?= $this->section('contentCss'); ?>

<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('contentJs'); ?>

<?= $this->endSection(); ?>

<!-- Html -->
<?= $this->section('content'); ?>
    <h1>ini dahsboard nasabah</h1>
<?= $this->endSection(); ?>