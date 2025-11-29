<?php 
require_once "../config/database.php";
include "../models/TimModel.php";
include "../models/AnggotaModel.php";

$database = new Database();
$db = $database->getConnection();

$tim = new TimModel($db);
$anggota = new AnggotaModel($db);

$action = $_GET['action'] ?? 'read';  // default tampilan utama

switch ($action) {

    case "get":
        $stmt = $anggota->getAllAnggota();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
        exit;

    case "create":
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $anggota->createAnggota($_POST);
            header("Location: AnggotaController.php");
            exit;
        }
        break;

    case "update":
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $anggota->updateAnggota($_POST['id_anggota'], $_POST);
            header("Location: AnggotaController.php");
            exit;
        }
        break;

    case "delete":
        if (isset($_GET['id'])) {
            $anggota->deleteAnggota($_GET['id']);
            header("Location: AnggotaController.php");
            exit;
        }
        break;

    case "read":
    default:
        $timList = $tim->readTim();
        $anggotaList = $anggota->getAllAnggota();

        $page_content = "../views/AnggotaViews.php";
        include "../views/Layout.php";
        break;
}
?>