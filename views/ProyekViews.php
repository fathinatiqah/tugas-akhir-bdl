<h2>Manajemen Data Proyek</h2>

<!-- Form Tambah Proyek Baru -->
  <h3>Tambah Proyek Baru</h3>
  <form action="../controller/ProyekController.php?action=create" method="POST">
    <div style="margin-bottom:10px;">
      <label for="id_klien">Klien:</label><br>
      <select name="id_klien" required>
            <option value="">-- Pilih Klien --</option>
            <?php foreach ($klienList as $klien): ?>
                <option value="<?= $klien['id_klien'] ?>">
                    <?= $klien['nama_klien'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div style="margin-bottom:10px;">
      <label for="id_tim">Tim:</label><br>
      <select name="id_tim" required>
            <option value="">-- Pilih Tim --</option>
            <?php foreach ($timList as $tim): ?>
                <option value="<?= $tim['id_tim'] ?>">
                    <?= $tim['nama_tim'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div style="margin-bottom:10px;">
      <label for="id_status">Status:</label><br>
      <select name="id_status" required>
      <option value="">-- Pilih Status --</option>
            <?php foreach ($statusList as $status): ?>
                <option value="<?= $status['id_status'] ?>">
                    <?= $status['nama_status'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div style="margin-bottom:10px;">
      <label for="nama_proyek">Nama Proyek:</label><br>
      <input type="text" name="nama_proyek" id="nama_proyek" placeholder="Nama Proyek">
    </div>
    <div style="margin-bottom:10px;">
      <label for="budget">Budget:</label><br>
      <input type="text" name="budget" id="budget" placeholder="Budget (mis: 1000000.00)">
    </div>
    <div style="margin-bottom:10px;">
      <label for="tanggal_mulai">Tanggal Mulai:</label><br>
      <input type="date" name="tanggal_mulai" id="tanggal_mulai" style="padding:5px; width: 200px;">
    </div>
    <div style="margin-bottom:10px;">
      <label for="tanggal_selesai">Tanggal Selesai:</label><br>
      <input type="date" name="tanggal_selesai" id="tanggal_selesai" style="padding:5px; width: 200px;">
    </div>

    <button type="submit">Simpan Proyek</button>
  </form>
<br>
<hr>

<!-- Search Proyek -->
<form action="../controller/ProyekController.php" method="GET" style="margin-bottom: 20px;">
    <input type="hidden" name="action" value="search">

    <input 
        type="text" 
        name="keyword" 
        placeholder="Cari proyek berdasarkan Nama" 
        style="padding: 7px; width: 320px;"
        value="<?= $_GET['keyword'] ?? '' ?>"
    >

    <button type="submit" style="padding: 6px 12px;">Cari</button>

    <a href="../controller/ProyekController.php" 
       style="padding: 6px 12px; background: #ddd; text-decoration:none; margin-left:10px;">
       Reset
    </a>
</form>

<!-- Tampilan Data Proyek -->
<h3>Daftar Proyek</h3>
<table border="1" cellpadding="8" cellspacing="0" style="border-collapse">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nama Proyek</th>
      <th>Klien</th>
      <th>Tim</th>
      <th>Status</th>
      <th>Budget</th>
      <th>Tanggal Mulai</th>
      <th>Tanggal Selesai</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
  <?php if ($proyekList && count($proyekList) > 0): ?>
    <?php foreach ($proyekList as $row): ?>
      <tr>
        <td><?= htmlspecialchars($row["id_proyek"]) ?></td>
        <td><?= htmlspecialchars($row["nama_proyek"]) ?></td>
        <td><?= htmlspecialchars($row["id_klien"]) ?></td>
        <td><?= htmlspecialchars($row["id_tim"]) ?></td>
        <td><?= htmlspecialchars($row["nama_status"]) ?></td>
        <td><?= htmlspecialchars($row["budget"]) ?></td>
        <td><?= htmlspecialchars($row["tanggal_mulai"] ?? '') ?></td>
        <td><?= htmlspecialchars($row["tanggal_selesai"] ?? '') ?></td>
        <td>
          <button class="edit-btn" onclick="editProyek(
            '<?= $row['id_proyek'] ?>',
            '<?= htmlspecialchars($row['id_klien']) ?>',
            '<?= htmlspecialchars($row['id_tim']) ?>',
            '<?= htmlspecialchars($row['nama_status']) ?>',
            '<?= htmlspecialchars($row['nama_proyek']) ?>',
            '<?= htmlspecialchars($row['budget']) ?>',
            '<?= htmlspecialchars($row['tanggal_mulai'] ?? '') ?>',
            '<?= htmlspecialchars($row['tanggal_selesai'] ?? '') ?>'
          )">Edit</button>

          <a href="../controller/ProyekController.php?action=delete&id=<?= $row['id_proyek'] ?>"
             class="delete-btn"
             onclick="return confirm('Yakin hapus proyek ini?')">
             Hapus
          </a>
        </td>
      </tr>
    <?php endforeach; ?>
  <?php else: ?>
    <tr>
      <td colspan="9" style="text-align:center;">Tidak ada data proyek.</td>
    </tr>
  <?php endif; ?>
  </tbody>
</table>

<!-- Pagination Proyek -->
<?php if ($totalPages > 1): ?>
<div style="margin-top:20px; text-align:center;">

    <!-- Tombol Prev -->
    <?php if ($page > 1): ?>
        <a href="?page=<?= $page - 1 ?>" 
           style="padding:8px 12px; background:#ddd; margin-right:5px;">Prev</a>
    <?php endif; ?>

    <!-- Nomor halaman -->
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?page=<?= $i ?>"
           style="padding:8px 12px; 
                  margin-right:5px; 
                  background: <?= $i == $page ? '#007bff' : '#eee' ?>; 
                  color: <?= $i == $page ? '#fff' : '#000' ?>;
                  text-decoration:none;">
            <?= $i ?>
        </a>
    <?php endfor; ?>

    <!-- Tombol Next -->
    <?php if ($page < $totalPages): ?>
        <a href="?page=<?= $page + 1 ?>" 
           style="padding:8px 12px; background:#ddd; margin-left:5px;">Next</a>
    <?php endif; ?>

</div>
<?php endif; ?>

<!-- Modal Edit Proyek -->
<div id="modalEditProyek" class="modal" style="display:none; position: fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.5);">
  <div class="modal-content" style="background: #fff; margin: 5% auto; padding: 20px; width: 500px; position: relative;">
    <span class="close" onclick="hideModalProyek()" style="position: absolute; top: 10px; right: 15px; cursor: pointer;">&times;</span>
    <h3>Edit Data Proyek</h3>

    <form action="../controller/ProyekController.php?action=update" method="POST">
      <input type="hidden" name="id_proyek" id="edit_id_proyek">

      <div style="margin-bottom:10px;">
        <label for="edit_id_klien">Klien:</label><br>
        <select name="id_klien" id="edit_id_klien" required>
            <option value="">-- Pilih Klien --</option>
            <?php foreach ($klienList as $klien): ?>
                <option value="<?= $klien['id_klien'] ?>">
                    <?= $klien['nama_klien'] ?>
                </option>
            <?php endforeach; ?>
        </select>
      </div>
      <div style="margin-bottom:10px;">
        <label for="edit_id_tim">Tim:</label><br>
        <select name="id_tim" id="edit_id_tim" required>
            <option value="">-- Pilih Tim --</option>
            <?php foreach ($timList as $tim): ?>
                <option value="<?= $tim['id_tim'] ?>">
                    <?= $tim['nama_tim'] ?>
                </option>
            <?php endforeach; ?>
        </select>
      </div>
      <div style="margin-bottom:10px;">
        <label for="edit_id_status">Status:</label><br>
        <select name="id_status" id="edit_id_status" required>
            <?php foreach ($statusList as $status): ?>
                <option value="<?= $status['id_status'] ?>">
                    <?= $status['nama_status'] ?>
                </option>
            <?php endforeach; ?>
        </select>
      </div>
      <div style="margin-bottom:10px;">
        <label for="edit_nama_proyek">Nama Proyek:</label><br>
        <input type="text" name="nama_proyek" id="edit_nama_proyek" required style="padding:5px; width: 100%;">
      </div>
      <div style="margin-bottom:10px;">
        <label for="edit_budget">Budget:</label><br>
        <input type="text" name="budget" id="edit_budget" style="padding:5px; width: 200px;">
      </div>
      <div style="margin-bottom:10px;">
        <label for="edit_tanggal_mulai">Tanggal Mulai:</label><br>
        <input type="date" name="tanggal_mulai" id="edit_tanggal_mulai" style="padding:5px; width: 200px;">
      </div>
      <div style="margin-bottom:10px;">
        <label for="edit_tanggal_selesai">Tanggal Selesai:</label><br>
        <input type="date" name="tanggal_selesai" id="edit_tanggal_selesai" style="padding:5px; width: 200px;">
      </div>

      <button type="submit" style="padding: 5px 10px;">Update Proyek</button>
    </form>
  </div>
</div>

<script>
function editProyek(id, idKlien, idTim, idStatus, nama, budget, tMulai, tSelesai) {
  document.getElementById("modalEditProyek").style.display = "block";
  document.getElementById("edit_id_proyek").value = id;
  document.getElementById("edit_id_klien").value = idKlien;
  document.getElementById("edit_id_tim").value = idTim;
  document.getElementById("edit_id_status").value = idStatus;
  document.getElementById("edit_nama_proyek").value = nama;
  document.getElementById("edit_budget").value = budget;
  document.getElementById("edit_tanggal_mulai").value = tMulai;
  document.getElementById("edit_tanggal_selesai").value = tSelesai;
}

function hideModalProyek() {
  document.getElementById("modalEditProyek").style.display = "none";
}
</script>
