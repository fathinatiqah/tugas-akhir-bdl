<?php
require_once "../config/database.php";
include "../models/KlienModel.php";

$database = new Database();
$db = $database->getConnection();

$klien = new KlienModel($db);

$action = $_GET['action'] ?? 'read';  // default tampilan utama

switch ($action) {

    case "get":
        $stmt = $klien->getAllKlien();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
        exit;

    case "create":
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $klien->createKlien($_POST);
            header("Location: KlienController.php");
            exit;
        }
        break;

    case "update":
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $klien->updateKlien($_POST['id_klien'], $_POST);
            header("Location: KlienController.php");
            exit;
        }
        break;

    case "delete":
        if (isset($_GET['id'])) {
            $klien->deleteKlien($_GET['id']);
            header("Location: KlienController.php");
            exit;
        }
        break;

    case "read":
    default:
        $klienList = $klien->getAllKlien();

        $page_content = "../views/KlienViews.php";
        include "../views/Layout.php";
        break;
}
?>