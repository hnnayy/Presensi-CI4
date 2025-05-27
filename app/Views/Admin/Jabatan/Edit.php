<?= $this->extend('Admin/layout.php') ?>
<?= $this->section('content') ?>

<style>
    .table-wrapper {
        max-width: 1000px;
        margin: 0 auto;
    }

    .cardd {
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 0;
        margin-bottom: 20px;
        background-color: #fff;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .cardd-header {
        background-color: #1f6186;
        color: white;
        font-weight: bold;
        font-size: 1.2rem;
        padding: 12px 16px;
        border-bottom: 1px solid #ccc;
        text-align: center;
    }

    .cardd-body {
        padding: 20px;
        background-color: #f8f9fa;
    }

    .input-style-1 {
        margin-bottom: 15px;
    }

    .input-style-1 label {
        display: block;
        margin-bottom: 5px;
        font-weight: 500;
    }

    .input-style-1 input {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .error-text {
        color: red;
        font-size: 0.9rem;
        margin-top: 5px;
    }

    .btn {
        padding: 8px 16px;
        font-size: 1rem;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-primary {
        background-color: #1f6186;
        color: white;
    }

    .btn-primary:hover {
        background-color: #154360;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
        margin-left: 10px;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .mt-2 {
        margin-top: 10px;
    }

    .btn-group {
        display: flex;
        justify-content: flex-start;
    }
</style>

<div class="cardd table-wrapper">
    <div class="cardd-header">
        Edit Jabatan
    </div>
    <div class="cardd-body">
        <form method="POST" action="<?= base_url('Admin/Jabatan/Update/' . $jabatan['id']) ?>">
            <?= csrf_field() ?>
            <div class="input-style-1">
                <label>Nama Jabatan</label>
                <input
                    type="text"
                    name="jabatan"
                    placeholder="Masukkan nama jabatan"
                    value="<?= old('jabatan', $jabatan['jabatan']) ?>"
                    required
                />
                <?php if (isset($validation) && $validation->getError('jabatan')): ?>
                    <div class="error-text"><?= $validation->getError('jabatan') ?></div>
                <?php endif; ?>
            </div>
            <div class="btn-group mt-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= base_url('Admin/Jabatan') ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
