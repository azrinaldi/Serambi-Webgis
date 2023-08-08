<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <?= $this->renderSection('style') ?>
</head>

<body>
    <div id="app">
        
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <?php include 'sidebar.php' ?>  
            <?= $this->renderSection('content') ?>
            <?php 
            if ($title != 'Beranda') {
                include 'footer.php';
            }
            ?>
        </div>
    </div>
    <?php include 'javascript.php' ?>
    <?= $this->renderSection('javascript') ?>
</body>

</html>