<?php
require_once "../config/database.php";
include "../models/ProyekModel.php";
include "../models/StatusModel.php";
include "../models/TugasModel.php";

$database = new Database();
$db = $database->getConnection();

$proyek = new ProyekModel($db);
$status = new StatusModel($db);
$tugas = new TugasModel($db);

$action = $_GET['action'] ?? 'read';  // default tampilan utama

switch ($action) {

    case "get":
        // return JSON array
        $data = $tugas->getAllTugas();
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
        exit;

    case "create":
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (empty($_POST['tanggal_mulai'])) {
                $_POST['tanggal_mulai'] = date("Y-m-d");
            }
        
            if (empty($_POST['tanggal_selesai'])) {
                $_POST['tanggal_selesai'] = null;
            }
        
            $tugas->createTugas($_POST);
            header("Location: TugasController.php");
            exit;
        }
        break;

    case "update":
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id_tugas'])) {

            // Jika tanggal_mulai kosong → set ke tanggal hari ini
            if (empty($_POST['tanggal_mulai'])) {
                $_POST['tanggal_mulai'] = date("Y-m-d");
            }
    
            if (empty($_POST['tanggal_selesai'])) {
                $_POST['tanggal_selesai'] = null; 
            }
    
            $tugas->updateTugas($_POST['id_tugas'], $_POST);
            header("Location: TugasController.php");
            exit;
        }
        break;

    case "delete":
        if (isset($_GET['id'])) {
            $tugas->deleteTugas((int)$_GET['id']);
            header("Location: TugasController.php?action=read");
            exit;
        }
        break;

    case "search":
        $keyword = $_GET['keyword'] ?? '';
        $proyekList = $proyek->readProyek();
        $statusList = $status->readStatus();
        $tugasList = $tugas->searchTugas($keyword);
    
        $page_content = "../views/TugasViews.php";
        include "../views/Layout.php";
        break;

    case "read":
    default:
        $proyekList = $proyek->readProyek();
        $statusList = $status->readStatus();
        $tugasList = $tugas->getAllTugas();

        $page_content = "../views/TugasViews.php";
        include "../views/Layout.php";
        break;
}
?>