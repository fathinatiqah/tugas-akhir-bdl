
<h2>Manajemen Data Klien</h2>

    <!-- Form Tambah -->
    <div class="form-box">
        <h3>Tambah Klien Baru</h3>
        <form action="../controller/KlienController.php?action=create" method="POST">
            <input type="text" name="nama_klien" placeholder="Nama Klien" required>
            <input type="text" name="kontak_klien" placeholder="Kontak Klien" required>
            <button type="submit">Simpan</button>
        </form>
    </div>

    <hr>

    <h3>Daftar Klien</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Klien</th>
                <th>Kontak</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($klienList && $klienList->rowCount() > 0): ?>
            <?php while ($row = $klienList->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?= $row["id_klien"] ?></td>
                    <td><?= htmlspecialchars($row["nama_klien"]) ?></td>
                    <td><?= htmlspecialchars($row["kontak_klien"]) ?></td>
                    <td>
                    <button class="edit-btn" onclick="editKlien(
                        '<?= $row['id_klien'] ?>',
                        '<?= htmlspecialchars($row['nama_klien']) ?>',
                        '<?= htmlspecialchars($row['kontak_klien']) ?>'
                    )">Edit</button>

                    <a href="../controller/KlienController.php?action=delete&id=<?= $row['id_klien'] ?>"
                    class="delete-btn"
                    onclick="return confirm('Yakin hapus data ini?')">
                    Hapus
                    </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" style="text-align:center;">Tidak ada data klien.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Modal Edit -->
<div id="modalEdit" class="modal">
    <div class="modal-content">
        <span class="close" onclick="hideModal()">&times;</span>
        <h3>Edit Data Klien</h3>

        <form action="../controller/KlienController.php?action=update" method="POST">
            <input type="hidden" name="id_klien" id="edit_id">
            <input type="text" name="nama_klien" id="edit_nama_klien" required>
            <input type="text" name="kontak_klien" id="edit_kontak_klien" required>

            <button type="submit">Update</button>
        </form>
    </div>
</div>

<script>
function editKlien(id_klien, nama, kontak) {
    document.getElementById("modalEdit").style.display = "block";
    document.getElementById("edit_id").value = id_klien;
    document.getElementById("edit_nama_klien").value = nama;
    document.getElementById("edit_kontak_klien").value = kontak;
}

function hideModal() {
    document.getElementById("modalEdit").style.display = "none";
}
</script>