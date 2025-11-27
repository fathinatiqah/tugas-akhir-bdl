<?php
require_once "../config/database.php";
require_once "../models/ViewModel.php";

$database = new Database();
$db = $database->getConnection();

$viewModel = new ViewModel($db);

$action = $_GET['action'] ?? 'read';

// Controller Logic
switch($action) {

    case "refresh":
        $viewModel->refreshMV();
        header("Location: ViewController.php?action=read");
        exit;

    case "read":
    default:
        $proyekDetail = $viewModel->getProyekDetail();
        $totalTugas   = $viewModel->getTotalTugas();

        $page_content = "../views/halaman_view.php";
        include "../views/Layout.php";
        break;
}
?>
