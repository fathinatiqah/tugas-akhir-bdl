<h2>Laporan Detail Proyek (view_proyek_detail)</h2>

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
