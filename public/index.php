<?php
require_once 'config/database.php';
require_once 'controllers/EquipmentController.php';
require_once 'controllers/LoanController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$page = isset($_GET['page']) ? $_GET['page'] : 'index';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

$eqController = new EquipmentController();
$loanController = new LoanController();

if ($page == 'equipments') {
    if ($action == 'create') {
        $eqController->create();
    } elseif ($action == 'store') {
        $eqController->store();
    } elseif ($action == 'show') {
        $eqController->show($_GET['id']);
    } else {
        $eqController->index();
    }
} elseif ($page == 'loans') {
    if ($action == 'create') {
        $loanController->create();
    } elseif ($action == 'store') {
        $loanController->store();
    }
} else {
    // Default redirect ke katalog
    header('Location: index.php?page=equipments');
    exit;
}