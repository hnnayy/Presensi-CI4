<?= $this->extend('Admin/layout.php') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    .table-container {
        max-width: 1200px;
        margin: 0 auto;
        background-color: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .table-header {
        border-bottom: 2px solid #1f6186;
        padding-bottom: 15px;
        margin-bottom: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .table-header h2 {
        color: #1f6186;
        margin: 0;
        font-size: 24px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn {
        font-size: 14px;
        padding: 12px 20px;
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
        transform: translateY(-1px);
        text-decoration: none;
        color: white;
    }

    .btn-sm {
        font-size: 12px;
        padding: 8px 12px;
    }

    .btn-warning {
        background-color: #f39c12;
        color: white;
    }

    .btn-warning:hover {
        background-color: #d68910;
        text-decoration: none;
        color: white;
    }

    .btn-danger {
        background-color: #e74c3c;
        color: white;
    }

    .btn-danger:hover {
        background-color: #c0392b;
        text-decoration: none;
        color: white;
    }

    .table-responsive {
        overflow-x: auto;
        margin-top: 20px;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
        border-radius: 6px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .data-table thead {
        background-color: #1f6186;
        color: white;
    }

    .data-table th {
        padding: 15px 12px;
        text-align: left;
        font-weight: 600;
        font-size: 14px;
        border-bottom: 2px solid #154360;
    }

    .data-table td {
        padding: 12px;
        border-bottom: 1px solid #e1e8ed;
        vertical-align: middle;
        font-size: 14px;
    }

    .data-table tbody tr {
        transition: background-color 0.2s ease;
    }

    .data-table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .data-table tbody tr:last-child td {
        border-bottom: none;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .table-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        padding-top: 15px;
        border-top: 1px solid #e1e8ed;
        font-size: 14px;
        color: #6c757d;
    }

    .alert {
        padding: 15px 20px;
        margin-bottom: 20px;
        border-radius: 6px;
        font-size: 14px;
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
        padding: 40px 20px;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 48px;
        margin-bottom: 15px;
        color: #dee2e6;
    }

    .search-box {
        position: relative;
        max-width: 300px;
    }

    .search-box input {
        width: 100%;
        padding: 10px 40px 10px 15px;
        border: 2px solid #e1e8ed;
        border-radius: 6px;
        font-size: 14px;
        transition: border-color 0.3s ease;
    }

    .search-box input:focus {
        outline: none;
        border-color: #1f6186;
        box-shadow: 0 0 0 3px rgba(31, 97, 134, 0.1);
    }

    .search-box i {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
    }

    @media (max-width: 768px) {
        .table-container {
            margin: 10px;
            padding: 20px;
        }

        .table-header {
            flex-direction: column;
            align-items: stretch;
            text-align: center;
        }

        .table-header h2 {
            justify-content: center;
            margin-bottom: 15px;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }

        .search-box {
            max-width: 100%;
            margin-bottom: 15px;
        }

        .action-buttons {
            justify-content: center;
        }

        .data-table th,
        .data-table td {
            padding: 10px 8px;
            font-size: 13px;
        }

        .table-info {
            flex-direction: column;
            gap: 10px;
            text-align: center;
        }
    }

    @media (max-width: 576px) {
        .data-table th:nth-child(1),
        .data-table td:nth-child(1) {
            display: none;
        }
    }
</style>

<div class="table-container">
    <div class="table-header">
        <h2>
            <i class="fas fa-user-tie"></i>
            Data Jabatan
        </h2>
        <div style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Cari jabatan...">
                <i class="fas fa-search"></i>
            </div>
            <a href="<?= base_url('Admin/Jabatan/Create') ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Tambah Data
            </a>
        </div>
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

    <div class="table-responsive">
        <?php if (!empty($jabatan)): ?>
            <table class="data-table" id="dataTable">
                <thead>
                    <tr>
                        <th style="width: 60px; text-align: center;">No</th>
                        <th>Nama Jabatan</th>
                        <th>Deskripsi</th>
                        <th>Level</th>
                        <th style="width: 150px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($jabatan as $jab): ?>
                        <tr>
                            <td style="text-align: center;"><?= $no++ ?></td>
                            <td>
                                <strong><?= esc($jab['jabatan']) ?></strong>
                            </td>
                            <td>
                                <?= !empty($jab['deskripsi']) ? esc($jab['deskripsi']) : '<span style="color: #6c757d; font-style: italic;">Tidak ada deskripsi</span>' ?>
                            </td>
                            <td>
                                <?php if (!empty($jab['level'])): ?>
                                    <span class="badge-level level-<?= $jab['level'] ?>">
                                        Level <?= $jab['level'] ?>
                                    </span>
                                <?php else: ?>
                                    <span style="color: #6c757d; font-style: italic;">Tidak ditentukan</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="<?= base_url('Admin/Jabatan/Edit/' . $jab['id']) ?>" 
                                       class="btn btn-sm btn-warning" 
                                       title="Edit Jabatan">
                                        <i class="fas fa-edit"></i>
                                        Edit
                                    </a>
                                    <a href="<?= base_url('Admin/Jabatan/Delete/' . $jab['id']) ?>" 
                                       class="btn btn-sm btn-danger" 
                                       onclick="return confirmDelete('<?= esc($jab['jabatan']) ?>')"
                                       title="Hapus Jabatan">
                                        <i class="fas fa-trash-alt"></i>
                                        Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="table-info">
                <div>
                    <i class="fas fa-info-circle"></i>
                    Menampilkan <?= count($jabatan) ?> data jabatan
                </div>
                <div>
                    Terakhir diperbarui: <?= date('d M Y, H:i') ?>
                </div>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-user-tie"></i>
                <h4>Belum ada data jabatan</h4>
                <p>Silakan tambah data jabatan untuk memulai.</p>
                <a href="<?= base_url('Admin/Jabatan/Create') ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Tambah Jabatan Pertama
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .badge-level {
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 500;
        text-align: center;
        display: inline-block;
        min-width: 60px;
    }

    .level-1 { background-color: #e8f5e8; color: #2d5a2d; }
    .level-2 { background-color: #e3f2fd; color: #1565c0; }
    .level-3 { background-color: #fff3e0; color: #ef6c00; }
    .level-4 { background-color: #fce4ec; color: #ad1457; }
    .level-5 { background-color: #f3e5f5; color: #7b1fa2; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const table = document.getElementById('dataTable');
    
    if (searchInput && table) {
        searchInput.addEventListener('keyup', function() {
            const filter = this.value.toLowerCase();
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
            
            for (let i = 0; i < rows.length; i++) {
                const jabatanCell = rows[i].getElementsByTagName('td')[1];
                const deskripsiCell = rows[i].getElementsByTagName('td')[2];
                
                if (jabatanCell || deskripsiCell) {
                    const jabatanText = jabatanCell.textContent || jabatanCell.innerText;
                    const deskripsiText = deskripsiCell.textContent || deskripsiCell.innerText;
                    
                    if (jabatanText.toLowerCase().indexOf(filter) > -1 || 
                        deskripsiText.toLowerCase().indexOf(filter) > -1) {
                        rows[i].style.display = '';
                    } else {
                        rows[i].style.display = 'none';
                    }
                }
            }
        });
    }
});

function confirmDelete(jabatanName) {
    return confirm(`Apakah Anda yakin ingin menghapus jabatan "${jabatanName}"?\n\nData yang sudah dihapus tidak dapat dikembalikan.`);
}

// Auto-hide alerts after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.remove();
            }, 300);
        }, 5000);
    });
});
</script>

<?= $this->endSection() ?>