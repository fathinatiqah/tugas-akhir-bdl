<?php
include 'config/database.php';
include 'models/Overview.php';

$db = new Database();
$conn = $db->getConnection();
$model = new Overview($conn);

// Statistik untuk dashboard
$totalAnggota = $model->getTotalAnggota();
$totalTim = $model->getTotalTim();
$totalKlien = $model->getTotalKlien();
$totalProyekAktif = $model->getTotalProyekAktif(1);
$totalBudget = $model->getTotalBudget();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Proyek</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body, html {
      height: 100%;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f5f6f8;
      color: #333;
    }

    .dashboard-container {
      display: grid;
      grid-template-columns: 250px 1fr;
      grid-template-rows: 60px 1fr;
      grid-template-areas:
        "sidebar header"
        "sidebar main";
      height: 100vh;
      padding: 20px;
    }

    /* Sidebar */
    .sidebar {
      grid-area: sidebar;
      background-color: #ffffff;
      border-right: 1px solid #e0e0e0;
      padding: 1rem;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .sidebar .logo {
      font-size: 1.25rem;
      font-weight: bold;
      margin-bottom: 2rem;
    }

    .sidebar nav ul {
      list-style: none;
    }
    .sidebar nav ul li {
      margin-bottom: 1rem;
    }
    .sidebar nav ul li a {
      text-decoration: none;
      color: #555;
      font-weight: 500;
      display: flex;
      align-items: center;
      padding: 0.5rem;
      border-radius: 4px;
      transition: background-color 0.2s;
    }
    .sidebar nav ul li a:hover {
      background-color: #e8f0ea;
      color: #2e7d32;
    }

    /* Header */
    .header {
      grid-area: header;
      background-color: #ffffff;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 1.5rem;
      border-bottom: 1px solid #e0e0e0;
    }

    .header .actions {
      display: flex;
      align-items: center;
      gap: 1rem;
    }
    .header .actions .btn {
      padding: 0.4rem 1rem;
      border: none;
      border-radius: 20px;
      font-size: 0.9rem;
      cursor: pointer;
      transition: background-color 0.2s;
    }
    .header .actions .btn-primary {
      background-color: #2e7d32;
      color: white;
    }
    .header .actions .btn-primary:hover {
      background-color: #276c2a;
    }
    .header .actions .btn-secondary {
      background-color: transparent;
      color: #2e7d32;
      border: 1px solid #2e7d32;
    }
    .header .actions .btn-secondary:hover {
      background-color: #e8f0ea;
    }

    .header .user {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    .header .user .avatar {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      background-color: #bdbdbd;
    }

    /* Main konten */
    .main {
      grid-area: main;
      padding: 1.5rem;
      overflow-y: auto;
    }

    /* --- card layout styling --- */
    .cards-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 18px;
      margin-top: 18px;
      align-items: start;
    }

    /* Card base */
    .card {
      background: #fff;
      border-radius: 10px;
      padding: 18px;
      box-shadow: 0 6px 18px rgba(38, 78, 162, 0.06);
      border-left: 4px solid rgba(38, 78, 162, 0.15);
      min-height: 86px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    /* Sizes */
    .card.small { padding: 14px 18px; }
    .card.medium { padding: 18px; min-height: 110px; }
    .card.big { padding: 22px; min-height: 120px; }

    /* Title / value */
    .card-title {
      font-size: 0.85rem;
      color: #6b7280; /* grey */
      font-weight: 600;
      margin-bottom: 6px;
      text-transform: capitalize;
    }

    .card-value {
      font-size: 1.45rem;
      font-weight: 700;
      color: #1f2937; /* dark */
      line-height: 1;
    }

    /* emphasized large value */
    .card-value.large {
      font-size: 1.6rem;
      color: #155e75;
    }

    /* sub text under big card */
    .card-sub {
      font-size: 0.85rem;
      color: #6b7280;
      margin-top: 8px;
    }

    /* Responsif */
    @media (max-width: 768px) {
      .dashboard-container {
        grid-template-columns: 1fr;
        grid-template-rows: 60px auto 1fr;
        grid-template-areas:
          "header"
          "sidebar"
          "main";
      }
      .sidebar {
        flex-direction: row;
        overflow-x: auto;
      }
      .sidebar nav ul {
        display: flex;
        gap: 1rem;
      }
      .sidebar nav ul li {
        margin-bottom: 0;
      }
      .sidebar .logo {
        margin-right: 1rem;
      }
    }

    @media (max-width: 1100px) {
    .cards-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 640px) {
      .cards-grid { grid-template-columns: 1fr; }
      .card { min-height: 80px; }
    }
  </style>
</head>
<body>
  <div class="dashboard-container">
    <aside class="sidebar">
      <div>
        <div class="logo">Proyekku</div>
        <nav>
          <ul>
            <li><a href="http://localhost/proyek">Dashboard</a></li>
            <li><a href="http://localhost/proyek/controller/KlienController.php?action=read">Klien</a></li>
            <li><a href="http://localhost/proyek/controller/ProyekController.php?action=read">Project</a></li>
            <li><a href="http://localhost/proyek/controller/TugasController.php?action=read">Tugas</a></li>
            <li><a href="http://localhost/proyek/controller/TimController.php?action=read">Team</a></li>
            <li><a href="http://localhost/proyek/controller/AnggotaController.php?action=read">Team Member</a></li>
          </ul>
        </nav>
      </div>
      <div>
        <nav>
          <ul>
            <li><a href="#">Settings</a></li>
            <li><a href="#">Help</a></li>
          </ul>
        </nav>
      </div>
    </aside>

    <header class="header">
      <div class="actions">
        <button class="btn btn-primary" onclick="window.location.href='controller/ViewController.php'">View</button>
        <button class="btn btn-secondary">Import Data</button>
    </header>

    <main class="main">
      <h1>Dashboard</h1>
      <p>Selamat datang di dashboard manajemen proyek. Kamu bisa menampilkan ringkasan proyek, tugas, statistik, dan lainnya di bagian ini.</p>
      <?php
      // Pastikan variabel ada — kalau tidak, beri nilai default
      $totalAnggota     = $totalAnggota     ?? 0;
      $totalTim         = $totalTim         ?? 0;
      $totalKlien       = $totalKlien       ?? 0;
      $totalProyekAktif = $totalProyekAktif ?? 0;
      $totalBudget      = $totalBudget      ?? 0;
      ?>
      <section class="cards-grid">
    <!-- Small summary cards -->
    <div class="card small">
      <div class="card-title">Total Anggota</div>
      <div class="card-value"><?= htmlspecialchars($totalAnggota) ?></div>
    </div>

    <div class="card small">
      <div class="card-title">Total Tim</div>
      <div class="card-value"><?= htmlspecialchars($totalTim) ?></div>
    </div>

    <div class="card small">
      <div class="card-title">Total Tim</div>
      <div class="card-value"><?= htmlspecialchars($totalKlien) ?></div>
    </div>

    <div class="card small">
      <div class="card-title">Proyek Aktif</div>
      <div class="card-value"><?= htmlspecialchars($totalProyekAktif) ?></div>
    </div>

    <!-- Big budget card -->
    <div class="card big" style="grid-column: 1 / -1;">
      <div class="card-title">Total Budget Proyek</div>
      <div class="card-value large"><?= htmlspecialchars(number_format($totalBudget, 2, ',', '.')) ?></div>
    </div>
  </section>
      <br>
    </main>
  </div>
</body>
</html>