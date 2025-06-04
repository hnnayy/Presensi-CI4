<?= $this->extend('Admin/layout.php') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    .page-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
    }

    .page-header {
        background: linear-gradient(135deg, #1f6186 0%, #154360 100%);
        color: white;
        padding: 25px 30px;
        border-radius: 10px;
        margin-bottom: 25px;
        box-shadow: 0 4px 20px rgba(31, 97, 134, 0.3);
    }

    .page-header h2 {
        margin: 0;
        font-size: 28px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .page-header p {
        margin: 8px 0 0 0;
        opacity: 0.9;
        font-size: 14px;
    }

    .table-container {
        background-color: white;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .table-title {
        font-size: 18px;
        font-weight: 600;
        color: #2c3e50;
    }

    .btn {
        font-size: 14px;
        padding: 10px 20px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .btn-primary {
        background-color: #1f6186;
        color: white;
    }

    .btn-primary:hover {
        background-color: #154360;
        color: white;
        text-decoration: none;
        transform: translateY(-1px);
    }

    .btn-sm {
        font-size: 12px;
        padding: 6px 12px;
    }

    .btn-warning {
        background-color: #f39c12;
        color: white;
    }

    .btn-warning:hover {
        background-color: #d68910;
        color: white;
        text-decoration: none;
    }

    .btn-danger {
        background-color: #e74c3c;
        color: white;
    }

    .btn-danger:hover {
        background-color: #c0392b;
        color: white;
        text-decoration: none;
    }

    .table-responsive {
        overflow-x: auto;
        border-radius: 8px;
        border: 1px solid #e1e8ed;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
        font-size: 14px;
    }

    thead {
        background: linear-gradient(135deg, #34495e 0%, #2c3e50 100%);
        color: white;
    }

    th {
        padding: 15px 12px;
        text-align: center;
        font-weight: 600;
        border: none;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #f1f2f6;
        vertical-align: middle;
    }

    tr:hover {
        background-color: #f8f9fa;
    }

    .badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-pusat {
        background-color: #3498db;
        color: white;
    }

    .badge-cabang {
        background-color: #2ecc71;
        color: white;
    }

    .zona-badge {
        padding: 3px 10px;
        border-radius: 15px;
        font-size: 11px;
        font-weight: 600;
        background-color: #9b59b6;
        color: white;
    }

    .coordinate-info {
        font-size: 11px;
        color: #7f8c8d;
        line-height: 1.3;
    }

    .time-info {
        font-weight: 600;
        color: #2c3e50;
    }

    .action-buttons {
        display: flex;
        gap: 5px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .alert {
        padding: 15px 20px;
        margin-bottom: 20px;
        border-radius: 8px;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .alert-success {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
    }

    .alert-danger {
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #7f8c8d;
    }

    .empty-state i {
        font-size: 64px;
        margin-bottom: 20px;
        opacity: 0.5;
    }

    .empty-state h3 {
        color: #34495e;
        margin-bottom: 10px;
    }

    .empty-state p {
        margin-bottom: 25px;
    }

    @media (max-width: 768px) {
        .page-container {
            padding: 10px;
        }
        
        .page-header {
            padding: 20px;
        }
        
        .page-header h2 {
            font-size: 24px;
        }
        
        .table-container {
            padding: 15px;
        }
        
        .table-header {
            flex-direction: column;
            align-items: stretch;
        }
        
        .btn {
            width: 100%;
            justify-content: center;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .action-buttons .btn {
            width: auto;
        }
        
        th, td {
            padding: 8px 6px;
            font-size: 12px;
        }
    }
</style>

<div class="page-container">
    <div class="page-header">
        <h2>
            <i class="fas fa-map-marker-alt"></i>
            <?= esc($title) ?>
        </h2>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i>
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <div class="table-container">
        <div class="table-header">
            <div class="table-title">
                <i class="fas fa-list"></i>
                Daftar Lokasi Presensi
            </div>
            <a href="<?= base_url('Admin/LokasiPresensi/Create') ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Tambah Lokasi Baru
            </a>
        </div>

        <?php if (!empty($lokasi_presensi)) : ?>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Nama Lokasi</th>
                            <th width="20%">Alamat</th>
                            <th width="10%">Tipe</th>
                            <th width="15%">Koordinat</th>
                            <th width="8%">Radius</th>
                            <th width="8%">Zona</th>
                            <th width="12%">Jam Kerja</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($lokasi_presensi as $lokasi) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <strong><?= esc($lokasi['nama_lokasi']) ?></strong>
                                </td>
                                <td style="text-align: left;">
                                    <small><?= esc($lokasi['alamat_lokasi']) ?></small>
                                </td>
                                <td>
                                    <span class="badge <?= $lokasi['tipe_lokasi'] == 'pusat' ? 'badge-pusat' : 'badge-cabang' ?>">
                                        <?= $lokasi['tipe_lokasi'] == 'pusat' ? 'Kantor Pusat' : 'Kantor Cabang' ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="coordinate-info">
                                        <div>Lat: <?= number_format($lokasi['latitude'], 4) ?></div>
                                        <div>Lng: <?= number_format($lokasi['longitude'], 4) ?></div>
                                    </div>
                                </td>
                                <td>
                                    <strong><?= number_format($lokasi['radius'], 2) ?> km</strong>
                                </td>
                                <td>
                                    <span class="zona-badge"><?= esc($lokasi['zona_waktu']) ?></span>
                                </td>
                                <td>
                                    <div class="time-info">
                                        <div><?= date('H:i', strtotime($lokasi['jam_masuk'])) ?></div>
                                        <small style="color: #7f8c8d;">s/d</small>
                                        <div><?= date('H:i', strtotime($lokasi['jam_pulang'])) ?></div>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="<?= base_url('Admin/LokasiPresensi/Edit/' . $lokasi['id']) ?>" 
                                           class="btn btn-warning btn-sm" 
                                           title="Edit Lokasi">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= base_url('Admin/LokasiPresensi/Delete/' . $lokasi['id']) ?>" 
                                           class="btn btn-danger btn-sm" 
                                           title="Hapus Lokasi"
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus lokasi <?= esc($lokasi['nama_lokasi']) ?>?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <div class="empty-state">
                <i class="fas fa-map-marker-alt"></i>
                <h3>Belum Ada Data Lokai</h3>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>