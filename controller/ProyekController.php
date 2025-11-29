<?php 
require_once "../config/database.php";
include "../models/KlienModel.php";
include "../models/TimModel.php";
include "../models/StatusModel.php";
include "../models/ProyekModel.php";

$database = new Database();
$db = $database->getConnection();

$klien = new KlienModel($db);
$tim = new TimModel($db);
$status = new StatusModel($db);
$proyek = new ProyekModel($db);

$action = $_GET['action'] ?? 'read';

switch ($action) {
    case "get":
        // Ambil semua proyek, output JSON
        $stmt = $proyek->getAllProyek();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
        exit;

    case "getById":
        if (isset($_GET['id'])) {
            $id = (int) $_GET['id'];
            $data = $proyek->getProyekById($id);
            echo json_encode($data);
            exit;
        }
        break;

    case "create":
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (empty($_POST['tanggal_mulai'])) {
                $_POST['tanggal_mulai'] = date("Y-m-d");
            }
        
            if (empty($_POST['tanggal_selesai'])) {
                $_POST['tanggal_selesai'] = null;
            }
        
            $proyek->createProyek($_POST);
            header("Location: ProyekController.php");
            exit;
        }
        break;

    case "update":
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id_proyek'])) {

            // Jika tanggal_mulai kosong → set ke tanggal hari ini
            if (empty($_POST['tanggal_mulai'])) {
                $_POST['tanggal_mulai'] = date("Y-m-d");
            }
    
            if (empty($_POST['tanggal_selesai'])) {
                $_POST['tanggal_selesai'] = null; 
            }
    
            $proyek->updateProyek($_POST['id_proyek'], $_POST);
            header("Location: ProyekController.php");
            exit;
        }
        break;

    case "delete":
        if (isset($_GET['id'])) {
            $id = (int) $_GET['id'];
            $proyek->deleteProyek($id);
            header("Location: ProyekController.php");
            exit;
        }
        break;

    case "read":
    default:
        $limit = 5; // jumlah data per halaman
        $page  = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;

        $offset = ($page - 1) * $limit;

        // ambil data paginasi
        $klienList = $klien->readKlien();
        $timList = $tim->readTim();
        $statusList = $status->readStatus();
        $proyekList = $proyek->getPaginatedProyek($limit, $offset);

        // hitung total halaman
        $totalData = $proyek->countProyek();
        $totalPages = ceil($totalData / $limit);

        $page_content = "../views/ProyekViews.php";
        include "../views/Layout.php";
        break;

    case "search":
        $keyword = $_GET['keyword'] ?? "";
        $statusList = $status->readStatus();
        $proyekList = $proyek->searchProyek($keyword);

        $page_content = "../views/ProyekViews.php";
        include "../views/Layout.php";
        break;

}