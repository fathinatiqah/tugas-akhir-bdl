<h2>Simple View (view_proyek_detail)</h2>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nama Proyek</th>
        <th>Klien</th>
        <th>Tim</th>
        <th>Status</th>
        <th>Budget</th>
        <th>Mulai</th>
        <th>Selesai</th>
    </tr>

    <?php foreach ($proyekDetail as $p): ?>
    <tr>
        <td><?= $p['id_proyek'] ?></td>
        <td><?= $p['nama_proyek'] ?></td>
        <td><?= $p['nama_klien'] ?></td>
        <td><?= $p['nama_tim'] ?></td>
        <td><?= $p['nama_status'] ?></td>
        <td><?= $p['budget'] ?></td>
        <td><?= $p['tanggal_mulai'] ?></td>
        <td><?= $p['tanggal_selesai'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<br>
<br>

<h2>Materialized View (mv_total_tugas)</h2>

<form method="POST" action="../controller/ViewController.php?action=refresh">
    <button type="submit" name="refresh">Refresh MV</button>
</form>

<table border="1">
    <tr>
        <th>ID Proyek</th>
        <th>Nama Proyek</th>
        <th>Total Tugas</th>
    </tr>

    <?php foreach ($totalTugas as $t): ?>
    <tr>
        <td><?= $t['id_proyek'] ?></td>
        <td><?= $t['nama_proyek'] ?></td>
        <td><?= $t['total_tugas'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>
