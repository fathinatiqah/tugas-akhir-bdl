<?php
require_once "../config/database.php";
include "../models/StatusModel.php";

$database = new Database();
$db = $database->getConnection();

$status = new StatusModel($db);

$action = $_GET['action'] ?? 'read';

switch ($action) {
    case "read":
        default:
            $statusList = $status->getAllStatus();
            break;
}
?>