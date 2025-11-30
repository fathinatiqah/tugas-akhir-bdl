<?php
require_once "../config/database.php";
require_once "../models/ViewModel.php";

$database = new Database();
$db = $database->getConnection();

$viewModel = new ViewModel($db);

$action = $_GET['action'] ?? 'read';

switch($action) {

    case "refresh":
        $viewModel->refreshMV();
        header("Location: LaporanController.php?action=read");
        exit;

    case "read":
    default:
        $dataTugas = $viewModel->getDetailTugas();
        $totalTugas   = $viewModel->getTotalTugas();

        $page_content = "../views/laporan_view.php";
        include "../views/Layout.php";
        break;
}
?>
