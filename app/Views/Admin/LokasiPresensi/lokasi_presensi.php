<?= $this->extend('Admin/layout.php') ?>
<?= $this->section('content') ?>

<!-- Font Awesome CDN (pastikan sudah dimuat di layout.php) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    .table-wrapper {
        max-width: 1200px;
        margin: 0 auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
        text-align: center;
    }

    thead {
        background-color: #525252;
        color: white;
    }

    th, td {
        padding: 10px;
        border: 1px solid #ddd;
        vertical-align: middle;
    }

    .btn {
        font-size: 0.9rem;
        padding: 6px 12px;
        border-radius: 4px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .btn-sm {
        font-size: 0.85rem;
        padding: 5px 10px;
    }

    .btn-primary {
        background-color: #1f6186;
        color: white;
        border: none;
    }

    .btn-primary:hover {
        background-color: #154360;
    }

    .btn-warning {
        background-color: #f39c12;
        color: white;
        border: none;
    }

    .btn-warning:hover {
        background-color: #d68910;
    }

    .btn-danger {
        background-color: #841c2d;
        color: white;
        border: none;
    }

    .btn-danger:hover {
        background-color: #6e1724;
    }

    .tambah-btn {
        margin-bottom: 15px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
</style>

<div class="table-wrapper">
    <a href="<?= base_url('Admin/LokasiPresensi/Create') ?>" class="btn btn-primary tambah-btn">
        <i class="fas fa-plus"></i> Tambah Data
    </a>

    <table id="dataTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Alamat Lokasi</th>
                <th>Tipe Lokasi</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Radius</th>
                <th>Zona Waktu</th>
                <th>Jam Masuk</th>
                <th>Jam Pulang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($lokasi_presensi as $lok): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($lok['alamat_lokasi']) ?></td>
                    <td><?= esc($lok['tipe_lokasi']) ?></td>
                    <td><?= esc($lok['latitude']) ?></td>
                    <td><?= esc($lok['longitude']) ?></td>
                    <td><?= esc($lok['radius']) ?> meter</td>
                    <td><?= esc($lok['zona_waktu']) ?></td>
                    <td><?= esc($lok['jam_masuk']) ?></td>
                    <td><?= esc($lok['jam_pulang']) ?></td>
                    <td>
                        <a href="<?= base_url('Admin/LokasiPresensi/Edit/' . $lok['id']) ?>" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="<?= base_url('Admin/LokasiPresensi/Delete/' . $lok['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                            <i class="fas fa-trash-alt"></i> Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
