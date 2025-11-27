<?php
require_once "../config/database.php";
include "../models/ProyekModel.php";

$database = new Database();
$db = $database->getConnection();

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
            $proyek->createProyek($_POST);
            header("Location: ProyekController.php");
            exit;
        }
        break;

    case "update":
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id_proyek'])) {
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
        // Untuk tampilan web
        $stmt = $proyek->getAllProyek();
        $proyekList = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $page_content = "../views/ProyekViews.php";
        include "../views/Layout.php";
        break;
}