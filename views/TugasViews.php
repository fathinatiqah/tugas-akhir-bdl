<!-- views/TugasViews.php -->
<h2>Manajemen Data Tugas</h2>

<!-- Form Tambah Tugas Baru -->
  <h3>Tambah Tugas Baru</h3>
  <form action="../controller/TugasController.php?action=create" method="POST">
    <div style="margin-bottom:10px;">
      <label for="id_proyek">Pilih Proyek:</label><br>
      <select name="id_proyek" required>
      <option value="">-- Pilih Proyek --</option>
            <?php foreach ($proyekList as $proyek): ?>
                <option value="<?= $proyek['id_proyek'] ?>">
                    <?= $proyek['nama_proyek'] ?>
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
      <label for="nama_tugas">Nama Tugas:</label><br>
      <input type="text" name="nama_tugas" id="nama_tugas" placeholder="Nama Tugas">
    </div>

    <div style="margin-bottom:10px;">
      <label for="deskripsi">Deskripsi:</label><br>
      <textarea name="deskripsi" id="deskripsi" placeholder="Deskripsi tugas..." rows="4" style="padding:5px; width: 100%; max-width:600px;"></textarea>
    </div>

    <div style="margin-bottom:10px;">
      <label for="tanggal_mulai">Tanggal Mulai:</label><br>
      <input type="date" name="tanggal_mulai" id="tanggal_mulai" style="padding:5px; width: 200px;">
      <small style="color:#666; display:block;">(Biarkan kosong untuk gunakan tanggal sekarang — DEFAULT CURRENT_DATE)</small>
    </div>

    <div style="margin-bottom:10px;">
      <label for="batas_waktu">Batas Waktu:</label><br>
      <input type="date" name="batas_waktu" id="batas_waktu" style="padding:5px; width: 200px;">
    </div>

    <div style="margin-bottom:10px;">
      <label for="tanggal_selesai_actual">Tanggal Selesai (aktual):</label><br>
      <input type="date" name="tanggal_selesai_actual" id="tanggal_selesai_actual" style="padding:5px; width: 200px;">
    </div>

    <button type="submit">Simpan Tugas</button>
  </form>
<br>
<hr>

<form action="../controller/TugasController.php" method="GET" style="margin-bottom: 20px;">
  <input type="hidden" name="action" value="search">

  <input 
      type="text" 
      name="keyword" 
      placeholder="Cari ID Proyek, Nama, Status" 
      style="padding: 7px; width: 300px;"
      value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>"
  >

  <button type="submit" style="padding: 6px 12px;">Cari</button>
  <a href="../controller/TugasController.php" 
     style="padding: 6px 12px; background:#ddd; text-decoration:none; margin-left:10px;">
     Reset
  </a>
</form>


<h3>Daftar Tugas</h3>
<table border="1" cellpadding="8" cellspacing="0">
  <thead>
    <tr>
      <th>ID</th>
      <th>ID Proyek</th>
      <th>Nama Tugas</th>
      <th>Status</th>
      <th>Deskripsi</th>
      <th>Tgl Mulai</th>
      <th>Batas Waktu</th>
      <th>Tgl Selesai (Actual)</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
  <?php if (!empty($tugasList) && count($tugasList) > 0): ?>
    <?php foreach ($tugasList as $row): ?>
      <tr>
        <td><?= htmlspecialchars($row["id_tugas"]) ?></td>
        <td><?= htmlspecialchars($row["id_proyek"]) ?></td>
        <td><?= htmlspecialchars($row["nama_tugas"]) ?></td>
        <td><?= htmlspecialchars($row["nama_status"]) ?></td>
        <td style="max-width:300px; white-space:pre-wrap;"><?= htmlspecialchars($row["deskripsi"]) ?></td>
        <td><?= htmlspecialchars($row["tanggal_mulai"]) ?></td>
        <td><?= htmlspecialchars($row["batas_waktu"] ?? '') ?></td>
        <td><?= htmlspecialchars($row['tanggal_selesai_actual'] ?? '') ?></td>
        <td>
          <button class="edit-btn" onclick="editTugas(
            '<?= $row['id_tugas'] ?>',
            '<?= htmlspecialchars($row['id_proyek']) ?>',
            '<?= htmlspecialchars($row['nama_status']) ?>',
            '<?= htmlspecialchars(addslashes($row['nama_tugas'])) ?>',
            '<?= htmlspecialchars(addslashes($row['deskripsi'])) ?>',
            '<?= htmlspecialchars($row['tanggal_mulai']) ?>',
            '<?= htmlspecialchars($row['batas_waktu'] ?? '') ?>',
            '<?= htmlspecialchars($row['tanggal_selesai_actual'] ?? '') ?>'
          )">Edit</button>

          <a href="../controller/TugasController.php?action=delete&id=<?= $row['id_tugas'] ?>"
             class="delete-btn"
             onclick="return confirm('Yakin hapus tugas ini?')">Hapus</a>
        </td>
      </tr>
    <?php endforeach; ?>
  <?php else: ?>
    <tr>
      <td colspan="9" style="text-align:center;">Tidak ada data tugas.</td>
    </tr>
  <?php endif; ?>
  </tbody>
