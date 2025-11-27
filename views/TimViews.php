
<h2>Manajemen Data Tim</h2>

<!-- Form Tambah -->
<div class="form-box">
    <h3>Tambah Tim Baru</h3>
    <form action="../controller/TimController.php?action=create" method="POST">
        <input type="text" name="nama_tim" placeholder="Nama Tim" required>
        <button type="submit">Simpan</button>
    </form>
</div>

<hr>

<h3>Daftar Tim</h3>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Tim</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php if ($timList && $timList->rowCount() > 0): ?>
        <?php while ($row = $timList->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?= $row["id_tim"] ?></td>
                <td><?= htmlspecialchars($row["nama_tim"]) ?></td>
                <td>
                <button class="edit-btn" onclick="editTim(
                    '<?= $row['id_tim'] ?>',
                    '<?= htmlspecialchars($row['nama_tim']) ?>',
                )">Edit</button>

                <a href="../controller/TimController.php?action=delete&id=<?= $row['id_tim'] ?>"
                class="delete-btn"
                onclick="return confirm('Yakin hapus data ini?')">
                Hapus
                </a>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="4" style="text-align:center;">Tidak ada data tim.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
</div>

<!-- Modal Edit -->
<div id="modalEdit" class="modal">
<div class="modal-content">
    <span class="close" onclick="hideModal()">&times;</span>
    <h3>Edit Data Tim</h3>

    <form action="../controller/TimController.php?action=update" method="POST">
        <input type="hidden" name="id_tim" id="edit_id">
        <input type="text" name="nama_tim" id="edit_nama_tim" required>

        <button type="submit">Update</button>
    </form>
</div>
</div>

<script>
function editTim(id_tim, nama) {
document.getElementById("modalEdit").style.display = "block";
document.getElementById("edit_id").value = id_tim;
document.getElementById("edit_nama_tim").value = nama;
}

function hideModal() {
document.getElementById("modalEdit").style.display = "none";
}
</script>