<h2>Demonstrasi Transaction Management</h2>

<p>Form ini akan membuat <b>1 proyek baru</b> dan <b>1 tugas baru</b> dalam satu transaksi.
Jika salah satu gagal, maka semuanya akan <b>rollback</b>.</p>

<?php if (isset($message)): ?>
    <div style="padding:10px; background:#eef; border-left:4px solid #55f; margin-bottom:15px;">
        <?= htmlspecialchars($message) ?>
    </div>
<?php endif; ?>

<h3>Form Transaksi</h3>

<form action="../controller/TransactionController.php?action=execute" method="POST">

    <label>Nama Proyek:</label><br>
    <input type="text" name="nama_proyek" required><br><br>

    <label>ID Klien:</label><br>
    <input type="number" name="id_klien" required><br><br>

    <label>ID Tim:</label><br>
    <input type="number" name="id_tim" required><br><br>

    <label>ID Status Proyek:</label><br>
    <input type="number" name="id_status" required><br><br>

    <label>Budget:</label><br>
    <input type="number" name="budget" required><br><br>

    <hr>
    <br>

    <h3>Data Tugas</h3>

    <label>ID Status Tugas:</label><br>
    <input type="number" name="id_status" required><br><br>

    <label>Nama Tugas:</label><br>
    <input type="text" name="nama_tugas" required><br><br>

    <label>Deskripsi:</label><br>
    <textarea name="deskripsi" required></textarea><br><br>

    <button type="submit">Jalankan Transaksi</button>
</form>

<br>
<hr>
<br>

<h3>Demonstrasi ACID Properties</h3>

<ul>
    <li><b>Atomicity</b>: Insert proyek dan tugas harus sukses semua atau batal semua.</li>
    <li><b>Consistency</b>: Data proyek dan tugas tetap konsisten setelah transaksi.</li>
    <li><b>Isolation</b>: Transaksi berjalan terpisah dari query lain.</li>
    <li><b>Durability</b>: Setelah commit, data tetap tersimpan meskipun server mati.</li>
</ul>
