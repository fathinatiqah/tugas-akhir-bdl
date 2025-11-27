<?php
require_once "../config/database.php";
include "../models/TugasModel.php";

$database = new Database();
$db = $database->getConnection();

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
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $tugas->createTugas($_POST);
            // arahkan kembali ke daftar tugas
            header("Location: TugasController.php?action=read");
            exit;
        }
        break;

    case "update":
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // pastikan field id_tugas dikirim lewat form
            $id = $_POST['id_tugas'] ?? null;
            if ($id) {
                $tugas->updateTugas((int)$id, $_POST);
            }
            header("Location: TugasController.php?action=read");
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
        $tugasList = $tugas->searchTugas($keyword)->fetchAll(PDO::FETCH_ASSOC);
    
        $page_content = "../views/TugasViews.php";
        include "../views/Layout.php";
        break;

    case "read":
    default:
        // sekarang getAllTugas() mengembalikan array
        $tugasList = $tugas->getAllTugas();

        $page_content = "../views/TugasViews.php";
        include "../views/Layout.php";
        break;
}
?>