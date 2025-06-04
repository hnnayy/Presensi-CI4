<?= $this->extend('Admin/layout.php') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    .form-container {
        max-width: 800px;
        margin: 0 auto;
        background-color: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .form-header {
        border-bottom: 2px solid #1f6186;
        padding-bottom: 15px;
        margin-bottom: 25px;
    }

    .form-header h2 {
        color: #1f6186;
        margin: 0;
        font-size: 24px;
        font-weight: 600;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
        font-size: 14px;
    }

    .form-group .required {
        color: #e74c3c;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e1e8ed;
        border-radius: 6px;
        font-size: 14px;
        transition: all 0.3s ease;
        box-sizing: border-box;
    }

    .form-control:focus {
        outline: none;
        border-color: #1f6186;
        box-shadow: 0 0 0 3px rgba(31, 97, 134, 0.1);
    }

    .form-control.is-invalid {
        border-color: #e74c3c;
    }

    .invalid-feedback {
        display: block;
        color: #e74c3c;
        font-size: 12px;
        margin-top: 5px;
    }

    .form-text {
        margin-top: 5px;
        font-size: 12px;
        color: #6c757d;
    }

    .btn {
        font-size: 14px;
        padding: 12px 24px;
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
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        color: white;
        text-decoration: none;
    }

    .form-actions {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #e1e8ed;
        display: flex;
        gap: 15px;
        justify-content: flex-start;
    }

    .alert {
        padding: 15px 20px;
        margin-bottom: 20px;
        border-radius: 6px;
        font-size: 14px;
    }

    .alert-danger {
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
    }

    .form-row {
        display: flex;
        gap: 20px;
    }

    .form-row .form-group {
        flex: 1;
    }

    @media (max-width: 768px) {
        .form-container {
            margin: 10px;
            padding: 20px;
        }
        
        .form-row {
            flex-direction: column;
            gap: 0;
        }
        
        .form-actions {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="form-container">
    <div class="form-header">
        <h2><i class="fas fa-map-marker-alt"></i> <?= esc($title) ?></h2>
    </div>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i>
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php if (isset($validation) && $validation->getErrors()) : ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i>
            <strong>Terjadi kesalahan:</strong>
            <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                <?php foreach ($validation->getErrors() as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('Admin/LokasiPresensi/Store') ?>" method="post" id="formLokasiPresensi">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="nama_lokasi">
                Nama Lokasi <span class="required">*</span>
            </label>
            <input 
                type="text" 
                class="form-control <?= (isset($validation) && $validation->hasError('nama_lokasi')) ? 'is-invalid' : '' ?>"
                id="nama_lokasi" 
                name="nama_lokasi" 
                value="<?= old('nama_lokasi') ?>"
                placeholder="Masukkan nama lokasi presensi"
                maxlength="255"
                required
            >
            <?php if (isset($validation) && $validation->hasError('nama_lokasi')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('nama_lokasi') ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="alamat_lokasi">
                Alamat Lokasi <span class="required">*</span>
            </label>
            <input 
                type="text" 
                class="form-control <?= (isset($validation) && $validation->hasError('alamat_lokasi')) ? 'is-invalid' : '' ?>"
                id="alamat_lokasi" 
                name="alamat_lokasi" 
                value="<?= old('alamat_lokasi') ?>"
                placeholder="Masukkan alamat lengkap lokasi"
                maxlength="500"
                required
            >
            <?php if (isset($validation) && $validation->hasError('alamat_lokasi')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('alamat_lokasi') ?>
                </div>
            <?php endif; ?>
            <small class="form-text text-muted">
                <i class="fas fa-info-circle"></i>
                Masukkan alamat selengkap mungkin untuk mendapatkan koordinat yang akurat
            </small>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="tipe_lokasi">
                    Tipe Lokasi <span class="required">*</span>
                </label>
                <select 
                    class="form-control <?= (isset($validation) && $validation->hasError('tipe_lokasi')) ? 'is-invalid' : '' ?>"
                    id="tipe_lokasi" 
                    name="tipe_lokasi"
                    required
                >
                    <option value="">-- Pilih Tipe Lokasi --</option>
                    <option value="pusat" <?= old('tipe_lokasi') == 'pusat' ? 'selected' : '' ?>>
                        Kantor Pusat
                    </option>
                    <option value="cabang" <?= old('tipe_lokasi') == 'cabang' ? 'selected' : '' ?>>
                        Kantor Cabang
                    </option>
                </select>
                <?php if (isset($validation) && $validation->hasError('tipe_lokasi')) : ?>
                    <div class="invalid-feedback">
                        <?= $validation->getError('tipe_lokasi') ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="zona_waktu">
                    Zona Waktu <span class="required">*</span>
                </label>
                <select 
                    class="form-control <?= (isset($validation) && $validation->hasError('zona_waktu')) ? 'is-invalid' : '' ?>"
                    id="zona_waktu" 
                    name="zona_waktu"
                    required
                >
                    <option value="">-- Pilih Zona Waktu --</option>
                    <option value="WIB" <?= old('zona_waktu') == 'WIB' ? 'selected' : '' ?>>
                        WIB (Waktu Indonesia Barat)
                    </option>
                    <option value="WITA" <?= old('zona_waktu') == 'WITA' ? 'selected' : '' ?>>
                        WITA (Waktu Indonesia Tengah)
                    </option>
                    <option value="WIT" <?= old('zona_waktu') == 'WIT' ? 'selected' : '' ?>>
                        WIT (Waktu Indonesia Timur)
                    </option>
                </select>
                <?php if (isset($validation) && $validation->hasError('zona_waktu')) : ?>
                    <div class="invalid-feedback">
                        <?= $validation->getError('zona_waktu') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="jam_masuk">
                    Jam Masuk <span class="required">*</span>
                </label>
                <input 
                    type="time" 
                    class="form-control <?= (isset($validation) && $validation->hasError('jam_masuk')) ? 'is-invalid' : '' ?>"
                    id="jam_masuk" 
                    name="jam_masuk" 
                    value="<?= old('jam_masuk') ?>"
                    required
                >
                <?php if (isset($validation) && $validation->hasError('jam_masuk')) : ?>
                    <div class="invalid-feedback">
                        <?= $validation->getError('jam_masuk') ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="jam_pulang">
                    Jam Pulang <span class="required">*</span>
                </label>
                <input 
                    type="time" 
                    class="form-control <?= (isset($validation) && $validation->hasError('jam_pulang')) ? 'is-invalid' : '' ?>"
                    id="jam_pulang" 
                    name="jam_pulang" 
                    value="<?= old('jam_pulang') ?>"
                    required
                >
                <?php if (isset($validation) && $validation->hasError('jam_pulang')) : ?>
                    <div class="invalid-feedback">
                        <?= $validation->getError('jam_pulang') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-group">
            <label for="radius">
                Radius Presensi (meter)
            </label>
            <input 
                type="number" 
                class="form-control <?= (isset($validation) && $validation->hasError('radius')) ? 'is-invalid' : '' ?>"
                id="radius" 
                name="radius" 
                value="<?= old('radius', '100') ?>"
                placeholder="100"
                min="10"
                max="1000"
            >
            <?php if (isset($validation) && $validation->hasError('radius')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('radius') ?>
                </div>
            <?php endif; ?>
            <small class="form-text text-muted">
                <i class="fas fa-info-circle"></i>
                Radius maksimal untuk presensi dari lokasi ini (default: 100 meter)
            </small>
        </div>

        <div class="form-group">
            <label for="keterangan">
                Keterangan
            </label>
            <textarea 
                class="form-control <?= (isset($validation) && $validation->hasError('keterangan')) ? 'is-invalid' : '' ?>"
                id="keterangan" 
                name="keterangan" 
                rows="3"
                placeholder="Keterangan tambahan lokasi (opsional)"
                maxlength="1000"
            ><?= old('keterangan') ?></textarea>
            <?php if (isset($validation) && $validation->hasError('keterangan')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('keterangan') ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary" id="btnSubmit">
                <i class="fas fa-save"></i>
                Simpan Data
            </button>
            <a href="<?= base_url('Admin/LokasiPresensi') ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formLokasiPresensi');
    const submitBtn = document.getElementById('btnSubmit');
    
    // Form validation
    form.addEventListener('submit', function(e) {
        let isValid = true;
        const requiredFields = ['nama_lokasi', 'alamat_lokasi', 'tipe_lokasi', 'zona_waktu', 'jam_masuk', 'jam_pulang'];
        
        requiredFields.forEach(function(fieldName) {
            const field = document.getElementById(fieldName);
            const value = field.value.trim();
            
            if (!value) {
                isValid = false;
                field.classList.add('is-invalid');
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        // Validate jam pulang > jam masuk
        const jamMasuk = document.getElementById('jam_masuk').value;
        const jamPulang = document.getElementById('jam_pulang').value;
        
        if (jamMasuk && jamPulang && jamMasuk >= jamPulang) {
            alert('Jam pulang harus lebih besar dari jam masuk!');
            document.getElementById('jam_pulang').classList.add('is-invalid');
            isValid = false;
        }
        
        // Validate radius
        const radius = document.getElementById('radius');
        if (radius.value && (radius.value < 10 || radius.value > 1000)) {
            alert('Radius harus antara 10-1000 meter!');
            radius.classList.add('is-invalid');
            isValid = false;
        }
        
        if (!isValid) {
            e.preventDefault();
            alert('Mohon perbaiki kesalahan pada form!');
            return false;
        }
        
        // Show loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
    });
    
    // Reset invalid state on input
    const inputs = form.querySelectorAll('input, select, textarea');
    inputs.forEach(function(input) {
        input.addEventListener('input', function() {
            this.classList.remove('is-invalid');
        });
    });
    
    // Auto-format time inputs
    const timeInputs = document.querySelectorAll('input[type="time"]');
    timeInputs.forEach(function(input) {
        input.addEventListener('change', function() {
            // Additional time validation can be added here
            this.classList.remove('is-invalid');
        });
    });
});
</script>

<?= $this->endSection() ?>