</table>

<!-- Modal Edit Tugas -->
<div id="modalEditTugas" class="modal" style="display:none; position: fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.5);">
  <div class="modal-content" style="background: #fff; margin: 4% auto; padding: 20px; width: 600px; position: relative;">
    <span class="close" onclick="hideModalTugas()" style="position: absolute; top: 10px; right: 15px; cursor: pointer;">&times;</span>
    <h3>Edit Data Tugas</h3>

    <form action="../controller/TugasController.php?action=update" method="POST">
      <input type="hidden" name="id_tugas" id="edit_id_tugas">

      <div style="margin-bottom:10px;">
        <label for="edit_id_proyek">ID Proyek:</label><br>
        <input type="number" name="id_proyek" id="edit_id_proyek" required style="padding:5px; width: 200px;">
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
        <label for="edit_nama_tugas">Nama Tugas:</label><br>
        <input type="text" name="nama_tugas" id="edit_nama_tugas" required style="padding:5px; width: 100%;">
      </div>

      <div style="margin-bottom:10px;">
        <label for="edit_deskripsi">Deskripsi:</label><br>
        <textarea name="deskripsi" id="edit_deskripsi" rows="4" style="padding:5px; width: 100%;"></textarea>
      </div>

      <div style="margin-bottom:10px;">
        <label for="edit_tanggal_mulai">Tanggal Mulai:</label><br>
        <input type="date" name="tanggal_mulai" id="edit_tanggal_mulai" style="padding:5px; width: 200px;">
      </div>

      <div style="margin-bottom:10px;">
        <label for="edit_batas_waktu">Batas Waktu:</label><br>
        <input type="date" name="batas_waktu" id="edit_batas_waktu" style="padding:5px; width: 200px;">
      </div>

      <div style="margin-bottom:10px;">
        <label for="edit_tanggal_selesai_actual">Tanggal Selesai (aktual):</label><br>
        <input type="date" name="tanggal_selesai_actual" id="edit_tanggal_selesai_actual" style="padding:5px; width: 200px;">
      </div>

      <button type="submit" style="padding: 6px 12px;">Update Tugas</button>
    </form>
  </div>
</div>

<script>
function editTugas(id, idProyek, idStatus, nama, deskripsi, tMulai, tBatas, tSelesai) {
  document.getElementById("modalEditTugas").style.display = "block";
  document.getElementById("edit_id_tugas").value = id;
  document.getElementById("edit_id_proyek").value = idProyek;
  document.getElementById("edit_id_status").value = idStatus;
  document.getElementById("edit_nama_tugas").value = nama;
  document.getElementById("edit_deskripsi").value = deskripsi;
  document.getElementById("edit_tanggal_mulai").value = tMulai;
  document.getElementById("edit_batas_waktu").value = tBatas;
  document.getElementById("edit_tanggal_selesai_actual").value = tSelesai;
}

function hideModalTugas() {
  document.getElementById("modalEditTugas").style.display = "none";
}
</script>
