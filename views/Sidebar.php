
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
        <button class="btn btn-primary" onclick="window.location.href='../controller/ViewController.php'">View</button>
        <button class="btn btn-secondary">Import Data</button>
    </header>

    <main class="main">
      <?php 
        if (isset($page_content) && file_exists($page_content)) {
            include $page_content;
        }
    ?>
    </main>
  </div>
