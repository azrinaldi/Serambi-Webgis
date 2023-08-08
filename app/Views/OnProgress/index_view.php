<?= $this->extend('_layouts/index_view.php') ?>

<?= $this->section('content') ?>
<div id="error">
    <div class="error-page container">
        <div class="col-md-8 col-12 offset-md-2">
            <img class="img-error d-flex justify-content-center" src="/mazer/assets/images/samples/error-404.png" alt="Not Found">
            <div class="text-center">
                <h1 class="error-title">NOT FOUND</h1>
                <p class='fs-5 text-gray-600'>The page you are looking not found.</p>
                <a href="/Home" class="btn btn-lg btn-outline-primary mt-3">Go Home</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>


<?= $this->section('style') ?>
<style>
    .img-error{
        width: 90%;
    }
</style>
<?= $this->endSection() ?>


<?= $this->section('javascript') ?>
<script>

</script>
<?= $this->endSection() ?>