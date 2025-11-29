<?php
require_once "../config/database.php";
require_once "../models/TransactionModel.php";

$db = new Database();
$conn = $db->getConnection();

$trx = new TransactionModel($conn);

$action = $_GET['action'] ?? 'form';

switch ($action) {

    case "execute":
        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $result = $trx->createProyekDenganTugas($_POST, $_POST);

            // Kirim hasil ke view
            $message = $result['msg'];

            $page_content = "../views/TransactionViews.php";
            include "../views/Layout.php";
            break;
        }

    case "form":
    default:
        $page_content = "../views/TransactionViews.php";
        include "../views/Layout.php";
        break;
}
?>