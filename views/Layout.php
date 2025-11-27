<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Proyekku Dashboard</title>
    <link rel="stylesheet" href="/proyek/assets/style.css">
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

    .header .search-box {
      flex: 1;
      margin-right: 1rem;
    }
    .header .search-box input {
      width: 100%;
      padding: 0.5rem 1rem;
      border: 1px solid #ccc;
      border-radius: 24px;
      font-size: 0.9rem;
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
    </style>
</head>
<body>
<div id="dashboard-wrapper">

    <!-- SIDEBAR -->
    <div id="sidebar">
        <?php include "Sidebar.php"; ?>
    </div>
</div>

</body>
</html>
