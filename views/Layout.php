<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Proyekku Dashboard</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
               * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body, html {
    height: 100%;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #ffeef8 0%, #fff5f9 100%);
    color: #333;
}

/* ===== DASHBOARD CONTAINER ===== */
.dashboard-container {
    display: grid;
    grid-template-columns: 280px 1fr;
    grid-template-rows: 70px 1fr;
    grid-template-areas:
        "sidebar header"
        "sidebar main";
    height: 100vh;
}

/* ===== SIDEBAR ===== */
.sidebar {
    grid-area: sidebar;
    background: linear-gradient(180deg, #ff6b9d 0%, #c44569 100%);
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    box-shadow: 4px 0 20px rgba(255, 107, 157, 0.15);
    position: relative;
    overflow: hidden;
}

.sidebar::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
    pointer-events: none;
}

.sidebar .logo {
    font-size: 1.75rem;
    font-weight: bold;
    margin-bottom: 2.5rem;
    color: white;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    position: relative;
    z-index: 1;
}

.sidebar .logo i {
    background: rgba(255, 255, 255, 0.2);
    padding: 0.5rem;
    border-radius: 12px;
    backdrop-filter: blur(10px);
}

.sidebar nav ul {
    list-style: none;
    position: relative;
    z-index: 1;
}

.sidebar nav ul li {
    margin-bottom: 0.5rem;
}

.sidebar nav ul li a {
    text-decoration: none;
    color: rgba(255, 255, 255, 0.9);
    font-weight: 500;
    display: flex;
    align-items: center;
    padding: 0.875rem 1rem;
    border-radius: 12px;
    transition: all 0.3s ease;
    gap: 0.875rem;
    font-size: 0.95rem;
}

.sidebar nav ul li a i {
    width: 20px;
    text-align: center;
    font-size: 1.1rem;
}

.sidebar nav ul li a:hover {
    background: rgba(255, 255, 255, 0.25);
    color: white;
    transform: translateX(5px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.sidebar nav ul li a.active {
    background: white;
    color: #ff6b9d;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
}

.sidebar-bottom {
    position: relative;
    z-index: 1;
}

/* ===== HEADER ===== */
.header {
    grid-area: header;
    background: white;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 2rem;
    box-shadow: 0 2px 20px rgba(255, 107, 157, 0.08);
    position: relative;
    z-index: 10;
}

.header::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 3px;
    background: linear-gradient(90deg, #ff6b9d 0%, #ffc3a0 50%, #ff6b9d 100%);
}

.header .actions {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.header .actions .btn {
    padding: 0.625rem 1.5rem;
    border: none;
    border-radius: 25px;
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.header .actions .btn-primary {
    background: linear-gradient(135deg, #ff6b9d 0%, #ff8fab 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(255, 107, 157, 0.3);
}

.header .actions .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 25px rgba(255, 107, 157, 0.4);
}

.header .actions .btn-secondary {
    background: white;
    color: #ff6b9d;
    border: 2px solid #ff6b9d;
}

.header .actions .btn-secondary:hover {
    background: linear-gradient(135deg, #ffe5f0 0%, #fff0f5 100%);
    transform: translateY(-2px);
}

.header .user-info {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-left: auto;
}

.header .notification {
    position: relative;
    cursor: pointer;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.header .notification:hover {
    background: #ffe5f0;
}

.header .notification i {
    font-size: 1.2rem;
    color: #ff6b9d;
}

.header .notification .badge {
    position: absolute;
    top: 5px;
    right: 5px;
    background: #ff6b9d;
    color: white;
    border-radius: 50%;
    width: 18px;
    height: 18px;
    font-size: 0.7rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

.header .user {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.5rem 1rem;
    border-radius: 25px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.header .user:hover {
    background: #ffe5f0;
}

.header .user .avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #ff6b9d 0%, #ffc3a0 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 1rem;
    box-shadow: 0 4px 10px rgba(255, 107, 157, 0.3);
}

.header .user .user-details {
    display: flex;
    flex-direction: column;
}

.header .user .user-name {
    font-weight: 600;
    color: #333;
    font-size: 0.9rem;
}

.header .user .user-role {
    font-size: 0.75rem;
    color: #999;
}

/* ===== MAIN CONTENT AREA ===== */
.main {
    grid-area: main;
    padding: 2rem;
    overflow-y: auto;
}

/* ===== RESPONSIVE DESIGN ===== */
@media (max-width: 768px) {
    .dashboard-container {
        grid-template-columns: 1fr;
        grid-template-rows: 70px auto 1fr;
        grid-template-areas:
            "header"
            "sidebar"
            "main";
    }

    .sidebar {
        flex-direction: row;
        overflow-x: auto;
        padding: 1rem;
    }

    .sidebar nav ul {
        display: flex;
        gap: 0.5rem;
    }

    .sidebar nav ul li {
        margin-bottom: 0;
    }

    .sidebar .logo {
        margin-right: 1rem;
        margin-bottom: 0;
        font-size: 1.25rem;
    }

    .header {
        padding: 0 1rem;
    }

    .header .user .user-details {
        display: none;
    }

    .main {
        padding: 1rem;
    }
}

@media (max-width: 480px) {
    .sidebar .logo {
        font-size: 1.1rem;
    }

    .sidebar nav ul li a {
        font-size: 0.85rem;
        padding: 0.625rem 0.75rem;
    }

    .header .actions .btn {
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
    }
}
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div id="sidebar">
        <?php include "Sidebar.php"; ?>
    </div>

</body>
</html>
