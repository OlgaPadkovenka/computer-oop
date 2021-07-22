<?php require_once './models/Cpu.php'; ?>

<?php
switch ($_GET['type']) {
    case 'cpu':
        $component = Cpu::findById($_GET['id']);
        break;
    case 'gpu':
        break;
    case 'hdd':
        break;
    case 'os':
        break;
    case 'ram':
        break;
    default:
        throw new Exception('Unkown omponent type "' . $_GET['type'] . '".');
}
?>

<?php include './templates/header.php' ?>

<div class="container">
    <h1><?= $component->getName() ?></h1>
    <ul>
        <li>Type de composant</li>
        <li>Marque: <?= $component->getBrand()->getName() ?></li>
        <li>Prix: <?= $component->getPrice() ?>€</li>
        <li>Caractéristiques supplémentaires</li>
    </ul>
</div>

<?php include './templates/footer.php' ?>