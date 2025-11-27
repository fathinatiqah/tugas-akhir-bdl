
<h2>Manajemen Data Anggota Tim</h2>

<!-- Form Tambah -->
<div class="form-box">
    <h3>Tambah Anggota Tim Baru</h3>
    <form action="../controller/AnggotaController.php?action=create" method="POST">
            <select name="id_tim" required>
            <option value="">-- Pilih Tim --</option>
            <?php foreach ($timList as $tim): ?>
                <option value="<?= $tim['id_tim'] ?>">
                    <?= $tim['nama_tim'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="text" name="nama_anggota" placeholder="Nama Anggota Tim" required>
        <input type="text" name="posisi" placeholder="Posisi" required>
        <button type="submit">Simpan</button>
    </form>
</div>

<hr>

<h3>Daftar Anggota Tim</h3>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>ID Team</th>
            <th>Nama Anggota</th>
            <th>Posisi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php if ($anggotaList && $anggotaList->rowCount() > 0): ?>
        <?php while ($row = $anggotaList->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?= $row["id_anggota"] ?></td>
                <td><?= $row["id_tim"] ?></td>
                <td><?= htmlspecialchars($row["nama_anggota"]) ?></td>
                <td><?= htmlspecialchars($row["posisi"]) ?></td>
                <td>
                <button class="edit-btn" onclick="editKlien(
                    '<?= $row['id_anggota'] ?>',
                    '<?= $row['id_tim'] ?>',
                    '<?= htmlspecialchars($row['nama_anggota']) ?>',
                    '<?= htmlspecialchars($row['posisi']) ?>'
                )">Edit</button>

                <a href="../controller/AnggotaController.php?action=delete&id=<?= $row['id_anggota'] ?>"
                class="delete-btn"
                onclick="return confirm('Yakin hapus data ini?')">
                Hapus
                </a>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="4" style="text-align:center;">Tidak ada data anggota.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
</div>

<!-- Modal Edit -->
<div id="modalEdit" class="modal">
<div class="modal-content">
    <span class="close" onclick="hideModal()">&times;</span>
    <h3>Edit Data Anggota</h3>

    <form action="../controller/AnggotaController.php?action=update" method="POST">
        <input type="hidden" name="id_anggota" id="edit_id">
        <select name="id_tim" required>
            <option value="">-- Pilih Tim --</option>
            <?php foreach ($timList as $tim): ?>
                <option value="<?= $tim['id_tim'] ?>">
                    <?= $tim['nama_tim'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="text" name="nama_anggota" id="edit_nama_anggota" required>
        <input type="text" name="posisi" id="edit_posisi" required>

        <button type="submit">Update</button>
    </form>
</div>
</div>

<script>
function editKlien(id_anggota, nama, posisi) {
document.getElementById("modalEdit").style.display = "block";
document.getElementById("edit_id").value = id_anggota;
document.getElementById("edit_tim").value = id_tim;
document.getElementById("edit_nama_anggota").value = nama;
document.getElementById("edit_posisi").value = kontak;
}

function hideModal() {
document.getElementById("modalEdit").style.display = "none";
}
</script>