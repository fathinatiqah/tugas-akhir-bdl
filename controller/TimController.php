<?php
require_once "../config/database.php";
include "../models/TimModel.php";

$database = new Database();
$db = $database->getConnection();

$tim = new TimModel($db);

$action = $_GET['action'] ?? 'read';  // default tampilan utama

switch ($action) {

    case "get":
        $stmt = $tim->getAllTim();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
        exit;

    case "create":
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $tim->createTim($_POST);
            header("Location: TimController.php");
            exit;
        }
        break;

    case "update":
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $tim->updateTim($_POST['id_tim'], $_POST);
            header("Location: TimController.php");
            exit;
        }
        break;

    case "delete":
        if (isset($_GET['id'])) {
            $tim->deleteTim($_GET['id']);
            header("Location: TimController.php");
            exit;
        }
        break;

    case "read":
    default:
        $timList = $tim->getAllTim();

        $page_content = "../views/TimViews.php";
        include "../views/Layout.php";
        break;
}
?>