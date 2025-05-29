<?= $this->extend('Admin/layout.php') ?>
<?= $this->section('content') ?>

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

    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: bold;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }
</style>

<div class="table-wrapper">
    <h2><?= $title ?></h2>

    <?php if (session()->getFlashdata('error')) : ?>
        <div style="color: red;"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('Admin/LokasiPresensi/store') ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="nama_lokasi">Nama Lokasi</label>
            <input type="text" name="nama_lokasi" id="nama_lokasi" value="<?= old('nama_lokasi') ?>">
        </div>

        <div class="form-group">
            <label for="alamat_lokasi">Alamat Lokasi</label>
            <input type="text" name="alamat_lokasi" id="alamat_lokasi" value="<?= old('alamat_lokasi') ?>">
        </div>

        <div class="form-group">
            <label for="tipe_lokasi">Tipe Lokasi</label>
            <select name="tipe_lokasi" id="tipe_lokasi">
                <option value="">-- Pilih Tipe --</option>
                <option value="Kantor" <?= old('tipe_lokasi') == 'Kantor' ? 'selected' : '' ?>>Kantor</option>
                <option value="Remote" <?= old('tipe_lokasi') == 'Remote' ? 'selected' : '' ?>>Remote</option>
            </select>
        </div>

        <div class="form-group">
            <label for="zona_waktu">Zona Waktu</label>
            <select name="zona_waktu" id="zona_waktu">
                <option value="">-- Pilih Zona --</option>
                <option value="WIB" <?= old('zona_waktu') == 'WIB' ? 'selected' : '' ?>>WIB</option>
                <option value="WITA" <?= old('zona_waktu') == 'WITA' ? 'selected' : '' ?>>WITA</option>
                <option value="WIT" <?= old('zona_waktu') == 'WIT' ? 'selected' : '' ?>>WIT</option>
            </select>
        </div>

        <div class="form-group">
            <label for="jam_masuk">Jam Masuk</label>
            <input type="time" name="jam_masuk" id="jam_masuk" value="<?= old('jam_masuk') ?>">
        </div>

        <div class="form-group">
            <label for="jam_pulang">Jam Pulang</label>
            <input type="time" name="jam_pulang" id="jam_pulang" value="<?= old('jam_pulang') ?>">
        </div>

        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
    </form>
</div>

<?= $this->endSection() ?>
