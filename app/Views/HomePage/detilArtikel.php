<?= $this->extend('Layout/template') ?>

<!-- Css -->
<?= $this->section('contentCss'); ?>
    <style>
    </style>

<?= $this->endSection(); ?>

<!-- JS -->
<?= $this->section('contentJs'); ?>

<?= $this->endSection(); ?>

<!-- Body -->
<?= $this->section('content'); ?>

    <!-- **** Loading Spinner **** -->
    <?= $this->include('Components/loadingSpinner'); ?>
    <!-- **** Alert Info **** -->
    <?= $this->include('Components/alertInfo'); ?>

    <h1>content here</h1>

<?= $this->endSection(); ?>