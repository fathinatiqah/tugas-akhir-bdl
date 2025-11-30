<h2>Laporan Detail Tugas</h2>

<table border="1" cellpadding="8" cellspacing="0">
    <tr style="background:#f06aa3; color:white;">
        <th>ID Proyek</th>
        <th>Nama Tugas</th>
        <th>Dikerjakan Oleh</th>
        <th>Status Tugas</th>
        <th>Batas Waktu</th>
    </tr>

    <?php foreach ($dataTugas as $t): ?>

        <?php
            $today = date('Y-m-d');
            $overdue = (!empty($t['batas_waktu']) 
                        && $t['batas_waktu'] < $today 
                        && $t['nama_status'] !== 'Selesai');
        ?>

        <tr style="<?= $overdue ? 'background:#ffb3b3;' : '' ?>">
            <td><?= $t['id_proyek'] ?></td>
            <td><?= $t['nama_tugas'] ?></td>
            <td><?= $t['nama_anggota'] ?></td>
            <td><?= $t['nama_status'] ?></td>
            <td><?= $t['batas_waktu'] ?></td>
        </tr>

    <?php endforeach; ?>
</table>


<br>

<h2>Laporan Total Tugas (mv_total_tugas)</h2>

<form method="POST" action="../controller/LaporanController.php?action=refresh">
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