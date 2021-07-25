<?php



include './models/Cpu.php';
include './models/Gpu.php';
require_once 'data/config.php';



?>

<?php

$errorMessages = [
    'Les paramètres de requête ne doivent pas être vides.',
    'Un paramètre de requête est manquant.',
    'Un paramètre de requête référence un enregistrement non-existant.',
];

$cpuIndex = null;
if (isset($_GET['cpu'])) {
    $cpuIndex = intval($_GET['cpu']);
}

$gpuIndex = null;
if (isset($_GET['gpu'])) {
    $gpuIndex = intval($_GET['gpu']);
}

$hddIndex = null;
if (isset($_GET['hdd'])) {
    $hddIndex = intval($_GET['hdd']);
}

$osIndex = null;
if (isset($_GET['os'])) {
    $osIndex = intval($_GET['os']);
}

$ramIndex = null;
if (isset($_GET['ram'])) {
    $ramIndex = intval($_GET['ram']);
}

?>

<?php include './templates/header.php' ?>

<?php
// Récupère tous les processeurs en base de données
$cpus = Cpu::findAll();
?>

<div class="container">
    <img src="images/Headerbild-pc-gamer-main.jpg" class="img-fluid mb-4" alt="PC gamer" />

    <?php if (isset($_GET['totalPrice'])) : ?>
        <div class="alert alert-primary" role="alert">
            Le prix de votre configuration est de <?= $_GET['totalPrice'] ?>€
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])) : ?>
        <div class="alert alert-danger" role="alert">
            <?= $errorMessages[$_GET['error']] ?>
        </div>
    <?php endif; ?>

    <h1>Composez votre PC gaming sur mesure</h1>
    <form action="actions/compute-config-price.php">
        <h2 class="mt-4 mb-2">Composants</h2>
        <div class="form-group mb-3">
            <label for="cpu">Processeur</label>
            <select name="cpu" class="form-control">
                <?php foreach ($cpus as $index => $cpu) : ?>
                    <option value="<?= $cpu->getId() ?>" <?php if (intval($cpuIndex) === $cpu->getId()) {
                                                                echo 'selected';
                                                            } ?>><?= $cpu->getName() ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="ram">Mémoire vive</label>
            <select name="ram" class="form-control">
                <?php foreach ($rams as $index => $ram) : ?>
                    <option value="<?= $index ?>" <?php if ($ramIndex === $index) {
                                                        echo 'selected';
                                                    } ?>><?= $ram['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="gpu">Carte graphique</label>
            <select name="gpu" class="form-control">
                <?php foreach ($gpus as $index => $gpu) : ?>
                    <option value="<?= $index ?>" <?php if ($gpuIndex === $index) {
                                                        echo 'selected';
                                                    } ?>><?= $gpu['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="hdd">Stockage</label>
            <select name="hdd" class="form-control">
                <?php foreach ($hdds as $index => $hdd) : ?>
                    <option value="<?= $index ?>" <?php if ($hddIndex === $index) {
                                                        echo 'selected';
                                                    } ?>><?= $hdd['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="os">Système d'exploitation</label>
            <select name="os" class="form-control">
                <?php foreach ($oss as $index => $os) : ?>
                    <option value="<?= $index ?>" <?php if ($osIndex === $index) {
                                                        echo 'selected';
                                                    } ?>><?= $os['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Calculer</input>
    </form>
</div>

<?php include './templates/footer.php' ?>